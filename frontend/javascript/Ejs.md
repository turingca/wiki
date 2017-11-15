前言
---

[Effective JavaScript templating](http://ejs.co/)

[GitHub Docs](https://github.com/mde/ejs)

What is EJS?
------------

"E" is for "effective." EJS is a simple templating language that lets you generate HTML markup with plain JavaScript. No religiousness about how to organize things. No reinvention of iteration and control-flow. It's just plain JavaScript.

“E” 的含义是 “有效” 的意思。EJS 是一个简单的模板语言，可以让你使用原生 JavaScript 生成 HTML 标记。没有关于如何组织内容的语法规则，也没有循环和控制流的重载，只是使用原生的 JavaScript。


Use plain JavaScript
We love JavaScript. It's a totally friendly language. All templating languages grow to be Turing-complete. Just cut out the middle-man, and use JS!

使用原生 JavaScript
我们喜欢使用JavaScript。它是一个足够友好的语言，所有的模板语言都会成长为图灵完备的。砍掉中间环节而只使用 JavaScript！


Fast development time
Don't waste time and attention figuring out arcane new syntax because 'elegance' — or how to preprocess your data so it will actually render right.

快速的开发周期
不要为了优雅而浪费时间和精力去搞清楚神秘的新语法，或者搞清楚它是如何正确地预处理你的数据内容。

Simple syntax
JavaScript code in simple, straightforward scriptlet tags. Just write JavaScript that emits the HTML you want, and get your shit done.

简单的语法
JavaScript 代码简单、直接的嵌入在```<script>```标签中。只通过编写 JavaScript 实现你想要的 HTML。

Speedy execution
We all know how fast V8 and the other JavaScript runtimes have gotten. EJS caches the intermediate JS functions for fast execution.

快速的执行
我们都知道V8和其他JavaScript引擎的运行时间有多快。 EJS缓存中间JS函数以便快速执行。

Easy debugging
It's easy to debug EJS errors: your errors are plain JavaScript exceptions, with template line-numbers included.

易于调试
容易的调试 EJS 的错误: 指出原生 JavaScript 的错误在模板的哪一行中。

Active development
EJS has a large community of active users, and the library is under active development. We're happy to answer your questions or give you help.

积极发展
EJS 在社区中拥有大量的活跃用户，而且库也在积极开发中。我们很愿意回答你的问题或者为你提供帮助。

### Features
* Fast compilation and rendering
* Simple template tags: <% %>
* Custom delimiters (e.g., use <? ?> instead of <% %>)
* Includes
* Both server JS and browser support
* Static caching of intermediate JavaScript
* Static caching of templates
* Complies with the Express view system

### 特点
* 快速编译和渲染
* 简单的模板标签: <% %>
* 自定义分隔符（例如使用 <? ?>替换<% %>）
* 使用 include 引入其他模板
* 同时支持服务器端和客户端使用
* JavaScript 的静态缓存
* 模板的静态缓存
* 与 Express 视图系统兼容

Get Started 快速入门
------------------

#### Install 安装

It's easy to install EJS with NPM.
```
$ npm install ejs
```

#### Use 使用

Pass EJS a template string and some data. BOOM, you've got some HTML.

```
var ejs = require('ejs'),
    people = ['geddy', 'neil', 'alex'],
    html = ejs.render('<%= people.join(", "); %>', {people: people});
```

#### Browser support 浏览器支持

Download a browser build from the latest release, and use it in a script tag.
```
<script src="ejs.js"></script>
<script>
  var people = ['geddy', 'neil', 'alex'],
      html = ejs.render('<%= people.join(", "); %>', {people: people});
</script>
```

Docs 帮助文档
-----------

#### Example 示例

```
<% if (user) { %>
  <h2><%= user.name %></h2>
<% } %>
```

#### Usage 用法

```
var template = ejs.compile(str, options);
template(data);
// => Rendered HTML string

ejs.render(str, data, options);
// => Rendered HTML string
```

#### Options 选项

* ```cache``` Compiled functions are cached, requires ```filename```
* ```filename``` Used by ```cache``` to key caches, and for includes
* ```context``` Function execution context
* ```compileDebug``` When ```false``` no debug instrumentation is compiled
* ```client``` Returns standalone compiled function
* ```delimiter``` Character to use with angle brackets for open/close
* ```debug``` Output generated function body
* ```_with``` Whether or not to use ```with() {}``` constructs. If ```false```then the locals will be stored in the ```locals``` object.

* cache 表示编译过的函数会被缓存，需要 filename
* filename 表示被 cache 用做缓存的键，用于包含
* context 表示函数的执行上下文
* compileDebug 如果值为 false，不会编译调试用的工具
* client 表示返回独立的编译后的函数
* delimiter 表示开启或者闭合尖括号所用的字符
* debug 表示输出生成的函数体
* _with 表示是否使用 ```with() {}``` 结构。如果为 false 则局部数据会储存在 locals 对象中


#### Tags 标签

* <% 'Scriptlet' tag, for control-flow, no output
* <%= Outputs the value into the template (HTML escaped)
* <%- Outputs the unescaped value into the template
* <%# Comment tag, no execution, no output
* <%% Outputs a literal '<%'
* %> Plain ending tag
* -%> Trim-mode ('newline slurp') tag, trims following newline

* <% 'Scriptlet' 标签, 用于控制流，没有输出
* <%= 向模板输出值（带有转义）
* <%- 向模板输出没有转义的值
* <%# 注释标签，不执行，也没有输出
* <%% 输出字面的 '<%'
* %> 普通的结束标签
* -%> Trim-mode ('newline slurp') 标签, 移除随后的换行符

#### Includes 包含

Includes are relative to the template with the include call. (This requires the 'filename' option.) For example if you have "./views/users.ejs" and "./views/user/show.ejs" you would use <%- include('user/show'); %>.

包含要么是绝对路径，或者如果不是的话，被视为相对于调用 include 的模板的路径（需要 filename 选项）。 例如，你在 ./views/users.ejs 中包含 ./views/user/show.ejs，你应该使用 <%- include('user/show') %>。

You'll likely want to use the raw output tag (<%-) with your include to avoid double-escaping the HTML output.
你可能会用到原始输出标签（<%-）避免二次转义HTML输出。

```
<ul>
  <% users.forEach(function(user){ %>
    <%- include('user/show', {user: user}); %>
  <% }); %>
</ul>
```

#### Custom delimiters 自定义分隔符

Custom delimiters can be applied on a per-template basis, or globally:
自定义分隔符可以以模板为单位应用，或者全局:

```
var ejs = require('ejs'),
    users = ['geddy', 'neil', 'alex'];

// Just one template
ejs.render('<?= users.join(" | "); ?>', {users: users},
    {delimiter: '?'});
// => 'geddy | neil | alex'

// Or globally
ejs.delimiter = '$';
ejs.render('<$= users.join(" | "); $>', {users: users});
// => 'geddy | neil | alex'
```

