
【手机淘宝】

【使用Flexible实现手淘H5页面的终端适配】

[原文地址](http://www.w3cplus.com/mobile/lib-flexible-for-html5-layout.html)

曾几何时为了兼容IE低版本浏览器而头痛，以为到Mobile时代可以跟这些麻烦说拜拜。可没想到到了移动时代，为了处理各终端的适配而乱了手脚。对于混迹各社区的偶，时常发现大家拿手机淘宝的H5页面做讨论——手淘的H5页面是如何实现多终端的适配？

那么趁此Amfe阿里无线前端团队双11技术连载之际，用一个实战案例来告诉大家，手淘的H5页面是如何实现多终端适配的，希望这篇文章对大家在Mobile的世界中能过得更轻松。

痛点：虽然H5的页面与PC的Web页面相比简单了不少，但让我们头痛的事情是要想尽办法让页面能适配众多不同的终端设备。
[查看终端设备参数](https://design.google.com/devices/)这是多么痛苦的一件事情。

http://www.paintcodeapp.com/news/ultimate-guide-to-iphone-resolutions

手淘设计师和前端开发的适配协作基本思路是：
* 选择一种尺寸作为设计和开发基准
* 定义一套适配规则，自动适配剩下的两种尺寸(其实不仅这两种，你懂的)
* 特殊适配效果给出设计效果

手淘设计师常选择iPhone6作为基准设计尺寸，交付给前端的设计尺寸是按750px *1334px为准(高度会随着内容多少而改变)。
前端开发人员通过一套适配规则自动适配到其他的尺寸。

拿到设计师给的设计图之后，剩下的事情是前端开发人员的事了。而手淘经过多年的摸索和实战，总结了一套移动端适配的方案——[flexible方案](https://github.com/amfe/lib-flexible)。


这种方案具体在实际开发中如何使用，暂时先卖个关子，在继续详细的开发实施之前，我们要先了解一些基本概念。

一些基本概念

在进行具体实战之前，首先得了解下面这些基本概念(术语)：

视窗 viewport

简单的理解，viewport是严格等于浏览器的窗口。在桌面浏览器中，viewport就是浏览器窗口的宽度高度。但在移动端设备上就有点复杂。

移动端的viewport太窄，为了能更好为CSS布局服务，所以提供了两个viewport:虚拟的viewportvisualviewport和布局的viewportlayoutviewport。

George Cummins在Stack Overflow上对这两个基本概念做了详细的解释。

而事实上viewport是一个很复杂的知识点，上面的简单描述可能无法帮助你更好的理解viewport，而你又想对此做更深的了解，可以阅读PPK写的相关教程。

物理像素(physical pixel)

物理像素又被称为设备像素，他是显示设备中一个最微小的物理部件。每个像素可以根据操作系统设置自己的颜色和亮度。正是这些设备像素的微小距离欺骗了我们肉眼看到的图像效果。

设备独立像素(density-independent pixel)

设备独立像素也称为密度无关像素，可以认为是计算机坐标系统中的一个点，这个点代表一个可以由程序使用的虚拟像素(比如说CSS像素)，然后由相关系统转换为物理像素。

CSS像素

CSS像素是一个抽像的单位，主要使用在浏览器上，用来精确度量Web页面上的内容。一般情况之下，CSS像素称为与设备无关的像素(device-independent pixel)，简称DIPs。

屏幕密度

屏幕密度是指一个设备表面上存在的像素数量，它通常以每英寸有多少像素来计算(PPI)。

设备像素比(device pixel ratio)

设备像素比简称为dpr，其定义了物理像素和设备独立像素的对应关系。它的值可以按下面的公式计算得到：

设备像素比 ＝ 物理像素 / 设备独立像素

在JavaScript中，可以通过window.devicePixelRatio获取到当前设备的dpr。而在CSS中，可以通过-webkit-device-pixel-ratio，-webkit-min-device-pixel-ratio和 -webkit-max-device-pixel-ratio进行媒体查询，对不同dpr的设备，做一些样式适配(这里只针对webkit内核的浏览器和webview)。

dip或dp,（device independent pixels，设备独立像素）与屏幕密度有关。dip可以用来辅助区分视网膜设备还是非视网膜设备。
