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

**3.4.6 String类型**
**3.4.7 Object类型**

**3.5 操作符**
**3.5.1 一元操作符**
**3.5.2 位操作符**
**3.5.3 布尔操作符**
**3.5.4 乘性操作符**
**3.5.5 加性操作符**
**3.5.6 关系操作符**
**3.5.7 相等操作符**
**3.5.8 条件操作符**
**3.5.9 赋值操作符**
**3.5.10 逗号操作符**

**3.6 语句**
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
**3.7.1 理解参数**
**3.7.2 没有重载**

**3.8 小结**

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

在向参数传递基本类型的值时，被传递的值会被复制给一个局部变量（即命名参数，或者用ECMAScript的概念来说，就是arguments对象中的一个元素）。在向参数传递引用类型的值时，会把这个值在内存中的地址复制给一个局部变量，因此这个局部变量的变化会反映在函数的外部。请看下面


**4.1.4 检测类型**

**4.2 执行环境及作用域**
**4.2.1 延长作用域链**
**4.2.2 没有块级作用域**

**4.3 垃圾收集**
**4.3.1 标记清除**
**4.3.2 引用计数**
**4.3.3 性能问题**
**4.3.4 管理内存**

**4.4 小结**

第5章 引用类型
--------------

**5.1 Object类型**
**5.2 Array类型**
**5.2.1 检测数组**
**5.2.2 转换方法**
**5.2.3 栈方法**
**5.2.4 队列方法**
**5.2.5 重排序方法**
**5.2.6 操作方法**
**5.2.7 位置方法**
**5.2.8 迭代方法**
**5.2.9 缩小方法**

**5.3 Date类型**
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
