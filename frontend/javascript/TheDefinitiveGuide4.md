18章 脚本化http
---------------

超文本传输协议（HyperTextTransferProtocol，HTTP）规定Web浏览器如何从Web服务器获取文档和向Web服务器提交表单内容，以及Web服务器如何响应这些请求和提交。Web浏览器会处理大量HTTP。通常，HTTP并不在脚本的控制下，只是当用户单击链接、提交表单和输入URL时才发生。

但是，用javascript操纵HTTP是可行的。当用脚本设置window对象的location属性或调用表单对象的submit()方法时，都会初始化HTTP请求。在这两种情况下，浏览器会加载新页面。这种用脚本控制HTTP的方法在多框架页面中非常有用，但这并非我们在此讨论的主题。相反，本章会说明在没有导致web浏览器重新加载任何窗口或窗体的内容情况下，脚本如何实现web浏览器与服务器之间的通信。

术语Ajax描述了一种主要使用脚本操纵http的web应用架构。Ajax应用的主要特点是使用脚本操纵HTTP和Web服务器进行数据交换，不会导致页面重载。避免页面重载（这是Web初期的标准做法）的能力使Web应用感觉更像传统的桌面应用。Web应用可以使用Ajax技术把用户的交互数据记录到服务器中；也可以开始只显示简单的页面，之后按需加载额外的数据和页面组件来提升应用的启动时间。

Ajax是Asynchronous Javascript and XML的缩写（未全部大写）。这个术语是Jesse James Carrett创造，最早出现在他于2005年发表的文章“Ajax:A New Approach to Web Applications”。“Ajax”曾经是一个流行多年的术语，现在它只不过是一个有用的术语，来描述基于用脚本操纵HTTP请求的Web应用架构。

Comet是和使用脚本操纵HTTP的Web应用架构相关的术语。在某种意义上，Comet和Ajax相反。在Comet中，Web服务器发起通信并异步发送消息到客户端。如果Web应用需要响应服务端发送的消息，则它使用Ajax技术发送或请求数据。在Ajax中，客户端从服务端“拉”数据，而在Comet中，服务端向客户端“推”数据。Comet还包括其他名词（如“服务器推”、“Ajax推”和“HTTP流”）。

Comet这个名字是由AlexRussell在“Comet:LowLatencyDatafortheBrowser“（http://infrequently.org/2006/03/comet-low-latency-data-for-the-browser/）中创造的。这个名字可能是对Ajax开了个玩笑，comet和ajax都是美国的洗涤日用品牌。

实现Ajax和Comet的方式有很多种，而这些底层的实现有时称为传输协议（transport）。例如，img元素有一个src属性。当脚本设置这个属性为url时，浏览器发起的HTTP GET请求会从这个URL下载图片。因此，脚本通过设置img元素的src属性，且把信息作为图片URL的查询字符串部分，就把能经过编码信息传递给web服务器。web服务器实际上必须返回某个图片来作为请求结果，但它一定要不可见：例如，一个1*1像素的透明图片。这种类型的图片也称为网页信标（web bug）。当网页信标不是与当前网页服务器而是其他服务器交流信息时，会担心隐私内容。这种第三方网页信标的方式常用于统计点击次数和网站流量分析。

img元素无法实现完整的Ajax传输协议，因为数据交换是单向的：客户端能发送数据到服务器，但服务器的响应一直是张图片导致客户端无法轻易从中提取信息。然而，iframe元素更加强大，为了把iframe作为Ajax传输协议使用，脚本首先要把发送给web服务器的信息编码到url中，然后设置iframe的src属性为该url。服务器能创建一个包含响应内容的html文档，并把它返回给web浏览器，并且在iframe中显示它。iframe需要对用户不可见，例如可以使用css隐藏它。脚本通过遍历iframe的文档对象来读取服务器端的响应。注意，这种访问受限于13.6.2节介绍的同源策略问题。

实际上，script元素的src属性能设置url并发起http-get请求。使用script元素实现脚本操纵http是非常吸引人的，因为它们可以跨域通信而不受限于同源策略。通常，使用基于script的Ajax传输协议时，服务器的响应采用JSON编码（见6.9节）的数据格式，当执行脚本时，javascript解析器能自动将其“编码”。由于它使用json数据格式，因此这种Ajax传输协议也叫做“JSONP”。

虽然在iframe和script传输协议之上能实现Ajax技术，但通常还有更简单的方式。一段时间以来，所有浏览器都支持XMLHttpRequest对象，它定义了用脚本操纵HTTP的API。除了常用的get请求，这个API还包含实现POST请求的能力，同时它能用文本或Document对象的形式返回服务器的响应。虽然它的名字叫XMLHttpRequestAPI，但并没有限定只能使用XML文档，它能获取任何类型的文本文档。18.1节涵盖XMLHttpRequestAPI和本章的大部分。本章大部分Ajax示例都将使用XMLHttpRequest对象来实现协议方案，我们也将在18.2节演示如何使用基于script的传输协议，因为script元素有规避同源限制的能力。

Ajax中的X表示XML，这个HTTP（XMLHttpRequest）的主要客户端API在其名字中突出了XML，并且后面我们将看到XMLHttpRequest对象的其中一个属性叫responseXML。它看起来像说明XML是用脚本操纵HTTP的重要部分，但实际上它不是，这些名字只是XML流行时的遗迹。当然，Ajax技术能和XML文档一起工作，但使用XML只是一种选择，实际上很少使用。XMLHttpRequest规范列出了这个令人困惑名字的不足之处：对象名XMLHttpRequest是为了兼容web，虽然这个名字的每个部分都可能造成误导。首先，这个对象支持包含XML在内的任何基于文本的格式。其次，它能用于HTTP和HTTPS请求（一些实现支持除了HTTP和HTTPS之外的协议，但规范不包括这些功能）。最后，它所支持的请求是一个广义的概念，指的是对于定义的HTTP方法的涉及HTTP请求或响应的所有活动。

Comet传输协议比Ajax更精妙，但都需要客户端和服务器之间建立（必要时重新建立）连接，同时需要服务器保持连接处于打开状态，这样它才能够发送异步信息。隐藏的iframe能像Comet传输协议一样有用，例如，如果服务器以iframe中待执行的script的元素的形式发送每条消息。实现comet的一种更可靠跨平台方案是客户端建立一个和服务器的连接（使用Ajax传输协议），同时服务器保持这个连接打开直到它需要推送一条消息。服务器每发送一条消息就关闭这个连接，这样可以确保客户端正确接收到消息。处理该消息之后，客户端马上为后续的消息推送建立一个新连接。

实现可靠的跨平台Comet传输协议是非常有挑战性的，所以大部分使用Comet架构的web应用开发者依赖于像Dojo这样的Web框架库中的传输协议。在写本章时，浏览器正开始实现HTML5相关草案的Server-Sent事件，它用EventSource对象的形式定义了简单的CometAPI。18.3节涵盖EventSource-API且演示了一个使用XMLHttpRequest实现的简单模拟示例。

在Ajax和Comet之上构建更高级的通信协议是可行的。
例如，这些客户端／服务器技术可以用做RPC（Remote Procedure Call，远程过程调用）机制或发布／订阅事件系统的基础。

但是本章不会介绍像上面这样更高级的协议，我们重点在能使Ajax和Comet可用的API上。

**18.1使用XMLHttpRequest**

浏览器在XMLHttpRequest类上定义了它们的HTTP-API。这个类的每个实例都表示一个独立的请求／响应对，并且这个对象的属性和方法允许指定请求细节和提取响应数据。很多年前Web浏览器就开始支持XMLHttpRequest，并且其API已经到了W3C制订标准的最后阶段。同时，W3C正在制订“2级XMLHttpRequest”标准草案。本节涵盖XMLHttpRequest核心API，也包括当前至少被两款浏览器支持的部分2级XMLHttpRequest标准草案（我们将其称为XHR2）。

当然，使用这个HTTP API必须要做的第一件事就是实例化XMLHttpRequest对象：

    var request ＝ new XMLHttpRequest();
    
你也能重用已存在的XMLHttpRequest，但注意这将会终止之前通过该对象挂起的任何请求。

IE6中的XMLHttpRequest：Microsoft最早把XMLHttpRequest对象引入到IE5中，且在IE5和IE6中它只是一个ActiveX对象。IE7之前的版本不支持非标准的XMLHttpRequest()构造函数，但它能像如下这样模拟：
```javascript
//在IE5和IE6中模拟XMLHttpRequest()构造函数
if (window.XMLHttpRequest === undefined) {
    window.XMLHttpRequest = function() {
        try {
            //如果可用，则使用ActiveX对象的最新版本
            return new ActiveXObject("Msxml2.XMLHTTP.6.0");
        }
        catch (e1) {
            try {
                //否则，回退到较旧的版本
                return new ActiveXObject("Msxml2.XMLHTTP.3.0");
            }
            catch (e2) {
                //否则，抛错
                throw new Error("XMLHttpRequest is not supported");
            }
        }
    };
}
```

一个HTTP请求由4部分组成：

* HTTP请求方法或“动作”（verb）
* 正在请求的URL
* 一个可选的请求头集合，其中可能包括身份验证信息
* 一个可选的请求主体

服务器返回的HTTP响应包含3部分：

* 一个数字和文字组成的状态码，用来显示请求的成功和失败
* 一个响应头集合
* 响应主体

接下来的前面两节会展示如何设置HTTP请求的每个部分和如何查询HTTP响应的每个部分，随后的核心章节会涵盖更多的专门议题。

HTTP的基础请求／响应架构非常简单并且易于使用。但在实践中会有各种各样随之而来的复杂问题：客户端和服务器交换cookie，服务器重定向浏览器到其他服务器，缓存某些资源而剩下的不缓存，某些客户端通过代理服务器发送所有的请求等。XMLHttpRequestAPI不是协议级的HTTPAPI而是浏览器级的API。浏览器需要考虑cookie，重定向，缓存和代理。但代码只需要担心请求和响应。

XMLHttpRequest和本地文件：网页中可以使用相对URL的能力通常意味着我们能使用本地文件系统来开发和测试HTML，并避免对Web服务器进行不必要的部署。然后当使用XMLHttpRequest进行Ajax编程时，这通常是不可行的。XMLHttpRequest用于同HTTP和HTTPS协议一起工作。理论上，它能够同像FTP这样的其他协议一起工作，但比如像请求方法和响应状态码等部分API是HTTP特有的。如果从本地文件中加载网页，那么该页面中的脚本将无法通过相对URL使用XMLHttpRequest，因为这些URL将相对于file://URL而不是http://URL。而同源策略通常会阻止使用绝对http://URL（请参见18.1.6节）。如果是当使用XMLHttpRequest时，为了测试它们通常必须把文件上传到Web服务器（或运行一个本地服务器）。

18.1.1 指定请求

创建XMLHttpRequest对象之后，发起http请求的下一步是调用XMLHttpRequest对象的open()方法去指定这个请求的两个必需部分：方法和URL。
```
    rquest.open("GET",      //开始一个HTTP GET请求
                "data.csv");//URL的内容
```
open()第一个参数指定HTTP方法或动作。这个字符串不区分大小写，但通常大家用大写字母来匹配HTTP协议。“GET”和“POST”方法是得到广泛支持的。
“GET”用于常规请求，它适用于当URL完全指定请求资源，当请求对服务器没有任何副作用以及当服务器的响应是可缓存时。“POST”方法常用于html表单。它在请求主体中包含额外数据（表单数据）且这些数据常存储到服务器上的数据库中（副作用）。相同URL的重复POST请求从服务器得到的响应可能不同，同时不应该缓存使用这个方法的请求。

除了“GET”和“POST”之外，XMLHttpRequest也允许把“DELETE”、“HEAD”、“OPTIONS”和“PUT”作为open()的第一个参数。（“HTTP CONNECT”、“TRACE”和“TRACK”因为安全风险已被明确禁止。）旧浏览器并不支持所有的这些方法，但至少“HEAD”得到了广泛支持，例18-13演示如何使用它。

open()的第2个参数是URL，它是请求主题。这是相对于文档的URL，这个文档包含调用open()的脚本。如果指定绝对URL、协议、主机和端口通常必须匹配所在文档的对应内容：跨域的请求通常会报错。（但是当服务器明确允许跨域请求时，2级XMLHttpRequest规范会允许它，见18.1.6节。）

如果有请求头的话，请求进程的下个步骤是设置它。例如，POST请求需要“Content-Type”头指定请求主题的MIME类型：
```
request.setRequestHeader("Content-Type", "text/plain");
```
如果对相同的头调用setRequestHeader()多次，新值不会取代之前指定的值，相反，HTTP请求将包含这个头的多个副本或这个头将指定多个值。

你不能自己指定“Content-Length”、“Date”、“Referer”或“User-Agent”头，XMLHttpRequest将自动添加这些头而防止伪造它们。类似地，XMLHttpRequest对象自动处理cookie、连接时间、字符集和编码判断，所以你无法向setRequestHeader()传递这些头：
```
Accept-Charset  Content-Transfer-Encoding TE
Accept-Encoding Date                      Trailer
Connection      Expert                    Transfer-Encoding
Content-Length  Host                      Upgrade
Cookie          Keep-Alive                User-Agent
Cookie2         Referer                   Via
```
你能为请求指定“Authorization”头，但通常不需要这么做。如果请求一个受密码保护的URL，把用户名和密码作为第4个和第5个参数传递给open()，则XMLHttpRequest将设置合适的头。（接下来我们将了解关于open()可选的第三个参数。可选的用户名和密码参数会在第四部分有介绍。）

使用XMLHttpRequest发起HTTP请求的最后一步是指定可选的请求主体并向服务器发送它。使用send()方法像如下这样做：
```
request.send(null);
```
GET请求绝对没有主体，所以应该传递null或省略这个参数。POST请求通常拥有主体，同时它应该匹配使用setRequestHeader()指定的“Content-Type”头。

顺序问题：HTTP请求的各部分有指定顺序：请求方法和URL首先到达，然后是请求头，最后是请求主体。XMLHttpRequest实现通常直到调用send()方法才开始启动网络。但XMLHttpRequest API的设计似乎使每个方法都将写入网络流。这意味着调用XMLHttpRequest方法的顺序必须匹配HTTP请求的架构。例如，setRequestHeader()方法的调用必须在调用open()之前但在调用send()之后，否则它将抛出异常。

例18-1使用了我们目前介绍的所有XMLHttpRequest方法。它用POST方法发送文本字符串给服务器，并忽略服务器返回的任何响应。

例18-1：用POST方法发送纯文本到服务器
```javascript
function postMessage(msg) {
    var request = new XMLHttpRequest();      // New request 新请求
    request.open("POST", "/log.php");        // POST to a server-side script 用POST向服务器发送脚本
    // Send the message, in plain-text, as the request body 用请求主体发送纯文本消息
    request.setRequestHeader("Content-Type", // Request body will be plain text 请求主体将是纯文本
                             "text/plain;charset=UTF-8");
    request.send(msg);                       // Send msg as the request body 把msg作为请求主体发送
    // The request is done. We ignore any response or any error 请求完成，我们将忽略任何响应和任何错误
}
```
注意例18-1中的send()方法启动请求，然后返回，当它等待服务器的响应时并不阻塞。接下来章节介绍的几乎都是异步处理HTTP响应。

**18.1.2取得响应**

一个完整的HTTP响应由状态码、响应头集合和响应主体组成。这些都可以通过XMLHttpRequest对象的属性和方法使用：

* status和statusText属性以数字和文本的形式返回HTTP状态码。这些属性保存标准的HTTP值，像200和“OK”表示成功请求，404和“NotFound”表示URL不能匹配服务器上的任何资源。
* 使用getResponseHeader()和getAllResponseHeaders()能查询响应头。XMLHttpRequest会自动处理cookie：它会从getAllResponseHeaders()头返回集合中过滤掉cookie头，而如果给getResponseHeader()传递“Set-Cookie”和“Set-Cookie2”则返回null。
* 响应主体可以从responseText属性中得到文本形式的，从responseXML属性中得到Document形式的。（这个属性名是有历史的：它实际上对XHTML和XML文档有效，但XHR2说它也应该对普通的HTML文档工作。）关于responseXML的更多内容请看18.1.2节下面的“2.响应解码”节。

XMLHttpRequest对象通常（除了见18.1.2节下面的“1.同步响应”节的内容）异步使用：发送请求后，send()方法立即返回，直到响应返回，前面列出的响应方法和属性才有效。为了在响应准备就绪时得到通知，必须监听XMLHttpRequest对象上的readystatechange事件（或者18.1.4节描述新的XHR进度事件）。但为了理解这个事件类型，你必须理解readyState属性。

readyState是一个整数，它指定了HTTP请求的状态，同时表18-1列出了它可能的值。第一列的符号是XMLHttpRequest构造函数定义的常量。这些常量是XMLHttpRequest规范的一部分，但老的浏览器和IE8没有定义它们，通常看到使用硬编码值4来表示XMLHttpRequest.DONE。

表18-1：XMLHttpRequest的readyState值

|常量|值|含义|
|----|---|---|
|UNSENT|0|open()尚未调用|
|OPENED|1|open()已调用|
|HEADERS_RECEIVED|2|接收到头信息|
|LOADING|3|接收到响应主体|
|DONE|4|响应完成|

理论上，每次readyState属性改变都会触发readystatechange事件。实际中，当readyState改变为0或1时可能没有触发这个事件。当调用send()时，即使readyState仍处于OPENED状态，也通常触发它。某些浏览器在LOADING状态时能触发多次事件来给出进度反馈。当readyState值改变为4或服务器的响应完成时，所有的浏览器都触发readystatechange事件。因为在响应完成之前也会触发事件，所以事件处理程序应该一直检验readyState值。

为了监听readystatechange事件，请把事件处理函数设置为XMLHttpRequest对象的onreadystatechange属性。也能使用addEventListener()（或在IE8以及之前版本中使用attachEvent()），但通常每个请求只需要一个处理程序，所以只设置onreadystatechange更容易。

例18-2定义了getText()函数来演示如何监听readystatechange事件。事件处理程序首先要确保请求完成。如果这样，它会检查响应状态码来确保请求成功。然后它查找“Content-Type”头来验证响应主体是否是期望的类型。如果3个条件都得到满足，它会把响主体（以文本形式）发送给指定的回调函数。

例18-2：获取HTTP响应的onreadystatechange
```javascript
// Issue an HTTP GET request for the contents of the specified URL.
// 发出一个HTTP GET请求以获得指定URL的内容
// When the response arrives successfully, verify that it is plain text
// 当响应成功到达，验证它是否是纯文本
// and if so, pass it to the specified callback function
// 如果是，把它传递给指定回调函数
function getText(url, callback) {
    var request = new XMLHttpRequest();         // Create new request 创建新情求
    request.open("GET", url);                   // Specify URL to fetch 指定待获取的URL
    request.onreadystatechange = function() {   // Define event listener 定义事件处理程序
        // If the request is compete and was successful 如果请求成功，则它是成功的
        if (request.readyState === 4 && request.status === 200) {
            var type = request.getResponseHeader("Content-Type");
            if (type.match(/^text/))            // Make sure response is text 确保响应是文本
                callback(request.responseText); // Pass it to callback 把它传递给回调函数
        }
    };
    request.send(null);                         // Send the request now 立即发送请求
}
```

1.同步响应

由于其本身的性质，异步处理HTTP响应是最好的方式。然而，XMLHttpRequest也支持同步响应。如果把false作为第3个参数传递给open()，那么send()方法将阻塞直到请求完成。在这种情况下，不需要使用事件处理程序：一旦send()返回，仅需要检查XMLHttpRequest对象的status和responseText属性。比较例18-2中getText()函数的同步代码：
```javascript
//发起同步的HTTP-GET请求以获得指定URL的内容
//返回响应文本，或如果请求不成功或响应不是文本就报错
function getTextSync(url) {
    var request = new XMLHttpRequest(); //创建新请求
    request.open("GET",url,false);  //传递false实现同步
    request.send(null);
    //如果请求不是200 OK，就报错
    if (request.status !== 200) throw new Error(request.statusText);
    //如果类型错误，就报错
    var type = request.getResponseHeader("Content-Type");
    if (!type.match(/^text/))
        throw new Error("Expected textual response; got: " + type);
    return request.responseText;
}
```
同步请求是吸引人的，但应该避免使用它们。客户端javascript是单线程的，当send()方法阻塞时，它通常会导致整个浏览器UI冻结。如果连接的服务器响应慢，那么用户的浏览器将冻结。然而，参见22.4节可接受的使用同步请求的场景。

2.响应解码

在前面的示例中，我们假设服务器使用像“text/plain”、“text/html”或“text/css”这样的的MIME类型发送文本响应，然后我们使用XMLHttpRequest对象的responseText属性得到它。

但是还是其他方式来处理服务器的响应。如果服务器发送XML或XHTML文档作为其响应，你能通过responseXML属性获得一个解析形式的XML文档。这个属性的值是一个Document对象，可以使用第15章介绍的技术搜索和遍历它。（XHR2草案规范指出浏览器也应该自动解析“text/html”类型的响应，使它们也能通过responseXML属性获取其Document文档对象，但在写本章时当前浏览器还没有这么做。）

如果服务器想发送诸如对象或数组这样的结构化数据作为其响应，它应该传输JSON编码（参见6.9节）的字符串数据。当接收它时，可以把responseText属性传递给JSON.parse()。例18-3是例18-2的归纳：它实现指定URL的GET请求并当URL的内容准备就绪时把它们传递给指定的回调函数。但它不是一直传递文本，而是传递Document对象或使用JSON.parse()编码的对象或字符串。

例18-3： 解析HTTP响应
```javascript
// Issue an HTTP GET request for the contents of the specified URL. 
// 发起HTTP-GET响应以获取指定URL的内容
// When the response arrives, pass it to the callback function as a 
// parsed XML Document object, a JSON-parsed object, or a string.
// 当响应到达时，把它以解析后的XML Document对象、解析后的JSON对象或字符串形式传递给回调函数
function get(url, callback) {
    var request = new XMLHttpRequest();         // Create new request 创建新请求
    request.open("GET", url);                   // Specify URL to fetch 指定待获取的URL
    request.onreadystatechange = function() {   // Define event listener 定义事件监听器
        // If the request is compete and was successful 如果请求完成且成功
        if (request.readyState === 4 && request.status === 200) {
            // Get the type of the response 获得响应的类型
            var type = request.getResponseHeader("Content-Type");
            // Check type so we don't get HTML documents in the future
            // 检查类型，这样我们不能在将来得到HTML文档
            if (type.indexOf("xml") !== -1 && request.responseXML) 
                callback(request.responseXML);              // Document response Document对象响应
            else if (type === "application/json")
                callback(JSON.parse(request.responseText)); // JSON response JSON响应
            else 
                callback(request.responseText);             // String response 字符串响应
        }
    };
    request.send(null);                         // Send the request now 立即发送请求
}
```
例18-3检查该响应的“Content-Type”头且专门处理“application/json”影响。你可能希望特殊编码的另一个响应类型是“application/javascript”或“text/javascript”。你能使用XMLHttpRequest请求javascript脚本，然后使用全局eval()（参见4.12.2节）执行这个脚本。但是，在这种情况下不需要使用XMLHttpRequest对象，因为script元素本身操纵HTTP脚本的能力完全可以实现加载并执行脚本。见示例13-4，且记住script元素能发起跨域HTTP请求，而XMLHttpRequestAPI则禁止。

web服务端通常使用二进制数据（例如，图片文件）响应HTTP请求。responseText属性只能用于文本，且它不能妥善处理二进制响应，即使对最终字符串使用了charCodeAt()方法。XHR2定义了处理二进制响应的方法，但在写本章时，浏览器厂商还没有实现它。进一步详情请参见22.6.2节。

服务器响应的正常解码是假设服务器为这个响应发送了“Content-Type”头和正确的MIME类型。例如，如果服务器发送XML文档但没有设置适当的MIME类型，那么XMLHttpRequest对象将不会解析它且设置responseXML属性。或者，如果服务器在“Content-Type”头中包含了错误的“charset”参数，那么XMLHttpRequest将使用错误的编码来解析响应，并且responseText中的字符可能是错的。XHR2定义了overrideMimeType()方法来解决这个问题，并且大量的浏览器已经实现了它。如果相对于服务器你更了解资源的MIME类型，那么在调用send()之前把类型传递给overrideMimeType()，这将使XMLHttpRequest忽略“Content-Type”头而使用指定的类型。假设你将下载XML文件，而你计划把它当成纯文本对待。可以使用setOverrideMimeType()让XMLHttpRequest知道它不需要把文件解析成XML文档：
```
//不要把响应作为XML文档处理
request.overrideMimeType("text/plain; charset=utf-8")
```

**18.1.3编码请求主体**

HTTP-POST请求包含一个请求主体，它包含客户端传递给服务器的数据。在例18-1中，请求主体是简单的文本字符串。但是，我们通常使用HTTP请求发送的都是更复杂的数据。本节演示这样做的一些方法。

1.表单编码的请求

考虑HTML表单。当用户提交表单时，表单中的数据（每个表单元素的名字和值）编码到一个字符串中并随请求发送。默认情况下，HTML表单通过POST方法发送给服务器，而编码后的表单数据则用做请求主体。对表单数据使用的编码方案相对简单：对每个表单元素的名字和值执行普通的URL编码（使用十六进制转义码替换特殊字符），使用等号把编码后的名字和值分开，并使用“&”符号分开名/值对。一个简单表单的编码像如下这样：
```
find=pizza&zipcode=02134&radius=1km
```
表单数据编码格式有一个正式的MIME类型：
```
application/x-www-form-urlencoded
```
当使用POST方法提交这种顺序的表单数据时，必须设置“Content-Type”请求头为这个值。

注意，这种类型的编码并不需要HTML表单，在本章我们实际上将不需要直接使用表单。在Ajax应用中，你希望发送给服务器的很可能是一个javascript对象。（这个对象可能从HTML表单的用户输入中得到，但这里不是问题。）前面展示的数据变成javascript对象的表单编码形式可能是：
```
{
    find:"pizza",
    zipcode:02134,
    radius:"1km"
}
```
表单编码在web上如此广泛使用，同时所有服务器端的编程语言都能得到良好的支持，所以非表单数据的表单编码通常也是容易实现的事情。例18-4展示了如何实现对象属性的表单编码。

例18-4：用于http请求的编码对象
```
/**
 * Encode the properties of an object as if they were name/value pairs from
 * an HTML form, using application/x-www-form-urlencoded format
 * 编码对象的属性，如果它们是来自HTML表单的名/值对，使用application/x-www-form-urlencode格式
 */
function encodeFormData(data) {
    if (!data) return "";    // Always return a string 一直返回字符串
    var pairs = [];          // To hold name=value pairs 为了保持名=值对
    for(var name in data) {                                  // For each name 为每个名字
        if (!data.hasOwnProperty(name)) continue;            // Skip inherited 跳过继承属性
        if (typeof data[name] === "function") continue;      // Skip methods 跳过方法
        var value = data[name].toString();                   // Value as string 把值转换成字符串
        name = encodeURIComponent(name.replace(" ", "+"));   // Encode name 编码名字
        value = encodeURIComponent(value.replace(" ", "+")); // Encode value 编码值
        pairs.push(name + "=" + value);   // Remember name=value pair 记住名=值对
    }
    return pairs.join('&'); // Return joined pairs separated with & 返回使用“&”连接的名/值对
}
```

使用已定义的encodeFormData()函数，我们能容易地写出像例18-5中的postData()函数这样的工具函数。需要注意的是，简单来说，postData()函数（在随后的示例中有相似的函数）不能处理服务器的响应。当响应完成，它传递整个XMLHttpRequest对象给指定的回调函数。这个回调函数负责检查响应状态码和提取响应文本。

例18-5：使用表单编码数据发起一个HTTP POST请求
```javascript
function postData(url, data, callback) {
    var request = new XMLHttpRequest();            
    request.open("POST", url);                    // POST to the specified url 对指定url发生post请求
    request.onreadystatechange = function() {     // Simple event handler 简单的事件处理程序
        if (request.readyState === 4 && callback) // When response is complete 当响应完成
            callback(request);                    // call the callback. 调用回调函数
    };
    request.setRequestHeader("Content-Type",      // Set Content-Type 设置Content-Type
                             "application/x-www-form-urlencoded");
    request.send(encodeFormData(data));           // Send form-encoded data 发送表单编码的数据
}
```
表单数据同样可以通过GET请求来提交，既然表单提交的目的是为了执行只读查询，因此GET请求比POST请求更合适。（当提交表单的目标仅仅是一个只读查询，GET比POST更合适。）GET请求从来没有主体，所以需要发送给服务器的表单编码数据“负载”要作为URL（后跟一个问号）的查询部分。encodeFormData()工具函数也能用于这种GET请求，且例18-6演示了如何使用它。

例18-6：使用表单编码数据发起GET请求
```javascript
function getData(url, data, callback) {
    var request = new XMLHttpRequest(); 
    request.open("GET", url +                     // GET the specified url 通过添加的编码数据获取指定的url
                 "?" + encodeFormData(data));     // with encoded data added
    request.onreadystatechange = function() {     // Simple event handler 简单事件处理程序
        if (request.readyState === 4 && callback) callback(request);
    };
    request.send(null);                           // Send the request 发送请求
}
```

HTML表单在提交的时候会对表单数据进行URL编码，但使用XMLHttpRequest能给我们编码自己想要的任何数据。随着服务器上的适当支持，我们的pizza查询数据将编码成一个更清晰的URL，如下：
```
http://restaurantfinder.example.com/02134/ikm/pizza
```

2.JSON编码的请求

在POST请求主体中使用表单编码是常见惯例，但在任何情况下它都不是HTTP协议的必需品。近年来，作为web交换格式的JSON已经得到普及。例18-7展示如何使用JSON.stringify()（参见6.9节）编码请求主体。注意这个示例和例18-5的不同仅在最后两行。

例18-7：使用JSON编码主体来发起HTTP-POST请求
```javascript
function postJSON(url, data, callback) {
    var request = new XMLHttpRequest();            
    request.open("POST", url);                    // POST to the specified url 对指定URL发送POST请求
    request.onreadystatechange = function() {     // Simple event handler 简单的事件处理程序
        if (request.readyState === 4 && callback) // When response is complete 当响应完成时
            callback(request);                    // call the callback. 调用回调函数
    };
    request.setRequestHeader("Content-Type", "application/json");
    request.send(JSON.stringify(data));
}
```

3.XML编码的请求

XML有时也用于数据传输的编码。javascript对象的用表单编码或JSON编码版本表达的pizza查询，也能用XML文档来表示它。例如，它看起来如下所示：
```
<query>
    <find zipcode="02134" radius="1km">
        pizza
    </find>
</query>
```
在目前展示的所有示例中，XMLHttpRequest的send()方法的参数是一个字符串或null。实际上，可以在这里传入XMLDocument对象。例18-8展示如何创建一个简单的XMLDocument对象并使用它作为HTTP请求的主体。

例18-8：使用XML文档作为其主体的HTTP POST请求
```javascript
// Encode what, where, and radius in an XML document and post them to the 
// 在XML中编码什么东西、在哪儿和半径，然后向指定的URL发送POST请求
// specified url, invoking callback when the response is received
// 当接收到响应时，调用回调函数
function postQuery(url, what, where, radius, callback) {
    var request = new XMLHttpRequest();            
    request.open("POST", url);                  // POST to the specified url 对指定的URL发送POST请求
    request.onreadystatechange = function() {   // Simple event handler 简单的事件处理程序
        if (request.readyState === 4 && callback) callback(request);
    };

    // Create an XML document with root element <query>
    var doc = document.implementation.createDocument("", "query", null);
    var query = doc.documentElement;            // The <query> element query元素
    var find = doc.createElement("find");       // Create a <find> element 创建find元素
    query.appendChild(find);                    // And add it to the <query> 并把它添加到query中
    find.setAttribute("zipcode", where);        // Set attributes on <find> 设置find的属性
    find.setAttribute("radius", radius);
    find.appendChild(doc.createTextNode(what)); // And set content of <find> 并设置find的内容

    // Now send the XML-encoded data to the server. 现在向服务器发送XML编码的数据
    // Note that the Content-Type will be automatically set. 注意将自动设置Content-Type头
    request.send(doc); 
}
```

注意：例18-8不曾为请求设置“Content-Type”头。当给send()方法传入XML文档时，并没有预先指定“Content-Type”头，但XMLHttpRequest对象会自动设置一个合适的头。（类似地，如果给send()传入一个字符串但没有指定Content-Type头，那么XMLHttpRequest将会添加“text/plain;charset=UTF-8”头。）在例18-1的代码中显式设置了这个头，但实际上对于纯文本的请求主体并不需要这么做。

4.上传文件

HTML表单的特性之一是当用户通过input属性type="file"元素选择文件时，表单将在它产生的POST请求主体中发送文件内容。HTML表单始终能上传文件，但到目前为止它还不能使用XMLHttpRequestAPI做相同的事情。然后，XHR2API允许通过向send()方法传入File对象来实现上传文件。

没有File()对象构造函数，脚本仅能获得表示用户当前选择文件的File对象。在支持File对象的浏览器中，每个input属性type="file"元素有一个files属性，它是File对象中的类数组对象。拖放API（参见17.7节）允许通过拖放事件的dataTransfer.files属性访问用户“拖放”到元素上的文件。我们将在22.6节和22.7节看到更多关于File对象的内容。但现在来讲，可以将它当做一个用户选择文件完全不透明的表示形式，适用于通过send()来上传文件。例18-9是一个自然的javascript函数，它对某些文件上传元素添加了change事件处理程序，这样它们能自动把任何选择过的文件内容通过POST方法自动发送到指定的URL。

例18-9：使用HTTP-POST请求上传文件
```javascript
// Find all <input type="file"> elements with a data-uploadto attribute
// 查找有data-uploadto属性的全部input属性type为file的元素
// and register an onchange handler so that any selected file is 
// 并注册onchange事件处理程序
// automatically POSTED to the specified "uploadto" URL. The server's
// 这样任何选择的文件都会自动通过POST方法发送到指定的“uploadto”URL
// response is ignored.
// 服务器的响应是忽略的
whenReady(function() {                        // Run when the document is ready 当文档准备就绪时运行
    var elts = document.getElementsByTagName("input"); // All input elements 所有的input元素
    for(var i = 0; i < elts.length; i++) {             // Loop through them 遍历它们
        var input = elts[i];
        if (input.type !== "file") continue;  // Skip all but file upload elts 跳过所有非文件上传元素
        var url = input.getAttribute("data-uploadto"); // Get upload URL 获取上传URL
        if (!url) continue;                   // Skip any without a url 跳过任何没有URL的元素

        input.addEventListener("change", function() {  // When user selects file 当用户选择文件时
            var file = this.files[0];         // Assume a single file selection 假设单个文件选择
            if (!file) return;                // If no file, do nothing 如果没有文件，不做任何事情
            var xhr = new XMLHttpRequest();   // Create a new request 创建新请求
            xhr.open("POST", url);            // POST to the URL 向这个url发送post请求
            xhr.send(file);                   // Send the file as body 把文件作为主体发送
        }, false);
    }
});
```

正如我们在22.6节所看到的，文件类型是更通用的二进制大对象（Blob）类型中的一个子类型。XHR2允许向send()方法传入任何Blob对象。如果没有显式设置Content-Type头，这个Blob对象的type属性用于设置待上传的Content-Type头。如果需要上传已经产生的二进制数据，可以使用22.5节和22.6.3节展示的技术把数据转化为Blob并将其作为请求主体。

5.multipart/form-data请求

当HTMl表单同时包含文件上传元素和其他元素时，浏览器不能使用普通的表单编码而必须使用称为“multipart/form-data”的特殊Content-Type来用POST方法提交表单。这种编码包括使用长“边界”字符串把请求主体分离成多个部分。对于文本数据，手动创建“multipart/form-data”请求主体是可能的，但很复杂。

XHR2定义了新的FormData API，它容易实现多部分请求主体。首先，使用FormData()构造函数创建FormData对象，然后按需多次调用这个对象的append()方法把个体“部分”（可以是字符串、File或Blob对象）添加到请求中。最后，把FormData对象传递给send()方法。send()方法将对请求定义合适的边界字符串和设置“Content-Type”头。例18-10演示了FormData的使用，同时我们将在例18-11再次看到它。

例18-10：使用POST方法发送multipart/form-data请求主体
```javascript
function postFormData(url, data, callback) {
    if (typeof FormData === "undefined")
        throw new Error("FormData is not implemented");

    var request = new XMLHttpRequest();            // New HTTP request 新HTTP请求
    request.open("POST", url);                     // POST to the specified url 对指定URL发送POST请求
    request.onreadystatechange = function() {      // A simple event handler. 简单的事件处理程序
        if (request.readyState === 4 && callback)  // When response is complete 当响应完成时
            callback(request);                     // ...call the callback. 调用回调函数
    };
    var formdata = new FormData();
    for(var name in data) {
        if (!data.hasOwnProperty(name)) continue;  // Skip inherited properties 跳过继承的属性
        var value = data[name];
        if (typeof value === "function") continue; // Skip methods 跳过方法
        // Each property becomes one "part" of the request. 每个属性变成请求的一个部分
        // File objects are allowed here 这里允许File对象
        formdata.append(name, value);              // Add name/value as one part 作为一部分添加名/值对
    }
    // Send the name/value pairs in a multipart/form-data request body. Each
    // 在multipart/form-data请求主体中发送名/值对
    // pair is one part of the request. Note that send automatically sets
    // 每对都是请求的一个部分，注意，当传入FormData对象时
    // the Content-Type header when you pass it a FormData object
    // send()会自动设置Content-Type头
    request.send(formdata);  
}
```

**18.1.4HTTP进度事件**

在之前的示例中，使用readystatechange事件探测HTTP请求的完成。XHR2规范草案定义了更多有用的事件集，有些已经在Firefox、Chrome和Safari中得到支持。在这个新的事件模型中，XMLHttpRequest对象在请求的不同阶段触发不同类型的事件，所以它不再需要检查readyState属性。

在支持它们的浏览器中，这些新事件会像如下这样触发。当调用send()时，触发单个loadstart事件。当正在加载服务器的响应时，XMLHttpRequest对象会发生progress事件，通常每隔50毫秒左右，所以可以使用这些事件给用户反馈请求的进度。如果请求快速完成，它可能从不会触发progress事件。当事件完成时，会触发load事件。

一个完成的请求不一定是成功的请求，例如，load事件的处理程序应该检查XMLHttpRequest对象的status状态码来确定收到的是“200 OK”而不是“404 NotFound”的HTTP响应。

HTTP请求无法完成有3种情况，对应3种事件。如果请求超时，会触发timeout事件。如果请求中止，会触发abort事件。（18.1.5节包含超时和abort方法的内容。）最后，像太多重定向这样的网络错误会阻止请求完成，但这些情况发生时会触发error事件。

对于任何具体请求，浏览器将只会触发load、abort、timeout和error事件中的一个。XHR2规范草案指出一旦这些事件中的一个发生后，浏览器应该触发loaded事件。但在写本章时，尚未有浏览器实现loadend事件。

可以通过XMLHttpRequest对象的addEventListener()方法为这些progress事件中的每个都注册处理程序。如果每种事件只有一个事件处理程序，通常更容易的方法是只设置对应的处理程序属性，比如onprogress和onload。甚至可以使用这些事件属性是否存在来测试浏览器是否支持progress事件：
```javascript
if("onprogress" in (new XMLHttpRequest())) {
    //支持progress事件
}
```

除了像type和timestamp这样常用的Event对象属性外，与这些progress事件相关联的事件对象还有3个有用的属性。loaded属性是目前传输的字节数值。total属性是自“Content-Length”头传输的数据的整体长度（单位是字节），如果不知道内容长度则为0。最后，如果知道内容长度则lengthComputable属性为true；否则为false。显然，total和loaded属性对progress事件处理程序相当有用：
```javascript
request.onprogress = function(e) {
    if (e.lengthComputable)
    progress.innerHTML = Math.round(100*e.loaded/e.total) + "% Complete";
}
```

上传进度事件

除了为监控HTTP响应的加载定义的这些有用的事件外，XHR2也给出了用于监控HTTP请求上传的事件。在实现这些特性的浏览器中，XMLHttpRequest对象将有upload属性。upload属性值是一个对象，它定义了addEventListener()方法和整个progress事件集合，比如onprogress和onload。（但upload对象没有定义onreadystatechange属性，upload仅能触发新的事件类型。）

你能仅仅像使用常见的progress事件处理程序一样使用upload事件处理程序。对于XMLHttpRequest对象X，设置X.onprogress以监控响应的下载进度，并且设置x.upload.onprogress以监控请求的上传进度。

例18-11演示了如何使用upload progress事件把上传进度反馈给用户。这个示例也演示了如何从拖放API中获得File对象和如何使用FormDataAPI在单个XMLHttpRequest请求中上传多个文件。在写本书时，这些功能依旧在草案中，并且这些示例不能在所有的浏览器中工作。

例18-11：监控HTTP上传进度
```javascript
// Find all elements of class "fileDropTarget" and register DnD event handlers
// 查找所有含有“fileDropTarget”类的元素
// to make them respond to file drops.  When files are dropped, upload them to 
// 并注册DnD事件处理程序使它们能够响应文件的拖放
// the URL specified in the data-uploadto attribute.
// 当文件放下时，上传它们到data-uploadto属性指定的URL
whenReady(function() {
    var elts = document.getElementsByClassName("fileDropTarget");
    for(var i = 0; i < elts.length; i++) {
        var target = elts[i];
        var url = target.getAttribute("data-uploadto");
        if (!url) continue;
        createFileUploadDropTarget(target, url);
    }

    function createFileUploadDropTarget(target, url) {
        // Keep track of whether we're currently uploading something so we can
        // 跟踪当前是否正在上传，因此我们能拒绝放下
        // reject drops. We could handle multiple concurrent uploads, but 
        // 我们可以处理多个并发上传
        // that would make progress notification too tricky for this example.
        // 但对这个例子使用进度通知太困难了
        var uploading = false; 

        console.log(target, url);

        target.ondragenter = function(e) {
            console.log("dragenter");
            if (uploading) return;  // Ignore drags if we're busy 如果正在忙，忽略拖放
            var types = e.dataTransfer.types;
            if (types && 
                ((types.contains && types.contains("Files")) ||
                 (types.indexOf && types.indexOf("Files") !== -1))) {
                target.classList.add("wantdrop");
                return false;
            }
        };
        target.ondragover = function(e) { if (!uploading) return false; };
        target.ondragleave = function(e) {
            if (!uploading) target.classList.remove("wantdrop");
        };
        target.ondrop = function(e) {
            if (uploading) return false;
            var files = e.dataTransfer.files;
            if (files && files.length) {
                uploading = true;
                var message = "Uploading files:<ul>";
                for(var i = 0; i < files.length; i++) 
                    message += "<li>" + files[i].name + "</li>";
                message += "</ul>";
                
                target.innerHTML = message;
                target.classList.remove("wantdrop");
                target.classList.add("uploading");
                
                var xhr = new XMLHttpRequest();
                xhr.open("POST", url);
                var body = new FormData();
                for(var i = 0; i < files.length; i++) body.append(i, files[i]);
                xhr.upload.onprogress = function(e) {
                    if (e.lengthComputable) {
                        target.innerHTML = message +
                            Math.round(e.loaded/e.total*100) +
                            "% Complete";
                    }
                };
                xhr.upload.onload = function(e) {
                    uploading = false;
                    target.classList.remove("uploading");
                    target.innerHTML = "Drop files to upload";
                };
                xhr.send(body);

                return false;
            }
            target.classList.remove("wantdrop");
        }
    }
});
```

**18.1.5中止请求和超时**

可以通过调用XMLHttpRequest对象的abort()方法来取消正在进行的HTTP请求。abort()方法在所有的XMLHttpRequest版本和XHR2中可用，调用abort()方法在这个对象上触发abort事件。（在写本章时，某些浏览器支持abort事件。可以通过XMLHttpRequest对象的“onabort”属性是否存在来判断。）

调用abort()的主要原因是完成取消或超时请求消耗的时间太长或当响应变得无关时。假设使用XMLHttpRequest为文本输入域请求自动完成推荐。如果用户在服务器的建议达到之前输入了新字符，这时等待请求不再有趣，应该中止。

XHR2定义了timeout属性来指定请求自动中止后的毫秒数，也定义了timeout事件用于当超时发生时触发（不是abort事件）。在写本章时，浏览器不支持这些自动超时（并且它们的XMLHttpRequest对象没有timeout和ontimeout属性）。可以用setTimeout()（参见14.1节）和abort()方法实现自己的超时。例18-12演示如何这么做。

例18-12：实现超时
```javascript
// Issue an HTTP GET request for the contents of the specified URL.
// 发起HTTP GET请求获取指定URL的内容
// If the response arrives successfully, pass responseText to the callback.
// 如果响应成功到达，传入responseText给回调函数
// If the response does not arrive in less than timeout ms, abort the request.
// 如果响应在timeout毫秒内没有到达，中止这个请求
// Browsers may fire "readystatechange" after abort(), and if a partial 
// 浏览器可能在abort()后触发"readystatechange"
// request has been received, the status property may even be set, so 
// 如果是部分请求结果到达，甚至可能设置status属性
// we need to set a flag so that we don't invoke the callback for a partial,
// 所以需要设置一个标记，当部分且超时的响应到达时不会调用回调函数
// timed-out response. This problem does not arise if we use the load event.
//如果使用load事件就没有这个风险
function timedGetText(url, timeout, callback) {
    var request = new XMLHttpRequest();         // Create new request. 创建新请求
    var timedout = false;                       // Whether we timed out or not. 是否超时
    // Start a timer that will abort the request after timeout ms. 启动计时器，在timeout毫秒后将中止请求
    var timer = setTimeout(function() {         // Start a timer. If triggered, 如果触发，其动一个计时器
                               timedout = true; // set a flag and then 设置标记
                               request.abort(); // abort the request. 然后中止请求
                           },
                           timeout);            // How long before we do this 中止请求之前的时长
    request.open("GET", url);                   // Specify URL to fetch 获取指定的URL
    request.onreadystatechange = function() {   // Define event listener. 定义事件处理程序
        if (request.readyState !== 4) return;   // Ignore incomplete requests. 忽略未完成的请求
        if (timedout) return;                   // Ignore aborted requests. 忽略中止请求
        clearTimeout(timer);                    // Cancel pending timeout. 取消等待的超时
        if (request.status === 200)             // If request was successful 如果请求成功
            callback(request.responseText);     // pass response to callback. 把response传给回调函数
    };
    request.send(null);                         // Send the request now 立即发送请求
}
```

**18.1.6跨域HTTP请求**

作为同源策略（参见13.6.2节）的一部分，XMLHttpRequest对象通常仅可以发起和文档具有相同的服务器的HTTP请求。这个限制关闭了安全漏洞，但它笨手笨脚并且也阻止了大量合适使用的跨域请求。可以在form和iframe元素中使用跨域URL，而浏览器显示最终的跨域文档。但因为同源策略，浏览器不允许原始脚本查找跨域文档的内容。使用XMLHttpRequest，文档内容都是通过responseText属性暴露，所以同源策略不允许XMLHttpRequest进行跨域请求。（注意script元素并未真正受限于同源策略：它加载并执行任何来源的脚本。如果我们看18.2节，跨域请求的灵活性使得script元素成为取代XMLHttpRequest的主流Ajax传输协议。）

XHR2通过在HTTP响应中选择发送合适的CORS（CrossOriginResourceSharing，跨域资源共享）允许跨域访问网站。在写本书时，Firefox、Safari、Chrome的当前版本都支持CORS，而IE8通过这里没有列出的专用XDomainRequest对象支持它。作为Web程序员，使用这个功能并不需要做什么额外的工作：如果浏览器支持XMLHttpRequest的CORS且实现跨域请求的网站决定使用CORS允许跨域请求，那么同源策略将不放宽而跨域请求会正常工作。

虽然实现CORS支持的跨域请求工作不需要做任何事情，但有一些安全细节需要了解。首先，如果给XMLHttpRequest的open()方法传入用户名和密码，那么它们绝对不会通过跨域请求发送（这使分布式密码破解攻击成为可能）。除外，跨域请求通常也不会包含其他任何的用户证书：cookie和HTTP身份验证令牌（token）通常不会作为请求的内容部分发送且任何作为跨域响应来接收的cookie都会丢弃。如果跨域请求需要这几种凭证才能成功，那么必须在用send()发送请求前设置XMLHttpRequest的withCredentials属性为true。这样做不常见，但测试withCredentials的存在性是测试浏览器是否支持CORS的一种方法。

示例8-13是常见的javascript代码，它使用XMLHttpRequest实现HTTP-HEAD请求以下载文档中a元素链接资源的类型、大小和时间等信息。这个HEAD请求按需发起，且由此产生的链接信息会出现在工具提示中。这个示例假设跨域链接的信息会出现在工具提示中。这个示例假设跨域链接的信息不可用，但通过支持CORS的浏览器尝试下载它。

例18-13：使用HEAD和CORS请求链接详细信息
```javascript
/**
 * linkdetails.js
 *
 * This unobtrusive JavaScript module finds all <a> elements that have an href
 * 这个常见的javascript模块查询有href属性但没有title属性的所有a元素
 * attribute but no title attribute and adds an onmouseover event handler to 
 * 并给它们注册onmouseover事件处理程序
 * them. The event handler makes an XMLHttpRequest HEAD request to fetch 
 * 这个事件处理程序使用XMLHttpRequestHEAD请求取得链接资源的详细信息
 * details about the linked resource, and then sets those details in the title
 * 然后把这些详细信息设置为链接的title属性
 * attribute of the link so that they will be displayed as a tooltip.
 * 这样它们将会在工具提示中显示
 */
whenReady(function() { 
    // Is there any chance that cross-origin requests will succeed?是否有机会使用跨域请求？
    var supportsCORS = (new XMLHttpRequest()).withCredentials !== undefined;

    // Loop through all links in the document 遍历文档中的所有链接
    var links = document.getElementsByTagName('a');
    for(var i = 0; i < links.length; i++) {
        var link = links[i];
        if (!link.href) continue; // Skip anchors that are not hyperlinks 跳过没有超链接的锚点
        if (link.title) continue; // Skip links that already have tooltips 跳过已经有工具提示的链接

        // If this is a cross-origin link 如果这是一个跨域链接
        if (link.host !== location.host || link.protocol !== location.protocol)
        {
            link.title = "Off-site link";  // Assume we can't get any more info 假设我们不能得到任何信息
            if (!supportsCORS) continue;   // Quit now if no CORS support 如果没有CORS支持就退出
            // Otherwise, we might be able to learn more about the link 否则，我们能了解这个链接的更多信息
            // So go ahead and register the event handlers so we can try. 所以继续前进，注册事件处理程序，于是我们可以尝试
        }

        // Register event handler to download link details on mouse over 注册事件处理程序，当鼠标悬停时下载链接详细信息
        if (link.addEventListener)
            link.addEventListener("mouseover", mouseoverHandler, false);
        else
            link.attachEvent("onmouseover", mouseoverHandler);
    }

    function mouseoverHandler(e) {
        var link = e.target || e.srcElement;      // The <a> element a元素
        var url = link.href;                      // The link URL 链接URL

        var req = new XMLHttpRequest();           // New request 新请求
        req.open("HEAD", url);                    // Ask for just the headers 仅仅询问头信息
        req.onreadystatechange = function() {     // Event handler 事件处理程序
            if (req.readyState !== 4) return;     // Ignore incomplete requests 忽略未完成的请求
            if (req.status === 200) {             // If successful 如果成功
                var type = req.getResponseHeader("Content-Type");   // Get  获取链接的详细情况
                var size = req.getResponseHeader("Content-Length"); // link
                var date = req.getResponseHeader("Last-Modified");  // details
                // Display the details in a tooltip. 在工具提示中显示详细信息
                link.title = "Type: " + type + "   \n" +  
                    "Size: " + size + "   \n" + "Date: " + date;
            }
            else {
                // If request failed, and the link doesn't already have an 如果请求失败，且链接没有“站外链接”的工具提示
                // "Off-site link" tooltip, then display the error. 那么显示这个错误
                if (!link.title)
                    link.title = "Couldn't fetch details: \n" +
                        req.status + " " + req.statusText;
            }
        };
        req.send(null);
        
        // Remove handler: we only want to fetch these headers once. 移除处理程序，仅想一次获取这些头信息
        if (link.removeEventListener)
            link.removeEventListener("mouseover", mouseoverHandler, false);
        else
            link.detachEvent("onmouseover", mouseoverHandler);
    }
});
```

**18.2借助script发送http请求：jsonp**

本章概述提到过script元素可以作为一种ajax传输机制：只须设置script元素的src属性（假如它还没插入到document中，需要插入进去），然后浏览器就会发送一个HTTP请求以下载src属性所指向的URL。使用script元素进行Ajax传输的一个主要原因是，它不受同源策略的影响，因此可以使用它们从其他的服务器请求数据，第二个原因是包含JSON编码数据的响应体会自动解码（即，执行）。

脚本和安全性：为了使用script元素进行Ajax传输，必须允许web页面可以执行远程服务器发送过来的任何javascript代码。这意味着对于不可信的服务器，不应该采取该技术。当与可信的服务器通信时，要提防攻击者可能进入服务器中，然后黑客会接管你的网页，运行他自己的代码，并显示任何他想要的内容，还表现得就像这些内容本就来自你的网站。

需要注意的是，这种方式普遍用于可信的第三方脚本，特别是在页面中嵌入广告和“组件”。作为Ajax传输使用的script与可信的web服务通信，没有比这更危险的了。

这种使用script元素作为ajax传输的技术称为JSONP，若HTTP请求所得到的响应数据是经过JSON编码的，则适合使用该技术。P代表“填充”或“前缀”——这个一会儿再作解释。

假设你写了一个服务，它处理GET请求并返回JSON编码的数据。同源的文档可以在代码中使用XMLHttpRequest和JSON.parse()，就像例18-3中的代码一样。假如在服务器上启用了CORS，在新的浏览器下，跨域的文档也可以使用XMLHttpRequest享受到该服务。在不支持CROS的旧浏览器下，跨域文档只能通过script元素访问这个服务。使用JSONP，JSON响应数据（理论上）是合法的javascript代码，当它到达时浏览器将执行它。相反，不使用JSONP，而是对JSON编码过的数据解码，结果还是数据，并没有做任何事情。

这就是JSONP中P的意义所在。当通过script元素调用数据时，响应内容必须用javascript函数名和圆括号包裹起来。而不是发送这样一段JSON数据：
```
[1,2,{"buckle":"my shoe"}]
```
它会发送这样一个包裹后的JSON响应：
```
handleResponse (
[1, 2, {"buckle": "my shoe"}]
)
```
包裹后的响应会成为script元素的内容，它先判断JSON编码后的数据（毕竟就是一个javascript表达式），然后把它传递给handleResponse()函数，我们可以假设，文档会拿这些数据做一些有用的事情。

为了可行起见，我们必须通过某种方式告诉服务，它正在从一个script元素调用，必须返回一个JSONP响应，而不应该是普通的JSON响应。这个可以通过在URL中添加一个查询参数来实现：例如，追加“?json”（或&json）。

在实践中，支持JSONP的服务不会强制指定客户端必须实现的回调函数名称，比如handleResponse。相反，它们使用查询参数的值，允许客户端指定一个函数名，然后使用函数名去填充响应。例18-14使用一个名为jsonp的查询参数来指定回调函数的名称。许多支持JSONP的服务都能分辨出这个参数名。另一个常见的参数名称是callback，为了让使用到的服务支持类似特殊的需求，就需要在代码上做一些修改了。

例18-14定义了一个getJSONP()函数，它发送JSONP请求。这个例子有点复杂，有几点值得注意。首先，注意它是如何创建一个新的script元素，设置其URL，并把它插入到文档中的。正是该插入操作触发HTTP请求。其次，注意例18-14为每个请求都创建了一个全新的内部回调函数，回调函数作为getJSONP()函数的一个属性存储起来。最后要注意的是回调函数做了一些必要的清理工作：删除脚本元素，并删除自身。

例18-14：使用script元素发送JSONP请求
```javascript
// Make a JSONP request to the specified URL and pass the parsed response
// 根据指定的URL发送一个JSONP请求
// data to the specified callback. Add a query parameter named "jsonp" to
// 然后把解析得到的响应数据传递给回调函数
// the URL to specify the name of the callback function for the request.
// 在URL中添加一个名为jsonp的查询参数，用于指定该请求的回调函数的名称
function getJSONP(url, callback) {
    // Create a unique callback name just for this request
    // 为本次请求创建一个唯一的回调函数名称
    var cbnum = "cb" + getJSONP.counter++; // Increment counter each time 每次自增计数器
    var cbname = "getJSONP." + cbnum;      // As a property of this function 作为JSONP函数的属性
    
    // Add the callback name to the url query string using form-encoding
    // 将回调函数名称以表单编码的形式添加到URL的查询部分中
    // We use the parameter name "jsonp".  Some JSONP-enabled services 
    // 使用jsonp作为参数名，一些支持JSONP的服务
    // may require a different parameter name, such as "callback".
    // 可能使用其他的参数名，比如callback
    if (url.indexOf("?") === -1)   // URL doesn't already have a query section URL没有查询部分
        url += "?jsonp=" + cbname; // add parameter as the query section 作为查询部分添加参数
    else                           // Otherwise, 
        url += "&jsonp=" + cbname; // add it as a new parameter. 作为新的参数添加它

    // Create the script element that will send this request 创建script元素用于发送请求
    var script = document.createElement("script");

    // Define the callback function that will be invoked by the script 定义将被脚本执行的回调函数
    getJSONP[cbnum] = function(response) {
        try {
            callback(response); // Handle the response data 处理响应数据
        }
        finally {               // Even if callback or response threw an error 即使回调函数或响应抛出错误
            delete getJSONP[cbnum];                // Delete this function 删除该函数
            script.parentNode.removeChild(script); // Remove script 移除script元素
        }
    };

    // Now trigger the HTTP request
    script.src = url;                  // Set script url 设置脚本的URL
    document.body.appendChild(script); // Add it to the document 把它添加到文档中
}

getJSONP.counter = 0;  // A counter we use to create unique callback names 用于创建唯一回调函数名称的计数器
```

**18.3基于服务器端推送事件的Comet技术**

在服务器端推送事件的标准草案中定义了一个EventSource对象，简化了Comet应用程序的编写可以传递一个URL给EventSource()构造函数，然后在返回的实例上监听消息事件。
```javascript
var ticker = new EventSource("stockprices.php");
ticker.onmessage = function(e) {
    var type = e.type;
    var data = e.data;
    //现在处理事件类型和事件的字符串数据
}
```
与message事件关联的事件对象有一个data属性，这个属性保存服务器作为该事件的负载发送的任何字符串。如同其他类型的事件一样，该对象还有一个type属性，默认值是message，事件源可以修改这个值。onmessage事件处理程序接收从一个给定的服务器事件源发出的所有事件，如果有必要，也可以根据type属性派发一个事件。

服务端推动事件的协议很简单。客户端（创建一个EventSource对象时会）建立一个到服务器的连接，服务器保持这个连接处于打开状态。当发生一个事件时，服务器端在连接中写入几行文本，抛给客户端的事件可能看起来是这样：
```
event:bid 设置时间对象的类型
data:GOOG 设置data属性
data:999  追加新的一行和更多的数据
          一个空行会触发消息事件
```
该协议还有一些额外的细节，比如允许事件携带给定ID，然后再次连上的客户端告诉服务器它收到的最后一个事件的ID，这样服务器就可以重新发送客户端错过的事件。但是这些细节在此处并不重要。

Comet架构的一个常见应用是聊天应用，聊天客户端可以通过XMLHttpRequest向聊天室发送新的消息，也可以通过EventSource对象订阅聊天信息。例18-15展示了使用EventSource写一个聊天客户端是多么容易。

例18-15：一个使用EventSource的简易聊天客户端
```
<script>
window.onload = function() {
    // Take care of some UI details 注意一些UI细节
    var nick = prompt("Enter your nickname");     // Get user's nickname 获取用户昵称
    var input = document.getElementById("input"); // Find the input field 找出input表单元素
    input.focus();                                // Set keyboard focus 设置键盘焦点
    // Register for notification of new messages using EventSource 通过EventSource注册新消息的通知
    var chat = new EventSource("/chat");
    chat.onmessage = function(event) {            // When a new message arrives 当捕获一条消息时
        var msg = event.data;                     // Get text from event object 从事件对象中取得文本数据
        var node = document.createTextNode(msg);  // Make it into a text node 把它放入一个文本节点
        var div = document.createElement("div");  // Create a <div> 创建一个div
        div.appendChild(node);                    // Add text node to div 将文本节点插入div中
        document.body.insertBefore(div, input);   // And add div before input 将div插入input之前
        input.scrollIntoView();                   // Ensure input elt is visible 保证input元素可见
    }
    // Post the user's messages to the server using XMLHttpRequest 使用XMLHttpRequest把用户的消息发送给服务器
    input.onchange = function() {                 // When user strikes return 用户完成输入
        var msg = nick + ": " + input.value;      // Username plus user's input 组合用户名和用户输入的信息
        var xhr = new XMLHttpRequest();           // Create a new XHR 创建新的XHR
        xhr.open("POST", "/chat");                // to POST to /chat. 发送到/chat
        xhr.setRequestHeader("Content-Type",      // Specify plain UTF-8 text  指明为普通的UTF-8文本
                             "text/plain;charset=UTF-8");
        xhr.send(msg);                            // Send the message 发送消息
        input.value = "";                         // Get ready for more input 准备下次输入
    }
};
</script>
<!-- The chat UI is just a single text input field 聊天的UI只是一个单行文本域 -->
<!-- New chat messages will be inserted before this input field 新的聊天消息会插入input域之前 -->
<input id="input" style="width:100%"/>
```

在写这本书的时候，Chrome和Safari已开始支持EventSource，Mozilla也准备在Firefox4.0之后的第一个版本中实现它。其XMLHttpRequest实现在下载过程中会（为readyState3）触发readystatechange事件的浏览器（例如FireFox），可以很容易地使用XMLHttpRequest模拟EventSource。例18-16展示了如何完成。配合这个模拟模块，例18-15就可以工作在Chrome、Safari和Firefox下了。（例18-16在IE或Opera下不可用，直到它们的XMLHttpRequest实现在下载过程中能够产生事件为止。）

例18-16：用XMLHttpRequest模拟EventSource
```javascript
// Emulate the EventSource API for browsers that do not support it.
// 在不支持EventSource API的浏览器里进行模拟
// Requires an XMLHttpRequest that sends readystatechange events whenever
// 需要有一个XMLHttpRequest对象在新数据写到长期存在的HTTP连接中时发送readystatechange事件
// there is new data written to a long-lived HTTP connection. Note that
// 注意，这个API的实现是不完整的
// this is not a complete implementation of the API: it does not support the
// 它不支持readyState属性、close()方法、open和error事件
// readyState property, the close() method, nor the open and error events.
// 消息事件也是通过onmessage属性注册的——这个版本还没有定义addEventListener()方法
// Also event registration for message events is through the onmessage 
// property only--this version does not define an addEventListener method.
if (window.EventSource === undefined) {     // If EventSource is not defined, 如果未定义EventSource对象
    window.EventSource = function(url) {    // emulate it like this. 像这样进行模拟
        var xhr;                        // Our HTTP connection... HTTP连接器
        var evtsrc = this;              // Used in the event handlers. 在事件处理程序中用到
        var charsReceived = 0;          // So we can tell what is new. 这样我们就可以知道什么是新的
        var type = null;                // To check property response type. 检查属性响应类型
        var data = "";                  // Holds message data 存放消息数据
        var eventName = "message";      // The type field of our event objects 事件对象的类型字段
        var lastEventId = "";           // For resyncing with the server 用于和服务器再次同步
        var retrydelay = 1000;          // Delay between connection attempts 在多个连接请求之间设置延迟
        var aborted = false;            // Set true to give up on connecting 设置为true表示放弃连接

        // Create an XHR object 创建一个XHR对象
        xhr = new XMLHttpRequest(); 

        // Define an event handler for it 定义一个事件处理程序
        xhr.onreadystatechange = function() {
            switch(xhr.readyState) {
            case 3: processData(); break;   // When a chunk of data arrives 当数据块到达时
            case 4: reconnect(); break;     // When the request closes 当请求关闭的时候
            }
        };

        // And establish a long-lived connection through it 通过connet()创建一个长期存在的连接
        connect();

        // If the connection closes normally, wait a second and try to restart
        // 如果连接正常关闭，等待1秒钟再尝试连接
        function reconnect() {
            if (aborted) return;             // Don't reconnect after an abort 在终止连接后不进行重连操作
            if (xhr.status >= 300) return;   // Don't reconnect after an error 在报错之后不进行重连操作
            setTimeout(connect, retrydelay); // Wait a bit, then reconnect 等待1秒后进行重连
        };

        // This is how we establish a connection 这里的代码展示了如何建立一个连接
        function connect() {
            charsReceived = 0; 
            type = null;
            xhr.open("GET", url);
            xhr.setRequestHeader("Cache-Control", "no-cache");
            if (lastEventId) xhr.setRequestHeader("Last-Event-ID", lastEventId);
            xhr.send();
        }

        // Each time data arrives, process it and trigger the onmessage handler
        // 每当数据到达的时候，会处理并触发onmessage处理程序
        // This function handles the details of the Server-Sent Events protocol
        // 这个函数处理Server-Send Events协议的细节
        function processData() {
            if (!type) {   // Check the response type if we haven't already 如果没有准备好，先检查响应类型
                type = xhr.getResponseHeader('Content-Type');
                if (type !== "text/event-stream") {
                    aborted = true;
                    xhr.abort();
                    return; 
                }
            }
            // Keep track of how much we've received and get only the  记录接收的数据
            // portion of the response that we haven't already processed. 获得响应中未处理的数据
            var chunk = xhr.responseText.substring(charsReceived);
            charsReceived = xhr.responseText.length;

            // Break the chunk of text into lines and iterate over them. 将大块的文本数据分成多行并遍历它们
            var lines = chunk.replace(/(\r\n|\r|\n)$/, "").split(/\r\n|\r|\n/);
            for(var i = 0; i < lines.length; i++) {
                var line = lines[i], pos = line.indexOf(":"), name, value="";
                if (pos == 0) continue;               // Ignore comments 忽略注释
                if (pos > 0) {                        // field name:value 字段名称：值
                    name = line.substring(0,pos);
                    value = line.substring(pos+1);
                    if (value.charAt(0) == " ") value = value.substring(1);
                }
                else name = line;                     // field name only 只有字段名称

                switch(name) {
                case "event": eventName = value; break;
                case "data": data += value + "\n"; break;
                case "id": lastEventId = value; break;
                case "retry": retrydelay = parseInt(value) || 1000; break; 
                default: break;  // Ignore any other line 忽略其他行
                }

                if (line === "") {  // A blank line means send the event 一个空行意味着发送事件
                    if (evtsrc.onmessage && data !== "") {
                        // Chop trailing newline if there is one 如果末尾有新行，就裁剪新行
                        if (data.charAt(data.length-1) == "\n")
                            data = data.substring(0, data.length-1);
                        evtsrc.onmessage({    // This is a fake Event object 这里是一个伪造的事件对象
                            type: eventName,  // event type 事件类型
                            data: data,       // event data 事件数据
                            origin: url       // the origin of the data 数据源
                        });
                    }
                    data = "";
                    continue;
                }
            }
        }
    };
}
```
我们通过一个服务器示例结束了Comet架构的探讨。例18-17展示了一个用服务器端javascript为Node编写的定制HTTP服务器。当一个客户端请求根URL“/”时，它会把例18-15里展示的聊天客户端代码和例18-16中的模拟代码发送到客户端。当客户端创建了一个指向URL“/chat”的GET请求时，它会用一个数组来保存响应数据流并保持连接处于打开状态。当客户端发起针对“chat”POST请求时，它会将响应的主体部分作为一条聊天消息使用并写入数据，以“data：”作为Server-Sent Events的前缀，添加到每个已打开的响应数据流上。如果安装了Node，那就可以在本地运行这个服务器例子。它监听8000端口，因此在启动服务器之后，就可以用浏览器访问http://localhost:8000来进行聊天。

例18-17：定制的Server-Sent Events聊天服务器
```javascript
// This is server-side JavaScript, intended to be run with NodeJS.
// 这个例子用的是服务器的Javascript，运行在NodeJS平台上
// It implements a very simple, completely anonymous chat room.
// 该聊天室的实现比较简单，而且是完全匿名的
// POST new messages to /chat, or GET a text/event-stream of messages
// 将新的消息以POST发送到/chat地址，或者以GET形式从同一个URL获取消息的文本/事件流
// from the same URL. Making a GET request to / returns a simple HTML file
// 创建一个GET请求到“/”来返回一个简单的HTML文件
// that contains the client-side chat UI.
// 这个文件包括客户端聊天UI
var http = require('http');  // NodeJS HTTP server API NodeJS HTTP服务器API

// The HTML file for the chat client. Used below.聊天客户端使用的HTML文件，在下面会用到
var clientui = require('fs').readFileSync("chatclient.html");
var emulation = require('fs').readFileSync("EventSourceEmulation.js");

// An array of ServerResponse objects that we're going to send events to
// ServerResponse对象数组，用于接收发送的事件
var clients = [];

// Send a comment to the clients every 20 seconds so they don't 每20秒发送一条注释到客户端
// close the connection and then reconnect 这样它们就不会关闭连接再重连
setInterval(function() {
    clients.forEach(function(client) {
        client.write(":ping\n");
    });
}, 20000);

// Create a new server 创建一个新服务器
var server = new http.Server();  

// When the server gets a new request, run this function
// 当服务器获取到一个新的请求，运行回调函数
server.on("request", function (request, response) {
    // Parse the requested URL 解析请求的URL
    var url = require('url').parse(request.url);

    // If the request was for "/", send the client-side chat UI.
    // 如果请求是发送到“/”，服务器就发送客户端聊天室UI
    if (url.pathname === "/") {  // A request for the chat UI 聊天客户端的UI请求
        response.writeHead(200, {"Content-Type": "text/html"});
        response.write("<script>" + emulation + "</script>");
        response.write(clientui);
        response.end();
        return;
    }
    // Send 404 for any request other than "/chat"
    // 如果请求是发送到“/chat”之外的地址，则返回404
    else if (url.pathname !== "/chat") {
        response.writeHead(404);
        response.end();
        return;
    }

    // If the request was a post, then a client is posting a new message
    // 如果请求类型是post，那么就有一个客户端发送了一条新的消息
    if (request.method === "POST") {
        request.setEncoding("utf8");
        var body = "";
        // When we get a chunk of data, add it to the body
        // 在获取数据之后，将其添加到请求主体中
        request.on("data", function(chunk) { body += chunk; });

        // When the request is done, send an empty response 
        // 当请求完成时，发送一个空响应
        // and broadcast the message to all listening clients.
        // 并将消息传播到所有处于监听状态的客户端中
        request.on("end", function() {
            response.writeHead(200);   // Respond to the request 响应该请求
            response.end();

            // Format the message in text/event-stream format
            // 将消息转换成文本/事件流格式
            // Make sure each line is prefixed with "data:" and that it is
            // 确保每一行的前缀都是“data:”
            // terminated with two newlines.
            // 并以两个换行符结束
            message = 'data: ' + body.replace('\n', '\ndata: ') + "\r\n\r\n";
            // Now send this message to all listening clients
            // 发送消息给所有监听的客户端
            clients.forEach(function(client) { client.write(message); });
        });
    }
    // Otherwise, a client is requesting a stream of messages
    else {
        // Set the content type and send an initial message event 
        // 如果不是POST类型的请求，则客户端正在请求一组消息
        response.writeHead(200, {'Content-Type': "text/event-stream" });
        response.write("data: Connected\n\n");

        // If the client closes the connection, remove the corresponding
        // 如果客户端关闭了连接
        // response object from the array of active clients
        // 从活动客户端数组中删除对应的响应对象
        request.connection.on("end", function() {
            clients.splice(clients.indexOf(response), 1);
            response.end();
        });

        // Remember the response object so we can send future messages to it
        // 记下响应对象，这样就可以向它发送未来的消息
        clients.push(response);
    }
});

// Run the server on port 8000. Connect to http://localhost:8000/ to use it.
// 启动服务器，监听8000端口，访问http://localhost:8000/来进行使用它
server.listen(8000);
```
