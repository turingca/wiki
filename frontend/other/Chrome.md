
https://developers.google.com/web/tools/chrome-devtools/



#调试工具
掌握Chrome浏览器的开发调试工具，也很容易上手其他客户端调试工具，例如火狐的firebug。
进入浏览器，快捷键F12调出开发者工具。

##Elements

快捷键Ctrl+F(Mac:CMD+F)，在搜索栏输入ID选择符或者类选择符就可以定位到元素啦

元素编辑器：完成相应的编辑之后，页面会立即发生相应改变。

选择一个DOM元素，按下Alt键并且鼠标双击选择DOM元素前面的箭头，展开该DOM元素下的所有字节点元素。

右键选中想要监听的DOM节点弹出菜单，鼠标停在Break on...，会出现三个子菜单：
1. Subtree modifications，在该DOM结点及其子结点的结构有变动时中断。
2. Attributes modifications，在该DOM结点（不包括其子结点）的属性有所变化时中断，可以用在找出某个属性或者class是由哪段代码添加或修改的，尤其是在修改JS插件时非常省事；
3. node removal，在该DOM结点被移除出DOM树时中断。

###Elements-Styles、Elements-Computed
一个DOM节点最终的CSS可能会被很多段CSS代码所影响，例如在Elements-Styles里就列出了所有对目标DOM节点有影响的CSS代码：可是这样一个一个来看，实在是很烦，那chrome有没有能总结出最终CSS的功能呢？chrome也是有的，藏在Elements-Computed里了，由于不是默认展开的面板，所以一直没能引起注意。关于这个功能，有个比较常用的场景，那就是查看一段文字的字体。

Elements面板右侧的Style编辑器中，点击颜色十六进制编码前的小色块，会弹出一个调色板：可以自定义颜色值，也可以使用拾色器进行取色，调色板下方可以选择Material Design的主要色系。

###Source

快速定位到行，快捷键Ctrl+O (Mac:CMD+O)，输入:行号:列号来进行定位
Ctrl+O快捷键也意味着在打开调试工具后快速定位到Source面板

在Sources面板中选择一个资源文件进行编辑，如css文件，通过按住Ctrl键可以添加多个编辑光标，同时对多处进行编辑。按下Ctrl+U可以撤销编辑。

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

       https://wappalyzer.com/  Wappalyzer 探测网站正在使用的开源软件技术，web开发者必备利器
       Wappalyzer = Appspector + Web Server Notifier Web + Technology Notifier

#技巧
chrome://flags/ 
