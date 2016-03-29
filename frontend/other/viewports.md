http://www.w3cplus.com/css/viewports.html  译文  
http://www.quirksmode.org/about/   作者
http://www.quirksmode.org/mobile/viewports.html  原文1
http://www.quirksmode.org/mobile/viewports2.html 原文2

在这个迷你系列的文章里，我将解释viewports和多种重要的HTML标签元素的宽度是如何工作的，例如<html>标签。同样也会解释window和screen的宽度问题。

第一部分主要关于桌面（pc）浏览器，基本目的在于为移动端（mobile）浏览器上，本话题的讨论创建舞台。
绝大多数web开发人员已经对pc的概念有了直观的认识。
mobile拥有相同的概念，但是更加复杂。如你所知，一个友好的预热将极大的帮助你理解mobile浏览器。

【概念：设备的pixels和CSS的pixels】

首先你应当理解CSS的pixels，以及它和设备的pixels的区别。

我们姑且认定设备的pixels为正确（标准）的pixels宽度。
这些pixels决定了你工作所用的那些设备上正式的分辨率。
在大多数情况下，能够从screen.width/height上取出具体值。

如果用户缩放（zoom）了浏览器，当然必须改变计算方式。
例如用户缩放了200%，上诉显示器只能横排容纳4个上诉元素了。

现代浏览器上的缩放，是基于“伸展”pixels。结果是，html元素上的宽度并没有因为缩放200%而由128pix变成256px，而是真实的pixels的被计算成了双倍。html元素在形式上依然是128CSS的pixels，即便它占用了256设备的pixels 。

换言之，缩放200%将一个单位的CSS的pixels变成了4倍的设备的pixels那么大，即宽度 * 2、高度 * 2，面积扩大了2 * 2.

下列图片将清楚的解释这个概念。如图1-1.有4个1像素，缩放为100%的html元素，CSS的pixels完整的和设备的pixels重叠
[]()
当我们缩小浏览器时，CSS的pixels开始收缩，导致1单位的设备的pixels上重叠了多个CSS的pixels，如图1-2
[]()
同理，放大浏览器时，相反的事情发生了，CSS的pixels开始扩大，导致1单位的CSS的pixels上重叠了多个设备的pixels，如图1-3
[]()

总体而言，你只需要关注CSS的pixels，这些pixels指定你的样式被如何渲染。

设备的pixels几乎对你毫无用处。但对用户而言却不是这样。用户会缩放页面，直到他能舒服的阅读内容。但是你不需关心这些缩放级别。浏览器会自动的保证你的CSS的pixels会被伸展还是收缩。

【100% 缩放】
本例设定缩放级别为100%。现在我们更严谨的定义，如下：

    在缩放级别为100%时，1单位的CSS的pixel是严格相等于1单位的设备pixel

100%缩放的概念非常有利于表述接下来的内容，但你不必在日常工作中过度担忧这个问题。在桌面系统上，你通常会在100%缩放级别下测试你的网站，但即便用户缩放，CSS的pixels的魔法依然能保证你网站外观保存相同的比例。

【屏幕尺寸 Screen size】

screen.width/height

* 含义：用户的屏幕的完整大小。
* 度量：设备的pixels。
* 兼容性问题：IE8里，不管使用IE7模式还是IE8模式，都以CSS的pixels来度量

我们先了解一些特殊的尺寸：screen.width 和 screen.height。
这两个属性包含了用户屏幕的完整宽度高度。这些尺寸使用设备的pixels来定义，他们的值不会因为缩放而改变：他们是显示器的特征，而不是浏览器。如图1-4所示。
[]()
很有趣吧？但是我们拿来何用呢？
简单的说，木有用！用户的显示器宽度对我们而言不重要 – 除非你想要用他们做网络统计数据.

【浏览器尺寸 Window size】

window.innerWidth/Height

* 含义：包含滚动条尺寸的浏览器完整尺寸
* 度量：CSS的pixels
* 兼容性问题：IE不支持，Opera用设备pixels来度量

相反的，你想要知道的浏览器的内部尺寸。它定义了当前用户有多大区域，可供你的CSS布局占用。你可以通过window.innerWidth 和 window.innerHeight来获取。如图1-5
[]()
显然，窗口的内部宽度使用CSS的pixels.你需要知道多少你自己定义的元素能塞入浏览器窗口，而这些数量会随着用户放大浏览器而减少（如图1-6）。所以当用户放大显示时，你能获取的浏览器窗口可用空间会减少，window.innerWidth/Height就是缩小的比例。

  







