18章 脚本化http
---------------

超文本传输协议（HyperTextTransferProtocol，HTTP）规定web浏览器如何从web服务器获取文档和向Web服务器提交表单内容，以及web服务器如何响应这些请求和提交。web浏览器会处理大量http。通常，http并不在脚本的控制下，只是当用户单击链接、提交表单和输入url时才发生。

但是，用javascript操纵http是可行的。当用脚本设置window对象的location属性或调用表单对象的submit()方法时，都会初始化http请求。在这两种情况下，浏览器会加载新页面。这种用脚本控制http的方法在多框架页面中非常有用，但这并非我们在此讨论的主题。相反，本章会说明在没有导致web浏览器重新加载任何窗口或窗体的内容情况下，脚本如何实现web浏览器与服务器之间的通信。

术语Ajax描述了一种主要使用脚本操纵http的web应用架构。ajax应用的主要特点是使用脚本操纵http和web服务器进行数据交换，不会导致页面重载。避免页面重载（这是web初期的标准做法）的能力使web应用感觉更像传统的桌面应用。web应用可以使用ajax技术把用户的交互数据记录到服务器中；也可以开始只显示简单的页面，之后按需加载额外的数据和页面组件来提升应用的启动时间。

ajax是Asynchronous Javascript and XML的缩写（未全部大写）。这个术语是Jesse James Carrett创造，最早出现在他于2005年发表的文章“Ajax:A New Approach to Web Applications”。“ajax”曾经是一个流行多年的术语，现在它只不过是一个有用的术语，来描述基于用脚本操纵http请求的web应用架构。

Comet是和使用脚本操纵http的web应用架构相关的术语。在某种意义上，Comet和Ajax相反。在comet中，web服务器发起通信并异步发送消息到客户端。如果web应用需要响应服务端发送的消息，则它使用ajax技术发送或请求数据。在ajax中，客户端从服务端“拉”数据，而在comet中，服务端向客户端“推”数据。comet还包括其他名词（如“服务器推”、“ajax推”和“http流”）。

comet这个名字是由Alex Russell在“comet:Low Latency Data for the Browser“中创造的。这个名字可能是对ajax开了个玩笑，comet和ajax都是美国的洗涤日用品牌。

实现ajax和comet的方式有很多种，而这些底层的实现有时称为传输协议（transport）。例如，img元素有一个src属性。当脚本设置这个属性为url时，浏览器发起的http get请求会从这个url下载图片。因此，脚本通过设置img元素的src属性，且把信息作为图片url的查询字符串部分，就把能经过编码信息传递给web服务器。web服务器实际上必须返回某个图片来作为请求结果，但它一定要不可见：例如，一个1*1像素的透明图片。这种类型的图片也称为网页信标（web bug）。当网页信标不是与当前网页服务器而是其他服务器交流信息时，会担心隐私内容。这种第三方网页信标的方式常用于统计点击次数和网站流量分析。

img元素无法实现完整的ajax传输协议，因为数据交换是单向的：客户端能发送数据到服务器，但服务器的响应一直是张图片导致客户端无法轻易从中提取信息。然而，iframe元素更加强大，为了把iframe作为ajax传输协议使用，脚本首先要把发送给web服务器的信息编码到url中，然后设置iframe的src属性为该url。服务器能创建一个包含响应内容的html文档，并把它返回给web浏览器，并且在iframe中显示它。iframe需要对用户不可见，例如可以使用css隐藏它。脚本通过遍历iframe的文档对象来读取服务器端的响应。注意，这种访问受限于13.6.2节介绍的同源策略问题。

实际上，script元素的src属性能设置url并发起http-get请求。使用script元素实现脚本操纵http是非常吸引人的，因为它们可以跨域通信而不受限于同源策略。通常，使用基于script元素的ajax传输协议时，服务器的响应采用json编码（见6.9节）的数据格式，当执行脚本时，javascript解析器能自动将其“编码”。由于它使用json数据格式，因此这种ajax传输协议也叫做“jsonp”。

虽然在iframe和script传输协议之上能实现ajax技术，但通常还有更简单的方式。一段时间以来，所有浏览器都支持XMLHttpRequest对象，它定义了用脚本操纵http的api。除了常用的get请求，这个api还包含实现post请求的能力，同时它能用文本或document对象的形式返回服务器的响应。虽然它的名字叫XMLHttpRequestAPI，但并没有限定只能使用XML文档，它能获取任何类型的文本文档。18.1节涵盖XMLHttpRequestAPI和本章的大部分。本章大部分ajax示例都将使用XMLHttpRequest对象来实现协议方案，我们也将在18.2节演示如何使用基于script的传输协议，因为script元素有规避同源限制的能力。

Ajax中的X表示XML，这个http（XMLHttpRequest）的主要客户端API在其名字中突出了XML，并且后面我们将看到XMLHttpRequest对象的其中一个属性叫responseXML。它看起来像说明XML是用脚本操纵HTTP的重要部分，但实际上它不是，这些名字只是XML流行时的遗迹。当然，ajax技术能和xml文档一起工作，但使用xml只是一种选择，实际上很少使用。XMLHttpRequest规范列出了这个令人困惑名字的不足之处：对象名XMLHttpRequest是为了兼容web，虽然这个名字的每个部分都可能造成误导。首先，这个对象支持包含XML在内的任何基于文本的格式。其次，它能用于HTTP和HTTPS请求（一些实现支持除了HTTP和HTTPS之外的协议，但规范不包括这些功能）。最后，它所支持的请求是一个广义的概念，指的是对于定义的HTTP方法的涉及HTTP请求或响应的所有活动。

Comet传输协议比Ajax更精妙，但都需要客户端和服务器之间建立（必要时重新建立）连接，同时需要服务器保持连接处于打开状态，这样它才能够发送异步信息。隐藏的iframe能像comet传输协议一样有用，例如，如果服务器以iframe中待执行的script的元素的形式发送每条消息。实现comet的一种更可靠跨平台方案是客户端建立一个和服务器的连接（使用ajax传输协议），同时服务器保持这个连接打开直到它需要推送一条消息。处理该消息之后，客户端马上为后续的消息推送建立一个新连接。

实现可靠的跨平台comet传输协议是非常有挑战性的，所以大部分使用comet架构的web应用开发者依赖于像Dojo这样的web框架库中的传输协议。在写本章时，浏览器正开始实现HTML5相关草案的Server-Sent事件，它用EventSource对象的形式定义了简单的comet-api。18.3节涵盖EventSource-API且演示了一个使用XMLHttpRequest实现的简单模拟示例。

在Ajax和Comet之上构建更高级的通信协议是可行的。例如，这些客户端／服务器技术可以用做RPC（Remote Procedure Call，远程过程调用）机制或发布／订阅事件系统的基础。

但是本章不会介绍像上面这样更高级的协议，我们重点在能使Ajax和Comet可用在API上。

**18.1使用XMLHttpRequest**

浏览器在XMLHttpRequest类上定义了它们的HTTP-API。这个类的每个实例都表示一个独立的请求／响应对，并且这个对象的属性和方法允许指定请求细节和提取响应数据。很多年前web浏览器就开始支持XMLHttpRequest，并且其API已经到了w3c制订标准的最后阶段。同时，w3c正在制订“2级XMLHttpRequest”标准草案。本节涵盖XMLHTTPRequest核心API，也包括当前至少被两款浏览器支持的部分2级XMLHttpRequest标准草案（我们将其称为XHR2）。

当然，使用这个HTTP-API必须要做的第一件事就是实例化XMLHttpRequest对象：

    var request ＝ new XMLHttpRequest();
    
你也能重用已存在的XMLHttpRequest，但注意这将会终止之前通过该对像挂起的任何请求。

IE6中的XMLHttpRequest:Microsoft最早把XMLHttpRequest对象引入到IE5中，且在IE5和IE6中它只是一个ActiveX对象。IE7之前的版本不支持非标准的XMLHttpRequest()构造函数，但它能像如下这样模拟：
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

一个http请求由4部分组成：

*  http请求方法或“动作”（web）
* 正在请求的url
* 一个可选的请求头集合，其中可能包括身份验证信息
* 一个可选的请求主体

服务器返回的http响应包含3部分：

* 一个数字和文字组成的状态码，用来显示请求的成功和失败
* 一个响应头集合
* 响应主体

接下来的前面两节会展示如何设置http请求的每个部分和如何查询http响应的每个部分，随后的核心章节会涵盖更多的专门议题。

http的基础请求／响应架构非常简单且易于使用。但在实践中会有各种各样随之而来的复杂问题：客户端和服务器交换cookie，服务器重定向浏览器到其他服务器，缓存某些资源而剩下的不缓存，某些客户端通过代理服务器发送所有的请求等。XMLHttpRequestAPI不是协议级的HTTP-API而是浏览器级的API。浏览器需要考虑cookie，重定向，缓存和代理。但代码只需要担心请求和响应。

XMLHttpRequest和本地文件，网页中可以使用相对url的能力通常意味着我们能使用本地文件系统来开发和测试html，并避免对web服务器进行不必要的部署。然后当使用XMLHttpRequest进行ajax编程时，这通常是不可行的。XMLHttpRequest用于同http和https协议一起工作。理论上，它能够同像ftp这样的其他协议一起工作，但比如像请求方法和响应状态码等部分api是http特有的。如果从本地文件中加载网页，那么该页面中的脚本将无法通过相对url使用XMLHttpRequest，因为这些url将相对于file://url而不是http://url。而同源策略通常会阻止使用绝对http://url（请参见18.1.6节）。如果是当使用XMLHttpRequest时，为了测试它们通常必须把文件上传到web服务器（或运行一个本地服务器）。

18.1.1指定请求

创建XMLHttpRequest对象之后，发起http请求的下一步是调用XMLHttpRequest对象的open()方法去指定这个请求的两个必需部分：方法和URL。
```
    rquest.open("GET",      //开始一个HTTP GET请求
                "data.csv");//URL的内容
```
open()第一个参数指定http方法或者动作。这个字符串不区分大小写，但通常大家用大写字母来匹配HTTP协议。“GET”和“POST”方法是得到广泛支持的。
“GET”用于常规请求，它适用于当url完全指定请求资源，当请求对服务器没有任何副作用以及当服务器的响应是可缓存时。“POST”方法常用于html表单。它在请求主体中包含额外数据（表单数据）且这些数据常存储到服务器上的数据库中（副作用）。相同url的重复post请求从服务器得到的响应可能不同，同时不应该缓存使用这个方法的请求。除了“GET”和“POST”之外，XMLHttpRequest也允许把“DELETE”、“HEAD”、“OPTIONS”和“PUT”作为open()的第一个参数。（“HTTP CONNECT”、“TRACE”和“TRACK”因为安全风险已被明确禁止。）旧浏览器并不支持所有的这些方法，但至少“HEAD”得到了广泛支持，例18-13演示如何使用它。

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
```
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
```
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
表单数据同样可以通过GET请求来提交，既然表单提交的目的是为了执行只读查询，因此POST请求比POST请求更合适。（当提交表单的目标仅仅是一个只读查询，GET比POST更合适。）GET请求从来没有主体，所以需要发送给服务器的表单编码数据“负载”要作为URL（后跟一个问号）的查询部分。encodeFormData()工具函数也能用于这种GET请求，且例18-6演示了如何使用它。

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

注意：例18-8不曾为请求设置“Content-Type”头。当给send()方法传入XML文档时，并没有预先指定“Content-Type”头，但XMLHttpRequest对象会自动设置一个合适的头。（类似地，如果给send()传入一个字符串但没有指定Content-Type头，那么XMLHttpRequest将会添加“ext/plain;charset=UTF-8”头。）在例18-1的代码中显式设置了这个头，但实际上对于纯文本的请求主体并不需要这么做。

4.上传文件

HTML表单的特性之一是当用户通过input属性type="file"元素选择文件时，表单将在它产生的POST请求主体中发送文件内容。HTML表单始终能上传文件，但到目前为止它还不能使用XMLHttpRequestAPI做相同的事情。然后，XHR2API允许通过向send()方法传入File对象来实现上传文件。

没有File()对象构造函数，脚本仅能获得表示用户当前选择文件的File对象。在支持File对象的浏览器中，每个input属性type="file"元素有一个files属性，它是File对象中的类数组对象。拖放API（参见17.7节）允许通过拖放事件的dataTransfer.files属性访问用户“拖放”到元素上的文件。我们将在22.6节和22.7节看到更多关于File对象的内容。但现在来讲，可以将它当做一个用户选择文件完全不透明的表示形式，适用于通过send()来上传文件。例18-9是一个自然的javascript函数，它对某些文件上传元素添加了change事件处理程序，这样它们能自动把任何选择过的文件内容通过POST方法自动发送到指定的URL。

例18-9：使用HTTP-POST请求上传文件
```
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

**18.2借助[script]发送http请求：jsonp**



**18.3基于服务器端推送事件的comet技术**


