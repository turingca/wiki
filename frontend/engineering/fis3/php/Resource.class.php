<?php
/**
 * 提供页面中管理资源的API接口
 */
class FISResource {
    //定义常量，不可修改
    const CSS_LINKS_HOOK = '<!--[FIS_CSS_LINKS_HOOK]-->';
    const JS_SCRIPT_HOOK = '<!--[FIS_JS_SCRIPT_HOOK]-->';
    const FRAMEWORK_HOOK = '<!--[FIS_FRAMEWORK_HOOK]-->';
    // http://php.net/manual/zh/language.oop5.static.php
    // 静态变量仅在局部函数域中存在，但当程序执行离开此作用域时，其值并不丢失
    // 资源映射数组
    private static $arrMap = array();
    // 已加载资源数组
    private static $arrLoaded = array();
    // 异步已删除数组
    private static $arrAsyncDeleted = array();
    // 静态资源收集数组
    private static $arrStaticCollection = array();
    // 收集require.async组件
    private static $arrRequireAsyncCollection = array();
    // 内联js代码池
    private static $arrScriptPool = array();

    public static $framework = null;

    // 记录{%script%}, {%style%}的id属性
    public static $cp = null;

    // 内嵌styles,内联样式数组
    public static $styleArray = array();
    // 配置
    public static $config = array();
    // 重置
    public static function reset(){
        self::$arrMap = array();
        self::$arrLoaded = array();
        self::$arrAsyncDeleted = array();
        self::$arrStaticCollection = array();
        self::$arrScriptPool = array();
        self::$framework  = null;
    }
    // 设置配置
    public static function setConfig($config) {
        self::$config = $config;
    }
    // 添加静态资源
    public static function addStatic($src) {
        // http://php.net/manual/zh/function.preg-match.php
        // 搜索$src与给定的正则表达式的一个匹配,$m被填充为搜索结果,$m[0]将包含完整模式匹配到的文本
        // $m[1] 将包含第一个捕获子组匹配到的文本，以此类推。
        preg_match('/\.(\w+)(?:\?[\s\S]+)?$/', $src, $m);
        if (!$m) {
            return;
        }
        $typ = $m[1];
        // http://am1.php.net/manual/zh/function.is-array.php
        // 检测变量是否是数组
        if (!is_array(self::$arrStaticCollection[$typ])) {
            self::$arrStaticCollection[$typ] = array();
        }
        // http://am1.php.net/manual/zh/function.in-array.php
        // 检查数组中是否存在某个值$src
        if (!in_array($src, self::$arrStaticCollection[$typ])) {
            self::$arrStaticCollection[$typ][] = $src;
        }
    }
    // 设置标记位，控制$mode的输出位置
    // php内核预定义常量PHP_EOL提高代码的源代码级可移植性(换行符unix系列用 \n windows系列用 \r\n mac用 \r)
    public static function placeHolder($mode) {
        // 标记位字符串
        $placeHolder = '';
        switch ($mode) {
            /*case 'mod':
            case 'framework':
                $placeHolder = self::FRAMEWORK_HOOK;
                break;*/
            case 'js':
                $placeHolder = self::FRAMEWORK_HOOK .  PHP_EOL  . self::JS_SCRIPT_HOOK;
                break;
            case 'css':
                $placeHolder = self::CSS_LINKS_HOOK;
                break;
            default:
                break;
        }
        return $placeHolder;
    }

    /**
     * 输出模板的最后，替换css hook为css标签集合,替换js hook为js代码
     * @param  [type] $strContent 缓冲区内容
     * @return [type]             [description]
     */
    public static function renderResponse($strContent) {
        // http://php.net/manual/zh/function.strpos.php
        // strpos返回字符串首次出现的位置
        $cssIntPos = strpos($strContent, self::CSS_LINKS_HOOK);
        if($cssIntPos !== false){
            // http://am1.php.net/manual/zh/function.substr-replace.php
            // 在字符串$strContent的副本中将由$cssIntPos和可选的length参数限定的子字符串使用self::render('css')进行替换。
            // http://am1.php.net/manual/zh/function.strlen.php
            // 返回字符串的长度；如果为空则返回0
            $strContent = substr_replace($strContent, self::render('css'), $cssIntPos, strlen(self::CSS_LINKS_HOOK));
        }
        $frameworkIntPos = strpos($strContent, self::FRAMEWORK_HOOK);
        if($frameworkIntPos !== false){
            $strContent = substr_replace($strContent, self::render('framework'), $frameworkIntPos, strlen(self::FRAMEWORK_HOOK));
        }
        $jsIntPos = strpos($strContent, self::JS_SCRIPT_HOOK);
        if($jsIntPos !== false){
            $jsContent = ($frameworkIntPos !== false) ? '' : self::getModJsHtml(); 
            $jsContent .= self::render('js') . self::renderScriptPool();
            $strContent = substr_replace($strContent, $jsContent, $jsIntPos, strlen(self::JS_SCRIPT_HOOK));
        }
        // 重置
        self::reset();
        return $strContent;
    }

    // 设置framewok mod.js
    public static function setFramework($strFramework) {
        self::$framework = $strFramework;
    }

    /**
     * 返回静态资源uri，有打包的时候，返回包的uri
     * @param  $strName 资源路径
     * @return [type]          [description]
     */
    public static function getUri($strName) {
        // http://php.net/manual/zh/function.strpos.php
        // strpos返回字符串首次出现的位置
        $intPos = strpos($strName, ':');
        if($intPos === false){
            $strNamespace = '__global__';
        } else {
            // http://php.net/manual/zh/function.substr.php
            // 返回字符串$strName从0开始$intPos长的的子字符串。
            $strNamespace = substr($strName, 0, $intPos);
        }
        if(isset(self::$arrMap[$strNamespace]) || self::register($strNamespace)) {
            $arrMap = &self::$arrMap[$strNamespace];

            if (isset($arrMap['res'][$strName])) {
                $arrRes = &$arrMap['res'][$strName];
                if($arrRes['type'] == 'php'){
                    // 模板目录拼接资源uri
                    return self::$config['template_dir'] . $arrRes['uri'];
                }else {
                    // http://php.net/manual/zh/function.array-key-exists.php
                    // array_key_exists()检查给定的键名或索引fis_debug是否存在于数组$_GET中
                    if(!array_key_exists('fis_debug', $_GET) && isset($arrRes['pkg'])) {
                        $arrPkg = &$arrMap['pkg'][$arrRes['pkg']];
                        // 打包后的uri
                        return $arrPkg['uri'];
                    } else {
                        // 资源uri
                        return $arrRes['uri'];
                    } 
                }
                
            }
        }
    }
    /**
     * 添加内联样式代码池
     * @param [type] $style [description]
     */
    public static function addStylePool($style) {
        self::$styleArray[] = $style;
    }
    // modjs的html
    private static function getModJsHtml() {
        $html = '';
        // 获取异步js资源集合，变为json格式的resourcemap
        $resourceMap = self::getResourceMap();
        $loadModJs = (self::$framework && (isset(self::$arrStaticCollection['js']) || $resourceMap));
        //require.resourceMap要在mod.js加载以后执行
        if ($loadModJs) {
            $html .= '<script type="text/javascript" src="' . self::$framework . '"></script>' . PHP_EOL;
        }
        if ($resourceMap) {
            $html .= '<script type="text/javascript">';
            $html .= 'require.resourceMap('.$resourceMap.');';
            $html .= '</script>';
        }
        return $html;
    }

    /**
     * 渲染资源，将收集到的js css，变为html标签，异步js资源变为resource map。
     * @param  [type] $type [description]
     * @return [type]       [description]
     */
    public static function render($type) {
        $html = '';
        if ($type === 'js') {
            if (isset(self::$arrStaticCollection['js'])) {
                $arrURIs = &self::$arrStaticCollection['js'];
                foreach ($arrURIs as $uri) {
                    if ($uri === self::$framework) {
                        continue;
                    }
                    $html .= '    <script type="text/javascript" src="' . $uri . '"></script>' . PHP_EOL;
                }
            }
        } else if($type === 'css'){
            if(isset(self::$arrStaticCollection['css'])){
                $arrURIs = &self::$arrStaticCollection['css'];
                // http://am1.php.net/manual/zh/function.implode.php
                // 返回一个字符串，其内容为由('"/>'.PHP_EOL.'<link rel="stylesheet" type="text/css" href="')分割开的数组的值。
                $html = '<link rel="stylesheet" type="text/css" href="' . implode('"/>' . PHP_EOL . '    <link rel="stylesheet" type="text/css" href="', $arrURIs) . '"/>' ;
            }
            if (self::$styleArray) {
                $html .= PHP_EOL . '    <style type="text/css">';
                $html .= PHP_EOL . implode("\n", self::$styleArray);
                $html .= '</style>';
            }
        } else if($type === 'framework'){
            $html .= self::getModJsHtml();
        }

        return $html;
    }

    /**
     * 添加js代码池
     * @param [type] $str      [description]
     * @param [type] $priority [description]
     */
    public static function addScriptPool($str, $priority) {
        // http://am1.php.net/manual/zh/function.intval.php
        $priority = intval($priority);
        if (!isset(self::$arrScriptPool[$priority])) {
            self::$arrScriptPool[$priority] = array();
        }
        self::$arrScriptPool[$priority][] = $str;
    }

    /**
     * 输出js，将页面的js源代码集合到pool，一起输出
     * @return [type] [description]
     */
    public static function renderScriptPool() {
        $html = '';
        if(!empty(self::$arrScriptPool)) {
            // http://am1.php.net/manual/zh/function.array-keys.php
            // 返回数组中的数字或者字符串的键名
            $priorities = array_keys(self::$arrScriptPool);
            // http://am1.php.net/manual/zh/function.rsort.php
            // 对数组逆向排序,为array中的元素赋与新的键名
            rsort($priorities);
            foreach ($priorities as $priority) {
                $html .= '<script type="text/javascript">!function(){' . implode("}();\n!function(){", self::$arrScriptPool[$priority]) . '}();</script>';
            }
        }
        return $html;
    }

    /**
     * 获取异步js资源集合，变为json格式的resourcemap
     * @return [type] [description]
     */
    public static function getResourceMap() {
        $ret = '';
        $arrResourceMap = array();
        // 非debug状态下需要打包
        $needPkg = !array_key_exists('fis_debug', $_GET);
        if (isset(self::$arrRequireAsyncCollection['res'])) {
            foreach (self::$arrRequireAsyncCollection['res'] as $id => $arrRes) {
                $deps = array();
                if (!empty($arrRes['deps'])) {
                    foreach ($arrRes['deps'] as $strName) {
                        // http://am1.php.net/manual/zh/function.preg-match.php
                        // 执行一个正则表达式匹配
                        if (preg_match('/\.js$/i', $strName)) {
                            $deps[] = $strName;
                        }
                    }
                }

                $arrResourceMap['res'][$id] = array(
                    'url' => $arrRes['uri'],
                );

                if (!empty($arrRes['pkg']) && $needPkg) {
                    $arrResourceMap['res'][$id]['pkg'] = $arrRes['pkg'];
                }

                if (!empty($deps)) {
                    $arrResourceMap['res'][$id]['deps'] = $deps;
                }
            }
        }
        if (isset(self::$arrRequireAsyncCollection['pkg']) && $needPkg) {
            foreach (self::$arrRequireAsyncCollection['pkg'] as $id => $arrRes) {
                $arrResourceMap['pkg'][$id] = array(
                    'url'=> $arrRes['uri']
                );
            }
        }
        if (!empty($arrResourceMap)) {
            // http://am1.php.net/manual/zh/function.str-replace.php
            // 该函数返回一个字符串或者数组。该字符串或数组是将参数3中全部的参数1都被参数2替换之后的结果。
            $ret = str_replace('\\/', '/', json_encode($arrResourceMap));
        }
        return  $ret;
    }

    // 获取并注册对应命名空间的map.json到$arrMap映射数组
    public static function register($strNamespace) {
        if($strNamespace === '__global__'){
            $strMapName = 'map.json';
        } else {
            $strMapName = $strNamespace . '-map.json';
        }
        // 配置目录
        $arrConfigDir = self::$config['config_dir'];
        // http://am1.php.net/manual/zh/function.preg-replace.php
        // 搜索参数3中匹配参数1的部分,以参数2进行替换。
        $strPath = preg_replace('/[\\/\\\\]+/', '/', $arrConfigDir . '/' . $strMapName);
        // http://php.net/manual/zh/function.is-file.php
        // 判断给定文件路径文件名是否为一个正常的文件
        if(is_file($strPath)) {
            // http://php.net/manual/zh/function.json-decode.php
            // 对JSON格式的字符串进行解码,第二个参数为true时,将返回array而非object
            // http://php.net/manual/zh/function.file-get-contents.php
            // file_get_contents()函数是用来将文件的内容读入到一个字符串中的首选方法
            // 操作系统支持还会使用内存映射技术来增强性能。
            self::$arrMap[$strNamespace] = json_decode(file_get_contents($strPath), true);
            return true;
        }
        return false;
    }

    /**
     * 分析组件依赖
     * @param array $arrRes 组件信息
     * @param bool  $async  是否异步
     */
    private static function loadDeps($arrRes, $async) {
        //require.async
        if (isset($arrRes['extras']) && isset($arrRes['extras']['async'])) {
            foreach ($arrRes['extras']['async'] as $uri) {
                self::load($uri, true);
            }
        }
        if(isset($arrRes['deps'])){
            foreach ($arrRes['deps'] as $strDep) {
                self::load($strDep, $async);
            }
        }
    }

    /**
     * 已经分析到的组件在后续被同步使用时在异步组里删除。
     * @param $strName
     */
    private static function delAsyncDeps($strName, $onlyDeps = false) {
        if (isset(self::$arrAsyncDeleted[$strName])) {
            return true;
        } else {
            self::$arrAsyncDeleted[$strName] = true;

            $arrRes = self::$arrRequireAsyncCollection['res'][$strName];

            //first deps
            if (isset($arrRes['deps'])) {
                foreach ($arrRes['deps'] as $strDep) {
                    if (isset(self::$arrRequireAsyncCollection['res'][$strDep])) {
                        self::delAsyncDeps($strDep);
                    }
                }
            }

            if ($onlyDeps) {
                return true;
            }

            //second self
            if (isset($arrRes['pkg'])) {
                $arrPkg = self::$arrRequireAsyncCollection['pkg'][$arrRes['pkg']];
                $syncJs = isset(self::$arrStaticCollection['js']) ? self::$arrStaticCollection['js'] : array();
                if ($arrPkg && !in_array($arrPkg['uri'], $syncJs)) {
                    //@TODO
                    //unset(self::$arrRequireAsyncCollection['pkg'][$arrRes['pkg']]);
                    foreach ($arrPkg['has'] as $strHas) {
                        if (isset(self::$arrRequireAsyncCollection['res'][$strHas])) {
                            self::$arrLoaded[$strName] = $arrPkg['uri'];
                            self::delAsyncDeps($strHas, true);
                        }
                    }
                    self::$arrStaticCollection['js'][] = $arrPkg['uri'];
                } else {
                    //@TODO
                    //unset(self::$arrRequireAsyncCollection['res'][$strName]);
                }
            } else {
                //已经分析过的并且在其他文件里同步加载的组件，重新收集在同步输出组
                self::$arrStaticCollection['js'][] = $arrRes['uri'];
                self::$arrLoaded[$strName] = $arrRes['uri'];
                //@TODO
                //unset(self::$arrRequireAsyncCollection['res'][$strName]);
            }
        }
    }

    /**
     * 加载组件以及组件依赖,分析依赖
     * @param $strName      资源路径
     * @param bool $async   是否为异步组件（only JS）
     * @return mixed
     */
    public static function load($strName, $async = false) {
        // isset检测变量是否设置,并且不是NULL
        // 判断资源是否已经加载过，是否在已加载数组中
        if(isset(self::$arrLoaded[$strName])) {
            // 同步组件优先级比异步组件高
            if (!$async && isset(self::$arrRequireAsyncCollection['res'][$strName])) {
                self::delAsyncDeps($strName);
            }
            return self::$arrLoaded[$strName];
        } else {
            // http://php.net/manual/zh/function.strpos.php
            // strpos返回字符串首次出现的位置
            $intPos = strpos($strName, ':');
            if($intPos === false) {
                // 命名空间全局
                $strNamespace = '__global__';
            } else {
                // http://php.net/manual/zh/function.substr.php
                // 返回字符串$strName从0开始$intPos长的的子字符串。
                // 命名空间指定
                $strNamespace = substr($strName, 0, $intPos);
            }
            // 是否$arrMap里有该命名空间,没有则注册对应命名空间的map.json到$arrMap映射数组
            if(isset(self::$arrMap[$strNamespace]) || self::register($strNamespace)) {
                // php引用符号&,引用同一内存地址
                $arrMap = &self::$arrMap[$strNamespace];
                // 资源打包数组
                $arrPkg = null;
                // 打包依赖数组
                $arrPkgHas = array();

                if(isset($arrMap['res'][$strName])) {
                    $arrRes = &$arrMap['res'][$strName];
                    // http://php.net/manual/zh/function.array-key-exists.php
                    // array_key_exists()检查给定的键名或索引fis_debug是否存在于数组$_GET中
                    if(!array_key_exists('fis_debug', $_GET) && isset($arrRes['pkg'])){
                        $arrPkg = &$arrMap['pkg'][$arrRes['pkg']];
                        $strURI = $arrPkg['uri'];

                        foreach ($arrPkg['has'] as $strResId) {
                            self::$arrLoaded[$strResId] = $strURI;
                        }

                        foreach ($arrPkg['has'] as $strResId) {
                            $arrHasRes = &$arrMap['res'][$strResId];
                            $arrPkgHas[$strResId] = $arrHasRes;
                            // 加载依赖
                            self::loadDeps($arrHasRes, $async);
                        }
                    } else {
                        $strURI = $arrRes['uri'];
                        self::$arrLoaded[$strName] = $strURI;
                        self::loadDeps($arrRes,  $async);
                    }

                    if ($async && $arrRes['type'] === 'js') {
                        if ($arrPkg) {
                            self::$arrRequireAsyncCollection['pkg'][$arrRes['pkg']] = $arrPkg;
                            // http://am1.php.net/manual/zh/function.array-merge.php
                            // 合并一个或多个数组
                            self::$arrRequireAsyncCollection['res'] = array_merge((array)self::$arrRequireAsyncCollection['res'], $arrPkgHas);
                        } else {
                            self::$arrRequireAsyncCollection['res'][$strName] = $arrRes;
                        }
                    } else {
                        self::$arrStaticCollection[$arrRes['type']][] = $strURI;
                    }
                    return $strURI;
                } else {
                    self::triggerError($strName, 'undefined resource "' . $strName . '"', E_USER_NOTICE);
                }
            } else {
                self::triggerError($strName, 'missing map file of "' . $strNamespace . '"', E_USER_NOTICE);
            }
        }
        self::triggerError($strName, 'unknown resource "' . $strName . '" load error', E_USER_NOTICE);
    }

    /**
     * 用户代码自定义js组件，其没有对应的文件
     * 只有有后缀的组件找不到时进行报错
     * @param $strName       组件ID
     * @param $strMessage    错误信息
     * @param $errorLevel    错误level
     */
    private static function triggerError($strName, $strMessage, $errorLevel) {
        $arrExt = array(
            'js',
            'css',
            'tpl',
            'html',
            'xhtml',
        );
        if (preg_match('/\.('.implode('|', $arrExt).')$/', $strName)) {
            trigger_error(date('Y-m-d H:i:s') . '   ' . $strName . ' ' . $strMessage, $errorLevel);
        }
    }
}
//scriptStart、scriptEnd 这对函数包裹的内嵌js将合并输出并分析依赖，注意添加<script>标记
function scriptStart() {
    ob_start();
}

function scriptEnd() {
    $script = ob_get_clean();
    $reg = "/(<script(?:\s+[\s\S]*?[\"'\s\w\/]>|\s*>))([\s\S]*?)(?=<\/script>|$)/i";
    // http://am1.php.net/manual/zh/function.preg-match.php
    // 执行一个正则表达式匹配,如果提供了参数3matches,它将被填充为搜索结果,$matches[0]将包含完整模式匹配到的文本
    // $matches[1]将包含第一个捕获子组匹配到的文本，以此类推。
    if(preg_match($reg,$script,$matches)){
        FISResource::addScriptPool($matches[2]);
    }else{
        FISResource::addScriptPool($script);
    }
}
// styleStart、styleEnd 这对函数包裹的内嵌css片段将合并输出到指定位置，内嵌css <style>标签是可选的
function styleStart() {
    ob_start();
}

function styleEnd() {
    $style = ob_get_clean();
    $reg = "/(<style(?:\s+[\s\S]*?[\"'\s\w\/]>|\s*>))([\s\S]*?)(?=<\/style>|$)/i";
    // http://am1.php.net/manual/zh/function.preg-match.php
    if(preg_match($reg,$style,$matches)){
        FISResource::addStylePool($matches[2]);
    }else{
        FISResource::addStylePool($style);
    }
}

/**
 * 设置前端加载器
 * @param [type] $id [description]
 */
function framework($id){
    FISResource::setFramework(FISResource::getUri($id));
}

/**
 * 加载某个资源及其依赖,同步加载css或js资源
 * @param  [type] $id 资源路径('static/css/style.css')
 * @return [type]     [description]
 */
function import($id) {
    FISResource::load($id);
}

/**
 * 添加标记位,控制css和js的输出位置
 * @param  [type] $type 资源文件后缀'js'或'css'
 * @return [type]       [description]
 */
function placeholder($type) {
    echo FISResource::placeholder($type);
}

/**
 * 加载组件,加载某个组件和对应的资源,支持传递数据(可选)到组件中
 * @param  [type] $id   资源路径("widget/footer/footer.php")
 * @param  array  $args 传递的数据，必须是关联数组
 * @return [type]       [description]
 */
function widget($id, $args = array()) {
    // 获取对应资源uri
    $uri = FISResource::getUri($id);
    // http://am1.php.net/manual/zh/function.is-file.php
    // 如果文件存在且为正常的文件则返回TRUE，否则返回FALSE
    if (is_file($uri)) {
        // http://php.net/manual/zh/function.extract.php
        // 关联数组的键名作变量,键值作变量值,导入到当前符号表,返回成功导入到符号表中的变量数目。
        extract($args);
        include $uri;
        FISResource::load($id);
    }
}

/**
 * 渲染页面
 * @param  [type] $id    资源路径
 * @param  [type] $array 传递的数据，必须是关联数组
 * @return [type]        [description]
 */
function display($id, $array) {
    // 获取资源uri
    $path = FISResource::getUri($id);
    // http://am1.php.net/manual/zh/function.is-file.php
    // 如果文件存在且为正常的文件则返回TRUE，否则返回FALSE
    if (is_file($path)) {
        // http://php.net/manual/zh/function.extract.php
        // 关联数组的键名作变量,键值作变量值,导入到当前符号表,返回成功导入到符号表中的变量数目。
        extract($array);
        // http://am1.php.net/manual/zh/function.ob-start.php
        // 此函数将打开输出缓冲,当输出缓冲激活后，脚本将不会输出内容(除http标头外)相反需要输出的内容被存储在内部缓冲区中
        // 内部缓冲区的内容可以用ob_get_contents()函数复制到一个字符串变量中.想要输出存储在内部缓冲区中的内容,可以使用ob_end_flush()
        // 函数.另外,使用ob_end_clean()函数会静默丢弃掉缓冲区的内容
        ob_start();
        include $path;
        // http://am1.php.net/manual/zh/function.ob-get-clean.php
        // 得到当前缓冲区的内容并删除当前输出缓冲区,ob_get_clean()实质上是一起执行了ob_get_contents()和ob_end_clean()。
        $html = ob_get_clean();
        FISResource::load($id); // 注意模板资源也要分析依赖，否则可能加载不全
        echo FISResource::renderResponse($html);
    } else {
        //  报错文件找不到
        trigger_error($id . ' file not found!');
    }
}
