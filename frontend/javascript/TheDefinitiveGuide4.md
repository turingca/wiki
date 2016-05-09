第19章 jquery类库
----------------
jquery类库被广泛地使用，作为web开发者，我们必须熟悉它，即便没有在自己的代码中使用它，也很有可能在他人写的代码中遇见。幸运的是，jquery足够小巧和稳定。
jquery能让你在文档中轻松找到关心的元素，并对这些元素进行操作：添加内容、编辑hmtl属性和css属性、定义事件处理程序，以及执行动画。它还拥有ajax工具来动态地发起http请求，以及一些通用的工具函数来操作对象和数组。
正如其名，jquery类库聚焦于查询。一个典型查询使用css选择器来识别一组文档元素，并返回一个对象来表示这些元素。返回的对象提供了大量有用的方法来批量操作匹配的元素。这些方法会尽可能返回调用对象本身，这使得简洁的链式调用成为可能。jquery如此强大和好用，关键得益于以下特性：

* 丰富强大的语法（css选择器），用来查询文档元素
* 高效的查询方法，用来找到与css选择器匹配的文档元素集
* 一套有用的方法，用来操作选中的元素
* 强大的函数式编程技巧，用来批量操作元素集，而不是每次只操作单个
* 简洁的语言用法（链式调用），用来表示一系列顺序操作

**19.1jquery基础**

**19.2jquery的getter和setter**
**19.3修改文档结构**
**19.4使用jquery处理事件**
**19.5动画效果**
**19.6jquery中的ajax**
**19.7工具函数**
**19.8jquery选择器和选取方法**
**19.9jquery的插件扩展**
**19.10 jquery ui 类库**

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
