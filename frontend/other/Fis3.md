前言
------
```
官方文档：http://fis.baidu.com/fis3/docs/beginning/intro.html
```
```
Github：https://github.com/fex-team
```

FIS3 是面向前端的工程构建工具。解决前端工程中性能优化、资源加载（异步、同步、按需、预加载、依赖管理、合并、内嵌）、模块化开发、自动化工具、开发规范、代码部署等问题。

安装Node和NPM
-------------

node -v 查看当前node版本
node -h 查看nodejs的帮助 

NPM（node package manager）

[对npm的介绍](http://www.92fenxiang.com/175.html)

npm -v  查看当前npm版本
npm config ls -l  查看所有 NPM 的设置
npm prefix -g     查看全局安装路径
npm cache clean   清理缓存

安装Fis3
----------

[NPM安装FIS遇到的问题](https://github.com/fex-team/fis/issues/565)

npm install -g fis3 安装到全局目录，如果 npm 长时间运行无响应，推荐使用 cnpm 来安装

npm install -g fis3 --disturl=http://registry.npm.taobao.org/mirrors/node --registry=http://registry.npm.taobao.org

升级Fis3
--------

npm update -g fis3

重装 npm install -g fis3

构建
------

进入项目根目录，执行命令，进行构建。

项目根目录：FIS3 配置文件（默认fis-conf.js）所在的目录为项目根目录。

```
fis3 release -d <path>

<path> 任意目录

fis3 release -h 获取更多参数
```

**资源定位**

构建过程中对资源URI进行了替换，替换成了绝对URL。通俗点讲就是相对路径换成了绝对路径。
这是一个FIS的很重要的特性：资源定位。资源定位能力，可以有效地分离开发路径与部署路径之间的关系，工程师不再关心资源部署到线上之后去了哪里，变成了什么名字，这些都可以通过配置来指定。而工程师只需要使用相对路径来定位自己的开发资源即可。这样的好处是资源可以发布到任何静态资源服务器的任何路径上，而不用担心线上运行时找不到它们，而且代码具有很强的可移植性，甚至可以从一个产品线移植到另一个产品线而不用担心线上部署不一致的问题。

在默认不配置的情况下只是对资源相对路径修改成了绝对路径。通过配置文件可以轻松分离开发路径（源码路径）与部署路径。比如我们想让所有的静态资源构建后到 static 目录下。

```
//配置配置文件，注意，清空所有的配置，只留下以下代码即可。
fis.match('*.{png,js,css}', {
  release: '/static/$0'
});
```

以上示例只是更改部署路径，还可以给url添加CDN domain或者添加文件指纹（时间戳或者md5戳）。

再次强调，FIS3的构建是不会对源码做修改的，而是构建产出到了另外一个目录，并且构建的结果才是用来上线使用的。

可能有人会疑惑，修改成了绝对路径，本地如何调试开发？下一节介绍调试的方法。

**配置文件**

默认配置文件为 fis-conf.js，FIS3 编译的整个流程都是通过配置来控制的。FIS3 定义了一种类似 CSS 的配置方式。固化了构建流程，让工程构建变得简单。

```
fis.match()
```

首先介绍设置规则的配置接口

```
fis.match(selector, props);
```

selector ：FIS3 把匹配文件路径的路径作为selector，匹配到的文件会分配给它设置的 props。关于selector语法，请参看Glob说明
props ：编译规则属性，包括文件属性和插件属性，更多属性


**glob**

FIS3中支持的glob规则，FIS3使用node-glob提供glob支持。

```
简要说明：

node-glob 中的使用方式有很多，如果要了解全部，请前往 node-glob。

这里把常用的一些用法做说明。

* 匹配0或多个除了 / 以外的字符
? 匹配单个除了 / 以外的字符
** 匹配多个字符包括 /
{} 可以让多个规则用 , 逗号分隔，起到或者的作用
! 出现在规则的开头，表示取反。即匹配不命中后面规则的文件
需要注意的是，fis 中的文件路径都是以 / 开头的，所以编写规则时，请尽量严格的以 / 开头。

当设置规则时，没有严格的以 / 开头，比如 a.js, 它匹配的是所有目录下面的 a.js, 包括：/a.js、/a/a.js、/a/b/a.js。 如果要严格只命中根目录下面的 /a.js, 请使用 fis.match('/a.js')。

另外 /foo/*.js， 只会命中 /foo 目录下面的所有 js 文件，不包含子目录。 而 /foo/**/*.js 是命中所有子目录以及其子目录下面的所有 js 文件，不包含当前目录下面的 js 文件。 如果需要命中 foo 目录下面以及所有其子目录下面的 js 文件，请使用 /foo/**.js。
```

```
扩展的规则:

假设匹配widget目录下以及其子目录下的所有 js 文件，使用 node-glob 需要这么写

widget/{*.js,**/*.js}

这样写起来比较麻烦，所以扩展了这块的语法，以下方式等价于上面的用法

widget/**.js

node-glob 中没有捕获分组，而fis中经常用到分组信息，如下面这种正则用法：

//让a目录下面的js发布到b目录下面，保留原始文件名。
fis.match(/^\/a\/(.*\.js$)/i, {
 release: '/b/$1'
});

由于原始node-glob不支持捕获分组，所以做了对括号用法的扩展，如下用法和正则用法等价。

// 让a目录下面的js发布到b目录下面，保留原始文件名。
fis.match('/a/(**.js)', {
 release: '/b/$1'
});
```

```
捕获分组:

使用node-glob捕获的分组，可以用于其他属性的设定，如release, url, id等。使用的方式与正则替换类似，我们可以用 $1, $2, $3 来代表相应的捕获分组。其中 $0 代表的是match到的整个字符串。

fis.match('/a/(**.js)', {
 release: '/b/$1' // $1 代表 (**.js) 匹配的内容
});
fis.match('/a/(**.js)', {
 release: '/b/$0' // $0 代表 /a/(**.js) 匹配的内容
});

```

```
特殊用法（类 css 伪类）

::package 用来匹配 fis 的打包过程。
::text 用来匹配文本文件。

默认识别这类后缀的文件。

[
'css', 'tpl', 'js', 'php',
'txt', 'json', 'xml', 'htm',
'text', 'xhtml', 'html', 'md',
'conf', 'po', 'config', 'tmpl',
'coffee', 'less', 'sass', 'jsp',
'scss', 'manifest', 'bak', 'asp',
'tmp', 'haml', 'jade', 'aspx',
'ashx', 'java', 'py', 'c', 'cpp',
'h', 'cshtml', 'asax', 'master',
'ascx', 'cs', 'ftl', 'vm', 'ejs',
'styl', 'jsx', 'handlebars'
]

如果你希望命中的文件类型不在列表中，请通过fis.set('project.fileType.text') 扩展，多个后缀用 , 分割。

fis.set('project.fileType.text', 'cpp,hhp');

::image 用来匹配文件类型为图片的文件。

默认识别这类后缀的文件。

[
'svg', 'tif', 'tiff', 'wbmp',
'png', 'bmp', 'fax', 'gif',
'ico', 'jfif', 'jpe', 'jpeg',
'jpg', 'woff', 'cur', 'webp',
'swf', 'ttf', 'eot', 'woff2'
]

如果你希望命中的文件类型不在列表中，请通过 fis.set('project.fileType.image') 扩展，多个后缀用 , 分割。

fis.set('project.fileType.image', 'raw,bpg');

*.html:js 用来匹配命中的html文件中的内嵌的js部分。

fis3 htmlLike 的文件内嵌的js内容也会走单文件编译流程，默认只做标准化处理，如果想压缩，可以进行如下配置。

fis.match('*.html:js', {
  optimizer: fis.plugin('uglify-js')
});

*.html:css 用来匹配命中的html文件中内嵌的css部分。

fis3 htmlLike 的文件内嵌的css内容也会走单文件编译流程，默认只做标准化处理，如果想压缩，可以进行如下配置。

fis.match('*.html:css', {
  optimizer: fis.plugin('clean-css')
});

*.html:inline-style 用来匹配命中的html文件中的内联样式。可以配置些auto prefix之类的插件。

*.html:scss 用来命中 html 文件中的scss部分，具体请参考fis3-demo中的use-xlang

```


属性
-----

全局属性

全局属性通过 fis.set 设置，通过 fis.get 获取；

内置的默认配置

```javascript
var DEFAULT_SETTINGS = {
  project: {
    charset: 'utf8',
    md5Length: 7,
    md5Connector: '_',
    files: ['**'],
    ignore: ['node_modules/**', 'output/**', '.git/**', 'fis-conf.js']
  },

  component: {
    skipRoadmapCheck: true,
    protocol: 'github',
    author: 'fis-components'
  },

  modules: {
    hook: 'components',
    packager: 'map'
  },

  options: {}
};
```

project.charset
解释：指定项目编译后产出文件的编码。
值类型：string
默认值：'utf8'
用法：在项目的fis-conf.js里可以覆盖为fis.set('project.charset', 'gbk');

project.md5Length
解释：文件MD5戳长度。
值类型：number
默认值：7
用法：在项目的fis-conf.js里可以修改为fis.set('project.md5Length', 8);

project.md5Connector
解释：设置md5与文件的连字符。
值类型：string
默认值：_
用法：在项目的fis-conf.js里可以修改为fis.set('project.md5Connector ', '.');

project.files
解释：设置项目源码文件过滤器。
值类型：Array
默认值：'**'
用法：fis.set('project.files', ['*.html']);

project.ignore
解释：排除某些文件
值类型：Array
默认值：['node_modules/**', 'output/**', 'fis-conf.js']
用法fis.set('project.ignore', ['*.bak']); //set为覆盖不是叠加

project.fileType.text
解释：追加文本文件后缀列表。
值类型：Array | string
默认值：无
说明：fis系统在编译时会对文本文件和图片类二进制文件做不同的处理，文件分类依据是后缀名。虽然内部已列出一些常见的文本文件后缀，但难保用户有其他的后缀文件，内部已列入文本文件后缀的列表为： [ 'css', 'tpl', 'js', 'php', 'txt', 'json', 'xml', 'htm', 'text', 'xhtml', 'html', 'md', 'conf', 'po', 'config', 'tmpl', 'coffee', 'less', 'sass', 'jsp', 'scss', 'manifest', 'bak', 'asp', 'tmp' ]，用户配置会 追加，而非覆盖内部后缀列表。
用法：编辑项目的fis-conf.js配置文件fis.set('project.fileType.text', 'tpl, js, css');

project.fileType.image
解释：追加图片类二进制文件后缀列表。
值类型：Array | string
默认值：无
说明：fis系统在编译时会对文本文件和图片类二进制文件做不同的处理，文件分类依据是后缀名。虽然内部已列出一些常见的图片类二进制文件后缀，但难保用户有其他的后缀文件，内部已列入文本文件后缀的列表为： [ 'svg', 'tif', 'tiff', 'wbmp', 'png', 'bmp', 'fax', 'gif', 'ico', 'jfif', 'jpe', 'jpeg', 'jpg', 'woff', 'cur' ]，用户配置会 追加，而非覆盖内部后缀列表。
用法：编辑项目的fis-conf.js配置文件fis.set('project.fileType.image', 'swf, cur, ico');

**文件属性**

fis3以文件属性控制文件的编译合并以及各种操作；文件属性包括基本属性和插件属性，插件属性是为了方便在不同的插件扩展点设置插件；

基本属性：

release
解释：设置文件的产出路径。默认是文件相对项目根目录的路径，以 / 开头。该值可以设置为 false ，表示为不产出（unreleasable）文件。
值类型：string
默认值：无
```
fis.match('/widget/{*,**/*}.js', {
  isMod: true,
  release: '/static/$0'
});
```

packTo
解释：分配到这个属性的文件将会合并到这个属性配置的文件中
值类型：string
默认值：无
```
  fis.match('/widget/{*,**/*}.js', {
      packTo: '/static/pkg_widget.js'
  })
```

widget目录下的所有js文件将会被合并到/static/pkg_widget.js中。packTo设置的是源码路径，也会受到已经设置的fis.match规则的影响，比如可以配置fis.match来更改packTo的产出路径或者 url；

```
  fis.match('/static/pkg_widget.js', {
      release: '/static/${namespace}/pkg/widget.js' // fis.set('namespace', 'home'),
      url: '/static/new/${namespace}/pkg/widget.js'
  })
```

packOrder
解释：用来控制合并时的顺序，值越小越在前面。配合packTo一起使用。
值类型：Integer
默认值：0
```
fis.match('/*.js', {
  packTo: 'pkg/script.js'
})
fis.match('/mod.js', {
  packOrder: -100
})
```

query
解释：指定文件的资源定位路径之后的query，比如'?t=123124132'。
值类型：string
默认值：无
```
  fis.set('new date', Date.now());
  fis.match('*.js', {
      query: '?=t' + fis.get('new date')
  });
```

id
解释：指定文件的资源id。默认是namespace + subpath 的值
值类型：string
默认值：namespace + subpath

如下方例子，假设/static/lib/jquery.js 设定了特定的id jquery, 那么在使用这个组件的时候，可以直接用这个id；
```
fis.match('/static/lib/jquery.js', {
  id: 'jquery',
  isMod: true
});
```
使用
```
  var $ = require('jquery');
```


moduleId
解释：指定文件资源的模块id。在插件fis3-hook-module里面自动包裹define的时候会用到，默认是id的值。
类型：string
默认值：**namespace + subpath**
```
fis.match('/static/lib/a.js', {
  id: 'a',
  moduleId: 'a'
  isMod: true
});
```
编译前
```
exports.a = 10
```
编译后
```
define('a',function(require,exports,module){
  exports.a = 10
})
```


url
解释：指定文件的资源定位路径，以 / 开头。默认是release 的值，url可以与发布路径release不一致。
值类型：string
默认值：无
```
fis.match('*.{js,css}', {
  release: '/static/$0',
  url: '/static/new_project/$0'
})
```

charset
解释：指定文本文件的输出编码。默认是 utf8，可以制定为 gbk 或 gb2312等。
值类型：string
默认值：无
```
fis.match('some/file/path', {
  charset: 'gbk'
});
```
使用 charset 编码需要使用encoding插件发布编译结果


isHtmlLike
解释：指定对文件进行html相关语言能力处理
值类型：bool
默认值：无

isCssLike
解释：指定对文件进行css相关的语言能力处理
值类型：bool
默认值：无

isJsLike
解释：指定对文件进行js相关的语言能力处理
值类型：string
默认值：无

useHash
解释：文件是否携带md5戳
值类型：bool
默认值：false
说明：文件分配到此属性后，其url及其产出带md5戳；
```
  fis.match('*.css', {
      useHash: false
  });
  fis.media('prod').match('*.css', {
      useHash: true
  });
```
fis3 release 时不带hash
fis3 release prod 时带 hash


domain
解释：给文件URL设置domain信息
值类型：string
默认值：无
说明：如果需要给某些资源添加cdn，分配到此属性的资源url会被添加domain；
```
fis.media('prod').match('*.js', {
  domain: 'http://cdn.baidu.com/'
});
```
fis3 release prod 时添加cdn


rExt
解释：设置最终文件产出后的后缀
值类型：string
默认值：无
说明：分配到此属性的资源的真实产出后缀
```
fis.match('*.less', {
  rExt: '.css'
});
```
源码为.less文件产出后修改为.css文件；


useMap
解释：文件信息是否添加到map.json
值类型：bool
默认值：无
说明：分配到此属性的资源出现在静态资源表中，现在对js、css等文件默认加入了静态资源表中；
```
fis.match('logo.png', {
  useMap: true
});
```

isMod
解释：标示文件是否为组件化文件。
值类型：bool
默认值：无
说明：标记文件为组件化文件。被标记成组件化的文件会入map.json表。并且会对js文件进行组件化包装。
```
fis.match('/widget/{*,**/*}.js', {
  isMod: true
});
```

extras
注释：在[静态资源映射表][]中的附加数据，用于扩展[静态资源映射表][]表的功能。
值类型：Object
默认值：无
说明：无
```
fis.match('/page/layout.tpl', {
  extras: {
      isPage: true
  }
});
```

requires
注释：默认依赖的资源id表
值类型：Array
默认值：无
说明：
```
fis.match('/widget/*.js', {
  requires: [
      'static/lib/jquery.js'
  ]
});
```


useSameNameRequire
注释：开启同名依赖
值类型：bool
默认值：false
说明：当设置开启同名依赖，模板会依赖同名css、js；js会依赖同名css，不需要显式引用。
```
fis.match('/widget/**', {
  useSameNameRequire: true
});
```

useCache
注释：文件是否使用编译缓存
值类型：bool
默认值：true
说明：当设置使用编译缓存，每个文件的编译结果均会在磁盘中保存以供下次编译使用。设置为false后，则该文件每次均会被编译。
```
fis.match('**.html', {
  useCache: false
});
```

插件属性

插件属性决定了匹配的文件进行哪些插件的处理；

lint

启用 lint 插件进行代码检查
```
fis.match('*.js', {
    lint: fis.plugin('js', {

    })
})
```

http://npmsearch.com/?q=fis-lint%20fis3-lint


parser
启用parser插件对文件进行处理；
如编译less文件
```
fis.match('*.less', {
   parser: fis.plugin('less'), //启用fis-parser-less插件
   rExt: '.css'
});
```

如编译sass文件
```
fis.match('*.sass', {
    parser: fis.plugin('node-sass'), //启用fis-parser-node-sass插件
    rExt: '.css'
});
```

http://npmsearch.com/?q=fis-parser%20fis3-parser


preprocessor
标准化前处理
```
fis.match('*.{css,less}', {
    preprocessor: fis.plugin('image-set')
});
```

http://npmsearch.com/?q=fis-preprocessor%20fis3-preprocessor


standard
自定义标准化，可以自定义uri、embed、require等三种能力，可自定义三种语言能力的语法；

http://npmsearch.com/?q=fis-standard%20fis3-standard


postprocessor
标准化后处理
```
fis.match('*.{js,tpl}', {
   postprocessor: fis.plugin('require-async')
});
```

http://npmsearch.com/?q=fis-postprocessor%20fis3-postprocessor


optimizer
启用优化处理插件，并配置其属性
```
fis.match('*.css', {
    optimizer: fis.plugin('clean-css')
});
```

http://npmsearch.com/?q=fis-optimizer%20fis3-optimizer



打包阶段插件

打包阶段插件设置时必须分配给所有文件，设置时必须match ::package，不然不做处理。
```
fis.match('::package', {
    packager: fis.plugin('map'),
    spriter: fis.plugin('csssprites')
});
```

prepackager
解释：打包预处理插件
值类型：Array | fis.plugin | function
默认值：无
用法：
```
fis.match('::package', {
  prepackager: fis.plugin('plugin-name')
})
```

packager
解释：打包插件
值类型：Array | fis.plugin | function
默认值：无
用法：
```
  fis.match('::package', {
      packager: fis.plugin('map')
  })
```

例子
```
fis.media('prod').match('::package', {
  packager: fis.plugin('map')
});
```

fis3 release prod 当在 prod 状态下进行打包


spriter
解释：打包后处理csssprite的插件。
值类型：Array | fis.plugin | function
默认值：无
用法：
```
  fis.match('::package', {
      spriter: fis.plugin('csssprites')
  })
```
例子
```
  fis.media('prod').match('::package', {
      spriter: fis.plugin('csssprites')
  });
```
fis3 release prod 当在 prod 状态下进行 csssprites 处理


postpackager
解释：打包后处理插件。
值类型：Array | fis.plugin | function
默认值：无
用法：
```
fis.match('::package', {
  postpackager: fis.plugin('plugin-name')
})
```
例子
```
fis.media('prod').match('::package', {
  postpackager: fis.plugin('plugin-name')
});
```
fis3 release prod 当在 prod 状态下调用打包后处理插件


deploy
解释：设置项目发布方式
值类型：Array | fis.plugin | function
默认值：fis.plugin('local-deliver')
说明：编译打包后，新增发布阶段，这个阶段主要决定了资源的发布方式，而这些方式都是以插件的方式提供的。比如你想一键部署到远端或者是把文件打包到 Tar/Zip 又或者是直接进行 Git 提交，都可以通过设置此属性，调用相应的插件就能搞定了。
用法：

假设项目开发完后，想部署到其他机器上，我们选择http提交数据的方式部署
```
fis.match('**', {
  deploy: fis.plugin('http-push', {
      receiver: 'http://target-host/receiver.php', // 接收端
      to: '/home/work/www' // 将部署到服务器的这个目录下
  })
})
```

```
常用插件
local-deliver
http-push
replace
encoding
```







定位资源
--------

定位资源能力，可以有效地分离开发路径与部署路径之间的关系，工程师不再关心资源部署到线上之后去了哪里，变成了什么名字，这些都可以通过配置来指定。而工程师只需要使用相对路径来定位自己的开发资源即可。这样的好处是：资源可以发布到任何静态资源服务器的任何路径上而不用担心线上运行时找不到它们，而且代码具有很强的可移植性，甚至可以从一个产品线移植到另一个产品线而不用担心线上部署不一致的问题。

![](img/fis3_uri.png)

**在html中定位资源**

FIS3支持对html中的script、link、style、video、audio、embed等标签的src或href属性进行分析，一旦这些标签的资源定位属性可以命中已存在文件，则把命中文件的url路径替换到属性中，同时可保留原来url中的query查询信息。

例如：

```
<!--源码：
<img title="百度logo" src="images/logo.gif"/>
编译后-->
<img title="百度logo" src="/images/logo_74e5229.gif"/>

<!--源码：
<link rel="stylesheet" type="text/css" href="demo.css">
编译后-->
<link rel="stylesheet" type="text/css" href="/demo_7defa41.css">

<!--源码：
<script type="text/javascript" src="demo.js"></script>
编译后-->
<script type="text/javascript" src="/demo_33c5143.js"></script>
```

值得注意的是， 资源定位结果可以被fis的配置文件控制，比如添加配置，调整文件发布路径：

```javascript
fis.match('*.{js,css,png,gif}', {
    useHash: true // 开启 md5 戳
});

// 所有的 js
fis.match('**.js', {
    //发布到/static/js/xxx目录下
    release : '/static/js$0'
});

// 所有的 css
fis.match('**.css', {
    //发布到/static/css/xxx目录下
    release : '/static/css$0'
});

// 所有image目录下的.png，.gif文件
fis.match('/images/(*.{png,gif})', {
    //发布到/static/pic/xxx目录下
    release: '/static/pic/$1$2'
});
```

再次编译得到：

```
<!--源码：
<img title="百度logo" src="images/logo.gif"/>
编译后-->
<img title="百度logo" src="/static/pic/logo_74e5229.gif"/>

<!--源码：
<link rel="stylesheet" type="text/css" href="demo.css">
编译后-->
<link rel="stylesheet" type="text/css" href="/static/css/demo_7defa41.css">

<!--源码：
<script type="text/javascript" src="demo.js"></script>
编译后-->
<script type="text/javascript" src="/static/js/demo_33c5143.js"></script>
```

我们甚至可以让url和发布目录不一致。比如：

```
is.match('*.{js,css,png,gif}', {
    useHash: true // 开启 md5 戳
});

// 所有的 js
fis.match('**.js', {
    //发布到/static/js/xxx目录下
    release : '/static/js$0',
    //访问url是/mm/static/js/xxx
    url : '/mm/static/js$0'
});

// 所有的 css
fis.match('**.css', {
    //发布到/static/css/xxx目录下
    release : '/static/css$0',
    //访问url是/pp/static/css/xxx
    url : '/pp/static/css$0'
});

// 所有image目录下的.png，.gif文件
fis.match('/images/(*.{png,gif})', {
    //发布到/static/pic/xxx目录下
    release: '/static/pic/$1',
    //访问url是/oo/static/baidu/xxx
    url : '/oo/static/baidu$0'
});
```

再次编译得到：

```
<!--源码：
<img title="百度logo" src="images/logo.gif"/>
编译后-->
<img title="百度logo" src="/oo/static/baidu/logo_74e5229.gif"/>

<!--源码：
<link rel="stylesheet" type="text/css" href="demo.css">
编译后-->
<link rel="stylesheet" type="text/css" href="/pp/static/css/demo_7defa41.css">

<!--源码：
<script type="text/javascript" src="demo.js"></script>
编译后-->
<script type="text/javascript" src="/mm/static/js/demo_33c5143.js"></script>
```

**在js中定位资源**

js语言中，可以使用编译函数 __uri(path) 来定位资源，fis分析js文件或html中的script标签内内容时会替换该函数所指向文件的线上url路径。

源码:

```javascript
var img = __uri('images/logo.gif');
```

编译后

```javascript
var img = '/images/logo_74e5229.gif';
```

源码:

```javascript
var css = __uri('demo.css');
```

编译后

```javascript
var css = '/demo_7defa41.css';
```

源码:

```javascript
var js = __uri('demo.js');
```

编译后

```javascript
var js = '/demo_33c5143.js';
```

资源定位结果可以被fis的配置文件控制，比如添加配置，调整文件发布路径：

```
fis.match('*.{js,css,png,gif}', {
    useHash: true // 开启 md5 戳
});

// 所有的 js
fis.match('**.js', {
    //发布到/static/js/xxx目录下
    release : '/static/js$0'
});

// 所有的 css
fis.match('**.css', {
    //发布到/static/css/xxx目录下
    release : '/static/css$0'
});

// 所有image目录下的.png，.gif文件
fis.match('/images/(*.{png,gif})', {
    //发布到/static/pic/xxx目录下
    release: '/static/pic/$1'
});
```

再次编译得到：

源码:

```
var img = __uri('images/logo.gif');
```

编译后

```
var img = '/static/pic/logo_74e5229.gif';
```

源码:

```
var css = __uri('demo.css');
```

编译后

```
var css = '/static/css/demo_7defa41.css';
```

源码:

```
var js = __uri('demo.js');
```

编译后

```
var js = '/static/js/demo_33c5143.js';
```


**在css中定位资源**

fis编译工具会识别css文件或html的style标签内容中url(path)以及src=path字段，并将其替换成对应资源的编译后url路径

源码：

```css
@import url('demo.css');
```

编译后

```css
@import url('/demo_7defa41.css');
```

源码：

```css
.style {
  background: url('images/body-bg.png');
}
```

编译后

```css
.style {
  background: url('/images/body-bg_1b8c3e0.png');
}
```

源码：

```css
.style {
  _filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='images/body-bg.png');
}
```

编译后

```css
.style {
  _filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='/images/body-bg_1b8c3e0.png');
}
```

资源定位结果可以被fis的配置文件控制，比如添加配置，调整文件发布路径：

```
fis.match('*.{js,css,png,gif}', {
    useHash: true // 开启 md5 戳
});

//所有的css文件
fis.match('**.css', {
    //发布到/static/css/xxx目录下
    release : '/static/css$0'
});

//所有image目录下的.png，.gif文件
fis.match('/images/(*.{png,gif})', {
    //发布到/static/pic/xxx目录下
    release : '/static/pic/$1$2'
});
```

再次编译得到：

源码：

```css
@import url('demo.css');
```

编译后

```css
@import url('/static/css/demo_7defa41.css');
```

源码：

```css
.style {
  background: url('images/body-bg.png');
}
```

编译后

```css
.style {
  background: url('/static/pic/body-bg_1b8c3e0.png');
}
```

源码：

```css
.style {
  _filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='images/body-bg.png');
}
```

编译后

```css
.style {
  _filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='/static/pic/body-bg_1b8c3e0.png');
}
```
