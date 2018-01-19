前言
----

http://www.chinastor.org/upload/2014-12/14122310427265.pdf

https://wenku.baidu.com/content/7da1c29fdd88d0d233d46a53?m=e743691db14cdff29ac60ea22a91b3ba&type=pic&src=6eb9168bdc140ad836a687d985fc8626.png

修摘自《JavaScript高级程序设计第3版》

第1章 JavaScript简介
-------------------

JavaScript诞生于1995年。当时，它的主要目的是处理以前由服务器端语言（如Perl）负责的一些输入验证操作。在JavaScript问世之前，必须把表单数据发送到服务器端才能确定用户是否没有填写某个必填域，是否输入了无效的值。Netscape Navigator希望通过JavaScript来解决这个问题。在人们普遍使用电话拔号上网的年代，能够在客户端完成一些基本的验证任务绝对是令人兴奋的。毕竟，拨号上网的速度之慢，导致了与服务器的每一次数据交换事实上都成了对人们耐心的一次考验。自此以后，JavaScript逐渐成为市面上常见浏览器必备的一项特色功能。如今，JavaScript的用途早已不再局限于简单的数据验证，而是具备了与浏览器窗口及其内容等几乎所有方面交互的能力。今天的JavaScript已经成为一门功能全面的编程语言，能够处理复杂的计算和交互，拥有了闭包、匿名（lamda，拉姆达）函数，甚至元编程等特性。作为Web的一个重要组成部分，JavaScript的重要性是不言而喻的，就连手机浏览器，甚至那些专为残障人士设计的浏览器等非常规浏览器都支持它。当然，微软的例子更为典型。虽然有自己的客户端脚本语言VBScript，但微软仍然在Internet Explorer的早期版本中加入了自己的JavaScript实现①。JavaScript从一个简单的输入验证器发展成为一门强大的编程语言，完全出乎人们的意料。应该说，它既是一门非常简单的语言，又是一门非常复杂的语言。说它简单，是因为学会使用它只需片刻功夫；而说它复杂，是因为要真正掌握它则需要数年时间。要想全面理解和掌握JavaScript，关键在于弄清楚它的本质、历史和局限性。

①对IE而言，当我们提到JavaScript时，实际上就是指IE对JavaScript（ECMAScript）的实现——JScript。最早的JScript基于Netscape JavaScript 1.0开发，于1996年8月随同Internet Explorer 3.0发布。

**1.1 JavaScript简史**

在Web日益流行的同时，人们对客户端脚本语言的需求也越来越强烈。那个时候，绝大多数因特网用户都使用速度仅为28.8kbit/s的“猫”（调制解调器）上网，但网页的大小和复杂性却不断增加。为完成简单的表单验证而频繁地与服务器交换数据只会加重用户的负担。想象一下：用户填写完一个表单，单击“提交”按钮，然后等待30秒钟，最终服务器返回消息说有一个必填字段没有填好......当时走在技术革新最前沿的Netscape公司，决定着手开发一种客户端语言，用来处理这种简单的验证。

当时就职于Netscape公司的布兰登·艾奇（BrendanEich），开始着手为计划于1995年2月发布的Netscape Navigator2开发一种名为LiveScript的脚本语言——该语言将同时在浏览器和服务器中使用（它在服务器上的名字叫LiveWire）。为了赶在发布日期前完成LiveScript的开发，Netscape与Sun公司建立了一个开发联盟。在Netscape Navigator 2正式发布前夕，Netscape为了搭上媒体热炒Java的顺风车，临时把LiveScript改名为JavaScript。

由于JavaScript1.0获得了巨大成功，Netscape随即在NetscapeNavigator3中又发布了JavaScript1.1。Web虽然羽翼未丰，但用户关注度却屡创新高。在这样的背景下，Netscape把自己定位为市场领袖型公司。与此同时，微软决定向与Navigator竞争的自家产品Internet Explorer浏览器投入更多资源。Netscape Navigator 3发布后不久，微软就在其Internet Explorer 3中加入了名为JScript的JavaScript实现（命名为JScript是为了避开与Netscape有关的授权问题）。以现在的眼光来看，微软1996年8月为进入Web浏览器领域而实施的这个重大举措，是导致Netscape日后蒙羞的一个标志性事件。然而，这个重大举措同时也标志着JavaScript作为一门语言，其开发向前迈进了一大步。

微软推出其JavaScript实现意味着有了两个不同的JavaScript版本：Netscape  Navigator中的JavaScript、Internet Explorer中的JScript。与C及其他编程语言不同，当时还没有标准规定JavaScript的语法和特性，两个不同版本并存的局面已经完全暴露了这个问题。随着业界担心的日益加剧，JavaScript的标准化问题被提上了议事日程。

1997年，以JavaScript1.1为蓝本的建议被提交给了欧洲计算机制造商协会（ECMA，European Computer Manufacturers Association）。该协会指定39号技术委员会（TC39，Technical Committee #39）负责“标准化一种通用、跨平台、供应商中立的脚本语言的语法和语义”。TC39由来自Netscape、Sun、微软、Borland及其他关注脚本语言发展的公司的程序员组成，他们经过数月的努力完成了ECMA-262——定义一种名为ECMAScript（发音为“ek-ma-script”）的新脚本语言的标准。第二年，ISO/IEC（International Organization for Standardization and International Electrotechnical Commission，国标标准化组织和国际电工委员会）也采用了ECMAScript作为标准（即ISO/IEC-16262）。自此以后，浏览器开发商就开始致力于将ECMAScript作为各自JavaScript实现的基础，也在不同程度上取得了成功。

**1.2 JavaScript实现**

虽然JavaScript和ECMAScript通常都被人们用来表达相同的含义，但JavaScript的含义却比ECMA-262中规定的要多得多。没错，一个完整的JavaScript实现应该由下列三个不同的部分组成：
- 核心（ECMAScript）
- 文档对象模型（DOM）
- 浏览器对象模型（BOM）

**1.2.1 ECMAScript**

由ECMA-262定义的ECMAScript与Web浏览器没有依赖关系。实际上，这门语言本身并不包含输入和输出定义。ECMA-262定义的只是这门语言的基础，而在此基础之上可以构建更完善的脚本语言。我们常见的Web浏览器只是ECMAScript实现可能的宿主环境之一。宿主环境不仅提供基本的ECMAScript实现，同时也会提供该语言的扩展，以便语言与环境之间对接交互。而这些扩展——如DOM，则利用ECMAScript的核心类型和语法提供更多更具体的功能，以便实现针对环境的操作。其他宿主环境包括Node（一种服务端JavaScript平台）和Adobe Flash。

既然ECMA-262标准没有参照Web浏览器，那它都规定了些什么内容呢？大致说来，它规定了这门语言的下列组成部分：

- 语法
- 类型
- 语句
- 关键字
- 保留字
- 操作符
- 对象

ECMAScript就是对实现该标准规定的各个方面内容的语言的描述。JavaScript实现了ECMAScript，Adobe ActionScript同样也实现了ECMAScript。

1. ECMAScript的版本

ECMAScript的不同版本又称为版次，以第x版表示（意即描述特定实现的ECMA-262规范的第x个版本）。ECMA-262的最近一版是第5版，发布于2009年。而ECMA-262的第1版本质上与Netscape的JavaScript 1.1相同——只不过删除了所有针对浏览器的代码并作了一些较小的改动：ECMA-262要求支持Unicode标准（从而支持多语言开发），而且对象也变成了平台无关的（Netscape JavaScript 1.1的对象在不同平台中的实现不一样，例如Date对象）。这也是JavaScript 1.1和1.2与ECMA-262第1版不一致的主要原因。

ECMA-262第2版主要是编辑加工的结果。这一版中内容的更新是为了与ISO/IEC-16262保持严格一致，没有作任何新增、修改或删节处理。因此，一般不使用第2版来衡量ECMAScript实现的兼容性。

ECMA-262第3版才是对该标准第一次真正的修改。修改的内容涉及字符串处理、错误定义和数值输出。这一版还新增了对正则表达式、新控制语句、try-catch异常处理的支持，并围绕标准的国际化做出了一些小的修改。从各方面综合来看，第3版标志着ECMAScript成为了一门真正的编程语言。

ECMA-262第4版对这门语言进行了一次全面的检核修订。由于JavaScript在Web上日益流行，开发人员纷纷建议修订ECMAScript，以使其能够满足不断增长的Web开发需求。作为回应，ECMA TC39重新召集相关人员共同谋划这门语言的未来。结果，出台后的标准几乎在第3版基础上完全定义了一门新语言。第4版不仅包含了强类型变量、新语句和新数据结构、真正的类和经典继承，还定义了与数据交互的新方式。与此同时，TC39下属的一个小组也提出了一个名为ECMAScript 3.1的替代性建议，该建议只对这门语言进行了较少的改进。这个小组认为第4版给这门语言带来的跨越太大了。因此，该小组建议对这门语言进行小幅修订，能够在现有JavaScript引擎基础上实现。最终，ES3.1附属委员会获得的支持超过了TC39，ECMA-262第4版在正式发布前被放弃。

ECMAScript3.1成为ECMA-262第5版，并于2009年12月3日正式发布。第5版力求澄清第3版中已知的歧义并增添了新的功能。新功能包括原生JSON对象（用于解析和序列化JSON数据）、继承的方法和高级属性定义，另外还包含一种严格模式，对ECMAScript引擎解释和执行代码进行了补充说明。

2. 什么是ECMAScript兼容

ECMA-262给出了ECMAScript兼容的定义。要想成为ECMAScript的实现，则该实现必须做到：

- 支持ECMA-262描述的所有“类型、值、对象、属性、函数以及程序句法和语义”（ECMA-262第1页）；
- 支持Unicode字符标准。

此外，兼容的实现还可以进行下列扩展。
- 添加ECMA-262没有描述的“更多类型、值、对象、属性和函数”。ECMA-262所说的这些新增特性，主要是指该标准中没有规定的新对象和对象的新属性。
- 支持ECMA-262没有定义的“程序和正则表达式语法”。（也就是说，可以修改和扩展内置的正则表达式语法。）上述要求为兼容实现的开发人员基于ECMAScript开发一门新语言提供了广阔的空间和极大的灵活性，这也从另一个侧面说明了ECMAScript受开发人员欢迎的原因。

3. Web浏览器对ECMAScript的支持

1996年，Netscape Navigator 3捆绑发布了JavaScript 1.1。而相同的JavaScript 1.1设计规范随后作为对新标准（ECMA-262）的建议被提交给Ecma。伴随着JavaScript的迅速走红，Netscape豪情满怀地着手开发JavaScript 1.2。然而，问题是Ecma当时还没有接受Netscape的建议。

Netscape  Navigator 3发布后不久，微软也推出了Internet Explorer 3。微软在IE的这一版中捆绑了JScript 1.0，很多人都认为JScript 1.0与JavaScript 1.1应该是一样的。但是，由于没有文档依据，加之不适当的特性模仿，JScript 1.0还是很难与JavaScript 1.1相提并论。

1997年，内置JavaScript 1.2的Netscape Navigator 4发布；而到这一年年底，ECMA-262第1版也被接受并实现了标准化。结果，虽然ECMAScript被认为是基于JavaScript 1.1制定的，但JavaScript 1.2与ECMAScript的第1版并不兼容。

JScript的升级版是Internet Explorer 4中内置的JScript 3.0（随同微软IIS 3.0发布的JScript 2.0从来也没有移植到浏览器中）。微软通过媒体大肆宣传JScript  3.0是世界上第一个ECMA兼容的脚本语言，但当时的ECMA-262尚未定稿。于是，JScript 3.0与JavaScript 1.2都遭遇了相同的尴尬局面——谁都没有按照最终的ECMAScript标准来实现。

Netscape决定更新其JavaScript实现，即在Netscape Navigator 4.06中发布JavaScript 1.3，从而做到了与ECMA-262的第一个版本完全兼容。在JavaScript1.3中，Netscape增加了对Unicode标准的支持，并在保留JavaScript 1.2新增特性的同时实现了所有对象的平台中立化。在Netscape以Mozilla项目的名义开放其源代码时，预期JavaScript 1.4将随同Netscape Navigator 5一道发布。然而，一个激进的决定，彻底重新设计Netscape代码，打乱了原有计划。后来，JavaScript 1.4只发布了针对Netscape Enterprise Server的服务器版，而没有内置于Web浏览器中。

到了2008年，五大主流Web浏览器（IE、Firefox、Safari、Chrome和Opera）全部做到了与ECMA-262兼容。IE8是第一个着手实现ECMA-262第5版的浏览器，并在IE9中提供了完整的支持。Firefox  4也紧随其后做到兼容。下表列出了ECMAScript受主流Web浏览器支持的情况。

**1.2.2 文档对象模型（DOM）**

文档对象模型（DOM，Document Object Model）是针对XML但经过扩展用于HTML的应用程序编程接口（API，Application Programming Interface）。DOM把整个页面映射为一个多层节点结构。HTML或XML页面中的每个组成部分都是某种类型的节点，这些节点又包含着不同类型的数据。看下面这个HTML页面：
```
<html>
<head><title>Sample Page</title></head>
<body>
<p>Hello World!</p></body>
</html> 
```
在DOM中，这个页面可以通过图1-2所示的分层节点图表示。

通过DOM创建的这个表示文档的树形图，开发人员获得了控制页面内容和结构的主动权。借助DOM提供的API，开发人员可以轻松自如地删除、添加、替换或修改任何节点。

1. 为什么要使用DOM

在Internet Explorer 4和Netscape Navigator 4分别支持的不同形式的DHTML（Dynamic HTML）基础上，开发人员首次无需重新加载网页，就可以修改其外观和内容了。然而，DHTML在给Web技术发展带来巨大进步的同时，也带来了巨大的问题。由于Netscape和微软在开发DHTML方面各持己见，过去那个只编写一个HTML页面就能够在任何浏览器中运行的时代结束了。

对开发人员而言，如果想继续保持Web跨平台的天性，就必须额外多做一些工作。而人们真正担心的是，如果不对Netscape和微软加以控制，Web开发领域就会出现技术上两强割据，浏览器互不兼容的局面。此时，负责制定Web通信标准的W3C（World  Wide  Web  Consortium，万维网联盟）开始着手规划DOM。

2. DOM级别

DOM1级（DOM Level 1）于1998年10月成为W3C的推荐标准。DOM1级由两个模块组成：DOM核心（DOM  Core）和DOM HTML。其中，DOM核心规定的是如何映射基于XML的文档结构，以便简化对文档中任意部分的访问和操作。DOM HTML模块则在DOM核心的基础上加以扩展，添加了针对HTML的对象和方法。

请读者注意，DOM并不只是针对JavaScript的，很多别的语言也都实现了DOM。不过，在Web浏览器中，基于ECMAScript实现的DOM的确已经成为JavaScript这门语言的一个重要组成部分。

如果说DOM1级的目标主要是映射文档的结构，那么DOM2级的目标就要宽泛多了。DOM2级在原来DOM的基础上又扩充了（DHTML一直都支持的）鼠标和用户界面事件、范围、遍历（迭代DOM文档的方法）等细分模块，而且通过对象接口增加了对CSS（Cascading  Style  Sheets，层叠样式表）的支持。DOM1级中的DOM核心模块也经过扩展开始支持XML命名空间。

DOM2级引入了下列新模块，也给出了众多新类型和新接口的定义。
- DOM视图（DOMViews）：定义了跟踪不同文档（例如，应用CSS之前和之后的文档）视图的接口；
- DOM事件（DOM Events）：定义了事件和事件处理的接口；
- DOM样式（DOM Style）：定义了基于CSS为元素应用样式的接口；
- DOM遍历和范围（DOM Traversal and Range）：定义了遍历和操作文档树的接口。
 
DOM3级则进一步扩展了DOM，引入了以统一方式加载和保存文档的方法——在DOM加载和保存（DOM Load and Save）模块中定义；新增了验证文档的方法——在DOM验证（DOM Validation）模块中定义。DOM3级也对DOM核心进行了扩展，开始支持XML1.0规范，涉及XML  Infoset、XPath和XML Base。

在阅读DOM标准的时候，读者可能会看到DOM0级（DOM Level 0）的字眼。实际上，DOM0级标准是不存在的；所谓DOM0级只是DOM历史坐标中的一个参照点而已。具体说来，DOM0级指的是Internet Explorer 4.0和Netscape Navigator 4.0最初支持的DHTML。

3. 其他DOM标准

除了DOM核心和DOM HTML接口之外，另外几种语言还发布了只针对自己的DOM标准。下面列出的语言都是基于XML的，每种语言的DOM标准都添加了与特定语言相关的新方法和新接口：
- SVG（Scalable Vector Graphic，可伸缩矢量图）1.0；
- MathML（Mathematical Markup Language，数学标记语言）1.0；
- SMIL（Synchronized Multimedia Integration Language，同步多媒体集成语言）。
 
还有一些语言也开发了自己的DOM实现，  例如Mozilla的XUL（XML User Interface Language，XML用户界面语言）。但是，只有上面列出的几种语言是W3C的推荐标准。

4. Web浏览器对DOM的支持

在DOM标准出现了一段时间之后，Web浏览器才开始实现它。微软在IE5中首次尝试实现DOM，但直到IE5.5才算是真正支持DOM1级。在随后的IE6和IE7中，微软都没有引入新的DOM功能，而到了IE8才对以前DOM实现中的bug进行了修复。

Netscape直到Netscape 6（Mozilla 0.6.0）才开始支持DOM。在Netscape 7之后，Mozilla把开发重心转向了Firefox浏览器。Firefox 3完全支持DOM1级，几乎完全支持DOM2级，甚至还支持DOM3级的一部分。（Mozilla开发团队的目标是构建与标准100%兼容的浏览器，而他们的努力也得到了回报。）

目前，支持DOM已经成为浏览器开发商的首要目标，主流浏览器每次发布新版本都会改进对DOM的支持。下表列出了主流浏览器对DOM标准的支持情况。

**1.2.3 浏览器对象模型（BOM）**

Internet Explorer 3和Netscape Navigator 3有一个共同的特色，那就是支持可以访问和操作浏览器窗口的浏览器对象模型（BOM，Browser Object Model）。开发人员使用BOM可以控制浏览器显示的页面以外的部分。而BOM真正与众不同的地方（也是经常会导致问题的地方），还是它作为JavaScript实现的一部分但却没有相关的标准。这个问题在HTML5中得到了解决，HTML5致力于把很多BOM功能写入正式规范。HTML5发布后，很多关于BOM的困惑烟消云散。

从根本上讲，BOM只处理浏览器窗口和框架；但人们习惯上也把所有针对浏览器的JavaScript扩展算作BOM的一部分。下面就是一些这样的扩展：
- 弹出新浏览器窗口的功能；
- 移动、缩放和关闭浏览器窗口的功能；
- 提供浏览器详细信息的navigator对象；
- 提供浏览器所加载页面的详细信息的location对象；
- 提供用户显示器分辨率详细信息的screen对象；
- 对cookies的支持；
- 像XMLHttpRequest和IE的ActiveXObject这样的自定义对象。

由于没有BOM标准可以遵循，因此每个浏览器都有自己的实现。虽然也存在一些事实标准，例如要有window对象和navigator对象等，但每个浏览器都会为这两个对象乃至其他对象定义自己的属性和方法。现在有了HTML5，BOM实现的细节有望朝着兼容性越来越高的方向发展。第8章将深入讨论BOM。

**1.3 JavaScript版本**

作为Netscape“继承人”的Mozilla公司，是目前唯一还在沿用最初的JavaScript版本编号序列的浏览器开发商。在Netscape将源代码提交给开源的Mozilla项目的时候，JavaScript在浏览器中的最后一个版本号是1.3。（如前所述，1.4版是只针对服务器的实现。）后来，随着Mozilla基金会继续开发JavaScript，添加新的特性、关键字和语法，JavaScript的版本号继续递增。下表列出了Netscape/Mozilla浏览器中JavaScript版本号的递增过程。

实际上，上表中的编号方案源自Firefox 4将内置JavaScript 2.0这一共识。因此，2.0版之前每个递增的版本号，表示的是相应实现与JavaScript  2.0开发目标还有多大的距离。虽然原计划是这样，但JavaScript的这种发展速度让这个计划不再可行。目前，JavaScript 2.0还没有目标实现。

请注意，只有Netscape/Mozilla浏览器才遵循这种编号模式。例如，IE的JScript就采用了另一种版本命名方案。换句话说，JScript的版本号与上表中JavaScript的版本号之间不存在任何对应关系。而且，大多数浏览器在提及对JavaScript的支持情况时，一般都以ECMAScript兼容性和对DOM的支持情况为准。

**1.4 小结**

JavaScript是一种专为与网页交互而设计的脚本语言，由下列三个不同的部分组成：
- ECMAScript，由ECMA-262定义，提供核心语言功能；
- 文档对象模型（DOM），提供访问和操作网页内容的方法和接口；
- 浏览器对象模型（BOM），提供与浏览器交互的方法和接口。
 
JavaScript的这三个组成部分，在当前五个主要浏览器（IE、Firefox、Chrome、Safari和Opera）中都得到了不同程度的支持。其中，所有浏览器对ECMAScript第3版的支持大体上都还不错，而对ECMAScript5的支持程度越来越高，但对DOM的支持则彼此相差比较多。对已经正式纳入HTML5标准的BOM来说，尽管各浏览器都实现了某些众所周知的共同特性，但其他特性还是会因浏览器而异。


第2章 在HTML中使用JavaScript
--------------------------

本章内容
- 使用`<script>`元素
- 嵌入脚本与外部脚本
- 文档模式对JavaScript的影响
- 考虑禁用JavaScript的场景
 
只要一提到把JavaScript放到网页中，就不得不涉及Web的核心语言——HTML。在当初开发JavaScript的时候，Netscape要解决的一个重要问题就是如何做到让JavaScript既能与HTML页面共存，又不影响那些页面在其他浏览器中的呈现效果。经过尝试、纠错和争论，最终的决定就是为Web增加统一的脚本支持。而Web诞生早期的很多做法也都保留了下来，并被正式纳入HTML规范当中。

**2.1 script元素**

向HTML页面中插入JavaScript的主要方法，就是使用`<script>`元素。这个元素由Netscape创造并在NetscapeNavigator2中首先实现。后来，这个元素被加入到正式的HTML规范中。HTML  4.01为`<script>`定义了下列6个属性。

- async：可选。表示应该立即下载脚本，但不应妨碍页面中的其他操作，比如下载其他资源或等待加载其他脚本。只对外部脚本文件有效。
- charset：可选。表示通过src属性指定的代码的字符集。由于大多数浏览器会忽略它的值，因此这个属性很少有人用。
- defer：可选。表示脚本可以延迟到文档完全被解析和显示之后再执行。只对外部脚本文件有效。IE7及更早版本对嵌入脚本也支持这个属性。
- language：已废弃。原来用于表示编写代码使用的脚本语言（如JavaScript、JavaScript1.2或VBScript）。大多数浏览器会忽略这个属性，因此也没有必要再用了。
- src：可选。表示包含要执行代码的外部文件。
- type：可选。可以看成是language的替代属性；表示编写代码使用的脚本语言的内容类型（也称为MIME类型） 。虽然`text/javascript`和`text/ecmascript`都已经不被推荐使用，但人们一直以来使用的都还是`text/javascript`。实际上，服务器在传送JavaScript文件时使用的MIME类型通常是application/x–javascript，但在type中设置这个值却可能导致脚本被忽略。另外，在非IE浏览器中还可以使用以下值：`application/javascript` 和 `application/ecmascript`。考虑到约定俗成和最大限度的浏览器兼容性，目前type属性的值依旧还是`text/javascript`。不过，这个属性并不是必需的，如果没有指定这个属性，则其默认值仍为`text/javascript`。

使用`<script>`元素的方式有两种：直接在页面中嵌入JavaScript代码和包含外部JavaScript文件。

在使用`<script>`元素嵌入JavaScript代码时，只须为`<script>`指定type属性。然后，像下面这样把JavaScript代码直接放在元素内部即可：

```
<script type="text/javascript">
function sayHi(){
    alert("Hi!");
}
</script>
```


包含在`<script>`元素内部的JavaScript代码将被从上至下依次解释。就拿前面这个例子来说，解释器会解释一个函数的定义，然后将该定义保存在自己的环境当中。在解释器对`<script>`元素内部的所有代码求值完毕以前，页面中的其余内容都不会被浏览器加载或显示。在使用`<script>`嵌入JavaScript代码时，记住不要在代码中的任何地方出现`</script>`字符串。例如，浏览器在加载下面所示的代码时就会产生一个错误：
```
<script type="text/javascript">
function sayScript(){
    alert("</script>");
}
</script> 
```
因为按照解析嵌入式代码的规则，当浏览器遇到字符串`</script>`时，就会认为那是结束的`</script>`标签。而通过转义字符“/”可以解决这个问题，例如：
```
<script type="text/javascript">
function sayScript(){
    alert("<\/script>");
}
</script>
```
这样写代码浏览器可以接受，因而也就不会导致错误了。

如果要通过`<script>`元素来包含外部JavaScript文件，那么src属性就是必需的。这个属性的值是一个指向外部JavaScript文件的链接，例如：
```
<script type="text/javascript" src="example.js"></script>
```
在这个例子中，外部文件example.js将被加载到当前页面中。外部文件只须包含通常要放在开始的`<script>`和结束的`</script>`之间的那些JavaScript代码即可。与解析嵌入式JavaScript代码一样，在解析外部JavaScript文件（包括下载该文件）时，页面的处理也会暂时停止。如果是在XHTML文档中，也可以省略前面示例代码中结束的`</script>`标签，例如：
```
<script type="text/javascript" src="example.js" />
```
但是，不能在HTML文档使用这种语法。原因是这种语法不符合HTML规范，而且也得不到某些浏览器（尤其是IE）的正确解析。

按照惯例，外部JavaScript文件带有`.js`扩展名。但这个扩展名不是必需的，因为浏览器不会检查包含JavaScript的文件的扩展名。这样一来，使用JSP、PHP或其他服务器端语言动态生成JavaScript代码也就成为了可能。但是，服务器通常还是需要看扩展名决定为响应应用哪种MIME类型。如果不使用.js扩展名，请确保服务器能返回正确的MIME类型。

需要注意的是，带有src属性的`<script>`元素不应该在其`<script>`和`</script>`标签之间再包含额外的JavaScript代码。如果包含了嵌入的代码，则只会下载并执行外部脚本文件，嵌入的代码会被忽略。

另外，通过`<script>`元素的src属性还可以包含来自外部域的JavaScript文件。这一点既让`<script>`元素倍显强大，又让它备受争议。在这一点上，`<script>`与`<img>`元素非常相似，即它的src属性可以是指向当前HTML页面所在域之外的某个域中的完整URL，例如：
```
<script type="text/javascript" src="http://www.somewhere.com/afile.js"></script>
```
这样，位于外部域中的代码也会被加载和解析，就像这些代码位于加载它们的页面中一样。利用这一点就可以在必要时通过不同的域来提供JavaScript文件。不过，在访问自己不能控制的服务器上的JavaScript文件时则要多加小心。如果不幸遇到了怀有恶意的程序员，那他们随时都可能替换该文件中的代码。因此，如果想包含来自不同域的代码，则要么你是那个域的所有者，要么那个域的所有者值得信赖。无论如何包含代码，只要不存在defer和async属性，浏览器都会按照`<script>`元素在页面中出现的先后顺序对它们依次进行解析。换句话说，在第一个`<script>`元素包含的代码解析完成后，第二个`<script>`包含的代码才会被解析，然后才是第三个、第四个......

**2.1.1 标签的位置**

按照传统的做法，所有`<script>`元素都应该放在页面的`<head>`元素中，例如：
```
<!DOCTYPE html>
<html>
<head>
<title>Example HTML Page</title>
<script type="text/javascript" src="example1.js"></script>
<script type="text/javascript" src="example2.js"></script>
</head>
<body>
<!-- 这里放内容 -->
</body>
</html> 
```
这种做法的目的就是把所有外部文件（包括CSS文件和JavaScript文件）的引用都放在相同的地方。可是，在文档的`<head>`元素中包含所有JavaScript文件，意味着必须等到全部JavaScript代码都被下载、解析和执行完成以后，才能开始呈现页面的内容（浏览器在遇到`<body>`标签时才开始呈现内容）。对于那些需要很多JavaScript代码的页面来说，这无疑会导致浏览器在呈现页面时出现明显的延迟，而延迟期间的浏览器窗口中将是一片空白。为了避免这个问题，现代Web应用程序一般都把全部JavaScript引用放在`<body>`元素中页面内容的后面，如下例所示：
```
<!DOCTYPE html>
<html>
<head>
<title>Example HTML Page</title>
</head>
<body>
<!-- 这里放内容 -->
<script type="text/javascript" src="example1.js"></script>
<script type="text/javascript" src="example2.js"></script>
</body>
</html>
```

这样，在解析包含的JavaScript代码之前，页面的内容将完全呈现在浏览器中。而用户也会因为浏览器窗口显示空白页面的时间缩短而感到打开页面的速度加快了。

**2.1.2 延迟脚本**

HTML 4.01为`<script>`标签定义了defer属性。这个属性的用途是表明脚本在执行时不会影响页面的构造。也就是说，脚本会被延迟到整个页面都解析完毕后再运行。因此，在`<script>`元素中设置defer属性，相当于告诉浏览器立即下载，但延迟执行。
```
<!DOCTYPE html>
<html>
<head><title>Example HTML Page</title>
<script type="text/javascript" defer="defer" src="example1.js"></script>
<script type="text/javascript" defer="defer" src="example2.js"></script>
</head>
<body>
<!-- 这里放内容 -->
</body>
</html> 
```
在这个例子中，虽然我们把`<script>`元素放在了文档的`<head>`元素中，但其中包含的脚本将延迟到浏览器遇到`</html>`标签后再执行。HTML5规范要求脚本按照它们出现的先后顺序执行，因此第一个延迟脚本会先于第二个延迟脚本执行，而这两个脚本会先于DOMContentLoaded事件（详见第13章）执行。在现实当中，延迟脚本并不一定会按照顺序执行，也不一定会在DOMContentLoaded事件触发前执行，因此最好只包含一个延迟脚本。

前面提到过，defer属性只适用于外部脚本文件。这一点在HTML5中已经明确规定，因此支持HTML5的实现会忽略给嵌入脚本设置的defer属性。IE4～IE7还支持对嵌入脚本的defer属性，但IE8及之后版本则完全支持HTML5规定的行为。IE4、Firefox3.5、Safari5和Chrome是最早支持defer属性的浏览器。其他浏览器会忽略这个属性，像平常一样处理脚本。为此，把延迟脚本放在页面底部仍然是最佳选择。

在XHTML文档中，要把defer属性设置为defer="defer"。

**2.1.3 异步脚本**

HTML5为`<script>`元素定义了async属性。这个属性与defer属性类似，都用于改变处理脚本的行为。同样与defer类似，async只适用于外部脚本文件，并告诉浏览器立即下载文件。但与defer不同的是，标记为async的脚本并不保证按照指定它们的先后顺序执行。例如：
```
<!DOCTYPE html>
<html>
<head>
<title>Example HTML Page</title>
<script type="text/javascript" async src="example1.js"></script>
<script type="text/javascript" async src="example2.js"></script>
</head>
<body>
<!-- 这里放内容 -->
</body>
</html>
```

在以上代码中，第二个脚本文件可能会在第一个脚本文件之前执行。因此，确保两者之间互不依赖非常重要。指定async属性的目的是不让页面等待两个脚本下载和执行，从而异步加载页面其他内容。为此，建议异步脚本不要在加载期间修改DOM。异步脚本一定会在页面的load事件前执行，但可能会在DOMContentLoaded事件触发之前或之后执行。支持异步脚本的浏览器有Firefox 3.6、Safari 5和Chrome。

在XHTML文档中，要把async属性设置为async="async"。

**2.1.4 在XHTML中的用法**

可扩展超文本标记语言，即XHTML（Extensible  HyperText  Markup  Language），是将HTML作为XML的应用而重新定义的一个标准。编写XHTML代码的规则要比编写HTML严格得多，而且直接影响能否在嵌入JavaScript代码时使用`<script/>`

**2.1.5 不推荐使用的语法**

在最早引入`<script>`元素的时候，该元素与传统HTML的解析规则是有冲突的。由于要对这个元素应用特殊的解析规则，因此在那些不支持JavaScript的浏览器（最典型的是Mosaic）中就会导致问题。具体来说，不支持JavaScript的浏览器会把`<script>`元素的内容直接输出到页面中，因而会破坏页面的布局和外观。Netscape与Mosaic协商并提出了一个解决方案，让不支持`<script>`元素的浏览器能够隐藏嵌入的JavaScript代码。这个方案就是把JavaScript代码包含在一个HTML注释中，像下面这样：
```
<script><!-- function sayHi(){ alert("Hi!"); } //--></script> 
```

给脚本加上HTML注释后，Mosaic等浏览器就会忽略`<script>`标签中的内容；而那些支持JavaScript的浏览器在遇到这种情况时，则必须进一步确认其中是否包含需要解析的JavaScript代码。

虽然这种注释JavaScript代码的格式得到了所有浏览器的认可，也能被正确解释，但由于所有浏览器都已经支持JavaScript，因此也就没有必要再使用这种格式了。在XHTML模式下，因为脚本包含在XML注释中，所以脚本会被忽略。

**2.2 嵌入代码与外部文件**

在HTML中嵌入JavaScript代码虽然没有问题，但一般认为最好的做法还是尽可能使用外部文件来包含JavaScript代码。不过，并不存在必须使用外部文件的硬性规定，但支持使用外部文件的人多会强调如下优点。- 可维护性：遍及不同HTML页面的JavaScript会造成维护问题。但把所有JavaScript文件都放在一个文件夹中，维护起来就轻松多了。而且开发人员因此也能够在不触及HTML标记的情况下，集中精力编辑JavaScript代码。
- 可缓存：浏览器能够根据具体的设置缓存链接的所有外部JavaScript文件。也就是说，如果有两个页面都使用同一个文件，那么这个文件只需下载一次。因此，最终结果就是能够加快页面加载的速度。
- 适应未来：通过外部文件来包含JavaScript无须使用前面提到XHTML或注释hack。HTML和XHTML包含外部文件的语法是相同的

**2.3 文档模式**

IE5.5引入了文档模式的概念，而这个概念是通过使用文档类型（doctype）切换实现的。最初的两种文档模式是：混杂模式（quirks mode）①和标准模式（standards mode）。混杂模式会让IE的行为与（包含非标准特性的）IE5相同，而标准模式则让IE的行为更接近标准行为。虽然这两种模式主要影响CSS内容的呈现，但在某些情况下也会影响到JavaScript的解释执行。本书将在必要时再讨论这些因文档模式而影响JavaScript执行的情况。

在IE引入文档模式的概念后，其他浏览器也纷纷效仿。在此之后，IE又提出一种所谓的准标准模式（almost standards mode）。这种模式下的浏览器特性有很多都是符合标准的，但也不尽然。不标准的地方主要体现在处理图片间隙的时候（在表格中使用图片时问题最明显）。如果在文档开始处没有发现文档类型声明，则所有浏览器都会默认开启混杂模式。但采用混杂模式不是什么值得推荐的做法，因为不同浏览器在这种模式下的行为差异非常大，如果不使用某些hack技术，跨浏览器的行为根本就没有一致性可言。

对于标准模式，可以通过使用下面任何一种文档类型来开启：
```
<!-- HTML 4.01 严格型 -->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">

<!-- XHTML 1.0 严格型 -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<!-- HTML 5 -->
<!DOCTYPE html> 
```
而对于准标准模式，则可以通过使用过渡型（transitional）或框架集型（frameset）文档类型来触发，如下所示：
```
<!-- HTML 4.01 过渡型 -->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">

<!-- HTML 4.01 框架集型 -->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN"
"http://www.w3.org/TR/html4/frameset.dtd">

<!-- XHTML 1.0 过渡型 -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<!-- XHTML 1.0 框架集型 -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
```

准标准模式与标准模式非常接近，它们的差异几乎可以忽略不计。因此，当有人提到“标准模式”时，有可能是指这两种模式中的任何一种。而且，检测文档模式（本书后面将会讨论）时也不会发现什么不同。本书后面提到标准模式时，指的是除混杂模式之外的其他模式。

**2.4 noscript元素**

早期浏览器都面临一个特殊的问题，即当浏览器不支持JavaScript时如何让页面平稳地退化。对这个问题的最终解决方案就是创造一个`<noscript>`元素，用以在不支持JavaScript的浏览器中显示替代的内容。这个元素可以包含能够出现在文档`<body>`中的任何HTML元素——`<script>`元素除外。包含在`<noscript>`元素中的内容只有在下列情况下才会显示出来：

- 浏览器不支持脚本；
- 浏览器支持脚本，但脚本被禁用。

符合上述任何一个条件，浏览器都会显示`<noscript>`中的内容。而在除此之外的其他情况下，浏览器不会呈现`<noscript>`中的内容。

请看下面这个简单的例子：
```
<html>
<head>
<title>Example HTML Page</title>
<script type="text/javascript" defer="defer" src="example1.js"></script>  
<script type="text/javascript" defer="defer" src="example2.js"></script>
</head>
<body>
<noscript><p>本页面需要浏览器支持（启用）JavaScript。</noscript>
</body>
</html> 
```
这个页面会在脚本无效的情况下向用户显示一条消息。而在启用了脚本的浏览器中，用户永远也不会看到它——尽管它是页面的一部分。

**2.5 小结**

把JavaScript插入到HTML页面中要使用`<script>`元素。使用这个元素可以把JavaScript嵌入到HTML页面中，让脚本与标记混合在一起；也可以包含外部的JavaScript文件。而我们需要注意的地方有：

- 在包含外部JavaScript文件时，必须将src属性设置为指向相应文件的URL。而这个文件既可以是与包含它的页面位于同一个服务器上的文件，也可以是其他任何域中的文件。
- 所有`<script>`元素都会按照它们在页面中出现的先后顺序依次被解析。在不使用defer和async属性的情况下，只有在解析完前面`<script>`元素中的代码之后，才会开始解析后面`<script>`元素中的代码。
- 由于浏览器会先解析完不使用defer属性的`<script>`元素中的代码，然后再解析后面的内容，所以一般应该把`<script>`元素放在页面最后，即主要内容后面，`</body>`标签前面。
- 使用defer属性可以让脚本在文档完全呈现之后再执行。延迟脚本总是按照指定它们的顺序执行。
- 使用async属性可以表示当前脚本不必等待其他脚本，也不必阻塞文档呈现。不能保证异步脚本按照它们在页面中出现的顺序执行。

另外，使用`<noscript>`元素可以指定在不支持脚本的浏览器中显示的替代内容。但在启用了脚本的情况下，浏览器不会显示`<noscript>`元素中的任何内容。

第3章 基本概念
------------

本章内容
- 语法
- 数据类型
- 流控制语句
- 函数

任何语言的核心都必然会描述这门语言最基本的工作原理。而描述的内容通常都要涉及这门语言的语法、操作符、数据类型、内置功能等用于构建复杂解决方案的基本概念。如前所述，ECMA-262通过叫做ECMAScript的“伪语言”为我们描述了JavaScript的所有这些基本概念。目前，ECMA-262第3版中定义的ECMAScript是各浏览器实现最多的一个版本。ECMA-262第5版是浏览器接下来实现的版本，但截止到2011年底，还没有浏览器完全实现了这个版本。为此，本章将主要按照第3版定义的ECMAScript介绍这门语言的基本概念，并就第5版的变化给出说明。

**3.1 语法**

ECMAScript的语法大量借鉴了C及其他类C语言（如Java和Perl）的语法。因此，熟悉这些语言的开发人员在接受ECMAScript更加宽松的语法时，一定会有一种轻松自在的感觉。

**3.1.1 区分大小写**

要理解的第一个概念就是ECMAScript中的一切（变量、函数名和操作符）都区分大小写。这也就意味着，变量名test和变量名Test分别表示两个不同的变量，而函数名不能使用typeof，因为它是一个关键字（3.2节介绍关键字），但typeOf则完全可以是一个有效的函数名。

**3.1.2 标识符**

所谓标识符，就是指变量、函数、属性的名字，或者函数的参数。标识符可以是按照下列格式规则组合起来的一或多个字符：

- 第一个字符必须是一个字母、下划线（_）或一个美元符号（$）
- 其他字符可以是字母、下划线、美元符号或数字。

标识符中的字母也可以包含扩展的ASCII或Unicode字母字符（如À和Æ），但我们不推荐这样做。按照惯例，ECMAScript标识符采用驼峰大小写格式，也就是第一个字母小写，剩下的每个单词的首字母大写，例如：

```
firstSecond
myCar
doSomethingImportant
```

虽然没有谁强制要求必须采用这种格式，但为了与ECMAScript内置的函数和对象命名格式保持一致，可以将其当作一种最佳实践。

不能把关键字、保留字、true、false和null用作标识符。3.2节将介绍更多相关内容。

**3.1.3 注释**

ECMAScript使用C风格的注释，包括单行注释和块级注释。单行注释以两个斜杠开头，如下所示：
```
// 单行注释
```
块级注释以一个斜杠和一个星号`/*`开头，以一个星号和一个斜杠`*/`结尾，如下所示：
```
/*
 * 这是一个多行
 *（块级）注释
 */
```
虽然上面注释中的第二和第三行都以一个星号开头，但这不是必需的。之所以添加那两个星号，纯粹是为了提高注释的可读性（这种格式在企业级应用中用得比较多）。

**3.1.4 严格模式**

ECMAScript5引入了严格模式（strict  mode）的概念。严格模式是为JavaScript定义了一种不同的解析与执行模型。在严格模式下，ECMAScript3中的一些不确定的行为将得到处理，而且对某些不安全的操作也会抛出错误。要在整个脚本中启用严格模式，可以在顶部添加如下代码：
```
"use strict";
```
这行代码看起来像是字符串，而且也没有赋值给任何变量，但其实它是一个编译指示（pragma），用于告诉支持的JavaScript引擎切换到严格模式。这是为不破坏ECMAScript3语法而特意选定的语法。在函数内部的上方包含这条编译指示，也可以指定函数在严格模式下执行：
```
function doSomething(){
    "use strict";
    //函数体
}
```
严格模式下，JavaScript的执行结果会有很大不同，因此本书将会随时指出严格模式下的区别。支持严格模式的浏览器包括IE10+、Firefox4+、Safari5.1+、Opera12+和Chrome。

**3.1.5 语句**

ECMAScript中的语句以一个分号结尾；如果省略分号，则由解析器确定语句的结尾，如下例所示：
```
var sum = a + b // 即使没有分号也是有效的语句——不推荐
var diff = a - b; // 有效的语句——推荐
```

虽然语句结尾的分号不是必需的，但我们建议任何时候都不要省略它。因为加上这个分号可以避免很多错误（例如不完整的输入），开发人员也可以放心地通过删除多余的空格来压缩ECMAScript代码（代码行结尾处没有分号会导致压缩错误）。另外，加上分号也会在某些情况下增进代码的性能，因为这样解析器就不必再花时间推测应该在哪里插入分号了。

可以使用C风格的语法把多条语句组合到一个代码块中，即代码块以左花括号`{`开头，以右花括号`}`结尾：
```
if (test) {
    test = false;
    alert(test);
}
```
虽然条件控制语句（如if语句）只在执行多条语句的情况下才要求使用代码块，但最佳实践是始终在控制语句中使用代码块——即使代码块中只有一条语句，例如：
```
if (test) alert(test); // 有效但容易出错，不要使用
if (test) {             
    // 推荐使用
    alert(test);
}
```
在控制语句中使用代码块可以让编码意图更加清晰，而且也能降低修改代码时出错的几率。

**3.2 关键字和保留字**

ECMA-262描述了一组具有特定用途的关键字，这些关键字可用于表示控制语句的开始或结束，或者用于执行特定操作等。按照规则，关键字也是语言保留的，不能用作标识符。以下就是ECMAScript的全部关键字（带*号上标的是第5版新增的关键字）：

break  do instanceof  typeof case else new var catch finally return void continue for switch while debugger *function this with default if throw delete in try 

ECMA-262还描述了另外一组不能用作标识符的保留字。尽管保留字在这门语言中还没有任何特定的用途，但它们有可能在将来被用作关键字。以下是ECMA-262第3版定义的全部保留字：
abstract      enum            int            short boolean       export          interface      static byte          extends         long           super char          final           native         synchronized class         float           package        throws const         goto            private        transient debugger      implements      protected      volatile double        import          public 

第5版把在非严格模式下运行时的保留字缩减为下列这些：
class          enum          extends         super const          export        import 
在严格模式下，第5版还对以下保留字施加了限制：
implements     package       public interface      private       static let            protected     yield 

注意，let和yield是第5版新增的保留字；其他保留字都是第3版定义的。为了最大程度地保证兼容性，建议读者将第3版定义的保留字外加let和yield作为编程时的参考。在实现ECMAScript3的JavaScript引擎中使用关键字作标识符，会导致“Identifier Expected”错误。而使用保留字作标识符可能会也可能不会导致相同的错误，具体取决于特定的引擎。第5版对使用关键字和保留字的规则进行了少许修改。关键字和保留字虽然仍然不能作为标识符使用，但现在可以用作对象的属性名。一般来说，最好都不要使用关键字和保留字作为标识符和属性名，以便与将来的ECMAScript版本兼容。除了上面列出的保留字和关键字，ECMA-262第5版对eval和arguments还施加了限制。在严格模式下，这两个名字也不能作为标识符或属性名，否则会抛出错误。

**3.3 变量**

ECMAScript的变量是松散类型的，所谓松散类型就是可以用来保存任何类型的数据。换句话说，每个变量仅仅是一个用于保存值的占位符而已。定义变量时要使用var操作符（注意var是一个关键字），后跟变量名（即一个标识符），如下所示：

```
var message;
```

这行代码定义了一个名为message的变量，该变量可以用来保存任何值（像这样未经过初始化的变量，会保存一个特殊的值——undefined，相关内容将在3.4节讨论）。ECMAScript也支持直接初始化变量，因此在定义变量的同时就可以设置变量的值，如下所示：

```
var message = "hi";
```

在此，变量message中保存了一个字符串值"hi"。像这样初始化变量并不会把它标记为字符串类型；初始化的过程就是给变量赋一个值那么简单。因此，可以在修改变量值的同时修改值的类型，如下所示：

```
var message = "hi"; message = 100; // 有效，但不推荐
```

在这个例子中，变量message一开始保存了一个字符串值"hi"，然后该值又被一个数字值100取代。虽然我们不建议修改变量所保存值的类型，但这种操作在ECMAScript中完全有效。

有一点必须注意，即用var操作符定义的变量将成为定义该变量的作用域中的局部变量。也就是说，如果在函数中使用var定义一个变量，那么这个变量在函数退出后就会被销毁，例如：

```
function test(){
    var message = "hi"; // 局部变量
}
test();
alert(message); // 错误！
```

这里，变量message是在函数中使用var定义的。当函数被调用时，就会创建该变量并为其赋值。而在此之后，这个变量又会立即被销毁，因此例子中的下一行代码就会导致错误。不过，可以像下面这样省略var操作符，从而创建一个全局变量：

```
function test() {
    message = "hi"; // 全局变量
}
test();
alert(message); // "hi" 
```

这个例子省略了var操作符，因而message就成了全局变量。这样，只要调用过一次test()函数，这个变量就有了定义，就可以在函数外部的任何地方被访问到。

虽然省略var操作符可以定义全局变量，但这也不是我们推荐的做法。因为在局部作用域中定义的全局变量很难维护，而且如果有意地忽略了var操作符，也会由于相应变量不会马上就有定义而导致不必要的混乱。给未经声明的变量赋值在严格模式下会导致抛出ReferenceError错误。

可以使用一条语句定义多个变量，只要像下面这样把每个变量（初始化或不初始化均可）用逗号分隔开即可：

```
var message = "hi",
    found = false,
    age = 29;
```

这个例子定义并初始化了3个变量。同样由于ECMAScript是松散类型的，因而使用不同类型初始化变量的操作可以放在一条语句中来完成。虽然代码里的换行和变量缩进不是必需的，但这样做可以提高可读性。在严格模式下，不能定义名为eval或arguments的变量，否则会导致语法错误。

**3.4 数据类型**

ECMAScript中有5种简单数据类型（也称为基本数据类型）：Undefined、Null、Boolean、Number和String。还有1种复杂数据类型——Object，Object本质上是由一组无序的名值对组成的。ECMAScript不支持任何创建自定义类型的机制，而所有值最终都将是上述6种数据类型之一。乍一看，好像只有6种数据类型不足以表示所有数据；但是，由于ECMAScript数据类型具有动态性，因此的确没有再定义其他数据类型的必要了。

**3.4.1 typeof操作符**

鉴于ECMAScript是松散类型的，因此需要有一种手段来检测给定变量的数据类型——typeof就是负责提供这方面信息的操作符。对一个值使用typeof操作符可能返回下列某个字符串：

- "undefined"——如果这个值未定义；
- "boolean"——如果这个值是布尔值；
- "string"——如果这个值是字符串；
- "number"——如果这个值是数值；
- "object"——如果这个值是对象或null；
- "function"——如果这个值是函数。

下面是几个使用typeof操作符的例子：

```
var message = "some string";
alert(typeof message); // "string"
alert(typeof(message)); // "string"
alert(typeof 95); // "number"
```

这几个例子说明，typeof操作符的操作数可以是变量（message），也可以是数值字面量。注意，typeof是一个操作符而不是函数，因此例子中的圆括号尽管可以使用，但不是必需的。

有些时候，typeof操作符会返回一些令人迷惑但技术上却正确的值。比如，调用typeof null会返回"object"，因为特殊值null被认为是一个空的对象引用。Safari 5及之前版本、Chrome 7及之前版本在对正则表达式调用typeof操作符时会返回"function"，而其他浏览器在这种情况下会返回"object"。

从技术角度讲，函数在ECMAScript中是对象，不是一种数据类型。然而，函数也确实有一些特殊的属性，因此通过typeof操作符来区分函数和其他对象是有必要的。

**3.4.2 Undefined类型**

Undefined类型只有一个值，即特殊的undefined。在使用var声明变量但未对其加以初始化时，这个变量的值就是undefined，例如：

```
var message;
alert(message == undefined); //true
```

这个例子只声明了变量message，但未对其进行初始化。比较这个变量与undefined字面量，结果表明它们是相等的。这个例子与下面的例子是等价的：

```
var message = undefined;
alert(message == undefined); //true
```

这个例子使用undefined值显式初始化了变量message。但我们没有必要这么做，因为未经初始化的值默认就会取得undefined值。

一般而言，不存在需要显式地把一个变量设置为undefined值的情况。字面值undefined的主要目的是用于比较，而ECMA-262第3版之前的版本中并没有规定这个值。第3版引入这个值是为了正式区分空对象指针与未经初始化的变量。

不过，包含undefined值的变量与尚未定义的变量还是不一样的。看看下面这个例子：

```
var message; // 这个变量声明之后默认取得了undefined值
// 下面这个变量并没有声明
// var age
alert(message); // "undefined"
alert(age); // 产生错误
```

运行以上代码，第一个警告框会显示变量message的值，即"undefined"。而第二个警告框——由于传递给alert()函数的是尚未声明的变量age——则会导致一个错误。对于尚未声明过的变量，只能执行一项操作，即使用typeof操作符检测其数据类型（对未经声明的变量调用delete不会导致错误，但这样做没什么实际意义，而且在严格模式下确实会导致错误）。然而，令人困惑的是：对未初始化的变量执行typeof操作符会返回undefined值，而对未声明的变量执行typeof操作符同样也会返回undefined值。来看下面的例子：

```
var message; // 这个变量声明之后默认取得了undefined值
// 下面这个变量并没有声明
// var age
alert(typeof message); // "undefined"
alert(typeof age);     // "undefined"
```

结果表明，对未初始化和未声明的变量执行typeof操作符都返回了undefined值；这个结果有其逻辑上的合理性。因为虽然这两种变量从技术角度看有本质区别，但实际上无论对哪种变量也不可能执行真正的操作。

即便未初始化的变量会自动被赋予undefined值，但显式地初始化变量依然是明智的选择。如果能够做到这一点，那么当typeof操作符返回"undefined"值时，我们就知道被检测的变量还没有被声明，而不是尚未初始化。

**3.4.3 Null类型**

Null类型是第二个只有一个值的数据类型，这个特殊的值是null。从逻辑角度来看，null值表示一个空对象指针，而这也正是使用typeof操作符检测null值时会返回"object"的原因，如下面的例子所示：

```
var car = null;
alert(typeof car); // "object"
```

如果定义的变量准备在将来用于保存对象，那么最好将该变量初始化为null而不是其他值。这样一来，只要直接检查null值就可以知道相应的变量是否已经保存了一个对象的引用，如下面的例子所示：

```
if (car != null) {
// 对car对象执行某些操作
} 
```

实际上，undefined值是派生自null值的，因此ECMA-262规定对它们的相等性测试要返回true：

```
alert(null == undefined); //true 
```

这里，位于null和undefined之间的相等操作符（==）总是返回true，不过要注意的是，这个操作符出于比较的目的会转换其操作数（本章后面将详细介绍相关内容）。

尽管null和undefined有这样的关系，但它们的用途完全不同。如前所述，无论在什么情况下都没有必要把一个变量的值显式地设置为undefined，可是同样的规则对null却不适用。换句话说，只要意在保存对象的变量还没有真正保存对象，就应该明确地让该变量保存null值。这样做不仅可以体现null作为空对象指针的惯例，而且也有助于进一步区分null和undefined。

**3.4.4 Boolean类型**

Boolean类型是ECMAScript中使用得最多的一种类型，该类型只有两个字面值：true和false。这两个值与数字值不是一回事，因此true不一定等于1，而false也不一定等于0。以下是为变量赋Boolean类型值的例子：
```
var found = true;
var lost = false; 
```
需要注意的是，Boolean类型的字面值true和false是区分大小写的。也就是说，True和False（以及其他的混合大小写形式）都不是Boolean值，只是标识符。虽然Boolean类型的字面值只有两个，但ECMAScript中所有类型的值都有与这两个Boolean值等价的值。要将一个值转换为其对应的Boolean值，可以调用转型函数Boolean()，如下例所示：

```
var message = "Hello world!";
var messageAsBoolean = Boolean(message); 
```

在这个例子中，字符串message被转换成了一个Boolean值，该值被保存在messageAsBoolean变量中。可以对任何数据类型的值调用Boolean()函数，而且总会返回一个Boolean值。至于返回的这个值是true还是false，取决于要转换值的数据类型及其实际值。下表给出了各种数据类型及其对应的转换规则。

|数据类型|转换为true的值|转换为false的值|
|:--|:---|:---|
|Boolean|true|false|
|String|任何非空字符串|""空字符串|
|Number|任何非零数字值（包括无穷大）|0和NaN（参见本章后面有关NaN的内容）|
|Object|任何对象|null|
|Undefined|n/a①|undefined|

这些转换规则对理解流控制语句（如if语句）自动执行相应的Boolean转换非常重要，请看下面的代码：

```
var message = "Hello world!";
if (message) {
    alert("Value is true");
}
```

运行这个示例，就会显示一个警告框，因为字符串message被自动转换成了对应的Boolean值（true）。由于存在这种自动执行的Boolean转换，因此确切地知道在流控制语句中使用的是什么变量至关重要。错误地使用一个对象而不是一个Boolean值，就有可能彻底改变应用程序的流程。

① n/a（或N/A），是not applicable的缩写，意思是“不适用”。

**3.4.5 Number类型**

Number类型应该是ECMAScript中最令人关注的数据类型了，这种类型使用IEEE754格式来表示整数和浮点数值（浮点数值在某些语言中也被称为双精度数值）。为支持各种数值类型，ECMA-262定义了不同的数值字面量格式。

最基本的数值字面量格式是十进制整数，十进制整数可以像下面这样直接在代码中输入：

```
var intNum = 55;// 整数
```

除了以十进制表示外，整数还可以通过八进制（以8为基数）或十六进制（以16为基数）的字面值来表示。其中，八进制字面值的第一位必须是零（0），然后是八进制数字序列（0～7）。如果字面值中的数值超出了范围，那么前导零将被忽略，后面的数值将被当作十进制数值解析。请看下面的例子：
```
var octalNum1 = 070;// 八进制的56
var octalNum2 = 079;// 无效的八进制数值——解析为79
var octalNum3 = 08; // 无效的八进制数值——解析为8
```

八进制字面量在严格模式下是无效的，会导致支持的JavaScript引擎抛出错误。十六进制字面值的前两位必须是0x，后跟任何十六进制数字（0～9及A～F）。其中，字母A～F可以大写，也可以小写。如下面的例子所示：
```
var hexNum1 = 0xA; // 十六进制的10
var hexNum2 = 0x1f; // 十六进制的31
```

在进行算术计算时，所有以八进制和十六进制表示的数值最终都将被转换成十进制数值。

鉴于JavaScript中保存数值的方式，可以保存正零（+0）和负零（-0）。正零和负零被认为相等，但为了读者更好地理解上下文，这里特别做此说明。

1. 浮点数值

所谓浮点数值，就是该数值中必须包含一个小数点，并且小数点后面必须至少有一位数字。虽然小数点前面可以没有整数，但我们不推荐这种写法。以下是浮点数值的几个例子：

```
var floatNum1 = 1.1;
var floatNum2 = 0.1;
var floatNum3 = .1;// 有效，但不推荐
```

由于保存浮点数值需要的内存空间是保存整数值的两倍，因此ECMAScript会不失时机地将浮点数值转换为整数值。显然，如果小数点后面没有跟任何数字，那么这个数值就可以作为整数值来保存。同样地，如果浮点数值本身表示的就是一个整数（如1.0），那么该值也会被转换为整数，如下面的例子所示：

```
var floatNum1 = 1.; // 小数点后面没有数字——解析为1
var floatNum2 = 10.0; // 整数——解析为10
```

对于那些极大或极小的数值，可以用e表示法（即科学计数法）表示的浮点数值表示。用e表示法表示的数值等于e前面的数值乘以10的指数次幂。ECMAScript中e表示法的格式也是如此，即前面是一个数值（可以是整数也可以是浮点数），中间是一个大写或小写的字母E，后面是10的幂中的指数，该幂值将用来与前面的数相乘。下面是一个使用e表示法表示数值的例子：

```
var floatNum = 3.125e7;// 等于31250000
```

在这个例子中，使用e表示法表示的变量floatNum的形式虽然简洁，但它的实际值则是31250000。在此，e表示法的实际含义就是“3.125乘以10的7次方”。也可以使用e表示法表示极小的数值，如0.00000000000000003，这个数值可以使用更简洁的3e-17表示。在默认情况下，ECMASctipt会将那些小数点后面带有6个零以上的浮点数值转换为以e表示法表示的数值（例如，0.0000003会被转换成3e-7）。浮点数值的最高精度是17位小数，但在进行算术计算时其精确度远远不如整数。例如，0.1加0.2的结果不是0.3，而是0.30000000000000004。这个小小的舍入误差会导致无法测试特定的浮点数值。例如：

```
if (a + b == 0.3) {
    // 不要做这样的测试
    alert("You got 0.3.");
}
```

在这个例子中，我们测试的是两个数的和是不是等于0.3。如果这两个数是0.05和0.25， 或者是0.15和0.15都不会有问题。而如前所述，如果这两个数是0.1和0.2，那么测试将无法通过。因此，永远不要测试某个特定的浮点数值。

关于浮点数值计算会产生舍入误差的问题，有一点需要明确：这是使用基于IEEE754数值的浮点计算的通病，ECMAScript并非独此一家；其他使用相同数值格式的语言也存在这个问题。

2. 数值范围

由于内存的限制，ECMAScript并不能保存世界上所有的数值。ECMAScript能够表示的最小数值保存在Number.MIN_VALUE中——在大多数浏览器中，这个值是5e-324；能够表示的最大数值保存在Number.MAX_VALUE中——在大多数浏览器中，这个值是1.7976931348623157e+308。如果某次计算的结果得到了一个超出JavaScript数值范围的值，那么这个数值将被自动转换成特殊的Infinity值。具体来说，如果这个数值是负数，则会被转换成-Infinity（负无穷），如果这个数值是正数，则会被转换成Infinity（正无穷）。

如上所述，如果某次计算返回了正或负的Infinity值，那么该值将无法继续参与下一次的计算，因为Infinity不是能够参与计算的数值。要想确定一个数值是不是有穷的（换句话说，是不是位于最小和最大的数值之间），可以使用isFinite()函数。这个函数在参数位于最小与最大数值之间时会返回true，如下面的例子所示：

```
var result = Number.MAX_VALUE + Number.MAX_VALUE;
alert(isFinite(result)); //false
```

尽管在计算中很少出现某些值超出表示范围的情况，但在执行极小或极大数值的计算时，检测监控这些值是可能的，也是必需的。

访问Number.NEGATIVE_INFINITY和Number.POSITIVE_INFINITY也可以得到负和正Infinity的值。可以想见，这两个属性中分别保存着-Infinity和Infinity。

3. NaN

NaN，即非数值（Not a Number）是一个特殊的数值，这个数值用于表示一个本来要返回数值的操作数未返回数值的情况（这样就不会抛出错误了）。例如，在其他编程语言中，任何数值除以0都会导致错误，从而停止代码执行。但在ECMAScript中，任何数值除以0会返回NaN①，因此不会影响其他代码的执行。

①原书如此，但实际上只有0除以0才会返回NaN，正数除以0返回Infinity，负数除以0返回-Infinity。

NaN本身有两个非同寻常的特点。首先，任何涉及NaN的操作（例如NaN/10）都会返回NaN，这个特点在多步计算中有可能导致问题。其次，NaN与任何值都不相等，包括NaN本身。例如，下面的代码会返回false：

```
alert(NaN == NaN); //false
```

针对NaN的这两个特点，ECMAScript定义了isNaN()函数。这个函数接受一个参数，该参数可以是任何类型，而函数会帮我们确定这个参数是否“不是数值”。isNaN()在接收到一个值之后，会尝试将这个值转换为数值。某些不是数值的值会直接转换为数值，例如字符串"10"或Boolean值。而任何不能被转换为数值的值都会导致这个函数返回true。请看下面的例子：

```
alert(isNaN(NaN));//true
alert(isNaN(10)); //false（10是一个数值）
alert(isNaN("10")); //false（可以被转换成数值10）
alert(isNaN("blue")); //true（不能转换成数值）
alert(isNaN(true)); //false（可以被转换成数值1）
```

这个例子测试了5个不同的值。测试的第一个值是NaN本身，结果当然会返回true。然后分别测试了数值10和字符串"10"，结果这两个测试都返回了false，因为前者本身就是数值，而后者可以被转换成数值。但是，字符串"blue"不能被转换成数值，因此函数返回了true。由于Boolean值true可以转换成数值1，因此函数返回false。

尽管有点儿不可思议，但isNaN()确实也适用于对象。在基于对象调用isNaN()函数时，会首先调用对象的valueOf()方法，然后确定该方法返回的值是否可以转换为数值。如果不能，则基于这个返回值再调用toString()方法，再测试返回值。而这个过程也是ECMAScript中内置函数和操作符的一般执行流程，更详细的内容请参见3.5节。

4. 数值转换

有3个函数可以把非数值转换为数值：Number()、parseInt()和parseFloat()。第一个函数，即转型函数Number()可以用于任何数据类型，而另两个函数则专门用于把字符串转换成数值。这3个函数对于同样的输入会有返回不同的结果。

Number()函数的转换规则如下。
- 如果是Boolean值，true和false将分别被转换为1和0。
- 如果是数字值，只是简单的传入和返回。
- 如果是null值，返回0。
- 如果是undefined，返回NaN。
- 如果是字符串，遵循下列规则：
    - 如果字符串中只包含数字（包括前面带正号或负号的情况），则将其转换为十进制数值，即"1"会变成1，"123"会变成123，而"011"会变成11（注意：前导的零被忽略了）；
    - 如果字符串中包含有效的浮点格式，如"1.1"，则将其转换为对应的浮点数值（同样，也会忽略前导零）；
    - 如果字符串中包含有效的十六进制格式，例如"0xf"，则将其转换为相同大小的十进制整数值；
    - 如果字符串是空的（不包含任何字符），则将其转换为0；
    - 如果字符串中包含除上述格式之外的字符，则将其转换为NaN。
- 如果是对象，则调用对象的valueOf()方法，然后依照前面的规则转换返回的值。如果转换的结果是NaN，则调用对象的toString()方法，然后再次依照前面的规则转换返回的字符串值。

根据这么多的规则使用Number()把各种数据类型转换为数值确实有点复杂。下面还是给出几个具体的例子吧。

```
var num1 = Number("Hello world!"); // NaN
var num2 = Number("");// 0
var num3 = Number("000011"); // 11
var num4 = Number(true);// 1
```

首先，字符串"Hello world!"会被转换为NaN，因为其中不包含任何有意义的数字值。空字符串会被转换为0。字符串"000011"会被转换为11，因为忽略了其前导的零。最后，true值被转换为1。

一元加操作符（3.5.1节将介绍）的操作与Number()函数相同。

由于Number()函数在转换字符串时比较复杂而且不够合理，因此在处理整数的时候更常用的是parseInt()函数。parseInt()函数在转换字符串时，更多的是看其是否符合数值模式。它会忽略字符串前面的空格，直至找到第一个非空格字符。如果第一个字符不是数字字符或者负号，parseInt()就会返回NaN；也就是说，用parseInt()转换空字符串会返回NaN（Number()对空字符返回0）。如果第一个字符是数字字符，parseInt()会继续解析第二个字符，直到解析完所有后续字符或者遇到了一个非数字字符。例如，"1234blue"会被转换为1234，因为"blue"会被完全忽略。类似地，"22.5"会被转换为22，因为小数点并不是有效的数字字符。

如果字符串中的第一个字符是数字字符，parseInt()也能够识别出各种整数格式（即前面讨论的十进制、八进制和十六进制数）。也就是说，如果字符串以"0x"开头且后跟数字字符，就会将其当作一个十六进制整数；如果字符串以"0"开头且后跟数字字符，则会将其当作一个八进制数来解析。为了更好地理解parseInt()函数的转换规则，下面给出一些例子：

```
var num1 = parseInt("1234blue");// 1234
var num2 = parseInt(""); // NaN
var num3 = parseInt("0xA"); // 10（十六进制数）
var num4 = parseInt(22.5); // 22 
var num5 = parseInt("070"); // 56（八进制数）
var num6 = parseInt("70");  // 70（十进制数）
var num7 = parseInt("0xf"); // 15（十六进制数）
var num8 = parseInt("blue1234"); // NaN
```


在使用parseInt()解析像八进制字面量的字符串时，ECMAScript3和5存在分歧。例如：

```
//ECMAScript3认为是56（八进制），ECMAScript5认为是70（十进制）
var num = parseInt("070");
```

在ECMAScript3JavaScript引擎中，"070"被当成八进制字面量，因此转换后的值是十进制的56。而在ECMAScript5JavaScript引擎中，parseInt()已经不具有解析八进制值的能力，因此前导的零会被认为无效，从而将这个值当成"70"，结果就得到十进制的70。在ECMAScript5中，即使是在非严格模式下也会如此。

为了消除在使用parseInt()函数时可能导致的上述困惑，可以为这个函数提供第二个参数：转换时使用的基数（即多少进制）。如果知道要解析的值是十六进制格式的字符串，那么指定基数16作为第二个参数，可以保证得到正确的结果，例如：

```
var num = parseInt("0xAF", 16); //175
```

实际上，如果指定了16作为第二个参数，字符串可以不带前面的"0x"，如下所示：
```
var num1 = parseInt("AF", 16); //175
var num2 = parseInt("AF"); //NaN
```

这个例子中的第一个转换成功了，而第二个则失败了。差别在于第一个转换传入了基数，明确告诉parseInt()要解析一个十六进制格式的字符串；而第二个转换发现第一个字符不是数字字符，因此就自动终止了。指定基数会影响到转换的输出结果。例如：
```
var num1 = parseInt("10", 2);//2（按二进制解析）
var num2 = parseInt("10", 8);//8（按八进制解析）
var num3 = parseInt("10", 10);//10（按十进制解析）
var num4 = parseInt("10", 16);//16 （按十六进制解析）
```

不指定基数意味着让parseInt()决定如何解析输入的字符串，因此为了避免错误的解析，我们建议无论在什么情况下都明确指定基数。

多数情况下，我们要解析的都是十进制数值，因此始终将10作为第二个参数是非常必要的。

与parseInt()函数类似，parseFloat()也是从第一个字符（位置0）开始解析每个字符。而且也是一直解析到字符串末尾，或者解析到遇见一个无效的浮点数字字符为止。也就是说，字符串中的第一个小数点是有效的，而第二个小数点就是无效的了，因此它后面的字符串将被忽略。举例来说，"22.34.5"将会被转换为22.34。

除了第一个小数点有效之外，parseFloat()与parseInt()的第二个区别在于它始终都会忽略前导的零。parseFloat()可以识别前面讨论过的所有浮点数值格式，也包括十进制整数格式。但十六进制格式的字符串则始终会被转换成0。由于parseFloat()只解析十进制值，因此它没有用第二个参数指定基数的用法。最后还要注意一点：如果字符串包含的是一个可解析为整数的数（没有小数点，或者小数点后都是零），parseFloat()会返回整数。以下是使用parseFloat()转换数值的几个典型示例。

```
var num1 = parseFloat("1234blue"); //1234 （整数）
var num2 = parseFloat("0xA"); //0 
var num3 = parseFloat("22.5"); //22.5
var num4 = parseFloat("22.34.5"); //22.34
var num5 = parseFloat("0908.5"); //908.5 
var num6 = parseFloat("3.125e7"); //31250000 
```

**3.4.6 String类型**

String类型用于表示由零或多个16位Unicode字符组成的字符序列，即字符串。字符串可以由双引号（"）或单引号（'）表示，因此下面两种字符串的写法都是有效的：

```
var firstName = "Nicholas";
var lastName = 'Zakas';
```

与PHP中的双引号和单引号会影响对字符串的解释方式不同，ECMAScript中的这两种语法形式没有什么区别。用双引号表示的字符串和用单引号表示的字符串完全相同。不过，以双引号开头的字符串也必须以双引号结尾，而以单引号开头的字符串必须以单引号结尾。例如，下面这种字符串表示法会导致语法错误：
```
var firstName = 'Nicholas"; // 语法错误（左右引号必须匹配）
```

1. 字符字面量
 
String数据类型包含一些特殊的字符字面量，也叫转义序列，用于表示非打印字符，或者具有其他用途的字符。这些字符字面量如下表所示：

|字面量|含义|
|:----|:---|
|\n|换行|
|\t|制表|
|\b|空格|
|\r|回车|
|\f|进纸|
|\\|斜杠|
|\' |单引号（'），在用单引号表示的字符串中使用。例如：'He said, \'hey.\''|
|\" 双引号（"），在用双引号表示的字符串中使用。例如："He said, \"hey.\""|
|\xnn|以十六进制代码nn表示的一个字符（其中n为0～F）。例如，\x41表示"A"|
|\unnnn|以十六进制代码nnnn表示的一个Unicode字符（其中n为0～F）。例如，\u03a3表示希腊字符Σ|


这些字符字面量可以出现在字符串中的任意位置，而且也将被作为一个字符来解析，如下面的例子所示：
```
var text = "This is the letter sigma: \u03a3."; 
```

这个例子中的变量text有28个字符，其中6个字符长的转义序列表示1个字符。任何字符串的长度都可以通过访问其length属性取得，例如：
```
alert(text.length); // 输出28
```

这个属性返回的字符数包括16位字符的数目。如果字符串中包含双字节字符，那么length属性可能不会精确地返回字符串中的字符数目。

2. 字符串的特点

ECMAScript中的字符串是不可变的，也就是说，字符串一旦创建，它们的值就不能改变。要改变某个变量保存的字符串，首先要销毁原来的字符串，然后再用另一个包含新值的字符串填充该变量，例如：
```
var lang = "Java"; lang = lang + "Script";
```

以上示例中的变量lang开始时包含字符串"Java"。而第二行代码把lang的值重新定义为"Java"与"Script"的组合，即"JavaScript"。实现这个操作的过程如下：首先创建一个能容纳10个字符的新字符串，然后在这个字符串中填充"Java"和"Script"，最后一步是销毁原来的字符串"Java"和字符串"Script"，因为这两个字符串已经没用了。这个过程是在后台发生的，而这也是在某些旧版本的浏览器（例如版本低于1.0的Firefox、IE6等）中拼接字符串时速度很慢的原因所在。但这些浏览器后来的版本已经解决了这个低效率问题。

3. 转换为字符串

要把一个值转换为一个字符串有两种方式。第一种是使用几乎每个值都有的toString()方法（第5章将讨论这个方法的特点）。这个方法唯一要做的就是返回相应值的字符串表现。来看下面的例子：
```
var age = 11;
var ageAsString = age.toString(); // 字符串"11"
var found = true;
var foundAsString = found.toString(); // 字符串"true"
```

数值、布尔值、对象和字符串值（没错，每个字符串也都有一个toString()方法，该方法返回字符串的一个副本）都有toString()方法。但null和undefined值没有这个方法。

多数情况下，调用toString()方法不必传递参数。但是，在调用数值的toString()方法时，可以传递一个参数：输出数值的基数。默认情况下，toString()方法以十进制格式返回数值的字符串表示。而通过传递基数，toString()可以输出以二进制、八进制、十六进制，乃至其他任意有效进制格式表示的字符串值。下面给出几个例子：

```
var num = 10;
alert(num.toString()); // "10"
alert(num.toString(2)); // "1010"
alert(num.toString(8)); // "12"
alert(num.toString(10));// "10"
alert(num.toString(16));// "a"
```

通过这个例子可以看出，通过指定基数，toString()方法会改变输出的值。而数值10根据基数的不同，可以在输出时被转换为不同的数值格式。注意，默认的（没有参数的）输出值与指定基数10时的输出值相同。

在不知道要转换的值是不是null或undefined的情况下，还可以使用转型函数String()，这个函数能够将任何类型的值转换为字符串。String()函数遵循下列转换规则：
- 如果值有toString()方法，则调用该方法（没有参数）并返回相应的结果；
- 如果值是null，则返回"null"；
- 如果值是undefined，则返回"undefined"。

下面再看几个例子：

```
var value1 = 10;
var value2 = true;
var value3 = null;
var value4;
alert(String(value1));// "10"
alert(String(value2));// "true"
alert(String(value3));// "null"
alert(String(value4));// "undefined"
```

这里先后转换了4个值：数值、布尔值、null和undefined。数值和布尔值的转换结果与调用toString()方法得到的结果相同。因为null和undefined没有toString()方法，所以String()函数就返回了这两个值的字面量。

要把某个值转换为字符串，可以使用加号操作符（3.5节讨论）把它与一个字符串（""）加在一起。

**3.4.7 Object类型**

ECMAScript中的对象其实就是一组数据和功能的集合。对象可以通过执行new操作符后跟要创建的对象类型的名称来创建。而创建Object类型的实例并为其添加属性和（或）方法，就可以创建自定义对象，如下所示：

```
var o = new Object();
```

这个语法与Java中创建对象的语法相似；但在ECMAScript中，如果不给构造函数传递参数，则可以省略后面的那一对圆括号。也就是说，在像前面这个示例一样不传递参数的情况下，完全可以省略那对圆括号（但这不是推荐的做法）：
```
var o = new Object; // 有效，但不推荐省略圆括号
```

仅仅创建Object的实例并没有什么用处，但关键是要理解一个重要的思想：即在ECMAScript中，（就像Java中的java.lang.Object对象一样）Object类型是所有它的实例的基础。换句话说，Object类型所具有的任何属性和方法也同样存在于更具体的对象中。

Object的每个实例都具有下列属性和方法。
- constructor：保存着用于创建当前对象的函数。对于前面的例子而言，构造函数（constructor）就是Object()。
- hasOwnProperty(propertyName)：用于检查给定的属性在当前对象实例中（而不是在实例的原型中）是否存在。其中，作为参数的属性名（propertyName）必须以字符串形式指定（例如：o.hasOwnProperty("name")）。
- isPrototypeOf(object)：用于检查传入的对象是否是传入对象的原型（第5章将讨论原型）。
- propertyIsEnumerable(propertyName)：用于检查给定的属性是否能够使用for-in语句（本章后面将会讨论）来枚举。与hasOwnProperty()方法一样，作为参数的属性名必须以字符串形式指定。
- toLocaleString()：返回对象的字符串表示，该字符串与执行环境的地区对应。
- toString()：返回对象的字符串表示。
- valueOf()：返回对象的字符串、数值或布尔值表示。通常与toString()方法的返回值相同。

由于在ECMAScript中Object是所有对象的基础，因此所有对象都具有这些基本的属性和方法。第5章和第6章将详细介绍Object与其他对象的关系。

从技术角度讲，ECMA-262中对象的行为不一定适用于JavaScript中的其他对象。浏览器环境中的对象，比如BOM和DOM中的对象，都属于宿主对象，因为它们是由宿主实现提供和定义的。ECMA-262不负责定义宿主对象，因此宿主对象可能会也可能不会继承Object。

**3.5 操作符**

ECMA-262描述了一组用于操作数据值的操作符，包括算术操作符（如加号和减号）、位操作符、关系操作符和相等操作符。ECMAScript操作符的与众不同之处在于，它们能够适用于很多值，例如字符串、数字值、  布尔值，甚至对象。不过，在应用于对象时，相应的操作符通常都会调用对象的valueOf()和（或）toString()方法，以便取得可以操作的值。

**3.5.1 一元操作符**

只能操作一个值的操作符叫做一元操作符。一元操作符是ECMAScript中最简单的操作符。

1. 递增和递减操作符

递增和递减操作符直接借鉴自C，而且各有两个版本：前置型和后置型。顾名思义，前置型应该位于要操作的变量之前，而后置型则应该位于要操作的变量之后。因此，在使用前置递增操作符给一个数值加1时，要把两个加号（++）放在这个数值变量前面，如下所示：

```
var age = 29;
++age;
```

在这个例子中，前置递增操作符把age的值变成了30（为29加上了1）。实际上，执行这个前置递增操作与执行以下操作的效果相同：

```
var age = 29;
age = age + 1;
```

执行前置递减操作的方法也类似，结果会从一个数值中减去1。使用前置递减操作符时，要把两个减号（--）放在相应变量的前面，如下所示：

```
var age = 29;
--age;
```

这样，age变量的值就减少为28（从29中减去了1）。执行前置递增和递减操作时，变量的值都是在语句被求值以前改变的。（在计算机科学领域，这种情况通常被称作副效应。）请看下面这个例子。
```
var age = 29;
var anotherAge = --age + 2;
alert(age);// 输出28 
alert(anotherAge); // 输出30
```

这个例子中变量anotherAge的初始值等于变量age的值前置递减之后加2。由于先执行了减法操作，age的值变成了28，所以再加上2的结果就是30。由于前置递增和递减操作与执行语句的优先级相等，因此整个语句会从左至右被求值。再看一个例子：
```
var num1 = 2;
var num2 = 20;
var num3 = --num1 + num2;// 等于21
var num4 = num1 + num2;// 等于21 
```

在这里，num3之所以等于21是因为num1先减去了1才与num2相加。而变量num4也等于21是因为相应的加法操作使用了num1减去1之后的值。

后置型递增和递减操作符的语法不变（仍然分别是++和--），只不过要放在变量的后面而不是前面。后置递增和递减与前置递增和递减有一个非常重要的区别，即递增和递减操作是在包含它们的语句被求值之后才执行的。这个区别在某些情况下不是什么问题，例如：

```
var age = 29;
age++;
```

把递增操作符放在变量后面并不会改变语句的结果，因为递增是这条语句的唯一操作。但是，当语句中还包含其他操作时，上述区别就会非常明显了。请看下面的例子：

```
var num1 = 2;
var num2 = 20;
var num3 = num1-- + num2;// 等于22
var num4 = num1 + num2;// 等于21
```

这里仅仅将前置递减改成了后置递减，就立即可以看到差别。在前面使用前置递减的例子中，num3和num4最后都等于21。而在这个例子中，num3等于22，num4等于21。差别的根源在于，这里在计算num3时使用了num1的原始值（2）完成了加法计算，而num4则使用了递减后的值（1）。

所有这4个操作符对任何值都适用，也就是它们不仅适用于整数，还可以用于字符串、布尔值、浮点数值和对象。在应用于不同的值时，递增和递减操作符遵循下列规则。
- 在应用于一个包含有效数字字符的字符串时，先将其转换为数字值，再执行加减1的操作。字符串变量变成数值变量。
- 在应用于一个不包含有效数字字符的字符串时，将变量的值设置为NaN（第4章将详细讨论）。字符串变量变成数值变量。
- 在应用于布尔值false时，先将其转换为0再执行加减1的操作。布尔值变量变成数值变量。
- 在应用于布尔值true时，先将其转换为1再执行加减1的操作。布尔值变量变成数值变量。
- 在应用于浮点数值时，执行加减1的操作。
- 在应用于对象时，先调用对象的valueOf()方法（第5章将详细讨论）以取得一个可供操作的值。然后对该值应用前述规则。如果结果是NaN，则在调用toString()方法后再应用前述规则。对象变量变成数值变量。

以下示例展示了上面的一些规则：

```
var s1 = "2";
var s2 = "z";
var b = false;
var f = 1.1;
var o = {
    valueOf: function() {
        return -1;
    }
};
s1++;// 值变成数值3
s2++;// 值变成NaN
b++;// 值变成数值1
f--;// 值变成0.10000000000000009（由于浮点舍入错误所致
o--;// 值变成数值-2
```

2. 一元加和减操作符

绝大多数开发人员对一元加和减操作符都不会陌生，而且这两个ECMAScript操作符的作用与数学书上讲的完全一样。一元加操作符以一个加号（+）表示，放在数值前面，对数值不会产生任何影响，如下面的例子所示：
```
var num = 25;
num = +num;     // 仍然是25 
```
不过，在对非数值应用一元加操作符时，该操作符会像Number()转型函数一样对这个值执行转换。换句话说，布尔值false和true将被转换为0和1，字符串值会被按照一组特殊的规则进行解析，而对象是先调用它们的valueOf()和（或）toString()方法，再转换得到的值。

下面的例子展示了对不同数据类型应用一元加操作符的结果：
```
var s1 = "01";
var s2 = "1.1";
var s3 = "z";
var b = false;
var f = 1.1;
var o = {
    valueOf: function() {
        return -1;
    }
};

s1 = +s1; // 值变成数值1
s2 = +s2; // 值变成数值1.1
s3 = +s3; // 值变成NaN
b = +b; // 值变成数值0
f = +f; // 值未变，仍然是1.1
o = +o; // 值变成数值-1 
```

一元减操作符主要用于表示负数，例如将1转换成-1。下面的例子演示了这个简单的转换过程：
```
var num = 25;
num = -num; // 变成了-25
```

在将一元减操作符应用于数值时，该值会变成负数（如上面的例子所示）。而当应用于非数值时，一元减操作符遵循与一元加操作符相同的规则，最后再将得到的数值转换为负数，如下面的例子所示：
```
var s1 = "01";
var s2 = "1.1";
var s3 = "z";
var b = false;
var f = 1.1;
var o = {
    valueOf: function() {
        return -1;
    }
};
s1 = -s1; // 值变成了数值-1
s2 = -s2; // 值变成了数值-1.1
s3 = -s3; // 值变成了NaN
b = -b;   // 值变成了数值0
f = -f;   // 变成了-1.1
o = -o;   // 值变成了数值1
```

一元加和减操作符主要用于基本的算术运算，也可以像前面示例所展示的一样用于转换数据类型。

**3.5.2 位操作符**

位操作符用于在最基本的层次上，即按内存中表示数值的位来操作数值。ECMAScript中的所有数值都以IEEE-754 64位格式存储，但位操作符并不直接操作64位的值。而是先将64位的值转换成32位的整数，然后执行操作，最后再将结果转换回64位。对于开发人员来说，由于64位存储格式是透明的，因此整个过程就像是只存在32位的整数一样。

对于有符号的整数，32位中的前31位用于表示整数的值。第32位用于表示数值的符号：0表示正数，1表示负数。这个表示符号的位叫做符号位，符号位的值决定了其他位数值的格式。其中，正数以纯二进制格式存储，31位中的每一位都表示2的幂。第一位（叫做位0）表示20，第二位表示21，以此类推。没有用到的位以0填充，即忽略不计。例如，数值18的二进制表示是00000000000000000000000000010010，或者更简洁的10010。这是5个有效位，这5位本身就决定了实际的值（如图3-1所示）。


负数同样以二进制码存储，但使用的格式是二进制补码。计算一个数值的二进制补码，需要经过下列3个步骤：

(1) 求这个数值绝对值的二进制码（例如，要求-18的二进制补码，先求18的二进制码）；
(2) 求二进制反码，即将0替换为1，将1替换为0；
(3) 得到的二进制反码加1。

要根据这3个步骤求得-18的二进制码，首先就要求得18的二进制码，即：

```
0000 0000 0000 0000 0000 0000 0001 0010
```

然后，求其二进制反码，即0和1互换：

```
1111 1111 1111 1111 1111 1111 1110 1101
```

最后，二进制反码加1：

```
1111 1111 1111 1111 1111 1111 1110 1101
                                      1
--------------------------------------- 
1111 1111 1111 1111 1111 1111 1110 1110 
```

这样，就求得了-18的二进制表示，即11111111111111111111111111101110。要注意的是，在处理有符号整数时，是不能访问位31的。ECMAScript会尽力向我们隐藏所有这些信息。换句话说，在以二进制字符串形式输出一个负数时，我们看到的只是这个负数绝对值的二进制码前面加上了一个负号。如下面的例子所示：
```
var num = -18;
alert(num.toString(2));// "-10010"
```

要把数值-18转换成二进制字符串时，得到的结果是"-10010"。这说明转换过程理解了二进制补码并将其以更合乎逻辑的形式展示了出来。

默认情况下，ECMAScript中的所有整数都是有符号整数。不过，当然也存在无符号整数。对于无符号整数来说，第32位不再表示符号，因为无符号整数只能是正数。而且，无符号整数的值可以更大，因为多出的一位不再表示符号，可以用来表示数值。

在ECMAScript中，当对数值应用位操作符时，后台会发生如下转换过程：64位的数值被转换成32位数值，然后执行位操作，最后再将32位的结果转换回64位数值。这样，表面上看起来就好像是在操作32位数值，就跟在其他语言中以类似方式执行二进制操作一样。但这个转换过程也导致了一个严重的副效应，即在对特殊的NaN和Infinity值应用位操作时，这两个值都会被当成0来处理。

如果对非数值应用位操作符，会先使用Number()函数将该值转换为一个数值（自动完成），然后再应用位操作。得到的结果将是一个数值。

1. 按位非（NOT）

按位非操作符由一个波浪线（~）表示，执行按位非的结果就是返回数值的反码。按位非是ECMAScript操作符中少数几个与二进制计算有关的操作符之一。下面看一个例子：

```
var num1 = 25; // 二进制00000000000000000000000000011001
var num2 = ~num1; // 二进制11111111111111111111111111100110
alert(num2);   // -26
```

这里，对25执行按位非操作，结果得到了-26。这也验证了按位非操作的本质：操作数的负值减1。因此，下面的代码也能得到相同的结果：
```
var num1 = 25;
var num2 = -num1 - 1;
alert(num2); // "-26" 
```

虽然以上代码也能返回同样的结果，但由于按位非是在数值表示的最底层执行操作，因此速度更快。

2. 按位与（AND）

按位与操作符由一个和号字符（&）表示，它有两个操作符数。从本质上讲，按位与操作就是将两个数值的每一位对齐，然后根据下表中的规则，对相同位置上的两个数执行AND操作：

|第一个数值的位|第二个数值的位|结果|
|:--|:--|:--|
|1  |1  |1  |
|1  |0  |0  |
|0  |1  |0  |
|0  |0  |0  |

简而言之，按位与操作只在两个数值的对应位都是1时才返回1，任何一位是0，结果都是0。下面看一个对25和3执行按位与操作的例子：

```
var result = 25 & 3;
alert(result); // 1
```

可见，对25和3执行按位与操作的结果是1。为什么呢？请看其底层操作：

```
25  = 0000 0000 0000 0000 0000 0000 0001 1001
3   = 0000 0000 0000 0000 0000 0000 0000 0011
---------------------------------------------
AND = 0000 0000 0000 0000 0000 0000 0000 0001
```

原来，25和3的二进制码对应位上只有一位同时是1，而其他位的结果自然都是0，因此最终结果等于1。


3. 按位或（OR）

按位或操作符由一个竖线符号（|）表示，同样也有两个操作数。按位或操作遵循下面这个真值表。

|第一个数值的位|第二个数值的位|结果|
|:--|:--|:--|
|1|1|1|
|1|0|1|
|0|1|1|
|0|0|0|

由此可见，按位或操作在有一个位是1的情况下就返回1，而只有在两个位都是0的情况下才返回0。如果在前面按位与的例子中对25和3执行按位或操作，则代码如下所示：
```
var result = 25 | 3;
alert(result); //27
```

25与3按位或的结果是27：

```
25 = 0000 0000 0000 0000 0000 0000 0001 1001
3  = 0000 0000 0000 0000 0000 0000 0000 0011 --------------------------------------------
OR = 0000 0000 0000 0000 0000 0000 0001 1011
```

这两个数值的都包含4个1，因此可以把每个1直接放到结果中。二进制码11011等于十进制值27。

4.按位异或（XOR）

按位异或操作符由一个插入符号（^）表示，也有两个操作数。以下是按位异或的真值表。

|第一个数值的位|第二个数值的位|结果|
|:--|:--|:--|
|1|1|0|
|1|0|1|
|0|1|1|
|0|0|0|

按位异或与按位或的不同之处在于，这个操作在两个数值对应位上只有一个1时才返回1，如果对应的两位都是1或都是0，则返回0。对25和3执行按位异或操作的代码如下所示：

```
var result = 25 ^ 3;
alert(result); //26
```

25与3按位异或的结果是26，其底层操作如下所示：

```
25  = 0000 0000 0000 0000 0000 0000 0001 1001
3   = 0000 0000 0000 0000 0000 0000 0000 0011    ---------------------------------------------
XOR = 0000 0000 0000 0000 0000 0000 0001 1010
```

这两个数值都包含4个1，但第一位上则都是1，因此结果的第一位变成了0。而其他位上的1在另一个数值中都没有对应的1，可以直接放到结果中。二进制码11010等于十进制值26（注意这个结果比执行按位或时小1）。

5. 左移

左移操作符由两个小于号（<<）表示，这个操作符会将数值的所有位向左移动指定的位数。例如，如果将数值2（二进制码为10）向左移动5位，结果就是64（二进制码为1000000），代码如下所示：

```
var oldValue = 2;// 等于二进制的10
var newValue = oldValue << 5; // 等于二进制的1000000，十进制的64
```

注意，在向左移位后，原数值的右侧多出了5个空位。左移操作会以0来填充这些空位，以便得到的结果是一个完整的32位二进制数（见图3-2）。

注意，左移不会影响操作数的符号位。换句话说，如果将-2向左移动5位，结果将是-64，而非64。

6. 有符号的右移

有符号的右移操作符由两个大于号（>>）表示，这个操作符会将数值向右移动，但保留符号位（即正负号标记）。有符号的右移操作与左移操作恰好相反，即如果将64向右移动5位，结果将变回2：

```
var oldValue = 64;// 等于二进制的1000000
var newValue = oldValue >> 5; // 等于二进制的10 ，即十进制的2
```

同样，在移位过程中，原数值中也会出现空位。只不过这次的空位出现在原数值的左侧、符号位的右侧（见图3-3）。而此时ECMAScript会用符号位的值来填充所有空位，以便得到一个完整的值。

7. 无符号右移

无符号右移操作符由3个大于号（>>>）表示，这个操作符会将数值的所有32位都向右移动。对正数来说，无符号右移的结果与有符号右移相同。仍以前面有符号右移的代码为例，如果将64无符号右移5位，结果仍然还是2：

```
var oldValue = 64;// 等于二进制的1000000
var newValue = oldValue >>> 5; // 等于二进制的10 ，即十进制的2
```

但是对负数来说，情况就不一样了。首先，无符号右移是以0来填充空位，而不是像有符号右移那样以符号位的值来填充空位。所以，对正数的无符号右移与有符号右移结果相同，但对负数的结果就不一样了。其次，无符号右移操作符会把负数的二进制码当成正数的二进制码。而且，由于负数以其绝对值的二进制补码形式表示，因此就会导致无符号右移后的结果非常之大，如下面的例子所示：

```
var oldValue = -64;// 等于二进制的11111111111111111111111111000000
var newValue = oldValue >>> 5;// 等于十进制的134217726
```

这里，当对-64执行无符号右移5位的操作后，得到的结果是134217726。之所以结果如此之大，是因为-64的二进制码为11111111111111111111111111000000，而且无符号右移操作会把这个二进制码当成正数的二进制码，换算成十进制就是4294967232。如果把这个值右移5位，结果就变成了00000111111111111111111111111110，即十进制的134217726。

**3.5.3 布尔操作符**

在一门编程语言中，布尔操作符的重要性堪比相等操作符。如果没有测试两个值关系的能力，那么诸如if...else和循环之类的语句就不会有用武之地了。布尔操作符一共有3个：非（NOT）、与（AND）和或（OR）。

1. 逻辑非

逻辑非操作符由一个叹号`!`表示，可以应用于ECMAScript中的任何值。无论这个值是什么数据类型，这个操作符都会返回一个布尔值。逻辑非操作符首先会将它的操作数转换为一个布尔值，然后再对其求反。也就是说，逻辑非操作符遵循下列规则：
- 如果操作数是一个对象，返回false；
- 如果操作数是一个空字符串，返回true；
- 如果操作数是一个非空字符串，返回false；
- 如果操作数是数值0，返回true；
- 如果操作数是任意非0数值（包括Infinity），返回false；
- 如果操作数是null，返回true；
- 如果操作数是NaN，返回true；
- 如果操作数是undefined，返回true。

下面几个例子展示了应用上述规则的结果：
```
alert(!false); // true
alert(!"blue");// false
alert(!0); // true
alert(!NaN); // true
alert(!"");  // true
alert(!12345); // false
```

逻辑非操作符也可以用于将一个值转换为与其对应的布尔值。而同时使用两个逻辑非操作符，实际上就会模拟Boolean()转型函数的行为。其中，第一个逻辑非操作会基于无论什么操作数返回一个布尔值，而第二个逻辑非操作则对该布尔值求反，于是就得到了这个值真正对应的布尔值。当然，最终结果与对这个值使用Boolean()函数相同，如下面的例子所示：

```
alert(!!"blue"); //true
alert(!!0);      //false
alert(!!NaN);    //false
alert(!!"");     //false
alert(!!12345);  //true
```

2. 逻辑与

逻辑与操作符由两个和号（&&）表示，有两个操作数，如下面的例子所示：
```
var result = true && false;
```

逻辑与的真值表如下：

|第一个数值的位|第二个数值的位|结果|
|:--|:--|:--|
|true|true|true|
|true|false|false|
|false|true|false|
|false|false|false|

逻辑与操作可以应用于任何类型的操作数，而不仅仅是布尔值。在有一个操作数不是布尔值的情况下，逻辑与操作就不一定返回布尔值；此时，它遵循下列规则：
- 如果第一个操作数是对象，则返回第二个操作数；
- 如果第二个操作数是对象，则只有在第一个操作数的求值结果为true的情况下才会返回该对象；
- 如果两个操作数都是对象，则返回第二个操作数；
- 如果有一个操作数是null，则返回null；
- 如果有一个操作数是NaN，则返回NaN；
- 如果有一个操作数是undefined，则返回undefined。

逻辑与操作属于短路操作，即如果第一个操作数能够决定结果，那么就不会再对第二个操作数求值。对于逻辑与操作而言，如果第一个操作数是false，则无论第二个操作数是什么值，结果都不再可能是true了。来看下面的例子：

```
var found = true;
var result = (found && someUndefinedVariable); // 这里会发生错误
alert(result); // 这一行不会执行
```

在上面的代码中，当执行逻辑与操作时会发生错误，因为变量someUndefinedVariable没有声明。由于变量found的值是true，所以逻辑与操作符会继续对变量someUndefinedVariable求值。但someUndefinedVariable尚未定义，因此就会导致错误。这说明不能在逻辑与操作中使用未定义的值。如果像下面这个例中一样，将found的值设置为false，就不会发生错误了：

```
var found = false;
var result = (found && someUndefinedVariable); // 不会发生错误
alert(result); // 会执行（"false"）
```

在这个例子中，警告框会显示出来。无论变量someUndefinedVariable有没有定义，也永远不会对它求值，因为第一个操作数的值是false。而这也就意味着逻辑与操作的结果必定是false，根本用不着再对`&&`右侧的操作数求值了。在使用逻辑与操作符时要始终铭记它是一个短路操作符。

3. 逻辑或

逻辑或操作符由两个竖线符号`||`表示，有两个操作数，如下面的例子所示：
```
var result = true || false;
```

逻辑或的真值表如下：

|第一个数值的位|第二个数值的位|结果|
|:--|:--|:--|
|true|true|true|
|true|false|true|
|false|true|true|
|false|false|false|

与逻辑与操作相似，如果有一个操作数不是布尔值，逻辑或也不一定返回布尔值；此时，它遵循下列规则：
- 如果第一个操作数是对象，则返回第一个操作数；
- 如果第一个操作数的求值结果为false，则返回第二个操作数；
- 如果两个操作数都是对象，则返回第一个操作数；
- 如果两个操作数都是null，则返回null；
- 如果两个操作数都是NaN，则返回NaN；
- 如果两个操作数都是undefined，则返回undefined。
 
与逻辑与操作符相似，逻辑或操作符也是短路操作符。也就是说，如果第一个操作数的求值结果为true，就不会对第二个操作数求值了。下面看一个例子：

```
var found = true;
var result = (found || someUndefinedVariable);// 不会发生错误
alert(result); // 会执行（"true"）
```

这个例子跟前面的例子一样，变量someUndefinedVariable也没有定义。但是，由于变量found的值是true，而变量someUndefinedVariable永远不会被求值，因此结果就会输出"true"。如果像下面这个例子一样，把found的值改为false，就会导致错误：

```
var found = false;
var result = (found || someUndefinedVariable);// 这里会发生错误
alert(result); // 这一行不会执行
```

我们可以利用逻辑或的这一行为来避免为变量赋null或undefined值。例如：
```
var myObject = preferredObject || backupObject;
```

在这个例子中，变量myObject将被赋予等号后面两个值中的一个。变量preferredObject中包含优先赋给变量myObject的值，变量backupObject负责在preferredObject中不包含有效值的情况下提供后备值。如果preferredObject的值不是null，那么它的值将被赋给myObject；如果是null，则将backupObject的值赋给myObject。ECMAScript程序的赋值语句经常会使用这种模式，本书也将采用这种模式。

**3.5.4 乘性操作符**

ECMAScript定义了3个乘性操作符：乘法、除法和求模。这些操作符与Java、C或者Perl中的相应操作符用途类似，只不过在操作数为非数值的情况下会执行自动的类型转换。如果参与乘性计算的某个操作数不是数值，后台会先使用Number()转型函数将其转换为数值。也就是说，空字符串将被当作0，布尔值true将被当作1。

1. 乘法

乘法操作符由一个星号（*）表示，用于计算两个数值的乘积。其语法类似于C，如下面的例子所示：

```
var result = 34 * 56;
```

在处理特殊值的情况下，乘法操作符遵循下列特殊的规则：

- 如果操作数都是数值，执行常规的乘法计算，即两个正数或两个负数相乘的结果还是正数，而如果只有一个操作数有符号，那么结果就是负数。如果乘积超过了ECMAScript数值的表示范围，则返回Infinity或-Infinity；
- 如果有一个操作数是NaN，则结果是NaN；
- 如果是Infinity与0相乘，则结果是NaN；
- 如果是Infinity与非0数值相乘，则结果是Infinity或-Infinity，取决于有符号操作数的符号；
- 如果是Infinity与Infinity相乘，则结果是Infinity；
- 如果有一个操作数不是数值，则在后台调用Number()将其转换为数值，然后再应用上面的规则。
 
2. 除法
 
除法操作符由一个斜线符号`/`表示，执行第二个操作数除第一个操作数的计算，如下面的例子所示：

```
var result = 66 / 11;
```

与乘法操作符类似，除法操作符对特殊的值也有特殊的处理规则。这些规则如下：
- 如果操作数都是数值，执行常规的除法计算，即两个正数或两个负数相除的结果还是正数，而如果只有一个操作数有符号，那么结果就是负数。如果商超过了ECMAScript数值的表示范围，则返回Infinity或-Infinity；
- 如果有一个操作数是NaN，则结果是NaN；
- 如果是Infinity被Infinity除，则结果是NaN；
- 如果是零被零除，则结果是NaN；
- 如果是非零的有限数被零除，则结果是Infinity或-Infinity，取决于有符号操作数的符号；
- 如果是Infinity被任何非零数值除，则结果是Infinity或-Infinity，取决于有符号操作数的符号；
- 如果有一个操作数不是数值，则在后台调用Number()将其转换为数值，然后再应用上面的规则。
 
3. 求模
 
求模（余数）操作符由一个百分号`%`表示，用法如下：

```
var result = 26 % 5; // 等于1
```

与另外两个乘性操作符类似，求模操作符会遵循下列特殊规则来处理特殊的值：
- 如果操作数都是数值，执行常规的除法计算，返回除得的余数；
- 如果被除数是无穷大值而除数是有限大的数值，则结果是NaN；
- 如果被除数是有限大的数值而除数是零，则结果是NaN；
- 如果是Infinity被Infinity除，则结果是NaN；
- 如果被除数是有限大的数值而除数是无穷大的数值，则结果是被除数；
- 如果被除数是零，则结果是零；
- 如果有一个操作数不是数值，则在后台调用Number()将其转换为数值，然后再应用上面的规则。

**3.5.5 加性操作符**



**3.5.6 关系操作符**
**3.5.7 相等操作符**
**3.5.8 条件操作符**
**3.5.9 赋值操作符**
**3.5.10 逗号操作符**

使用逗号操作符可以在一条语句中执行多个操作，如下面的例子所示：

```
var num1=1, num2=2, num3=3;
```

逗号操作符多用于声明多个变量；但除此之外，逗号操作符还可以用于赋值。在用于赋值时，逗号操作符总会返回表达式中的最后一项，如下面的例子所示：
```
var num = (5, 1, 4, 8, 0); // num的值为0
```

由于0是表达式中的最后一项，因此num的值就是0。虽然逗号的这种使用方式并不常见，但这个例子可以帮我们理解逗号的这种行为。

**3.6 语句**

ECMA-262规定了一组语句（也称为流控制语句）。从本质上看，语句定义了ECMAScript中的主要语法，语句通常使用一或多个关键字来完成给定任务。语句可以很简单，例如通知函数退出；也可以比较复杂，例如指定重复执行某个命令的次数。

**3.6.1 if语句**
**3.6.2 do-while语句**
**3.6.3 while语句**
**3.6.4 for语句**
**3.6.5 for-in语句**
**3.6.6 label语句**
**3.6.7 break和continue 语句**
**3.6.8 with语句**
**3.6.9 switch语句**

**3.7 函数**

函数对任何语言来说都是一个核心的概念。通过函数可以封装任意多条语句，而且可以在任何地方、任何时候调用执行。ECMAScript中的函数使用function关键字来声明，后跟一组参数以及函数体。函数的基本语法如下所示：

```
function functionName(arg0, arg1,...,argN) {
    statements
}
```

以下是一个函数示例：
```
function sayHi(name, message) {
    alert("Hello " + name + "," + message);
}
```

这个函数可以通过其函数名来调用，后面还要加上一对圆括号和参数（圆括号中的参数如果有多个，可以用逗号隔开）。调用sayHi()函数的代码如下所示：
```
sayHi("Nicholas", "how are you today?");
```

这个函数的输出结果是"Hello Nicholas,how are you today?"。函数中定义中的命名参数name和message被用作了字符串拼接的两个操作数，而结果最终通过警告框显示了出来。

ECMAScript中的函数在定义时不必指定是否返回值。实际上，任何函数在任何时候都可以通过return语句后跟要返回的值来实现返回值。请看下面的例子：

```
function sum(num1, num2) {
    return num1 + num2;
}
```

这个sum()函数的作用是把两个值加起来返回一个结果。我们注意到，除了return语句之外，没有任何声明表示该函数会返回一个值。调用这个函数的示例代码如下：

```
var result = sum(5, 10);
```

这个函数会在执行完return语句之后停止并立即退出。因此，位于return语句之后的任何代码都永远不会执行。例如：

```
function sum(num1, num2) {
    return num1 + num2;
    alert("Hello world");// 永远不会执行
}
```

在这个例子中，由于调用alert()函数的语句位于return语句之后，因此永远不会显示警告框。当然，一个函数中也可以包含多个return语句，如下面这个例子中所示：

```
function diff(num1, num2) {
    if (num1 < num2) {
        return num2 - num1;
    } else {
        return num1 - num2;
    }
}
```

这个例子中定义的diff()函数用于计算两个数值的差。如果第一个数比第二个小，则用第二个数减第一个数；否则，用第一个数减第二个数。代码中的两个分支都具有自己的return语句，分别用于执行正确的计算。另外，return语句也可以不带有任何返回值。在这种情况下，函数在停止执行后将返回undefined值。这种用法一般用在需要提前停止函数执行而又不需要返回值的情况下。比如在下面这个例子中，就不会显示警告框：
```
function sayHi(name, message) {
    return;
    alert("Hello " + name + "," + message);//永远不会调用
}
```

推荐的做法是要么让函数始终都返回一个值，要么永远都不要返回值。否则，如果函数有时候返回值，有时候有不返回值，会给调试代码带来不便。

严格模式对函数有一些限制：
- 不能把函数命名为eval或arguments；
- 不能把参数命名为eval或arguments；
- 不能出现两个命名参数同名的情况。
 
如果发生以上情况，就会导致语法错误，代码无法执行。

**3.7.1 理解参数**

ECMAScript函数的参数与大多数其他语言中函数的参数有所不同。ECMAScript函数不介意传递进来多少个参数，也不在乎传进来参数是什么数据类型。也就是说，即便你定义的函数只接收两个参数，在调用这个函数时也未必一定要传递两个参数。可以传递一个、三个甚至不传递参数，而解析器永远不会有什么怨言。之所以会这样，原因是ECMAScript中的参数在内部是用一个数组来表示的。函数接收到的始终都是这个数组，而不关心数组中包含哪些参数（如果有参数的话）。如果这个数组中不包含任何元素，无所谓；如果包含多个元素，也没有问题。实际上，在函数体内可以通过arguments对象来访问这个参数数组，从而获取传递给函数的每一个参数。

其实，arguments对象只是与数组类似（它并不是Array的实例），因为可以使用方括号语法访问它的每一个元素（即第一个元素是arguments[0]，第二个元素是argumetns[1]，以此类推），使用length属性来确定传递进来多少个参数。在前面的例子中，sayHi()函数的第一个参数的名字叫name，而该参数的值也可以通过访问arguments[0]来获取。因此，那个函数也可以像下面这样重写，即不显式地使用命名参数：

```
function sayHi() {
    alert("Hello " + arguments[0] + "," + arguments[1]);
}
```

这个重写后的函数中不包含命名的参数。虽然没有使用name和message标识符，但函数的功能依旧。这个事实说明了ECMAScript函数的一个重要特点：命名的参数只提供便利，但不是必需的。另外，在命名参数方面，其他语言可能需要事先创建一个函数签名，而将来的调用必须与该签名一致。但在ECMAScript中，没有这些条条框框，解析器不会验证命名参数。通过访问arguments对象的length属性可以获知有多少个参数传递给了函数。下面这个函数会在每次被调用时，输出传入其中的参数个数：

```
function howManyArgs() {
    alert(arguments.length);
}
howManyArgs("string", 45); //2
howManyArgs(); //0
howManyArgs(12); //1
```

执行以上代码会依次出现3个警告框，分别显示2、0和1。由此可见，开发人员可以利用这一点让函数能够接收任意个参数并分别实现适当的功能。请看下面的例子：

```
function doAdd() {
    if(arguments.length == 1) {
        alert(arguments[0] + 10);
    } else if (arguments.length == 2) {
        alert(arguments[0] + arguments[1]);
    }
}
doAdd(10);//20
doAdd(30, 20);//50
```

函数doAdd()会在只有一个参数的情况下给该参数加上10；如果是两个参数，则将那个参数简单相加并返回结果。因此，doAdd(10)会返回20，而doAdd(30,20)则返回50。虽然这个特性算不上完美的重载，但也足够弥补ECMAScript的这一缺憾了。

另一个与参数相关的重要方面，就是arguments对象可以与命名参数一起使用，如下面的例子所示：
```
function doAdd(num1, num2) {
    if(arguments.length == 1) {
        alert(num1 + 10);
    } else if (arguments.length == 2) {
        alert(arguments[0] + num2);
    }
}
```

在重写后的这个doAdd()函数中，两个命名参数都与arguments对象一起使用。由于num1的值与arguments[0]的值相同，因此它们可以互换使用（当然，num2和arguments[1]也是如此）。关于arguments的行为，还有一点比较有意思。那就是它的值永远与对应命名参数的值保持同步。例如：

```
function doAdd(num1, num2) {
    arguments[1] = 10;
    alert(arguments[0] + num2);
} 
```

每次执行这个doAdd()函数都会重写第二个参数，将第二个参数的值修改为10。因为arguments对象中的值会自动反映到对应的命名参数，所以修改arguments[1]，也就修改了num2，结果它们的值都会变成10。不过，这并不是说读取这两个值会访问相同的内存空间；它们的内存空间是独立的，但它们的值会同步。另外还要记住，如果只传入了一个参数，那么为arguments[1]设置的值不会反应到命名参数中。这是因为arguments对象的长度是由传入的参数个数决定的，不是由定义函数时的命名参数的个数决定的。

关于参数还要记住最后一点：没有传递值的命名参数将自动被赋予undefined值。这就跟定义了变量但又没有初始化一样。例如，如果只给doAdd()函数传递了一个参数，则num2中就会保存undefined值。

严格模式对如何使用arguments对象做出了一些限制。首先，像前面例子中那样的赋值会变得无效。也就是说，即使把arguments[1]设置为10，num2的值仍然还是undefined。其次，重写arguments的值会导致语法错误（代码将不会执行）。

ECMAScript中的所有参数传递的都是值，不可能通过引用传递参数。

**3.7.2 没有重载**

ECMAScript函数不能像传统意义上那样实现重载。而在其他语言（如Java）中，可以为一个函数编写两个定义，只要这两个定义的签名（接受的参数的类型和数量）不同即可。如前所述，ECMAScirpt函数没有签名，因为其参数是由包含零或多个值的数组来表示的。而没有函数签名，真正的重载是不可能做到的。

如果在ECMAScript中定义了两个名字相同的函数，则该名字只属于后定义的函数。请看下面的例子：

```
function addSomeNumber(num){
    return num + 100;
}
function addSomeNumber(num) {
    return num + 200;
}
var result = addSomeNumber(100); //300
```

在此，函数addSomeNumber()被定义了两次。第一个版本给参数加100，而第二个版本给参数加200。由于后定义的函数覆盖了先定义的函数，因此当在最后一行代码中调用这个函数时，返回的结果就是300。

如前所述，通过检查传入函数中参数的类型和数量并作出不同的反应，可以模仿方法的重载。

**3.8 小结**

JavaScript的核心语言特性在ECMA-262中是以名为ECMAScript的伪语言的形式来定义的。ECMAScript中包含了所有基本的语法、操作符、数据类型以及完成基本的计算任务所必需的对象，但没有对取得输入和产生输出的机制作出规定。理解ECMAScript及其纷繁复杂的各种细节，是理解其在Web浏览器中的实现——JavaScript的关键。目前大多数实现所遵循的都是ECMA-262第3版，但很多也已经着手开始实现第5版了。以下简要总结了ECMAScript中基本的要素。
- ECMAScript中的基本数据类型包括Undefined、Null、Boolean、Number和String。
- 与其他语言不同，ECMScript没有为整数和浮点数值分别定义不同的数据类型，Number类型可用于表示所有数值。
- ECMAScript中也有一种复杂的数据类型，即Object类型，该类型是这门语言中所有对象的基础类型。
- 严格模式为这门语言中容易出错的地方施加了限制。
- ECMAScript提供了很多与C及其他类C语言中相同的基本操作符，包括算术操作符、布尔操作符、关系操作符、相等操作符及赋值操作符等。
- ECMAScript从其他语言中借鉴了很多流控制语句，例如if语句、for语句和switch语句等。ECMAScript中的函数与其他语言中的函数有诸多不同之处。
- 无须指定函数的返回值，因为任何ECMAScript函数都可以在任何时候返回任何值。
- 实际上，未指定返回值的函数返回的是一个特殊的undefined值。
- ECMAScript中也没有函数签名的概念，因为其函数参数是以一个包含零或多个值的数组的形式传递的。
- 可以向ECMAScript函数传递任意数量的参数，并且可以通过arguments对象来访问这些参数。
- 由于不存在函数签名的特性，ECMAScript函数不能重载。


第4章 变量、作用域和内存问题
------------------------

本章内容
- 理解基本类型和引用类型的值
- 理解执行环境
- 理解垃圾收集

按照ECMA-262的定义，JavaScript的变量与其他语言的变量有很大区别。JavaScript变量松散类型的本质，决定了它只是在特定时间用于保存特定值的一个名字而已。由于不存在定义某个变量必须要保存何种数据类型值的规则，变量的值及其数据类型可以在脚本的生命周期内改变。尽管从某种角度看，这可能是一个既有趣又强大，同时又容易出问题的特性，但JavaScript变量实际的复杂程度还远不止如此。

**4.1 基本类型和引用类型的值**

ECMAScript变量可能包含两种不同数据类型的值：基本类型值和引用类型值。基本类型值指的是简单的数据段，而引用类型值指那些可能由多个值构成的对象。

在将一个值赋给变量时，解析器必须确定这个值是基本类型值还是引用类型值。第3章讨论了5种基本数据类型：Undefined、Null、Boolean、Number和String。这5种基本数据类型是按值访问的，因为可以操作保存在变量中的实际的值。

引用类型的值是保存在内存中的对象。与其他语言不同，JavaScript不允许直接访问内存中的位置，也就是说不能直接操作对象的内存空间。在操作对象时，实际上是在操作对象的引用而不是实际的对象。为此，引用类型的值是按引用访问的（这种说法不严密，当复制保存着对象的某个变量时，操作的是对象的引用。但在为对象添加属性时，操作的是实际的对象。——图灵社区“壮壮的前端之路”）。

在很多语言中，字符串以对象的形式来表示，因此被认为是引用类型的。ECMAScript放弃了这一传统。

**4.1.1 动态的属性**

定义基本类型值和引用类型值的方式是类似的：创建一个变量并为该变量赋值。但是，当这个值保存到变量中以后，对不同类型值可以执行的操作则大相径庭。对于引用类型的值，我们可以为其添加属性和方法，也可以改变和删除其属性和方法。请看下面的例子：

```javascript
var person = new Object();
person.name = "Nicholas";
alert(person.name); //"Nicholas"
```

以上代码创建了一个对象并将其保存在了变量person中。然后，我们为该对象添加了一个名为name的属性，并将字符串值"Nicholas"赋给了这个属性。紧接着，又通过alert()函数访问了这个新属性。如果对象不被销毁或者这个属性不被删除，则这个属性将一直存在。但是，我们不能给基本类型的值添加属性，尽管这样做不会导致任何错误。比如：

```javascript
var name = "Nicholas";
name.age = 27;
alert(name.age); //undefined
```

在这个例子中，我们为字符串name定义了一个名为age的属性，并为该属性赋值27。但在下一行访问这个属性时，发现该属性不见了。这说明只能给引用类型值动态地添加属性，以便将来使用。

**4.1.2 复制变量值**

除了保存的方式不同之外，在从一个变量向另一个变量复制基本类型值和引用类型值时，也存在不同。如果从一个变量向另一个变量复制基本类型的值，会在变量对象上创建一个新值，然后把该值复制到为新变量分配的位置上。来看一个例子：

```javascript
var num1 = 5;
var num2 = num1;
```

在此，num1中保存的值是5。当使用num1的值来初始化num2时，num2中也保存了值5。但num2中的5与num1中的5是完全独立的，该值只是num1中5的一个副本。此后，这两个变量可以参与任何操作而不会相互影响。图4-1形象地展示了复制基本类型值的过程。

当从一个变量向另一个变量复制引用类型的值时，同样也会将存储在变量对象中的值复制一份放到为新变量分配的空间中。不同的是，这个值的副本实际上是一个指针，而这个指针指向存储在堆中的一个对象。复制操作结束后，两个变量实际上将引用同一个对象。因此，改变其中一个变量，就会影响另一个变量，如下面的例子所示：

```javascript
var obj1 = new Object();
var obj2 = obj1;
obj1.name = "Nicholas";
alert(obj2.name);  //"Nicholas" 
```

首先，变量obj1保存了一个对象的新实例。然后，这个值被复制到了obj2中；换句话说，obj1和obj2都指向同一个对象。这样，当为obj1添加name属性后，可以通过obj2来访问这个属性，因为这两个变量引用的都是同一个对象。图4-2展示了保存在变量对象中的变量和保存在堆中的对象之间的这种关系。

**4.1.3 传递参数**

ECMAScript中所有函数的参数都是按值传递的。也就是说，把函数外部的值复制给函数内部的参数，就和把值从一个变量复制到另一个变量一样。基本类型值的传递如同基本类型变量的复制一样，而引用类型值的传递，则如同引用类型变量的复制一样。有不少开发人员在这一点上可能会感到困惑，因为访问变量有按值和按引用两种方式，而参数只能按值传递。

在向参数传递基本类型的值时，被传递的值会被复制给一个局部变量（即命名参数，或者用ECMAScript的概念来说，就是arguments对象中的一个元素）。在向参数传递引用类型的值时，会把这个值在内存中的地址复制给一个局部变量，因此这个局部变量的变化会反映在函数的外部。请看下面这个例子：

```
function addTen(num) {
    num += 10;
    return num;
}

var count = 20;
var result = addTen(count);
alert(count); //20，没有变化
alert(result); //30
```

这里的函数addTen()有一个参数num，而参数实际上是函数的局部变量。在调用这个函数时，变量count作为参数被传递给函数，这个变量的值是20。于是，数值20被复制给参数num以便在addTen()中使用。在函数内部，参数num的值被加上了10，但这一变化不会影响函数外部的count变量。参数num与变量count互不相识，它们仅仅是具有相同的值。假如num是按引用传递的话，那么变量count的值也将变成30，从而反映函数内部的修改。当然，使用数值等基本类型值来说明按值传递参数比较简单，但如果使用对象，那问题就不怎么好理解了。再举一个例子：

```
function setName(obj) {
    obj.name = "Nicholas";
}
var person = new Object();
setName(person);
alert(person.name); // "Nicholas"
```

以上代码中创建一个对象，并将其保存在了变量person中。然后，这个变量被传递到setName()函数中之后就被复制给了obj。在这个函数内部，obj和person引用的是同一个对象。换句话说，即使这个变量是按值传递的，obj也会按引用来访问同一个对象。于是，当在函数内部为obj添加name属性后，函数外部的person也将有所反映；因为person指向的对象在堆内存中只有一个，而且是全局对象。有很多开发人员错误地认为：在局部作用域中修改的对象会在全局作用域中反映出来，就说明参数是按引用传递的。为了证明对象是按值传递的，我们再看一看下面这个经过修改的例子：

```javascript
function setName(obj) {
    obj.name = "Nicholas";
    obj = new Object();
    obj.name = "Greg";
}
var person = new Object();
setName(person);
alert(person.name); //"Nicholas"
```

这个例子与前一个例子的唯一区别，就是在setName()函数中添加了两行代码：一行代码为obj重新定义了一个对象，另一行代码为该对象定义了一个带有不同值的name属性。在把person传递给setName()后，其name属性被设置为"Nicholas"。然后，又将一个新对象赋给变量obj，同时将其name属性设置为"Greg"。如果person是按引用传递的，那么person就会自动被修改为指向其name属性值为"Greg"的新对象。但是，当接下来再访问person.name时，显示的值仍然是"Nicholas"。这说明即使在函数内部修改了参数的值，但原始的引用仍然保持未变。实际上，当在函数内部重写obj时，这个变量引用的就是一个局部对象了。而这个局部对象会在函数执行完毕后立即被销毁。

可以把ECMAScript函数的参数想象成局部变量。

**4.1.4 检测类型**

要检测一个变量是不是基本数据类型？第3章介绍的typeof操作符是最佳的工具。说得更具体一点，typeof操作符是确定一个变量是字符串、数值、布尔值，还是undefined的最佳工具。如果变量的值是一个对象或null，则typeof操作符会像下面例子中所示的那样返回"object"：

```
var s = "Nicholas";
var b = true;
var i = 22;
var u;
var n = null;
var o = new Object();
alert(typeof s); //string
alert(typeof i); //number
alert(typeof b); //boolean
alert(typeof u); //undefined
alert(typeof n); //object
alert(typeof o); //object
```

虽然在检测基本数据类型时typeof是非常得力的助手，但在检测引用类型的值时，这个操作符的用处不大。通常，我们并不是想知道某个值是对象，而是想知道它是什么类型的对象。为此，ECMAScript提供了instanceof操作符，其语法如下所示：
```
result = variable instanceof constructor
```
如果变量是给定引用类型（根据它的原型链来识别；第
6章将介绍原型链）的实例，那么instanceof操作符就会返回true。请看下面的例子：

```
alert(person instanceof Object); // 变量person是Object吗？
alert(colors instanceof Array);  // 变量colors是Array吗？
alert(pattern instanceof RegExp);// 变量pattern是RegExp吗？
```

根据规定，所有引用类型的值都是Object的实例。因此，在检测一个引用类型值和Object构造函数时，instanceof操作符始终会返回true。当然，如果使用instanceof操作符检测基本类型的值，则该操作符始终会返回false，因为基本类型不是对象。

使用typeof操作符检测函数时，该操作符会返回"function"。在Safari5及之前版本和Chrome7及之前版本中使用typeof检测正则表达式时，由于规范的原因，这个操作符也返回"function"。ECMA-262规定任何在内部实现[[Call]]方法的对象都应该在应用typeof操作符时返回"function"。由于上述浏览器中的正则表达式也实现了这个方法，因此对正则表达式应用typeof会返回"function"。在IE和Firefox中，对正则表达式应用typeof会返回"object"。

**4.2 执行环境及作用域**

执行环境（execution context，为简单起见，有时也称为“环境”）是JavaScript中最为重要的一个概念。执行环境定义了变量或函数有权访问的其他数据，决定了它们各自的行为。每个执行环境都有一个与之关联的变量对象（variable object），环境中定义的所有变量和函数都保存在这个对象中。虽然我们编写的代码无法访问这个对象，但解析器在处理数据时会在后台使用它。

全局执行环境是最外围的一个执行环境。根据ECMAScript实现所在的宿主环境不同，表示执行环境的对象也不一样。在Web浏览器中，全局执行环境被认为是window对象（第7章将详细讨论），因此所有全局变量和函数都是作为window对象的属性和方法创建的。某个执行环境中的所有代码执行完毕后，该环境被销毁，保存在其中的所有变量和函数定义也随之销毁（全局执行环境直到应用程序退出——例如关闭网页或浏览器——时才会被销毁）。

每个函数都有自己的执行环境。当执行流进入一个函数时，函数的环境就会被推入一个环境栈中。而在函数执行之后，栈将其环境弹出，把控制权返回给之前的执行环境。ECMAScript程序中的执行流正是由这个方便的机制控制着。

当代码在一个环境中执行时，会创建变量对象的一个作用域链（scope chain）。作用域链的用途，是保证对执行环境有权访问的所有变量和函数的有序访问。作用域链的前端，始终都是当前执行的代码所在环境的变量对象。如果这个环境是函数，则将其活动对象（activation  object）作为变量对象。活动对象在最开始时只包含一个变量，即arguments对象（这个对象在全局环境中是不存在的）。作用域链中的下一个变量对象来自包含（外部）环境，而再下一个变量对象则来自下一个包含环境。这样，一直延续到全局执行环境；全局执行环境的变量对象始终都是作用域链中的最后一个对象。

标识符解析是沿着作用域链一级一级地搜索标识符的过程。搜索过程始终从作用域链的前端开始，然后逐级地向后回溯，直至找到标识符为止（如果找不到标识符，通常会导致错误发生）。请看下面的示例代码：
```
var color = "blue";
function changeColor() {
    if (color === "blue") {
        color = "red";
    } else {
        color = "blue";
    }
}
changeColor();
alert("Color is now " + color);
```

在这个简单的例子中，函数changeColor()的作用域链包含两个对象：它自己的变量对象（其中定义着arguments对象）和全局环境的变量对象。可以在函数内部访问变量color，就是因为可以在这个作用域链中找到它。此外，在局部作用域中定义的变量可以在局部环境中与全局变量互换使用，如下面这个例子所示：

```javascript
var color = "blue";
function changeColor() {
    var anotherColor = "red";
    function swapColors() {
        var tempColor = anotherColor;
        anotherColor = color;
        color = tempColor;
        // 这里可以访问color、anotherColor和tempColor
    }
    // 这里可以访问color和anotherColor，但不能访问tempColor
    swapColors();
}
// 这里只能访问color
changeColor();
```

以上代码共涉及3个执行环境：全局环境、changeColor()的局部环境和swapColors()的局部环境。全局环境中有一个变量color和一个函数changeColor()。changeColor()的局部环境中有一个名为anotherColor的变量和一个名为swapColors()的函数，但它也可以访问全局环境中的变量color。swapColors()的局部环境中有一个变量tempColor，该变量只能在这个环境中访问到。无论全局环境还是changeColor()的局部环境都无权访问tempColor。然而，在swapColors()内部则可以访问其他两个环境中的所有变量，因为那两个环境是它的父执行环境。图4-3形象地展示了前面这个例子的作用域链。

图4-3中的矩形表示特定的执行环境。其中，内部环境可以通过作用域链访问所有的外部环境，但外部环境不能访问内部环境中的任何变量和函数。这些环境之间的联系是线性、有次序的。每个环境都可以向上搜索作用域链，以查询变量和函数名；但任何环境都不能通过向下搜索作用域链而进入另一个执行环境。对于这个例子中的swapColors()而言，其作用域链中包含3个对象：swapColors()的变量对象、changeColor()的变量对象和全局变量对象。swapColors()的局部环境开始时会先在自己的变量对象中搜索变量和函数名，如果搜索不到则再搜索上一级作用域链。changeColor()的作用域链中只包含两个对象：它自己的变量对象和全局变量对象。这也就是说，它不能访问swapColors()的环境。

函数参数也被当作变量来对待，因此其访问规则与执行环境中的其他变量相同。

**4.2.1 延长作用域链**

虽然执行环境的类型总共只有两种——全局和局部（函数），但还是有其他办法来延长作用域链。这么说是因为有些语句可以在作用域链的前端临时增加一个变量对象，该变量对象会在代码执行后被移除。在两种情况下会发生这种现象。具体来说，就是当执行流进入下列任何一个语句时，作用域链就会得到加长：
- try-catch语句的catch块；
- with语句。
 
这两个语句都会在作用域链的前端添加一个变量对象。对with语句来说，会将指定的对象添加到作用域链中。对catch语句来说，会创建一个新的变量对象，其中包含的是被抛出的错误对象的声明。下面看一个例子。

```
function buildUrl() {
    var qs = "?debug=true";
    with(location) {
        var url = href + qs;
    }
    return url;
}
```

在此，with语句接收的是location对象，因此其变量对象中就包含了location对象的所有属性和方法，而这个变量对象被添加到了作用域链的前端。buildUrl()函数中定义了一个变量qs。当在with语句中引用变量href时（实际引用的是location.href），可以在当前执行环境的变量对象中找到。当引用变量qs时，引用的则是在buildUrl()中定义的那个变量，而该变量位于函数环境的变量对象中。至于with语句内部，则定义了一个名为url的变量，因而url就成了函数执行环境的一部分，所以可以作为函数的值被返回。

在IE8及之前版本的JavaScript实现中，存在一个与标准不一致的地方，即在catch语句中捕获的错误对象会被添加到执行环境的变量对象，而不是catch语句的变量对象中。换句话说，即使是在catch块的外部也可以访问到错误对象。IE9修复了这个问题。

**4.2.2 没有块级作用域**

JavaScript没有块级作用域经常会导致理解上的困惑。在其他类C的语言中，由花括号封闭的代码块都有自己的作用域（如果用ECMAScript的话来讲，就是它们自己的执行环境），因而支持根据条件来定义变量。例如，下面的代码在JavaScript中并不会得到想象中的结果：

```
if (true) {
    var color = "blue";
}
alert(color); //"blue"
```

这里是在一个if语句中定义了变量color。如果是在C、C++或Java中，color会在if语句执行完毕后被销毁。但在JavaScript中，if语句中的变量声明会将变量添加到当前的执行环境（在这里是全局环境）中。在使用for语句时尤其要牢记这一差异，例如：

```
for (var i=0; i < 10; i++) {
    doSomething(i);
}
alert(i);//10
```

对于有块级作用域的语言来说，for语句初始化变量的表达式所定义的变量，只会存在于循环的环境之中。而对于JavaScript来说，由for语句创建的变量i即使在for循环执行结束后，也依旧会存在于循环外部的执行环境中。

1. 声明变量

使用var声明的变量会自动被添加到最接近的环境中。在函数内部，最接近的环境就是函数的局部环境；在with语句中，最接近的环境是函数环境。如果初始化变量时没有使用var声明，该变量会自动被添加到全局环境。如下所示：

```
function add(num1, num2) {
    var sum = num1 + num2;
    return sum;
}
var result = add(10, 20);// 30
alert(sum); // 由于sum不是有效的变量，因此会导致错误
```

以上代码中的函数add()定义了一个名为sum的局部变量，该变量包含加法操作的结果。虽然结果值从函数中返回了，但变量sum在函数外部是访问不到的。如果省略这个例子中的var关键字，那么当add()执行完毕后，sum也将可以访问到：
```
function add(num1, num2) {
    sum = num1 + num2;
    return sum;
}
var result = add(10, 20); //30
alert(sum);               //30
```

这个例子中的变量sum在被初始化赋值时没有使用var关键字。于是，当调用完add()之后，添加到全局环境中的变量sum将继续存在；即使函数已经执行完毕，后面的代码依旧可以访问它。

在编写JavaScript代码的过程中，不声明而直接初始化变量是一个常见的错误做法，因为这样可能会导致意外。我们建议在初始化变量之前，一定要先声明，这样就可以避免类似问题。在严格模式下，初始化未经声明的变量会导致错误。

2. 查询标识符

当在某个环境中为了读取或写入而引用一个标识符时，必须通过搜索来确定该标识符实际代表什么。搜索过程从作用域链的前端开始，向上逐级查询与给定名字匹配的标识符。如果在局部环境中找到了该标识符，搜索过程停止，变量就绪。如果在局部环境中没有找到该变量名，则继续沿作用域链向上搜索。搜索过程将一直追溯到全局环境的变量对象。如果在全局环境中也没有找到这个标识符，则意味着该变量尚未声明。通过下面这个示例，可以理解查询标识符的过程：

```
var color = "blue";
function getColor() {
    return color;
}
alert(getColor());  //"blue"
```

调用本例中的函数getColor()时会引用变量color。为了确定变量color的值，将开始一个两步的搜索过程。首先，搜索getColor()的变量对象，查找其中是否包含一个名为color的标识符。在没有找到的情况下，搜索继续到下一个变量对象（全局环境的变量对象），然后在那里找到了名为color的标识符。因为搜索到了定义这个变量的变量对象，搜索过程宣告结束。图4-4形象地展示了上述搜索过程。

在这个搜索过程中，如果存在一个局部的变量的定义，则搜索会自动停止，不再进入另一个变量对象。换句话说，如果局部环境中存在着同名标识符，就不会使用位于父环境中的标识符，如下面的例子所示：

```
var color = "blue";
function getColor() {
    var color = "red";
    return color;
}
alert(getColor());  //"red"
```

修改后的代码在getColor()函数中声明了一个名为color的局部变量。调用函数时，该变量就会被声明。而当函数中的第二行代码执行时，意味着必须找到并返回变量color的值。搜索过程首先从局部环境中开始，而且在这里发现了一个名为color的变量，其值为"red"。因为变量已经找到了，所以搜索即行停止，return语句就使用这个局部变量，并为函数会返回"red"。也就是说，任何位于局部变量color的声明之后的代码，如果不使用window.color都无法访问全局color变量。

变量查询也不是没有代价的。很明显，访问局部变量要比访问全局变量更快，因为不用向上搜索作用域链。JavaScript引擎在优化标识符查询方面做得不错，因此这个差别在将来恐怕就可以忽略不计了。


**4.3 垃圾收集**

JavaScript具有自动垃圾收集机制，也就是说，执行环境会负责管理代码执行过程中使用的内存。而在C和C++之类的语言中，开发人员的一项基本任务就是手工跟踪内存的使用情况，这是造成许多问题的一个根源。在编写JavaScript程序时，开发人员不用再关心内存使用问题，所需内存的分配以及无用内存的回收完全实现了自动管理。这种垃圾收集机制的原理其实很简单：找出那些不再继续使用的变量，然后释放其占用的内存。为此，垃圾收集器会按照固定的时间间隔（或代码执行中预定的收集时间），周期性地执行这一操作。下面我们来分析一下函数中局部变量的正常生命周期。局部变量只在函数执行的过程中存在。而在这个过程中，会为局部变量在栈（或堆）内存上分配相应的空间，以便存储它们的值。然后在函数中使用这些变量，直至函数执行结束。此时，局部变量就没有存在的必要了，因此可以释放它们的内存以供将来使用。在这种情况下，很容易判断变量是否还有存在的必要；但并非所有情况下都这么容易就能得出结论。垃圾收集器必须跟踪哪个变量有用哪个变量没用，对于不再有用的变量打上标记，以备将来收回其占用的内存。用于标识无用变量的策略可能会因实现而异，但具体到浏览器中的实现，则通常有两个策略。

**4.3.1 标记清除**

JavaScript中最常用的垃圾收集方式是标记清除（mark-and-sweep）。当变量进入环境（例如，在函数中声明一个变量）时，就将这个变量标记为“进入环境”。从逻辑上讲，永远不能释放进入环境的变量所占用的内存，因为只要执行流进入相应的环境，就可能会用到它们。而当变量离开环境时，则将其标记为“离开环境”。可以使用任何方式来标记变量。比如，可以通过翻转某个特殊的位来记录一个变量何时进入环境，或者使用一个“进入环境的”变量列表及一个“离开环境的”变量列表来跟踪哪个变量发生了变化。说到底，如何标记变量其实并不重要，关键在于采取什么策略。垃圾收集器在运行的时候会给存储在内存中的所有变量都加上标记（当然，可以使用任何标记方式）。然后，它会去掉环境中的变量以及被环境中的变量引用的变量的标记。而在此之后再被加上标记的变量将被视为准备删除的变量，原因是环境中的变量已经无法访问到这些变量了。最后，垃圾收集器完成内存清除工作，销毁那些带标记的值并回收它们所占用的内存空间。到2008年为止，IE、Firefox、Opera、Chrome和Safari的JavaScript实现使用的都是标记清除式的垃圾收集策略（或类似的策略），只不过垃圾收集的时间间隔互有不同。

**4.3.2 引用计数**

另一种不太常见的垃圾收集策略叫做引用计数（reference counting）。引用计数的含义是跟踪记录每个值被引用的次数。当声明了一个变量并将一个引用类型值赋给该变量时，则这个值的引用次数就是1。如果同一个值又被赋给另一个变量，则该值的引用次数加1。相反，如果包含对这个值引用的变量又取得了另外一个值，则这个值的引用次数减1。当这个值的引用次数变成0时，则说明没有办法再访问这个值了，因而就可以将其占用的内存空间回收回来。这样，当垃圾收集器下次再运行时，它就会释放那些引用次数为零的值所占用的内存。NetscapeNavigator3.0是最早使用引用计数策略的浏览器，但很快它就遇到了一个严重的问题：循环引用。循环引用指的是对象A中包含一个指向对象B的指针，而对象B中也包含一个指向对象A的引用。请看下面这个例子：
```
function problem() {
    var objectA = new Object();
    var objectB = new Object();
    objectA.someOtherObject = objectB;
    objectB.anotherObject = objectA;
}
```
在这个例子中，objectA和objectB通过各自的属性相互引用；也就是说，这两个对象的引用次数都是2。在采用标记清除策略的实现中，由于函数执行之后，这两个对象都离开了作用域，因此这种相互引用不是个问题。但在采用引用计数策略的实现中，当函数执行完毕后，objectA和objectB还将继续存在，因为它们的引用次数永远不会是0。假如这个函数被重复多次调用，就会导致大量内存得不到回收。为此，Netscape在Navigator4.0中放弃了引用计数方式，转而采用标记清除来实现其垃圾收集机制。可是，引用计数导致的麻烦并未就此终结。我们知道，IE中有一部分对象并不是原生JavaScript对象。例如，其BOM和DOM中的对象就是使用C++以COM（Component Object Model，组件对象模型）对象的形式实现的，而COM对象的垃圾收集机制采用的就是引用计数策略。因此，即使IE的JavaScript引擎是使用标记清除策略来实现的，但JavaScript访问的COM对象依然是基于引用计数策略的。换句话说，只要在IE中涉及COM对象，就会存在循环引用的问题。下面这个简单的例子，展示了使用COM对象导致的循环引用问题：
```
var element = document.getElementById("some_element");
var myObject = new Object();
myObject.element = element;
element.someObject = myObject;
```
这个例子在一个DOM元素（element）与一个原生JavaScript对象（myObject）之间创建了循环引用。其中，变量myObject有一个名为element的属性指向element对象；而变量element也有一个属性名叫someObject回指myObject。由于存在这个循环引用，即使将例子中的DOM从页面中移除，它也永远不会被回收。为了避免类似这样的循环引用问题，最好是在不使用它们的时候手工断开原生JavaScript对象与DOM元素之间的连接。例如，可以使用下面的代码消除前面例子创建的循环引用：

```
myObject.element = null;
element.someObject = null;
```

将变量设置为null意味着切断变量与它此前引用的值之间的连接。当垃圾收集器下次运行时，就会删除这些值并回收它们占用的内存。为了解决上述问题，IE9把BOM和DOM对象都转换成了真正的JavaScript对象。这样，就避免了两种垃圾收集算法并存导致的问题，也消除了常见的内存泄漏现象。

导致循环引用的情况不止这些，其他一些情况将在本书中陆续介绍。

**4.3.3 性能问题**

垃圾收集器是周期性运行的，而且如果为变量分配的内存数量很可观，那么回收工作量也是相当大的。在这种情况下，确定垃圾收集的时间间隔是一个非常重要的问题。说到垃圾收集器多长时间运行一次，不禁让人联想到IE因此而声名狼藉的性能问题。IE的垃圾收集器是根据内存分配量运行的，具体一点说就是256个变量、4096个对象（或数组）字面量和数组元素（slot）或者64KB的字符串。达到上述任何一个临界值，垃圾收集器就会运行。这种实现方式的问题在于，如果一个脚本中包含那么多变量，那么该脚本很可能会在其生命周期中一直保有那么多的变量。而这样一来，垃圾收集器就不得不频繁地运行。结果，由此引发的严重性能问题促使IE7重写了其垃圾收集例程。随着IE7的发布，其JavaScript引擎的垃圾收集例程改变了工作方式：触发垃圾收集的变量分配、字面量和（或）数组元素的临界值被调整为动态修正。IE7中的各项临界值在初始时与IE6相等。如果垃圾收集例程回收的内存分配量低于15%，则变量、字面量和（或）数组元素的临界值就会加倍。如果例程回收了85%的内存分配量，则将各种临界值重置回默认值。这一看似简单的调整，极大地提升了IE在运行包含大量JavaScript的页面时的性能。

事实上，在有的浏览器中可以触发垃圾收集过程，但我们不建议读者这样做。在IE中，调用window.CollectGarbage()方法会立即执行垃圾收集。在Opera7及更高版本中，调用window.opera.collect()也会启动垃圾收集例程。

**4.3.4 管理内存**

使用具备垃圾收集机制的语言编写程序，开发人员一般不必操心内存管理的问题。但是，JavaScript在进行内存管理及垃圾收集时面临的问题还是有点与众不同。其中最主要的一个问题，就是分配给Web浏览器的可用内存数量通常要比分配给桌面应用程序的少。这样做的目的主要是出于安全方面的考虑，目的是防止运行JavaScript的网页耗尽全部系统内存而导致系统崩溃。内存限制问题不仅会影响给变量分配内存，同时还会影响调用栈以及在一个线程中能够同时执行的语句数量。

因此，确保占用最少的内存可以让页面获得更好的性能。而优化内存占用的最佳方式，就是为执行中的代码只保存必要的数据。一旦数据不再有用，最好通过将其值设置为null来释放其引用——这个做法叫做解除引用（dereferencing）。这一做法适用于大多数全局变量和全局对象的属性。局部变量会在它们离开执行环境时自动被解除引用，如下面这个例子所示：
```
function createPerson(name) {
    var localPerson = new Object();
    localPerson.name = name;
    return localPerson;
}
var globalPerson = createPerson("Nicholas");
// 手工解除globalPerson的引用
globalPerson = null;
```
在这个例子中，变量globalPerson取得了createPerson()函数返回的值。在createPerson()函数内部，我们创建了一个对象并将其赋给局部变量localPerson，然后又为该对象添加了一个名为name的属性。最后，当调用这个函数时，localPerson以函数值的形式返回并赋给全局变量globalPerson。由于localPerson在createPerson()函数执行完毕后就离开了其执行环境，因此无需我们显式地去为它解除引用。但是对于全局变量globalPerson而言，则需要我们在不使用它的时候手工为它解除引用，这也正是上面例子中最后一行代码的目的。

不过，解除一个值的引用并不意味着自动回收该值所占用的内存。解除引用的真正作用是让值脱离执行环境，以便垃圾收集器下次运行时将其回收。

**4.4 小结**

JavaScript变量可以用来保存两种类型的值：基本类型值和引用类型值。基本类型的值源自以下5种基本数据类型：Undefined、Null、Boolean、Number和String。基本类型值和引用类型值具有以下特点：
- 基本类型值在内存中占据固定大小的空间，因此被保存在栈内存中；
- 从一个变量向另一个变量复制基本类型的值，会创建这个值的一个副本；
- 引用类型的值是对象，保存在堆内存中；
- 包含引用类型值的变量实际上包含的并不是对象本身，而是一个指向该对象的指针；
- 从一个变量向另一个变量复制引用类型的值，复制的其实是指针，因此两个变量最终都指向同一个对象；确定一个值是哪种基本类型可以使用typeof操作符，而确定一个值是哪种引用类型可以使用instanceof操作符。

所有变量（包括基本类型和引用类型）都存在于一个执行环境（也称为作用域）当中，这个执行环境决定了变量的生命周期，以及哪一部分代码可以访问其中的变量。以下是关于执行环境的几点总结：
- 执行环境有全局执行环境（也称为全局环境）和函数执行环境之分；
- 每次进入一个新执行环境，都会创建一个用于搜索变量和函数的作用域链；
- 函数的局部环境不仅有权访问函数作用域中的变量，而且有权访问其包含（父）环境，乃至全局环境；
- 全局环境只能访问在全局环境中定义的变量和函数，而不能直接访问局部环境中的任何数据；
- 变量的执行环境有助于确定应该何时释放内存。
 
JavaScript是一门具有自动垃圾收集机制的编程语言，开发人员不必关心内存分配和回收问题。可以对JavaScript的垃圾收集例程作如下总结。
- 离开作用域的值将被自动标记为可以回收，因此将在垃圾收集期间被删除。
- “标记清除”是目前主流的垃圾收集算法，这种算法的思想是给当前不使用的值加上标记，然后再回收其内存。
- 另一种垃圾收集算法是“引用计数”，这种算法的思想是跟踪记录所有值被引用的次数。JavaScript引擎目前都不再使用这种算法；但在IE中访问非原生JavaScript对象（如DOM元素）时，这种算法仍然可能会导致问题。
- 当代码中存在循环引用现象时，“引用计数”算法就会导致问题。
- 解除变量的引用不仅有助于消除循环引用现象，而且对垃圾收集也有好处。为了确保有效地回收内存，应该及时解除不再使用的全局对象、全局对象属性以及循环引用变量的引用。

第5章 引用类型
------------

本章内容
- 使用对象
- 创建并操作数组
- 理解基本的JavaScript类型
- 使用基本类型和基本包装类型
 
引用类型的值（对象）是引用类型的一个实例。在ECMAScript中，引用类型是一种数据结构，用于将数据和功能组织在一起。它也常被称为类，但这种称呼并不妥当。尽管ECMAScript从技术上讲是一门面向对象的语言，但它不具备传统的面向对象语言所支持的类和接口等基本结构。引用类型有时候也被称为对象定义，因为它们描述的是一类对象所具有的属性和方法。

虽然引用类型与类看起来相似，但它们并不是相同的概念。为避免混淆，本书将不使用类这个概念。

如前所述，对象是某个特定引用类型的实例。新对象是使用new操作符后跟一个构造函数来创建的。构造函数本身就是一个函数，只不过该函数是出于创建新对象的目的而定义的。请看下面这行代码：
```
var person = new Object();
```

这行代码创建了Object引用类型的一个新实例，然后把该实例保存在了变量person中。使用的构造函数是Object，它只为新对象定义了默认的属性和方法。ECMAScript提供了很多原生引用类型（例如Object），以便开发人员用以实现常见的计算任务。

**5.1 Object类型**

到目前为止，我们看到的大多数引用类型值都是Object类型的实例；而且，Object也是ECMAScript中使用最多的一个类型。虽然Object的实例不具备多少功能，但对于在应用程序中存储和传输数据而言，它们确实是非常理想的选择。创建Object实例的方式有两种。第一种是使用new操作符后跟Object构造函数，如下所示：
```
var person = new Object();
person.name = "Nicholas";
person.age = 29;
```

另一种方式是使用对象字面量表示法。对象字面量是对象定义的一种简写形式，目的在于简化创建包含大量属性的对象的过程。下面这个例子就使用了对象字面量语法定义了与前面那个例子中相同的person对象：

```
var person = {
    name : "Nicholas",
    age : 29
};
```

在这个例子中，左边的花括号`{`表示对象字面量的开始，因为它出现在了表达式上下文（expression  context）中。ECMAScript中的表达式上下文指的是能够返回一个值（表达式）。赋值操作符表示后面是一个值，所以左花括号在这里表示一个表达式的开始。同样的花括号，如果出现在一个语句上下文（statement context）中，例如跟在if语句条件的后面，则表示一个语句块的开始。

然后，我们定义了name属性，之后是一个冒号，再后面是这个属性的值。在对象字面量中，使用逗号来分隔不同的属性，因此"Nicholas"后面是一个逗号。但是，在age属性的值29的后面不能添加逗号，因为age是这个对象的最后一个属性。在最后一个属性后面添加逗号，会在IE7及更早版本和Opera中导致错误。

在使用对象字面量语法时，属性名也可以使用字符串，如下面这个例子所示。
```
var person = {
    "name" : "Nicholas",
    "age" : 29,
    5 : true
};
```

这个例子会创建一个对象，包含三个属性：name、age和5。但这里的数值属性名会自动转换为字符串。另外，使用对象字面量语法时，如果留空其花括号，则可以定义只包含默认属性和方法的对象，如下所示：
```
var person = {}; //与new Object()相同
person.name = "Nicholas";
person.age = 29;
```

这个例子与本节前面的例子是等价的，只不过看起来似乎有点奇怪。关于对象字面量语法，我们推荐只在考虑对象属性名的可读性时使用。

在通过对象字面量定义对象时，实际上不会调用Object构造函数（Firefox 2及更早版本会调用Object构造函数；但Firefox 3之后就不会了）。

虽然可以使用前面介绍的任何一种方法来定义对象，但开发人员更青睐对象字面量语法，因为这种语法要求的代码量少，而且能够给人封装数据的感觉。实际上，对象字面量也是向函数传递大量可选参数的首选方式，例如：
```
function displayInfo(args) {
    var output = "";
    if (typeof args.name == "string") {
        output += "Name: " + args.name + "\n";
    }
    if (typeof args.age == "number") {
        output += "Age: " + args.age + "\n";
    }
    alert(output);
}
displayInfo({ name: "Nicholas", age: 29 });
displayInfo({ name: "Greg" });
```

在这个例子中，函数displayInfo()接受一个名为args的参数。这个参数可能带有一个名为name或age的属性，也可能这两个属性都有或者都没有。在这个函数内部，我们通过typeof操作符来检测每个属性是否存在，然后再基于相应的属性来构建一条要显示的消息。然后，我们调用了两次这个函数，每次都使用一个对象字面量来指定不同的数据。这两次调用传递的参数虽然不同，但函数都能正常执行。

这种传递参数的模式最适合需要向函数传入大量可选参数的情形。一般来讲，命名参数虽然容易处理，但在有多个可选参数的情况下就会显示不够灵活。最好的做法是对那些必需值使用命名参数，而使用对象字面量来封装多个可选参数。

一般来说，访问对象属性时使用的都是点表示法，这也是很多面向对象语言中通用的语法。不过，在JavaScript也可以使用方括号表示法来访问对象的属性。在使用方括号语法时，应该将要访问的属性以字符串的形式放在方括号中，如下面的例子所示。

```
alert(person["name"]); //"Nicholas"
alert(person.name); //"Nicholas"
```

从功能上看，这两种访问对象属性的方法没有任何区别。但方括号语法的主要优点是可以通过变量来访问属性，例如：
```
var propertyName = "name";
alert(person[propertyName]); //"Nicholas"
```

如果属性名中包含会导致语法错误的字符，或者属性名使用的是关键字或保留字，也可以使用方括号表示法。例如：
```
person["first name"] = "Nicholas";
```

由于"first name"中包含一个空格，所以不能使用点表示法来访问它。然而，属性名中是可以包含非字母非数字的，这时候就可以使用方括号表示法来访问它们。通常，除非必须使用变量来访问属性，否则我们建议使用点表示法。

**5.2 Array类型**

除了Object之外，Array类型恐怕是ECMAScript中最常用的类型了。而且，ECMAScript中的数组与其他多数语言中的数组有着相当大的区别。虽然ECMAScript数组与其他语言中的数组都是数据的有序列表，但与其他语言不同的是，ECMAScript数组的每一项可以保存任何类型的数据。也就是说，可以用数组的第一个位置来保存字符串，用第二位置来保存数值，用第三个位置来保存对象，以此类推。而且，ECMAScript数组的大小是可以动态调整的，即可以随着数据的添加自动增长以容纳新增数据。

创建数组的基本方式有两种。第一种是使用Array构造函数，如下面的代码所示。
```
var colors = new Array();
```

如果预先知道数组要保存的项目数量，也可以给构造函数传递该数量，而该数量会自动变成length属性的值。例如，下面的代码将创建length值为20的数组。
```
var colors = new Array(20);
```

也可以向Array构造函数传递数组中应该包含的项。以下代码创建了一个包含3个字符串值的数组：
```
var colors = new Array("red", "blue", "green");
```

当然，给构造函数传递一个值也可以创建数组。但这时候问题就复杂一点了，因为如果传递的是数值，则会按照该数值创建包含给定项数的数组；而如果传递的是其他类型的参数，则会创建包含那个值的只有一项的数组。下面就两个例子：
```
var colors = new Array(3); // 创建一个包含3项的数组
var names = new Array("Greg"); // 创建一个包含1项，即字符串"Greg"的数组
```

另外，在使用Array构造函数时也可以省略new操作符。如下面的例子所示，省略new操作符的结果相同：
```
var colors = Array(3); // 创建一个包含3项的数组
var names = Array("Greg"); // 创建一个包含1项，即字符串"Greg"的数组
```

创建数组的第二种基本方式是使用数组字面量表示法。数组字面量由一对包含数组项的方括号表示，多个数组项之间以逗号隔开，如下所示：
```
var colors = ["red", "blue", "green"];  // 创建一个包含3个字符串的数组
var names = []; // 创建一个空数组
var values = [1,2,]; // 不要这样！这样会创建一个包含2或3项的数组
var options = [,,,,,]; // 不要这样！这样会创建一个包含5或6项的数组
```

以上代码的第一行创建了一个包含3个字符串的数组。第二行使用一对空方括号创建了一个空数组。第三行展示了在数组字面量的最后一项添加逗号的结果：在IE中，values会成为一个包含3个项且每项的值分别为1、2和undefined的数组；在其他浏览器中，values会成为一个包含2项且值分别为1和2的数组。原因是IE8及之前版本中的ECMAScript实现在数组字面量方面存在bug。由于这个bug导致的另一种情况如最后一行代码所示，该行代码可能会创建包含5项的数组（在IE9+、Firefox、Opera、Safari和Chrome中），也可能会创建包含6项的数组（在IE8及更早版本中）。在像这种省略值的情况下，每一项都将获得undefined值；这个结果与调用Array构造函数时传递项数在逻辑上是相同的。但是由于IE的实现与其他浏览器不一致，因此我们强烈建议不要使用这种语法。

与对象一样，在使用数组字面量表示法时，也不会调用Array构造函数（Firefox 3及更早版本除外）。

在读取和设置数组的值时，要使用方括号并提供相应值的基于0的数字索引，如下所示：
```
var colors = ["red", "blue", "green"];// 定义一个字符串数组
alert(colors[0]); // 显示第一项
colors[2] = "black"; // 修改第三项
colors[3] = "brown"; // 新增第四项
```

方括号中的索引表示要访问的值。如果索引小于数组中的项数，则返回对应项的值，就像这个例子中的`colors[0]`会显示"red"一样。设置数组的值也使用相同的语法，但会替换指定位置的值。如果设置某个值的索引超过了数组现有项数，如这个例子中的`colors[3]`所示，数组就会自动增加到该索引值加1的长度（就这个例子而言，索引是3，因此数组长度就是4）。数组的项数保存在其length属性中，这个属性始终会返回0或更大的值，如下面这个例子所示：
```
var colors = ["red", "blue", "green"]; // 创建一个包含3个字符串的数组
var names = []; // 创建一个空数组
alert(colors.length); //3
alert(names.length);//0
```

数组的length属性很有特点——它不是只读的。因此，通过设置这个属性，可以从数组的末尾移除项或向数组中添加新项。请看下面的例子：
```
var colors = ["red", "blue", "green"]; //创建一个包含3个字符串的数组
colors.length = 2;
alert(colors[2]); //undefined
```

这个例子中的数组colors一开始有3个值。将其length属性设置为2会移除最后一项（位置为2的那一项），结果再访问colors[2]就会显示undefined了。如果将其length属性设置为大于数组项数的值，则新增的每一项都会取得undefined值，如下所示：
```
var colors = ["red", "blue", "green"]; // 创建一个包含3个字符串的数组
colors.length = 4;
alert(colors[3]);//undefined
```

在此，虽然colors数组包含3个项，但把它的length属性设置成了4。这个数组不存在位置3，所以访问这个位置的值就得到了特殊值undefined。利用length属性也可以方便地在数组末尾添加新项，如下所示：
```
var colors = ["red", "blue", "green"]; // 创建一个包含3个字符串的数组
colors[colors.length] = "black"; //（在位置3）添加一种颜色
colors[colors.length] = "brown"; //（在位置4）再添加一种颜色
```

由于数组最后一项的索引始终是length-1，因此下一个新项的位置就是length。每当在数组末尾添加一项后，其length属性都会自动更新以反应这一变化。换句话说，上面例子第二行中的colors[colors.length]为位置3添加了一个值，最后一行的colors[colors.length]则为位置4添加了一个值。当把一个值放在超出当前数组大小的位置上时，数组就会重新计算其长度值，即长度值等于最后一项的索引加1，如下面的例子所示：

```
var colors = ["red", "blue", "green"];// 创建一个包含3个字符串的数组
colors[99] = "black";//（在位置99）添加一种颜色
alert(colors.length); // 100
```

在这个例子中，我们向colors数组的位置99插入了一个值，结果数组新长度（length）就是100（99+1）。而位置3到位置98实际上都是不存在的，所以访问它们都将返回undefined。

数组最多可以包含4294967295个项，这几乎已经能够满足任何编程需求了。如果想添加的项数超过这个上限值，就会发生异常。而创建一个初始大小与这个上限值接近的数组，则可能会导致运行时间超长的脚本错误。

**5.2.1 检测数组**

自从ECMAScript3做出规定以后，就出现了确定某个对象是不是数组的经典问题。对于一个网页，或者一个全局作用域而言，使用instanceof操作符就能得到满意的结果：
```
if (value instanceof Array) {
    //对数组执行某些操作
}
```

instanceof操作符的问题在于，它假定只有一个全局执行环境。如果网页中包含多个框架，那实际上就存在两个以上不同的全局执行环境，从而存在两个以上不同版本的Array构造函数。如果你从一个框架向另一个框架传入一个数组，那么传入的数组与在第二个框架中原生创建的数组分别具有各自不同的构造函数。为了解决这个问题，ECMAScript5新增了`Array.isArray()`方法。这个方法的目的是最终确定某个值到底是不是数组，而不管它是在哪个全局执行环境中创建的。这个方法的用法如下。
```
if (Array.isArray(value)) {
    //对数组执行某些操作
}
```

支持Array.isArray()方法的浏览器有IE9+、Firefox  4+、Safari  5+、Opera  10.5+和Chrome。要在尚未实现这个方法中的浏览器中准确检测数组，请参考22.1.1节。

**5.2.2 转换方法**

如前所述，所有对象都具有toLocaleString()、toString()和valueOf()方法。其中，调用数组的toString()方法会返回由数组中每个值的字符串形式拼接而成的一个以逗号分隔的字符串。而调用valueOf()返回的还是数组。实际上，为了创建这个字符串会调用数组每一项的toString()方法。来看下面这个例子。

```
var colors = ["red", "blue", "green"]; // 创建一个包含3个字符串的数组
alert(colors.toString()); // red,blue,green
alert(colors.valueOf());  // red,blue,green
alert(colors);            // red,blue,green
```

在这里，我们首先显式地调用了toString()方法，以便返回数组的字符串表示，每个值的字符串表示拼接成了一个字符串，中间以逗号分隔。接着调用valueOf()方法，而最后一行代码直接将数组传递给了alert()。由于alert()要接收字符串参数，所以它会在后台调用toString()方法，由此会得到与直接调用toString()方法相同的结果。另外，toLocaleString()方法经常也会返回与toString()和valueOf()方法相同的值，但也不总是如此。当调用数组的toLocaleString()方法时，它也会创建一个数组值的以逗号分隔的字符串。而与前两个方法唯一的不同之处在于，这一次为了取得每一项的值，调用的是每一项的toLocale- String()方法，而不是toString()方法。请看下面这个例子。
```
var person1 = {
    toLocaleString : function () {
        return "Nikolaos";
    },
    toString : function() {
        return "Nicholas";
    }
};
var person2 = {
    toLocaleString : function () {
        return "Grigorios";
    },
    toString : function() {
        return "Greg";
    }
};
var people = [person1, person2];
alert(people); // Nicholas,Greg
alert(people.toString()); // Nicholas,Greg
alert(people.toLocaleString()); // Nikolaos,Grigorios
```

我们在这里定义了两个对象：person1和person2。而且还分别为每个对象定义了一个toString()方法和一个toLocaleString()方法，这两个方法返回不同的值。然后，创建一个包含前面定义的两个对象的数组。在将数组传递给alert()时，输出结果是"Nicholas,Greg"，因为调用了数组每一项的toString()方法（同样，这与下一行显式调用toString()方法得到的结果相同）。而当调用数组的toLocaleString()方法时，输出结果是"Nikolaos,Grigorios"，原因是调用了数组每一项的toLocaleString()方法。

数组继承的toLocaleString()、toString()和valueOf()方法，在默认情况下都会以逗号分隔的字符串的形式返回数组项。而如果使用join()方法，则可以使用不同的分隔符来构建这个字符串。join()方法只接收一个参数，即用作分隔符的字符串，然后返回包含所有数组项的字符串。请看下面的例子：
```
var colors = ["red", "green", "blue"];
alert(colors.join(","));  // red,green,blue
alert(colors.join("||")); // red||green||blue
```

在这里，我们使用join()方法重现了toString()方法的输出。在传递逗号的情况下，得到了以逗号分隔的数组值。而在最后一行代码中，我们传递了双竖线符号，结果就得到了字符串 `"red|| green||blue"`。如果不给join()方法传入任何值，或者给它传入undefined，则使用逗号作为分隔符。IE7及更早版本会错误的使用字符串"undefined"作为分隔符。

如果数组中的某一项的值是null或者undefined，那么该值在join()、toLocaleString()、toString()和valueOf()方法返回的结果中以空字符串表示。

**5.2.3 栈方法**

ECMAScript数组也提供了一种让数组的行为类似于其他数据结构的方法。具体说来，数组可以表现得就像栈一样，后者是一种可以限制插入和删除项的数据结构。栈是一种LIFO（Last-In-First-Out，后进先出）的数据结构，也就是最新添加的项最早被移除。而栈中项的插入（叫做推入）和移除（叫做弹出），只发生在一个位置——栈的顶部。ECMAScript为数组专门提供了push()和pop()方法，以便实现类似栈的行为。

push()方法可以接收任意数量的参数，把它们逐个添加到数组末尾，并返回修改后数组的长度。而pop()方法则从数组末尾移除最后一项，减少数组的length值，然后返回移除的项。请看下面的例子：

```
var colors = new Array(); // 创建一个数组
var count = colors.push("red", "green"); // 推入两项
alert(count); // 2
count = colors.push("black"); // 推入另一项
alert(count); //3
var item = colors.pop(); // 取得最后一项
alert(item); //"black"
alert(colors.length); //2
```

以上代码中的数组可以看成是栈（代码本身没有任何区别，而push()和pop()都是数组默认的方法）。首先，我们使用push()将两个字符串推入数组的末尾，并将返回的结果保存在变量count中（值为2）。然后，再推入一个值，而结果仍然保存在count中。因为此时数组中包含3项，所以push()返回3。在调用pop()时，它会返回数组的最后一项，即字符串"black"。此后，数组中仅剩两项。可以将栈方法与其他数组方法连用，像下面这个例子一样。

```
var colors = ["red", "blue"];
colors.push("brown"); // 添加另一项
colors[3] = "black";  // 添加一项
alert(colors.length); // 4
var item = colors.pop(); // 取得最后一项
alert(item); //"black"
```

在此，我们首先用两个值来初始化一个数组。然后，使用push()添加第三个值，再通过直接在位置3上赋值来添加第四个值。而在调用pop()时，该方法返回了字符串"black"，即最后一个添加到数组的值。


**5.2.4 队列方法**

栈数据结构的访问规则是LIFO（后进先出），而队列数据结构的访问规则是FIFO（First-In-First-Out，先进先出）。队列在列表的末端添加项，从列表的前端移除项。由于push()是向数组末端添加项的方法，因此要模拟队列只需一个从数组前端取得项的方法。实现这一操作的数组方法就是shift()，它能够移除数组中的第一个项并返回该项，同时将数组长度减1。结合使用shift()和push()方法，可以像使用队列一样使用数组。

```
var colors = new Array(); //创建一个数组
var count = colors.push("red", "green"); //推入两项
alert(count); //2
count = colors.push("black"); //推入另一项
alert(count); //3
var item = colors.shift();//取得第一项
alert(item); //"red"
alert(colors.length); //2
```

这个例子首先使用push()方法创建了一个包含3种颜色名称的数组。代码中加粗的那一行使用shift()方法从数组中取得了第一项，即"red"。在移除第一项之后，"green"就变成了第一项，而"black"则变成了第二项，数组也只包含两项了。

ECMAScript还为数组提供了一个unshift()方法。顾名思义，unshift()与shift()的用途相反：它能在数组前端添加任意个项并返回新数组的长度。因此，同时使用unshift()和pop()方法，可以从相反的方向来模拟队列，即在数组的前端添加项，从数组末端移除项，如下面的例子所示。

```
var colors = new Array(); //创建一个数组
var count = colors.unshift("red", "green");//推入两项
alert(count); //2ß
count = colors.unshift("black"); //推入另一项
alert(count);//3
var item = colors.pop();//取得最后一项
alert(item);//"green"
alert(colors.length); //2
```

这个例子创建了一个数组并使用unshift()方法先后推入了3个值。首先是"red"和"green"，然后是"black"，数组中各项的顺序为"black"、"red"、"green"。在调用pop()方法时，移除并返回的是最后一项，即"green"。

IE7及更早版本对JavaScript的实现中存在一个偏差，其unshift()方法总是返回undefined而不是数组的新长度。IE8在非兼容模式下会返回正确的长度值。

**5.2.5 重排序方法**

数组中已经存在两个可以直接用来重排序的方法：reverse()和sort()。有读者可能猜到了，reverse()方法会反转数组项的顺序。请看下面这个例子。
```
var values = [1, 2, 3, 4, 5];
values.reverse();
alert(values); // 5,4,3,2,1
```

这里数组的初始值及顺序是1、2、3、4、5。而调用数组的reverse()方法后，其值的顺序变成了5、4、3、2、1。这个方法的作用相当直观明了，但不够灵活，因此才有了sort()方法。

在默认情况下，sort()方法按升序排列数组项——即最小的值位于最前面，最大的值排在最后面。为了实现排序，sort()方法会调用每个数组项的toString()转型方法，然后比较得到的字符串，以确定如何排序。即使数组中的每一项都是数值，sort()方法比较的也是字符串，如下所示。
```
var values = [0, 1, 5, 10, 15];
values.sort();
alert(values); //0,1,10,15,5
```

可见，即使例子中值的顺序没有问题，但sort()方法也会根据测试字符串的结果改变原来的顺序。因为数值5虽然小于10，但在进行字符串比较时，"10"则位于"5"的前面，于是数组的顺序就被修改了。不用说，这种排序方式在很多情况下都不是最佳方案。因此sort()方法可以接收一个比较函数作为参数，以便我们指定哪个值位于哪个值的前面。比较函数接收两个参数，如果第一个参数应该位于第二个之前则返回一个负数，如果两个参数相等则返回0，如果第一个参数应该位于第二个之后则返回一个正数。以下就是一个简单的比较函数：

```
function compare(value1, value2) {
    if (value1 < value2) {
        return -1;
    } else if (value1 > value2) {
        return 1;
    } else {
        return 0;
    }
}
```

这个比较函数可以适用于大多数数据类型，只要将其作为参数传递给sort()方法即可，如下面这个例子所示。
```
var values = [0, 1, 5, 10, 15];
values.sort(compare);
alert(values); //0,1,5,10,15
```

在将比较函数传递到sort()方法之后，数值仍然保持了正确的升序。当然，也可以通过比较函数产生降序排序的结果，只要交换比较函数返回的值即可。

```
function compare(value1, value2) {
    if (value1 < value2) {
        return 1;
    } else if (value1 > value2) {
        return -1;
    } else {
        return 0;
    }
}
var values = [0, 1, 5, 10, 15];
values.sort(compare);
alert(values); // 15,10,5,1,0
```

这个修改后的例子中，比较函数在第一个值应该位于第二个之后的情况下返回1，而在第一个值应该在第二个之前的情况下返回-1。交换返回值的意思是让更大的值排位更靠前，也就是对数组按照降序排序。当然，如果只想反转数组原来的顺序，使用reverse()方法要更快一些。

reverse()和sort()方法的返回值是经过排序之后的数组。

对于数值类型或者其valueOf()方法会返回数值类型的对象类型，可以使用一个更简单的比较函数。这个函数只要用第二个值减第一个值即可。
```
function compare(value1, value2) {
    return value2 - value1;
}
```

由于比较函数通过返回一个小于零、等于零或大于零的值来影响排序结果，因此减法操作就可以适当地处理所有这些情况。

**5.2.6 操作方法**

ECMAScript为操作已经包含在数组中的项提供了很多方法。其中，concat()方法可以基于当前数组中的所有项创建一个新数组。具体来说，这个方法会先创建当前数组一个副本，然后将接收到的参数添加到这个副本的末尾，最后返回新构建的数组。在没有给concat()方法传递参数的情况下，它只是复制当前数组并返回副本。如果传递给concat()方法的是一或多个数组，则该方法会将这些数组中的每一项都添加到结果数组中。如果传递的值不是数组，这些值就会被简单地添加到结果数组的末尾。下面来看一个例子。
```
var colors = ["red", "green", "blue"];
var colors2 = colors.concat("yellow", ["black", "brown"]);
alert(colors);  //red,green,blue
alert(colors2); //red,green,blue,yellow,black,brown
```

以上代码开始定义了一个包含3个值的数组colors。然后，基于colors调用了concat()方法，并传入字符串"yellow"和一个包含"black"和"brown"的数组。最终，结果数组colors2中包含了"red"、"green"、"blue"、"yellow"、"black"和"brown"。至于原来的数组colors，其值仍然保持不变。

下一个方法是slice()，它能够基于当前数组中的一或多个项创建一个新数组。slice()方法可以接受一或两个参数，即要返回项的起始和结束位置。在只有一个参数的情况下，slice()方法返回从该参数指定位置开始到当前数组末尾的所有项。如果有两个参数，该方法返回起始和结束位置之间的项——但不包括结束位置的项。注意，slice()方法不会影响原始数组。请看下面的例子。
```
var colors = ["red", "green", "blue", "yellow", "purple"];
var colors2 = colors.slice(1);
var colors3 = colors.slice(1,4);
alert(colors2); //green,blue,yellow,purple
alert(colors3); //green,blue,yellow
```

在这个例子中，开始定义的数组colors包含5项。调用slice()并传入1会得到一个包含4项的新数组；因为是从位置1开始复制，所以会包含"green"而不会包含"red"。这个新数组colors2中包含的是"green"、"blue"、"yellow"和"purple"。接着，我们再次调用slice()并传入了1和4，表示复制从位置1开始，到位置3结束。结果数组colors3中包含了"green"、"blue"和"yellow"。

如果slice()方法的参数中有一个负数，则用数组长度加上该数来确定相应的位置。例如，在一个包含5项的数组上调用slice(-2,-1)与调用slice(3,4)得到的结果相同。如果结束位置小于起始位置，则返回空数组。

下面我们来介绍splice()方法，这个方法恐怕要算是最强大的数组方法了，它有很多种用法。splice()的主要用途是向数组的中部插入项，但使用这种方法的方式则有如下3种。
- 删除：可以删除任意数量的项，只需指定2个参数：要删除的第一项的位置和要删除的项数。例如，`splice(0,2)`会删除数组中的前两项。
- 插入：可以向指定位置插入任意数量的项，只需提供3个参数：起始位置、0（要删除的项数）和要插入的项。如果要插入多个项，可以再传入第四、第五，以至任意多个项。例如，`splice(2,0,"red","green")`会从当前数组的位置2开始插入字符串"red"和"green"。
- 替换：可以向指定位置插入任意数量的项，且同时删除任意数量的项，只需指定3个参数：起始位置、要删除的项数和要插入的任意数量的项。插入的项数不必与删除的项数相等。例如，`splice (2,1,"red","green")`会删除当前数组位置2的项，然后再从位置2开始插入字符串"red"和"green"。

splice()方法始终都会返回一个数组，该数组中包含从原始数组中删除的项（如果没有删除任何项，则返回一个空数组）。下面的代码展示了上述3种使用splice()方法的方式。
```
var colors = ["red", "green", "blue"];
var removed = colors.splice(0,1); // 删除第一项
alert(colors); // green,blue
alert(removed); // red，返回的数组中只包含一项
removed = colors.splice(1, 0, "yellow", "orange");   // 从位置1开始插入两项
alert(colors); // green,yellow,orange,blue
alert(removed);// 返回的是一个空数组
removed = colors.splice(1, 1, "red", "purple"); // 插入两项，删除一项
alert(colors); // green,red,purple,orange,blue
alert(removed);// yellow，返回的数组中只包含一项
```

上面的例子首先定义了一个包含3项的数组colors。第一次调用splice()方法只是删除了这个数组的第一项，之后colors还包含"green"和"blue"两项。第二次调用splice()方法时在位置1插入了两项，结果colors中包含"green"、"yellow"、"orange"和"blue"。这一次操作没有删除项，因此返回了一个空数组。最后一次调用splice()方法删除了位置1处的一项，然后又插入了"red"和"purple"。在完成以上操作之后，数组colors中包含的是"green"、"red"、"purple"、"orange"和"blue"。

**5.2.7 位置方法**

ECMAScript5为数组实例添加了两个位置方法：indexOf()和lastIndexOf()。这两个方法都接收两个参数：要查找的项和（可选的）表示查找起点位置的索引。其中，indexOf()方法从数组的开头（位置0）开始向后查找，lastIndexOf()方法则从数组的末尾开始向前查找。

这两个方法都返回要查找的项在数组中的位置，或者在没找到的情况下返回-1。在比较第一个参数与数组中的每一项时，会使用全等操作符；也就是说，要求查找的项必须严格相等（就像使用===一样）。以下是几个例子。
```
var numbers = [1,2,3,4,5,4,3,2,1];
alert(numbers.indexOf(4)); //3
alert(numbers.lastIndexOf(4)); //5
alert(numbers.indexOf(4, 4)); // 5
alert(numbers.lastIndexOf(4, 4)); //3
var person = {
    name: "Nicholas"
};
var people = [{ name: "Nicholas" }];
var morePeople = [person];
alert(people.indexOf(person));//-1
alert(morePeople.indexOf(person)); //0
```

使用indexOf()和lastIndexOf()方法查找特定项在数组中的位置非常简单，支持它们的浏览器包括IE9+、Firefox 2+、Safari 3+、Opera 9.5+和Chrome。

**5.2.8 迭代方法**

ECMAScript5为数组定义了5个迭代方法。每个方法都接收两个参数：要在每一项上运行的函数和（可选的）运行该函数的作用域对象——影响this的值。传入这些方法中的函数会接收三个参数：数组项的值、该项在数组中的位置和数组对象本身。根据使用的方法不同，这个函数执行后的返回值可能会也可能不会影响方法的返回值。以下是这5个迭代方法的作用。
- every()：对数组中的每一项运行给定函数，如果该函数对每一项都返回true，则返回true。
- filter()：对数组中的每一项运行给定函数，返回该函数会返回true的项组成的数组。
- forEach()：对数组中的每一项运行给定函数。这个方法没有返回值。
- map()：对数组中的每一项运行给定函数，返回每次函数调用的结果组成的数组。
- some()：对数组中的每一项运行给定函数，如果该函数对任一项返回true，则返回true。以上方法都不会修改数组中的包含的值。
 
在这些方法中，最相似的是every()和some()，它们都用于查询数组中的项是否满足某个条件。对every()来说，传入的函数必须对每一项都返回true，这个方法才返回true；否则，它就返回false。而some()方法则是只要传入的函数对数组中的某一项返回true，就会返回true。请看以下例子。

```
var numbers = [1,2,3,4,5,4,3,2,1];
var everyResult = numbers.every(function(item, index, array) {
    return (item > 2);
});
alert(everyResult); //false
var someResult = numbers.some(function(item, index, array){
    return (item > 2);
});
alert(someResult); //true
```

以上代码调用了every()和some()，传入的函数只要给定项大于2就会返回true。对于every()，它返回的是false，因为只有部分数组项符合条件。对于some()，结果就是true，因为至少有一项是大于2的。下面再看一看filter()函数，它利用指定的函数确定是否在返回的数组中包含某一项。例如，要返回一个所有数值都大于2的数组，可以使用以下代码。

```
var numbers = [1,2,3,4,5,4,3,2,1];
var filterResult = numbers.filter( function(item, index, array) {
    return (item > 2);
});
alert(filterResult); //[3,4,5,4,3]
```

这里，通过调用filter()方法创建并返回了包含3、4、5、4、3的数组，因为传入的函数对它们每一项都返回true。这个方法对查询符合某些条件的所有数组项非常有用。map()也返回一个数组，而这个数组的每一项都是在原始数组中的对应项上运行传入函数的结果。例如，可以给数组中的每一项乘以2，然后返回这些乘积组成的数组，如下所示。
```
var numbers = [1,2,3,4,5,4,3,2,1];
var mapResult = numbers.map(function(item, index, array) {
    return item * 2;
});
alert(mapResult); //[2,4,6,8,10,8,6,4,2]
```

以上代码返回的数组中包含给每个数乘以2之后的结果。这个方法适合创建包含的项与另一个数组一一对应的数组。最后一个方法是forEach()，它只是对数组中的每一项运行传入的函数。这个方法没有返回值，本质上与使用for循环迭代数组一样。来看一个例子。
```
var numbers = [1,2,3,4,5,4,3,2,1];
numbers.forEach(function(item, index, array) {
    //执行某些操作
});
```

这些数组方法通过执行不同的操作，可以大大方便处理数组的任务。支持这些迭代方法的浏览器有IE9+、Firefox 2+、Safari 3+、Opera 9.5+和Chrome。

**5.2.9 归并方法**

ECMAScript5还新增了两个归并数组的方法：reduce()和reduceRight()。这两个方法都会迭代数组的所有项，然后构建一个最终返回的值。其中，reduce()方法从数组的第一项开始，逐个遍历到最后。而reduceRight()则从数组的最后一项开始，向前遍历到第一项。这两个方法都接收两个参数：一个在每一项上调用的函数和（可选的）作为归并基础的初始值。传给reduce()和reduceRight()的函数接收4个参数：前一个值、当前值、项的索引和数组对象。这个函数返回的任何值都会作为第一个参数自动传给下一项。第一次迭代发生在数组的第二项上，因此第一个参数是数组的第一项，第二个参数就是数组的第二项。使用reduce()方法可以执行求数组中所有值之和的操作，比如：

```
var values = [1,2,3,4,5];
var sum = values.reduce(function(prev, cur, index, array) {
    return prev + cur;
});
alert(sum); //15
```

第一次执行回调函数，prev是1，cur是2。第二次，prev是3（1加2的结果），cur是3（数组的第三项）。这个过程会持续到把数组中的每一项都访问一遍，最后返回结果。reduceRight()的作用类似，只不过方向相反而已。来看下面这个例子。

```
var values = [1,2,3,4,5];
var sum = values.reduceRight(function(prev, cur, index, array){
    return prev + cur;
});
alert(sum); //15
```

在这个例子中，第一次执行回调函数，prev是5，cur是4。当然，最终结果相同，因为执行的都是简单相加的操作。使用reduce()还是reduceRight()，主要取决于要从哪头开始遍历数组。除此之外，它们完全相同。支持这两个归并函数的浏览器有IE9+、Firefox 3+、Safari 4+、Opera 10.5和Chrome。

**5.3 Date类型**

ECMAScript中的Date类型是在早期Java中的java.util.Date类基础上构建的。为此，Date类型使用自UTC（Coordinated Universal Time，国际协调时间）1970年1月1日午夜（零时）开始经过的毫秒数来保存日期。在使用这种数据存储格式的条件下，Date类型保存的日期能够精确到1970年1月1日之前或之后的285616年。要创建一个日期对象，使用new操作符和Date构造函数即可，如下所示。
```
var now = new Date(); 
```

在调用Date构造函数而不传递参数的情况下，新创建的对象自动获得当前日期和时间。如果想根据特定的日期和时间创建日期对象，必须传入表示该日期的毫秒数（即从UTC时间1970年1月1日午夜起至该日期止经过的毫秒数）。为了简化这一计算过程，ECMAScript提供了两个方法：`Date.parse()`和`Date.UTC()`。其中，`Date.parse()`方法接收一个表示日期的字符串参数，然后尝试根据这个字符串返回相应日期的毫秒数。ECMA-262没有定义`Date.parse()`应该支持哪种日期格式，因此这个方法的行为因实现而异，而且通常是因地区而异。将地区设置为美国的浏览器通常都接受下列日期格式：

- 月/日/年”，如6/13/2004；
- “英文月名日,年”，如January 12,2004；
- “英文星期几英文月名日年时:分:秒时区” ，如Tue May 25 2004 00:00:00 GMT-0700。
- ISO8601扩展格式YYYY-MM-DDTHH:mm:ss.sssZ（例如2004-05-25T00:00:00）。只有兼容ECMAScript5的实现支持这种格式。

例如，要为2004年5月25日创建一个日期对象，可以使用下面的代码：
```
var someDate = new Date(Date.parse("May 25, 2004"));
```

如果传入Date.parse()方法的字符串不能表示日期，那么它会返回NaN。实际上，如果直接将表示日期的字符串传递给Date构造函数，也会在后台调用Date.parse()。换句话说，下面的代码与前面的例子是等价的：
```
var someDate = new Date("May 25, 2004");
```

这行代码将会得到与前面相同的日期对象。

日期对象及其在不同浏览器中的实现有许多奇怪的行为。其中有一种倾向是将超出范围的值替换成当前的值，以便生成输出。例如，在解析"January 32, 2007"时，有的浏览器会将其解释为"February 1, 2007"。而Opera则倾向于插入当前月份的当前日期，返回"January当前日期，2007"。也就是说，如果在2007年9月21日运行前面的代码，将会得到"January 21, 2007"（都是21日）。

Date.UTC()方法同样也返回表示日期的毫秒数，但它与Date.parse()在构建值时使用不同的信息。Date.UTC()的参数分别是年份、基于0的月份（一月是0，二月是1，以此类推）、月中的哪一天（1到31）、小时数（0到23）、分钟、秒以及毫秒数。在这些参数中，只有前两个参数（年和月）是必需的。如果没有提供月中的天数，则假设天数为1；如果省略其他参数，则统统假设为0。以下是两个使用Date.UTC()方法的例子：

```
// GMT时间2000年1月1日午夜零时
var y2k = new Date(Date.UTC(2000, 0));
// GMT时间2005年5月5日下午5:55:55
var allFives = new Date(Date.UTC(2005, 4, 5, 17, 55, 55));
```

这个例子创建了两个日期对象。第一个对象表示GMT时间2000年1月1日午夜零时，传入的值一个是表示年份的2000，一个是表示月份的0（即一月份）。因为其他参数是自动填充的（即月中的天数为1，其他所有参数均为0），所以结果就是该月第一天的午夜零时。第二个对象表示GMT时间2005年5月5日下午5:55:55，即使日期和时间中只包含5，也需要传入不一样的参数：月份必须是4（因为月份是基于0的）、小时必须设置为17（因为小时以0到23表示），剩下的参数就很直观了。如同模仿Date.parse()一样，Date构造函数也会模仿Date.UTC()，但有一点明显不同：日期和时间都基于本地时区而非GMT来创建。不过，Date构造函数接收的参数仍然与Date.UTC()相同。

因此，如果第一个参数是数值，Date构造函数就会假设该值是日期中的年份，而第二个参数是月份，以此类推。据此，可以将前面的例子重写如下。

```
// 本地时间2000年1月1日午夜零时
var y2k = new Date(2000, 0);
// 本地时间2005年5月5日下午5:55:55
var allFives = new Date(2005, 4, 5, 17, 55, 55);
```

以上代码创建了与前面例子中相同的两个日期对象，只不过这次的日期都是基于系统设置的本地时区创建的。

ECMAScript5添加了Data.now()方法，返回表示调用这个方法时的日期和时间的毫秒数。这个方法简化了使用Data对象分析代码的工作。例如：
```
//取得开始时间
var start = Date.now();
//调用函数
doSomething();
//取得停止时间
var stop = Date.now(), result = stop – start;
```

支持Data.now()方法的浏览器包括IE9+、Firefox3+、Safari3+、Opera10.5和Chrome。在不支持它的浏览器中，使用+操作符把Data对象转换成字符串，也可以达到同样的目的。
```
//取得开始时间
var start = +new Date();
//调用函数doSomething();
//取得停止时间
var stop = +new Date(), result = stop - start;
```

**5.3.1 继承的方法**
**5.3.1 日期格式化方法**
**5.3.1 日期/时间组件方法**

**5.4 RegExp类型**
**5.4.1 RegExp实例属性**
**5.4.2 RegExp实例方法**
**5.4.3 RegExp构造函数属性**
**5.4.4 模式的局限性**

**5.5 Function类型**
**5.5.1 没有重载（深入理解）**
**5.5.2 函数声明与函数表达式**
**5.5.3 作为值的函数**
**5.5.4 函数内部属性**
**5.5.5 函数属性和方法**

**5.6 基本包装类型**
**5.6.1 Boolean类型**
**5.6.2 Number类型**
**5.6.3 String类型**

**5.7 单体内置对象**
**5.7.1 Global对象**
**5.7.2 Math对象**
**5.8 小结**
