微信JS-SDK说明文档

    http://mp.weixin.qq.com/wiki/11/74ad127cc054f6b80759c40f77ec03db.html#.E6.A6.82.E8.BF.B0

概述
----

微信JS-SDK是微信公众平台面向网页开发者提供的基于微信内的网页开发工具包。
通过使用微信JS-SDK，网页开发者可借助微信高效地使用拍照、选图、语音、位置等手机系统的能力，同时可以直接使用微信分享、扫一扫、卡券、支付等微信特有的能力，为微信用户提供更优质的网页体验。
此文档面向网页开发者介绍微信JS-SDK如何使用及相关注意事项。

JSSDK使用步骤
------------

步骤一：绑定域名
先登录微信公众平台进入“公众号设置”的“功能设置”里填写“JS接口安全域名”。
如果你使用了支付类接口，请确保支付目录在该安全域名下，否则将无法完成支付。
备注：登录后可在“开发者中心”查看对应的接口权限。

步骤二：引入JS文件
在需要调用JS接口的页面引入如下JS文件，（支持https）：[http://res.wx.qq.com/open/js/jweixin-1.0.0.js](http://res.wx.qq.com/open/js/jweixin-1.0.0.js)
请注意，如果你的页面启用了https，务必引入 [https://res.wx.qq.com/open/js/jweixin-1.0.0.js](https://res.wx.qq.com/open/js/jweixin-1.0.0.js) ，否则将无法在iOS9.0以上系统中成功使用JSSDK
如需使用摇一摇周边功能，请引入 jweixin-1.1.0.js
备注：支持使用 AMD/CMD 标准模块加载方法加载

步骤三：通过config接口注入权限验证配置
所有需要使用JS-SDK的页面必须先注入配置信息，否则将无法调用（同一个url仅需调用一次，对于变化url的SPA的web app可在每次url变化时进行调用,
目前Android微信客户端不支持pushState的H5新特性，所以使用pushState来实现web app的页面会导致签名失败，此问题会在Android6.2中修复）。

```javascript
wx.config({
    debug: true, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
    appId: '', // 必填，公众号的唯一标识
    timestamp: , // 必填，生成签名的时间戳
    nonceStr: '', // 必填，生成签名的随机串
    signature: '',// 必填，签名，见附录1
    jsApiList: [] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
});
```

步骤四：通过ready接口处理成功验证

```javascript
wx.ready(function(){
    //config信息验证后会执行ready方法，所有接口调用都必须在config接口获得结果之后，
    //config是一个客户端的异步操作，所以如果需要在页面加载时就调用相关接口，则须把相关接口放在ready函数中调用来确保正确执行。
    //对于用户触发时才调用的接口，则可以直接调用，不需要放在ready函数中。
});
```

步骤五：通过error接口处理失败验证

```javascript
wx.error(function(res){
    //config信息验证失败会执行error函数，如签名过期导致验证失败，具体错误信息可以打开config的debug模式查看，
    //也可以在返回的res参数中查看，对于SPA可以在这里更新签名。
});
```

接口调用说明
------------

所有接口通过wx对象(也可使用jWeixin对象)来调用，参数是一个对象，除了每个接口本身需要传的参数之外，还有以下通用参数：
success：接口调用成功时执行的回调函数。
fail：接口调用失败时执行的回调函数。
complete：接口调用完成时执行的回调函数，无论成功或失败都会执行。
cancel：用户点击取消时的回调函数，仅部分有用户取消操作的api才会用到。
trigger: 监听Menu中的按钮点击时触发的方法，该方法仅支持Menu中的相关接口。
备注：不要尝试在trigger中使用ajax异步请求修改本次分享的内容，因为客户端分享操作是一个同步操作，这时候使用ajax的回包会还没有返回。

以上几个函数都带有一个参数，类型为对象，其中除了每个接口本身返回的数据之外，还有一个通用属性errMsg，其值格式如下：
调用成功时："xxx:ok" ，其中xxx为调用的接口名
用户取消时："xxx:cancel"，其中xxx为调用的接口名
调用失败时：其值为具体错误信息

基础接口
--------

判断当前客户端版本是否支持指定JS接口

```javascript
wx.checkJsApi({
    jsApiList: ['chooseImage'], // 需要检测的JS接口列表，所有JS接口列表见附录2,
    success: function(res) {
        //以键值对的形式返回，可用的api值true，不可用为false
        //如：{"checkResult":{"chooseImage":true},"errMsg":"checkJsApi:ok"}
    }
});
```
备注：checkJsApi接口是客户端6.0.2新引入的一个预留接口，第一期开放的接口均可不使用checkJsApi来检测。


分享接口
--------

请注意不要有诱导分享等违规行为，对于诱导分享行为将永久回收公众号接口权限，详细规则请查看：朋友圈管理常见问题 。

获取“分享到朋友圈”按钮点击状态及自定义分享内容接口

```javascript
wx.onMenuShareTimeline({
    title: '', // 分享标题
    link: '', // 分享链接
    imgUrl: '', // 分享图标
    success: function () { 
        // 用户确认分享后执行的回调函数
    },
    cancel: function () { 
        // 用户取消分享后执行的回调函数
    }
});
```

获取“分享给朋友”按钮点击状态及自定义分享内容接口

```javascript
wx.onMenuShareAppMessage({
    title: '', // 分享标题
    desc: '', // 分享描述
    link: '', // 分享链接
    imgUrl: '', // 分享图标
    type: '', // 分享类型,music、video或link，不填默认为link
    dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
    success: function () { 
        // 用户确认分享后执行的回调函数
    },
    cancel: function () { 
        // 用户取消分享后执行的回调函数
    }
});
```

获取“分享到QQ”按钮点击状态及自定义分享内容接口

```javascript
wx.onMenuShareQQ({
    title: '', // 分享标题
    desc: '', // 分享描述
    link: '', // 分享链接
    imgUrl: '', // 分享图标
    success: function () { 
       // 用户确认分享后执行的回调函数
    },
    cancel: function () { 
       // 用户取消分享后执行的回调函数
    }
});
```

获取“分享到腾讯微博”按钮点击状态及自定义分享内容接口

```javascript
wx.onMenuShareWeibo({
    title: '', // 分享标题
    desc: '', // 分享描述
    link: '', // 分享链接
    imgUrl: '', // 分享图标
    success: function () { 
       // 用户确认分享后执行的回调函数
    },
    cancel: function () { 
        // 用户取消分享后执行的回调函数
    }
});
```

获取“分享到QQ空间”按钮点击状态及自定义分享内容接口

```javascript
wx.onMenuShareQZone({
    title: '', // 分享标题
    desc: '', // 分享描述
    link: '', // 分享链接
    imgUrl: '', // 分享图标
    success: function () { 
       // 用户确认分享后执行的回调函数
    },
    cancel: function () { 
        // 用户取消分享后执行的回调函数
    }
});
```


图像接口
--------

音频接口
--------

智能接口
--------

设备信息
--------

地理位置
--------

摇一摇周边
---------

界面操作
--------

微信扫一扫
----------

微信小店
---------

微信卡券
-------

微信支付
--------

附录1-JS-SDK使用权限签名算法
---------------------------
【jsapi_ticket】
生成签名之前必须先了解一下jsapi_ticket，jsapi_ticket是公众号用于调用微信JS接口的临时票据。正常情况下，jsapi_ticket的有效期为7200秒，通过access_token来获取。由于获取jsapi_ticket的api调用次数非常有限，频繁刷新jsapi_ticket会导致api调用受限，影响自身业务，开发者必须在自己的服务全局缓存jsapi_ticket 。

参考[文档](http://mp.weixin.qq.com/wiki/15/54ce45d8d30b6bf6758f68d2e95bc627.html)获取access_token（有效期7200秒，开发者必须在自己的服务全局缓存access_token）。
用第一步拿到的access_token 采用httpGET方式请求获得jsapi_ticket（有效期7200秒，开发者必须在自己的服务全局缓存jsapi_ticket）：
[link](https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=ACCESS_TOKEN&type=jsapi)

成功返回如下JSON：
```javascript
{
"errcode":0,
"errmsg":"ok",
"ticket":"bxLdikRXVbTPdHSM05e5u5sUoXNKd8-41ZO3MhKoyN5OfkWITDGgnr2fwJ0m9E8NYzWKVZvdVtaUgWvsdshFKA",
"expires_in":7200
}
```

获得jsapi_ticket之后，就可以生成JS-SDK权限验证的签名了。
【签名算法】
签名生成规则如下：参与签名的字段包括noncestr（随机字符串）, 有效的jsapi_ticket, timestamp（时间戳）, url（当前网页的URL，不包含#及其后面部分）。对所有待签名参数按照字段名的ASCII 码从小到大排序（字典序）后，使用URL键值对的格式（即key1=value1&key2=value2…）拼接成字符串string1。这里需要注意的是所有参数名均为小写字符。对string1作sha1加密，字段名和字段值都采用原始值，不进行URL 转义。

即signature=sha1(string1)。 示例：

```javascript
noncestr=Wm3WZYTPz0wzccnW
jsapi_ticket=sM4AOVdWfPE4DxkXGEs8VMCPGGVi4C3VM0P37wVUCFvkVAy_90u5h9nbSlYy3-Sl-HhTdfl2fzFy1AOcHKP7qg
timestamp=1414587457
url=http://mp.weixin.qq.com?params=value
```

步骤1. 对所有待签名参数按照字段名的ASCII 码从小到大排序（字典序）后，使用URL键值对的格式（即key1=value1&key2=value2…）拼接成字符串string1：jsapi_ticket=sM4AOVdWfPE4DxkXGEs8VMCPGGVi4C3VM0P37wVUCFvkVAy_90u5h9nbSlYy3-Sl-HhTdfl2fzFy1AOcHKP7qg&noncestr=Wm3WZYTPz0wzccnW&timestamp=1414587457&url=http://mp.weixin.qq.com?params=value

步骤2. 对string1进行sha1签名，得到signature：0f9de62fce790f9a083d5c99e95740ceb90c27ed

【注意事项】

签名用的noncestr和timestamp必须与wx.config中的nonceStr和timestamp相同。
签名用的url必须是调用JS接口页面的完整URL。
出于安全考虑，开发者必须在服务器端实现签名的逻辑。
如出现invalid signature 等错误详见附录5常见错误及解决办法。

附录2-所有JS接口列表
-------------------
【版本1.0.0接口】

* onMenuShareTimeline
* onMenuShareAppMessage
* onMenuShareQQ
* onMenuShareWeibo
* onMenuShareQZone
* startRecord
* stopRecord
* onVoiceRecordEnd
* playVoice
* pauseVoice
* stopVoice
* onVoicePlayEnd
* uploadVoice
* downloadVoice
* chooseImage
* previewImage
* uploadImage
* downloadImage
* translateVoice
* getNetworkType
* openLocation
* getLocation
* hideOptionMenu
* showOptionMenu
* hideMenuItems
* showMenuItems
* hideAllNonBaseMenuItem
* showAllNonBaseMenuItem
* closeWindow
* scanQRCode
* chooseWXPay
* openProductSpecificView
* addCard
* chooseCard
* openCard

附录3-所有菜单项列表
--------------------

附录4-卡券扩展字段及签名生成算法
--------------------------------

附录5-常见错误及解决方法
------------------------

调用config 接口的时候传入参数 debug: true 可以开启debug模式，页面会alert出错误信息。以下为常见错误及解决方法：

【invalid url domain】当前页面所在域名与使用的appid没有绑定，请确认正确填写绑定的域名，如果使用了端口号，则配置的绑定域名也要加上端口号（一个appid可以绑定三个有效域名。

【invalid signature】签名错误。建议按如下顺序检查：

1.确认签名算法正确，可用 http://mp.weixin.qq.com/debug/cgi-bin/sandbox?t=jsapisign 页面工具进行校验。
2.确认config中nonceStr（js中驼峰标准大写S）, timestamp与用以签名中的对应noncestr, timestamp一致。
3.确认url是页面完整的url(请在当前页面alert(location.href.split('#')[0])确认)，包括'http(s)://'部分，以及'？'后面的GET参数部分,但不包括'#'hash后面的部分。
4.确认config中的appid与用来获取jsapi_ticket的appid一致。
5.确保一定缓存access_token和jsapi_ticket。
6.确保你获取用来签名的url是动态获取的，动态页面可参见实例代码中php的实现方式。如果是html的静态页面在前端通过ajax将url传到后台签名，前端需要用js获取当前页面除去'#'hash部分的链接（可用location.href.split('#')[0]获取,而且需要encodeURIComponent），因为页面一旦分享，微信客户端会在你的链接末尾加入其它参数，如果不是动态获取当前链接，将导致分享后的页面签名失败。

【the permission value is offline verifying】这个错误是因为config没有正确执行，或者是调用的JSAPI没有传入config的jsApiList参数中。建议按如下顺序检查：
1.确认config正确通过。
2.如果是在页面加载好时就调用了JSAPI，则必须写在wx.ready的回调中。
3.确认config的jsApiList参数包含了这个JSAPI。

【permission denied】该公众号没有权限使用这个JSAPI，或者是调用的JSAPI没有传入config的jsApiList参数中（部分接口需要认证之后才能使用）。

【function not exist】当前客户端版本不支持该接口，请升级到新版体验。

【为什么6.0.1版本config:ok，但是6.0.2版本之后不ok】（因为6.0.2版本之前没有做权限验证，所以config都是ok，但这并不意味着你config中的签名是OK的，请在6.0.2检验是否生成正确的签名以保证config在高版本中也ok。）
【在iOS和Android都无法分享】（请确认公众号已经认证，只有认证的公众号才具有分享相关接口权限，如果确实已经认证，则要检查监听接口是否在wx.ready回调函数中触发）
【服务上线之后无法获取jsapi_ticket，自己测试时没问题。】（因为access_token和jsapi_ticket必须要在自己的服务器缓存，否则上线后会触发频率限制。请确保一定对token和ticket做缓存以减少2次服务器请求，不仅可以避免触发频率限制，还加快你们自己的服务速度。目前为了方便测试提供了1w的获取量，超过阀值后，服务将不再可用，请确保在服务上线前一定全局缓存access_token和jsapi_ticket，两者有效期均为7200秒，否则一旦上线触发频率限制，服务将不再可用）。
【uploadImage怎么传多图】（目前只支持一次上传一张，多张图片需等前一张图片上传之后再调用该接口）
【没法对本地选择的图片进行预览（chooseImage接口本身就支持预览，不需要额外支持）】
【通过a链接(例如先通过微信授权登录)跳转到b链接，invalidsignature签名失败】（后台生成签名的链接为使用jssdk的当前链接，也就是跳转后的b链接，请不要用微信登录的授权链接进行签名计算，后台签名的url一定是使用jssdk的当前页面的完整url除去'#'部分）
【出现config:fail错误】（这是由于传入的config参数不全导致，请确保传入正确的appId、timestamp、nonceStr、signature和需要使用的jsApiList）
如何把jsapi上传到微信的多媒体资源下载到自己的服务器（请参见文档中uploadVoice和uploadImage接口的备注说明）
【Android通过jssdk上传到微信服务器，第三方再从微信下载到自己的服务器，会出现杂音（微信团队已经修复此问题，目前后台已优化上线）】
【绑定父级域名，是否其子域名也是可用的】（是的，合法的子域名在绑定父域名之后是完全支持的）
【在iOS微信6.1版本中，分享的图片外链不显示，只能显示公众号页面内链的图片或者微信服务器的图片，已在6.2中修复】
【是否需要对低版本自己做兼容】（jssdk都是兼容低版本的，不需要第三方自己额外做更多工作，但有的接口是6.0.2新引入的，只有新版才可调用）
【该公众号支付签名无效，无法发起该笔交易】（请确保你使用的jweixin.js是官方线上版本，不仅可以减少用户流量，还有可能对某些bug进行修复，拷贝到第三方服务器中使用，官方将不对其出现的任何问题提供保障，具体支付签名算法可参考 JSSDK微信支付一栏）
【目前Android微信客户端不支持pushState的H5新特性，所以使用pushState来实现web app的页面会导致签名失败，此问题已在Android6.2中修复】
uploadImage在chooseImage的回调中有时候Android会不执行，Android6.2会解决此问题，若需支持低版本可以把调用uploadImage放在setTimeout中延迟100ms解决
require subscribe错误说明你没有订阅该测试号，该错误仅测试号会出现
getLocation返回的坐标在openLocation有偏差，因为getLocation返回的是gps坐标，openLocation打开的腾讯地图为火星坐标，需要第三方自己做转换，6.2版本开始已经支持直接获取火星坐标
查看公众号（未添加）: "menuItem:addContact"不显示，目前仅有从公众号传播出去的链接才能显示，来源必须是公众号
ICP备案数据同步有一天延迟，所以请在第二日绑定

附录6-DEMO页面和示例代码
------------------------

附录7-问题反馈
---------------

邮箱地址：weixin-open@qq.com
邮件主题：【微信JS-SDK反馈】
邮件内容说明：用简明的语言描述问题所在，并交代清楚遇到该问题的场景，可附上截屏图片，微信团队会尽快处理你的反馈。
