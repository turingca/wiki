百度地图JavaScript API v2.0(有删减，访问该完整百度文档见下链接)

    http://lbsyun.baidu.com/index.php?title=jspopular

概述
----
JavaScript API v2.0
百度地图JavaScript API是一套由JavaScript语言编写的应用程序接口，可帮助您在网站中构建功能丰富、交互性强的地图应用，支持PC端和移动端基于浏览器的地图应用开发，且支持HTML5特性的地图开发。
该套API免费对外开放。自v1.5版本起，您需先[申请密钥（ak）](http://lbsyun.baidu.com/apiconsole/key?application=key)才可使用，接口（除发送短信功能外）无使用次数限制。
在您使用百度地图JavaScript API之前，请先阅读百度地图API[使用条款](http://lbsyun.baidu.com/index.php?title=open/law#qa001)。任何非营利性应用请直接使用，商业应用请参考[使用须知](http://lbsyun.baidu.com/index.php?title=open/question)。
JavaScript API首家支持Https，如需要申请Https服务，请您[认证企业信息](http://lbsyun.baidu.com/apiconsole/auth)，成为企业认证用户后，https将自动开通，同时获得更高的服务配额。

简介
----
百度地图JavaScript API是一套由JavaScript语言编写的应用程序接口，它能够帮助您在网站中构建功能丰富、交互性强的地图应用，包含了构建地图基本功能的各种接口，提供了诸如本地搜索、路线规划等数据服务。

* 基本地图功能：展示（支持2D图、3D图、卫星图）、平移、缩放、拖拽等。

* 地图控件展示功能：可以在地图上添加/删除鹰眼、工具条、比例尺、自定义版权、地图类型及定位控件，并可以设置各类控件的显示位置。

* 覆盖物功能：支持在地图上添加/删除点、线、面、热区、行政区划、用户自定义覆盖物等；开源库提供富标注、标注管理器、聚合marker、自定义覆盖物等功能。

* 工具类功能：提供经纬度坐标与屏幕坐标互转功能；开源库里提供测距、几何运算及GPS坐标/国测局坐标转百度坐标等功能。

* 定位功能：支持IP定位及浏览器（支持html5特性浏览器）定位功能。

* 右键菜单功能：支持在地图上添加右键菜单。

* 鼠标交互功能：支持动态修改鼠标样式、鼠标拖拽/缩放地图及鼠标绘制等功能。

* 图层功能：支持重设地图底图、地图上叠加实时交通图层或自定义图层功能。

* 本地搜索功能：包括根据城市、矩形范围、圆形范围等条件进行POI搜索；且支持用户自有数据的检索。

* 公交检索：支持起始点坐标、起始点名称、LocalSearchPoi实例三种检索条件的检索；检索结果支持便捷、可换乘、少步行、不乘地铁四种方案。

* 驾车检索：支持起始点坐标、起始点名称、LocalSearchPoi实例三种检索条件的检索；返回最短时间、最短距离、避开高速的驾车导航结果；且提供计算打车费用服务。

* 步行导航：提供步行导航方案。

* 逆/地理编码：支持百度坐标与地址描述信息之间的转换服务。

* 个性化数据展示功能：用户自有数据存储到LBS.云后，JavaScript API可以提供以麻点图形式展示自有数据功能。

坐标体系
--------

百度地图api中采用两种坐标体系，经纬度坐标系和墨卡托投影坐标系。前者单位是度，后者单位是米，具体定义可以参见百科词条解释：[http://baike.baidu.com/view/61394.htm](http://baike.baidu.com/view/61394.htm) 和 [http://baike.baidu.com/view/301981.htm](http://baike.baidu.com/view/301981.htm) 。

国际经纬度坐标标准为WGS-84,国内必须至少使用国测局制定的GCJ-02,对地理位置进行首次加密。百度坐标在此基础上，进行了BD-09二次加密措施,更加保护了个人隐私。百度对外接口的坐标系并不是GPS采集的真实经纬度，需要通过坐标转换接口进行转换。

从其他体系的坐标迁移到百度坐标，开发者可以使用坐标转换接口进行转换。

引用
----

自JS APIv1.5之后，最新版本为2.0，您需要首先申请密钥（ak），才可成功加载API JS文件。ak的使用方法如下:

    <script src="http://api.map.baidu.com/api?v=2.0&ak=您的密钥" type="text/javascript"></script>


其中参数v为API当前的版本号，目前最新版本为2.0。在1.2版本之前您还可以设置services参数，以告知API是否加载服务部分，true表示加载，false表示不加载，默认为true。

地图API是由JavaScript语言编写的，您在使用之前需要通过script标签将API引用到页面中：
使用V1.4及以前版本的引用方式:

    <script src="http://api.map.baidu.com/api?v=1.4" type="text/javascript"></script>

使用V2.0版本的引用方式：

    <script src="http://api.map.baidu.com/api?v=2.0&ak=您的密钥" type="text/javascript"></script>

其中参数v为API当前的版本号，目前最新版本为2.0。在1.2版本之前您还可以设置services参数，以告知API是否加载服务部分，true表示加载，false表示不加载，默认为true。

API自1.1版本起开始支持iPhone、Android这样的移动平台。
用户通过手机浏览器就可以访问由地图API创建出来的应用。移动平台的屏幕尺寸通常比PC或笔记本要小，操作方式也有所不同。为了更好的在手机浏览器上展示地图，我们有如下建议：

* 将地图容器高设置为100%，使其充满整个屏幕，或者您也可以计算浏览器窗口的大小并进行设置。
* 添加下面的meta标签： <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />

这样做是为了让页面以正常比例进行显示并且禁止用户缩放页面的操作。
您可以参考 [Apple's Developer documentation](https://developer.apple.com/devcenter/safari/index.action) 和 [Android documentation ](http://developer.android.com/index.html)获得更多信息。
移动端开发具体实现请参考[相关下载_示例代码](http://lbsyun.baidu.com/index.php?title=jspopular/js-download)提供的Demo源码。

JavaScript API首家支持Https，如需要申请Https服务，请您认证企业信息，成为企业认证用户后，https将自动开通，同时获得更高的服务配额。
注意：仅JavaScript API V2.0 版本支持https，其他JavaScript API版本均不支持。使用https服务，请先检查您的版本。

如果使用JavaScript API ，需要加一个特殊字段 (s=1)：

    https://api.map.baidu.com/api?v=2.0&ak=你的密钥& s=1；

对于Web API 无需加特殊字段，直接使用 HTTPS协议访问即可，如Geocoding：

    https://api.map.baidu.com/geocoder/v2/?ak=你的秘钥&callback=renderReverse&location=39.983424,116.322987&output=xml&pois=1
    
如果对数据安全要求高，建议使用 POST请求，避免把请求参数放到 URI中敏感信息被泄露；

异步加载
--------

JavaScript API支持异步加载，您可以在引用脚本的时候添加callback参数，当脚本加载完成后callback函数会被立刻调用。请参考下面的使用示例：

    <!DOCTYPE html>  
    <html>  
    <head>  
    <meta charset="utf-8"/>  
    <title>异步加载</title>  
    <script type="text/javascript">  
    function initialize() {  
      var mp = new BMap.Map('map');  
      mp.centerAndZoom(new BMap.Point(121.491, 31.233), 11);  
    }  
       
    function loadScript() {  
      var script = document.createElement("script");  
      script.src = "http://api.map.baidu.com/api?v=2.0&ak=您的密钥&callback=initialize";//此为v2.0版本的引用方式  
      // http://api.map.baidu.com/api?v=1.4&ak=您的密钥&callback=initialize"; //此为v1.4版本及以前版本的引用方式  
      document.body.appendChild(script);  
    }  
       
    window.onload = loadScript;  
    </script>  
    </head>  
    <body>  
      <div id="map" style="width:500px;height:320px"></div>  
    </body>  
    </html>


