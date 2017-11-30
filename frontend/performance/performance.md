https://developers.google.com/web/fundamentals/performance/


##关键渲染路径 Critical Rendering Path

https://developers.google.com/web/fundamentals/performance/critical-rendering-path/

优化关键渲染路径 是指优先显示与当前用户操作有关的内容。

要提供快速的网络体验，浏览器需要做许多工作。这类工作大多数是我们这些网络开发者看不到的：我们编写标记，屏幕上就会显示出漂亮的页面。但浏览器到底是如何使用我们的 HTML、CSS 和 JavaScript 在屏幕上渲染像素的呢？

从收到 HTML、CSS 和 JavaScript 字节到对其进行必需的处理，从而将它们转变成渲染的像素这一过程中有一些中间步骤，优化性能其实就是了解这些步骤中发生了什么 - 即关键渲染路径。

###构建对象模型

https://developers.google.com/web/fundamentals/performance/critical-rendering-path/constructing-the-object-model

浏览器渲染页面前需要先构建 DOM 和 CSSOM 树。因此，我们需要确保尽快将 HTML 和 CSS 都提供给浏览器。

TL;DR

字节 → 字符 → 令牌 → 节点 → 对象模型。
HTML 标记转换成文档对象模型 (DOM)；CSS 标记转换成 CSS 对象模型 (CSSOM)。
DOM 和 CSSOM 是独立的数据结构。
Chrome DevTools Timeline 让我们可以捕获和检查 DOM 和 CSSOM 的构建和处理开销。

###渲染树构建、布局及绘制

https://developers.google.com/web/fundamentals/performance/critical-rendering-path/render-tree-construction

CSSOM 树和 DOM 树合并成渲染树，然后用于计算每个可见元素的布局，并输出给绘制流程，将像素渲染到屏幕上。优化上述每一个步骤对实现最佳渲染性能至关重要。

在前面介绍构建对象模型的章节中，我们根据 HTML 和 CSS 输入构建了 DOM 树和 CSSOM 树。 不过，它们都是独立的对象，分别网罗文档不同方面的信息：一个描述内容，另一个则是描述需要对文档应用的样式规则。我们该如何将两者合并，让浏览器在屏幕上渲染像素呢？

TL;DR

DOM 树与 CSSOM 树合并后形成渲染树。
渲染树只包含渲染网页所需的节点。
布局计算每个对象的精确位置和大小。
最后一步是绘制，使用最终渲染树将像素渲染到屏幕上。

下面简要概述了浏览器完成的步骤：

处理 HTML 标记并构建 DOM 树。
处理 CSS 标记并构建 CSSOM 树。
将 DOM 与 CSSOM 合并成一个渲染树。
根据渲染树来布局，以计算每个节点的几何信息。
将各个节点绘制到屏幕上。
我们的演示网页看起来可能很简单，实际上却需要完成相当多的工作。如果 DOM 或 CSSOM 被修改，您只能再执行一遍以上所有步骤，以确定哪些像素需要在屏幕上进行重新渲染。

_优化关键渲染路径_就是指最大限度缩短执行上述第 1 步至第 5 步耗费的总时间。 这样一来，就能尽快将内容渲染到屏幕上，此外还能缩短首次渲染后屏幕刷新的时间，即为交互式内容实现更高的刷新率。

###阻塞渲染的CSS
https://developers.google.com/web/fundamentals/performance/critical-rendering-path/render-blocking-css


默认情况下，CSS 被视为阻塞渲染的资源，这意味着浏览器将不会渲染任何已处理的内容，直至 CSSOM 构建完毕。请务必精简您的 CSS，尽快提供它，并利用媒体类型和查询来解除对渲染的阻塞。

在渲染树构建中，我们看到关键渲染路径要求我们同时具有 DOM 和 CSSOM 才能构建渲染树。这会给性能造成严重影响：HTML 和 CSS 都是阻塞渲染的资源。 HTML 显然是必需的，因为如果没有 DOM，我们就没有可渲染的内容，但 CSS 的必要性可能就不太明显。如果我们在 CSS 不阻塞渲染的情况下尝试渲染一个普通网页会怎样？

TL;DR

默认情况下，CSS 被视为阻塞渲染的资源。
我们可以通过媒体类型和媒体查询将一些 CSS 资源标记为不阻塞渲染。
浏览器会下载所有 CSS 资源，无论阻塞还是不阻塞。

CSS 是阻塞渲染的资源。需要将它尽早、尽快地下载到客户端，以便缩短首次渲染的时间。

###使用 JavaScript 添加交互
https://developers.google.com/web/fundamentals/performance/critical-rendering-path/adding-interactivity-with-javascript

JavaScript 允许我们修改网页的方方面面：内容、样式以及它如何响应用户交互。 不过，JavaScript 也会阻止 DOM 构建和延缓网页渲染。 为了实现最佳性能，可以让您的 JavaScript 异步执行，并去除关键渲染路径中任何不必要的 JavaScript。

TL;DR

JavaScript 可以查询和修改 DOM 与 CSSOM。
JavaScript 执行会阻止 CSSOM。
除非将 JavaScript 显式声明为异步，否则它会阻止构建 DOM。

简言之，JavaScript 在 DOM、CSSOM 和 JavaScript 执行之间引入了大量新的依赖关系，从而可能导致浏览器在处理以及在屏幕上渲染网页时出现大幅延迟：

脚本在文档中的位置很重要。
当浏览器遇到一个 script 标记时，DOM 构建将暂停，直至脚本完成执行。
JavaScript 可以查询和修改 DOM 与 CSSOM。
JavaScript 执行将暂停，直至 CSSOM 就绪。
“优化关键渲染路径”在很大程度上是指了解和优化 HTML、CSS 和 JavaScript 之间的依赖关系谱。

向 script 标记添加异步关键字可以指示浏览器在等待脚本可用期间不阻止 DOM 构建，这样可以显著提升性能。


###评估关键渲染路径
https://developers.google.com/web/fundamentals/performance/critical-rendering-path/measure-crp

作为每个可靠性能策略的基础，准确的评估和检测必不可少。 无法评估就谈不上优化。本文说明了评估 CRP 性能的不同方法。

Lighthouse 方法会对页面运行一系列自动化测试，然后生成关于页面的 CRP 性能的报告。 这一方法对您的浏览器中加载的特定页面的 CRP 性能提供了快速且简单的高级概览，让您可以快速地测试、循环访问和提高其性能。
Navigation Timing API 方法会捕获真实用户监控 (RUM) 指标。如名称所示，这些指标捕获自真实用户与网站的互动，并为真实的 CRP 性能（您的用户在各种设备和网络状况下的体验）提供了准确的信息。
通常情况下，最好利用 Lighthouse 发现明显的 CRP 优化机会，然后使用 Navigation Timing API 设置您的代码，以便监控应用在实际使用过程中的性能。

###分析关键渲染路径性能
https://developers.google.com/web/fundamentals/performance/critical-rendering-path/analyzing-crp

###优化关键渲染路径
https://developers.google.com/web/fundamentals/performance/critical-rendering-path/optimizing-critical-rendering-path

###PageSpeed 规则和建议



前端性能优化
==========

加载优化
-------

1.合并css，javascript
2.合并小图片，使用雪碧图
3.缓存一切可缓存的资源
4.使用长cache
5.使用外联式引用css、javascript
6.压缩html、css、javascript
7.启用gzip
8.使用首屏加载
9.使用按需加载
10.使用滚屏加载
11.使用Media Query加载
12.使用loading进度条
13.减少cookie
14.避免重定向
15.异步加载第三方资源

图片优化
------

1.使用图片压缩集成工具，例如[智图](http://zhitu.isux.us/)
2.使用css3、svg、iconfont代替图片
3.使用[srcset](http://caniuse.com/#search=Srcset%20attribute)(ios>8,android>5)
4.webp优于jpg

脚本优化
------

css优化
------

渲染优化
-------


引摘
-----

[ISUX移动H5前端性能优化](https://isux.tencent.com/h5-performance.html)