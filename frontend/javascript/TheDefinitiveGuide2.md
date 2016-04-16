#第二部分 客户端javascript

本书第二部分主要讲解javascript是如何在web浏览器中实现的，这些章节介绍了大量的脚本宿主对象，这些对象可以表示浏览器窗口、文档树和文档的内容等。这些章节同样涵盖重要的web应用所需的网络编程API、本地存储和检索数据、画图等。

第13章web浏览器中的javascript
-----------------------

本书第一部分介绍了javascript语言核心。第二部分开始转向web浏览器中javascript的讨论，通常称为客户端javascript。迄今为止，我们多看到的大部分例子虽然是合法的javascript代码，但是却没有特定的上下文，也就是说它们不过是一些运行在不明环境中的代码片段。本章提供了一个可以运行javascript的上下文。

在开始讨论javascript之前，有必要先思考一下在web浏览器中是如何呈现web页面的。一些呈现静态信息的页面，叫做文档（document）（由于加入了javascript，静态页面的信息看上去会动来动去，但信息本身是静态的），相对于文档来说，其他web页面则感觉上更像是应用。如果需要的话，这些页面可以动态载入新的信息，因此看起来更加图形化，而非文本化，并且它们可以进行离线操作，以及保存数据到本地，以便再次访问时进行状态恢复。此外，还有其他web页面处于文档和应用的中间，结合了两者的特性。

本章以客户端javascript概述开始，包括一个简单的例子，以及对javascript在web文档和web应用中角色的讨论。概述内容还介绍了哪些内容在后续章节中会有，接下来会详细解释javascript代码在html文档中是如何嵌入并执行的，然后还会介绍兼容性，可访问性和安全性等问题。

**13.1客户端javascript**

window对象是所有客户端javascript特性和API的主要接入点。它表示web浏览器的一个窗口或窗体，并且可以用标识符window来引用它。window对象定义了一些属性，比如，指代Location对象的location属性，Location对象指定当前显示在窗口中的URL，并允许脚本往窗口里载入新的URL：
```javascript
//设置location属性，从而跳转到新的web页面
window.location = "http://www.oreilly.com/";
```
window对象还定义了一些方法，比如alert()，可以弹出一个对话框用来显示一些信息。还有setTimeout()，可以注册一个函数，在给定的一段时间之后触发一个回调：
```javascript
//等待两秒，然后说 hello
setTimeout(function() {alert("hello world");}, 2000);
```
注意上面的代码并没有显式地使用window属性。在客户端javascript中，Window对象也是全局对象。这意味着Window对象处于作用域链的顶部，它的属性和方法实际上是全局变量和全局函数。Window对象有一个引用自身的属性，叫做window。如果需要引用窗口对象本身，可以用这个属性，但是如果只是想要引用全局窗口对象的属性，通常并不需要用到window。

Window对象还定义了很多其他重要的属性、方法和构造函数，参见第14章查看完整的细节。

Window对象中其中一个最重要的属性是document，它引用Document对象，后者表示显示在窗口中的文档。Document对象有一些重要方法，比如getElementById()，可以基于元素id属性的值返回单一的文档元素（表示HTML标签的一对开始/结束标记，以及它们之间的所有内容）：
```javascript
//查找id="timestamp"的元素
var timestamp = document.getElementById("timestamp");
```
getElementById()返回的Element对象有其他重要的属性和方法，比如允许脚本获取它们内容，设置属性值等：
```javascript
//如果元素为空，往里面插入当前的日期和时间
if(timestamp.firstChild == null)
    timestamp.appendChild(document.createTextNode(new Date().toString()));
```
查询、遍历和修改文档内容的方法会在15章介绍。

每个Element对象都有style和className属性，允许脚本指定文档元素的CSS样式，或修改应用到元素上的CSS类名。设置这些CSS相关的属性会改变文档元素的呈现：
```javascript
//显式修改目标元素的呈现
timestamp.style.backgroundColor = "yellow";
//或者只改变类，让样式表指定具体内容
timestamp.className = "highlight";
```
第16章会介绍style和className属性，以及其他CSS编程技术。

Window、Document和Element对象上另一个重要的属性集合是事件处理程序相关的属性。可以在脚本中为之绑定一个函数，这个函数会在某个事件发生时以异步的方式调用。事件处理程序可以让javascript代码修改窗口、文档和组成文档的元素的行为。事件处理程序的属性名是以单词“on”开始的，用法如下：
```javascript
//当用户单击timestamp元素时，更新它的内容
timestamp.onclick = function() { this.innerHTML = new Date().toString(); }
```
Window对象的onload处理程序是最重要的事件处理程序之一。当显示在窗口中的文档内容稳定并可以操作时会触发它。JavaScript代码通常封装在onload事件处理程序里。第17章将会详细讲述事件。例13-1是onload处理程序的演示，并展示了客户端javascript的实例代码，包括查询文档元素、修改css类和定义事件处理程序。这个例子的javascript代码是放置在html的script标签之内的，且在13.2节会对它进行解释。注意代码里的一个函数是在另一个函数里定义的。因为事件处理程序的广泛使用，使得嵌套函数在客户端javascript中非常普遍。

例13-1显示内容的简单客户端javascript

```html
<!DOCTYPE html>
<html>
<head>
<style>
/* CSS styles for this page 本页的CSS样式表 */
/* Children of class="reveal" are  not shown  class="reveal"的元素的子元素都不显示*/
.reveal * { display: none; }  
/* Except for the class="handle" child  除了class="handle"的元素*/
.reveal *.handle { display: block;} 
</style>
<script>
// Don't do anything until the entire document has loaded
// 所有的页面逻辑在onload事件之后启动
window.onload = function() {
    // Find all container elements with class "reveal"
    // 找到所有class名为“reveal”的容器元素
    var elements = document.getElementsByClassName("reveal");
    for(var i = 0; i < elements.length; i++) {  // For each one... 对每个元素进行遍历
        var elt = elements[i];
        // Find the "handle" element with the container
        // 找到容器中的“handle”元素
        var title = elt.getElementsByClassName("handle")[0];
        // When that element is clicked, reveal the rest of the content
        // 当单击这个元素时，呈现剩下的内容
        title.onclick = function() {
            if (elt.className == "reveal") elt.className = "revealed";
            else if (elt.className == "revealed") elt.className = "reveal";
        }
    }
};
</script>
</head>
<body>
<div class="reveal">
<h1 class="handle">Click Here to Reveal Hidden Text</h1>
<p>This paragraph is hidden. It appears when you click on the title.</p>
</div>
</body>
</html>
```

在本章的概要介绍中提到了，一些web页面感觉上像文档，而另一些则像应用。接下来的两节会探讨javascript在两种web页面类型里是如何使用的。

**13.1.1Web文档里的javascript**

javascript程序可以通过document对象和它包含的element对象遍历和管理文档内容。它可以通过操纵css样式和类，修改文档内容的呈现。并且可以通过注册适当的事件处理程序来定义文档元素的行为。内容、呈现和行为的组合，叫做动态HTML或DHTML，会在第15~17章里介绍。

Web文档里应当少量地使用javascript，因为javascript真正的角色是增强用户的浏览体验，使信息的获取和传递更容易。用户的体验不应依赖于javascript，但javascript可以增强体验，比如通过下面的方式：

* 创建动画和其他视觉效果，巧妙地引导和帮助用户进行页面导航。
* 对表格的列进行分组，让用户更容易地找到所需要的。
* 隐藏某些内容，当用户“深入”到内容里时，再逐渐展示详细信息。  



**13.1.2Web应用里的javascript**

在web文档中使用的javascript DHTML特性在web应用中都会用到，对于web应用来说，除了内容、呈现和操作API之外，还依赖web浏览器环境提供的更基础的服务。

要真正理解web应用，需要先认识到web浏览器已经有了很好的发展，现在已经不仅仅是作为显示文档的工具的角色了，而逐渐变成了一个简易的操作系统。想一下，传统操作系统允许组织桌面和文件夹里的图标（表示文件或应用）；web浏览器允许在工具栏和文件夹例组织书签（表示文档和web应用）。系统可以在一个窗口里运行多个应用；web浏览器可以在一个标签里显示多个文档。操作系统定义了很多底层网络API、提供绘制图像、保存文件等功能。web浏览器也定义底层网络API（第18章）、保存数据（第20章）和绘制图像（第21章）。

谨记web浏览器是简单操作系统的概念，这样就可以把web应用定义为用javascript访问更多浏览器提供的高级服务（比如网络、图像和数据存储）的web页面。高级服务里最有名的是XMLHttpRequest对象，后者可以对HTTP请求编程来启用网络。web应用使用这个服务从服务器获取新信息，而不用重新载入页面。类似这样的web应用通常叫做Ajax应用，Ajax构成了“web2.0”的脊梁。XMLHttpRequest会在第18章详细介绍。

HTML5标准（在撰写本书时还是草案）和相关标准为web应用定义了很多其他重要的API。这些API包括21章和第20章的数据存储和图像API，以及很多其他特性的API，如地理位置信息、历史管理和后台线程。在实现这些API之后，会开启一场Web应用的功能的革命。这些API会在第22章中介绍。

当然，javascript在web应用里会比在web文档里显得更加重要。javascript增强了web文档，但是设计良好的文档需要在禁用javascript后还能继续工作。web应用本质上就是javascript程序，后者使用由web浏览器提供的操作系统类型的服务，并且不用期望它们在禁用浏览器脚本后还能正常工作。（利用HTML表单提交的方式和服务器CGI脚本进行通信的交互式web页面，是原始的“web应用”，可以不用javascript来实现。但是，我们不会在本书中讨论这种web应用类型。）

**13.2在html里嵌入javascript**

在html文档里嵌入客户端javascript代码有4种方法：

* 内联，放置在script标签对之间。
* 放置在由script标签的src属性指定的外部文件中。
* 放置在html事件处理程序中，该事件处理程序由onclick或onmouseover这样的html属性指定。
* 放在一个URL里，这个url使用特殊的“javascript:”协议。  


接下来的小节会逐一解释这4种javascript嵌套技术。但是，值得注意的是，html事件处理程序属性的javascript:URL这两种方式在现代javascript代码里已经很少使用（它们在web早期多少有点通用）。内联脚本（没有src属性）也比它们之前用得少了。有个编程哲学叫“Unobtrusive JavaScript”，主张内容（html）和行为（javascript代码）应该尽量地保持分离。根据这个编程哲学，javascript最好通过script元素的src属性来嵌入HTML文档里。Unobtrusive（不显眼） JavaScript是一种将Javascript从HTML结构中抽离的设计概念，避免在HTML标签中夹杂一堆onchange、onclick等属性去挂载javascript事件，让html与javascript分离，依MVC的原则将功能权贵区分清楚，使HTMl也变得结构化容易阅读。

**13.2.1<script>元素**

javascript代码可以以内联的形式出现在html文件里的script标签之间:

    <script> //这里是你的javascript代码</script>

在XHTML中，script标签中的内容被当做其他内容一样对待。如果javascript代码包含了“<”或“&”字符，那么这些字符就被解释成为XML标记。因此，如果要使用XHTML，最好把所有的javascript代码放入到一个CDATA部分里：

    <script><![CDATA[//这里是你的javascript代码]]></script>

例13-2展示了一个HTML文件，它包含简单的javascript程序。注释解释了这个程序是做什么的，但这个例子主要演示的是javascript代码以及css样式表是如何嵌入到html文件里。注意这个例子和例13-1的结构类似，并同样使用onload事件处理程序。

例13-2： 实现一个简单的javascript数字时钟程序

```html
<!DOCTYPE html>                 <!-- This is an HTML5 file 这是一个HTML5文件-->
<html>                          <!-- The root element 根节点-->
<head>                          <!-- Title, scripts & styles go here 标题、脚本和样式都放在这里 -->
<title>Digital Clock</title>
<script>                        // A script of js code ，js代码
// Define a function to display the current time
// 定义一个函数用以显示当前的时间
function displayTime() {
    var elt = document.getElementById("clock");  // Find element with id="clock"，通过id="clock"找到元素
    var now = new Date();                        // Get current time，得到当前时间
    elt.innerHTML = now.toLocaleTimeString();    // Make elt display it，让elt来显示它
    setTimeout(displayTime, 1000);               // Run again in 1 second，在1秒后再次执行
}
// Start displaying the time when document loads.
// 当onload事件发生时开始显示时间
window.onload = displayTime;  
</script>
<style>                         /* A CSS stylesheet for the clock  钟表的样式*/
#clock {                        /* Style apply to element with id="clock" 定义id="clock"的元素的样式*/
  font: bold 24pt sans;         /* Use a big bold font 使用粗体大号字*/
  background: #ddf;             /* On a light bluish-gray background 定义蓝灰色背景*/
  padding: 10px;                /* Surround it with some space 周围有一圈空白*/
  border: solid black 2px;      /* And a solid black border 定义纯黑色边框*/
  border-radius: 10px;          /* Round the corners (where supported) 定义圆角（如果浏览器支持的话）*/
}
</style>
</head>
<body>                    <!-- The body is the displayed parts of the doc. body部分是用来显示文档的-->
<h1>Digital Clock</h1>    <!-- Display a title 显示标题 -->
<span id="clock"></span>  <!-- The time gets inserted here 输出时钟-->
</body>
</html>
```

**13.2.2外部文件中的脚本**

script标签支持src属性，这个属性指定包含javascript代码的文件的url。它的用法如下：

    <script src="../../scripts/util.js"></script>

javascript文件的扩展名通常是以.js结尾的。它包含纯粹的javascript代码，其中既没有script标签，也没有其他html标签。

具有src属性的script标签的行为就像指定的javascript文件的内容直接出现在标签script之间一样。注意，即便指定了src属性并且script标签之间没有javascript代码，结束的script标签也是不能丢的。在XHTML中，在此处可以使用简短的script标签。

使用src属性时，script标签之间的任何内容都会忽略。如果需要，可以在<script>标签之间添加代码的补充说明文档或版权信息。但要注意，如果有任何非空格或javascript注释的文本出现在带src属性的script之间，HTML5校验器将会报错。

以下是src属性方式的一些优点：
* 可以把大块javascript代码从html文件中删除，这有助于保持内容和行为的分离，从而简化html文件。
* 如果多个web页面共用相同的javascript代码，用src属性可以让你只管理一份代码，而不用在代码改变时编辑每个html文件。
* 如果一个javascript代码文件由多个页面共享，就只需要下载它一次，通过使用它的第一个页面——随后的页面可以从浏览器缓存检索它。
* 由于src属性的值可以是任意的URL，因此来自一个web服务器的javascript程序或web页面可以使用由另一个服务器输出的代码。很多互联网广告依赖与此。
* 从其他网站载入脚本的能力，可以让我们更好地利用缓存，goolge正在为通用的客户端类库推广标准且好记的url，可以让浏览器只缓存一份副本，并且网络上的任意站点都可以使用。链接javascript代码到google服务器，可以减少web页面的启动时间，因为这些类库已经存在于用户的浏览器缓存中，但是你必须相信第三方提供的代码服务，这对于你的站点来说很关键。[参见](http://code.google.com/apis/ajaxlibs/)查看更多信息。

从文档服务器之外的服务器里载入脚本有重要的安全隐患。13.6.2节介绍的同源安全策略会阻止一个域的文档中的javascript和另一个域的内容进行交互。但是，要注意和脚本本身的来源并没有关系，而是和脚本嵌入的文档的来源有关系。因此，同源策略并不适用于如下情况：即便代码和文档有着不同的来源，javascript代码也可以和它嵌入的文档进行交互。当在页面中用src属性包含一个脚本时，就给了脚本作者（以及从中载入这段脚本的域的网站管理员）完全控制web页面的权限。

**13.2.3脚本类型**

javascript是web的原始脚本语言，而在默认的情况下，假定script元素包含或引用javascript代码。如果要使用不标准的脚本语言，如Microsoft的VBScript（只有IE支持），就必须用type属性指定脚本的MIME类型：

    <script type="text/vbscript">
    这里是VBScript代码
    </script>

type属性的默认值是“text/javascript”。如果需要，可以显式指定此类型，但这完全没必要。

老的浏览器在script标记上用language属性代替type属性，这种情况现在也会经常看到：

    <script language="javascript">
    //这里是javascript代码......
    </script>

language属性已经废弃，不应该再使用了。

当web浏览器遇到script元素，并且这个script元素包含其值不被浏览器识别的type属性时，它会解析这个元素但不会尝试显示或执行它的内容。这意味着可以使用script元素来嵌入任意文本数据到文档里，只要用type属性为数据声明一个不可执行的类型。要获取数据，可以用表示script元素（第15章会解释如何获取这些元素）的HTMLElement对象的text属性。但是，要注意这些数据嵌入技术只对内联脚本生效。如果同时指定src属性和一个未知的类型，那这个脚本会被忽略，并且不会从指定的url下载任何内容。

**13.2.4HTML中的事件处理程序**



**13.3javascript程序的执行**
**13.4兼容性和互用性**
**13.5可访问性**
**13.6安全性**
**13.7客户端框架**

window对象
----------
**14.1计时器**
**14.2浏览器定位和导航**
**14.3浏览历史**
**14.4浏览器和屏幕信息**
**14.5对话框**
**14.6错误处理**
**14.7作为window对象属性的文档元素**
**14.8多窗口和窗体**

脚本化文档
----------
**15.1dom概览**
**15.2选取文档元素**
**15.3文档结构和遍历**
**15.4属性**
**15.5元素的内容**
**15.6创建、插入和删除节点**
**15.7例子：生成目录表**
**15.8文档和元素的几何形状和滚动**
**15.9html表单**
**15.10其他文档特性**

脚本化css
---------
**16.1css概览**
**16.2重要的css属性**
**16.3脚本化内联样式**
**16.4查询计算出的样式**
**16.5脚本化css类**
**16.6脚本化样式表**

