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
