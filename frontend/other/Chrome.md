
https://developers.google.com/web/tools/chrome-devtools/

https://developer.chrome.com/devtools

https://segmentfault.com/a/1190000007713707

#调试工具
掌握Chrome浏览器的开发调试工具，也很容易上手其他客户端调试工具，例如火狐的firebug。
进入浏览器，快捷键F12调出开发者工具。

##Elements面板

快捷键Ctrl+F(Mac:CMD+F)，在搜索栏输入ID选择符或者类选择符就可以定位到元素啦

元素编辑器：完成相应的编辑之后，页面会立即发生相应改变。

选择一个DOM元素，按下Alt键并且鼠标双击选择DOM元素前面的箭头，展开该DOM元素下的所有字节点元素。

右键选中想要监听的DOM节点弹出菜单，鼠标停在Break on...，会出现三个子菜单：
1. Subtree modifications，在该DOM结点及其子结点的结构有变动时中断。
2. Attributes modifications，在该DOM结点（不包括其子结点）的属性有所变化时中断，可以用在找出某个属性或者class是由哪段代码添加或修改的，尤其是在修改JS插件时非常省事；
3. node removal，在该DOM结点被移除出DOM树时中断。

###Elements-Styles、Elements-Computed
一个DOM节点最终的CSS可能会被很多段CSS代码所影响，例如在Elements-Styles里就列出了所有对目标DOM节点有影响的CSS代码：可是这样一个一个来看，实在是很烦，那chrome有没有能总结出最终CSS的功能呢？chrome也是有的，藏在Elements-Computed里了，由于不是默认展开的面板，所以一直没能引起注意。关于这个功能，有个比较常用的场景，那就是查看一段文字的字体。

Elements面板右侧的Style编辑器中，点击颜色十六进制编码前的小色块，会弹出一个调色板：可以自定义颜色值，也可以使用拾色器进行取色，调色板下方可以选择MaterialDesign的主要色系；按住shift再点击即可切换相应颜色模式。

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

##Network面板

###Capture screenshots（捕捉网页截图）

Capture Screenshots是自动分析DOM树的变化，截下DOM树变化各个重要阶段时的页面，尚不清楚是如何判断截图时机的（不过肯定是在DOM树有变化的时候才截图的）。除了截图外，还能看到每个截图所对应的Network情况，通过横向比较，可以发现一些请求（图片、js、css、xhr等）对页面的影响，举例来说：在加载某js前，页面上是没有菜单的，加载后菜单就出来了，那就可以粗略地判断此js与菜单有关。
另外，这功能对于解决页面抖动（最常见于MVVM框架的DOM树渲染，以及由于图片未加载导致该区域尺寸未定的情况）也有很大的帮助。
打开Network面板，点亮左上角那个摄像机的图标（鼠标移上去会提示Capturescreenshots）点亮该图标后，会打开新的一折叠面板，在该面板上会提示按Ctrl+R来启动截图，刷新页面按Ctrl+R后，截图就自动完成了

##Timeline面板

随着webpage可以承载的表现形式更加多样化，通过webpage来实现更多交互功能，构建web应用程序已经成为很多产品的首要选择。这种方式拥有非常明显的优势：跨平台、开发便捷、便于部署和维护等等，但随着功能的不断积累，web应用程序也会变得越来越复杂。但是，我们仍然想要在webpage支持丰富的呈现形式的同时，让页面效果能够达到>=60fps(帧)/s的刷新频率以避免出现卡顿，就需要我们使用一些比较直观的方式来分析衡量页面的性能问题，为性能优化方案提供依据。

为什么是60fps?我们的目标是保证页面要有高于每秒60fps(帧)的刷新频率，这和目前大多数显示器的刷新率相吻合(60Hz)。如果网页动画能够做到每秒60帧，就会跟显示器同步刷新，达到最佳的视觉效果。这意味着，一秒之内进行60次重新渲染，每次重新渲染的时间不能超过16.66毫秒。

需求大体明确，就是要找到页面执行过程中的性能瓶颈。而Chrome DevTools的Timeline则正是用来记录和分析应用在运行时所有的活动情况，它是用来排查应用性能瓶颈的最佳工具。

Tips:为了避免浏览器插件对分析过程产生影响，建议在隐身模式下进行分析。

Chrome TimeLine工具可以很好地辅助分析页面的性能瓶颈，提供详细全面的分析数据，为性能优化提供数据依据，以及还包括如 Memery Mode、Screen Shot 等多种多样的技巧，非常强大。

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

###TimeLine中的事件汇总：

####Loading事件

|事件|描述|
|----------|:------------|
|Parse HTML|浏览器执行HTML解析|
|Finish Loading|网络请求完毕事件|
|Receive Data|请求的响应数据到达事件，如果响应数据很大（拆包），可能会多次触发该事件|
|Receive Response|响应头报文到达时触发|
|Send Request|发送网络请求时触发|

####Scripting事件
|事件|描述|
|---|:---|
|Animation Frame Fired|一个定义好的动画帧发生并开始回调处理时触发|
|Cancel Animation Frame|取消一个动画帧时触发|
|GC Event|垃圾回收时触发|
|DOMContentLoaded|当页面中的DOM内容加载并解析完毕时触发|
|Evaluate Script|A script was evaluated.|
|Event|js事件|
|Function Call|只有当浏览器进入到js引擎中时触发|
Install Timer   创建计时器（调用setTimeout()和setInterval()）时触发
Request Animation Frame A requestAnimationFrame() call scheduled a new frame
Remove Timer    当清除一个计时器时触发
Time    调用console.time()触发
Time End    调用console.timeEnd()触发
Timer Fired 定时器激活回调后触发
XHR Ready State Change  当一个异步请求为就绪状态后触发
XHR Load    当一个异步请求完成加载后触发


#快捷键

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


#插件

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

#技巧
chrome://flags/ 





