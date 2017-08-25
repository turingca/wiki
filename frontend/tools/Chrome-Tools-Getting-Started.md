Getting Started 入门指南
======================

Overview 概述
------------

[link](https://developers.google.com/web/tools/setup/)

Set up your workspace to include a good editor, debugging, and build tools for the multi-device web.

让您的工作区包含适用于多设备网页的优秀编辑器、调试功能和构建工具。

Time is a huge factor in staying productive. Your development environment is where you spend most of yours. Set yourself up for success by including a strong, extensible editor and powerful debugging & development tools.

* Setup Your Editor
* Setup Persistence with DevTools Workspaces
* Setup CSS and JS Preprocessors
* Setup Command Line Shortcuts
* Setup Browser Extensions
* Setup Your Build Tools

When you're done, continue to learn more about the Chrome Developer Tools (DevTools), Chrome's built-in tool that helps you develop, test, and debug your pages.

时间是保持高效的重要因素。您在开发环境中花费的时间最多。通过包含强大、可扩展的编辑器以及强有力的调试与开发工具，让自己为成功做好准备。

* 设置您的编辑器
* 使用DevTools的工作区设置持久化
* 设置 CSS 与 JS 预处理器
* 设置命令行快捷键
* 设置浏览器扩展程序
* 设置构建工具

完成后，继续详细了解 Chrome Developer Tools (DevTools)，它是 Chrome 内置的工具，可以帮助您开发、测试和调试页面。

Set Up Your Editor 设置您的编辑器
------------------------------

[link](https://developers.google.com/web/tools/setup/setup-editor)

Your code editor is your main development tool; you use it to write and save lines of code. Write better code faster by learning your editor's shortcuts and installing key plugins.

TL;DR

* Choose an editor that lets you customize shortcuts and has lots of plugins to help you write better code.
* Make use of the package manager to make it easier to discover, install, and update plugins.
* Install plugins that help keep you productive during development; start with the recommendations in this guide.

代码编辑器是您的主要开发工具；可以使用代码编辑器编写和保存代码行。了解代码编辑器的快捷键并安装主要插件可以更快地编写出更好的代码。

TL;DR

* 选择一个能够让您自定义快捷键并拥有许多插件的编辑器，以便帮助您编写更好的代码。
* 使用软件包管理器，更轻松地发现、安装和更新插件。
* 安装可以让您在开发期间提高效率的插件；请从此指南中的推荐开始。

**Install Sublime text editor 安装 Sublime 文本编辑器**

Sublime is a great editor with a solid base level of functionality which makes writing code a pleasure. You can install a package manager that makes it easy to install plugins and add new functionality.

There are currently two download options for Sublime Text, either version 2 or version 3. Version 3 is pretty stable and will give you access to packages not available in Sublime Text 2, however you may find version 2 more reliable.

Note: Rob Dodson's blog post on how to get to know and love Sublime is a great reference for getting the most out of your editor. The concepts are relevant to any text editor, not just Sublime.

Sublime 是一款非常优秀的编辑器，具有强大的功能，让编写代码充满乐趣。 您可以安装软件包管理器，轻松地安装插件和添加新功能。

Sublime Text 当前有两种下载选项，版本 2 或版本 3。版本 3 非常稳定，让您可以访问 Sublime Text 2 不支持的软件包，不过您可能会发现版本 2 更加可靠。

注：Rob Dodson 有关如何了解和爱上 Sublime 的博文是充分利用编辑器一个非常好的参考。这些概念与所有文本编辑器相关，而不仅仅与 Sublime 相关。

**Why use a package manager? 为什么要使用软件包管理器？**

Package managers make it easy to find, install, and keep packages & plugins up-to-date.

You can install a Package Manager for Sublime by following these instructions https://packagecontrol.io/installation.

You only need to do this once, after which see below for our recommended list of plugins.

使用软件包管理器，您可以轻松地查找、安装和更新软件包与插件。

您可以按照这些说明为 Sublime 安装 Package Manager https://packagecontrol.io/installation。

您只需执行一次操作，之后请参见下方我们推荐的插件列表。

**Install plugins 安装插件**

Plugins help you stay more productive. What are the things you keep having to go back out to other tools to do?

Linting - there's a plugin for that. Showing what changes haven't been committed - there are plugins for that. Integration with other tools, such as GitHub, there are plugins for that.

Package managers make it very easy to find, install, and update plugins:

1. In the Sublime Text editor, open your package manager (ctrl+shift+p).
2. Enter 'Install Package'.
3. Enter the name of the plugin you are looking for (or else browse all plugins).

Check out these trending lists of Sublime Text plugins. Here are the plugins we love and recommend you install because they help you speed up your development:

插件可以帮助您提高效率。您必须退回去使用其他工具执行的任务是什么？

Linting（检查代码潜在问题）- 有一个插件可以执行这项任务。显示一些更改未被提交 - 有一些插件可以解决这个问题。与其他工具集成（如 GitHub），许多插件都可以实现这个目标。

利用软件包管理器，您可以轻松地查找、安装和更新插件：

在 Sublime Text 编辑器中，打开您的软件包管理器 (ctrl+shift+p)。

1. 输入“Install Package”。
2. 输入您正在查找的插件名称（或者浏览所有插件）。
3. 查看 Sublime Text 插件趋势列表。

这里是一些我们喜爱并推荐您安装的一些插件，它们能够帮助您加快开发速度：

**Autoprefixer**

If you want a quick way to add vendor prefixes to your CSS, you can do so with this handy plugin.

Write CSS, ignoring vendor prefixes and when you want to add them, hit ctrl+shift+p and type Autoprefix CSS.

We cover how you can automate this in your build process, that way your CSS stays lean and you don't need to remember to hit ctrl+shift+p.

如果想要快速地将供应商前缀添加到 CSS，您可以使用这款方便的插件。

编写 CSS，忽略供应商前缀，当您想要添加它们时，按 ctrl+shift+p，然后键入 Autoprefix CSS。

我们会介绍如何在构建流程中实现这项操作的自动化，这样，您的 CSS 就会始终保持简洁，您无需记得要按 ctrl+shift+p。

**ColorPicker**

Pick any color from the palette and add it to your CSS with ctrl+shift+c.

从调色板中选取颜色，然后通过按 ctrl+shift+c 将其添加至您的 CSS。

**Emmet**

Add some useful keyboard shortcuts and snippets to your text editor. Check out the video on [Emmet.io](https://emmet.io/) for an intro into what it can do (a personal favorite is the 'Toggle Comment' command).

为您的文本编辑器添加一些有用的键盘快捷键和代码段。您可以在[Emmet.io](https://emmet.io/) 上观看视频，了解它的用途（个人比较喜欢的是“Toggle Comment”命令）。

**HTML-CSS-JS prettify**

This extension gives you a command to format your HTML, CSS and JS. You can even prettify your files whenever your save a file.

此扩展程序为您提供了可以设置 HTML、CSS 和 JS 格式的命令。无论何时保存文件，您都可以修饰文件 ctrl+shift+h。

**Git Gutter**

Add a marker in the gutter wherever there is a change made to a file.

文件有更改时，可以在 gutter 中添加标记。

**Gutter Color**

Note: This is only available in Sublime Text 3

Gutter Color shows you a small color sample next to your CSS.

The plugin requires ImageMagick. If you are on Mac OS X, we recommend trying the installer from [CactusLabs](http://cactuslab.com/imagemagick/) (you may need to restart your machine to get it working).

注：仅适用于 Sublime Text 3

Gutter Color 可以在 CSS 旁为您显示小色样。

此插件需要 ImageMagick。如果使用 Mac OS X，我们建议您尝试 [CactusLabs](http://cactuslab.com/imagemagick/) 的安装程序（您可能需要重启计算机才能使其工作）。


Set Up Persistence with DevTools Workspaces 使用 DevTools 的工作区设置持久化
------------------------------------------------------------------------

[link](https://developers.google.com/web/tools/setup/setup-workflow)

Set up persistent authoring in Chrome DevTools so you can both see your changes immediatedly and save those changes to disk.

Chrome DevTools lets you change elements and styles on a web page and see your changes immediately. By default, refresh the browser and the changes go away unless you've manually copied and pasted them to an external editor.

Workspaces lets you persist those changes to disk without having to leave Chrome DevTools. Map resources served from a local web server to files on a disk and view changes made to those files as if they were being served.

TL;DR

* Don't manually copy changes to local files. Use workspaces to persist changes made in DevTools to your local resources.
* Stage your local files to your browser. Map files to URLs.
* Once persistent workspaces are set-up, style changes made in the Elements panel are persisted automatically; DOM changes aren't. Persist element changes in the Sources panel instead.

在 Chrome DevTools 中设置永久制作，以便立即查看更改和将这些更改保存到磁盘中。

利用 Chrome DevTools，您可以更改网页上的元素和样式并立即查看更改。默认情况下，刷新浏览器后更改消失，除非您将其手动复制并粘贴到外部编辑器中。

通过工作区，您可以将这些更改保存到磁盘中，而不用离开 Chrome DevTools。将本地网络服务器提供的资源映射到磁盘上的文件中，并实时查看对这些文件的更改。

TL;DR

* 请勿将这些更改手动复制到本地文件中。使用工作区将在 DevTools 中进行的更改保存到您的本地资源中。
* 将您的本地文件暂存到浏览器中。将文件映射到网址。
* 设置好永久工作区后，在 Elements 面板中进行的样式更改将自动保留；DOM 更改则不会。在 Sources 元素面板中保留元素更改。

**Add local source files to workspace将本地源文件添加到工作区**

To make a local folder's source files editable in the Sources panel:

1. Right-click in the left-side panel.
2. Select Add Folder to Workspace.
3. Choose location of local folder that you want to map.
4. Click Allow to give Chrome access to the folder.

Typically, the local folder contains the site's original source files that were used to populate the site on the server. If you do not want to change those original files via the workspace, make a copy of the folder and specify it as the workspace folder instead.

要将本地文件夹的源文件设置为可以在 Sources 面板中修改，请执行以下操作：

1. 右键点击左侧面板。
2. 选择 Add Folder to Workspace。
3. 选择您想要映射的本地文件夹的位置。
4. 点击 Allow，授予 Chrome 访问该文件夹的权限。

通常，本地文件夹包含网站的原始源文件，用于在服务器上填充网站。如果您不希望通过工作区更改这些原始文件，请复制文件夹并将其指定为工作区文件夹。

**Stage persisted changes 暂存保留的更改**

You've already mapped your local folder to your workspace, but the browser is still serving the network folder contents. To automatically stage persistent changes in the browser, map local files in the folder to a URL:

1. Right-click or Control+click on a file in the Sources left-side panel.
2. Choose Map to File System Resource.
3. Select the local file in the persistent workspace.
4. Reload the page in Chrome.

Thereafter, Chrome loads the mapped URL, displaying the workspace contents instead of the network contents. Work directly in the local files without having to repeatedly switch between Chrome and an external editor.

您已将本地文件夹映射到工作区中，但浏览器仍在提供网络文件夹内容。要将永久更改自动暂存到浏览器中，请将文件夹中的本地文件映射到网址：

1. 右键点击或者在按住 Ctrl 的同时点击 Sources 左侧面板中的文件。
2. 选择 Map to File System Resource。
3. 选择永久工作区中的本地文件。
4. 在 Chrome 中重新加载页面。

之后，Chrome会加载映射的网址，同时显示工作区内容，而不是网络内容。这样，您可以直接在本地文件中操作，而不必在 Chrome 与外部编辑器之间重复切换。

**Limitations 限制**

As powerful as Workspaces are, there are some limitations you should be aware of.

* Only style changes in the Elements panel are persisted; changes to the DOM are not persisted.
* Only styles defined in an external CSS file can be saved. Changes to element.style or to inline styles are not persisted. (If you have inline styles, they can be changed on the Sources panel.)
* Style changes in the Elements panel are persisted immediately without an explicit save -- Ctrl + S or Cmd + S (Mac) -- if you have the CSS resource mapped to a local file.
* If you are mapping files from a remote server instead of a local server, when you refresh the page, Chrome reloads the page from the remote server. Your changes still persist to disk and are reapplied if you continue editing in Workspaces.
* You must use the full path to a mapped file in the browser. Even your index files must include .html in the URL, in order to see the staged version.

尽管工作区功能强大，您仍应当注意一些限制。

* 只有 Elements 面板中的样式更改会保留；对 DOM 的更改不会保留。
* 仅可以保存在外部 CSS 文件中定义的样式。对 element.style 或内嵌样式的更改不会保留。（如果您有内嵌样式，可以在 Sources 面板中对它们进行更改。）
* 如果您有映射到本地文件的CSS资源，在Elements面板中进行的样式更改无需显式保存即会立即保留Ctrl + S 或者 Cmd + S (Mac)。
* 如果您正在从远程服务器（而不是本地服务器）映射文件，Chrome 会从远程服务器重新加载页面。您的更改仍将保存到磁盘，并且如果您在工作区中继续编辑，这些更改将被重新应用。
* 您必须在浏览器中使用映射文件的完整路径。要查看暂存版本，您的索引文件在网址中必须包含 .html。

**Local file management**

In addition to editing existing files, you can also add and delete files in the local mapped directory you’re using for Workspaces.

除了修改现有文件外，您还可以在为工作区使用的本地映射目录中添加和删除文件。

**Add file 添加文件**

To add a file:

1. Right-click a folder in the left Sources pane.
2. Select New File.
3. Type a name for the new file including its extension (e.g., newscripts.js) and press Enter; the file is added to the local folder.

要添加文件，请执行以下操作：

1. 右键点击 Sources 左侧窗格中的文件夹。
2. 选择 New File。
3. 为新文件键入一个包含扩展名的名称（例如 newscripts.js）并按 Enter；文件将添加到本地文件夹中。

**Delete file 删除文件**

To delete a file:

1. Right-click on the file in the left Sources pane.
2. Choose Delete and click Yes to confirm.

要删除文件，请执行以下操作：

1. 右键点击 Sources 左侧窗格中的文件。
2. 选择 Delete 并点击 Yes 确认。

**Back up a file 备份文件**

Before making substantial changes to a file, it's useful to duplicate the original for back-up purposes.

To duplicate a file:

1. Right-click on the file in the left Sources pane.
2. Choose Make a Copy....
3. Type a name for the file including its extension (e.g., mystyles-org.css) and press Enter.

对文件进行重大更改前，复制原始文件进行备份非常有用。

要复制文件，请进行以下操作：

1. 右键点击 Sources 左侧窗格中的文件。
2. 选择 Make a Copy...。
3. 为文件键入一个包含扩展名的名称（例如 mystyles-org.css）并按 Enter。

**Refresh 刷新**

When you create or delete files directly in Workspaces, the Sources directory automatically refreshes to show the file changes. To force a refresh at any time, right-click a folder and choose Refresh.

This is also useful if you change files that are concurrently open in an external editor and want the changes to show up in DevTools. Usually DevTools catches such changes automatically, but if you want to be certain, just refresh the folder as described above.

直接在工作区中创建或删除文件时，Sources 目录将自动刷新以显示文件更改。要随时强制刷新，请右键点击文件夹并选择 Refresh。

如果您在外部编辑器中更改当前正在打开的文件，并且希望更改显示在 DevTools 中，刷新操作也非常有用。DevTools 通常可以自动捕捉此类更改，但是如果您希望确保万无一失，只需按上文所述刷新文件夹。

**Search for files or text 搜索文件或文本**

To search for a loaded file in DevTools, press Ctrl + O or Cmd + O (Mac) to open a search dialog. You can still do this in Workspaces, but the search is expanded to both the remote loaded files and the local files in your Workspace folder.

To search for a string across files:

1. Open the search window: click the Show Drawer button Show drawer and then click the Search; or press Ctrl + Shift + F or Cmd + Opt + F (Mac).
2. Type a string into the search field and press Enter.
3. If the string is a regular expression or needs to be case-insensitive, click the appropriate box.

The search results are shown in the Console drawer, listed by file name, with the number of matches in each file indicated. Use the Expand Expand and Collapse Collapse arrows to expand or collapse the results for a given file.

要在 DevTools 中搜索已加载的文件，请按 Ctrl + O 或者 Cmd + O (Mac) 打开搜索对话框。您仍然可以在工作区中进行此操作，不过，搜索范围将扩展到 Workspace 文件夹中的远程已加载文件和本地文件。

要在多个文件中搜索某个字符串，请执行以下操作：

1. 打开搜索窗口：点击 Show Drawer 按钮 Show Drawer ，然后点击 Search；或者按 Ctrl + Shift + F 或 Cmd + Opt + F (Mac)。
2. 将字符串键入搜索字段并按 Enter。
3. 如果字符串是一个正则表达式或者需要不区分大小写，请点击相应的框。

搜索结果将显示在 Console 抽屉中并按文件名列示，同时指示匹配数量。使用展开 展开和折叠 折叠箭头可以展开或折叠给定文件的结果。


Set Up CSS and JS Preprocessors 设置 CSS 与 JS 预处理器
-----------------------------------------------------

[link](https://developers.google.com/web/tools/setup/setup-preprocessors)

CSS preprocessors such as Sass, as well as JS preprocessors and transpilers can greatly accelerate your development when used correctly. Learn how to set them up.

TL;DR

* Preprocessors let you use features in CSS and JavaScript that your browser doesn't support natively, for example, CSS variables.
* If you're using preprocessors, map your original source files to the rendered output using Source Maps.
* Make sure your web server can serve Source Maps.
Use a supported preprocessor to automatically generate Source Maps.

正确使用 CSS 预处理器（如 Sass、JS 预处理器和转译器）可以极大地提高您的开发速度。了解如何设置。

TL;DR

* 预处理器让您可以使用浏览器原生不支持的 CSS 和 JavaScript 中的功能，如 CSS 变量。
* 如果您使用预处理器，可以使用 Source Maps 将原始源文件映射到渲染的输出。
* 确保您的网络服务器能够提供 Source Maps。
* 使用支持的预处理器自动生成 Source Maps。

**What's a preprocessor? 什么是预处理器？**

A preprocessor takes an arbitrary source file and converts it into something that the browser understands.

With CSS as output, they are used to add features that otherwise wouldn't exist (yet): CSS Variables, Nesting and much more. Notable examples in this category are [Sass](http://sass-lang.com/), [Less](http://lesscss.org/) and [Stylus](http://stylus-lang.com/).

With JavaScript as output, they either convert (compile) from a completely different language, or convert (transpile) a superset or new language standard down to today's standard. Notable examples in this category are [CoffeeScript](http://coffeescript.org/) and ES6 (via [Babel](https://babeljs.io/)).

预处理器可以获取任意的源文件，并将其转换成浏览器可以识别的内容。

输出为 CSS 时，可以使用预处理器添加以下功能（如果不使用预处理器，则不会存在这些功能）：CSS 变量、嵌套，等等。这个类别中显著的例子是 [Sass](http://sass-lang.com/)、[Less](http://lesscss.org/) 和 [Stylus](http://stylus-lang.com/)。

输出为 JavaScript 时，它们可以从完全不同的语言转换（编译），或者将超集或新语言标准转换（转译）为当前的标准。这个类别中显著的例子是 [CoffeeScript](http://coffeescript.org/) 和 ES6（通过 [Babel](https://babeljs.io/)）。

**Debugging and editing preprocessed content 调试和修改预处理的内容**

As soon as you are in the browser and use DevTools to edit your CSS or debug your JavaScript, one issue becomes very apparent: what you are looking at does not reflect your source, and doesn't really help you fix your problem.

In order to work around, most modern preprocessors support a feature called Source Maps.

What are Source Maps?

A source map is a JSON-based mapping format that creates a relationship between a minified file and its sources. When you build for production, along with minifying and combining your JavaScript files, you generate a source map that holds information about your original files.

How Source Maps work

For each CSS file it produces, a CSS preprocessor generates a source map file (.map) in addition to the compiled CSS. The source map file is a JSON file that defines a mapping between each generated CSS declaration and the corresponding line of the source file.

Each CSS file contains an annotation that specifies the URL of its source map file, embedded in a special comment on the last line of the file:

```/*# sourceMappingURL=<url> */```
For instance, given an Sass source file named styles.scss:

```
%$textSize: 26px;
$fontColor: red;
$bgColor: whitesmoke;
h2 {
    font-size: $textSize;
    color: $fontColor;
    background: $bgColor;
}
```
Sass generates a CSS file, styles.css, with the sourceMappingURL annotation:

```
h2 {
  font-size: 26px;
  color: red;
  background-color: whitesmoke;
}
/*# sourceMappingURL=styles.css.map */
Below is an example source map file:
```

```
{
  "version": "3",
  "mappings":"AAKA,EAAG;EACC,SAAS,EANF,IAAI;EAOX,KAAK"
  "sources": ["sass/styles.scss"],
  "file": "styles.css"
}
```

只要您在浏览器中且使用 DevTools 修改您的 CSS 或调试 JavaScript，就会出现一个非常明显的问题：您正在浏览的内容没有反映源，而且不会真的帮助您解决问题。

为了解决问题，最现代的预处理器支持一种名称为 Source Maps 的功能。

什么是 Source Maps？

源映射是一种基于 JSON 的映射格式，可以在缩小的文件与其源之间建立关系。如果您为生产而构建，缩小和合并 JavaScript 文件时，还会生成包含原始文件相关信息的源映射。

Source Maps 的工作方式

对于生成的每个 CSS 文件，除了编译的 CSS，CSS 预处理器还会生成源映射文件 (.map)。源映射文件是 JSON 文件，会在每个生成的 CSS 声明与源文件相应行之间定义映射。

每个 CSS 文件均包含指定源映射文件网址的注解，嵌入文件最后一行上的特殊注释中：

```/*# sourceMappingURL=<url> */```
例如，假设存在一个名为 styles.scss 的 Sass 源文件：

```
%$textSize: 26px;
$fontColor: red;
$bgColor: whitesmoke;
h2 {
    font-size: $textSize;
    color: $fontColor;
    background: $bgColor;
}
```

Sass 会生成 CSS 文件 styles.css，包含 sourceMappingURL 注解：

```
h2 {
  font-size: 26px;
  color: red;
  background-color: whitesmoke;
}
/*# sourceMappingURL=styles.css.map */
```

下方为一个源映射文件示例：

```
{
  "version": "3",
  "mappings":"AAKA,EAAG;EACC,SAAS,EANF,IAAI;EAOX,KAAK"
  "sources": ["sass/styles.scss"],
  "file": "styles.css"
}
```

**Verify web server can serve Source Maps 验证网络服务器可以提供 Source Maps**

Some web servers, like Google App Engine for example, require explicit configuration for each file type served. In this case, your Source Maps should be served with a MIME type of application/json, but Chrome will actually [accept any content-type](https://stackoverflow.com/questions/19911929/what-mime-type-should-i-use-for-source-map-files), for example application/octet-stream.

Bonus: Source mapping via custom header

If you don't want an extra comment in your file, use an HTTP header field on the minified JavaScript file to tell DevTools where to find the source map. This requires configuration or customization of your web server and is beyond the scope of this document.

X-SourceMap: /path/to/file.js.map
Like the comment, this tells DevTools and other tools where to look for the source map associated with a JavaScript file. This header also gets around the issue of referencing Source Maps in languages that don't support single-line comments.

一些网络服务器（如 Google App 引擎）需要适用于提供的每个文件类型的显式配置。这种情况下，需要为您的 Source Maps 提供 MIME 类型的 application/json，但实际上 Chrome 可以[接受任何内容类型](https://stackoverflow.com/questions/19911929/what-mime-type-should-i-use-for-source-map-files)，例如 application/octet-stream。

奖励：通过自定义标题进行源映射

如果您不希望文件中存在其他注释，请使用缩小的 JavaScript 文件上的 HTTP 标题字段告知 DevTools 在哪里可以找到源映射。这需要配置或自定义您的网络服务器，不在本文档的介绍范围内。

```X-SourceMap: /path/to/file.js.map```

像注释一样，它也可以告知 DevTools 和其他工具在哪里可以查找与 JavaScript 文件关联的源映射。此标题也可以解决以不支持单行注释的语言引用 Source Maps 的问题。

**Supported preprocessors**

Just about any compiled to JavaScript language has an option to generate Source Maps today – including Coffeescript, TypeScript, JSX and many more. You can additionally use Source Maps on the server side within Node, in our CSS with via Sass, Less and more, using browserify which gives you node-style require abilities, and through minification tools like uglify-js which also adds the neat ability to generate multi-level Source Maps.

JavaScript

| Compiler | Command | Instructions |
|----------|---------|--------------|
CoffeeScript    $ coffee -c square.coffee -m    The -m (--map) flag is all it takes for the compiler to output a source map, it will also handle adding the sourceMapURL comment pragma for you to the outputted file.
TypeScript  $ tsc -sourcemap square.ts  The -sourcemap flag will generate the map and add the comment pragma.
Traceur $ traceur --source-maps=[file|inline]   With --source-maps=file, every output file ending in .js will have a sourcemap file ending in .map; with source-maps='inline', every output file ending in .js will end with a comment containing the sourcemap encoded in a data: URL.
Babel   $ babel script.js --out-file script-compiled.js --source-maps   Use --source-maps or -s to generate Source Maps. Use --source-maps inline for inline Source Maps.
UglifyJS    $ uglifyjs file.js -o file.min.js --source-map file.min.js.map  That is the very basic command needed to generate a source map for 'file.js'. This will also add the comment pragma to output file.

