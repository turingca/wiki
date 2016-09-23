第19章 jQuery类库
----------------

jQuery类库被广泛地使用，作为Web开发者，我们必须熟悉它，即便没有在自己的代码中使用它，也很有可能在他人写的代码中遇见。幸运的是，jQuery足够小巧和稳定。

jQuery能让你在文档中轻松找到关心的元素，并对这些元素进行操作：添加内容、编辑hmtl属性和css属性、定义事件处理程序，以及执行动画。它还拥有Ajax工具来动态地发起HTTP请求，以及一些通用的工具函数来操作对象和数组。

正如其名，jQuery类库聚焦于查询。一个典型查询使用css选择器来识别一组文档元素，并返回一个对象来表示这些元素。返回的对象提供了大量有用的方法来批量操作匹配的元素。这些方法会尽可能返回调用对象本身，这使得简洁的链式调用成为可能。jQuery如此强大和好用，关键得益于以下特性：

* 丰富强大的语法（css选择器），用来查询文档元素
* 高效的查询方法，用来找到与css选择器匹配的文档元素集
* 一套有用的方法，用来操作选中的元素
* 强大的函数式编程技巧，用来批量操作元素集，而不是每次只操作单个
* 简洁的语言用法（链式调用），用来表示一系列顺序操作

本章首先会介绍如何使用jQuery来实现简单查询并操作其结果。接下来的章节会讲解：
* 如何设置HTML属性，CSS样式和类、HTML表单的值和元素内容、位置高宽，以及数据
* 如何改变文档结构：对元素进行插入、替换、包装盒删除操作
* 如何使用jQuery的跨浏览器事件模型
* 如何用jQuery来实现动画视觉效果
* jQuery的Ajax工具，如何用脚本来发起HTTP请求
* jQuery的工具函数
* jQuery选择器的所有语法，以及如何使用jQuery的高级选择方法
* 如何使用和编写插件来对jQuery进行扩展
* jQuery UI类库

**19.1 jQuery基础**

jQuery类库定义了一个全局函数：jQuery()。该函数使用频繁，因此在类库中还给它定义了一个快捷别名：$。这是jQuery在全局命名空间中定义的唯一两个变量。（如果你在自己的代码中有使用$作为变量，或者引入了Prototype等使用$作为全局变量的类库，这时，为了避免冲突，可以调用jQuery.noConflict()来释放$变量，让其指向原始值。）

这个拥有两个名字的全局方法是jQuery的核心查询方法。例如，下面的代码能获取文档中的所有div元素：
```javascript
var divs = $("div");
```
该方法返回的值表示零个或多个DOM元素，这就jQuery对象。注意：jQuery()是工厂函数，不是构造函数，它返回一个新创建的对象，但并没有和new关键字一起使用。jQuery对象定义了很多方法，可以用来操作它们表示的这组元素，本章中的大部分文字将用来阐释这些方法。例如，下面这段代码可以用来找到所有拥有details类的p元素，将其高亮显示，并将其中隐藏的p元素快速显示出来：
```javascript
$("p.details").css("background-color", "yellow").show("fast");
```
上面的css()方法操作的jQuery对象是由$()返回的，css()方法返回的也是这个对象，因此可以继续调用show()方法，这就是链式调用，很简洁紧凑。在jQuery编程中，链式调用这个习惯用语很普遍。再举个例子，下面的代码可以找到文档中拥有“clicktohide”CSS类的所有元素，并给每一个元素都注册一个事件处理函数。当用户单击元素时，会调用事件处理程序，使得该元素缓慢向上收缩，最终消失：
```javascript
$(".clicktohide").click(function() { $(this).slideUp("slow"); });
```

**19.1.1jQuery()函数**

在jQuery类库中，最重要的方法是jQuery()方法（也就是$()）。它的功能很强大，有4种不同的调用方式。

第一种也是最常用的调用方式是传递css选择器（字符串）给$()方法。当通过这种方式调用时，$()方法会返回当前文档中匹配该选择器的元素集。jQuery支持大部分CSS3选择器语法，还支持一些自己的扩展语法。19.8.1节将详细阐述jQuery选择器语法。还可以将一个元素或jQuery对象作为第二参数传递给$()方法，这时返回的是该特定元素或元素集的子元素中匹配选择器的部分。这第二个参数是可选的，定义了元素查询的起始点，经常称为上下文（context）。

第二种调用方式是传递一个Element、Document或Window对象给$()方法。在这种情况下，$()方法只须简单地将

**19.2jquery的getter和setter**
**19.3修改文档结构**
**19.4使用jquery处理事件**
**19.5动画效果**
**19.6jquery中的ajax**
**19.7工具函数**
**19.8jquery选择器和选取方法**

在本章中，我们已经使用了带有简单CSS选择器的jQuery选取函数；$()。现在是时候深入了解jQuery选择器语法，以及一些提取和扩充选中元素集的方法了。

***19.8.1jQuery选择器***

在CSS3选择器标准草案定义的选择器语法中，jQuery支持相当完整的一套子集，同时还添加了一些非标准但很有用的伪类。15.2.5节描述过基本的CSS选择器。在此我们会重复一下，并增加对更多高级选择器的阐释。注意：本节描述的是jQuery选择器。其中有不少选择器（但不是全部）可以在CSS样式表中使用。

选择器语法有三层结构。你肯定已经见过选择器中最简单的形式。“#test”选取id属性为“test”的元素。“blockquote”选取文档中的所有blockquote元素，而“div.note”则选取所有class属性为“note”的div元素。简单选择器可以组合成“组合选择器”，比如“div.note>p”和“blockquote i”，只要用组合字符做分隔符就行。简单选择器和组合选择器还可以分组成逗号分隔的列表。这种选择器组是传递给$()函数最常见的形式。在解释组合选择器和选择器组之前，我们必须先了解简单选择器的语法。

1.简单选择器

简单选择器的开头部分（显式或隐式地）是标签类型声明。例如，如果只对p元素感兴趣，简单选择器可以用“p”开头。如果选取的元素和标签名无关，则可以使用通配符“*”号来代替。如果选择器没有以标签名或通配符开头，则隐式含有一个通配符。

标签名或通配符指定了备选文档元素的一个初始集。在简单选择器中，标签类型声明之后的部分由零个或多个过滤器组成。过滤器从左到右应用，和书写顺序一致，其中每一个都会缩小选中元素集。表19-1列举了jQuery支持的过滤器。

**19.9jQuery的插件扩展**

jQuery的写法使得添加新功能很方便。添加新功能的模块称为插件（plug-in），可以在这里找到很多插件： http://plugins.jquery.com 。jQuery插件是普通的Javascript代码文件，在网页中使用时，只需要script元素引入就好，就和引用任何其他javascript类库一样（注意，必须在jQuery之后引入插件）。

开发jQuery插件非常简单。关键点是要知道jQuery.fn是所有jQuery对象的原型对象。如果给该对象添加一个函数，该函数会成为一个jQuery方法。例子如下：
```javascript
jQuery.fn.println = funciton() {
    //将所有参数合并成空格分隔的字符串
    var msg = Array.prototype.join.call(arguments, "");
    //遍历jQuery对象中的每一个元素
    this.each(function() {
        //将参数字符串作为纯文本添加到每一个元素后面，并添加一个br
        jQuery(this).append(document.createTextNode(msg).append("<br/>"));
    });
    //返回这个未加修改的jQuery对象，以便链式调用
    return this;
}
```
通过上面对jQuery.fn.println()函数的定义，我们可以在任何jQuery对象上类似如下调用println()方法了：
```javascript
$("#debug").println("x = ", x, "; y = ", y);
```
这是添加新方法到jQuery.fn中的常见开发方式。如果发现自己在使用each()方法“手动”遍历jQuery对象中的元素，并在元素上执行某些操作时，就可以问问自己，是否可以将代码重构一下，使得这些each()回调移动到一个扩展方法里（jQuery插件的这种扩展方式是全局性的，带来方便的同时，也污染了jQuery对象，容易造成潜在的冲突。译者不推荐“随时随想”使用这种扩展方式）。在开发扩展功能时，如果遵守基本的模块化代码实践，以及遵守jQuery特定的一些传统约定，就可以将该扩展称为插件，并与他人分享。下面是一些值得留意的jQuery插件约定：

* 不要依赖$标识符：包含的页面有可能调用了jQuery.noConflict()函数，$()可能不再等同于jQuery()函数。在上面这种简短的插件里，只要使用jQuery代替$就行。如果开发的扩展很长，则最好用一个匿名函数将扩展代码都包装起来，以避免创建全局变量。如果这样做，可以将jQuery作为参数传递给匿名函数，参数名采用$:
```javascript
(function($) { //带有参数名为$的匿名函数
    //在此书写插件代码
}(jQuery)); //使用jQuery对象作为参数调用该匿名函数
```
* 如果插件代码不返回自己的值，请确保返回jQuery对象以便链式调用。通常这就是this对象，只要不加修改地返回即可。在上面的例子中，方法末尾是"return this;"代码行。遵循jQuery的另一个习俗，可以让上面的方法更简短些（可读性低一些）：返回each()方法的结果。这样，println()方法会包含代码"return this.each(function() {...});"。
* 如果扩展方式拥有两个以上参数或配置选项，请允许用户能使用对象的方式传递选项（就如我们在19.5.2节看到的animate()方法和在19.6.3节看到的jQuery.ajax()函数一样）。
* 不要污染jQuery方法的命名空间。优雅的jQuery插件会用一套有用的API定义最少量的方法。通常，一个jQuery插件只会在jQuery.fn上定义一个方法。该方法会接受字符串作为第一个参数，然后将该字符串作为函数名解析，然后将剩余参数传给该解析函数。当可以将插件限定为一个方法时，该方法名应该与插件同名。如果需要定义多个方法，则使用插件名作为每一个方法名的前缀。
* 如果插件需要绑定事件处理程序，请将所有这些处理程序放在事件命名空间中（参见19.4.4节）。使用插件名作为命名空间名。
* 如果插件需要使用data()方法与元素关联数据，请将所有数据值放在单一对象中，然后用与插件名相同的键值将该对象作为单一值存储。
* 用“jquery.plugin.js”这种文件命名方式保存插件代码到一个文件中（将“plugin”替换为插件名）

插件可以给jQuery自身增加函数来添加新的工具函数。例如：
```javascript
//该方法输出其参数（使用println()插件方法）
//到id为“debug”的元素上。如果不存在该元素，则创建一个并添加到文档中
jQuery.debug = function() {
    var elt = jQuery("#debug"); //查找#debug元素
    if (elt.length == 0) { //如果它不存在则创建之
        elt = jQuery("<div id='debug'><h1>Debugging Output</h1></div>");
        jQuery(document.body).append(elt);
    }
    elt.println.apply(elt, arguments); //将参数输出到元素中
}
```
除了定义新方法，还可以扩展jQuery类库的其他部分。例如，在19.5节中，我们已经看到可以通过给jQuery.fx.speeds添加属性来扩充新的动画时长名（除了“fast”和“slow”），也可以通过给jQuery.easing添加属性来添加新的缓动函数。插件甚至可以扩展jQuery的CSS选择器引擎！可以通过给jQuery.expr[':']对象添加属性来添加新的伪类过滤器（比如:first和:input）。下面这个例子定义了一个新的:draggable过滤器，可用来仅返回拥有draggable=true属性的元素：
```javascript
jQuery.expr[':'].draggable = function(e) {return e.draggable === true;};
```
使用上面定义的这个选择器，可以用$("img:draggable")来选取可拖曳的图片，而不用使用冗长的$("img[draggable=true]")。
从上面的代码中可以看到，自定义选择器函数的第一个参数是候选的DOM元素。如果该元素匹配选择器，则返回true；否则返回false。许多自定义选择器只需要这一个元素参数，但实际上在调用它们时传入了4个参数。第二个参数是整数序号，表示当前元素在候选元素数组中的位置。候选元素数组作为第4个参数传入，选择器不应该修改它。第三个参数很有趣的：这是调用RegExp.exec()方法后返回的数组。如果有的话，该数组的第4个元素（序号是3）是伪类过滤器后面的圆括号中的值。圆括号和里面的如何引号都去除了，只留下参数字符串。下面是一个例子，用来说明如何实现一个:data(x)伪类，该伪类只在元素拥有data-x属性时返回true（参考15.4.3节）：
```javascript
jQuery.expr[':'].data = function(element, index, match, array) {
    //注意，IE7及其以下版本不支持hasAttribute()
    return element.hasAttribute("data-" + match[3]);
};
```

**19.10 jQuery UI类库**

第20章 客户端存储
-----------------
**20.1 localstorage和sessionstorage**
**20.2 cookie**
**20.3 利用ie userdata持久化数据**
**20.4 应用程序存储和离线web应用**

第21章 多媒体和图形编程
----------------------
**21.1脚本化图片**
**21.2脚本化音频和视频**
**21.3svg:可伸缩的矢量图形**
**21.4[canvas]中的图形**

第22章 HTML5 API
----------------

**22.1地理位置**

**22.2历史纪录管理**

**22.3跨域消息传递**

**22.4web worker**

**22.5类型化数组和arraybuffer**

**22.6blob**

**22.7文件系统api**

**22.8客户端数据库**

**22.9web套接字**

第18章介绍过客户端javascript代码如何通过网络进行通信。该章中的例子都使用http协议，这也意味着它们受限于http协议的特性：它是一种无状态的协议，由客户端请求和服务端响应组成。http实际上是相对比较特殊的网络协议。大多数基于因特网（或者局域网）的网络连接通常都包含长连接和基于tcp套接字的双向消息交换。让不信任的客户端脚本访问底层的tcp套接字是不安全的，但是WebSocket API定义了一种安全方案：它允许客户端代码在客户端和支持websocket协议的服务器端创建双向的套接字类型的连接。这让某些网络操作会变得更加简单。
要通过使用javascript使用websocket，只须了解这里要介绍的websocket api。其中并没有用于书写一个websocket服务器的服务器端api，但是本节会有一个简单服务器例子，该例子使用node（见12.2节）和第三方的websocket服务器库来实现。客户端和服务器端的通信是通过tcp套接字长连接实现的，其遵循websocket协议定义的规则。关于websocket协议的细节这里不做详细介绍，但是，值得注意的是，websocket是经过精心设计的协议，实现让web服务器能够很容易地同时处理同一端口上的http连接和websocket连接。
很多浏览器提供商都实现了websocket。但是，由于发现早期草案版本的websocket协议有重要的安全漏洞，因此，一直到撰写本书时，有些浏览器在安全版本的协议未标准化之前，都将它们支持的websocket功能关闭了。比如，在firefox4中，要启用websocket功能，需要访问about:config页面，然后将配置变量“network.websocket.override-security-block”设置为true。

websocket api的使用非常简单。首先，通过websocket()构造函数创建一个套接字：

    var socket = new WebSocket("ws://ws.example.com:1234/resource");
    
创建了套接字之后，通常需要在上面注册一个事件处理程序：
```javascript
    socket.onopen = function(e){/*套接字已经连接*/};
    socket.onclose = function(e){/*套接字已经关闭*/};
    socket.onerror = function(e){/*出错了*/};
    socket.onmessage = function(e){
        var message = e.data;/*服务器发送一条消息*/
    };
```
为了通过套接字发送数据给服务器，可以调用套接字的send()方法：
```javascript
    socket.send("hello,server");
```
当前版本的websocket api仅支持文本消息，并且必须以UTF-8编码形式的字符串传递给该消息。然而，当前websocket协议还包含对二进制消息的支持，未来版本的api可能会允许在客户端和websocket服务器端进行二进制数据的交换。
当完成和服务器的通信之后，可以通过调用close方法来关闭websocket。
websocket完全是双向的，并且一旦建立了websocket连接，客户端和服务器端都可以在任何时候互相传送消息，与此同时，这种通信机制采用的不是请求和响应的形式。每个基于websocket的服务都要定义自己的“子协议”，用于在客户端和服务器端传输数据。慢慢的，这些“子协议”也可能发生演变，可能最终要求客户端和服务器端需要支持多个版本的子协议。幸运的是，websocket协议包含一种协商机制，用于选择客户端和服务器端都能“理解”的子协议。可以传递一个字符串数组给WebSocket()构造函数。服务器端会将该数组作为客户端能够理解的子协议列表。然后，它会选择其中一个使用，并将它传递给客户端。一旦连接建立之后，客户端就能够通过套接字protocol属性监测当前在使用的是哪种子协议。

1.8节介绍了EventSource API，并通过一个在线聊天的客户端和服务器展示了这些api如何使用。有了websocket，写这类应用就变得更加容易了。例22-16就是一个简单的聊天客户端：它和例18-5很像，不同的是它采用了websocket来实现双向通信，而没有使用EventSource来获取消息以及XMLHttpRequest来发送消息。

例22-16：基于WebSocket的聊天客户端：

```javascript
window.onload = function() {
    // Take care of some UI details，关心一些UI细节
    var nick = prompt("Enter your nickname");     // Get user's nickname，获取用户昵称
    var input = document.getElementById("input"); // Find the input field，查找input字段
    input.focus();                                // Set keyboard focus，设置光标
    // Open a WebSocket to send and receive chat messages on，打开一个websocket用于发送和接收聊天消息
    // Assume that the HTTP server we were downloaded from also functions as
    //假设下载的HTTP服务器作为websocket服务器运作，并且使用相同de主机名和端口
    // a websocket server, and use the same host name and port, but change
    //只是协议由http变成了ws
    // from the http:// protocol to ws://
    var socket = new WebSocket("ws://" + location.host + "/");
    // This is how we receive messages from the server through the web socket
    //下面展示了如何通过websocket从服务器获取消息
    socket.onmessage = function(event) {          // When a new message arrives，当收到一条消息
        var msg = event.data;                     // Get text from event object，从事件对象中获取消息内容
        var node = document.createTextNode(msg);  // Make it into a text node，将它标记为一个文本节点
        var div = document.createElement("div");  // Create a <div>，创建一个div
        div.appendChild(node);                    // Add text node to div，将文本节点添加到该div
        document.body.insertBefore(div, input);   // And add div before input，在input前添加该div
        input.scrollIntoView();                   // Ensure input elt is visible，确保输入框可见
    }
    // This is how we send messages to the server through the web socket
    //下面展示了如何通过websocket发送消息给服务器端
    input.onchange = function() {                 // When user strikes return，当用户敲击回车键
        var msg = nick + ": " + input.value;      // Username plus user's input，用户昵称加上用户的输入
        socket.send(msg);                         // Send it through the socket，通过套接字传递该内容
        input.value = "";                         // Get ready for more input，等待更多内容的输入
    }
};
```

```
//The chat UI is just a single, wide text input field 
//聊天窗口UI很简单，一个宽的文本输入框
// New chat messages will be inserted before this element 
// 新的聊天消息会插入到该元素中
<input id="input" style="width:100%"/>
```


例22-17是一个基于websocket的聊天服务器，运行在node中（见12.2节）。通过将该例和例18-17作比较，可以发现，websocket将聊天应用的服务器端简化成和客户端一样。

例22-17：使用websocket和node的聊天服务器

```javascript
/*
 * This is server-side JavaScript, intended to be run with NodeJS.这是运行在nodejs上的服务器端javascript
 * It runs a WebSocket server on top of an HTTP server, using an external
 *在HTTP服务器之上，它运行一个websocket服务器，该服务器使用自https://github.com/miksago/node-websocket-server/的第三方websocket库实现
 * websocket library from https://github.com/miksago/node-websocket-server/
 * If it gets an  HTTP request for "/" it returns the chat client HTML file.
 *如果得到“／”的一个HTTP请求，则返回聊天客户端的HTML文件
 * Any other HTTP requests return 404. Messages received via the 
 *除此之外任何HTTP请求都返回404
 * WebSocket protocol are simply broadcast to all active connections.
 *通过websocket协议接收到的消息都仅广播给所有激活状态的连接
 */
var http = require('http');            // Use Node's HTTP server API，使用node的HTTP服务器api
var ws = require('websocket-server');  // Use an external WebSocket library，使用第三方websocket库

// Read the source of the chat client at startup. Used below.
//启动阶段，读取聊天客户端的资源文件
var clientui = require('fs').readFileSync("wschatclient.html");

// Create an HTTP server，创建一个HTTP服务器
var httpserver = new http.Server();  

// When the HTTP server gets a new request, run this function
//当HTTP服务器获得一个新请求时，运行此函数
httpserver.on("request", function (request, response) {
    // If the request was for "/", send the client-side chat UI.
    //如果请求“／”，则返回客户端聊天UI
    if (request.url === "/") {  // A request for the chat UI，请求聊天UI
        response.writeHead(200, {"Content-Type": "text/html"});
        response.write(clientui);
        response.end();
    }
    else {  // Send a 404 "Not Found" code for any other request，对任何其他的请求返回404无法找到编码
        response.writeHead(404);
        response.end();
    }
});

// Now wrap a WebSocket server around the HTTP server，在HTTP服务器上包装一个websocket服务器
var wsserver = ws.createServer({server: httpserver});

// Call this function when we receive a new connection request，当调用一个新的连接请求的时候，调用此函数
wsserver.on("connection", function(socket) {
    socket.send("Welcome to the chat room."); // Greet the new client，向新客户端打招呼
    socket.on("message", function(msg) {      // Listen for msgs from the client，监听来自客户端的消息
        wsserver.broadcast(msg);              // And broadcast them to everyone，并将它们广播给每个人
    });
});

// Run the server on port 8000. Starting the WebSocket server starts the
//在8000端口运行服务器。启动websocket服务器的时候也会启动HTTP服务器。
// HTTP server as well. Connect to http://localhost:8000/ to use it.
//连接到http://localhost:8000/，并开始使用它
wsserver.listen(8000);
```


第三部分 javascript核心参考
---------------------------
参考文档：包括javascript语言核心定义的类、方法和属性。

| | | | |
|-------|--------|-----|--------|
|Arguments|EvalError|Number|String|
|Array|Function|Object|SyntaxError|
|Boolean|Global|RangeError|TypeError|
|Date|JSON|ReferenceError|URIError|
|Error|Math|RegExp| |


第四部分 客户端javascript核心参考
--------------------------------

javascript语言核心怎对文本、数组、日期和正则表达式的操作定义了很少的api，但是这些api不包括输入输出功能。输入和输出功能（类似网络、存储和图形相关的复杂特性）是由javascript所属的宿主环境提供的，这里所说的宿主环境通常是web浏览器，还有其他。
