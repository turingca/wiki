第17章事件处理
-------------

客户端javascript程序采用了异步事件驱动编程模型（13.3.2节有介绍）。在这种程序设计风格下，当文档、浏览器、元素或与之相关的对象发生某些有趣的事情时，web浏览器就会产生事件（event）。例如，当web浏览器加载完文档、用户把鼠标指针移到超链接上或敲击键盘时，web浏览器都会产生事件。如果javascript应用程序关注特定类型的事件，那么它可以注册当这类事件发生时要调用的一个或多个函数。请注意，这种风格并不只应用于web编程，所有使用图形用户界面的应用程序都采用了它，它们静待某些事件发生（即，它们等待事件发生），然后它们响应。
请注意，事件本身并不是一个需要定义的技术名词。简而言之，事件就是web浏览器通知应用程序发生了什么事情。事件不是javascript对象，不会出现在程序源代码中。当然，会有一些事件相关的对象出现在源代码中，它们需要技术说明，因此，本章从一些重要的定义开始。
事件类型（event type）是一个用来说明发生什么类型事件的字符串。例如，“mousemove”表示用户移动鼠标，“keydown”表示键盘上某个按键被按下，而“load”表示文档（或某个其他资源）从网络上加载完毕。由于事件类型只是一个字符串，因此实际上会称之为事件名字（event name），我们用这个名字来标识所谈论的特定类型的事件。现代浏览器支持许多事件类型。17.1节会有一个概述。

**17.1事件类型**
**17.2注册事件处理程序**
**17.3事件处理程序的调用**
**17.4文档加载事件**
**17.5鼠标事件**
**17.6鼠标滚轮事件**
**17.7拖放事件**

例17-2展示了如何在应用中响应鼠标拖动。使用像那样的技术允许在网页中拖起和“放置”元素，但真正的“拖放”是另一回事。拖放（Drag-and-Drop，DnD）是在“拖放源（darg source）”和“拖放目标（drop target）”之间传输数据的用户界面，它可以存在相同应用之间也可是不同应用之间。
拖放是复杂的人机交互，用于实现拖放的API总是很复杂：

* 它们必须和底层OS结合，使它们能够在不相关的应用间工作。
* 它们必须适用于“移动”、“复制”和“链接”数据传输操作，允许拖放源和拖放目标通过设置限制允许的操作，然后让用户选择（通常使用键盘辅助键）许可设置
* 它们必须为拖放源提供一种方式指定待拖动的图标或图像。
* 它们必须为拖放源和拖放目标的DnD交互过程提供基于事件的通知。

在Microsoft在IE的早期版本引入了DnD API。它并不是精心设计且良好归档的API，但其他浏览器都尝试复制它，且HTML5标准化了类似IE DnD API的东西并增加了是API更易于使用的新特性。在写本章时，这些新的易于使用的DnD API尚未实现尚未实现，所以本节包括了IE API来表示对HTML5标准祝福。

IE DnD API难以使用以及当前浏览器的不同实现使得无法共同使用API一些较复杂的部分，但它允许web应用像普通的桌面应用一样参与应用间DnD。浏览器一直能够实现简单的DnD。如果在web浏览器中选择了文本，非常容易把文本拖到字处理器中。同时如果在字处理器中选择了选择一个URL，你能把它拖到浏览器中并使浏览器访问这个url。本节演示了如何创建自定义拖放源和自定义拖放目标，前者传输数据而不是其文本内容，后者以某种方式响应拖放数据而不是仅显示它。

DnD总是基于事件且javascript api包含两个事件集，一个在拖放源上触发，另一个在拖放目标上触发。所有传递给DnD事件处理程序的事件对象都类似鼠标事件对象，另外它拥有dataTransfer属性。这个属性引用DataTransfer对象，该对象定义DnD API的方法和属性。

拖放源事件相当简单，我们就从它们开始。任何有HTML draggable属性的文档元素都是拖放源。当用户开始用鼠标在拖放源上拖动时，浏览器并没有选择元素内容，相反，它在这个元素上触发dragstart事件。这个事件的处理程序就调用dataTransfer.setData()指定当前可用的拖放源数据（和数据类型）。（当新的HTML5 API实现时，可以用dataTransfer.items.add()代替。）这个事件处理程序也可以设置dataTransfer.effectAllowed来指定支持“移动”、“复制”和“链接”传输操作中的几种，同时它可以调用dataTransfer.setDragImage()或dataTransfer.addElement()（在那些支持这些方法的浏览器中）指定图片或文档元素用做拖动时的视觉表现。

在拖动的过程中，浏览器在拖放源上触发拖动事件。如果想更新拖动图片或修改提供的数据，可以监听这些事件，但一般不需要注册“拖动”事件处理程序。    

当放置数据发生时会触发dragend事件。如果拖放源支持“移动”操作，它就会检查dataTransfer.dropEffect去看看是否实际执行了移动操作。如果执行了，数据就被传输到其他地方，你应该从拖放源中删除它。

实现简单的自定义拖放源只需要dragstart事件。例17-4就是这样的例子，它在<span>元素中用“hh:mm”格式显示当前时间，并每分钟更新一次时间。假设这是示例要做的一切，用户能选择时钟中显示的文本，然后拖动这个时间。但在这个例子中javascript代码通过设置时钟元素的darggable属性为true和定义ondragstrat事件处理程序函数来使得时钟成为自定义拖放源。事件处理程序使用dataTransfer.setData()指定一个完整的时间戳字符串（包括日期、秒和时区信息）作为待拖动的数据。它还调用dataTransfer.setDragIcon()指定待拖动的图片（一个时钟图标）。

例17-4：一个自定义拖放源

```
<script src="whenReady.js"></script>
<script>
whenReady(function() {
    var clock = document.getElementById("clock");  // The clock element，时钟元素
    var icon = new Image();                        // An image to drag，用于拖动的图片
    icon.src = "clock-icon.png";                   // Image URL，图片URL
    // Display the time once every minute，每分钟显示一次时间
    function displayTime() {
        var now = new Date();               // Get current time，获取当前时间
        var hrs = now.getHours(), mins = now.getMinutes();
        if (mins < 10) mins = "0" + mins;
        clock.innerHTML = hrs + ":" + mins; // Display current time，显示当前时间
        setTimeout(displayTime, 60000);     // Run again in 1 minute，一分钟后将再次运行
    }
    displayTime();
    // Make the clock draggable，使时钟能够拖动
    // We can also do this with an HTML attribute: <span draggable="true">...
    //我们也能通过HTML属性实现这个目的：<span draggable="true">...
    clock.draggable = true;
    // Set up drag event handlers，设置拖动事件处理程序
    clock.ondragstart = function(event) {
        var event = event || window.event; // For IE compatability，用于IE兼容性
        // The dataTransfer property is key to the drag-and-drop API
        //dataTransfer属性是拖放API的关键
        var dt = event.dataTransfer;
        // Tell the browser what is being dragged，告诉浏览器正在拖动的是什么
        // The Date() constructor used as a function returns a timestamp string
        //把Date()构造函数用做一个返回时间戳字符串的函数
        dt.setData("Text", Date() + "\n");
        // Tell the browser to drag our icon to represent the timestamp, in
        // browsers that support that. Without this line, the browser may
        // use an image of the clock text as the value to drag.
        //在支持的浏览器中，告诉它拖动图标来表现时间戳
        if (dt.setDragImage) dt.setDragImage(icon, 0, 0);
    };
});
</script>
<style> 
#clock { /* Make the clock look nice 使时钟好看一些*/
    font: bold 24pt sans; background: #ddf; padding: 10px;
    border: solid black 2px; border-radius: 10px;
}
</style>
<h1>Drag timestamps from the clock从时钟中拖出时间戳</h1>
<span id="clock"></span>  <!-- The time is displayed here 时间显示在这里-->
<textarea cols=60 rows=20></textarea> <!-- You can drop timestamps here 把时间戳放置在这里-->
```

拖放目标比拖放源更棘手。任何文档元素都可以是拖放目标，这不需要像拖放源一样设置HTML属性，只需要简单地定义合适的事件监听程序。（但是使用新的HTML5 DnD API，就可以在拖放目标上定义dropzone属性来取代定义后面介绍的一部分事件处理程序。）有4个事件在拖放目标上触发。当拖放对象（dragged object）进入文档元素时，浏览器在这个元素上触发dragenter事件。拖放目标应该使用dataTransfer.types属性确定拖放对象的可用数据是否是它能理解的格式。（也可以检查dataTransfer.effectAllowed确保拖放源和拖放目标同意使用移动、复制和链接操作中的一个。）如果检查成功，拖放目标必须要让用户和浏览器都知道它对放置感兴趣。可以通过改变它的边框或背景颜色来向用户反馈。令人吃惊的是，拖放目标通过取消事件来告知浏览器它对放置感兴趣。

如果元素不取消浏览器发送给它的dragenter事件，浏览器将不会把它作为这次拖放的拖放目标，并不会向它再发送任何事件。但如果拖放目标取消了dragenter事件，浏览器将发送dragover事件表示用户继续在目标上拖动对象。再一次令人吃惊的是，拖放目标必须监听且取消所有这些事情来表明它继续对放置感兴趣。如果拖放目标想指定它只允许移动、复制或链接操作，它应该使用dragover事件处理程序来设置dataTransfer.dropEffect。

如果用户移动拖放对象离开通过取消事件表明有兴趣的拖放目标，那么在拖放目标上将触发dragleave事件。这个事件的处理程序应该恢复元素的边框或背景颜色或取消任何其他为响应dragenter事件而执行的可视化反馈。遗憾的是，dargenter和dragleave事件会冒泡，如果拖放目标内部有嵌套元素，想知道dragleave事件表示拖放对象从拖放目标离开到目标外的事件还是到目标内的事件是非常困难的。

最后，如果用户把拖放对象放置到拖放目标上，在拖放目标上会触发drop事件。这个事件的处理程序应该使用dataTransfer.getData()获取传输的数据并做一些适当的处理。另外，如果用户在拖放目标放置一或多个文件，dataTransfer.files属性将是一个类数组的File对象。（见例18-11的说明。）使用新的HTML5 API，drop事件处理程序将能遍历dataTransfer.items[]的元素去检查文件和非文件数据。

例17-5演示如何使ul元素成为拖放目标，同时如何使它们中的li元素成为拖放源。这个示例是一段不唐突的javascript代码（英文为Unobtrusive Javascript，在网页中编写javascript的一种通用方法），它查找class属性包含“dnd”的ul元素，在它找到的此类列表上注册DnD事件处理程序。这些事件处理程序使列表本身成为拖放目标，在这个列表上放置的任何文本会变成新的列表项并插入到列表尾部。这些事件处理程序也监听列表项的拖动，使得每个列表项的文本可用于传输。拖放源事件处理程序允许“复制”和“移动”操作，并在移动操作下放置对象时会删除原有列表项。（但是，请注意并不是所有的浏览器都支持移动操作。）

例17-5：作为拖放目标和拖放源的列表

```
/*
 * The DnD API is quite complicated, and browsers are not fully interoperable.
 * This example gets the basics right, but each browser is a little different
 * and each one seems to have its own unique bugs. This code does not attempt
 * browser-specific workarounds.
 * DnD API相当复杂，且浏览器也不完全兼容
 * 这个例子基本正确，但每个浏览器会有一点不同，每个似乎都有自身独有的bug
 * 这些代码不会尝试浏览器独有的解决方案
 */
whenReady(function() {  // Run this function when the document is ready，当文档准备就绪时运行这个函数

    // Find all <ul class='dnd'> elements and call the dnd() function on them
    // 查找所有的<ul class='dnd'>元素，并对其调用dnd()函数
    var lists = document.getElementsByTagName("ul");
    var regexp = /\bdnd\b/;
    for(var i = 0; i < lists.length; i++)
        if (regexp.test(lists[i].className)) dnd(lists[i]);

    // Add drag-and-drop handlers to a list element
    // 为列表元素添加拖放事件处理程序
    function dnd(list) {
        var original_class = list.className;  // Remember original CSS class，保存原始css类
        var entered = 0;                      // Track enters and leaves，跟踪进入和离开

        // This handler is invoked when a drag first enters the list. It checks
        // 当拖放对象首次进入列表时调用这个处理程序
        // that the drag contains data in a format it can process and, if so,
        // 它会检查拖放对象包含的数据格式它是否能处理
        // returns false to indicate interest in a drop. In that case, it also
        // 如果能，它返回false来表示有兴趣放置
        // highlights the drop target to let the user know of that interest.
        // 在这种情况下，它会高亮拖放目标，让用户知道该兴趣
        list.ondragenter = function(e) {
            e = e || window.event;  // Standard or IE event，标准或IE事件
            var from = e.relatedTarget; 
            // dragenter and dragleave events bubble, which makes it tricky to，dragenter和dragleave事件冒泡
            // know when to highlight or unhighlight the element in a case like，它使得在像<ul>元素有<li>子元素的情况下
            // this where the <ul> element has <li> children. In browsers that，何时高亮显示或取消高亮显示元素变得棘手
            // define relatedTarget we can track that.，在定义relatedTarget的浏览器中，我们能跟踪它
            // Otherwise, we count enter/leave pairs，否则，我们需要通过统计进入和离开的次数

            // If we entered from outside the list or if，如果从列表外面进入或第一次进入
            // this is the first entrance then we need to do some stuff，那么需要做一些处理
            entered++;
            if ((from && !ischild(from, list)) || entered == 1) {

                // All the DnD info is in this dataTransfer object，所有的DnD信息都在dataTransfer对象上
                var dt = e.dataTransfer; 

                // The dt.types object lists the types or formats that the data
                // dt.types对象列出可用的拖放数据的类型或格式
                // being dragged is available in. HTML5 says the type has a
                // HTML5定义这个对象有contains()方法
                // contains() method. In some browsers it is an array with an
                // 在一些浏览器中，它是一个有indexOf()方法的数组
                // indexOf method. In IE8 and before, it simply doesn't exist.
                // 在IE8以及之前版本中，它根本不存在
                var types = dt.types;    // What formats data is available in，可用数据格式是什么

                // If we don't have any type data or if data is
                // 如果没有任何类型的数据或可用数据是纯文本格式
                // available in plain text format, then highlight the
                // 那么高亮显示列表让用户知道我们正在监听拖放
                // list to let the user know we're listening for drop
                // 同时返回false让浏览器知晓
                // and return false to let the browser know.
                if (!types ||                                           // IE
                    (types.contains && types.contains("text/plain")) || //HTML5
                    (types.indexOf && types.indexOf("text/plain")!=-1)) //Webkit 
                {
                    list.className = original_class + " droppable";
                    return false;
                }
                // If we don't recognize the data type, we don't want a drop，如果我们无法识别数据类型，我们不希望拖放
                return;   // without canceling，没有取消
            }
            return false; // If not the first enter, we're still interested，如果不是第一次进入，我们继续保持兴趣
        };

        // This handler is invoked as the mouse moves over the list.
        // We have to define this handler and return false or the drag
        // will be canceled.
        // 当鼠标指针悬停在列表上时，会调用这个处理程序
        // 我们必须定义这个处理程序并返回false，否则这个拖放操作将取消
        list.ondragover = function(e) { return false; };

        // This handler is invoked when the drag moves out of the list
        // or out of one of its children. If we are actually leaving the list
        // (not just going from one list item to another), then unhighlight it.
        // 当鼠标对象移出列表或从其子元素中移出时，会调用这个处理程序，如果我们真正离开这个列表（不是仅仅从一个列表项到另一个）
        // 那么取消高亮显示它
        list.ondragleave = function(e) {
            e = e || window.event;
            var to = e.relatedTarget;

            // If we're leaving for something outside the list or if this leave，如果我们要到列表以外的元素或打破离开和进入次数的平衡
            // balances out the enters, then unhighlight the list，那么取消高亮显示列表
            entered--;
            if ((to && !ischild(to,list)) || entered <= 0) {
                list.className = original_class;
                entered = 0;
            }
            return false;
        };

        // This handler is invoked when a drop actually happens，当实际放置时，会调用这个程序
        // We take the dropped text and make it into a new <li> element，我们会接受放下的文本并将其放到一个新的<li>元素中
        list.ondrop = function(e) {
            e = e || window.event;       // Get the event，获得事件

            // Get the data that was dropped in plain text format.，获得放置的纯文本数据
            // "Text" is a nickname for "text/plain".  "Text"是"text/plain"的昵称
            // IE does not support "text/plain", so we use "Text" here，IE不支持"text/plain"，所以在这里使用"Text"
            var dt = e.dataTransfer;       // dataTransfer object，dataTransfer对象
            var text = dt.getData("Text"); // Get dropped data as plain text，获取放置的纯文本数据

            // If we got some text, turn it into a new item at list end.
            // 如果得到一些文本，把它放入列表尾部的新项中
            if (text) {
                var item = document.createElement("li"); // Create new <li>，创建新<li>
                item.draggable = true;                   // Make it draggable，使它可拖动
                item.appendChild(document.createTextNode(text)); // Add text，添加文本
                list.appendChild(item);                  // Add it to the list，把它添加到列表中

                // Restore the list's original style and reset the entered count
                // 恢复列表的原始样式且重置进入次数
                list.className = original_class;
                entered = 0;

                return false;
            }
        };

        // Make all items that were originally in the list draggable，使原始所有列表项都可拖动
        var items = list.getElementsByTagName("li");
        for(var i = 0; i < items.length; i++)
            items[i].draggable = true;

        // And register event handlers for dragging list items.为拖动列表项注册事件处理程序
        // Note that we put these handlers on the list and let events，注意我们把处理程序放在列表上
        // bubble up from the items，让事件从列表项向上冒泡

        // This handler is invoked when a drag is initiated within the list.
        // 当在列表中开始拖动对象，会调用这个处理程序
        list.ondragstart = function(e) {
            var e = e || window.event;
            var target = e.target || e.srcElement;
            // If it bubbled up from something other than a <li>, ignore it
            // 如果它不是从<li>向上冒泡，那么忽略它
            if (target.tagName !== "LI") return false;
            // Get the all-important dataTransfer object，获得最重要的dataTransfer对象
            var dt = e.dataTransfer;
            // Tell it what data we have to drag and what format it is in，设置拖动的数据和数据类型
            dt.setData("Text", target.innerText || target.textContent);
            // Tell it we know how to allow copies or moves of the data，设置允许复制和移动这些数据
            dt.effectAllowed = "copyMove";
        };

        // This handler is invoked after a successful drop occurs，当成功的放置后，将调用这个处理程序
        list.ondragend = function(e) {
            e = e || window.event;
            var target = e.target || e.srcElement;

            // If the drop was a move, then delete the list item，如果这个拖放操作是move，那么要删除列表项
            // In IE8, this will be "none" unless you explicitly set it to 
            // 在IE中，它将是“none”，除非在之前的ondrop处理程序中显式设置它为move
            // move in the ondrop handler above.  But forcing it to "move" for
            // 但为IE强制设置“move”会阻止其他浏览器给用户选择复制还是移动的机会
            // IE prevents other browsers from giving the user a choice of a
            // copy or move operation.
            if (e.dataTransfer.dropEffect === "move")
                target.parentNode.removeChild(target);
        }

        // This is the utility function we used in ondragenter and ondragleave.
        // 这是在ondragenter和ondragleave使用的工具函数
        // Return true if a is a child of b，如果a是b的子元素则返回true
        function ischild(a,b) {
            for(; a; a = a.parentNode) if (a === b) return true;
            return false;
        }
    }
});
```

**17.8文本事件**s


**17.9键盘事件**

脚本化http
----------

超文本传输协议（HyperTextTransferProtocol，HTTP）规定web浏览器如何从web服务器获取文档和向Web服务器提交表单内容，以及web服务器如何响应这些请求和提交。web浏览器会处理大量http。通常，http并不在脚本的控制下，只是当用户单击链接、提交表单和输入url时才发生。
但是，用javascript操纵http是可行的。当用脚本设置window对象的location属性或调用表单对象的submit()方法时，都会初始化http请求。在这两种情况下，浏览器会加载新页面。这种用脚本控制http的方法在多框架页面中非常有用，但这并非我们在此讨论的主题。相反，本章会说明在没有导致web浏览器重新加载任何窗口或窗体的内容情况下，脚本如何实现web浏览器与服务器之间的通信。

术语Ajax（Asynchronous javascript and xml的缩写，未全部大写）描述了一种主要使用脚本操纵http的web应用架构。
ajax应用的主要特点是使用脚本操纵http和web服务器进行数据交换，不会导致页面重载。避免页面重载（这是web初期的标准做法）的能力使web应用感觉更像传统的桌面应用。web应用可以使用ajax技术把用户的交互数据记录到服务器中；也可以开始只显示简单的页面，之后按需加载额外的数据和页面组件来提升应用的启动时间。ajax是Asynchronous Javascript and XML的缩写（未全部大写）。这个术语是Jesse James Carrett创造，最早出现在他于2005年发表的文章“Ajax:A New Approach to Web Applications”。“ajax”曾经是一个流行多年的术语，现在它只不过是一个有用的术语，来描述基于用脚本操纵http请求的web应用架构。

Comet是和使用脚本操纵http的web应用架构相关的术语。在某种意义上，Comet和Ajax相反。在comet中，web服务器发起通信并异步发送消息到客户端。如果web应用需要响应服务端发送的消息，则它使用ajax技术发送或请求数据。在ajax中，客户端从服务端“拉”数据，而在comet中，服务端向客户端“推”数据。comet还包括其他名词（如“服务器推”、“ajax推”和“http流”）。comet这个名字是由Alex Russell在“comet:Low Latency Data for the Browser“中创造的。这个名字可能是对ajax开了个玩笑，comet和ajax都是美国的洗涤日用品牌。

实现ajax和comet的方式有很多种，而这些底层的实现有时称为传输协议（transport）。例如，img元素有一个src属性。当脚本设置这个属性为url时，浏览器发起的http get请求会从这个url下载图片。因此，脚本通过设置img元素的src属性，且把信息作为图片url的查询字符串部分，就把能经过编码信息传递给web服务器。web服务器实际上必须返回某个图片来作为请求结果，但它一定要不可见：例如，一个1*1像素的透明图片。这种类型的图片也称为网页信标（web bug）。当网页信标不是与当前网页服务器而是其他服务器交流信息时，会担心隐私内容。这种第三方网页信标的方式常用于统计点击次数和网站流量分析。

img元素无法实现完整的ajax传输协议，因为数据交换是单向的：客户端能发送数据到服务器，但服务器的响应一直是张图片导致客户端无法轻易从中提取信息。然而，iframe元素更加强大，为了把iframe作为ajax传输协议使用，脚本首先要把发送给web服务器的信息编码到url中，然后设置iframe的src属性为该url。服务器能创建一个包含响应内容的html文档，并把它返回给web浏览器，并且在iframe中显示它。iframe需要对用户不可见，例如可以使用css隐藏它。脚本通过遍历iframe的文档对象来读取服务器端的响应。注意，这种访问受限于13.6.2节介绍的同源策略问题。

实际上，script元素的src属性能设置url并发起http get请求。使用script元素实现脚本操纵http是非常吸引人的，因为它们可以跨域通信而不受限于同源策略。通常，使用基于script元素的ajax传输协议时，服务器的响应采用json编码（见6.9节）的数据格式，当执行脚本时，javascript解析器能自动将其“编码”。由于它使用json数据格式，因此这种ajax传输协议也叫做“jsonp”。

虽然在iframe和script传输协议之上能实现ajax技术，但通常还有更简单的方式。一段时间以来，所有浏览器都支持XMLHttpRequest对象，它定义了用脚本操纵http的api。除了常用的get请求，这个api还包含实现post请求的能力，同时它能用文本或document对象的形式返回服务器的响应。虽然它的名字叫XMLHttpRequestAPI，但并没有限定只能使用XML文档，它能获取任何类型的文本文档。18.1节涵盖XMLHttpRequestAPI和本章的大部分。本章大部分ajax示例都将使用XMLHttpRequest对象来实现协议方案，我们也将在18.2节演示如何使用基于script的传输协议，因为script元素有规避同源限制的能力。

Ajax中的X表示XML，这个http（XMLHttpRequest）的主要客户端API在其名字中突出了XML，并且后面我们将看到XMLHttpRequest对象的其中一个属性叫responseXML。它看起来像说明XML是用脚本操纵HTTP的重要部分，但实际上它不是，这些名字只是XML流行时的遗迹。当然，ajax技术能和xml文档一起工作，但使用xml只是一种选择，实际上很少使用。XMLHttpRequest规范列出了这个令人困惑名字的不足之处：对象名XMLHttpRequest是为了兼容web，虽然这个名字的每个部分都可能造成误导。首先，这个对象支持包含XML在内的任何基于文本的格式。其次，它能用于HTTP和HTTPS请求（一些实现支持除了HTTP和HTTPS之外的协议，但规范不包括这些功能）。最后，它所支持的请求是一个广义的概念，指的是对于定义的HTTP方法的涉及HTTP请求或响应的所有活动。

Comet传输协议比Ajax更精妙，但都需要客户端和服务器之间建立（必要时重新建立）连接，同时需要服务器保持连接处于打开状态，这样它才能够发送异步信息。隐藏的iframe能像comet传输协议一样有用，例如，如果服务器以iframe中待执行的script的元素的形式发送每条消息。实现comet的一种更可靠跨平台方案是客户端建立一个和服务器的连接（使用ajax传输协议），同时服务器保持这个连接打开直到它需要推送一条消息。处理该消息之后，客户端马上为后续的消息推送建立一个新连接。

实现可靠的跨平台comet传输协议是非常有挑战性的，所以大部分使用comet架构的web应用开发者依赖于像Dojo这样的web框架库中的传输协议。在写本章时，浏览器正开始实现HTML5相关草案的Server-Sent事件，它用EventSource对象的形式定义了简单的comet api。18.3节涵盖EventSource API且演示了一个使用XMLHttpRequest实现的简单模拟示例。

在Ajax和Comet之上构建更高级的通信协议是可行的。例如，这些客户端／服务器技术可以用做RPC（Remote Procedure Call，远程过程调用）机制或发布／订阅事件系统的基础。
但是本章不会介绍像上面这样更高级的协议，我们重点在能使Ajax和Comet可用在API上。

**18.1使用xmlhttprequest**

浏览器在XMLHttpRequest类上定义了它们的Http API。这个类的每个实例都表示一个独立的请求／响应对，并且这个对象的属性和方法允许指定请求细节和提取响应数据。很多年前web浏览器就开始支持xmlhttprequest，并且其API已经到了w3c制订标准的最后阶段。同时，w3c正在制订“2级XMLHttpRequest”标准草案。本节涵盖XMLHTTPRequest核心API，也包括当前至少被两款浏览器支持的部分2级XMLHttpRequest标准草案（我们将其称为XHR2）。

当然，使用这个HTTP API必须要做的第一件事就是实例化XMLHttpRequest对象：

    var request ＝ new XMLHttpRequest();
    
你也能重用已存在的XMLHttpRequest，但注意这将会终止之前通过该对像挂起的任何请求。

IE6中的XMLHttpRequest  TODO

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

http的基础请求／响应架构非常简单且易于使用。但在实践中会有各种各样随之而来的复杂问题：客户端和服务器交换cookie，服务器重定向浏览器到其他服务器，缓存某些资源而剩下的不缓存，某些客户端通过代理服务器发送所有的请求等。XMLHttpRequestAPI不是协议级的HTTP API而是浏览器级的API。浏览器需要考虑cookie，重定向，缓存和代理。但代码只需要担心请求和响应。

XMLHttpRequest和本地文件，网页中可以使用相对url的能力通常意味着我们能使用本地文件系统来开发和测试html，并避免对web服务器进行不必要的部署。然后当使用XMLHttpRequest进行ajax编程时，这通常是不可行的。XMLHttpRequest用于同http和https协议一起工作。理论上，它能够同像ftp这样的其他协议一起工作，但比如像请求方法和响应状态码等部分api是http特有的。如果从本地文件中加载网页，那么该页面中的脚本将无法通过相对url使用XMLHttpRequest，因为这些url将相对于file://url而不是http://url。而同源策略通常会阻止使用绝对http://url（请参见18.1.6节）。如果是当使用XMLHttpRequest时，为了测试它们通常必须把文件上传到web服务器（或运行一个本地服务器）。

18.1.1指定请求

创建XMLHttpRequest对象之后，发起http请求的下一步是调用XMLHttpRequest对象的open()方法去指定这个请求的两个必需部分：方法和URL。

    rquest.open("GET",      //开始一个HTTP GET请求
                "data.csv");//URL的内容

open()第一个参数指定http方法或者动作。这个字符串不区分大小写，但通常大家用大写字母来匹配HTTP协议。“GET”和“POST”方法是得到广泛支持的。“GET”用于常规请求，它适用于当url完全指定请求资源，当请求对服务器没有任何副作用以及当服务器的响应是可缓存时。“POST”方法常用于html表单。它在请求主体中包含额外数据（表单数据）且这些数据常存储到服务器上的数据库中（副作用）。相同url的重复post请求从服务器得到的响应可能不同，同时不应该缓存使用这个方法的请求。除了“GET”和“POST”之外，xmlhttprequest也允许把“DELETE”、“HEAD”、“OPTIONS”和“PUT”作为open()的第一个参数。（“HTTP CONNECT”、“TRACE”和“TRACK”因为安全风险已被明确禁止。）旧浏览器并不支持所有的这些方法，但至少“HEAD”得到了广泛支持，例18-13演示如何使用它。



**18.2借助[script]发送http请求：jsonp**
**18.3基于服务器端推送事件的comet技术**

