
前言
---

[官方新版文档地址](https://developers.google.com/web/tools/chrome-devtools/)

[官方旧版文档地址](https://developer.chrome.com/devtools)

Web开发和调试工具，可用来对网站进行迭代、调试和分析。

Dogfood: 寻找最新版本的Chrome开发者工具, [Chrome Canary](https://www.google.com/intl/en/chrome/browser/canary.html)总是有最新的DevTools.建议参考更新的英文版本文档来使用。


术语
---

⌘（command）、⌥（option）、⇧（shift）、⇪（caps lock）

TL;DR “Too Long; Don’t Read”的缩写
根据字典解释，“TL;DR”发源自网络。一般用于回复别人写得太多，反而让人抓不住重点，现在有的人把它放在一段话的开头，代表“长话短说”的意思——如今不少服务都直接以“TL;DR”为命名，把网络上一篇很长的报道，缩短成简单的三两句话，让人快速抓住文章的精华。

Device Mode 设备模式
lantency  延迟
geolocation 地理定位
accelerometer 加速度计
emulate sensors 模拟传感器

Elements Panel 元素面板
Ancestors 祖先
Framework listeners 框架侦听器

Console Panel 控制台面板

Sources Panel 源代码面板

Deactivate 停用

anonymous function 匿名函数

deprecated 过时的

开启
---

在Chrome菜单中选择 更多工具 > 开发者工具
在页面元素上右键点击，选择 “检查”
使用 [快捷键](https://developers.google.com/web/tools/chrome-devtools/shortcuts) Ctrl+Shift+I (Windows) 或 Cmd+Opt+I (Mac)

设备模式
-------

使用设备模式构建完全响应式，移动优先的网络体验。

可以通过按 Command+Shift+M (Mac) 或 Ctrl+Shift+M（Windows、Linux）来切换 Device Mode。要使用此快捷键，鼠标焦点需要位于 DevTools 窗口中。如果焦点位于视口中，您将触发 Chrome 的切换用户快捷键。

警告：Device Mode可以让您了解您的网站在移动设备上的大致显示效果，但要获得全面的了解，则应始终在真实设备上测试您的网站。DevTools无法模拟移动设备的性能特性。

在[不同的屏幕尺寸和分辨率](https://developers.google.com/web/tools/chrome-devtools/device-mode/emulate-mobile-viewports)（包括Retina显示屏）下模拟您的网站。

通过可视化和[检查CSS媒体查询](https://developers.google.com/web/tools/chrome-devtools/device-mode/emulate-mobile-viewports)进行自适应设计。

使用[网络模拟器](https://developers.google.com/web/tools/chrome-devtools/network-performance/network-conditions)在不影响其他标签流量的情况下模拟您网站的性能。

针对触摸事件、地理定位和设备方向准确[模拟设备输入](https://developers.google.com/web/tools/chrome-devtools/device-mode/device-input-and-sensors)


元素面板
------

Elements Panel 使用元素面板可以自由的操作DOM和CSS来迭代布局和设计页面.

**实时编辑DOM节点**

[详细编辑DOM](https://developers.google.com/web/tools/chrome-devtools/inspect-styles/edit-dom)

要实时编辑 DOM 节点，只需双击选定元素，然后进行更改。
DOM 树视图会显示树的当前状态；可能会与最初因其他原因加载的 HTML 不匹配。 例如，您可以使用 JavaScript 修改 DOM 树；浏览器引擎会尝试修正无效的作者标记并生成意外的 DOM。

在控制台中使用inspect方法，例如inspect(document.body)。


**实时编辑样式**

[详细编辑样式](https://developers.google.com/web/tools/chrome-devtools/inspect-styles/edit-styles)

在Styles窗格中实时编辑样式属性名称和值。所有样式均可修改，除了灰色部分（与用户代理样式表一样）。
要编辑名称或值，请点击它，进行更改，然后按Tab或Enter保存更改。
默认情况下，您的CSS修改不是永久的，重新加载页面时更改会丢失。 如果您想要在页面加载时保留更改，请设置[永久制作](https://developers.google.com/web/tools/setup/setup-workflow)。

**检查和编辑框模型参数**

使用 Computed 窗格检查和编辑当前元素的框模型参数。 框模型中的所有值均可修改，只需点击它们即可。

同轴矩形包含当前元素 padding、border 和 margin 属性的 top、bottom、left、right 值。
对于位置为非静态的元素，还会显示 position 矩形，包含 top、right、bottom 和 left 属性的值。

对于 position: fixed 和 position: absolute 元素，中心域包含选定元素实际的 offsetWidth × offsetHeight 像素尺寸。所有值都可以通过双击修改，就像 Styles 窗格中的属性值一样。 不过，无法保证这些更改能够生效，因为这要取决于具体的元素定位详情。

**查看本地更改**

要查看对页面所做实时编辑的历史记录，请执行以下操作：

1. Styles窗格中，点击您修改的文件。DevTools会将您带到Sources面板。
2. 右键点击文件。
3. 选择Local modifications。

要探索所做的更改，请执行以下操作：

* 展开顶级文件名查看做出修改的时间。
* 展开第二级项目查看修改相应的不同（前和后）。

粉色背景的线表示移除，绿色背景的线表示添加。

**撤消更改**

如果您未设置永久制作，每次您重新加载页面时，所有的实时编辑都会丢失。

假设您已设置了永久制作，要撤消更改，请执行以下操作：

* 使用 Ctrl+Z (Windows) 或 Cmd+Z (Mac) 通过 Elements 面板快速撤消对 DOM 或样式所做的细微更改。
* 要撤消对文件所做的所有本地修改，请打开 Sources 面板，然后选择文件名旁的 revert。

**TODO多发场景**

快捷键Ctrl+F(Mac:CMD+F)，在搜索栏输入ID选择符或者类选择符就可以定位到元素啦

选择一个DOM元素，按下Alt键并且鼠标双击选择DOM元素前面的箭头，展开该DOM元素下的所有字节点元素。

右键选中想要监听的DOM节点弹出菜单，鼠标停在Break on...，会出现三个子菜单：
1. Subtree modifications，在该DOM结点及其子结点的结构有变动时中断。
2. Attributes modifications，在该DOM结点（不包括其子结点）的属性有所变化时中断，可以用在找出某个属性或者class是由哪段代码添加或修改的，尤其是在修改JS插件时非常省事；
3. node removal，在该DOM结点被移除出DOM树时中断。

一个DOM节点最终的CSS可能会被很多段CSS代码所影响，例如在Elements-Styles里就列出了所有对目标DOM节点有影响的CSS代码：可是这样一个一个来看，实在是很烦，那chrome有没有能总结出最终CSS的功能呢？chrome也是有的，藏在Elements-Computed里了，由于不是默认展开的面板，所以一直没能引起注意。关于这个功能，有个比较常用的场景，那就是查看一段文字的字体。

控制台面板
--------

[详细介绍](https://developers.google.com/web/tools/chrome-devtools/console/)

Console Panel 在开发期间，可以使用控制台面板记录诊断信息，或者使用它作为 shell在页面上与JavaScript交互。

了解如何：打开DevTools控制台；堆叠冗余消息或将其显示在各自的行上；清除或保留输出，或者将其保存到文件中；过滤输出，以及访问其他控制台设置。

**TL;DR**

* 以专用面板或任何其他面板旁的抽屉式导航栏的形式打开控制台。
* 堆叠冗余消息，或者将其显示在各自的行上。
* 清除或保留页面之间的输出，或者将其保存到文件中。
* 按严重性等级、通过隐藏网络消息或者按正则表达式模式对输出进行过滤。

**消息堆叠**

如果一条消息连续重复，而不是在新行上输出每一个消息实例，控制台将“堆叠”消息并在左侧外边距显示一个数字。此数字表示该消息已重复的次数。如果您倾向于为每一个日志使用一个独特的行条目，请在 DevTools 的console设置中启用Show timestamps。
由于每一条消息的时间戳均不同，因此，每一条消息都将显示在各自的行上。

**清除历史记录**

您可以通过以下方式清除控制台历史记录：

* 在控制台中点击右键，然后按Clear console。
* 在控制台中键入clear()。
* 从您的JavaScript代码内调用console.clear()。
* 按Ctrl+L （Windows、Linux）⌘+K（Mac）

**保留历史记录**

启用控制台顶部的 Preserve log 复选框可以在页面刷新或更改之间保留控制台历史记录。 消息将一直存储，直至您清除控制台或者关闭标签。

**保存历史记录**

在控制台中点击右键，然后选择 Save as，将控制台的输出保存到日志文件中。

**设置说明**

Hide network messages默认情况下，控制台将报告网络问题。启用此设置将指示控制台不显示这些错误的日志。例如，将不会记录 404 和 500 系列错误。

Log XMLHttpRequests 确定控制台是否记录每一个 XMLHttpRequest。

Preserve log upon navigation 在页面刷新或导航时保留控制台历史记录。

Show timestamps在调用时向显示的每条控制台消息追加一个时间戳。对于发生特定事件时的调试非常实用。这会停用消息堆叠。

Enable custom formatters  控制JavaScript对象的[格式设置](https://docs.google.com/document/d/1FTascZXT9cxfetuPRT2eXPQKXui4nWFivUnS_335T3U/preview)。



源代码面板
--------

Sources Panel 在源代码面板中设置断点来调试 JavaScript ，或者通过Workspaces（工作区）连接本地文件来使用开发者工具的实时编辑器。

**断点调试**

[如何设置断点](https://developers.google.com/web/tools/chrome-devtools/javascript/add-breakpoints)

[如何逐步调试代码](https://developers.google.com/web/tools/chrome-devtools/javascript/step-code)

[使用 DevTools 的工作区设置持久化](https://developers.google.com/web/tools/setup/setup-workflow)

Resume 继续执行直到下一个断点。如果没有遇到断点，则继续正常执行。

LongResume继续执行，将断点停用500毫秒。便于暂时跳过断点，否则会持续暂停执行代码，例如，循环内的断点。点击并按住 Resume，直到展开以显示操作。

Step Over 不管下一行发生什么都会执行，并跳转到下一行。

Step Into 如果下一行包含一个函数调用，Step Into 将跳转并在其第一行暂停该函数。

Step Out 函数调用后，执行当前函数剩余部分，然后在下一个语句暂停。

Deactivate breakpoints暂时停用所有断点。
用于继续完整执行，不会真正移除断点。再次点击以重新激活断点。

Pause on exceptions Pause on exceptions 在发生异常时，自动暂停执行代码。


调试混淆的代码
使用开发者工具的Workspaces（工作区）进行持久化保存

##Source面板

Ctrl+o 打开一个js文件
Ctrl+p 同ctrl+o
Ctrl+f 查找当前js文件中的关键字
Ctrl+shift+f 全局查找关键字
Ctrl+shift+e 在控制台运行当前选中的代码片段
快速定位到行，快捷键Ctrl+O (Mac:CMD+O)，输入:行号:列号来进行定位
Ctrl+O快捷键也意味着在打开调试工具后快速定位到Source面板

在Sources面板中选择一个资源文件进行编辑，如css文件，通过按住Ctrl键可以添加多个编辑光标，同时对多处进行编辑。按下Ctrl+U可以撤销编辑。

给代码添加断点的方法有两种，在代码中写debugger和在source面板中鼠标单击添加断点。两者的不同点在于：鼠标单击的方式会在代码行数改变的时候无法定位到之前的位置，但可以在调试的过程中删除断点；debugger的方式不会因为代码行数改变而定位不到，但必须要刷新代码才能把断点删掉。

###直接修改js进行调试

chrome开发者工具中一个比较常用的功能就是在Elements面板修改css直接看效果，殊不知，原来在Sources面板中，连js都可以直接修改。
原本我也感到很惊讶，js跟css的差别很大，js是执行完就完事了，哪像css一直都有效的呀，那这修改执行完的js又能有什么作用呢？在查阅相关资料后，发现这功能主要是在设置断点(breakpoint)进行单步调试时用的，步骤如下：1直接给某行js代码设置断点，2刷新页面后，程序就会停在断点设置的那一行上，3然后我们就可以在断点那一行代码的后面添加我们自己的debug代码了，4按下快捷键Ctrl+s保存，发现该面板变红了，即表示保存生效，此时利用快捷键F10，就能最终看到刚刚添加的debug代码的效果了。值得注意的是，由于单步调试只能往下走而不能回头，如果要重新测试的话就要刷新页面，但刷新页面会导致刚刚保存的调试代码消失，恢复到线上版本的代码。

###在单步调试过程中直接查看变量

在单步调试过程中，我们总免不了看看各个变量当前的值是什么，以此来判断问题是不是出现在当前这一行代码。查看变量值的方法还是有很多的，下面列举两种常用的：1通过Sources-Watch面板，在这里设置想要监控的变量，随着单步调试的进行，这些被监控的变量的值也会随之更新，2通过console打印变量，除了在代码里写console.log()外，其实是可以直接在单步调试的过程中直接用console来打印的，除了上述的这两种方法，还有更简单的方法：在单步调试的过程中，直接把鼠标移到想查看的变量，然后就会弹出个小框把变量的值给显示出来啦。

###Snippets（程序小片段）

Snippets提供了在chrome里保存及运行一段js代码的功能，我们可以简单地把snippet当做是笔记，用来搭配直接修改js进行调试（因为刷新后添加的代码就不见了）来记录下每次调试需要用到的代码；也可以用作写一些小demo来试函数、api等功能。


网络面板
------

Network Panel 使用网络面板了解请求和下载的资源文件并优化网页加载性能。

使用 Network 面板测量您的网站网络性能。

[测量资源加载时间](https://developers.google.com/web/tools/chrome-devtools/network-performance/resource-loading)

Network 面板记录页面上每个网络操作的相关信息，包括详细的耗时数据、HTTP 请求与响应标头和 Cookie，等等。

TL;DR

* 使用Network面板记录和分析网络活动。
* 整体或单独查看资源的加载信息。
* 过滤和排序资源的显示方式。
* 保存、复制和清除网络记录。
* 根据需求自定义Network面板。

**Network面板概览**

Network面板由五个窗格组成：

Controls。使用这些选项可以控制Network面板的外观和功能。
Filters。 使用这些选项可以控制在 Requests Table 中显示哪些资源。提示：按住 Cmd (Mac) 或 Ctrl (Windows/Linux) 并点击过滤器可以同时选择多个过滤器。
Overview。 此图表显示了资源检索时间的时间线。如果您看到多条竖线堆叠在一起，则说明这些资源被同时检索。
Requests Table。 此表格列出了检索的每一个资源。 默认情况下，此表格按时间顺序排序，最早的资源在顶部。点击资源的名称可以显示更多信息。 提示：右键点击 Timeline 以外的任何一个表格标题可以添加或移除信息列。
Summary。 此窗格可以一目了然地告诉您请求总数、传输的数据量和加载时间。

默认情况下，Requests Table会显示以下列。您可以添加和移除列。

Name。资源的名称。
Status。HTTP状态代码。
Type。已请求资源的MIME类型。
Initiator。发起请求的对象或进程。值为以下选项之一：
Parser。Chrome 的 HTML 解析器发起请求。
Redirect。HTTP 重定向发起请求。
Script。脚本发起请求。
Other。某些其他进程或操作发起请求，例如用户通过链接或者在地址栏中输入网址导航到页面。
Size。响应标头（通常为数百字节）加响应正文（由服务器提供）的组合大小。
Time。从请求开始至在响应中接收到最终字节的总持续时间。
Timeline。Timeline 列可以显示所有网络请求的可视瀑布。 点击此列的标题可以显示一个包含更多排序字段的菜单。

###Capture screenshots（捕捉网页截图）

Capture Screenshots是自动分析DOM树的变化，截下DOM树变化各个重要阶段时的页面，尚不清楚是如何判断截图时机的（不过肯定是在DOM树有变化的时候才截图的）。除了截图外，还能看到每个截图所对应的Network情况，通过横向比较，可以发现一些请求（图片、js、css、xhr等）对页面的影响，举例来说：在加载某js前，页面上是没有菜单的，加载后菜单就出来了，那就可以粗略地判断此js与菜单有关。
另外，这功能对于解决页面抖动（最常见于MVVM框架的DOM树渲染，以及由于图片未加载导致该区域尺寸未定的情况）也有很大的帮助。
打开Network面板，点亮左上角那个摄像机的图标（鼠标移上去会提示Capturescreenshots）点亮该图标后，会打开新的一折叠面板，在该面板上会提示按Ctrl+R来启动截图，刷新页面按Ctrl+R后，截图就自动完成了



性能面板
------

注意: 在Chrome57之后时间线面板Timeline-Panel更名为性能面板. 

使用时间轴面板可以通过记录和查看网站生命周期内发生的各种事件来提高页面的运行时性能。

[如何查看性能](https://developers.google.com/web/tools/chrome-devtools/evaluate-performance/timeline-tool)


使用 Chrome DevTools 的 Timeline 面板可以记录和分析您的应用在运行时的所有活动。 这里是开始调查应用中可觉察性能问题的最佳位置


TL;DR

执行 Timeline 记录，分析页面加载或用户交互后发生的每个事件。
在 Overview 窗格中查看 FPS、CPU 和网络请求。
点击火焰图中的事件以查看与其相关的详细信息。
放大显示一部分记录以简化分析。

**Timeline 面板概览**

Timeline 面板包含以下四个窗格：

1. Controls。开始记录，停止记录和配置记录期间捕获的信息。
2. Overview。 页面性能的高级汇总。更多内容请参见下文。
3. 火焰图。 CPU堆叠追踪的可视化。
4. Details。选择事件后，此窗格会显示与该事件有关的更多信息。 未选择事件时，此窗格会显示选定时间范围的相关信息。

您可以在火焰图上看到一到三条垂直的虚线。蓝线代表DOMContentLoaded事件。 绿线代表首次绘制的时间。 红线代表load事件。

**Overview 窗格**

Overview窗格包含以下三个图表：

1. FPS。每秒帧数。绿色竖线越高，FPS越高。 FPS图表上的红色块表示长时间帧，很可能会出现卡顿。
2. CPU。 CPU资源。此面积图指示消耗CPU资源的事件类型。
3. NET。每条彩色横杠表示一种资源。横杠越长，检索资源所需的时间越长。 


每个横杠的浅色部分表示等待时间（从请求资源到第一个字节下载完成的时间）。
深色部分表示传输时间（下载第一个和最后一个字节之间的时间）。

横杠按照以下方式进行彩色编码：
HTML文件为蓝色。
脚本为黄色。
样式表为紫色。
媒体文件为绿色。
其他资源为灰色。


**做记录**

要记录页面加载，请打开Timeline面板，打开想要记录的页面，然后重新加载页面。 Timeline 面板会自动记录页面重新加载。

要记录页面交互，请打开 Timeline 面板，然后按 Record 按钮 (Record 按钮) 或者键入键盘快捷键 Cmd+E (Mac) 或 Ctrl+E (Windows / Linux)，开始记录。记录时，Record 按钮会变成红色。执行页面交互，然后按 Record 按钮或再次键入键盘快捷键停止记录。

完成记录后，DevTools 会猜测哪一部分记录与您最相关，并自动缩放到那一个部分。

记录提示

* 尽可能保持记录简短。简短的记录通常会让分析更容易。
* 避免不必要的操作。避免与您想要记录和分析的活动无关联的操作（鼠标点击、网络加载，等等）。例如，如果您想要记录点击 Login 按钮后发生的事件，请不要滚动页面、加载图像，等等。
* 停用浏览器缓存。记录网络操作时，最好从 DevTools 的 Settings 面板或 Network conditions 抽屉式导航栏停用浏览器的缓存。
* 停用扩展程序。Chrome 扩展程序会给应用的 Timeline 记录增加不相关的噪声。 以隐身模式打开 Chrome 窗口或者创建新的 Chrome 用户个人资料，确保您的环境中没有扩展程序。


**查看记录详细信息**

在火焰图中选择事件时，Details窗格会显示与事件相关的其他信息。

一些标签（如 Summary）适用于所有事件类型。其他标签则仅对特定事件类型可用。 请参阅[Timeline事件参考](https://developers.google.com/web/tools/chrome-devtools/evaluate-performance/performance-reference)，了解与每个记录类型相关的详细信息。


**时间线事件参考**

时间线事件模式可以显示记录时触发的所有事件。使用时间线事件参考可以详细了解每一个时间线事件类型。

常见的时间线事件属性

某些详细信息存在于所有类型的事件中，而一些仅适用于特定的事件类型。本部分列出了不同事件类型的通用属性。特定于特定事件类型的属性列在这些事件类型遵循的参考中。

|属性|显示时间|
|:--|:------|
|Aggregated time|对于带嵌套事件的事件，每个类别的事件所用的时间。|
|Call Stack|对于带子事件的事件，每个类别的事件所用的时间。|
|CPU time|记录的事件所花费的 CPU 时间。|
|Details|有关事件的其他详细信息。|
|Duration (at time-stamp)|    事件及其所有子事件完成所需的时间，时间戳是事件发生的时间（相对于记录开始的时间）。|
|Self time| 事件（不包括任何子事件）花费的时间。|
|Used Heap Size| 记录事件时应用使用的内存大小，以及自上次采样以来已使用堆大小的增减 (+/-) 变化。|


Loading事件

本部分列出了属于加载类别的事件及其属性。

|事件|说明|
|:----------|:------------|
|Parse HTML|浏览器执行HTML解析，Chrome 执行其 HTML 解析算法|
|Finish Loading|网络请求完毕事件，网络请求已完成|
|Receive Data|请求的响应数据到达事件，如果响应数据很大（拆包），可能会多次触发该事件，请求的数据已被接收。存在一个或多个 Receive Data 事件|
|Receive Response|响应头报文到达时触发，请求的初始 HTTP 响应|
|Send Request|发送网络请求时触发，网络请求已被发送|


Loading 事件属性

|属性|说明|
|:---|:----|
|Resource|请求的资源的网址。|
|Preview|请求的资源的预览（仅图像）。|
|Request Method|用于请求的 HTTP 方法（例如，GET 或 POST）。|
|Status Code|HTTP 响应代码。|
|MIME Type|请求的资源的 MIME 类型。|
|Encoded Data Length|请求的资源的长度（以字节为单位）。|


Scripting 事件

本部分列出了属于脚本类别的事件及其属性。

|事件|说明|
|---|:---|
|Animation Frame Fired|预定的动画帧被触发，其回调处理程序被调用。一个定义好的动画帧发生并开始回调处理时触发|
|Cancel Animation Frame|预定的动画帧被取消。取消一个动画帧时触发|
|GC Event|发生垃圾回收。垃圾回收时触发|
|DOMContentLoaded|浏览器触发DOMContentLoaded。当页面的所有DOM 内容都已加载和解析时，将触发此事件。当页面中的DOM内容加载并解析完毕时触发|
|Evaluate Script|脚本已被评估。|
|Event|JavaScript事件（例如，“mousedown”或“key”）。js事件|
|Function Call|发生顶级JavaScript函数调用（只有浏览器进入JavaScript引擎时才会出现）。只有当浏览器进入到js引擎中时触发|
|Install Timer|已使用setInterval()或setTimeout()创建定时器。创建计时器（调用setTimeout()和setInterval()）时触发|
|Request Animation Frame|requestAnimationFrame()调用已预定一个新帧。|
|Remove Timer|之前创建的定时器已被清除。当清除一个计时器时触发|
|Time|一个脚本调用了 console.time()调用console.time()触发|
|Time End|一个脚本调用了 console.timeEnd()调用console.timeEnd()触发|
|Timer Fired|使用setInterval()或setTimeout()创建的定时器已被触发。定时器激活回调后触发|
|XHR Ready State Change|XMLHTTPRequest的就绪状态已发生变化。当一个异步请求为就绪状态后触发|
|XHR Load|XMLHTTPRequest 已结束加载。当一个异步请求完成加载后触发|


Scripting 事件属性

|属性|说明|
|:--|:----|
|Timer ID|定时器 ID。|
|Timeout|定时器指定的超时。|
|Repeats|指定定时器是否重复的布尔值。|
|Function Call|已调用一个函数。|


Rendering 事件

本部分列出了属于渲染类别的事件及其属性。

|事件|说明|
|:--|:----|
|Invalidate layout|页面布局被DOM更改声明为无效。|
|Layout|页面布局已被执行。|
|Recalculate style|Chrome重新计算了元素样式。|
|Scroll|嵌套视图的内容被滚动。|
|Rendering|事件属性|

|属性|说明|
|:--|:----|
|Layout invalidated|对于Layout记录，导致布局失效的代码的堆叠追踪。|
|Nodes that need layout|对于Layout记录，被标记为需要在重新布局启动前布局的节点的数量。正常情况下，这些代码是被开发者代码声明为无效的代码，以及向上追溯到重新布局根目录的路径。|
|Layout tree size|对于布局记录，重新布局根目录下节点（Chrome 启动重新布局的节点）的总数。|
|Layout scope|可能的值为“Partial”（重新布局边界是DOM的一部分）或“Whole document”。|
|Elements affected|对于 Recalculate 样式记录，受样式重新计算影响的元素的数量。|
|Styles invalidated|对于 Recalculate 样式记录，提供导致样式失效的代码的堆叠追踪。|


Painting 事件

本部分列出了属于打印类别的事件及其属性。

|事件|说明|
|:--|:----|
|Composite Layers|Chrome的渲染引擎合成了图像层。|
|Image Decode|一个图像资源被解码。|
|Image Resize|一个图像的大小相对于其原生尺寸发生了变化。|
|Paint|合成的图层被绘制到显示画面的一个区域。将鼠标悬停到 Paint 记录上会突出显示已被更新的显示画面区域。|


Painting 事件属性

|属性|说明|
|:--|:----|
|Location|对于Paint事件，绘制矩形的 x 和 y 坐标。|
|Dimensions|对于Paint事件，已绘制区域的高度和宽度。|


**在记录期间捕捉屏幕截图**

Timeline面板可以在页面加载时捕捉屏幕截图。此功能称为幻灯片。

在您开始记录之前，请在 Controls 窗格中启用 Screenshots 复选框，以便捕捉记录的屏幕截图。 屏幕截图显示在 Overview 窗格下方。将您的鼠标悬停在 Screenshots 或 Overview 窗格上可以查看记录中该点的缩放屏幕截图。 左右移动鼠标可以模拟记录的动画。


**分析JavaScript**

开始记录前，请启用 JS Profile 复选框，以便在您的时间线记录中捕捉 JavaScript 堆栈。 启用 JS 分析器后，您的火焰图会显示调用的每个 JavaScript 函数。

开始记录前，请启用 JS Profile 复选框，以便在您的时间线记录中捕捉 JavaScript 堆栈。 启用 JS 分析器后，您的火焰图会显示调用的每个 JavaScript 函数。


**分析绘制**

开始记录前，请启用 Paint 复选框，以便获取有关 Paint 事件的更多数据分析。 启用绘制分析并点击 Paint 事件后，新 Paint Profiler 标签会出现在 Details 窗格中，后者显示了许多与事件相关的更精细信息。


**渲染设置**

打开主 DevTools 菜单，然后选择More tools > Rendering settings 访问渲染设置，这些设置在调试绘制问题时非常有用。渲染设置会作为一个标签显示在 Console 抽屉式导航栏（如果隐藏，请按 esc 显示抽屉式导航栏）旁边。


**搜索记录**

查看事件时，您可能希望侧重于一种类型的事件。例如，您可能需要查看每个 Parse HTML 事件的详细信息。

在 Timeline 处于焦点时，按 Cmd+F (Mac) 或 Ctrl+F (Windows / Linux) 以打开一个查找工具栏。键入您想要检查的事件类型的名称，如 Event。

工具栏仅适用于当前选定的时间范围。选定时间范围以外的任何事件都不会包含在结果中。

利用上下箭头，您可以按照时间顺序在结果中移动。所以，第一个结果表示选定时间范围内最早的事件，最后一个结果表示最后的事件。每次按向上或向下箭头会选择一个新事件，因此，您可以在 Details 窗格中查看其详细信息。按向上和向下箭头等同于在火焰图中点击事件。

**在Timeline部分上放大**

您可以放大显示一部分记录，以便简化分析。使用 Overview 窗格可以放大显示一部分记录。 放大后，火焰图会自动缩放以匹配同一部分。

要在 Timeline 部分上放大，请执行以下操作：

在 Overview 窗格中，使用鼠标拖出 Timeline 选择。
在标尺区域调整灰色滑块。
选择部分后，可以使用 W、A、S 和 D 键调整您的选择。 W 和 S 分别代表放大和缩小。 A 和 D 分别代表左移和右移。

**保存和打开记录**

您可以在 Overview 或火焰图窗格中点击右键并选择相关选项，保存和打开记录。


[分析运行时性能](https://developers.google.com/web/tools/chrome-devtools/rendering-tools/)


用户希望页面可以交互并且非常流畅。像素管道的每个阶段均可能出现卡顿现象。 了解用于确定和解决会降低运行时性能的常见问题的工具和策略。

TL;DR

不要编写会强制浏览器重新计算布局的JavaScript。将读取和写入功能分开，并首先执行读取。
不要使您的CSS过于复杂。减少使用CSS并保持CSS选择器简洁。
尽可能地避免布局。选择根本不会触发布局的CSS。
绘制比任何其他渲染活动花费的时间都要多。请留意绘制瓶颈。

**JavaScript**

JavaScript计算，特别是会触发大量视觉变化的计算会降低应用性能。 不要让时机不当或长时间运行的 JavaScript影响用户交互。

工具

进行Timeline记录，并找出疑似较长的Evaluate Script 事件。 如果您发现存在任何这样的事件，可以启用JS分析器并重新做记录，以便获取究竟调用了哪些JS函数以及调用每个函数需要多长时间的更详细信息。

如果您注意到 JavaScript 中出现较多的卡顿现象，您可能需要进一步分析并收集 JavaScript CPU 配置文件。CPU 配置文件会显示执行时间花费在页面的哪些函数上。在[加快JavaScript执行速度](https://developers.google.com/web/tools/chrome-devtools/rendering-tools/js-execution)中了解如何创建CPU配置文件。


问题

下表对一些常见JavaScript问题和潜在解决方案进行了说明：

|问题|示例|解决方案|
|:----|:----|:----|
|大开销输入处理程序影响响应或动画|触摸、视差滚动。|让浏览器尽可能晚地处理触摸和滚动，或者绑定侦听器（请参阅Paul Lewis[运行时性能检查单中的大开销输入处理程序](https://calendar.perfplanet.com/2013/the-runtime-performance-checklist/)）。|
|时机不当的 JavaScript 影响响应、动画、加载。|页面加载后用户向右滚动、setTimeout/setInterval。|优化 JavaScript 执行：使用 requestAnimationFrame、使 DOM 操作遍布各个帧、使用网络工作线程。|
|长时间运行的 JavaScript 影响响应。| DOMContentLoaded 事件由于 JS 工作过多而停止。|   将纯粹的计算工作转移到网络工作线程。如果您需要 DOM 访问权限，请使用 requestAnimationFrame（另请参阅优化 JavaScript 执行）。|
|会产生垃圾的脚本影响响应或动画。|任何地方都可能发生垃圾回收。 | 减少编写会产生垃圾的脚本（请参阅 Paul Lewis 运行时性能检查单中的动画垃圾回收）。|


**样式**

样式更改开销较大，在这些更改会影响DOM中的多个元素时更是如此。 只要您将样式应用到元素，浏览器就必须确定对所有相关元素的影响、重新计算布局并重新绘制。

相关指南：

[缩小样式计算的范围并降低其复杂性](https://developers.google.com/web/fundamentals/performance/rendering/reduce-the-scope-and-complexity-of-style-calculations)


工具

进行 Timeline 记录。检查大型 Recalculate Style 事件的记录（以紫色显示）。

点击 Recalculate Style 事件可以在 Details 窗格中查看更多相关信息。 如果样式更改需要较长时间，对性能的影响会非常大。 如果样式计算会影响大量元素，则需要改进另一个方面。

要降低 Recalculate Style 事件的影响，请执行以下操作：

* 使用[CSS 触发器](https://csstriggers.com/)了解哪些 CSS 属性会触发布局、绘制与合成。 这些属性对渲染性能的影响最大。
* 请转换到影响较小的属性。请参阅坚持仅合成器属性和管理层计数，寻求更多指导。


问题

下表对一些常见样式问题和潜在解决方案进行了说明：

|问题|示例|解决方案|
|:----|:----|:----|
|大开销样式计算影响响应或动画。| 任何会更改元素几何形状的 CSS 属性，如宽度、高度或位置；浏览器必须检查所有其他元素并重做布局。|[避免会触发布局的CSS](https://developers.google.com/web/fundamentals/performance/rendering/avoid-large-complex-layouts-and-layout-thrashing)。
|
|复杂的选择器影响响应或动画。|嵌套选择器强制浏览器了解与所有其他元素有关的全部内容，包括父级和子级。|在CSS中引用只有一个类的元素。|

相关指南：

[缩小样式计算的范围并降低其复杂性](https://developers.google.com/web/fundamentals/performance/rendering/reduce-the-scope-and-complexity-of-style-calculations)


**布局**

布局（或Firefox中的自动重排）是浏览器用来计算页面上所有元素的位置和大小的过程。 网页的布局模式意味着一个元素可能影响其他元素；例如 <body> 元素的宽度一般会影响其子元素的宽度以及树中各处的节点，等等。这个过程对于浏览器来说可能很复杂。 一般的经验法则是，如果在帧完成前从DOM请求返回几何值，您将发现会出现“强制同步布局”，在频繁地重复或针对较大的DOM树执行操作时这会成为性能的大瓶颈。

相关指南：

[避免布局抖动](https://developers.google.com/web/fundamentals/performance/rendering/avoid-large-complex-layouts-and-layout-thrashing)
[诊断强制同步布局](https://developers.google.com/web/tools/chrome-devtools/rendering-tools/forced-synchronous-layouts)


工具

Chrome DevTools 的 Timeline 可以确定页面何时会导致强制同步布局。 这些 Layout 事件使用红色竖线标记。

“布局抖动”是指反复出现强制同步布局情况。 这种情况会在 JavaScript 从 DOM 反复地写入和读取时出现，将会强制浏览器反复重新计算布局。 要确定布局抖动，请找到多个强制同步布局警告（如上方屏幕截图所示）的模式。


问题

下表对一些常见布局问题和潜在解决方案进行了说明：

|问题|示例|解决方案|
|:----|:----|:----|
|强制同步布局影响响应或动画。|强制浏览器在像素管道中过早执行布局，导致在渲染流程中重复步骤。| 先批处理您的样式读取，然后处理任何写入（另请参阅[避免大型、复杂的布局和布局抖动](https://developers.google.com/web/fundamentals/performance/rendering/avoid-large-complex-layouts-and-layout-thrashing)）。|
|布局抖动影响响应或动画。|形成一个使浏览器进入读取-写入-读取写入周期的循环，强制浏览器反复地重新计算布局。|使用[FastDom内容库](https://github.com/wilsonpage/fastdom)自动批处理读取-写入操作。|


**绘制与合成**

绘制是填充像素的过程。这经常是渲染流程开销最大的部分。 如果您在任何情况下注意到页面出现卡顿现象，很有可能存在绘制问题。

合成是将页面的已绘制部分放在一起以在屏幕上显示的过程。 大多数情况下，如果坚持仅合成器属性并避免一起绘制，您会看到性能会有极大的改进，但是您需要留意过多的层计数（另请参阅坚持仅合成器属性和管理层计数）。

工具

想要了解绘制花费多久或多久绘制一次？请在 Timeline 面板上启用 Paint profiler，然后进行记录。

如果您的大部分渲染时间花费在绘制上，即表示存在绘制问题。

请查看 rendering settings 菜单，进一步了解可以帮助诊断绘制问题的配置。


问题

下表对一些常见绘制与合成问题及潜在解决方案进行了说明：

|问题|示例|解决方案|
|:---|:----|:----|
|绘制风暴影响响应或动画。|较大的绘制区域或大开销绘制影响响应或动画。|避免绘制、提升将要移动到自有层的元素，使用变形和不透明度（请参阅降低绘制的复杂性并减少绘制区域）。|
|层数激增影响动画。|使用translateZ(0)过度提升过多的元素会严重影响动画性能。|    请谨慎提升到层，并且仅在您了解这样会有切实改进时提升到层（请参阅坚持仅合成器属性和管理层计数）。|

[诊断强制的同步布局](https://developers.google.com/web/tools/chrome-devtools/rendering-tools/forced-synchronous-layouts)


##Timeline面板

https://developers.google.com/web/fundamentals/performance/rendering/

（一）文章：https://blog.coding.net/blog/Chome-Timeline

缩略图区域，可以看到除了时间轴以外被上下分成了四块，分别代表FPS、CPU时间、网络通信时间、堆栈占用；这个缩略图可以横向缩放，白色区域是下面可以看到的时间段（灰色当然是不可见的啦）。

Interactions区域可以看一些交互事件，例如你滚动了一下页面，那么这里会出现一个scroll 的线段，线段覆盖的范围就是滚动经过的时间。

Main区域则是具体的事件列表。

对于一般的屏幕，原则上来说一秒要往屏幕上绘制 60 帧，所以理论上讲我们一帧内的计算时间不能超过 16 毫秒，然而浏览器除了执行我们的代码以外，还要干点别的（例如计算 CSS，播放音频……），所以其实我们能用的只有 10~12 毫秒左右。

（二）

随着webpage可以承载的表现形式更加多样化，通过webpage来实现更多交互功能，构建web应用程序已经成为很多产品的首要选择。这种方式拥有非常明显的优势：跨平台、开发便捷、便于部署和维护等等，但随着功能的不断积累，web应用程序也会变得越来越复杂。但是，我们仍然想要在webpage支持丰富的呈现形式的同时，让页面效果能够达到>=60fps(帧)/s的刷新频率以避免出现卡顿，就需要我们使用一些比较直观的方式来分析衡量页面的性能问题，为性能优化方案提供依据。

为什么是60fps?我们的目标是保证页面要有高于每秒60fps(帧)的刷新频率，这和目前大多数显示器的刷新率相吻合(60Hz)。如果网页动画能够做到每秒60帧，就会跟显示器同步刷新，达到最佳的视觉效果。这意味着，一秒之内进行60次重新渲染，每次重新渲染的时间不能超过16.66毫秒。

需求大体明确，就是要找到页面执行过程中的性能瓶颈。而Chrome DevTools的Timeline则正是用来记录和分析应用在运行时所有的活动情况，它是用来排查应用性能瓶颈的最佳工具。

Tips:为了避免浏览器插件对分析过程产生影响，建议在隐身模式下进行分析。

Chrome TimeLine工具可以很好地辅助分析页面的性能瓶颈，提供详细全面的分析数据，为性能优化提供数据依据，以及还包括如Memery Mode、Screen Shot等多种多样的技巧，非常强大。

Timeline工具会详细检测出在Web应用加载的过程中时间花费情况的概览，包括下载资源、处理DOM事件、页面布局渲染、向屏幕绘制元素等。你可以通过分析Timeline得到的事件、框架和实时的内存用量，找出应用的性能问题。

在分析页面前，需要首先开启录制功能，记录页面的操作和渲染记录。如上图，左上角的灰色圆点就是录制按钮，点击后会变成红色，然后在页面上进行相关操作后再次按下变成灰色完成录制，这样就完成了一次对操作及加载渲染的记录过程，随后Timeline就会开始分析操作过程中的各项性能参数。

Timeline同时提供了两种查看模式：“事件模式(Event Mode)”和“帧模式(Frame Mode)”。
事件模式：显示重新渲染的各种事件花费的时间。帧模式：显示每一帧的时间花费情况。

###事件模式 (Event Mode)
如果我们的一个页面执行效率不高，我们必须要搞清楚导致页面性能低下的原因，到底是javascript执行出了问题，还是页面渲染出了问题。要了解这里面的执行细节，我们可以使用“事件模式”来进行分析。首先我们需要录制一些需要被分析的操作，录制结束后进入事件模式预览Timeline。下图是得到的事件模式的视图：

蓝色(Loading)：网络通信和HTML解析
黄色(Scripting)：JavaScript执行
紫色(Rendering)：样式计算和布局，即重排
绿色(Painting)：重绘
灰色(other)：其它事件花费的时间
白色(Idle)：空闲时间

在显示的记录中，浏览器也会为在检测过程中发现的一些可能导致性能问题的过程进行标注，在ModeView视图区域，可能会出现一些红色的区块段，这些红色的区块段表明，在对应的时间上执行的事件可能存在性能问题，而在对应的MainThread视图区域，事件区块的右上角会出现红色的小三角，点击当前区块，在下面的Summary概要区域内会给出详细的警告内容以及脚本可能出现问题的行数，如“Forced synchronous layout is a possible performance bottleneck”，浏览器提示“强制同步布局可能会导致性能瓶颈”。

###帧模式 (Frame Mode)
帧模式从页面渲染性能的角度提供了数据支撑，一个柱状“frame”表示渲染过程中的一帧，也就是浏览器为了渲染单个内容块而必须要做的工作，包括：执行js，处理事件，修改DOM，更改样式和布局，绘制页面等。



内存面板
-------

注意: 在 Chrome 57 之后分析面板更名为内存面板. Profiles Panel

如果需要比时间轴面板提供的更多信息，可以使用“配置”面板，例如跟踪内存泄漏。 Use the Profiles panel if you need more information than the Timeline provide, for instance to track down memory leaks.

[JavaScript CPU 分析器](https://developers.google.com/web/tools/chrome-devtools/rendering-tools/js-execution)

使用Chrome DevTools CPU分析器识别开销大的函数。

TL;DR

使用 CPU 分析器准确地记录调用了哪些函数和每个函数花费的时间。
将您的配置文件可视化为火焰图。

**记录CPU分析**

如果您在 JavaScript 中注意到出现卡顿，请收集 JavaScript CPU 分析。CPU 分析会显示执行时间花费在页面中哪些函数上。

转到 DevTools 的 Profiles 面板。
选择 Collect JavaScript CPU Profile 单选按钮。
按 Start。
根据您要分析的内容不同，可以重新加载页面、与页面交互，或者只是让页面运行。
完成后，按 Stop 按钮。

您也可以使用[Command Line API](https://developers.google.com/web/tools/chrome-devtools/console/command-line-reference#profilename-and-profileendname) 对命令行产生的分析进行记录和分组。


**查看CPU分析**

完成记录后，DevTools会使用记录的数据自动填充Profile面板。

默认视图为Heavy(Bottom Up)此视图让您可以看到哪些函数对性能影响最大并能够检查这些函数的调用路径。

更改排序顺序

要更改排序顺序，请点击focus selected function图标旁的下拉菜单，然后选择下列选项中的一项：
Chart。显示记录按时间顺序排列的火焰图。

Heavy (Bottom Up)。按照函数对性能的影响列出函数，让您可以检查函数的调用路径。 这是默认视图。

Tree (Top Down)。显示调用结构的总体状况，从调用堆栈的顶端开始。

排除函数

要从您的 CPU 分析中排除函数，请点击以选择该函数，然后按 exclude selected function 图标 (exclude function 图标)。

已排除函数的调用方由排除函数的总时间管理。

点击 restore all functions 图标 (restore all functions 图标) 可以将所有排除的函数恢复到记录中。


**以火焰图形式查看 CPU 分析**

火焰图视图直观地表示了一段时间内的 CPU 分析。

记录 CPU 分析后，更改排序顺序为 Chart，以便以火焰图形式查看记录。


火焰图分为以下两部分：

* 概览。整个记录的鸟瞰图。 条的高度与调用堆栈的深度相对应。 所以，栏越高，调用堆栈越深。
* 调用堆栈。这里可以详细深入地查看记录过程中调用的函数。 横轴是时间，纵轴是调用堆栈。 堆栈由上而下组织。所以，上面的函数调用它下面的函数，以此类推。

函数的颜色随机，与其他面板中使用的颜色无关。 不过，函数的颜色在调用过程中始终保持一致，以便您了解执行的模式。

高调用堆栈不一定很重要，只是表示调用了大量的函数。 但宽条表示调用需要很长时间完成。 这些需要优化。


在记录的特定部分上放大

在概览中点击、按住并左右拖动鼠标，可放大调用堆栈的特定部分。 缩放后，调用堆栈会自动显示您选定的记录部分。

查看函数详情

点击函数可在 Sources 面板中查看其定义。

将鼠标悬停在函数上可显示其名称和计时数据。提供的信息如下：

* Name。函数的名称。
* Self time。完成函数当前的调用所需的时间，仅包含函数本身的声明，不包含函数调用的任何函数。
* Total time。完成此函数和其调用的任何函数当前的调用所需的时间。
URL。形式为 file.js:100 的函数定义的位置，其中 file.js 是定义函数的文件名称，100 是定义的行号。
* Aggregated self time。记录中函数所有调用的总时间，不包含此函数调用的函数。
* Aggregated total time。函数所有调用的总时间，不包含此函数调用的函数。
* Not optimized。如果分析器已检测出函数存在潜在的优化，会在此处列出。



[内存堆区分析器](https://developers.google.com/web/tools/chrome-devtools/memory-problems/)

了解如何使用 Chrome 和 DevTools 查找影响页面性能的内存问题，包括内存泄漏、内存膨胀和频繁的垃圾回收。

TL;DR

使用 Chrome 的任务管理器了解您的页面当前正在使用的内存量。
使用 Timeline 记录可视化一段时间内的内存使用。
使用堆快照确定已分离的 DOM 树（内存泄漏的常见原因）。
使用分配时间线记录了解新内存在 JS 堆中的分配时间。


概览

在[RAIL](https://developers.google.com/web/fundamentals/performance/rail)性能模型的精髓中，您的性能工作的焦点应是用户。

内存问题至关重要，因为这些问题经常会被用户察觉。 用户可通过以下方式察觉内存问题：

页面的性能随着时间的延长越来越差。 这可能是内存泄漏的症状。 内存泄漏是指，页面中的错误导致页面随着时间的延长使用的内存越来越多。
页面的性能一直很糟糕。 这可能是内存膨胀的症状。 内存膨胀是指，页面为达到最佳速度而使用的内存比本应使用的内存多。
页面出现延迟或者经常暂停。 这可能是频繁垃圾回收的症状。 垃圾回收是指浏览器收回内存。 浏览器决定何时进行垃圾回收。 回收期间，所有脚本执行都将暂停。因此，如果浏览器经常进行垃圾回收，脚本执行就会被频繁暂停。


内存膨胀：如何界定“过多”？

内存泄漏很容易确定。如果网站使用的内存越来越多，则说明发生内存泄漏。 但内存膨胀比较难以界定。 什么情况才算是“使用过多的内存”？

这里不存在硬性数字，因为不同的设备和浏览器具有不同的能力。 在高端智能手机上流畅运行的相同页面在低端智能手机上则可能崩溃。

界定的关键是使用 RAIL 模型并以用户为中心。了解什么设备在您的用户中深受欢迎，然后在这些设备上测试您的页面。如果体验一直糟糕，则页面可能超出这些设备的内存能力。


使用 Chrome 任务管理器实时监视内存使用

使用 Chrome 任务管理器作为内存问题调查的起点。 任务管理器是一个实时监视器，可以告诉您页面当前正在使用的内存量。

按 Shift+Esc 或者转到 Chrome 主菜单并选择 More tools > Task manager，打开任务管理器。
右键点击任务管理器的表格标题并启用 JavaScript memory。


下面两列可以告诉您与页面的内存使用有关的不同信息：

* Memory 列表示原生内存。DOM 节点存储在原生内存中。 如果此值正在增大，则说明正在创建 DOM 节点。
* JavaScript Memory 列表示 JS 堆。此列包含两个值。 您感兴趣的值是实时数字（括号中的数字）。 实时数字表示您的页面上的可到达对象正在使用的内存量。 如果此数字在增大，要么是正在创建新对象，要么是现有对象正在增长。


**使用 Timeline 记录可视化内存泄漏**

您也可以使用 Timeline 面板作为调查的起点。 Timeline 面板可以帮助您直观了解页面在一段时间内的内存使用情况。

在 DevTools 上打开 Timeline 面板。
启用 Memory 复选框。
做记录。
提示：一种比较好的做法是使用强制垃圾回收开始和结束记录。 在记录时点击 Collect garbage 按钮 (强制垃圾回收按钮) 可以强制进行垃圾回收。

要显示 Timeline 内存记录，请考虑使用下面的代码：


快捷键
-----

MAC:  Command == Ctrl 切换上下标签页的时 Control == Ctrl

|快捷键    |功能|
|----------|:-----------|
|Ctrl + N  |打开新的窗口|
|Ctrl + W  or  Ctrl + F4 |关闭当前标签页|
|Ctrl + T  |打开新的标签页|
|Ctrl + Shift + N|打开新的隐身窗口|
|Ctrl + O |浏览器中打开计算机中的文件|
|按住Ctrl键的同时点击链接或鼠标滚轮点击链接|从后台在新标签页中打开链接|
|按住 Shift 键的同时点击链接|在新窗口中打开链接|
|Ctrl + Shift + T|重新打开上次关闭的标签页|
|Ctrl + 1 到 Ctrl + 8 |切换到标签栏中指定位置编号所对应的标签页|
|Ctrl + 9 |切换到最后一个标签页|
|Ctrl + Tab 或 Ctrl + PgDown |切换到下一个标签页|
|Ctrl + Shift + Tab 或 Ctrl + PageUp|切换到上一个标签页|


插件
----

对于前端开发者来说，Chrome浏览器绝对是开发过程中不可缺少的利器：不仅仅是因为Chrome自带的功能强大的devtool，更是因为Chrome有着各种好用的前端语言调试工具以及诸如EnjoyCSS、LiveReload等这类能够提高你编码效率的强大扩展。

[Wappalyzer](https://wappalyzer.com/)  
探测网站正在使用的开源软件技术，web开发者必备利器
Wappalyzer = Appspector + Web Server Notifier Web + Technology Notifier

[掘金](https://gold.xitu.io/extension/?utm_source=extension&utm_medium=segmentfault)干货内容聚合

[vuejs devtools](https://chrome.google.com/webstore/detail/vuejs-devtools/nhdogjmejiglipccpnnnanhbledajbpd)Chrome开发者工具扩展，用于调试Vue.js应用。

[React Developer Tools](https://chrome.google.com/webstore/detail/react-developer-tools/fmkadmapgofadopljbjfkapdkoienihi)可以在Chrome和Firefox开发者工具审查 React 组件的浏览器扩展。

[AngularJS Batarang](https://chrome.google.com/webstore/detail/angularjs-batarang/ighdmehidhipcmcojjgiloacoafjmpfk)用来调试和分析AngularJS应用。

[ng-inspector for AngularJS](https://chrome.google.com/webstore/detail/ng-inspector-for-angularj/aadgmnobpdmgmigaicncghmmoeflnamj)在检查元素面板中显示当前页面实时AngularJS范围层次结构、以及它的控制器或指令与范围相关

[EnjoyCSS](https://chrome.google.com/webstore/detail/enjoycss/gefdjidjdnjmgbipbbfkmaidbibpkfja)EnjoyCSS能够通过图形化的界面帮助你在线生成CSS3 代码，可谓前端开发者的一大利器。

[LiveReload](https://chrome.google.com/webstore/detail/livereload/jnihajbhpnppcggbcgedagnkighmdlei?hl=zh-CN)LiveReload 会监控你指定的目录中文件，如果有文件被更改，它就自动触发浏览器刷新页面，这样我们不用每次修改文件后，都要去按下F5刷新页面。

[jquery audit]()jQuery Audit是让你可以在DevTools查看页面节点的jQuery属性和数据，方便你调试使用jQuery库的web应用。你可以在上面看到你选中的页面元素的jQuery的events、data等属性。例如，很多人都喜欢用$.data()来让jQuery节点对象缓存一些数据，通过jQuery Audit你可以很方便地看到你缓存的数据。

[JS Runtime Inspector]()JS Runtime Inspector让你可以在DevTools上直接通过关键词来搜索页面上JavaScript对象。当你想知道此时你的程序中某个JavaScript对象的属性和数据，然而你并不知道它所在哪个作用域，只知道对象名称，因而你不能在控制台用window.xxxObj的方式来访问这个对象，所以此时你可以借助JS Runtime Inspector来查找这个对象了。

[Devtools redirect]()Devtools redirect可以帮你给页面上的网络连接重定位。事实上网络请求重定位的功能，可以用fiddler或者ngix轻松实现，但Devtools redirect可以让你直接在浏览器上配置这些重定位。

技巧
----

chrome://flags/ 






