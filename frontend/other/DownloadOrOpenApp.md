需求：
--------

根据场景判断下载或者安装APP：页面判断本地环境（IOS、Android）是否安装APP，安装则打开APP相应页面，未安装则自动跳转到下载APP页面（AppStore、腾讯应用宝、自定义下载APP页面）或直接下载APP安装文件。

参考调研
------------

**回家吃饭**

下面是回家吃饭的一条运营推广短信：

    ［回家吃饭］美食当然要分享，成功邀请1位好友，你与好友平分60元饭票！多邀多得，奖励无限！详情戳http://dwz.cn/2XWhBc 回复TD退订
    
通过还原上面的短链接（是通过百度短网址服务dwz.cn进行还原或生成）：

    http://m.jiashuangkuaizi.com/activities/a201511/loadApp?media=shouye

好的开始分析核心代码：
```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>回家吃饭</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
</head>
<body>
加载中，请稍候 ...
<a id="loadAppButton" href="chomecook://jskz/media=shouye" style="display:none;width:0px;height:0px;"></a>
</body>
<script>
var iframe = document.createElement('iframe');
iframe.style.cssText = 'display:none;width:0px;height:0px;';
document.body.appendChild(iframe);

function loadApp() {
    //var ua = navigator.userAgent.toLowerCase();
    var ua = navigator.userAgent;
        var platform = /MicroMessenger/i.test(ua) ? "weixin" : /Android/i.test(ua) ? "android" : /iPhone|iPad|iPod/i.test(ua) ? "ios" : "pc";
        var version = "2.4.2";
        if (platform == "android") {
            location.href = "http://a.app.qq.com/o/simple.jsp?pkgname=com.privatekitchen.huijia";
        } else if (platform == "ios") {
            location.href = 'https://itunes.apple.com/app/id922791815';
        } else if (platform == "weixin") {
            //location.href = "http://a.app.qq.com/o/simple.jsp?pkgname=com.privatekitchen.huijia";
            alert('在浏览器中打开');
        } else if (platform == "pc") {
            location.href = "http://a.app.qq.com/o/simple.jsp?pkgname=com.privatekitchen.huijia";
      	    //location.href = 'http://m.oyekeji.com/apk/media/huijiachifan/huijiachifan_user_' + version + '.apk';
    }
}

var doOpenApp = function() {
    //iframe.src = 'chomecook://jskz/action_name=HomePage';
    setTimeout('loadApp();', 3000);
    document.getElementById('loadAppButton').click();
};
window.onload=function(){
    doOpenApp();
}
</script>
</html>
```
**京东触屏**

m.jd.com

**淘宝触屏**

m.taobao.com

