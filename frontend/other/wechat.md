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

附录2-所有JS接口列表
-------------------

附录3-所有菜单项列表
--------------------

附录4-卡券扩展字段及签名生成算法
--------------------------------

附录5-常见错误及解决方法
------------------------

附录6-DEMO页面和示例代码
------------------------

附录7-问题反馈
---------------

邮箱地址：weixin-open@qq.com
邮件主题：【微信JS-SDK反馈】
邮件内容说明：用简明的语言描述问题所在，并交代清楚遇到该问题的场景，可附上截屏图片，微信团队会尽快处理你的反馈。
