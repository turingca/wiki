第13章 事件
----------

本章内容
- 理解事件流
- 使用事件处理程序
- 不同的事件类型

JavaScript与HTML之间的交互是通过事件实现的。事件，就是文档或浏览器窗口中发生的一些特定的交互瞬间。可以使用侦听器（或处理程序）来预订事件，以便事件发生时执行相应的代码。这种在传统软件工程中被称为观察员模式的模型，支持页面的行为（JavaScript代码）与页面的外观（HTML和CSS代码）之间的松散耦合。事件最早是在IE3和NetscapeNavigator2中出现的，当时是作为分担服务器运算负载的一种手段。在IE4和Navigator4发布时，这两种浏览器都提供了相似但不相同的API，这些API并存经过了好几个主要版本。DOM2级规范开始尝试以一种符合逻辑的方式来标准化DOM事件。IE9、Firefox、Opera、Safari和Chrome全都已经实现了“DOM2级事件”模块的核心部分。IE8是最后一个仍然使用其专有事件系统的主要浏览器。浏览器的事件系统相对比较复杂。尽管所有主要浏览器已经实现了“DOM2级事件”，但这个规范本身并没有涵盖所有事件类型。浏览器对象模型（BOM）也支持一些事件，这些事件与文档对象模型（DOM）事件之间的关系并不十分清晰，因为BOM事件长期没有规范可以遵循（HTML5后来给出了详细的说明）。随着DOM3级的出现，增强后的DOM事件API变得更加繁琐。使用事件有时相对简单，有时则非常复杂，难易程度会因你的需求而不同。不过，有关事件的一些核心概念是一定要理解的。

**13.1 事件流**

当浏览器发展到第四代时（IE4及Netscape Communicator 4），浏览器开发团队遇到了一个很有意思的问题：页面的哪一部分会拥有某个特定的事件？要明白这个问题问的是什么，可以想象画在一张纸上的一组同心圆。如果你把手指放在圆心上，那么你的手指指向的不是一个圆，而是纸上的所有圆。两家公司的浏览器开发团队在看待浏览器事件方面还是一致的。如果你单击了某个按钮，他们都认为单击事件不仅仅发生在按钮上。换句话说，在单击按钮的同时，你也单击了按钮的容器元素，甚至也单击了整个页面。事件流描述的是从页面中接收事件的顺序。但有意思的是，IE和Netscape开发团队居然提出了差不多是完全相反的事件流的概念。IE的事件流是事件冒泡流，而NetscapeCommunicator的事件流是事件捕获流。

**13.1.1 事件冒泡**

IE的事件流叫做事件冒泡（event  bubbling），即事件开始时由最具体的元素（文档中嵌套层次最深的那个节点）接收，然后逐级向上传播到较为不具体的节点（文档）。以下面的HTML页面为例：
```
<!DOCTYPE html>
<html>
<head><title>Event Bubbling Example</title>
</head>
<body>
<div id="myDiv">Click Me</div>
</body>
</html>
```

如果你单击了页面中的`<div>`元素，那么这个click事件会按照如下顺序传播：
1. `<div>`
2. `<body>`
3. `<html>`
4. `document`

也就是说，click事件首先在`<div>`元素上发生，而这个元素就是我们单击的元素。然后，click事件沿DOM树向上传播，在每一级节点上都会发生，直至传播到document对象。图13-1展示了事件冒泡的过程。

所有现代浏览器都支持事件冒泡，但在具体实现上还是有一些差别。IE5.5及更早版本中的事件冒泡会跳过`<html>`元素（从`<body>`直接跳到`document`）。IE9、Firefox、Chrome和Safari则将事件一直冒泡到window对象。

**13.1.2 事件捕获**

Netscape Communicator团队提出的另一种事件流叫做事件捕获（event capturing）。事件捕获的思想是不太具体的节点应该更早接收到事件，而最具体的节点应该最后接收到事件。事件捕获的用意在于在事件到达预定目标之前捕获它。如果仍以前面的HTML页面作为演示事件捕获的例子，那么单击`<div>`元素就会以下列顺序触发click事件。
1. document
2. html
3. body
4. div

在事件捕获过程中，document对象首先接收到click事件，然后事件沿DOM树依次向下，一直传播到事件的实际目标，即`<div>`元素。图13-2展示了事件捕获的过程。

虽然事件捕获是NetscapeCommunicator唯一支持的事件流模型，但IE9、Safari、Chrome、Opera和Firefox目前也都支持这种事件流模型。尽管“DOM2级事件”规范要求事件应该从document对象开始传播，但这些浏览器都是从window对象开始捕获事件的。由于老版本的浏览器不支持，因此很少有人使用事件捕获。我们也建议读者放心地使用事件冒泡，在有特殊需要时再使用事件捕获。

**13.1.3 DOM事件流**

DOM2级事件规定的事件流包括三个阶段：事件捕获阶段、处于目标阶段和事件冒泡阶段。首先发生的是事件捕获，为截获事件提供了机会。然后是实际的目标接收到事件。最后一个阶段是冒泡阶段，可以在这个阶段对事件做出响应。以前面简单的HTML页面为例，单击`<div>`元素会按照图13-3所示顺序触发事件。

在DOM事件流中，实际的目标（`<div>`元素）在捕获阶段不会接收到事件。这意味着在捕获阶段，事件从document到`<html>`再到`<body>`后就停止了。下一个阶段是“处于目标”阶段， 于是事件在`<div>`上发生，并在事件处理（后面将会讨论这个概念）中被看成冒泡阶段的一部分。然后，冒泡阶段发生，事件又传播回文档。

多数支持DOM事件流的浏览器都实现了一种特定的行为；即使“DOM2级事件”规范明确要求捕获阶段不会涉及事件目标，但IE9、Safari、Chrome、Firefox和Opera9.5及更高版本都会在捕获阶段触发事件对象上的事件。结果，就是有两个机会在目标对象上面操作事件。

IE9、Opera、Firefox、Chrome和Safari都支持DOM事件流；IE8及更早版本不支持DOM事件流。

**13.2 事件处理程序**

事件就是用户或浏览器自身执行的某种动作。诸如click、load和mouseover，都是事件的名字。而响应某个事件的函数就叫做事件处理程序（或事件侦听器）。事件处理程序的名字以"on"开头，因此click事件的事件处理程序就是onclick，load事件的事件处理程序就是onload。为事件指定处理程序的方式有好几种。

**13.2.1 HTML事件处理程序**

某个元素支持的每种事件，都可以使用一个与相应事件处理程序同名的HTML特性来指定。这个特性的值应该是能够执行的JavaScript代码。例如，要在按钮被单击时执行一些JavaScript，可以像下面这样编写代码：
```
<input type="button" value="Click Me" onclick="alert('Clicked')" />
```

当单击这个按钮时，就会显示一个警告框。这个操作是通过指定onclick特性并将一些JavaScript代码作为它的值来定义的。由于这个值是JavaScript，因此不能在其中使用未经转义的HTML语法字符，例如和号`&`、双引号`""`、小于号`<`或大于号`>`。

为了避免使用HTML实体，这里使用了单引号。如果想要使用双引号，那么就要将代码改写成如下所示：
```
<input type="button" value="Click Me" onclick="alert(&quot;Clicked&quot;)" />
```

在HTML中定义的事件处理程序可以包含要执行的具体动作，也可以调用在页面其他地方定义的脚本，如下面的例子所示：

```
<script type="text/javascript">
    function showMessage() {
        alert("Hello world!");
    }
</script>
<input type="button" value="Click Me" onclick="showMessage()" /> 
```

在这个例子中，单击按钮就会调用showMessage()函数。这个函数是在一个独立的`<script>`元素中定义的，当然也可以被包含在一个外部文件中。事件处理程序中的代码在执行时，有权访问全局作用域中的任何代码。这样指定事件处理程序具有一些独到之处。首先，这样会创建一个封装着元素属性值的函数。这个函数中有一个局部变量event，也就是事件对象（本章稍后讨论）：

```
<!-- 输出 "click" -->
<input type="button" value="Click Me" onclick="alert(event.type)">
```

通过event变量，可以直接访问事件对象，你不用自己定义它，也不用从函数的参数列表中读取。在这个函数内部，this值等于事件的目标元素，例如：

```
<!-- 输出 "Click Me" -->
<input type="button" value="Click Me" onclick="alert(this.value)">
```

关于这个动态创建的函数，另一个有意思的地方是它扩展作用域的方式。在这个函数内部，可以像访问局部变量一样访问document及该元素本身的成员。这个函数使用with像下面这样扩展作用域：

```
function() {
    with(document) {
        with(this) {
            //元素属性值
        }
    }
}
```

如此一来，事件处理程序要访问自己的属性就简单多了。下面这行代码与前面的例子效果相同：

```
<!-- 输出 "Click Me" -->
<input type="button" value="Click Me" onclick="alert(value)">
```

如果当前元素是一个表单输入元素，则作用域中还会包含访问表单元素（父元素）的入口，这个函数就变成了如下所示：
```
function() {
    with(document) {
        with(this.form) {
            with(this) {
                //元素属性值
            }
        }
    }
}
```

实际上，这样扩展作用域的方式，无非就是想让事件处理程序无需引用表单元素就能访问其他表单字段。例如
：
```
<form method="post">
<input type="text" name="username" value="">
<input type="button" value="Echo Username" onclick="alert(username.value)"> 
</form>
```

在这个例子中，单击按钮会显示文本框中的文本。值得注意的是，这里直接引用了username元素。

不过，在HTML中指定事件处理程序有两个缺点。首先，存在一个时差问题。因为用户可能会在HTML元素一出现在页面上就触发相应的事件，但当时的事件处理程序有可能尚不具备执行条件。以前面的例子来说明，假设showMessage()函数是在按钮下方、页面的最底部定义的。如果用户在页面解析showMessage()函数之前就单击了按钮，就会引发错误。为此，很多HTML事件处理程序都会被封装在一个try-catch块中，以便错误不会浮出水面，如下面的例子所示：
```
<input type="button" value="Click Me" onclick="try{showMessage();}catch(ex){}">
```

这样，如果在showMessage()函数有定义之前单击了按钮，用户将不会看到JavaScript错误，因为在浏览器有机会处理错误之前，错误就被捕获了。另一个缺点是，这样扩展事件处理程序的作用域链在不同浏览器中会导致不同结果。不同JavaScript引擎遵循的标识符解析规则略有差异，很可能会在访问非限定对象成员时出错。通过HTML指定事件处理程序的最后一个缺点是HTML与JavaScript代码紧密耦合。如果要更换事件处理程序，就要改动两个地方：HTML代码和JavaScript代码。而这正是许多开发人员摒弃HTML事件处理程序，转而使用JavaScript指定事件处理程序的原因所在。

要了解关于HTML事件处理程序缺点的更多信息，请参考Garrett  Smith的文章[“Event Handler Scope”](www.jibbering.com/faq/names/event_handler.html)。

**13.2.2 DOM0级事件处理程序**

通过JavaScript指定事件处理程序的传统方式，就是将一个函数赋值给一个事件处理程序属性。这种为事件处理程序赋值的方法是在第四代Web浏览器中出现的，而且至今仍然为所有现代浏览器所支持。原因一是简单，二是具有跨浏览器的优势。要使用JavaScript指定事件处理程序，首先必须取得一个要操作的对象的引用。每个元素（包括window和document）都有自己的事件处理程序属性，这些属性通常全部小写，例如onclick。将这种属性的值设置为一个函数，就可以指定事件处理程序，如下所示：
```
var btn = document.getElementById("myBtn");
btn.onclick = function() {
    alert("Clicked");
};
```

在此，我们通过文档对象取得了一个按钮的引用，然后为它指定了onclick事件处理程序。但要注意，在这些代码运行以前不会指定事件处理程序，因此如果这些代码在页面中位于按钮后面，就有可能在一段时间内怎么单击都没有反应。使用DOM0级方法指定的事件处理程序被认为是元素的方法。因此，这时候的事件处理程序是在元素的作用域中运行；换句话说，程序中的this引用当前元素。来看一个例子。
```
var btn = document.getElementById("myBtn");
btn.onclick = function() {
    alert(this.id);//"myBtn"
};
```

单击按钮显示的是元素的ID，这个ID是通过this.id取得的。不仅仅是ID，实际上可以在事件处理程序中通过this访问元素的任何属性和方法。以这种方式添加的事件处理程序会在事件流的冒泡阶段被处理。也可以删除通过DOM0级方法指定的事件处理程序，只要像下面这样将事件处理程序属性的值设置为null即可：

```
btn.onclick = null;     //删除事件处理程序
```

将事件处理程序设置为null之后，再单击按钮将不会有任何动作发生。

如果你使用HTML指定事件处理程序，那么onclick属性的值就是一个包含着在同名HTML特性中指定的代码的函数。而将相应的属性设置为null，也可以删除以这种方式指定的事件处理程序。

**13.2.3 DOM2级事件处理程序**

DOM2级事件定义了两个方法，用于处理指定和删除事件处理程序的操作：`addEventListener()`和`removeEventListener()`。所有DOM节点中都包含这两个方法，并且它们都接受3个参数：要处理的事件名、作为事件处理程序的函数和一个布尔值。最后这个布尔值参数如果是true，表示在捕获阶段调用事件处理程序；如果是false，表示在冒泡阶段调用事件处理程序。

要在按钮上为click事件添加事件处理程序，可以使用下列代码：

```
var btn = document.getElementById("myBtn");
btn.addEventListener("click", function() {
    alert(this.id);
}, false);
```
    
上面的代码为一个按钮添加了onclick事件处理程序，而且该事件会在冒泡阶段被触发（因为最后一个参数是false）。与DOM0级方法一样，这里添加的事件处理程序也是在其依附的元素的作用域中运行。使用DOM2级方法添加事件处理程序的主要好处是可以添加多个事件处理程序。来看下面的例子。

```
var btn = document.getElementById("myBtn");
btn.addEventListener("click", function() {
    alert(this.id);
}, false);
btn.addEventListener("click", function() {
    alert("Hello world!");
}, false);
```

这里为按钮添加了两个事件处理程序。这两个事件处理程序会按照添加它们的顺序触发，因此首先会显示元素的ID，其次会显示"Hello world!"消息。通过addEventListener()添加的事件处理程序只能使用removeEventListener()来移除；移除时传入的参数与添加处理程序时使用的参数相同。这也意味着通过addEventListener()添加的匿名函数将无法移除，如下面的例子所示。

```
var btn = document.getElementById("myBtn");
btn.addEventListener("click", function() {
    alert(this.id);
}, false);
//这里省略了其他代码
btn.removeEventListener("click", function(){
    //没有用！
    alert(this.id);
}, false);
```

在这个例子中，我们使用addEventListener()添加了一个事件处理程序。虽然调用remove- EventListener()时看似使用了相同的参数，但实际上，第二个参数与传入addEventListener()中的那一个是完全不同的函数。而传入removeEventListener()中的事件处理程序函数必须与传入addEventListener()中的相同，如下面的例子所示。

```
var btn = document.getElementById("myBtn");
var handler = function() {
    alert(this.id);
};
btn.addEventListener("click", handler, false);
//这里省略了其他代码
btn.removeEventListener("click", handler, false); //有效！
```

重写后的这个例子没有问题，是因为在addEventListener()和removeEventListener()中使用了相同的函数。

大多数情况下，都是将事件处理程序添加到事件流的冒泡阶段，这样可以最大限度地兼容各种浏览器。最好只在需要在事件到达目标之前截获它的时候将事件处理程序添加到捕获阶段。如果不是特别需要，我们不建议在事件捕获阶段注册事件处理程序。

IE9、Firefox、Safari、Chrome和Opera支持DOM2级事件处理程序。

**13.2.4 IE事件处理程序**

IE实现了与DOM中类似的两个方法：attachEvent()和detachEvent()。这两个方法接受相同的两个参数：事件处理程序名称与事件处理程序函数。由于IE8及更早版本只支持事件冒泡，所以通过attachEvent()添加的事件处理程序都会被添加到冒泡阶段。要使用attachEvent()为按钮添加一个事件处理程序，可以使用以下代码。

```
var btn = document.getElementById("myBtn");
btn.attachEvent("onclick", function() {
    alert("Clicked");
});
```

注意，attachEvent()的第一个参数是"onclick"，而非DOM的addEventListener()方法中的"click"。

在IE中使用attachEvent()与使用DOM0级方法的主要区别在于事件处理程序的作用域。在使用DOM0级方法的情况下，事件处理程序会在其所属元素的作用域内运行；在使用attachEvent()方法的情况下，事件处理程序会在全局作用域中运行，因此this等于window。来看下面的例子。

```
var btn = document.getElementById("myBtn");
btn.attachEvent("onclick", function() {
    alert(this === window); //true
});
```

在编写跨浏览器的代码时，牢记这一区别非常重要。与addEventListener()类似，attachEvent()方法也可以用来为一个元素添加多个事件处理程序。来看下面的例子。
```
var btn = document.getElementById("myBtn");
btn.attachEvent("onclick", function() {
    alert("Clicked");
});
btn.attachEvent("onclick", function() {
    alert("Hello world!");
});
```

这里调用了两次attachEvent()，为同一个按钮添加了两个不同的事件处理程序。不过，与DOM方法不同的是，这些事件处理程序不是以添加它们的顺序执行，而是以相反的顺序被触发。单击这个例子中的按钮，首先看到的是"Hello world!"，然后才是"Clicked"。使用attachEvent()添加的事件可以通过detachEvent()来移除，条件是必须提供相同的参数。与DOM方法一样，这也意味着添加的匿名函数将不能被移除。不过，只要能够将对相同函数的引用传给detachEvent()，就可以移除相应的事件处理程序。例如：
```
var btn = document.getElementById("myBtn");
var handler = function() {
    alert("Clicked");
};
btn.attachEvent("onclick", handler);
//这里省略了其他代码
btn.detachEvent("onclick", handler);
```

这个例子将保存在变量handler中的函数作为事件处理程序。因此，后面的detachEvent()可以使用相同的函数来移除事件处理程序。

支持IE事件处理程序的浏览器有IE和Opera。

**13.2.5 跨浏览器的事件处理程序**

为了以跨浏览器的方式处理事件，不少开发人员会使用能够隔离浏览器差异的JavaScript库，还有一些开发人员会自己开发最合适的事件处理的方法。自己编写代码其实也不难，只要恰当地使用能力检测即可（能力检测在第9章介绍过）。要保证处理事件的代码能在大多数浏览器下一致地运行，只需关注冒泡阶段。第一个要创建的方法是addHandler()，它的职责是视情况分别使用DOM0级方法、DOM2级方法或IE方法来添加事件。这个方法属于一个名叫EventUtil的对象，本书将使用这个对象来处理浏览器间的差异。addHandler()方法接受3个参数：要操作的元素、事件名称和事件处理程序函数。与addHandler()对应的方法是removeHandler()，它也接受相同的参数。这个方法的职责是移除之前添加的事件处理程序——无论该事件处理程序是采取什么方式添加到元素中的，如果其他方法无效，默认采用DOM0级方法。

EventUtil的用法如下所示。
```
var EventUtil = {
    addHandler: function (element, type, handler) {
        if (element.addEventListener) {
            element.addEventListener(type, handler, false);
        } else if (element.attachEvent) {
            element.attachEvent("on" + type, handler);
        } else {
            element["on" + type] = handler;
        }
    },
    removeHandler: function(element, type, handler) {
        if (element.removeEventListener) {
            element.removeEventListener(type, handler, false);
        } else if (element.detachEvent) {
            element.detachEvent("on" + type, handler);
        } else {
            element["on" + type] = null;
        }
    }
};
```

这两个方法首先都会检测传入的元素中是否存在DOM2级方法。如果存在DOM2级方法，则使用该方法：传入事件类型、事件处理程序函数和第三个参数false（表示冒泡阶段）。如果存在的是IE的方法，则采取第二种方案。注意，为了在IE8及更早版本中运行，此时的事件类型必须加上"on"前缀。最后一种可能就是使用DOM0级方法（在现代浏览器中，应该不会执行这里的代码）。此时，我们使用的是方括号语法来将属性名指定为事件处理程序，或者将属性设置为null。可以像下面这样使用EventUtil对象：

```
var btn = document.getElementById("myBtn");
var handler = function() {
    alert("Clicked");
};
EventUtil.addHandler(btn, "click", handler);
//这里省略了其他代码
EventUtil.removeHandler(btn, "click", handler);
```

addHandler()和removeHandler()没有考虑到所有的浏览器问题，例如在IE中的作用域问题。不过，使用它们添加和移除事件处理程序还是足够了。此外还要注意，DOM0级对每个事件只支持一个事件处理程序。好在，只支持DOM0级的浏览器已经没有那么多了，因此这对你而言应该不是什么问题。

**13.3 事件对象**

在触发DOM上的某个事件时，会产生一个事件对象event，这个对象中包含着所有与事件有关的信息。包括导致事件的元素、事件的类型以及其他与特定事件相关的信息。例如，鼠标操作导致的事件对象中，会包含鼠标位置的信息，而键盘操作导致的事件对象中，会包含与按下的键有关的信息。所有浏览器都支持event对象，但支持方式不同。

**13.3.1 DOM中的事件对象**

兼容DOM的浏览器会将一个event对象传入到事件处理程序中。无论指定事件处理程序时使用什么方法（DOM0级或DOM2级），都会传入event对象。来看下面的例子。

```
var btn = document.getElementById("myBtn");
btn.onclick = function(event) {
    alert(event.type); //"click"
};
btn.addEventListener("click", function(event) {
    alert(event.type); //"click"
}, false);
```

这个例子中的两个事件处理程序都会弹出一个警告框，显示由event.type属性表示的事件类型。这个属性始终都会包含被触发的事件类型，例如"click"（与传入addEventListener()和removeEventListener()中的事件类型一致）。在通过HTML特性指定事件处理程序时，变量event中保存着event对象。请看下面的例子。

```
<input type="button" value="Click Me" onclick="alert(event.type)"/>
```

以这种方式提供event对象，可以让HTML特性事件处理程序与JavaScript函数执行相同的操作。event对象包含与创建它的特定事件有关的属性和方法。触发的事件类型不一样，可用的属性和方法也不一样。不过，所有事件都会有下表列出的成员。

|属性/方法|类型|读/写|说明|
|:--|:--|:--|:--|
|bubbles|Boolean|只读|表明事件是否冒泡|
|cancelable|Boolean|只读|表明是否可以取消事件的默认行为|
|currentTarget Element|只读|其事件处理程序当前正在处理事件的那个元素|
|defaultPrevented|Boolean|只读|为true表示已经调用了preventDefault()（DOM3级事件中新增）|
|detail|Integer|只读与事件相关的细节信息|
|eventPhase|Integer|只读|调用事件处理程序的阶段：1表示捕获阶段，2表示“处于目标”，3表示冒泡阶段|
|preventDefault()|Function|只读|取消事件的默认行为。如果cancelable是true，则可以使用这个方法|
|stopImmediatePropagation()|Function|只读|取消事件的进一步捕获或冒泡，同时阻止任何事件处理程序被调用（DOM3级事件中新增）|
|stopPropagation()|Function|只读|取消事件的进一步捕获或冒泡。如果bubbles为true，则可以使用这个方法|
|target|Element|只读|事件的目标|
|trusted|Boolean|只读|为true表示事件是浏览器生成的。为false表示事件是由开发人员通过JavaScript创建的（DOM3级事件中新增）|
|type|String|只读|被触发的事件的类型|
|view|AbstractView|只读|与事件关联的抽象视图。等同于发生事件的window对象|

在事件处理程序内部，对象this始终等于currentTarget的值，而target则只包含事件的实际目标。如果直接将事件处理程序指定给了目标元素，则this、currentTarget和target包含相同的值。来看下面的例子。

```
var btn = document.getElementById("myBtn");
btn.onclick = function(event) {
    alert(event.currentTarget === this);//true
    alert(event.target === this);//true
};
```

这个例子检测了currentTarget和target与this的值。由于click事件的目标是按钮，因此这三个值是相等的。如果事件处理程序存在于按钮的父节点中（例如document.body），那么这些值是不相同的。再看下面的例子。

```
document.body.onclick = function(event) {
    alert(event.currentTarget === document.body);//true
    alert(this === document.body); //true
    alert(event.target === document.getElementById("myBtn")); //true
};
```

当单击这个例子中的按钮时，this和currentTarget都等于document.body，因为事件处理程序是注册到这个元素上的。然而，target元素却等于按钮元素，因为它是click事件真正的目标。由于按钮上并没有注册事件处理程序，结果click事件就冒泡到了document.body，在那里事件才得到了处理。在需要通过一个函数处理多个事件时，可以使用type属性。例如：
```
var btn = document.getElementById("myBtn");
var handler = function(event) {
    switch(event.type) {
        case "click":
            alert("Clicked");
        break;
        case "mouseover":
            event.target.style.backgroundColor = "red";
        break;
        case "mouseout":
            event.target.style.backgroundColor = "";
        break;
    }
};
btn.onclick = handler;
btn.onmouseover = handler;
btn.onmouseout = handler;
```

这个例子定义了一个名为handler的函数，用于处理3种事件：click、mouseover和mouseout。当单击按钮时，会出现一个与前面例子中一样的警告框。当按钮移动到按钮上面时，背景颜色应该会变成红色，而当鼠标移动出按钮的范围时，背景颜色应该会恢复为默认值。这里通过检测event.type属性，让函数能够确定发生了什么事件，并执行相应的操作。要阻止特定事件的默认行为，可以使用preventDefault()方法。例如，链接的默认行为就是在被单击时会导航到其href特性指定的URL。如果你想阻止链接导航这一默认行为，那么通过链接的onclick事件处理程序可以取消它，如下面的例子所示。

```
var link = document.getElementById("myLink");
link.onclick = function(event) {
    event.preventDefault();
};
```

只有cancelable属性设置为true的事件，才可以使用preventDefault()来取消其默认行为。另外，stopPropagation()方法用于立即停止事件在DOM层次中的传播，即取消进一步的事件捕获或冒泡。例如，直接添加到一个按钮的事件处理程序可以调用stopPropagation()，从而避免触发注册在document.body上面的事件处理程序，如下面的例子所示。
```
var btn = document.getElementById("myBtn");
btn.onclick = function(event) {
    alert("Clicked");
    event.stopPropagation();
};
document.body.onclick = function(event) {
    alert("Body clicked");
}; 
```

对于这个例子而言，如果不调用stopPropagation()，就会在单击按钮时出现两个警告框。可是，由于click事件根本不会传播到document.body，因此就不会触发注册在这个元素上的onclick事件处理程序。事件对象的eventPhase属性，可以用来确定事件当前正位于事件流的哪个阶段。如果是在捕获阶段调用的事件处理程序，那么eventPhase等于1；如果事件处理程序处于目标对象上，则eventPhase等于2；如果是在冒泡阶段调用的事件处理程序，eventPhase等于3。这里要注意的是，尽管“处于目标”发生在冒泡阶段，但eventPhase仍然一直等于2。来看下面的例子。

```
var btn = document.getElementById("myBtn");
btn.onclick = function(event) {
    alert(event.eventPhase); //2
};
document.body.addEventListener("click", function(event) {
    alert(event.eventPhase); //1
}, true);
document.body.onclick = function(event) {
    alert(event.eventPhase); //3
};
```

当单击这个例子中的按钮时，首先执行的事件处理程序是在捕获阶段触发的添加到document.body中的那一个，结果会弹出一个警告框显示表示eventPhase的1。接着，会触发在按钮上注册的事件处理程序，此时的eventPhase值为2。最后一个被触发的事件处理程序，是在冒泡阶段执行的添加到document.body上的那一个，显示eventPhase的值为3。而当eventPhase等于2时，this、target和currentTarget始终都是相等的。

只有在事件处理程序执行期间，event对象才会存在；一旦事件处理程序执行完成，event对象就会被销毁。

**13.3.2 IE中的事件对象**

与访问DOM中的event对象不同，要访问IE中的event对象有几种不同的方式，取决于指定事件处理程序的方法。在使用DOM0级方法添加事件处理程序时，event对象作为window对象的一个属性存在。来看下面的例子。

```
var btn = document.getElementById("myBtn");
btn.onclick = function() {
    var event = window.event;
    alert(event.type); //"click"
};
```

在此，我们通过window.event取得了event对象，并检测了被触发事件的类型（IE中的type属性与DOM中的type属性是相同的）。可是，如果事件处理程序是使用attachEvent()添加的，那么就会有一个event对象作为参数被传入事件处理程序函数中，如下所示。

```
var btn = document.getElementById("myBtn");
btn.attachEvent("onclick", function(event) {
    alert(event.type);//"click"
});
```

在像这样使用attachEvent()的情况下，也可以通过window对象来访问event对象，就像使用DOM0级方法时一样。不过为方便起见，同一个对象也会作为参数传递。如果是通过HTML特性指定的事件处理程序，那么还可以通过一个名叫event的变量来访问event对象（与DOM中的事件模型相同）。再看一个例子。

```
<input type="button" value="Click Me" onclick="alert(event.type)">
```

IE的event对象同样也包含与创建它的事件相关的属性和方法。其中很多属性和方法都有对应的或者相关的DOM属性和方法。与DOM的event对象一样，这些属性和方法也会因为事件类型的不同而不同，但所有事件对象都会包含下表所列的属性和方法。

|属性/方法|类型|读/写|说明|
|:---|:---|:---|:---|
|cancelBubble|Boolean|读/写|默认值为false，但将其设置为true就可以取消事件冒泡（与DOM中的stopPropagation()方法的作用相同）|
|returnValue|Boolean|读/写|默认值为true，但将其设置为false就可以取消事件的默认行为（与DOM中的preventDefault()方法的作用相同）|
|srcElement|Element|只读|事件的目标（与DOM中的target属性相同）|
|type|String|只读|被触发的事件的类型|


因为事件处理程序的作用域是根据指定它的方式来确定的，所以不能认为this会始终等于事件目标。故而，最好还是使用event.srcElement比较保险。例如：var btn = document.getElementById("myBtn"); btn.onclick = function(){     alert(window.event.srcElement === this);    //true }; btn.attachEvent("onclick", function(event){     alert(event.srcElement === this);           //false });\

在第一个事件处理程序中（使用DOM0级方法指定的），srcElement属性等于this，但在第二个事件处理程序中，这两者的值不相同。如前所述，returnValue属性相当于DOM中的preventDefault()方法，它们的作用都是取消给定事件的默认行为。只要将returnValue设置为false，就可以阻止默认行为。来看下面的例子。var link = document.getElementById("myLink"); link.onclick = function(){     window.event.returnValue = false; };

这个例子在onclick事件处理程序中使用returnValue达到了阻止链接默认行为的目的。与DOM不同的是，在此没有办法确定事件是否能被取消。相应地，cancelBubble属性与DOM中的stopPropagation()方法作用相同，都是用来停止事件冒泡的。由于IE不支持事件捕获，因而只能取消事件冒泡；但stopPropagatioin()可以同时取消事件捕获和冒泡。例如：var btn = document.getElementById("myBtn"); btn.onclick = function(){     alert("Clicked");     window.event.cancelBubble = true; }; document.body.onclick = function(){     alert("Body clicked"); };

通过在onclick事件处理程序中将cancelBubble设置为true，就可阻止事件通过冒泡而触发document.body中注册的事件处理程序。结果，在单击按钮之后，只会显示一个警告框。


**13.3.3 跨浏览器的事件对象**

虽然DOM和IE中的event对象不同，但基于它们之间的相似性依旧可以拿出跨浏览器的方案来。IE中event对象的全部信息和方法DOM对象中都有，只不过实现方式不一样。不过，这种对应关系让实现两种事件模型之间的映射非常容易。可以对前面介绍的EventUtil对象加以增强，添加如下方法以求同存异。var EventUtil = {     addHandler: function(element, type, handler){         //省略的代码    },     getEvent: function(event){         return event ? event : window.event;     },     getTarget: function(event){         return event.target || event.srcElement;     },     preventDefault: function(event){         if (event.preventDefault){             event.preventDefault();         } else {             event.returnValue = false;         }     },     removeHandler: function(element, type, handler){         //省略的代码    },     stopPropagation: function(event){if (event.stopPropagation){             event.stopPropagation();         } else {             event.cancelBubble = true;         }     } }; 

以上代码显示，我们为EventUtil添加了4个新方法。第一个是getEvent()，它返回对event对象的引用。考虑到IE中事件对象的位置不同，可以使用这个方法来取得event对象，而不必担心指定事件处理程序的方式。在使用这个方法时，必须假设有一个事件对象传入到事件处理程序中，而且要把该变量传给这个方法，如下所示。btn.onclick = function(event){     event = EventUtil.getEvent(event); };

在兼容DOM的浏览器中，event变量只是简单地传入和返回。而在IE中，event参数是未定义的（undefined），因此就会返回window.event。将这一行代码添加到事件处理程序的开头，就可以确保随时都能使用event对象，而不必担心用户使用的是什么浏览器。第二个方法是getTarget()，它返回事件的目标。在这个方法内部，会检测event对象的target属性，如果存在则返回该属性的值；否则，返回srcElement属性的值。可以像下面这样使用这个方法。btn.onclick = function(event){     event = EventUtil.getEvent(event);     var target = EventUtil.getTarget(event); };

第三个方法是preventDefault()，用于取消事件的默认行为。在传入event对象后，这个方法会检查是否存在preventDefault()方法，如果存在则调用该方法。如果preventDefault()方法不存在，则将returnValue设置为false。下面是使用这个方法的例子。var link = document.getElementById("myLink"); link.onclick = function(event){     event = EventUtil.getEvent(event);     EventUtil.preventDefault(event); };

以上代码可以确保在所有浏览器中单击该链接都不会打开另一个页面。首先，使用EventUtil. getEvent()取得event对象，然后将其传入到EventUtil.preventDefault()以取消默认行为。第四个方法是stopPropagation()，其实现方式类似。首先尝试使用DOM方法阻止事件流，否则就使用cancelBubble属性。下面看一个例子。

var btn = document.getElementById("myBtn"); btn.onclick = function(event){     alert("Clicked");     event = EventUtil.getEvent(event);     EventUtil.stopPropagation(event); }; document.body.onclick = function(event){     alert("Body clicked"); };

在此，首先使用EventUtil.getEvent()取得了event对象，然后又将其传入到EventUtil. stopPropagation()。别忘了由于IE不支持事件捕获，因此这个方法在跨浏览器的情况下，也只能用来阻止事件冒泡。

**13.4 事件类型**

Web浏览器中可能发生的事件有很多类型。如前所述，不同的事件类型具有不同的信息，而“DOM3级事件”规定了以下几类事件。
- UI（User Interface，用户界面）事件，当用户与页面上的元素交互时触发；
- 焦点事件，当元素获得或失去焦点时触发；
- 鼠标事件，当用户通过鼠标在页面上执行操作时触发；
- 滚轮事件，当使用鼠标滚轮（或类似设备）时触发；
- 文本事件，当在文档中输入文本时触发；
- 键盘事件，当用户通过键盘在页面上执行操作时触发；
- 合成事件，当为IME（Input Method Editor，输入法编辑器）输入字符时触发；
- 变动（mutation）事件，当底层DOM结构发生变化时触发。
- 变动名称事件，当元素或属性名变动时触发。此类事件已经被废弃，没有任何浏览器实现它们，因此本章不做介绍。
 
除了这几类事件之外，HTML5也定义了一组事件，而有些浏览器还会在DOM和BOM中实现其他专有事件。这些专有的事件一般都是根据开发人员需求定制的，没有什么规范，因此不同浏览器的实现有可能不一致。DOM3级事件模块在DOM2级事件模块基础上重新定义了这些事件，也添加了一些新事件。包括IE9在内的所有主流浏览器都支持DOM2级事件。IE9也支持DOM3级事件。

**13.4.1 UI事件**

UI事件指的是那些不一定与用户操作有关的事件。这些事件在DOM规范出现之前，都是以这种或那种形式存在的，而在DOM规范中保留是为了向后兼容。现有的UI事件如下。
- DOMActivate：表示元素已经被用户操作（通过鼠标或键盘）激活。这个事件在DOM3级事件中被废弃，但Firefox 2+和Chrome支持它。考虑到不同浏览器实现的差异，不建议使用这个事件。
- load：当页面完全加载后在window上面触发，当所有框架都加载完毕时在框架集上面触发，当图像加载完毕时在img元素上面触发，或者当嵌入的内容加载完毕时在object元素上面触发。
- unload：当页面完全卸载后在window上面触发，当所有框架都卸载后在框架集上面触发，或者当嵌入的内容卸载完毕后在object元素上面触发。
- abort：在用户停止下载过程时，如果嵌入的内容没有加载完，则在object元素上面触发。
- error：当发生JavaScript错误时在window上面触发，当无法加载图像时在img元素上面触发，当无法加载嵌入内容时在object元素上面触发，或者当有一或多个框架无法加载时在框架集上面触发。第17章将继续讨论这个事件。
- select：当用户选择文本框（input或texterea）中的一或多个字符时触发。第14章将继续讨论这个事件。
- resize：当窗口或框架的大小变化时在window或框架上面触发。
- scroll：当用户滚动带滚动条的元素中的内容时，在该元素上面触发。body元素中包含所加载页面的滚动条。

多数这些事件都与window对象或表单控件相关。除了DOMActivate之外，其他事件在DOM2级事件中都归为HTML事件（DOMActivate在DOM2级中仍然属于UI事件）。要确定浏览器是否支持DOM2级事件规定的HTML事件，可以使用如下代码：
```
var isSupported = document.implementation.hasFeature("HTMLEvents", "2.0");
```
注意，只有根据“DOM2级事件”实现这些事件的浏览器才会返回true。而以非标准方式支持这些事件的浏览器则会返回false。要确定浏览器是否支持“DOM3级事件”定义的事件，可以使用如下代码：
```
var isSupported = document.implementation.hasFeature("UIEvent", "3.0"); 
```

**13.4.2 焦点事件**

焦点事件会在页面元素获得或失去焦点时触发。利用这些事件并与document.hasFocus()方法及document.activeElement属性配合，可以知晓用户在页面上的行踪。有以下6个焦点事件。
- blur：在元素失去焦点时触发。这个事件不会冒泡；所有浏览器都支持它。
- DOMFocusIn：在元素获得焦点时触发。这个事件与HTML事件focus等价，但它冒泡。只有Opera支持这个事件。DOM3级事件废弃了DOMFocusIn，选择了focusin。
- DOMFocusOut：在元素失去焦点时触发。这个事件是HTML事件blur的通用版本。只有Opera支持这个事件。DOM3级事件废弃了DOMFocusOut，选择了focusout。
- focus：在元素获得焦点时触发。这个事件不会冒泡；所有浏览器都支持它。
- focusin：在元素获得焦点时触发。这个事件与HTML事件focus等价，但它冒泡。支持这个事件的浏览器有IE5.5+、Safari 5.1+、Opera 11.5+和Chrome。
- focusout：在元素失去焦点时触发。这个事件是HTML事件blur的通用版本。支持这个事件的浏览器有IE5.5+、Safari 5.1+、Opera 11.5+和Chrome。

这一类事件中最主要的两个是focus和blur，它们都是JavaScript早期就得到所有浏览器支持的事件。这些事件的最大问题是它们不冒泡。因此，IE的focusin和focusout与Opera的DOMFocusIn和DOMFocusOut才会发生重叠。IE的方式最后被DOM3级事件采纳为标准方式。当焦点从页面中的一个元素移动到另一个元素，会依次触发下列事件：
1. focusout在失去焦点的元素上触发
2. focusin在获得焦点的元素上触发
3. blur在失去焦点的元素上触发
4. DOMFocusOut在失去焦点的元素上触发
5. focus在获得焦点的元素上触发
6. DOMFocusIn在获得焦点的元素上触发。

其中，blur、DOMFocusOut和focusout的事件目标是失去焦点的元素；而focus、DOMFocusIn和focusin的事件目标是获得焦点的元素。要确定浏览器是否支持这些事件，可以使用如下代码：
```
var isSupported = document.implementation.hasFeature("FocusEvent", "3.0");
```

即使focus和blur不冒泡，也可以在捕获阶段侦听到它们。Peter-Paul Koch就此写过一篇非常棒的文章：www.quirksmode.org/blog/archives/2008/04/delegating_the.html。

**13.4.3 鼠标与滚轮事件**
**13.4.4 键盘与文本事件**
**13.4.5 复合事件**

复合事件（composition event）是DOM3级事件中新添加的一类事件，用于处理IME 的输入序列。IME（Input Method Editor，输入法编辑器）可以让用户输入在物理键盘上找不到的字符。例如，使用拉丁文键盘的用户通过IME照样能输入日文字符。IME通常需要同时按住多个键，但最终只输入一个字符。复合事件就是针对检测和处理这种输入而设计的。有以下三种复合事件。
- compositionstart：在IME的文本复合系统打开时触发，表示要开始输入了。
- compositionupdate：在向输入字段中插入新字符时触发。
- compositionend：在IME的文本复合系统关闭时触发，表示返回正常键盘输入状态。
 
复合事件与文本事件在很多方面都很相似。在触发复合事件时，目标是接收文本的输入字段。但它比文本事件的事件对象多一个属性data，其中包含以下几个值中的一个：
- 如果在compositionstart事件发生时访问，包含正在编辑的文本（例如，已经选中的需要马上替换的文本）；
- 如果在compositionupdate事件发生时访问，包含正插入的新字符；
- 如果在compositionend事件发生时访问，包含此次输入会话中插入的所有字符

与文本事件一样，必要时可以利用复合事件来筛选输入。可以像下面这样使用它们：var textbox = document.getElementById("myText"); EventUtil.addHandler(textbox, "compositionstart", function(event){     event = EventUtil.getEvent(event);     alert(event.data); });  EventUtil.addHandler(textbox, "compositionupdate", function(event){     event = EventUtil.getEvent(event);     alert(event.data); }); EventUtil.addHandler(textbox, "compositionend", function(event){     event = EventUtil.getEvent(event);     alert(event.data); });

IE9+是到2011年唯一支持复合事件的浏览器。由于缺少支持，对于需要开发跨浏览器应用的开发人员，它的用处不大。要确定浏览器是否支持复合事件，可以使用以下代码：var isSupported = document.implementation.hasFeature("CompositionEvent", "3.0");

**13.4.6 变动事件**

DOM2级的变动（mutation）事件能在DOM中的某一部分发生变化时给出提示。变动事件是为XML或HTMLDOM设计的，并不特定于某种语言。DOM2级定义了如下变动事件。
- DOMSubtreeModified：在DOM结构中发生任何变化时触发。这个事件在其他任何事件触发后都会触发。
- DOMNodeInserted：在一个节点作为子节点被插入到另一个节点中时触发。
- DOMNodeRemoved：在节点从其父节点中被移除时触发。
- DOMNodeInsertedIntoDocument：在一个节点被直接插入文档或通过子树间接插入文档之后触发。这个事件在DOMNodeInserted之后触发。
- DOMNodeRemovedFromDocument：在一个节点被直接从文档中移除或通过子树间接从文档中移除之前触发。这个事件在DOMNodeRemoved之后触发。
- DOMAttrModified：在特性被修改之后触发。
- DOMCharacterDataModified：在文本节点的值发生变化时触发。

使用下列代码可以检测出浏览器是否支持变动事件：
```
var isSupported = document.implementation.hasFeature("MutationEvents", "2.0");
```
IE8及更早版本不支持任何变动事件。下表列出了不同浏览器对不同变动事件的支持情况。

|事件|Opera 9+|Firefox 3+|Safari 3+及Chrome|IE9+|
|DOMSubtreeModified|－|支持|支持|支持|
|DOMNodeInserted|支持|支持|支持|支持|
|DOMNodeRemoved|支持|支持|支持|支持|

由于DOM3级事件模块作废了很多变动事件，所以本节只介绍那些将来仍然会得到支持的事件。

1. 删除节点
 
在使用removeChild()或replaceChild()从DOM中删除节点时，首先会触发DOMNodeRemoved事件。这个事件的目标（event.target）是被删除的节点，而event.relatedNode属性中包含着对目标节点父节点的引用。在这个事件触发时，节点尚未从其父节点删除，因此其parentNode属性仍然指向父节点（与event.relatedNode相同）。这个事件会冒泡，因而可以在DOM的任何层次上面处理它。

如果被移除的节点包含子节点，那么在其所有子节点以及这个被移除的节点上会相继触发DOMNodeRemovedFromDocument事件。但这个事件不会冒泡，所以只有直接指定给其中一个子节点的事件处理程序才会被调用。这个事件的目标是相应的子节点或者那个被移除的节点，除此之外event对象中不包含其他信息。紧随其后触发的是DOMSubtreeModified事件。这个事件的目标是被移除节点的父节点；此时的event对象也不会提供与事件相关的其他信息。

为了理解上述事件的触发过程，下面我们就以一个简单的HTML页面为例。

```
<!DOCTYPE html>
<html>
<head>
<title>Node Removal Events Example</title>
</head>
<body>
<ul id="myList">
<li>Item 1</li>
<li>Item 2</li>
<li>Item 3</li>
</ul>
</body>
</html>
```
在这个例子中，我们假设要移除ul元素。此时，就会依次触发以下事件。
1. 在ul元素上触发DOMNodeRemoved事件。relatedNode属性等于document.body。
2. 在ul元素上触发DOMNodeRemovedFromDocument事件。
3. 在身为ul元素子节点的每个li元素及文本节点上触发DOMNodeRemovedFromDocument事件。
4. 在document.body上触发DOMSubtreeModified事件，因为ul元素是document.body的直接子元素。



**13.4.7 HTML5事件**
**13.4.8 设备事件**
**13.4.9 触摸与手势事件**

**13.5 内存与性能**
**13.5.1 事件委托**
**13.5.2 移除事件处理程序**

**13.6 模拟事件**
**13.6.1 DOM中的事件模拟**
**13.6.2 IE中的事件模拟**
**13.7 小结**

第14章 表单脚本
--------------

**14.1 表单的基础知识**
**14.1.1 提交表单**
**14.1.2 重置表单**
**14.1.2 表单字段**

**14.2 文本框脚本**
**14.2.1 选择文本**
**14.2.2 过滤输入**
**14.2.3 自动切换焦点**
**14.2.4 HTML5约束验证API**

**14.3 选择框脚本**
**14.3.1 选择选项**
**14.3.2 添加选项**
**14.3.3 移除选项**
**14.3.4 移动和重排选项**

**14.4 表单序列化**
**14.5 富文本编辑**
**14.5.1 使用contenteditable属性**
**14.5.2 操作富文本**
**14.5.3 富文本选区**
**14.5.4 表单与富文本**
**14.6 小结**

第15章 使用Canvas绘图
---------------------

**15.1 基本用法**
**15.2 2D上下文**
**15.2.1 填充和描边**
**15.2.2 绘制矩形**
**15.2.3 绘制路径**
**15.2.4 绘制文本**
**15.2.5 变换**
**15.2.6 绘制图像**
**15.2.7 阴影**
**15.2.8 渐变**
**15.2.9 模式**
**15.2.10 使用图像数据**
**15.2.11 合成**

**15.3 WebGL**
**15.3.1 类型化数组**
**15.3.2 WebGL上下文**
**15.3.3 支持**
**15.4 小结**

第16章 HTML5脚本编程
-------------------

**16.1 跨文档消息传递**
**16.2 原生拖放**
**16.2.1 拖放事件**
**16.2.2 自定义放置目标**
**16.2.3 dataTransfer对象**
**16.2.4 dropEffect与effectAllowed**
**16.2.5 可拖动**
**16.2.6 其他成员**

**16.3 媒体元素**
**16.3.1 属性**
**16.3.2 事件**
**16.3.3 自定义媒体播放器**
**16.3.4 检测编码器的支持情况**
**16.3.5 Audio类型**
**16.4 历史状态管理**
**16.5 小结**

第17章 错误处理与调试
---------------------

**17.1 浏览器报告的错误**
**17.1.1 IE**
**17.1.2 Firefox**
**17.1.3 Safari**
**17.1.4 Opera**
**17.1.5 Chrome**

**17.2 错误处理**
**17.2.1 try-catch语句**
**17.2.2 抛出错误**
**17.2.3 错误(error)事件**
**17.2.4 处理错误的策略**
**17.2.5 常见的错误类型**
**17.2.6 区分致命错误和非致命错误**
**17.2.7 把错误记录到服务器**
**17.3 调试技术**
**17.3.1 将消息记录到控制台**
**17.3.1 将消息记录到当前页面**
**17.3.1 抛出错误**

**17.4 常见的IE错误**
**17.4.1 操作终止**
**17.4.2 无效字符**
**17.4.3 未找到成员**
**17.4.4 未知运行时错误**
**17.4.5 语法错误**
**17.4.6 系统无法找到指定资源**
**17.5 小结**

第18章 JavaScript与XML
---------------------

**18.1 浏览器对XML DOM的支持**
**18.1.1 DOM2级核心**
**18.1.2 DOMParser类型**
**18.1.3 XMLSerializer类型**
**18.1.4 IE8及之前版本中的XML**
**18.1.5 跨浏览器处理XML**
**18.2 浏览器对XPath的支持**
**18.2.1 DOM3级XPath**
**18.2.2 IE中的XPath**
**18.2.3 跨浏览器使用XPath**
**18.3 浏览器对XSLT的支持**
**18.3.1 IE中的XSLT**
**18.3.2 XSLTProcessor类型**
**18.3.3 跨浏览器使用XSLT**
**18.4 小结**

第19章 E4X
----------

**19.1 E4X的类型**
**19.1.1 XML类型**
**19.1.2 XMLList类型**
**19.1.3 Namespace类型**
**19.1.4 QName类型**
**19.2 一般用法**
**19.2.1 访问特性**
**19.2.2 其他节点类型**
**19.2.3 查询**
**19.2.4 构建和操作XML**
**19.2.5 解析和序列化L**
**19.2.6 命名空间**
**19.3 其他变化**
**19.4 全面启用E4X**
**19.5 小结**

第20章 JSON
-----------

**20.1 语法**
**20.1.1 简单值**
**20.1.2 对象**
**20.1.3 数组**
**20.2 解析与序列化**
**20.2.1 JSON对象**
**20.2.2 序列化选项**
**20.2.3 解析选项**
**20.3 小结**

第21章 Ajax与Comet
------------------

本章内容
- 使用 XMLHttpRequest 对象
- 使用 XMLHttpRequest 事件 
- 跨域 Ajax 通信的限制

2005年，Jesse James Garrett 发表了一篇在线文章，题为[“Ajax: A new Approach to Web Applications”](http://www.adaptivepath.com/ideas/essays/archives/000385.php)。他在这篇文章里介绍了一种技术，用他的话说，就叫Ajax，是对`Asynchronous JavaScript + XML`的简写。这一技术能够向服务器请求额外的数据而无须卸载页面，会带来更好的用户体验。Garrett还解释了怎样使用这一技术改变自从Web诞生以来就一直沿用的`“单击，等待”`的交互模式。

Ajax技术的核心是XMLHttpRequest对象(简称XHR)，这是由微软首先引入的一个特性，其他浏览器提供商后来都提供了相同的实现。在XHR出现之前，Ajax式的通信必须借助一些hack手段来实现，大多数是使用隐藏的框架或内嵌框架。XHR为向服务器发送请求和解析服务器响应提供了流畅的接口。能够以异步方式从服务器取得更多信息，意味着用户单击后，可以不必刷新页面也能取得新数据。也就是说，可以使用XHR对象取得新数据，然后再通过DOM将新数据插入到页面中。另外，虽然名字中包含XML的成分，但Ajax通信与数据格式无关;这种技术就是无须刷新页面即可从服务器取得数据，但不一定是XML数据。实际上，Garrett提到的这种技术已经存在很长时间了。在Garrett撰写那篇文章之前，人们通常将这种技术叫做远程脚本(remote scripting)，而且早在1998年就有人采用不同的手段实现了这种浏览器与服务器的通信。再往前推，JavaScript需要通过Java applet或Flash电影等中间层向服务器发送请求。 而XHR则将浏览器原生的通信能力提供给了开发人员，简化了实现同样操作的任务。

在重命名为Ajax之后，大约是2005年底2006年初，这种浏览器与服务器的通信技术可谓红极一 时。人们对JavaScript和Web的全新认识，催生了很多使用原有特性的新技术和新模式。就目前来说， 熟练使用XHR对象已经成为所有Web开发人员必须掌握的一种技能。

**21.1 XMLHttpRequest对象**

IE5是第一款引入XHR对象的浏览器。在IE5中，XHR对象是通过MSXML库中的一个ActiveX 12对象实现的。因此，在IE中可能会遇到三种不同版本的XHR对象，即MSXML2.XMLHttp、MSXML2.XMLHttp.3.0和MSXML2.XMLHttp.6.0。要使用MSXML库中的XHR对象，需要像第18章讨论创建XML文档时一样，编写一个函数，例如:

```
//适用于IE7之前的版本
function createXHR() {
    if (typeof arguments.callee.activeXString != "string") {
        var versions= ["MSXML2.XMLHttp.6.0", "MSXML2.XMLHttp.3.0", "MSXML2.XMLHttp"],
        i,
        len;
        for (i=0, len=versions.length; i < len; i++) {
            try {
                new ActiveXObject(versions[i]);
                arguments.callee.activeXString = versions[i];
                break;
            } catch (ex) {
                //跳过
            }
        }
    }
    return new ActiveXObject(arguments.callee.activeXString);
}
```

这个函数会尽力根据IE中可用的MSXML库的情况创建最新版本的XHR对象。

IE7+、Firefox、Opera、Chrome和Safari都支持原生的XHR对象，在这些浏览器中创建XHR对象要像下面这样使用XMLHttpRequest构造函数。

```
var xhr = new XMLHttpRequest();
```

假如你只想支持IE7及更高版本，那么大可丢掉前面定义的那个函数，而只用原生的XHR实现。但是，如果你必须还要支持IE的早期版本，那么则可以在这个createXHR()函数中加入对原生XHR对象的支持。
```
    function createXHR(){
        if (typeof XMLHttpRequest != "undefined") {
            return new XMLHttpRequest();
        } else if (typeof ActiveXObject != "undefined") {
            if (typeof arguments.callee.activeXString != "string"){
            var versions = [ "MSXML2.XMLHttp.6.0", "MSXML2.XMLHttp.3.0","MSXML2.XMLHttp"],
            i, len;

            for (i=0,len=versions.length; i < len; i++){
               try {
                   new ActiveXObject(versions[i]);
                   arguments.callee.activeXString = versions[i];
                   break;
                } catch (ex){
                    //跳过
                }
            }
            }
            return new ActiveXObject(arguments.callee.activeXString);
        } else {
            throw new Error("No XHR object available.");
        }
    }
```

这个函数中新增的代码首先检测原生XHR对象是否存在，如果存在则返回它的新实例。如果原生对象不存在，则检测ActiveX对象。如果这两种对象都不存在，就抛出一个错误。然后，就可以使用下面的代码在所有浏览器中创建XHR对象了。
```
var xhr = createXHR();
```

由于其他浏览器中对XHR的实现与IE最早的实现是兼容的，因此就可以在所有浏览器中都以相同方式使用上面创建的xhr对象。

**21.1.1 XHR的用法**

在使用XHR对象时，要调用的第一个方法是open()，它接受3个参数：要发送的请求的类型（"get"、"post"等）、请求的URL和表示是否异步发送请求的布尔值。下面就是调用这个方法的例子。

```
xhr.open("get", "example.php", false);
```

这行代码会启动一个针对example.php的GET请求。有关这行代码，需要说明两点：一是URL相对于执行代码的当前页面（当然也可以使用绝对路径）；二是调用open()方法并不会真正发送请求，而只是启动一个请求以备发送。

只能向同一个域中使用相同端口和协议的URL发送请求。如果URL与启动请求的页面有任何差别，都会引发安全错误。

要发送特定的请求，必须像下面这样调用send()方法：
```
xhr.open("get", "example.txt", false);
xhr.send(null);
```

这里的send()方法接收一个参数，即要作为请求主体发送的数据。如果不需要通过请求主体发送数据，则必须传入null，因为这个参数对有些浏览器来说是必需的。调用send()之后，请求就会被分派到服务器。由于这次请求是同步的，JavaScript代码会等到服务器响应之后再继续执行。在收到响应后，响应的数据会自动填充XHR对象的属性，相关的属性简介如下。
- responseText：作为响应主体被返回的文本。
- responseXML：如果响应的内容类型是"text/xml"或"application/xml"，这个属性中将保存包含着响应数据的XMLDOM文档。
- status：响应的HTTP状态。
- statusText：HTTP状态的说明。

在接收到响应后，第一步是检查status属性，以确定响应已经成功返回。一般来说，可以将HTTP状态代码为200作为成功的标志。此时，responseText属性的内容已经就绪，而且在内容类型正确的情况下，responseXML也应该能够访问了。此外，状态代码为304表示请求的资源并没有被修改，可以直接使用浏览器中缓存的版本；当然，也意味着响应是有效的。为确保接收到适当的响应，应该像下面这样检查上述这两种状态代码：
```
xhr.open("get", "example.txt", false);
xhr.send(null);
if ((xhr.status >= 200 && xhr.status < 300) || xhr.status == 304) {
    alert(xhr.responseText);
} else {
    alert("Request was unsuccessful: " + xhr.status);
} 
```

根据返回的状态代码，这个例子可能会显示由服务器返回的内容，也可能会显示一条错误消息。我们建议读者要通过检测status来决定下一步的操作，不要依赖statusText，因为后者在跨浏览器使用时不太可靠。另外，无论内容类型是什么，响应主体的内容都会保存到responseText属性中；而对于非XML数据而言，responseXML属性的值将为null。

有的浏览器会错误地报告204状态代码。IE中XHR的ActiveX版本会将204设置为1223，而IE中原生的XHR则会将204规范化为200。Opera会在取得204时报告status的值为0。

像前面这样发送同步请求当然没有问题，但多数情况下，我们还是要发送异步请求，才能让JavaScript继续执行而不必等待响应。此时，可以检测XHR对象的readyState属性，该属性表示请求/响应过程的当前活动阶段。这个属性可取的值如下。
- 0：未初始化。尚未调用open()方法。
- 1：启动。已经调用open()方法，但尚未调用send()方法。
- 2：发送。已经调用send()方法，但尚未接收到响应。
- 3：接收。已经接收到部分响应数据。
- 4：完成。已经接收到全部响应数据，而且已经可以在客户端使用了。
 
只要readyState属性的值由一个值变成另一个值，都会触发一次readystatechange事件。可以利用这个事件来检测每次状态变化后readyState的值。通常，我们只对readyState值为4的阶段感兴趣，因为这时所有数据都已经就绪。不过，必须在调用open()之前指定onreadystatechange事件处理程序才能确保跨浏览器兼容性。下面来看一个例子。

```
var xhr = createXHR();
xhr.onreadystatechange = function() {
    if (xhr.readyState == 4) {
        if ((xhr.status >= 200 && xhr.status < 300) || xhr.status == 304) {
            alert(xhr.responseText);
        } else {
            alert("Request was unsuccessful: " + xhr.status);
        }
    }
};
xhr.open("get", "example.txt", true);
xhr.send(null);
```

以上代码利用DOM0级方法为XHR对象添加了事件处理程序，原因是并非所有浏览器都支持DOM2级方法。与其他事件处理程序不同，这里没有向onreadystatechange事件处理程序中传递event对象；必须通过XHR对象本身来确定下一步该怎么做。

这个例子在onreadystatechange事件处理程序中使用了xhr对象，没有使用this对象，原因是onreadystatechange事件处理程序的作用域问题。如果使用this对象，在有的浏览器中会导致函数执行失败，或者导致错误发生。因此，使用实际的XHR对象实例变量是较为可靠的一种方式。

另外，在接收到响应之前还可以调用abort()方法来取消异步请求，如下所示：
```
xhr.abort();
```
调用这个方法后，XHR对象会停止触发事件，而且也不再允许访问任何与响应有关的对象属性。在终止请求之后，还应该对XHR对象进行解引用操作。由于内存原因，不建议重用XHR对象。

**21.1.2 HTTP头部信息**

每个HTTP请求和响应都会带有相应的头部信息，其中有的对开发人员有用，有的也没有什么用。XHR对象也提供了操作这两种头部（即请求头部和响应头部）信息的方法。默认情况下，在发送XHR请求的同时，还会发送下列头部信息。
- Accept：浏览器能够处理的内容类型。
- Accept-Charset：浏览器能够显示的字符集。
- Accept-Encoding：浏览器能够处理的压缩编码。
- Accept-Language：浏览器当前设置的语言。
- Connection：浏览器与服务器之间连接的类型。
- Cookie：当前页面设置的任何Cookie。
- Host：发出请求的页面所在的域。
- Referer：发出请求的页面的URI。注意，HTTP规范将这个头部字段拼写错了，而为保证与规范一致，也只能将错就错了。（这个英文单词的正确拼法应该是referrer。）
- User-Agent：浏览器的用户代理字符串。

虽然不同浏览器实际发送的头部信息会有所不同，但以上列出的基本上是所有浏览器都会发送的。使用setRequestHeader()方法可以设置自定义的请求头部信息。这个方法接受两个参数：头部字段的名称和头部字段的值。要成功发送请求头部信息，必须在调用open()方法之后且调用send()方法之前调用setRequestHeader()，如下面的例子所示。

```
var xhr = createXHR();
xhr.onreadystatechange = function() {
    if (xhr.readyState == 4) {
        if ((xhr.status >= 200 && xhr.status < 300) || xhr.status == 304) {
            alert(xhr.responseText);
        } else {
            alert("Request was unsuccessful: " + xhr.status);
        }
    };
    xhr.open("get", "example.php", true);
    xhr.setRequestHeader("MyHeader", "MyValue");
    xhr.send(null);
```

服务器在接收到这种自定义的头部信息之后，可以执行相应的后续操作。我们建议读者使用自定义的头部字段名称，不要使用浏览器正常发送的字段名称，否则有可能会影响服务器的响应。有的浏览器允许开发人员重写默认的头部信息，但有的浏览器则不允许这样做。调用XHR对象的getResponseHeader()方法并传入头部字段名称，可以取得相应的响应头部信息。而调用getAllResponseHeaders()方法则可以取得一个包含所有头部信息的长字符串。来看下面的例子。
```
var myHeader = xhr.getResponseHeader("MyHeader");
var allHeaders = xhr.getAllResponseHeaders();
```

在服务器端，也可以利用头部信息向浏览器发送额外的、结构化的数据。在没有自定义信息的情况下，getAllResponseHeaders()方法通常会返回如下所示的多行文本内容：
```
Date: Sun, 14 Nov 2004 18:04:03 GMT
Server: Apache/1.3.29 (Unix) 
Vary: Accept
X-Powered-By: PHP/4.3.8 
Connection: close
Content-Type: text/html;
charset=iso-8859-1 
```

这种格式化的输出可以方便我们检查响应中所有头部字段的名称，而不必一个一个地检查某个字段是否存在。

**21.1.3 GET请求**

GET是最常见的请求类型，最常用于向服务器查询某些信息。必要时，可以将查询字符串参数追加到URL的末尾，以便将信息发送给服务器。对XHR而言，位于传入open()方法的URL末尾的查询字符串必须经过正确的编码才行。使用GET请求经常会发生的一个错误，就是查询字符串的格式有问题。查询字符串中每个参数的名称和值都必须使用encodeURIComponent()进行编码，然后才能放到URL的末尾；而且所有名-值对儿都必须由和号`&`分隔，如下面的例子所示。

```
xhr.open("get", "example.php?name1=value1&name2=value2", true);
```

下面这个函数可以辅助向现有URL的末尾添加查询字符串参数：
```
function addURLParam(url, name, value) {
    url += (url.indexOf("?") == -1 ? "?" : "&");
    url += encodeURIComponent(name) + "=" + encodeURIComponent(value);
    return url;
}
```
这个addURLParam()函数接受三个参数：要添加参数的URL、参数的名称和参数的值。这个函数首先检查URL是否包含问号（以确定是否已经有参数存在）。如果没有，就添加一个问号；否则，就添加一个和号。然后，将参数名称和值进行编码，再添加到URL的末尾。最后返回添加参数之后的URL。

下面是使用这个函数来构建请求URL的示例。
```
var url = "example.php";
//添加参数
url = addURLParam(url, "name", "Nicholas");
url = addURLParam(url, "book", "Professional JavaScript");
//初始化请求
xhr.open("get", url, false);
```
在这里使用addURLParam()函数可以确保查询字符串的格式良好，并可靠地用于XHR对象。

**21.1.4 POST请求**

使用频率仅次于GET的是POST请求，通常用于向服务器发送应该被保存的数据。POST请求应该把数据作为请求的主体提交，而GET请求传统上不是这样。POST请求的主体可以包含非常多的数据，而且格式不限。在open()方法第一个参数的位置传入"post"，就可以初始化一个POST请求，如下面的例子所示。
```
xhr.open("post", "example.php", true);
```

发送POST请求的第二步就是向send()方法中传入某些数据。由于XHR最初的设计主要是为了处理XML，因此可以在此传入XMLDOM文档，传入的文档经序列化之后将作为请求主体被提交到服务器。当然，也可以在此传入任何想发送到服务器的字符串。默认情况下，服务器对POST请求和提交Web表单的请求并不会一视同仁。因此，服务器端必须有程序来读取发送过来的原始数据，并从中解析出有用的部分。不过，我们可以使用XHR来模仿表单提交：首先将Content-Type头部信息设置为`application/x-www-form-urlencoded`，也就是表单提交时的内容类型，其次是以适当的格式创建一个字符串。第14章曾经讨论过，POST数据的格式与查询字符串格式相同。如果需要将页面中表单的数据进行序列化，然后再通过XHR发送到服务器，那么就可以使用第14章介绍的serialize()函数来创建这个字符串：

```
function submitData() {
    var xhr = createXHR();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            if ((xhr.status >= 200 && xhr.status < 300) || xhr.status == 304){
                alert(xhr.responseText);
            } else {
                alert("Request was unsuccessful: " + xhr.status);
            }
        }
    };
    xhr.open("post", "postexample.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    var form = document.getElementById("user-info");
    xhr.send(serialize(form));
}
```

这个函数可以将ID为"user-info"的表单中的数据序列化之后发送给服务器。而下面的示例PHP文件postexample.php就可以通过`$_POST`取得提交的数据了：
```
<?php
    header("Content-Type: text/plain");
    echo <<<EOF
    Name: {$_POST[‘user-name’]}
    Email: {$_POST[‘user-email’]}
    EOF;
?>
```

如果不设置Content-Type头部信息，那么发送给服务器的数据就不会出现在`$_POST`超级全局变量中。这时候，要访问同样的数据，就必须借助`$HTTP_RAW_POST_DATA`。

与GET请求相比，POST请求消耗的资源会更多一些。从性能角度来看，以发送相同的数据计，GET请求的速度最多可达到POST请求的两倍。

**21.2 XMLHttpRequest2级**

鉴于XHR已经得到广泛接受，成为了事实标准，W3C也着手制定相应的标准以规范其行为。XMLHttpRequest1级只是把已有的XHR对象的实现细节描述了出来。而XMLHttpRequest2级则进一步发展了XHR。并非所有浏览器都完整地实现了XMLHttpRequest2级规范，但所有浏览器都实现了它规定的部分内容。

**21.2.1 FormData**

现代Web应用中频繁使用的一项功能就是表单数据的序列化，XMLHttpRequest2级为此定义了FormData类型。FormData为序列化表单以及创建与表单格式相同的数据（用于通过XHR传输）提供了便利。下面的代码创建了一个FormData对象，并向其中添加了一些数据。
```
var data = new FormData();
data.append("name", "Nicholas");
```
这个append()方法接收两个参数：键和值，分别对应表单字段的名字和字段中包含的值。可以像这样添加任意多个键值对儿。而通过向FormData构造函数中传入表单元素，也可以用表单元素的数据预先向其中填入键值对儿：
```
var data = new FormData(document.forms[0]);
```

创建了FormData的实例后，可以将它直接传给XHR的send()方法，如下所示：

```
var xhr = createXHR();
xhr.onreadystatechange = function() {
    if (xhr.readyState == 4) {
        if ( (xhr.status >= 200 && xhr.status < 300) || xhr.status == 304 ) {
            alert(xhr.responseText);
        } else {
            alert("Request was unsuccessful: " + xhr.status);\
        }
    }
};
xhr.open("post","postexample.php", true);
var form = document.getElementById("user-info");
xhr.send(new FormData(form));
```

使用FormData的方便之处体现在不必明确地在XHR对象上设置请求头部。XHR对象能够识别传入的数据类型是FormData的实例，并配置适当的头部信息。支持FormData的浏览器有Firefox 4+、Safari 5+、Chrome和Android 3+版WebKit。

**21.2.2 超时设定**

IE8为XHR对象添加了一个timeout属性，表示请求在等待响应多少毫秒之后就终止。在给timeout设置一个数值后，如果在规定的时间内浏览器还没有接收到响应，那么就会触发timeout事件，进而会调用ontimeout事件处理程序。这项功能后来也被收入了XMLHttpRequest2级规范中。来看下面的例子。

```
var xhr = createXHR();
xhr.onreadystatechange = function() {
    if (xhr.readyState == 4) {
        try {
            if ((xhr.status >= 200 && xhr.status < 300) || xhr.status == 304) {
                alert(xhr.responseText);
            } else {
                alert("Request was unsuccessful: " + xhr.status);
            }
        } catch (ex) {
            //假设由ontimeout事件处理程序处理 
        }
    }
};
xhr.open("get", "timeout.php", true);
xhr.timeout = 1000; 
//将超时设置为1秒钟（仅适用于IE8+）
xhr.ontimeout = function() {
    alert("Request did not return in a second.");
};
xhr.send(null);
```

这个例子示范了如何使用timeout属性。将这个属性设置为1000毫秒，意味着如果请求在1秒钟内还没有返回，就会自动终止。请求终止时，会调用ontimeout事件处理程序。但此时readyState可能已经改变为4了，这意味着会调用onreadystatechange事件处理程序。可是，如果在超时终止请求之后再访问status属性，就会导致错误。为避免浏览器报告错误，可以将检查status属性的语句封装在一个try-catch语句当中。在写作本书时，IE8+仍然是唯一支持超时设定的浏览器。

**21.2.3 overrideMimeType()方法**

Firefox最早引入了overrideMimeType()方法，用于重写XHR响应的MIME类型。这个方法后来也被纳入了XMLHttpRequest2级规范。因为返回响应的MIME类型决定了XHR对象如何处理它，所以提供一种方法能够重写服务器返回的MIME类型是很有用的。比如，服务器返回的MIME类型是text/plain，但数据中实际包含的是XML。根据MIME类型，即使数据是XML，responseXML属性中仍然是null。通过调用overrideMimeType()方法，可以保证把响应当作XML而非纯文本来处理。
```
var xhr = createXHR();
xhr.open("get", "text.php", true);
xhr.overrideMimeType("text/xml");
xhr.send(null);
```
这个例子强迫XHR对象将响应当作XML而非纯文本来处理。调用overrideMimeType()必须在send()方法之前，才能保证重写响应的MIME类型。支持overrideMimeType()方法的浏览器有Firefox、Safari 4+、Opera 10.5和Chrome。

**21.3 进度事件**

Progress Events规范是W3C的一个工作草案，定义了与客户端服务器通信有关的事件。这些事件最早其实只针对XHR操作，但目前也被其他API借鉴。有以下6个进度事件。
- loadstart：在接收到响应数据的第一个字节时触发。
- progress：在接收响应期间持续不断地触发。
- error：在请求发生错误时触发。
- abort：在因为调用abort()方法而终止连接时触发。
- load：在接收到完整的响应数据时触发。
- loadend：在通信完成或者触发error、abort或load事件后触发。
 
每个请求都从触发loadstart事件开始，接下来是一或多个progress事件，然后触发error、abort或load事件中的一个，最后以触发loadend事件结束。支持前5个事件的浏览器有Firefox 3.5+、Safari 4+、Chrome、iOS版Safari和Android版WebKit。Opera（从第11版开始）、IE 8+只支持load事件。目前还没有浏览器支持loadend事件。这些事件大都很直观，但其中两个事件有一些细节需要注意。

**21.3.1 load事件**

Firefox在实现XHR对象的某个版本时，曾致力于简化异步交互模型。最终，Firefox实现中引入了load事件，用以替代readystatechange事件。响应接收完毕后将触发load事件，因此也就没有必要去检查readyState属性了。而onload事件处理程序会接收到一个event对象，其target属性就指向XHR对象实例，因而可以访问到XHR对象的所有方法和属性。然而，并非所有浏览器都为这个事件实现了适当的事件对象。结果，开发人员还是要像下面这样被迫使用XHR对象变量。
```
var xhr = createXHR();
xhr.onload = function() {
    if ((xhr.status >= 200 && xhr.status < 300) || xhr.status == 304){
        alert(xhr.responseText);
    } else {
        alert("Request was unsuccessful: " + xhr.status);
    }
};
xhr.open("get", "altevents.php", true);
xhr.send(null);
```

只要浏览器接收到服务器的响应，不管其状态如何，都会触发load事件。而这意味着你必须要检查status属性，才能确定数据是否真的已经可用了。Firefox、Opera、Chrome和Safari都支持load事件。

**21.3.2 progress事件**

Mozilla对XHR的另一个革新是添加了progress事件，这个事件会在浏览器接收新数据期间周期性地触发。而onprogress事件处理程序会接收到一个event对象，其target属性是XHR对象，但包含着三个额外的属性：lengthComputable、position和totalSize。其中，lengthComputable是一个表示进度信息是否可用的布尔值，position表示已经接收的字节数，totalSize表示根据Content-Length响应头部确定的预期字节数。有了这些信息，我们就可以为用户创建一个进度指示器了。下面展示了为用户创建进度指示器的一个示例。

```
var xhr = createXHR();
xhr.onload = function(event) {
    if ((xhr.status >= 200 && xhr.status < 300) || xhr.status == 304) {
        alert(xhr.responseText);
    } else {
        alert("Request was unsuccessful: " + xhr.status);
    }
};
xhr.onprogress = function(event) {
    var divStatus = document.getElementById("status");
    if (event.lengthComputable) {
        divStatus.innerHTML = "Received " + event.position + "of" + event.totalSize + " bytes";
    }
};
xhr.open("get", "altevents.php", true);
xhr.send(null);
```

为确保正常执行，必须在调用open()方法之前添加onprogress事件处理程序。在前面的例子中，每次触发progress事件，都会以新的状态信息更新HTML元素的内容。如果响应头部中包含Content-Length字段，那么也可以利用此信息来计算从响应中已经接收到的数据的百分比。

**21.4 跨域资源共享**

通过XHR实现Ajax通信的一个主要限制，来源于跨域安全策略。默认情况下，XHR对象只能访问与包含它的页面位于同一个域中的资源。这种安全策略可以预防某些恶意行为。但是，实现合理的跨域请求对开发某些浏览器应用程序也是至关重要的。CORS（Cross-Origin Resource Sharing，跨源资源共享）是W3C的一个工作草案，定义了在必须访问跨源资源时，浏览器与服务器应该如何沟通。CORS背后的基本思想，就是使用自定义的HTTP头部让浏览器与服务器进行沟通，从而决定请求或响应是应该成功，还是应该失败。比如一个简单的使用GET或POST发送的请求，它没有自定义的头部，而主体内容是text/plain。在发送该请求时，需要给它附加一个额外的Origin头部，其中包含请求页面的源信息（协议、域名和端口），以便服务器根据这个头部信息来决定是否给予响应。下面是Origin头部的一个示例：
```
Origin: http://www.nczonline.net
```
如果服务器认为这个请求可以接受，就在Access-Control-Allow-Origin头部中回发相同的源信息（如果是公共资源，可以回发"*"）。例如：

```
Access-Control-Allow-Origin: http://www.nczonline.net
```

如果没有这个头部，或者有这个头部但源信息不匹配，浏览器就会驳回请求。正常情况下，浏览器会处理请求。注意，请求和响应都不包含cookie信息。

**21.4.1 IE对CORS的实现**

微软在IE8中引入了XDR（XDomainRequest）类型。这个对象与XHR类似，但能实现安全可靠的跨域通信。XDR对象的安全机制部分实现了W3C的CORS规范。以下是XDR与XHR的一些不同之处。
- cookie不会随请求发送，也不会随响应返回。
- 只能设置请求头部信息中的Content-Type字段。
- 不能访问响应头部信息。
- 只支持GET和POST请求。
 
这些变化使CSRF（Cross-Site Request Forgery，跨站点请求伪造）和XSS（Cross-Site Scripting，跨站点脚本）的问题得到了缓解。被请求的资源可以根据它认为合适的任意数据（用户代理、来源页面等）来决定是否设置Access-Control-Allow-Origin头部。作为请求的一部分，Origin头部的值表示请求的来源域，以便远程资源明确地识别XDR请求。XDR对象的使用方法与XHR对象非常相似。也是创建一个XDomainRequest的实例，调用open()方法，再调用send()方法。但与XHR对象的open()方法不同，XDR对象的open()方法只接收两个参数：请求的类型和URL。所有XDR请求都是异步执行的，不能用它来创建同步请求。请求返回之后，会触发load事件，响应的数据也会保存在responseText属性中，如下所示。

```
var xdr = new XDomainRequest();
xdr.onload = function() {
    alert(xdr.responseText);
};
xdr.open("get", "http://www.somewhere-else.com/page/");
xdr.send(null);
```

在接收到响应后，你只能访问响应的原始文本；没有办法确定响应的状态代码。而且，只要响应有效就会触发load事件，如果失败（包括响应中缺少Access-Control-Allow-Origin头部）就会触发error事件。遗憾的是，除了错误本身之外，没有其他信息可用，因此唯一能够确定的就只有请求未成功了。要检测错误，可以像下面这样指定一个onerror事件处理程序。
```
var xdr = new XDomainRequest(); xdr.onload = function(){     alert(xdr.responseText); }; xdr.onerror = function(){     alert("An error occurred."); }; xdr.open("get", "http://www.somewhere-else.com/page/"); xdr.send(null);
```

鉴于导致XDR请求失败的因素很多，因此建议你不要忘记通过onerror事件处理程序来捕获该事件；否则，即使请求失败也不会有任何提示。

在请求返回前调用abort()方法可以终止请求：
```
xdr.abort(); //终止请求
```

与XHR一样，XDR对象也支持timeout属性以及ontimeout事件处理程序。下面是一个例子。
```
var xdr = new XDomainRequest(); xdr.onload = function(){     alert(xdr.responseText); }; xdr.onerror = function(){     alert("An error occurred."); }; xdr.timeout = 1000; xdr.ontimeout = function(){     alert("Request took too long."); }; xdr.open("get", "http://www.somewhere-else.com/page/"); xdr.send(null); 
```

这个例子会在运行1秒钟后超时，并随即调用ontimeout事件处理程序。为支持POST请求，XDR对象提供了contentType属性，用来表示发送数据的格式，如下面的例子所示。

```
var xdr = new XDomainRequest(); xdr.onload = function(){     alert(xdr.responseText); }; xdr.onerror = function(){     alert("An error occurred."); }; xdr.open("post", "http://www.somewhere-else.com/page/"); xdr.contentType = "application/x-www-form-urlencoded"; xdr.send("name1=value1&name2=value2");
```

这个属性是通过XDR对象影响头部信息的唯一方式。

**21.4.2 其他浏览器对CORS的实现**

Firefox 3.5+、Safari 4+、Chrome、iOS版Safari和Android平台中的WebKit都通过XMLHttpRequest对象实现了对CORS的原生支持。在尝试打开不同来源的资源时，无需额外编写代码就可以触发这个行为。要请求位于另一个域中的资源，使用标准的XHR对象并在open()方法中传入绝对URL即可，例如：
```
var xhr = createXHR();
xhr.onreadystatechange = function() {
    if (xhr.readyState == 4) {
        if ((xhr.status >= 200 && xhr.status < 300) || xhr.status == 304) {
            alert(xhr.responseText);
        } else {
            alert("Request was unsuccessful: " + xhr.status);
        }
    }
};
xhr.open("get", "http://www.somewhere-else.com/page/", true);
xhr.send(null);
```

与IE中的XDR对象不同，通过跨域XHR对象可以访问status和statusText属性，而且还支持同步请求。跨域XHR对象也有一些限制，但为了安全这些限制是必需的。以下就是这些限制。
- 不能使用setRequestHeader()设置自定义头部。
- 不能发送和接收cookie。
- 调用getAllResponseHeaders()方法总会返回空字符串。

由于无论同源请求还是跨源请求都使用相同的接口，因此对于本地资源，最好使用相对URL，在访问远程资源时再使用绝对URL。这样做能消除歧义，避免出现限制访问头部或本地cookie信息等问题。

**21.4.3 Preflighted Requests**

CORS通过一种叫做PreflightedRequests的透明服务器验证机制支持开发人员使用自定义的头部、GET或POST之外的方法，以及不同类型的主体内容。在使用下列高级选项来发送请求时，就会向服务器发送一个Preflight请求。这种请求使用OPTIONS方法，发送下列头部。
- Origin：与简单的请求相同。
- Access-Control-Request-Method：请求自身使用的方法。
- Access-Control-Request-Headers：（可选）自定义的头部信息，多个头部以逗号分隔。
 
以下是一个带有自定义头部NCZ的使用POST方法发送的请求。

```
Origin: http://www.nczonline.net
Access-Control-Request-Method: POST
Access-Control-Request-Headers: NCZ
```

发送这个请求后，服务器可以决定是否允许这种类型的请求。服务器通过在响应中发送如下头部与浏览器进行沟通。
- Access-Control-Allow-Origin：与简单的请求相同。
- Access-Control-Allow-Methods：允许的方法，多个方法以逗号分隔。
- Access-Control-Allow-Headers：允许的头部，多个头部以逗号分隔。
- Access-Control-Max-Age：应该将这个Preflight请求缓存多长时间（以秒表示）。

例如：
```
Access-Control-Allow-Origin: http://www.nczonline.net Access-Control-Allow-Methods: POST, GET
Access-Control-Allow-Headers: NCZ
Access-Control-Max-Age: 1728000
```

Preflight请求结束后，结果将按照响应中指定的时间缓存起来。而为此付出的代价只是第一次发送这种请求时会多一次HTTP请求。支持Preflight请求的浏览器包括Firefox 3.5+、Safari 4+和Chrome。IE 10及更早版本都不支持。

**21.4.4 带凭据的请求**

默认情况下，跨源请求不提供凭据（cookie、HTTP认证及客户端SSL证明等）。通过将withCredentials属性设置为true，可以指定某个请求应该发送凭据。如果服务器接受带凭据的请求，会用下面的HTTP头部来响应。
```
Access-Control-Allow-Credentials: true
```
如果发送的是带凭据的请求，但服务器的响应中没有包含这个头部，那么浏览器就不会把响应交给JavaScript（于是，responseText中将是空字符串，status的值为0，而且会调用onerror()事件处理程序）。另外，服务器还可以在Preflight响应中发送这个HTTP头部，表示允许源发送带凭据的请求。支持withCredentials属性的浏览器有Firefox 3.5+、Safari 4+和Chrome。IE 10及更早版本都不支持。

**21.4.5 跨浏览器的CORS**

即使浏览器对CORS的支持程度并不都一样，但所有浏览器都支持简单的（非Preflight和不带凭据的）请求，因此有必要实现一个跨浏览器的方案。检测XHR是否支持CORS的最简单方式，就是检查是否存在withCredentials属性。再结合检测XDomainRequest对象是否存在，就可以兼顾所有浏览器了。
```
function createCORSRequest(method, url) {
    var xhr = new XMLHttpRequest();
    if ("withCredentials" in xhr) {
        xhr.open(method, url, true);
    } else if (typeof XDomainRequest != "undefined") {
        var xhr = new XDomainRequest();
        xhr.open(method, url);
    } else {
        xhr = null;
    }
    return xhr;
}
var request = createCORSRequest("get", "http://www.somewhere-else.com/page/"); if (request) {
    request.onload = function() {
        //对request.responseText进行处理
    };
    request.send();
}
```

Firefox、Safari和Chrome中的XMLHttpRequest对象与IE中的XDomainRequest对象类似，都提供了够用的接口，因此以上模式还是相当有用的。这两个对象共同的属性/方法如下。
- abort()：用于停止正在进行的请求。
- onerror：用于替代onreadystatechange检测错误。
- onload：用于替代onreadystatechange检测成功。
- responseText：用于取得响应内容。
- send()：用于发送请求。
 
以上成员都包含在createCORSRequest()函数返回的对象中，在所有浏览器中都能正常使用。

**21.5 其他跨域技术**

在CORS出现以前，要实现跨域Ajax通信颇费一些周折。开发人员想出了一些办法，利用DOM中能够执行跨域请求的功能，在不依赖XHR对象的情况下也能发送某种请求。虽然CORS技术已经无处不在，但开发人员自己发明的这些技术仍然被广泛使用，毕竟这样不需要修改服务器端代码。

**21.5.1 图像Ping**

上述第一种跨域请求技术是使用`<img>`标签。我们知道，一个网页可以从任何网页中加载图像，不用担心跨域不跨域。这也是在线广告跟踪浏览量的主要方式。正如第13章讨论过的，也可以动态地创建图像，使用它们的onload和onerror事件处理程序来确定是否接收到了响应。动态创建图像经常用于图像Ping。图像Ping是与服务器进行简单、单向的跨域通信的一种方式。请求的数据是通过查询字符串形式发送的，而响应可以是任意内容，但通常是像素图或204响应。通过图像Ping，浏览器得不到任何具体的数据，但通过侦听load和error事件，它能知道响应是什么时候接收到的。来看下面的例子。
```
var img = new Image();
img.onload = img.onerror = function() {
    alert("Done!");
};
img.src = "http://www.example.com/test?name=Nicholas";
```

这里创建了一个Image的实例，然后将onload和onerror事件处理程序指定为同一个函数。这样无论是什么响应，只要请求完成，就能得到通知。请求从设置src属性那一刻开始，而这个例子在请求中发送了一个name参数。图像Ping最常用于跟踪用户点击页面或动态广告曝光次数。图像Ping有两个主要的缺点，一是只能发送GET请求，二是无法访问服务器的响应文本。因此，图像Ping只能用于浏览器与服务器间的单向通信。

**21.5.2 JSONP**

JSONP是JSON with padding（填充式JSON或参数式JSON）的简写，是应用JSON的一种新方法，在后来的Web服务中非常流行。JSONP看起来与JSON差不多，只不过是被包含在函数调用中的JSON，就像下面这样。
```
callback({ "name": "Nicholas" });
```

JSONP由两部分组成：回调函数和数据。回调函数是当响应到来时应该在页面中调用的函数。回调函数的名字一般是在请求中指定的。而数据就是传入回调函数中的JSON数据。下面是一个典型的JSONP请求。
```
http://freegeoip.net/json/?callback=handleResponse
```

这个URL是在请求一个JSONP地理定位服务。通过查询字符串来指定JSONP服务的回调参数是很常见的，就像上面的URL所示，这里指定的回调函数的名字叫handleResponse()。JSONP是通过动态`<script>`元素（要了解详细信息，请参考第13章）来使用的，使用时可以为src属性指定一个跨域URL。这里的`<script>`元素与`<img>`元素类似，都有能力不受限制地从其他域加载资源。因为JSONP是有效的JavaScript代码，所以在请求完成后，即在JSONP响应加载到页面中以后，就会立即执行。来看一个例子。

```
function handleResponse(response){
    alert("You’re at IP address " + response.ip + ", which is in " + response.city + ", " + response.region_name);
}
var script = document.createElement("script");
script.src = "http://freegeoip.net/json/?callback=handleResponse"; document.body.insertBefore(script, document.body.firstChild);
```

这个例子通过查询地理定位服务来显示你的IP地址和位置信息。JSONP之所以在开发人员中极为流行，主要原因是它非常简单易用。与图像Ping相比，它的优点在于能够直接访问响应文本，支持在浏览器与服务器之间双向通信。不过，JSONP也有两点不足。首先，JSONP是从其他域中加载代码执行。如果其他域不安全，很可能会在响应中夹带一些恶意代码，而此时除了完全放弃JSONP调用之外，没有办法追究。因此在使用不是你自己运维的Web服务时，一定得保证它安全可靠。其次，要确定JSONP请求是否失败并不容易。虽然HTML5给`<script>`元素新增了一个onerror事件处理程序，但目前还没有得到任何浏览器支持。为此，开发人员不得不使用计时器检测指定时间内是否接收到了响应。但就算这样也不能尽如人意，毕竟不是每个用户上网的速度和带宽都一样。

**21.5.3 Commet**

Comet是Alex Russell①发明的一个词儿，指的是一种更高级的Ajax技术（经常也有人称为“服务器推送”）。Ajax是一种从页面向服务器请求数据的技术，而Comet则是一种服务器向页面推送数据的技术。Comet能够让信息近乎实时地被推送到页面上，非常适合处理体育比赛的分数和股票报价。有两种实现Comet的方式：长轮询和流。长轮询是传统轮询（也称为短轮询）的一个翻版，即浏览器定时向服务器发送请求，看有没有更新的数据。图21-1展示的是短轮询的时间线。

长轮询把短轮询颠倒了一下。页面发起一个到服务器的请求，然后服务器一直保持连接打开，直到有数据可发送。发送完数据之后，浏览器关闭连接，随即又发起一个到服务器的新请求。这一过程在页面打开期间一直持续不断。图21-2展示了长轮询的时间线。

无论是短轮询还是长轮询，浏览器都要在接收数据之前，先发起对服务器的连接。两者最大的区别在于服务器如何发送数据。短轮询是服务器立即发送响应，无论数据是否有效，而长轮询是等待发送响应。轮询的优势是所有浏览器都支持，因为使用XHR对象和setTimeout()就能实现。而你要做的就是决定什么时候发送请求。

第二种流行的Comet实现是HTTP流。流不同于上述两种轮询，因为它在页面的整个生命周期内只使用一个HTTP连接。具体来说，就是浏览器向服务器发送一个请求，而服务器保持连接打开，然后周期性地向浏览器发送数据。比如，下面这段PHP脚本就是采用流实现的服务器中常见的形式。

```
<?php
    $i = 0;
    while(true) {
    //输出一些数据，然后立即刷新输出缓存
    echo "Number is $i";
    flush();
    //等几秒钟
    sleep(10);
    $i++;
}
```

所有服务器端语言都支持打印到输出缓存然后刷新（将输出缓存中的内容一次性全部发送到客户端）的功能。而这正是实现HTTP流的关键所在。

在Firefox、Safari、Opera和Chrome中，通过侦听readystatechange事件及检测readyState的值是否为3，就可以利用XHR对象实现HTTP流。在上述这些浏览器中，随着不断从服务器接收数据，readyState的值会周期性地变为3。当readyState值变为3时，responseText属性中就会保存接收到的所有数据。此时，就需要比较此前接收到的数据，决定从什么位置开始取得最新的数据。使用XHR对象实现HTTP流的典型代码如下所示。

```
function createStreamingClient(url, progress, finished) {
    var xhr = new XMLHttpRequest(), received = 0;
    xhr.open("get", url, true);
    xhr.onreadystatechange = function() {
        var result;
        if (xhr.readyState == 3) {
            //只取得最新数据并调整计数器
            result = xhr.responseText.substring(received);             received += result.length;
            //调用progress回调函数
            progress(result);
        } else if (xhr.readyState == 4) {
            finished(xhr.responseText);
        }
    };
    xhr.send(null);
    return xhr;
}

var client = createStreamingClient("streaming.php", function (data) {alert("Received: " + data);}, function(data) {alert("Done!");}
);
```

这个createStreamingClient()函数接收三个参数：要连接的URL、在接收到数据时调用的函数以及关闭连接时调用的函数。有时候，当连接关闭时，很可能还需要重新建立，所以关注连接什么时候关闭还是有必要的。只要readystatechange事件发生，而且readyState值为3，就对responseText进行分割以取得最新数据。这里的received变量用于记录已经处理了多少个字符，每次readyState值为3时都递增。然后，通过progress回调函数来处理传入的新数据。而当readyState值为4时，则执行finished回调函数，传入响应返回的全部内容。虽然这个例子比较简单，而且也能在大多数浏览器中正常运行（IE除外） ，但管理Comet的连接是很容易出错的，需要时间不断改进才能达到完美。浏览器社区认为Comet是未来Web的一个重要组成部分，为了简化这一技术，又为Comet创建了两个新的接口。

**21.5.4 服务器发送事件**

SSE（Server-Sent Events，服务器发送事件）是围绕只读Comet交互推出的API或者模式。SSE API用于创建到服务器的单向连接，服务器通过这个连接可以发送任意数量的数据。服务器响应的MIME类型必须是text/event-stream，而且是浏览器中的JavaScript API能解析格式输出。SSE支持短轮询、长轮询和HTTP流，而且能在断开连接时自动确定何时重新连接。有了这么简单实用的API，再实现Comet就容易多了。支持SSE的浏览器有Firefox 6+、Safari 5+、Opera 11+、Chrome和iOS 4+版Safari。

1. SSE API

SSE的JavaScriptAPI与其他传递消息的JavaScriptAPI很相似。要预订新的事件流，首先要创建一个新的EventSource对象，并传进一个入口点：
```
var source = new EventSource("myevents.php");
```

注意，传入的URL必须与创建对象的页面同源（相同的URL模式、域及端口）。EventSource的实例有一个readyState属性，值为0表示正连接到服务器，值为1表示打开了连接，值为2表示关闭了连接。另外，还有以下三个事件。
- open：在建立连接时触发。
- message：在从服务器接收到新事件时触发。
- error：在无法建立连接时触发。

就一般的用法而言，onmessage事件处理程序也没有什么特别的。
```
source.onmessage = function(event) {
    var data = event.data;
    //处理数据
};
```

服务器发回的数据以字符串形式保存在event.data中。默认情况下，EventSource对象会保持与服务器的活动连接。如果连接断开，还会重新连接。这就意味着SSE适合长轮询和HTTP流。如果想强制立即断开连接并且不再重新连接，可以调用close()方法。
```
source.close();
```

2. 事件流
 
所谓的服务器事件会通过一个持久的HTTP响应发送，这个响应的MIME类型为text/event-stream。响应的格式是纯文本，最简单的情况是每个数据项都带有前缀`data:`，
例如：
```
data: foo

data: bar

data: foo
data: bar
```

对以上响应而言，事件流中的第一个message事件返回的event.data值为"foo"，第二个message事件返回的event.data值为"bar"，第三个message事件返回的event.data值为"foo\nbar"（注意中间的换行符）。对于多个连续的以`data:`开头的数据行，将作为多段数据解析，每个值之间以一个换行符分隔。只有在包含`data:`的数据行后面有空行时，才会触发message事件，因此在服务器上生成事件流时不能忘了多添加这一行。通过`id:`前缀可以给特定的事件指定一个关联的ID，这个ID行位于`data:`行前面或后面皆可：
```
data: foo
id: 1
```

设置了ID后，EventSource对象会跟踪上一次触发的事件。如果连接断开，会向服务器发送一个包含名为Last-Event-ID的特殊HTTP头部的请求，以便服务器知道下一次该触发哪个事件。在多次连接的事件流中，这种机制可以确保浏览器以正确的顺序收到连接的数据段。

**21.5.5 Web Sockets**

要说最令人津津乐道的新浏览器API，就得数WebSockets了。WebSockets的目标是在一个单独的持久连接上提供全双工、双向通信。在JavaScript中创建了WebSocket之后，会有一个HTTP请求发送到浏览器以发起连接。在取得服务器响应后，建立的连接会使用HTTP升级从HTTP协议交换为WebSocket协议。也就是说，使用标准的HTTP服务器无法实现WebSockets，只有支持这种协议的专门服务器才能正常工作。由于Web Sockets使用了自定义的协议，所以URL模式也略有不同。未加密的连接不再是`http://`，而是`ws://`；加密的连接也不是`https://`，而是`wss://`。在使用WebSocketURL时，必须带着这个模式，因为将来还有可能支持其他模式。使用自定义协议而非HTTP协议的好处是，能够在客户端和服务器之间发送非常少量的数据，而不必担心HTTP那样字节级的开销。由于传递的数据包很小，因此WebSockets非常适合移动应用。毕竟对移动应用而言，带宽和网络延迟都是关键问题。使用自定义协议的缺点在于，制定协议的时间比制定JavaScriptAPI的时间还要长。WebSockets曾几度搁浅，就因为不断有人发现这个新协议存在一致性和安全性的问题。Firefox4和Opera11都曾默认启用WebSockets，但在发布前夕又禁用了，因为又发现了安全隐患。目前支持WebSockets的浏览器有Firefox6+、Safari5+、Chrome和iOS4+版Safari。

1. Web Sockets API
 
要创建Web Socket，先实例一个WebSocket对象并传入要连接的URL：
```
var socket = new WebSocket("ws://www.example.com/server.php");
```

注意，必须给WebSocket构造函数传入绝对URL。同源策略对WebSockets不适用，因此可以通过它打开到任何站点的连接。至于是否会与某个域中的页面通信，则完全取决于服务器。（通过握手信息就可以知道请求来自何方。）

实例化了WebSocket对象后，浏览器就会马上尝试创建连接。与XHR类似，WebSocket也有一个表示当前状态的readyState属性。不过，这个属性的值与XHR并不相同，而是如下所示。
- WebSocket.OPENING (0)：正在建立连接。
- WebSocket.OPEN (1)：已经建立连接。
- WebSocket.CLOSING (2)：正在关闭连接。
- WebSocket.CLOSE (3)：已经关闭连接。
 
WebSocket没有readystatechange事件；不过，它有其他事件，对应着不同的状态。readyState的值永远从0开始。要关闭WebSocket连接，可以在任何时候调用close()方法。`socket.close();` 调用了close()之后，readyState的值立即变为2（正在关闭），而在关闭连接后就会变成3。

2. 发送和接收数据

WebSocket打开之后，就可以通过连接发送和接收数据。要向服务器发送数据，使用send()方法并传入任意字符串，例如：
```
var socket = new WebSocket("ws://www.example.com/server.php"); socket.send("Hello world!");
```

因为WebSockets只能通过连接发送纯文本数据，所以对于复杂的数据结构，在通过连接发送之前，必须进行序列化。下面的例子展示了先将数据序列化为一个JSON字符串，然后再发送到服务器：

```
var message = {
    time: new Date(),
    text: "Hello world!",
    clientId: "asdfp8734rew"
};
socket.send(JSON.stringify(message));
```

接下来，服务器要读取其中的数据，就要解析接收到的JSON字符串。当服务器向客户端发来消息时，WebSocket对象就会触发message事件。这个message事件与其他传递消息的协议类似，也是把返回的数据保存在event.data属性中。
```
socket.onmessage = function(event) {
    var data = event.data;
    //处理数据
};
```

与通过send()发送到服务器的数据一样，event.data中返回的数据也是字符串。如果你想得到其他格式的数据，必须手工解析这些数据。

3. 其他事件
 
WebSocket对象还有其他三个事件，在连接生命周期的不同阶段触发。
- open：在成功建立连接时触发。
- error：在发生错误时触发，连接不能持续。
- close：在连接关闭时触发。

WebSocket对象不支持DOM2级事件侦听器，因此必须使用DOM0级语法分别定义每个事件处理程序。

```
var socket = new WebSocket("ws://www.example.com/server.php");
socket.onopen = function() {
    alert("Connection established.");
};
socket.onerror = function() {
    alert("Connection error.");
};
socket.onclose = function() {
    alert("Connection closed.");
};
```

在这三个事件中，只有close事件的event对象有额外的信息。这个事件的事件对象有三个额外的属性：wasClean、code和reason。其中，wasClean是一个布尔值，表示连接是否已经明确地关闭；code是服务器返回的数值状态码；而reason是一个字符串，包含服务器发回的消息。可以把这些信息显示给用户，也可以记录到日志中以便将来分析。

```
socket.onclose = function(event) {
    console.log("Was clean? " + event.wasClean + " Code=" + event.code + " Reason=" + event.reason);
};
```


**21.5.6 SSE与Web Sockets**

面对某个具体的用例，在考虑是使用SSE还是使用WebSockets时，可以考虑如下几个因素。首先，你是否有自由度建立和维护WebSockets服务器？因为WebSocket协议不同于HTTP，所以现有服务器不能用于WebSocket通信。SSE倒是通过常规HTTP通信，因此现有服务器就可以满足需求。第二个要考虑的问题是到底需不需要双向通信。如果用例只需读取服务器数据（如比赛成绩），那么SSE比较容易实现。如果用例必须双向通信（如聊天室），那么WebSockets显然更好。别忘了，在不能选择WebSockets的情况下，组合XHR和SSE也是能实现双向通信的。

**21.6 安全**

讨论Ajax和Comet安全的文章可谓连篇累牍，而相关主题的书也已经出了很多本了。大型Ajax应用程序的安全问题涉及面非常之广，但我们可以从普遍意义上探讨一些基本的问题。首先，可以通过XHR访问的任何URL也可以通过浏览器或服务器来访问。下面的URL就是一个例子。
```
/getuserinfo.php?id=23
```
如果是向这个URL发送请求，可以想象结果会返回ID为23的用户的某些数据。谁也无法保证别人不会将这个URL的用户ID修改为24、56或其他值。因此，getuserinfo.php文件必须知道请求者是否真的有权限访问要请求的数据；否则，你的服务器就会门户大开，任何人的数据都可能被泄漏出去。

对于未被授权系统有权访问某个资源的情况，我们称之为CSRF（Cross-Site Request Forgery，跨站点请求伪造）。未被授权系统会伪装自己，让处理请求的服务器认为它是合法的。受到CSRF攻击的Ajax程序有大有小，攻击行为既有旨在揭示系统漏洞的恶作剧，也有恶意的数据窃取或数据销毁。为确保通过XHR访问的URL安全，通行的做法就是验证发送请求者是否有权限访问相应的资源。有下列几种方式可供选择。
- 要求以SSL连接来访问可以通过XHR请求的资源。
- 要求每一次请求都要附带经过相应算法计算得到的验证码。

请注意，下列措施对防范CSRF攻击不起作用。
- 要求发送POST而不是GET请求——很容易改变。
- 检查来源URL以确定是否可信——来源记录很容易伪造。
- 基于cookie信息进行验证——同样很容易伪造。
 
XHR对象也提供了一些安全机制，虽然表面上看可以保证安全，但实际上却相当不可靠。实际上，前面介绍的open()方法还能再接收两个参数：要随请求一起发送的用户名和密码。带有这两个参数的请求可以通过SSL发送给服务器上的页面，如下面的例子所示。
```
xhr.open("get", "example.php", true, "username", "password"); //不要这样做！！
```

即便可以考虑这种安全机制，但还是尽量不要这样做。把用户名和密码保存在JavaScript代码中本身就是极为不安全的。任何人，只要他会使用JavaScript调试器，就可以通过查看相应的变量发现纯文本形式的用户名和密码。

**21.7 小结**

Ajax是无需刷新页面就能够从服务器取得数据的一种方法。关于Ajax，可以从以下几方面来总结一下。
- 负责Ajax运作的核心对象是XMLHttpRequest（XHR）对象。
- XHR对象由微软最早在IE5中引入，用于通过JavaScript从服务器取得XML数据。
- 在此之后，Firefox、Safari、Chrome和Opera都实现了相同的特性，使XHR成为了Web的一个事实标准。
- 虽然实现之间存在差异，但XHR对象的基本用法在不同浏览器间还是相对规范的，因此可以放心地用在Web开发当中。

同源策略是对XHR的一个主要约束，它为通信设置了“相同的域、相同的端口、相同的协议”这一限制。试图访问上述限制之外的资源，都会引发安全错误，除非采用被认可的跨域解决方案。这个解决方案叫做CORS（Cross-Origin  Resource  Sharing，跨源资源共享），IE8通过XDomainRequest对象支持CORS，其他浏览器通过XHR对象原生支持CORS。图像Ping和JSONP是另外两种跨域通信的技术，但不如CORS稳妥。

Comet是对Ajax的进一步扩展，让服务器几乎能够实时地向客户端推送数据。实现Comet的手段主要有两个：长轮询和HTTP流。所有浏览器都支持长轮询，而只有部分浏览器原生支持HTTP流。SSE（Server-Sent  Events，服务器发送事件）是一种实现Comet交互的浏览器API，既支持长轮询，也支持HTTP流。

WebSockets是一种与服务器进行全双工、双向通信的信道。与其他方案不同，WebSockets不使用HTTP协议，而使用一种自定义的协议。这种协议专门为快速传输小数据设计。虽然要求使用不同的Web服务器，但却具有速度上的优势。各方面对Ajax和Comet的鼓吹吸引了越来越多的开发人员学习JavaScript，人们对Web开发的关注也再度升温。与Ajax有关的概念都还相对比较新，这些概念会随着时间推移继续发展。

Ajax是一个非常庞大的主题，完整地讨论这个主题超出了本书的范围。要想了解有关Ajax的更多信息，请读者参考《Ajax高级程序设计（第2版）》。图灵社区会员 StinkBC(StinkBC@gmail.com) 专享 尊重版权。

第22章 高级技巧
-------------

本章内容
- 使用高级函数
- 防篡改对象
- Yielding Timers

JavaScript是一种极其灵活的语言，具有多种使用风格。一般来说，编写JavaScript要么使用过程方式，要么使用面向对象方式。然而，由于它天生的动态属性，这种语言还能使用更为复杂和有趣的模式。这些技巧要利用ECMAScript的语言特点、BOM扩展和DOM功能来获得强大的效果。

**22.1 高级函数**

函数是JavaScript中最有趣的部分之一。它们本质上是十分简单和过程化的，但也可以是非常复杂和动态的。一些额外的功能可以通过使用闭包来实现。此外，由于所有的函数都是对象，所以使用函数指针非常简单。这些令JavaScript函数不仅有趣而且强大。以下几节描绘了几种在JavaScript中使用函数的高级方法。

**22.1.1 安全的类型检测**

JavaScript内置的类型检测机制并非完全可靠。事实上，发生错误否定及错误肯定的情况也不在少数。比如说typeof操作符吧，由于它有一些无法预知的行为，经常会导致检测数据类型时得到不靠谱的结果。Safari（直至第4版）在对正则表达式应用typeof操作符时会返回"function"，因此很难确定某个值到底是不是函数。

再比如，instanceof操作符在存在多个全局作用域（像一个页面包含多个frame）的情况下，也是问题多多。一个经典的例子（第5章也提到过）就是像下面这样将对象标识为数组。
```
var isArray = value instanceof Array;
```
以上代码要返回true，value必须是一个数组，而且还必须与Array构造函数在同个全局作用域中。（别忘了，Array是window的属性。）如果value是在另个frame中定义的数组，那么以上代码就会返回false。

在检测某个对象到底是原生对象还是开发人员自定义的对象的时候，也会有问题。出现这个问题的原因是浏览器开始原生支持JSON对象了。因为很多人一直在使用Douglas Crockford的JSON库，而该库定义了一个全局JSON对象。于是开发人员很难确定页面中的JSON对象到底是不是原生的。

解决上述问题的办法都一样。大家知道，在任何值上调用Object原生的toString()方法，都会返回一个[object NativeConstructorName]格式的字符串。每个类在内部都有一个`[[Class]]`属性，这个属性中就指定了上述字符串中的构造函数名。举个例子吧。
```
alert(Object.prototype.toString.call(value));    //"[object Array]" 
```
由于原生数组的构造函数名与全局作用域无关，因此使用toString()就能保证返回一致的值。利用这一点，可以创建如下函数：
```
function isArray(value) {
    return Object.prototype.toString.call(value) == "[object Array]"; 
}
```

同样，也可以基于这一思路来测试某个值是不是原生函数或正则表达式：
```
function isFunction(value) {
    return Object.prototype.toString.call(value) == "[object Function]"; 
}
function isRegExp(value) {
    return Object.prototype.toString.call(value) == "[object RegExp]";
}
```

不过要注意，对于在IE中以COM对象形式实现的任何函数，isFunction()都将返回false（因为它们并非原生的JavaScript函数，请参考第10章中更详细的介绍）。

这一技巧也广泛应用于检测原生JSON对象。Object的toString()方法不能检测非原生构造函数的构造函数名。因此，开发人员定义的任何构造函数都将返回`[object  Object]`。有些JavaScript库会包含与下面类似的代码。
```
var isNativeJSON = window.JSON && Object.prototype.toString.call(JSON) == "[object JSON]";
```

在Web开发中能够区分原生与非原生JavaScript对象非常重要。只有这样才能确切知道某个对象到底有哪些功能。这个技巧可以对任何对象给出正确的结论。

请注意，Object.prototpye.toString()本身也可能会被修改。本节讨论的技巧假设Object.prototpye.toString()是未被修改过的原生版本。

**22.1.2 作用域安全的构造函数**

第6章讲述了用于自定义对象的构造函数的定义和用法。你应该还记得，构造函数其实就是一个使用new操作符调用的函数。当使用new调用时，构造函数内用到的this对象会指向新创建的对象实例，如下面的例子所示：
```
function Person(name, age, job) {
    this.name = name;
    this.age = age;
    this.job = job;
}
var person = new Person("Nicholas", 29, "Software Engineer");
```

上面这个例子中，Person构造函数使用this对象给三个属性赋值：name、age和job。当和new操作符连用时，则会创建一个新的Person对象，同时会给它分配这些属性。问题出在当没有使用new操作符来调用该构造函数的情况上。由于该this对象是在运行时绑定的，所以直接调用Person()，this会映射到全局对象window上，导致错误对象属性的意外增加。例如：
```
var person = Person("Nicholas", 29, "Software Engineer");
alert(window.name);  //"Nicholas"
alert(window.age);   //29
alert(window.job);   //"Software Engineer"
```

这里，原本针对Person实例的三个属性被加到window对象上，因为构造函数是作为普通函数调用的，忽略了new操作符。这个问题是由this对象的晚绑定造成的，在这里this被解析成了window对象。由于window的name属性是用于识别链接目标和frame的，所以这里对该属性的偶然覆盖可能会导致该页面上出现其他错误。这个问题的解决方法就是创建一个作用域安全的构造函数。作用域安全的构造函数在进行任何更改前，首先确认this对象是正确类型的实例。如果不是，那么会创建新的实例并返回。请看以下例子：
```
function Person(name, age, job) {
    if (this instanceof Person) {
        this.name = name;
        this.age = age;
        this.job = job;
    } else { 
        return new Person(name, age, job);
    }
}
var person1 = Person("Nicholas", 29, "Software Engineer");
alert(window.name); //""
alert(person1.name);//"Nicholas"
var person2 = new Person("Shelby", 34, "Ergonomist");
alert(person2.name);//"Shelby"
```

这段代码中的Person构造函数添加了一个检查并确保this对象是Person实例的if语句，它表示要么使用new操作符，要么在现有的Person实例环境中调用构造函数。任何一种情况下，对象初始化都能正常进行。如果this并非Person的实例，那么会再次使用new操作符调用构造函数并返回结果。最后的结果是，调用Person构造函数时无论是否使用new操作符，都会返回一个Person的新实例，这就避免了在全局对象上意外设置属性。

关于作用域安全的构造函数的贴心提示。实现这个模式后，你就锁定了可以调用构造函数的环境。如果你使用构造函数窃取模式的继承且不使用原型链，那么这个继承很可能被破坏。这里有个例子：
```
function Polygon(sides) {
    if (this instanceof Polygon) {
        this.sides = sides;
        this.getArea = function() {
            return 0;
        };
    } else {
        return new Polygon(sides);
    }
}
function Rectangle(width, height) {
    Polygon.call(this, 2);
    this.width = width;
    this.height = height;
    this.getArea = function() {
        return this.width * this.height;
    };
}
var rect = new Rectangle(5, 10);
alert(rect.sides); //undefined
```

在这段代码中，Polygon构造函数是作用域安全的，然而Rectangle构造函数则不是。新创建一个Rectangle实例之后，这个实例应该通过Polygon.call()来继承Polygon的sides属性。但是，由于Polygon构造函数是作用域安全的，this对象并非Polygon的实例，所以会创建并返回一个新的Polygon对象。Rectangle构造函数中的this对象并没有得到增长，同时Polygon.call()返回的值也没有用到，所以Rectangle实例中就不会有sides属性。如果构造函数窃取结合使用原型链或者寄生组合则可以解决这个问题。考虑以下例子：
```
function Polygon(sides) {
    if (this instanceof Polygon) {
        this.sides = sides;
        this.getArea = function() {
            return 0;
        };
    } else {
        return new Polygon(sides);
    }
}
function Rectangle(width, height) {
    Polygon.call(this, 2);
    this.width = width;
    this.height = height;
    this.getArea = function() {
        return this.width * this.height;
    };
}
Rectangle.prototype = new Polygon();
var rect = new Rectangle(5, 10);
alert(rect.sides); //2
```

上面这段重写的代码中，一个Rectangle实例也同时是一个Polygon实例，所以Polygon.call()会照原意执行，最终为Rectangle实例添加了sides属性。多个程序员在同一个页面上写JavaScript代码的环境中，作用域安全构造函数就很有用了。届时，对全局对象意外的更改可能会导致一些常常难以追踪的错误。除非你单纯基于构造函数窃取来实现继承，推荐作用域安全的构造函数作为最佳实践。

**22.1.3 惰性载入函数**

因为浏览器之间行为的差异，多数JavaScript代码包含了大量的if语句，将执行引导到正确的代码中。看看下面来自上一章的createXHR()函数。
```
function createXHR() {
    if (typeof XMLHttpRequest != "undefined") {
        return new XMLHttpRequest();
    } else if (typeof ActiveXObject != "undefined") {
        if (typeof arguments.callee.activeXString != "string") {
            var versions = ["MSXML2.XMLHttp.6.0",
                           "MSXML2.XMLHttp.3.0",                             "MSXML2.XMLHttp"],
                           i,
                           len;
            for (i=0, len=versions.length; i < len; i++) {
                try {
                    new ActiveXObject(versions[i]);
                    arguments.callee.activeXString = versions[i];
                    break;
                } catch (ex) {
                    //跳过
                }
            }
        }
        return new ActiveXObject(arguments.callee.activeXString);
    } else {
        throw new Error("No XHR object available.");
    }
}
```

每次调用createXHR()的时候，它都要对浏览器所支持的能力仔细检查。首先检查内置的XHR，然后测试有没有基于ActiveX的XHR，最后如果都没有发现的话就抛出一个错误。每次调用该函数都是这样，即使每次调用时分支的结果都不变：如果浏览器支持内置XHR，那么它就一直支持了，那么这种测试就变得没必要了。即使只有一个if语句的代码，也肯定要比没有if语句的慢，所以如果if语句不必每次执行，那么代码可以运行地更快一些。解决方案就是称之为惰性载入的技巧。惰性载入表示函数执行的分支仅会发生一次。有两种实现惰性载入的方式，第一种就是在函数被调用时再处理函数。在第一次调用的过程中，该函数会被覆盖为另外一个按合适方式执行的函数，这样任何对原函数的调用都不用再经过执行的分支了。例如，可以用下面的方式使用惰性载入重写createXHR()。

```
function createXHR(){
    if (typeof XMLHttpRequest != "undefined") {
        createXHR = function(){
            return new XMLHttpRequest();
        };
    } else if (typeof ActiveXObject != "undefined") {
        createXHR = function() {
            if (typeof arguments.callee.activeXString != "string") {
                var versions = ["MSXML2.XMLHttp.6.0",
                "MSXML2.XMLHttp.3.0",
                "MSXML2.XMLHttp"],
                i,
                len;
                for (i=0, len=versions.length; i < len; i++) {
                    try {
                        new ActiveXObject(versions[i]);    arguments.callee.activeXString = versions[i];
                        break;
                    } catch (ex){
                        //skip
                    }
                }
            }
            return new ActiveXObject(arguments.callee.activeXString);
        };
    } else {
        createXHR = function() {
            throw new Error("No XHR object available.");
        };
    }
    return createXHR();
}
```

在这个惰性载入的createXHR()中，if语句的每一个分支都会为createXHR变量赋值，有效覆盖了原有的函数。最后一步便是调用新赋的函数。下一次调用createXHR()的时候，就会直接调用被分配的函数，这样就不用再次执行if语句了。第二种实现惰性载入的方式是在声明函数时就指定适当的函数。这样，第一次调用函数时就不会损失性能了，而在代码首次加载时会损失一点性能。以下就是按照这一思路重写前面例子的结果。
```
var createXHR = (function(){
    if (typeof XMLHttpRequest != "undefined") {
        return function() {
            return new XMLHttpRequest();
        };
    } else if (typeof ActiveXObject != "undefined") {
        return function() {
            if (typeof arguments.callee.activeXString != "string") {
                var versions = ["MSXML2.XMLHttp.6.0",
                "MSXML2.XMLHttp.3.0",
                "MSXML2.XMLHttp"],
                i,
                len;
                for (i=0, len=versions.length; i < len; i++) {
                    try {
                        new ActiveXObject(versions[i]);
                        arguments.callee.activeXString = versions[i]; break;
                    } catch (ex){
                        //skip
                    }
                }
            }
            return new ActiveXObject(arguments.callee.activeXString);
        };
    } else {
        return function() {
            throw new Error("No XHR object available.");
        };
    }
})();
```

这个例子中使用的技巧是创建一个匿名、自执行的函数，用以确定应该使用哪一个函数实现。实际的逻辑都一样。不一样的地方就是第一行代码（使用var定义函数）、新增了自执行的匿名函数，另外每个分支都返回正确的函数定义，以便立即将其赋值给createXHR()。惰性载入函数的优点是只在执行分支代码时牺牲一点儿性能。至于哪种方式更合适，就要看你的具体需求而定了。不过这两种方式都能避免执行不必要的代码。


**22.1.4 函数绑定**

另一个日益流行的高级技巧叫做函数绑定。函数绑定要创建一个函数，可以在特定的this环境中以指定参数调用另一个函数。该技巧常常和回调函数与事件处理程序一起使用，以便在将函数作为变量传递的同时保留代码执行环境。请看以下例子：
```
var handler = {
    message: "Event handled",
    handleClick: function(event) {
        alert(this.message); 
    } }; var btn = document.getElementById("my-btn"); EventUtil.addHandler(btn, "click", handler.handleClick); 在上面这个例子中，创建了一个叫做handler的对象。handler.handleClick()方法被分配为一个DOM按钮的事件处理程序。当按下该按钮时，就调用该函数，显示一个警告框。虽然貌似警告框应该显示Event  handled，然而实际上显示的是undefiend。这个问题在于没有保存handler.handleClick()的环境，所以this对象最后是指向了DOM按钮而非handler（在IE8中，this指向window。）可以如下面例子所示，使用一个闭包来修正这个问题。var handler = {     message: "Event handled",     handleClick: function(event){         alert(this.message);     } }; var btn = document.getElementById("my-btn"); EventUtil.addHandler(btn, "click", function(event){     handler.handleClick(event); });

这个解决方案在onclick事件处理程序内使用了一个闭包直接调用handler.handleClick()。当然，这是特定于这段代码的解决方案。创建多个闭包可能会令代码变得难于理解和调试。因此，很多JavaScript库实现了一个可以将函数绑定到指定环境的函数。这个函数一般都叫bind()。一个简单的bind()函数接受一个函数和一个环境，并返回一个在给定环境中调用给定函数的函数，并且将所有参数原封不动传递过去。语法如下：function bind(fn, context){     return function(){         return fn.apply(context, arguments);     }; }

这个函数似乎简单，但其功能是非常强大的。在bind()中创建了一个闭包，闭包使用apply()调用传入的函数，并给apply()传递context对象和参数。注意这里使用的arguments对象是内部函数的，而非bind()的。当调用返回的函数时，它会在给定环境中执行被传入的函数并给出所有参数。bind()函数按如下方式使用：var handler = {     message: "Event handled",     handleClick: function(event){         alert(this.message);     } }; var btn = document.getElementById("my-btn"); EventUtil.addHandler(btn, "click", bind(handler.handleClick, handler));

在这个例子中，我们用bind()函数创建了一个保持了执行环境的函数，并将其传给EventUtil. addHandler()。event对象也被传给了该函数，如下所示：var handler = {     message: "Event handled",     handleClick: function(event){         alert(this.message + ":" + event.type);     } }; var btn = document.getElementById("my-btn"); EventUtil.addHandler(btn, "click", bind(handler.handleClick, handler));

handler.handleClick()方法和平时一样获得了event对象，因为所有的参数都通过被绑定的函数直接传给了它。ECMAScript 5为所有函数定义了一个原生的bind()方法，进一步简单了操作。换句话说，你不用再自己定义bind()函数了，而是可以直接在函数上调用这个方法。例如：

var handler = {     message: "Event handled",     handleClick: function(event){ alert(this.message + ":" + event.type);     } }; var btn = document.getElementById("my-btn"); EventUtil.addHandler(btn, "click", handler.handleClick.bind(handler));

原生的bind()方法与前面介绍的自定义bind()方法类似，都是要传入作为this值的对象。支持原生bind()方法的浏览器有IE9+、Firefox 4+和Chrome。只要是将某个函数指针以值的形式进行传递，同时该函数必须在特定环境中执行，被绑定函数的效用就突显出来了。它们主要用于事件处理程序以及 setTimeout()和 setInterval()。然而，被绑定函数与普通函数相比有更多的开销，它们需要更多内存，同时也因为多重函数调用稍微慢一点，所以最好只在必要时使用。

**22.1.5 函数柯里化**
**22.2 防篡改对象**
**22.2.1 不可扩展对象**
**22.2.2 密封的对象**
**22.2.3 冻结的对象**
**22.3 高级定时器**
**22.3.1 重复的定时器**
**22.3.2 Yielding Processes**
**22.3.3 函数节流**
**22.4 自定义事件**
**22.5 拖放**
**22.5.1 修缮拖放功能**
**22.5.2 添加自定义事件**
**22.6 小结**

第23章 离线应用与客户端存储
--------------------------

**23.1 离线检测**
**23.2 应用缓存**
**23.3 数据存储**
**23.3.1 Cookie**
**23.3.2 IE用户数据**
**23.3.3 Web存储机制**
**23.3.4 IndexedDB**
**23.4 小结**

第24章 最佳实践
---------------

**24.1 可维护性**
**24.1.1 什么是可维护的代码**
**24.1.2 代码约定**
**24.1.3 松散耦合**
**24.1.4 编程实践**
**24.2 性能**
**24.2.1 注意作用域**
**24.2.2 选择正确的方法**
**24.2.3 最小化语句数**
**24.2.4 优化DOM交互**
**24.3 部署**
**24.3.1 构建过程**
**24.3.2 验证**
**24.3.3 压缩**
**24.4 小结**

第25章 新兴的API
----------------

**25.1 requestAnimationFrame()**
**25.1.1 早期动画循环**
**25.1.2 循环间隔的问题**
**25.1.3 mozRequestAnimation-Frame**
**25.1.4 webkitRequestAnimationFrame与msRequestAnimationFrame**
**25.2 Page Visibility API**
**25.3 Geolocation API**
**25.4 File API**
**25.4.1 FileReader类型**
**25.4.2 读取部分内容**
**25.4.3 对象URL**
**25.4.4 读取拖动的文件**
**25.4.5 使用XHR上传文件**
**25.5 Web计时**
**25.6 Web Workers**
**25.6.1 使用Worker**
**25.6.2 Worker全局作用域**
**25.6.3 包含其他脚本**
**25.6.4 Web Workers的未来**
**25.7 小结**

附录A ECMAScript Harmony
-----------------------

附录B 严格模式
--------------

附录C JavaScript库
------------------

附录D JavaScript工具
--------------------
















