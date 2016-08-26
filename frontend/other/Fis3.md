前言
------

[FIS](http://fis.baidu.com)

[官方文档](http://fis.baidu.com/fis3/docs/beginning/intro.html)

[Github传送门](https://github.com/fex-team/fis3)

介绍
-----

FIS3是面向前端的工程构建工具。解决前端工程中性能优化、资源加载（异步、同步、按需、预加载、依赖管理、合并、内嵌）、模块化开发、自动化工具、开发规范、代码部署等问题。

安装
----

**安装Node和NPM**

详细过程参考[官网](https://nodejs.org)

Ubuntu 用户使用apt-get安装node后，安装的程序名叫nodejs，需要软链成node
Windows用户安装完成后需要在CMD下确认是否能执行node和npm

node -v 查看当前node版本
node -h 查看nodejs的帮助 

NPM（node package manager）

[对npm的介绍](http://www.92fenxiang.com/175.html)

npm -v  查看当前npm版本
npm config ls -l  查看所有NPM的设置
npm prefix -g     查看全局安装路径
npm cache clean   清理缓存

**安装Fis3**

[NPM安装FIS遇到的问题](https://github.com/fex-team/fis/issues/565)

npm install -g fis3 安装到全局目录，如果npm长时间运行无响应，推荐使用cnpm来安装

npm install -g fis3 --disturl=http://registry.npm.taobao.org/mirrors/node --registry=http://registry.npm.taobao.org

**升级Fis3**

npm update -g fis3

**重装fis3**

npm install -g fis3

构建
----

由fis3-command-release插件提供构建能力，FIS3的构建不会修改源码，而是会通过用户设置，将构建结果输出到指定的目录。

**命令**

进入项目根目录，执行命令，进行构建。项目根目录：FIS3 配置文件（默认fis-conf.js）所在的目录为项目根目录。

```
fis3 release -d <path>
<path> 任意目录
fis3 release -h 获取更多参数
```

构建发布到项目目录的output目录下
```
fis3 release -d ./output
```

构建发布到项目父级目录的 dist 子目录下
```
fis3 release -d ../dist
```

发布到其他盘（Windows）
```
fis3 release -d D:\output
```

**资源定位**

构建过程中对资源URI进行了替换，替换成了绝对URL。通俗点讲就是相对路径换成了绝对路径。这是一个FIS的很重要的特性：资源定位。资源定位能力，可以有效地分离开发路径与部署路径之间的关系，工程师不再关心资源部署到线上之后去了哪里，变成了什么名字，这些都可以通过配置来指定。而工程师只需要使用相对路径来定位自己的开发资源即可。这样的好处是资源可以发布到任何静态资源服务器的任何路径上，而不用担心线上运行时找不到它们，而且代码具有很强的可移植性，甚至可以从一个产品线移植到另一个产品线而不用担心线上部署不一致的问题。

在默认不配置的情况下只是对资源相对路径修改成了绝对路径。通过配置文件可以轻松分离开发路径（源码路径）与部署路径。比如我们想让所有的静态资源构建后到static目录下。
```javascript
//配置配置文件，注意，清空所有的配置，只留下以下代码即可。
fis.match('*.{png,js,css}', {
  release: '/static/$0'
});
```

以上示例只是更改部署路径，还可以给url添加CDN-domain或者添加文件指纹（时间戳或者md5戳）。再次强调，FIS3的构建是不会对源码做修改的，而是构建产出到了另外一个目录，并且构建的结果才是用来上线使用的。可能有人会疑惑，修改成了绝对路径，本地如何调试开发？下一节介绍调试的方法。

**配置文件**

默认配置文件为fis-conf.js，FIS3编译的整个流程都是通过配置来控制的。FIS3定义了一种类似CSS的配置方式。固化了构建流程，让工程构建变得简单。

```javascript
fis.match()
```

首先介绍设置规则的配置接口
```
fis.match(selector, props);
```
selector：FIS3把匹配文件路径的路径作为selector，匹配到的文件会分配给它设置的props。关于selector语法，请参看Glob说明。props：编译规则属性，包括文件属性和插件属性。

**重要特性**

规则覆盖：假设有两条规则A和B，它俩同时命中了文件test.js，如果A在B前面，B的属性会覆盖A的同名属性。不同名属性追加到test.js的File对象上。

```javascript
//A
fis.match('*', {
  release: '/dist/$0'
});
//B
fis.match('test.js', {
  useHash: true,
  release: '/dist/js/$0'
})
```

那么test.js分配到的属性
```javascript
{
  useHash: true, // B
  release: '/dist/js/$0' // B
}
```

```javascript
fis.media()
```

fis.media()接口提供多种状态功能，比如有些配置是仅供开发环境下使用，有些则是仅供生产环境使用的。
```javascript
fis.match('*', {
  useHash: false
});
fis.media('prod').match('*.js', {
  optimizer: fis.plugin('uglify-js')
});
```

```javascript
fis3 release <media>
```

<media>配置的media值
```javascript
fis3 release prod
```
编译时使用prod指定的编译配置，即对js进行压缩。

如上，fis.media()可以使配置文件变为多份（多个状态，一个状态一份配置）。
```javascript
fis.media('rd').match('*', {
  deploy: fis.plugin('http-push', {
    receiver: 'http://remote-rd-host/receiver.php'
  })
});
fis.media('qa').match('*', {
  deploy: fis.plugin('http-push', {
    receiver: 'http://remote-qa-host/receiver.php'
  })
});
```
push到RD的远端机器上
```
fis3 release rd 
```
push到QA的远端机器上
```
fis3 release qa 
```

media dev已经被占用，默认情况下不加<media>参数时默认为dev

我们执行fis3 inspect来查看文件命中属性的情况。
fis3 inspect 是一个非常重要的命令，可以查看文件分配到的属性，这些属性决定了文件将如何被编译处理。

```javascript
~ /app.js
 -- useHash false `*.js`   (0th)

 ~ /img/list-1.png
 -- useHash false `*.png`   (2th)

 ~ /img/list-2.png
 -- useHash false `*.png`   (2th)

 ~ /img/logo.png
 -- useHash false `*.png`   (2th)

 ~ /style.css
 -- useHash false `*.css`   (1th)

 ~ ::package
 -- empty
```

查看特定media的分配情况
```
fis3 inspect <media> 
```

**文件指纹**

文件指纹，唯一标识一个文件。在开启强缓存的情况下，如果文件的URL不发生变化，无法刷新浏览器缓存。一般都需要通过一些手段来强刷缓存，一种方式是添加时间戳，每次上线更新文件，给这个资源文件的URL添加上时间戳。
```html
<img src="a.png?t=12012121">
```

而FIS3选择的是添加MD5戳，直接修改文件的URL，而不是在其后添加query。
对js、css、png图片引用URL添加md5戳，配置如下；
```javascript
//清除其他配置，只剩下如下配置
fis.match('*.{js,css,png}', {
  useHash: true
});
```

构建到../output目录下看变化。
```javascript
fis3 release -d ../output
```
构建出的文件携带了md5戳，对应的引入url也带上了md5戳。


**压缩资源**

为了减少资源网络传输的大小，通过压缩器对js、css、图片进行压缩是一直以来前端工程优化的选择。在FIS3中这个过程非常简单，通过给文件配置压缩器即可。

```javascript
//清除其他配置，只保留如下配置
fis.match('*.js', {
  //fis-optimizer-uglify-js插件进行压缩，已内置
  optimizer: fis.plugin('uglify-js')
});
fis.match('*.css', {
  //fis-optimizer-clean-css插件进行压缩，已内置
  optimizer: fis.plugin('clean-css')
});
fis.match('*.png', {
  // fis-optimizer-png-compressor插件进行压缩，已内置
  optimizer: fis.plugin('png-compressor')
});
```

构建到 ../output目录下看变化。
```
fis3 release -d ../output
```

查看 ../output目录下已经被压缩过的结果。


**CssSprite图片合并**

压缩了静态资源，我们还可以对图片进行合并，来减少请求数量。FIS3提供了比较简易、使用方便的图片合并工具。通过配置即可调用此工具并对资源进行合并。FIS3构建会对CSS中，路径带?__sprite的图片进行合并。为了节省编译的时间，分配到useSprite: true的CSS文件才会被处理。

默认情况下，对打包css文件启动图片合并功能。
```css
li.list-1::before {
  background-image: url('./img/list-1.png?__sprite');
}
li.list-2::before {
  background-image: url('./img/list-2.png?__sprite');
}
```

```javascript
//启用fis-spriter-csssprites插件
fis.match('::package', {
  spriter: fis.plugin('csssprites')
})
//对CSS进行图片合并
fis.match('*.css', {
  // 给匹配到的文件分配属性 `useSprite`
  useSprite: true
});
```
CssSprites详细配置参见[fis-spriter-csssprites](https://github.com/fex-team/fis-spriter-csssprites)

**功能组合**

我们学习了如何用FIS3做压缩、文件指纹、图片合并、资源定位，现在把这些功能组合起来，配置文件如下；
```javascript
//加md5
fis.match('*.{js,css,png}', {
  useHash: true
});
//启用fis-spriter-csssprites插件，需安装
fis.match('::package', {
  spriter: fis.plugin('csssprites')
})
//对CSS进行图片合并
fis.match('*.css', {
  //给匹配到的文件分配属性`useSprite`
  useSprite: true
});
fis.match('*.js', {
  //fis-optimizer-uglify-js插件进行压缩，已内置
  optimizer: fis.plugin('uglify-js')
});
fis.match('*.css', {
  //fis-optimizer-clean-css插件进行压缩，已内置
  optimizer: fis.plugin('clean-css')
});
fis.match('*.png', {
  //fis-optimizer-png-compressor插件进行压缩，已内置
  optimizer: fis.plugin('png-compressor')
});
```
fis3 release时添加md5、静态资源压缩、css文件引用图片进行合并。

可能有时候开发的时候不需要压缩、合并图片、也不需要hash。那么给上面配置追加如下配置；
```javascript
fis.media('debug').match('*.{js,css,png}', {
  useHash: false,
  useSprite: false,
  optimizer: null
})
```
fis3 release debug 启用media debug的配置，覆盖上面的配置，把诸多功能关掉。


调试
-----

FIS3构建后，默认情况下会对资源的URL进行修改，改成绝对路径。这时候本地双击打开文件是无法正常工作的。这给开发调试带来了绝大的困惑。FIS3内置一个简易WebServer，可以方便调试构建结果。

**目录**

构建时不指定输出目录，即不指定 -d参数时，构建结果被发送到内置WebServer的根目录下。此目录可以通过执行以下命令打开。
```
fis3 server open
```

**发布**

```
fis3 release
```

**启动**

通过
```
fis3 server start
```
来启动本地WebServer，当此Server启动后，会自动浏览器打开http://127.0.0.1:8080，默认监听端口8080。通过执行以下命令得到更多启动参数，可以设置不同的端口号（当8080占用时）
```
fis3 server -h
```

**预览**

启动WebServer以后，会自动打开浏览器，访问http://127.0.0.1:8080，这时即可查看到页面渲染结果。正如所有其他WebServer，FIS3内置的Server是常驻的，如果不重启计算机或者调用命令关闭是不会关闭的。所以后续只需访问对应链接即可，而不需要每次release就启动一次server。

**文件监听**

为了方便开发，FIS3支持文件监听，当启动文件监听时，修改文件会构建发布。而且其编译是增量的，编译花费时间少。FIS3通过对release命令添加-w或者--watch参数启动文件监听功能。
```
fis3 release -w
```
添加-w参数时，程序不会执行终止；停止程序用快捷键CTRL+c

**浏览器自动刷新**

文件修改自动构建发布后，如果浏览器能自动刷新，这是一个非常好的开发体验。FIS3支持浏览器自动刷新功能，只需要给release命令添加-L参数，通常 -w和-L一起使用。
```
fis3 release -wL
```
程序停止用快捷键 CTRL+c

**发布到远端机器**

当我们开发项目后，需要发布到测试机（联调机），一般可以通过如SMB、FTP等上传代码。FIS3默认支持使用HTTP上传代码，首先需要在测试机部署上传接收脚本（或者服务），这个脚本非常简单，现在给出了php的实现版本，可以把它放到测试机上某个Web服务根目录，并且配置一个url能访问到即可。

示例脚本是php脚本，测试机Web需要支持PHP的解析，如果需要其他语言实现，请参考这个php脚本实现，如果嫌麻烦，我们提供了一个node版本的接收端

假定这个URL是：http://cq.01.p.p.baidu.com:8888/receiver.php，那么我们只需要在配置文件配置
```javascript
fis.match('*', {
  deploy: fis.plugin('http-push', {
    receiver: 'http://cq.01.p.p.baidu.com:8888/receiver.php',
    to: '/home/work/htdocs' // 注意这个是指的是测试机器的路径，而非本地机器
  })
})
```
如果你想通过其他协议上传代码，请参考deploy插件开发实现对应协议插件即可。
当执行fis3 release时上传测试机器，可能上传测试机是最后联调时才会有的，更好的做法是设置特定media。
```javascript
//其他配置
fis.media('qa').match('*', {
  deploy: fis.plugin('http-push', {
    receiver: 'http://cq.01.p.p.baidu.com:8888/receiver.php',
    to: '/home/work/htdocs' // 注意这个是指的是测试机器的路径，而非本地机器
  })
});
```
fis3 release qa 上传测试机器
fis3 release 产出到本地测试服务器根目录

**替代内置Server**

FIS3内置了一个WebServer提供给构建后的代码进行调试。如果你自己启动了你自己的WebServer依然可以使用它们。
假设你的WebServer的根目录是/Users/my-name/work/htdocs，那么发布时只需要设置产出目录到这个目录即可。
```
fis3 release -d /Users/my-name/work/htdocs
```
如果想执行fis3 release直接发布到此目录下，可在配置文件配置；
```javascript
fis.match('*', {
  deploy: fis.plugin('local-deliver', {
    to: '/Users/my-name/work/htdocs'
  })
})
```

内置语法
--------

FIS项目曾经历了很久的“努力做好编译工具”的时代。那段时间里，FIS走了很多弯路，那时我们认为前端领域需要很复杂的编译工具才能很好的处理各种开发需求。2013年初，FIS的编译工具非常庞大复杂，日益暴露出来的问题已经开始不再收敛了，这促使FIS小组重新审视FIS的编译系统：满足前端开发需求的最小编译规则集是什么？

前端编译工具有必要那么复杂么？答案是完全没必要！想象一下尺规作图，一把直尺，一只圆规，就可以做出很多基本几何操作。经过FIS团队不断实践总结，我们发现支持前端开发所需要的编译能力只有三种 ：

* 资源定位：获取任何开发中所使用资源的线上路径；
* 内容嵌入：把一个文件的内容(文本)或者base64编码(图片)嵌入到另一个文件中；
* 依赖声明：在一个文本文件内标记对其他资源的依赖关系；

一套前端编译工具，只要实现上述3项编译能力，就可以变得非常易用，代码可维护性瞬间提高很多。

这三种编译能力作为FIS的内置语法提供：

* 资源定位
* 内容嵌入
* 依赖声明

内置语法主要针对html、css、js等三种语言提供不同的编译语法。假设遇到后端模板、异构语言、前端模板等如何让内置语法起效呢？
```javascript
//FIS中前端模板推荐预编译为js，所以应该使用js的内置语法
fis.match('*.tmpl', {
  isJsLike: true
});
```
```javascript
fis.match('*.sass', {
  isCssLike: true
});
```
```javascript
fis.match('*.xxhtml', {
  isHtmlLike: true
})
```

**嵌入资源**

嵌入资源即内容嵌入，可以为工程师提供诸如图片base64嵌入到css、js里，前端模板编译到js文件中，将js、css、html拆分成几个文件最后合并到一起的能力。有了这项能力，可以有效的减少http请求数，提升工程的可维护性。fis不建议用户使用内容嵌入能力作为组件化拆分的手段，因为声明依赖能力会更适合组件化开发。

**在html中嵌入资源**

在html中可以嵌入其他文件内容或者base64编码值，可以在资源定位的基础上，给资源加?__inline参数来标记资源嵌入需求。

**html中嵌入图片base64**

源码
```html
  <img title="百度logo" src="images/logo.gif?__inline"/>
```
编译后
```html
  <img title="百度logo" src="data:image/gif;base64,R0lGODlhDgGBALMAAGBn6eYxLvvy9PnKyfO...Jzna6853wjKc850nPeoYgAgA7"/>
```

**html中嵌入样式文件**

源码
```html
  <link rel="stylesheet" type="text/css" href="demo.css?__inline">
```
编译后
```html
  <style>img { border: 5px solid #ccc; }</style>
```

**html中嵌入脚本资源**

源码
```html
  <script type="text/javascript" src="demo.js?__inline"></script>
```
编译后
```html
  <script type="text/javascript">console.log('inline file');</script>
```

**html中嵌入页面文件**

源码（推荐使用）
```html
  <link rel="import" href="demo.html?__inline">
```
编译后
```html
  <!-- this is the content of demo.html -->
  <h1>demo.html content</h1>
```

源码
```
（功能同<link ref="import" href="xxx?__inline">语法，此语法为旧语法，不推荐使用 ）
  <!--inline[demo.html]-->
```
编译后
```
  <!-- this is the content of demo.html -->
  <h1>demo.html content</h1>
```

**在js中嵌入资源**

在js中，使用编译函数__inline()来提供内容嵌入能力。可以利用这个函数嵌入图片的base64编码、嵌入其他js或者前端模板文件的编译内容， 这些处理对html中script标签里的内容同样有效。

**在js中嵌入js文件**

源码
```javascript
  __inline('demo.js');
```
编译后
```javascript
  console.log('demo.js content');
```

**在js中嵌入图片base64**

源码
```javascript
  var img = __inline('images/logo.gif');
```
编译后
```javascript
  var img = 'data:image/gif;base64,R0lGODlhDgGBALMAAGBn6eYxLvvy9PnKyfO...Jzna6853wjKc850nPeoYgAgA7';
```

**在js中嵌入其他文本文件**

源码
```javascript
  var css = __inline('a.css');
```
编译后
```javascript
  var css = "body \n{color: red;\n}";
```

**在css中嵌入资源**

与html类似，凡是命中了资源定位能力的编译标记，除了src="xxx"之外，都可以通过添加?__inline编译标记都可以把文件内容嵌入进来。src="xxx"被用在ie浏览器支持的filter内，该属性不支持base64字符串，因此未做处理。

**在css文件中嵌入其他css文件**

源码
```css
  @import url('demo.css?__inline');
```
编译后
```css
  img { border: 5px solid #ccc; };
```

**在css中嵌入图片的base64**

源码
```css
  .style {
      background: url(images/logo.gif?__inline);
  }
```
编译后
```css
  .style {
      background: url(data:image/gif;base64,R0lGODlhDgGBALMAAGBn6eYxLvvy9PnKyfO...Jzna6853wjKc850nPeoYgAgA7);
  }
```

**定位资源**

定位资源能力，可以有效地分离开发路径与部署路径之间的关系，工程师不再关心资源部署到线上之后去了哪里，变成了什么名字，这些都可以通过配置来指定。而工程师只需要使用相对路径来定位自己的开发资源即可。这样的好处是：资源可以发布到任何静态资源服务器的任何路径上而不用担心线上运行时找不到它们，而且代码具有很强的可移植性，甚至可以从一个产品线移植到另一个产品线而不用担心线上部署不一致的问题。

![](img/fis3_uri.png)

**在html中定位资源**

FIS3支持对html中的script、link、style、video、audio、embed等标签的src或href属性进行分析，一旦这些标签的资源定位属性可以命中已存在文件，则把命中文件的url路径替换到属性中，同时可保留原来url中的query查询信息。

例如：
```html
<!--源码：
<img title="百度logo" src="images/logo.gif"/>
编译后-->
<img title="百度logo" src="/images/logo_74e5229.gif"/>

<!--源码：
<link rel="stylesheet" type="text/css" href="demo.css">
编译后-->
<link rel="stylesheet" type="text/css" href="/demo_7defa41.css">

<!--源码：
<script type="text/javascript" src="demo.js"></script>
编译后-->
<script type="text/javascript" src="/demo_33c5143.js"></script>
```
值得注意的是， 资源定位结果可以被fis的配置文件控制，比如添加配置，调整文件发布路径：
```javascript
fis.match('*.{js,css,png,gif}', {
    useHash: true // 开启 md5 戳
});
//所有的js
fis.match('**.js', {
    //发布到/static/js/xxx目录下
    release : '/static/js$0'
});

//所有的css
fis.match('**.css', {
    //发布到/static/css/xxx目录下
    release : '/static/css$0'
});

//所有image目录下的.png，.gif文件
fis.match('/images/(*.{png,gif})', {
    //发布到/static/pic/xxx目录下
    release: '/static/pic/$1$2'
});
```

再次编译得到：

```html
<!--源码：
<img title="百度logo" src="images/logo.gif"/>
编译后-->
<img title="百度logo" src="/static/pic/logo_74e5229.gif"/>

<!--源码：
<link rel="stylesheet" type="text/css" href="demo.css">
编译后-->
<link rel="stylesheet" type="text/css" href="/static/css/demo_7defa41.css">

<!--源码：
<script type="text/javascript" src="demo.js"></script>
编译后-->
<script type="text/javascript" src="/static/js/demo_33c5143.js"></script>
```

我们甚至可以让url和发布目录不一致。比如：
```javascript
fis.match('*.{js,css,png,gif}', {
    useHash: true // 开启 md5 戳
});
//所有的 js
fis.match('**.js', {
    //发布到/static/js/xxx目录下
    release : '/static/js$0',
    //访问url是/mm/static/js/xxx
    url : '/mm/static/js$0'
});

//所有的 css
fis.match('**.css', {
    //发布到/static/css/xxx目录下
    release : '/static/css$0',
    //访问url是/pp/static/css/xxx
    url : '/pp/static/css$0'
});

// 所有image目录下的.png，.gif文件
fis.match('/images/(*.{png,gif})', {
    //发布到/static/pic/xxx目录下
    release: '/static/pic/$1',
    //访问url是/oo/static/baidu/xxx
    url : '/oo/static/baidu$0'
});
```

再次编译得到：

```html
<!--源码：
<img title="百度logo" src="images/logo.gif"/>
编译后-->
<img title="百度logo" src="/oo/static/baidu/logo_74e5229.gif"/>

<!--源码：
<link rel="stylesheet" type="text/css" href="demo.css">
编译后-->
<link rel="stylesheet" type="text/css" href="/pp/static/css/demo_7defa41.css">

<!--源码：
<script type="text/javascript" src="demo.js"></script>
编译后-->
<script type="text/javascript" src="/mm/static/js/demo_33c5143.js"></script>
```

**在js中定位资源**

js语言中，可以使用编译函数 __uri(path) 来定位资源，fis分析js文件或html中的script标签内内容时会替换该函数所指向文件的线上url路径。

源码:
```javascript
var img = __uri('images/logo.gif');
```
编译后
```javascript
var img = '/images/logo_74e5229.gif';
```

源码:
```javascript
var css = __uri('demo.css');
```
编译后
```javascript
var css = '/demo_7defa41.css';
```

源码:
```javascript
var js = __uri('demo.js');
```
编译后
```javascript
var js = '/demo_33c5143.js';
```

资源定位结果可以被fis的配置文件控制，比如添加配置，调整文件发布路径：
```javascript
fis.match('*.{js,css,png,gif}', {
    useHash: true // 开启 md5 戳
});
//所有的js
fis.match('**.js', {
    //发布到/static/js/xxx目录下
    release : '/static/js$0'
});

//所有的css
fis.match('**.css', {
    //发布到/static/css/xxx目录下
    release : '/static/css$0'
});

//所有image目录下的.png，.gif文件
fis.match('/images/(*.{png,gif})', {
    //发布到/static/pic/xxx目录下
    release: '/static/pic/$1'
});
```

再次编译得到：

源码:
```javascript
var img = __uri('images/logo.gif');
```
编译后
```javascript
var img = '/static/pic/logo_74e5229.gif';
```

源码:
```javascript
var css = __uri('demo.css');
```
编译后
```javascript
var css = '/static/css/demo_7defa41.css';
```

源码:
```javascript
var js = __uri('demo.js');
```

编译后
```javascript
var js = '/static/js/demo_33c5143.js';
```


**在css中定位资源**

fis编译工具会识别css文件或html的style标签内容中url(path)以及src=path字段，并将其替换成对应资源的编译后url路径

源码：
```css
@import url('demo.css');
```
编译后
```css
@import url('/demo_7defa41.css');
```

源码：
```css
.style {
  background: url('images/body-bg.png');
}
```
编译后
```css
.style {
  background: url('/images/body-bg_1b8c3e0.png');
}
```

源码：
```css
.style {
  _filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='images/body-bg.png');
}
```
编译后
```css
.style {
  _filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='/images/body-bg_1b8c3e0.png');
}
```

资源定位结果可以被fis的配置文件控制，比如添加配置，调整文件发布路径：
```javascript
fis.match('*.{js,css,png,gif}', {
    useHash: true // 开启 md5 戳
});
//所有的css文件
fis.match('**.css', {
    //发布到/static/css/xxx目录下
    release : '/static/css$0'
});
//所有image目录下的.png，.gif文件
fis.match('/images/(*.{png,gif})', {
    //发布到/static/pic/xxx目录下
    release : '/static/pic/$1$2'
});
```

再次编译得到：

源码：
```css
@import url('demo.css');
```
编译后
```css
@import url('/static/css/demo_7defa41.css');
```

源码：
```css
.style {
  background: url('images/body-bg.png');
}
```
编译后
```css
.style {
  background: url('/static/pic/body-bg_1b8c3e0.png');
}
```

源码：
```css
.style {
  _filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='images/body-bg.png');
}
```
编译后
```css
.style {
  _filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='/static/pic/body-bg_1b8c3e0.png');
}
```

**声明依赖**

声明依赖能力为工程师提供了声明依赖关系的编译接口。FIS3在执行编译的过程中，会扫描这些编译标记，从而建立一张静态资源关系表，资源关系表详细记录了项目内的静态资源id、发布后的线上路径、资源类型以及依赖关系和资源打包等信息。使用FIS3作为编译工具的项目，可以将这张表提交给后端或者前端框架去运行时，根据组件使用情况来按需加载资源或者资源所在的包，从而提升前端页面运行性能。

**在html中声明依赖**

```
用户可以在html的注释中声明依赖关系，这些依赖关系最终会被记录下来，当某个文件中包含字符__RESOURCE_MAP__那么这个记录会被字符串化后替换 __RESOURCE_MAP__。为了方便描述呈现，我们假定项目根目录下有个文件manifest.json包含此字符，编译后会把表结构替换到这个文件中。
```

在项目的index.html里使用注释声明依赖关系：
```
<!--
@require demo.js
@require "demo.css"
-->
```
默认情况下，只有js和css文件会输出到manifest.json表中，如果想将html文件加入表中，需要通过配置useMap让HTML文件加入manifest.json，例如：
```javascript
//fis-conf.js
fis.match('*.html', {
    useMap: true
})
```
配置以下内容到配置文件进行编译
```javascript
//fis-conf.js
fis.match('*.html', {
    useMap: true
});
fis.match('*.{js,css}', {
    //开启 hash
    useHash: true
});
```

查看output目录下的manifest.json文件，则可看到：
```javascript
{
  "res" : {
    "demo.css" : {
        "uri" : "/static/css/demo_7defa41.css",
        "type" : "css"
    },
    "demo.js" : {
        "uri" : "/static/js/demo_33c5143.js",
        "type" : "js",
        "deps" : [ "demo.css" ]
    },
    "index.html" : {
        "uri" : "/index.html",
        "type" : "html",
        "deps" : [ "demo.js", "demo.css" ]
    }
  },
  "pkg" : {}
}
```

**在js中声明依赖**

```
fis支持识别js文件中的注释中的@require字段标记的依赖关系，这些分析处理对html的script标签内容同样有效。
```

```javascript
//demo.js
/**
 * @require demo.css
 * @require list.js
 */
```
经过编译之后，查看产出的manifest.json文件，可以看到：
```
{
  "res" : {
      ...
      "demo.js" : {
          "uri" : "/static/js/demo_33c5143.js",
          "type" : "js",
          "deps" : [ "demo.css", "list.js", "jquery" ]
      },
      ...
  },
  "pkg" : {}
}
```

```
注意，require()不再处理，js中require()留给各种前端模块化方案，假设你选择的是AMD那么就得解析require([])和require()；如果选用的是mod.js 那么就得解析require.async()和require()，其他亦然。
```

**在css中声明依赖**

```
fis支持识别css文件注释中的@require字段标记的依赖关系，这些分析处理对html的style标签内容同样有效。
```

```css
/**
 * demo.css
 * @require reset.css
 */
 ```
经过编译之后，查看产出的 manifest.json 文件，可以看到：
```javascript
{
  "res" : {
    ...
    "demo.css" : {
      "uri" : "/static/css/demo_7defa41.css",
      "type" : "css",
      "deps" : [ "reset.css" ]
    },
    ...
  },
  "pkg" : {}
}
```

工作原理
--------

FIS3是基于文件对象进行构建的，每个进入FIS3的文件都会实例化成一个File对象，整个构建过程都对这个对象进行操作完成构建任务。以下通过伪码来阐述FIS3的构建流程。

**构建流程**

```javascript
fis.release = function (opt) {
  var src = fis.util.find(fis.project.root);
  var files = {};
  src.forEach(function (f) {
    var file = new File(f);
    files[file.subpath] = fis.compile(file);
  });
  var packager = fis.matchRules('::package');
  var keys = Object.keys(packager);
  var ret = {
    files: files,
    map: {}
  };
  if (packager.indexOf('prepackager') > -1) {
    pipe('prepackager', ret);
  }
  if (packager.indexOf('packager') > -1) {
    pipe('packager', ret);
  }
  files.forEach(function (f) {
    //打包阶段产出的map表替换到文件
    if (f._isResourceMap) {
      f._content = f._content.replace(/\b__RESOURCE_MAP__\b/g, JSON.stringify(ret.map));
    }
  });
  if (packager.indexOf('spriter') > -1) {
    pipe('spriter', ret);
  }
  if (packager.indexOf('postpackager') > -1) {
    pipe('postpackager', ret);
  }
}
```

如上述代码，整个FIS3的构建流程大体概括分为三个阶段。

1. 扫描项目目录拿到文件并初始化出一个文件对象列表
2. 对文件对象中每一个文件进行单文件编译
3. 获取用户设置的package插件，进行打包处理（包括合并图片）

其中打包处理开了四个扩展点，通过用户配置启用某些插件。

* prepackager 打包前处理插件扩展点
* packager 打包插件扩展点，通过此插件收集文件依赖信息、合并信息产出静态资源映射表
* spriter 图片合并扩展点，如 csssprites
* postpackager 打包后处理插件扩展点

**单文件编译流程**

```javascript
fis.compile = function (file) {
  if (file.isFile()) {
    if (exports.useLint && file.lint) {
      pipe('lint', file);
    }
    if (!file.hasCache) {
      process(file);
    } else {
      file.revertCache();
    }
  } else {
    process(file);
  }
};

function process(file) {
  if (file.parser) {
    pipe('parser', file);
  }
  if (file.preprocessor) {
    pipe('preprocessor', file);
  }
  if (file.standard) {
    standard(file); // 标准化处理
  }
  if (file.postprocessor) {
    pipe('postprocessor', file);
  }
  if (file.optimizer) {
    pipe('optimizer', file);
  }
}
```

其中插件扩展点包括：

* lint：代码校验检查，比较特殊，所以需要release命令命令行添加 -l 参数
* parser：预处理阶段，比如less、sass、es6、react前端模板等都在此处预编译处理
* preprocessor：标准化前处理插件
* standard：标准化插件，处理内置语法
* postprocessor：标准化后处理插件

```
预处理阶段一般是对异构语言等进行预编译，如less、sass编译为标准的css；前端模板被编译为js等等
```

单文件阶段通过读取文件属性，来执行对应扩展点插件。

举个例子：
```javascript
fis.match('*.es6', {
  parser: fis.plugin('babel'),
  rExt: '.js' // 代码编译产出时，后缀改成 .js
});
```
给后缀是 .es6 的文件配置了一个parser 属性，属性值是启用了一个叫babel 的插件，当执行到预处理阶段时，将es6编译为es5，供浏览器执行。
其他插件扩展点亦然。

**File对象**

```javascript
function File(filepath) {
  var props = path.info(filepath);
  merge(props, fis.matchRules(filepath)); // merge 分配到的属性
  assign(this, props); // merge 属性到对象
}
```

当一个文件被实例化为一个File对象后，包括一些文件基本属性，如filename、realpath等等，当这个文件被处理时，FIS3还会把用户自定义的属性merge到文件对象上。

比如
```javascript
fis.match('a.js', {
  myProp: true
});
```

这样a.js处理的时候就会携带这个属性myProp。myProp是一个自定义属性，FIS3默认内置了一些属性配置，来方便控制一个文件的编译流程，可参考配置属性

可能你会问，自定义属性到底有什么用，其实自定义属性可以标注一些文件，提供插件来做一些特定的需求。

初级使用
--------

**一个复杂一点的例子**

为了尝试更多FIS3提供的特性，我们设计一个比较复杂的例子。这个例子包含两个页面，三个css文件，其中俩页面各一个css文件，剩下一个css文件共用，包含一个less文件，并被俩页面同时使用，两个png图片，两个js文件。

例子下载地址 [demo-lv1](https://github.com/fex-team/fis3/tree/dev/doc/demo/demo-simple)

**安装一些插件**

FIS3是一个扩展性很强的构建工具，社区也包含很多FIS3的插件。为了展示FIS3的预处理、静态合并js、css能力，需要安装两个插件。

* fis-parser-less：例子引入一个less文件，需要less预处理插件
* fis3-postpackager-loader：可对页面散列文件进行合并

FIS3的插件都是以NPM包形式存在的，所以安装FIS3的插件需要使用npm来安装。
```
npm install -g 插件名
```
譬如：
```
npm install -g fis-parser-less
npm install -g fis3-postpackager-loader
```

**预处理**

FIS3提供强大的预处理能力，可以对less、sass等异构语言进行预处理，还可以对模板语言进行预编译。FIS3社区已经提供了绝大多数需要预处理的异构语言。

我们给定的例子中有个less文件，那么需要对less进行预处理，我们已经安装了对应的预处理插件。现在只需要配置启用这个插件就能搞定这个事情。
```javascript
fis.match('*.less', {
  // fis-parser-less 插件进行解析
  parser: fis.plugin('less'),
  // .less 文件后缀构建后被改成 .css 文件
  rExt: '.css'
})
```
如同之前强调的，虽然构建后后缀为.css。但在使用FIS3时，开发者只需要关心源码路径。所以引入一个less文件时，依然是.less后缀。

<link rel="stylesheet" type="text/css" href="./test.less">

**简单合并**

在起步中我们阐述了图片合并CssSprite，为了减少请求。现在介绍一种比较简单的打包js、css的方式。 

启用打包后处理插件进行合并：

基于整个项目打包
```javascript
fis.match('::package', {
  postpackager: fis.plugin('loader')
});

fis.match('*.less', {
  parser: fis.plugin('less'),
  rExt: '.css'
});

fis.match('*.{less,css}', {
  packTo: '/static/aio.css'
});

fis.match('*.js', {
  packTo: '/static/aio.js'
});
```
这样配置打包的结果是：一个页面最终只会引入一个css、js：aio.js和aio.css。 但两个页面的资源都被打包到同一个包里面了。这个可能不是我们想要的结果，我们想一个页面只包含这个页面用过的资源。

基于页面的打包方式
```javascript
fis.match('::package', {
  postpackager: fis.plugin('loader', {
    allInOne: true
  })
});

fis.match('*.less', {
  parser: fis.plugin('less'),
  rExt: '.css'
});
```
给loader插件配置allInOne属性，即可对散列的引用链接进行合并，而不需要进行配置packTo指定合并包名。

注意，这个插件只针对纯前端的页面进行比较粗暴的合并，如果使用了后端模板，一般都需要从整站出发配置合并。

**构建调试预览**

进入demo目录，执行命令，构建即发布到本地测试服务根目录下：
```
fis3 release
```
启动内置服务器进行预览；
```
fis3 server start --type node
```

中级使用
-------

在初级使用中，为了解析less和进行简单的资源合并，我们安装了两个已经提供好的插件，使用插件完成了我们的工作。假设某些情况下，还没有相关插件，该怎么办？

那么这节讨论一下FIS中插件如何编写。在工作原理中，已经介绍了整个构建的过程，以及说明了FIS与其他构建工具的不同点。

**预处理插件编写**

假设给定项目中要是用es6，线上运行时解析成标准js性能堪忧，想用自动化工具进行预处理转换。如原理介绍parser阶段就是进行归一化的过程，通过预处理阶段，整个文件都会翻译为标准的文件，即浏览器可解析的文件。

这时候我们搜罗开源社区，看转换es6到es5哪个转换工具更好一些，发现babel具有无限的潜能。

任务：预处理es6为es5

前期准备：

* .es6后缀最终变为.js
* 使用babel进行es6的转换
* FIS3实现一个parser类型的插件，取名叫translate-es6，插件全名fis3-parser-translate-es6

开发插件：

开发插件文档详细介绍了开发插件的步骤，但为了更友好的进行接下来的工作，我们在这里简述一下整个过程。

FIS3支持local mode加载一个插件。当你调用一个插件的时候，配置如下：
```javascript
{
  parser: fis.plugin('translate-es6')
}
```
如果项目的根目录node_modules下有这个插件，就能挂载起来。
```
my-proj/node_modules/fis3-parser-translate-es6
```
这样我们就知道，插件逻辑放到什么地方能用fis.plugin接口挂载。
```
my-proj/node_modules/fis3-parser-translate-es6/index.js
```
```javascript
// vi index.js
// babel node.js api 只需要babel-core即可
var babel = require('babel-core');
module.exports = function (content, file, options) {
  var result = babel.transform(content, opts);
  return result.code; // 处理后的文件内容
}
```
如上我们调用babel-core封装了一个fis3-parser插件。

现在我们要在项目使用它
```
my-proj/fis-conf.js # 项目fis3 配置文件
my-proj/node_modules/fis3-parser-translate-es6/index.js # 插件逻辑
my-proj/style.es6
my-proj/index.html
```

配置使用
```javascript
fis.match('*.es6', {
  parser: fis.plugin('translate-es6'),
  rExt: '.js' // .es6 最终修改其后缀为 .js
})
```

构建
```
fis3 release -d ./output
```

**打包插件编写**

在开始之前，我们需要阐述下打包这个名词，打包在前端工程中有两个方面。

* 收集页面用到的js、css，分别合并这些引用，将资源合并成一个。
* 打包，对某些资源进行打包，而记录它们打包的信息，譬如某个文件打包到了哪个包文件。

其实一般意义上来说，对于第一种情况收集打包只适合于纯前端页面，并且要求资源都是静态引入的。假设出现这种情况：
```
<script type="text/javascript">
// load common.js and index.js
F.load([
  'common',
  'index'
]);
</script>
```
需要通过动态脚本去加载的资源，就无法通过工具静态分析来去做合并了。

还有一种情况，如果模板是后端模板，也依然无法做到这一点，因为加载资源只有在运行时、解析时才能确定。

那么对于这类打包合并资源，需要特殊的处理思路。

1. 直接将所有资源合并成一个文件，进行整站（整个项目）合并；
2. 通过配置文件配置打包，并且合并时记录合并信息，在运行时根据这些打包信息吐给浏览器合适的资源。

第一种，粗暴问题多，并且项目足够大时效率明显不合适。我们主要探讨第二种。

FIS3默认内置了一个打包插件fis3-packager-map，它根据用户的配置信息对资源进行打包。
```javascript
//fis-conf.js
fis.match('/widget/*.js', {
  packTo: '/static/widget_pkg.js'
})
```
标明/widget目录下的js被合并成一个文件widget_pkg.js

假设
```
/widget/a.js
/widget/b.js
/widget/c.js
/map.json
```
编译发布后：
```
/widget/a.js
/widget/b.js
/widget/c.js
/static/widget_pkg.js
/map.json
```
我们前面说过

当某文件包含字符 __RESOURCE_MAP__ 时，最终静态资源表（资源之间的依赖、合并信息）会替换这个字符。
构建后，出现一个合并资源以外，还会产出一张某资源合并到什么文件中的关系信息。
```javascript
{
  "res": {
    "widget/a.js": {
      "uri": "/widget/a.js",
      "type": "js",
      "pkg": "p0"
    },
    "widget/b.js": {
      "uri": "/widget/b.js",
      "type": "js",
      "pkg": "p0"
    },
    "widget/c.js": {
      "uri": "/widget/c.js",
      "type": "js",
      "pkg": "p0"
    }    
  },
  "pkg": {
    "p0": {
      "uri": "/static/widget_pkg.js",
      "has": [
        "widget/a.js",
        "widget/b.js",
        "widget/c.js"
      ],
      "type": "js"
    }
  }
}
```

**发布插件**

FIS3 的插件都放在 NPM 平台上，把插件发布到其上即可。

参考链接[npm publish](https://docs.npmjs.com/getting-started/publishing-npm-packages)

发布的插件如何使用：

* npm install -g <plugin> 安装插件
* FIS3 配置文件中按照配置规则进行配置，fis.plugin(<plugin-name>)


高级使用
-------

**静态资源映射表**

记录文件依赖、打包、URL等信息的表结构，在FIS2中统称map.json。在FIS3中默认不产出map.json，FIS3中为了方便各种语言下读取map.json，对产出 map.json 做了优化。

当某个文件包含字符__RESOURCE_MAP__，就会用表结构数据替换此字符。这样的好处是不再固定把表结构写入某一个特定文件，方便定制。

比如在php
```
<?php
$_map = json_decode('__RESOURCE_MAP__', true);
?>
```
js
```javascript
var _map = __RESOURCE_MAP__;
```

假设上面的php和js为分析静态资源映射表的程序，那么就省去了读map.json的过程。

当然，如果你想继续像FIS2一样的产出map.json，只需要在模块下新建文件map.json，内容设置为 __RESOURCE_MAP__ 即可。

**模块化开发**

模块化开发是工程实践的最佳手段，分而治之维护上带来了很大的益处。说到模块化开发，首先很多人都会想到AMD、CMD，同时会想到require.js、sea.js这样的前端模块化框架。主要给js提供模块化开发的支持，之后也增加了对css、前端模板的支持。这些框架就包含了组件依赖分析、保持加载并保持依赖顺序等功能。但在FIS中，依赖本身在构建过程中就已经分析完成，并记录在静态资源映射表中，那么对于线上运行时，模块化框架就可以省掉依赖分析这个步骤了。

在声明依赖内置语法中提到了几种资源之间标记依赖的语法，这样模板可以依赖js、css，js可以依赖某些css，或者某个类型的组件可以互相依赖。

另外，考虑到js还需要有运行时支持，所以对于不同前端模块化框架，在js代码中FIS编译分析依赖增加了几种依赖函数的解析。这些包括

***AMD***

````javascript
define()
require([]);
require('');
```

***seajs***

```javascript
define()
require('')
sea.use([])
```

***mod.js (extends commonjs)***

```javascript
define()
require('')
require.async('')
require.async([])
```

考虑到不可能一个框架运用多个模块化框架（因为全都占用同样的全局函数，互斥），所以编译支持这块分成三个插件进行支持。

* fis3-hook-commonjs
* fis3-hook-amd
* fis3-hook-cmd

```javascript
// vi fis-conf.js
fis.hook('commonjs');
```
```
插件README有详细的使用文档。
```

如上面说到的，这个编译插件只是对编译工具做一下扩展，支持前端模块化框架中的组件与组件之间依赖的函数，以及入口函数来标记生成到静态资源映射表中；另外一个功能是针对某些前端模块化框架的特性自动添加define。

有了依赖表，但如何把资源加载到页面上，需要额外的FIS构建插件或者方案支持。

假设以纯前端（没有后端模板）的项目为例，对于依赖组件的加载就靠插件fis3-postpackager-loader。其是一种基于构建工具的加载组件的方法，构建出的html已经包含了其使用到的组件以及依赖资源的引用。
```javascript
//npm install -g fis3-postpackager-loader
fis.match('::package', {
  postpackager: fis.plugin('loader', {})
});
```
为了方便、统一管理组件以及合并时便利，需要把组件统一放到某些文件夹下，并设置此目录下的资源都是组件资源。
```javascript
// widget目录下为组件
fis.match('/widget/**.js', {
  isMod: true
});
```
通过以上三步，纯前端的模块化开发就可实现。

总结一下；

* 编译工具扩展：根据不同前端模块化框架，扩展声明依赖能力
* 静态资源管理：解析静态资源映射表加载页面用到的组件及其组件的依赖
* 目录规范：设置某个文件夹下资源标记为依赖

工具扩展、目录规范，前后端的前端工程项目都需要，其不同之处就在于静态资源管理这部分。

**资源映射表的模块化方案设计**

**解决方案封装**

解决方案：解决一系列特定问题的工具、规范、开发、上线支持的方案，被称为解决方案。前端工程的解决方案一般包括：
```
研发规范 + 模块化框架 + 测试套件 + 辅助开发工具
```
FIS3中的包装解决方案，就是把这些集成到一个工具中。

一个解决方案就是继承自FIS3并且支持特定模块化开发、特定模板语言、特定处理流程、研发规范的构建工具。

**封装解决方案的必要性**
  
* 规范开发，对于特定团队业务，应该有特定的目录规范、模块化框架等
* FIS3只提供一个方便定制前端工程的构建系统，每个团队需要怎么样去处理工程需要自己定制，定制会引入大量的FIS3插件，解决方案可统一规定引入哪些插件
* 树立独立技术品牌

**解决方案封装**

准备
```
方案名 foo
构建工具名字 foo
模板语言 PHP
模块化框架选择 require.js
特定目录规范
```

目录规范
```
/static # 静态资源
/page # 页面
/widget # 组件
/fis-conf.js # 配置文件
```

部署规范
```
/template # 所有的PHP模板
/static  # 所有的静态资源
```

构建工具
```
foo
foo/bin/foo.js
foo/index.js
package.json
```

基于FIS3配置目录规范和部署规范

```javascript
//vi foo/index.js
var fis = module.exports = require('fis3');
fis.require.prefixes.unshift('foo');
fis.cli.name = 'foo';
fis.cli.info = require('./package.json');

fis.match('*', {
  release: '/static/$0' // 所有资源发布时产出到 /static 目录下
});

fis.match('*.php', {
  release: '/template/$0' // 所有 PHP 模板产出后放到 /template 目录下
});

// 所有js, css 加 hash
fis.match('*.{js,css,less}', {
  useHash: true
});

// 所有图片加 hash
fis.match('image', {
  useHash: true
});

// fis-parser-less
fis.match('*.less', {
  parser: fis.plugin('less'),
  rExt: '.css'
});

fis.match('*.js', {
  optimizer: fis.plugin('uglify-js')
});

fis.match('*.{css,less}', {
  optimizer: fis.plugin('clean-css')
});

fis.match('*.png', {
  optimizer: fis.plugin('png-compressor')
});

fis.match('widget/*.{php,js,css}', {
  isMod: true
});

fis.match('::package', {
  spriter: fis.plugin('csssprites')
});

//fis3-hook-module
fis.hook('module', {
  mode: 'amd' // 模块化支持amd规范，适应require.js
});
```

实现/bin/foo.js

```javascript
#!/usr/bin/env node

// vi foo/bin/foo.js

var Liftoff = require('liftoff');
var argv = require('minimist')(process.argv.slice(2));
var path = require('path');
var cli = new Liftoff({
  name: 'foo', // 命令名字
  processTitle: 'foo',
  moduleName: 'foo',
  configName: 'fis-conf',
  // only js supported!
  extensions: {
    '.js': null
  }
});

cli.launch({
  cwd: argv.r || argv.root,
  configPath: argv.f || argv.file
}, function(env) {
  var fis;
  if (!env.modulePath) {
    fis = require('../');
  } else {
    fis = require(env.modulePath);
  }
  // 配置插件查找路径，优先查找本地项目里面的 node_modules
  // 然后才是全局环境下面安装的fis3目录里面的 node_modules
  fis.require.paths.unshift(path.join(env.cwd, 'node_modules'));
  fis.require.paths.push(path.join(path.dirname(__dirname), 'node_modules'));
  fis.cli.run(argv, env);
});
```
以上代码copy过来即可，不需要做大的改动，感兴趣可研究其原理。

依赖的NPM包，需要在package.json中加上依赖：

* fis-parser-less解析less
* fis-optimizer-uglify-js 压缩 js，fis3 已内置
* fis-optimizer-clean-css 压缩 css，fis3 已内置
* fis-optimizer-png-compressor 压缩 png 图片，fis3 已内置
* fis3-hook-module 模块化支持插件
* fis3 fis3 核心
* minimist
* liftoff

package.json需要添加
```JavaScript
"bin": {
  "foo": "bin/foo.js"
}
```

发布foo到NPM

通过以上步骤可以简单封装一个解决方案，FIS3提供了大量的插件，已经几乎极其简单的配置方式来搞定研发规范的设置，很轻松即可打造完整的前端集成解决方案。

**基于Smarty的解决方案**

**基于纯PHP的解决方案**

**基于Laravel的解决方案**


接口文档
--------

**命令行**

查看fis3提供了哪些命令
```
fis3 -h
```
通过帮助信息，不难发现FIS3默认内置了命令release、install、init、server、inspect等命令，这些命令都是FIS的fis-command-*插件提供，通过
```
fis3 <command>
```
来调用，详见以下文档介绍内置的命令。

**release**

fis3-command-release插件提供，默认内置，编译发布一个FIS3项目。
添加-h或者--help参数可以看到如上帮助信息，其中标明此命令有哪些参数并且起到什么作用。
```
fis3 release -h
```
-h、--help 打印帮助信息
-d、--dest 编译产出到一个特定的目录
```
fis3 release -d ./output
```
发布到当前命令执行目录下的 ./output 目录下。
```
fis3 release -d ../output
```
发布到当前命令执行目录父目录的 ../output 目录下, 即上一级的output 目录。

-l、--lint 启用文件格式检测
```
fis3 release -l
```
默认fis3 release不会启用lint过程，只有通过命令行参数指定了才会开启。

-w、--watch 启动文件监听
```
fis3 release -w
```
会启动文件监听功能，当文件变化时会编译发布变化了的文件以及依赖它的文件。加了此参数，命令不会马上退出，而是常驻且监听文件变化，并按需再次执行。想停止命令需要使用快捷键 CTRL+c 来强制停止。

-L、--live 启动livereload 功能
```
fis3 release -L
```
livereload功能应该跟watch功能一起使用（-w 在开启liveload 的前提下，自动开启），当某文档做了修改时，会自动刷新页面。

-c, --clean 清除编译缓存
```
fis3 release -c
```
默认fis的每次编译都会检测编译缓存是否有效，如果有效fis是不会重复编译的。开启此选项后，fis编译前会做一次缓存清理。

-u, --unique 启用独立缓存
```
fis3 release -u
```
为了防止多个项目同时编译时缓存文件混乱，启用此选项后，会使用独立的缓存文件夹。一般用于编译机。

**install**

fis-command-install插件提供，默认内置，用来从组件平台中下载组件到当前项目中，并自动下载其依赖。默认组件下载来源于fis-components机构。 更多内容请查看components文档.
```
~/sanbox/test fis3 install bootstrap-datepicker

 [INFO] Currently running fis3 (/usr/local/lib/node_modules/fis3/)

Installed
├── github:fis-components/bootstrap-datepicker@v1.4.0
├── github:fis-components/bootstrap@v3.3.4
└── github:fis-components/jquery@2.1.0

~/sanbox/test tree . -L 3
.
└── components
    ├── bootstrap
    │   ├── README.md
    │   ├── affix.js
    │   ├── alert.js
    │   ├── bootstrap.js
    │   ├── button.js
    │   ├── carousel.js
    │   ├── collapse.js
    │   ├── component.json
    │   ├── css
    │   ├── dropdown.js
    │   ├── fonts
    │   ├── modal.js
    │   ├── popover.js
    │   ├── scrollspy.js
    │   ├── tab.js
    │   ├── tooltip.js
    │   └── transition.js
    ├── bootstrap-datepicker
    │   ├── README.md
    │   ├── bootstrap-datepicker.css
    │   ├── bootstrap-datepicker.js
    │   ├── bootstrap-datepicker.standalone.css
    │   ├── bootstrap-datepicker3.css
    │   ├── bootstrap-datepicker3.standalone.css
    │   └── component.json
    └── jquery
        ├── README.md
        ├── component.json
        └── jquery.js

6 directories, 25 files
```
命令使用说明

fis3 install --help
```
 [INFO] Currently running fis3 (/usr/local/lib/node_modules/fis3/)

  Usage: install [options] <components...>

  Options:

    -h, --help         output usage information
    --save             save component(s) dependencies into `components.json` file.
    -r, --root <path>  set project root
```
可以同时下载多个组件，多个组件之间使用空格隔开，如：
```
fis3 install jquery jquery-ui
```
当设置--save参数时，除了安装组件外，还会将依赖信息保存在当前项目根目录下面的component.json 文件中。

**init**

fis3-command-init插件提供，默认内置

fis3脚手架工具，用来快速初始化项目。在fis-scaffold机构中的仓库都可以通过fis3 init ${模板名称} 来初始化到当前目录。当不指定模板名称时，fis3会使用default作为模板用来初始化。

fis3 init --help
```
 [INFO] Currently running fis3 (/usr/local/lib/node_modules/fis3/)

  Usage: init <template>

  Options:

    -h, --help         output usage information
    -r, --root <path>  set project root
```

**server**

fis-command-server插件提供，默认内置

fis3内置了一个小型web server, 可以通过fis3 server start 快速开启。如果一切正常，开启后它将自动弹出浏览器打开http://127.0.0.1:8080/。

需要说明的是，fis3自带的server默认是通过java内嵌jetty然后桥接php-cgi的方式运行的。所以，要求用户机器上必须安装有jre和php-cgi程序。

另外, fis server是后台进行运行的，不会随着进程的结束而停止。如果想停止该服务器，请使用fis3 server stop进行关闭。

更多说明请参考命令行使用说明。

$ fis3 server --help
```
 [INFO] Currently running fis3 (/usr/local/lib/node_modules/fis3/)

  Usage: server <command> [options]

  Commands:

    start                  start server
    stop                   shutdown server
    restart                restart server
    info                   output server info
    open                   open document root directory
    clean                  clean files in document root
    install <name>         install server framework

  Options:

    -h, --help                     output usage information
    -p, --port <int>               server listen port
    --root <path>                  document root
    --type <php|java|node>         process language
    --rewrite [script]             enable rewrite mode
    --repos <url>                  install repository
    --timeout <seconds>            start timeout
    --php_exec <path>              path to php-cgi executable file
    --php_exec_args <args>         php-cgi arguments
    --php_fcgi_children <int>      the number of php-cgi processes
    --php_fcgi_max_requests <int>  the max number of requests
    --registry <registry>          set npm registry
    --include <glob>               clean include filter
    --exclude <glob>               clean exclude filter
    --https                        start https server

```

**inspect**

fis3-command-inspect插件提供，默认内置

用来查看文件match结果。如下所示，将列出项目中所有文件，并显示该文件有哪些属性及属性值，以及该属性是源于哪个fis.match 配置。

fis3 inspect
```
 [INFO] Currently running fis3 (/usr/local/lib/node_modules/fis3/)

 ~ /README.md
 -- useHash false `*`   (0th)


 ~ /comp/1-0/1-0.js
 -- useHash false `*`   (0th)
 -- isMod true `/comp/**/*.js`   (1th)
 -- release /static/comp/1-0/1-0.js `/comp/**/*.js`   (1th)


 ~ /comp/2-0/2-0.js
 -- useHash false `*`   (0th)
 -- isMod true `/comp/**/*.js`   (1th)
 -- release /static/comp/2-0/2-0.js `/comp/**/*.js`   (1th)


 ~ /comp/cal/cal.js
 -- useHash false `*`   (0th)
 -- isMod true `/comp/**/*.js`   (1th)
 -- release /static/comp/cal/cal.js `/comp/**/*.js`   (1th)


 ~ /index.html
 -- useHash false `*`   (0th)


 ~ /static/mod.js
 -- useHash false `*`   (0th)


 ~ ::package
 -- postpackager [plugin `loader`] `::package`   (2th)
```

**配置**

本文提及配置API&属性都可以在配置API和配置属性找到

FIS3配置设计了一套类似css的规则，而就如同css一样，有!important也有@media，那么就在这篇文档中揭露我们的类css配置；默认情况下，配置文件写到fis-conf.js文件中，此文件放到项目的根目录下，或说有此文件的目录被看做是项目根目录

以下例子配置内容，都应该指的是fis-conf.js 的内容，不再特别说明；

通过API：fis.match()，FIS3在处理的时候首先会加载项目内的所有文件，然后通过fis.match()来为某一个文件分配不同的属性，这些属性叫做文件属性。这些属性控制这个文件经过怎么样的操作；

先来一个例子：启用插件的例子
```javascript
fis.match('a.js', {
    optimizer: fis.plugin('uglify-js')
});
fis.match('b.min.js', {
    optimizer: null
})
```

如上面，a.js 文件分配了属性，其中处理过程中会调用fis-optimizer-uglify-js插件进行压缩；而已经压缩过的b.min.js就不需要进行压缩了，那么它的optimizer就设置为 null；可以不设置这个属性为 null 因为默认为 null。

规则覆盖的例子：假设fis.match()给若干文件分配了属性，当两个规则之间匹配的文件相同时，后设置的可以覆盖前面设置的属性，如果前面规则没有某属性则追加；
```javascript
fis.match('{a,b,c}.js', {
    optimizer: fis.plugin('uglify-js')
});
fis.match('{a,b}.js', {
    isMod: true,
    optimizer: null
});
```

c.js分配到的属性是{optimizer: fis.plugin('uglify-js')}，意思是最终会被压缩，a.js和b.js分配到的属性是{isMod: true, optimizer: null}意思是最终会附带属性isMod并进行组件化处理、不做压缩。
通过上面两个例子，大家不难看出；FIS3设计的是一套类css的配置体系，那么其中fis.match()就是用来设置规则的；其中第一个参数可当成是 selector其设置的类型是glob或者是[正则][]；

**media**

多状态，刚才说到过，FIS3中都靠给文件分配不同属性来决定这个文件经过哪些处理的；那么media就能让我们在不同状态（情形）下给文件分配不同属性；这个任务就由fis.media()完成；

假设我们有如下需求，当在开发阶段资源都不压缩，但是在上线时做压缩，那么这个配置如何写呢；
```javascript
//default `dev` mode
fis.match('**.js', {

});

fis.media('prod').match('**.js', {
    optimizer: fis.plugin('uglify-js')
}).match('**.css', {
    optimizer: fis.plugin('clean-css')
});
```
这样就写完了，那么怎么在编译发布的时候使用media呢，是这样的；
```
fis3 release <media>
```
那么对上面的配置

fis3 release 默认开发状态不做压缩
fis3 release prod 上线编译调用


**important**

fis.match()的第三个参数就是设置!important的，那么设置了这个属性后，后面的规则就无法覆盖了。

比如
```javascript
fis.match('{a,b,c}.js', {
    optimizer: fis.plugin('uglify-js')
}, true);
fis.match('a.js', {
    optimizer: null
})
```
这样的设置下，当a.js处理使还是会被调用压缩器进行压缩；


**::package**

```javascript
fis.match('::package', {
   packager: fis.plugin('map')
});
```
表示当packager阶段所有的文件都分配某些属性

**::image**
```
// 所有被标注为图片的文件添加 hash
fis.match('::image', {
  useHash: true
});
```
project.fileType.image 添加支持图片

**::text**

```javascript
// 所有被标注为文本的文件去除hash
fis.match('::text', {
  useHash: false
});
```
project.fileType.text

**:js**

匹配模板中的内联js，支持isHtmlLike的所有模板
```javascript
// 压缩 index.html 内联的 js
fis.match('index.html:js', {
  optimizer: fis.plugin('uglify-js')
});
// 压缩 index.tpl 内联的 js
fis.match('index.tpl:js', {
  optimizer: fis.plugin('uglify-js')
})
```

**:css**

匹配模板中内联css，支持isHtmlLike 的所有模板
```javascript
// 压缩 index.html 内联的 css
fis.match('index.html:css', {
  optimizer: fis.plugin('clean-css')
});
// 压缩 index.tpl 内联的 css
fis.match('index.tpl:css', {
  optimizer: fis.plugin('clean-css')
})
```

**配置接口**

fis3通过配置来决定代码、资源该如何处理，包括配置、压缩、CDN、合并等；

**配置API**

```
fis.set()
```
设置一些配置，如系统内置属性project、namespace、modules、settings。fis.set设置的值通过fis.get()获取

语法
```
fis.set(key, value)
```

参数key：任意字符串，但系统占用了project、namespace、modules、settings它们在系统中有特殊含义，详见全局属性。

当字符串以.分割的，.字符后的字符将会是字符前字符同名对象的健

value：任意变量
```javascript
fis.set('namespace', 'home');
fis.set('my project namespace', 'common');
fis.set('a.b.c', 'some value'); // fis.get('a') => {b: {c: 'some value'}}
```

**fis.get()**

获取已经配置的属性，和fis.set()成对使用

语法
```
fis.get(key)
```
参数：key 任意字符串
```javascript
// fis.set('namespace', 'common')
var ns = fis.get('namespace');
// fis.set('a.b.c', 'd')
fis.get('a'); // => {b:{c: 'd'}}
fis.get('a.b'); // => {c:'d'}
fis.get('a.b.c'); // => 'd'
```

**fis.match()**

给匹配到的文件分配属性，文件属性决定了这个文件进行怎么样的操作；

fis.match模拟一个类似css的覆盖规则，负责给文件分配规则属性，这些规则属性决定了这个文件将会被如何处理；

就像css 的规则一样，后面分配到的规则会覆盖前面的；如
```
fis.match('{a,b}.js', {
    release: '/static/$0'
});
fis.match('b.js', {
    release: '/static/new/$0'
});
```
b.js 最终分配到的规则属性是
```
{
    release: '/static/new/$0'
}
```
那么b.js将会产出到 /static/new 目录下；

语法
```javascript
fis.match(selector, props[, important])
```
参数：selector（glob或者是任意正则）；props文件属性；important bool 设置了这个属性为true，即表示设置的规则无法被覆盖；具体行为可参考 css !important。
```javascript
fis.match('*.js', {
  useHash: true,
  release: '/static/$0'
});
```

**fis.media()**

fis.media是模仿自css的@media，表示不同的状态。这是fis3中的一个重要概念，其意味着有多份配置，每一份配置都可以让fis3进行不同的编译；
比如开发时和上线时的配置不同，比如部署测试机时测试机器目录不同，比如测试环境和线上机器的静态资源domain不同，一切这些不同都可以设定特定的fis.media来搞定。
语法
```
fis.media(mode)
```
参数：mode（string） mode，设定不同状态，比如 rd、qa、dev、production

返回值：fis对象
```javascript
fis.media('dev').match('*.js', {
    optimizer: null
});
fis.media('rd').match('*.js', {
  domain: 'http://rd-host/static/cdn'
});
```

**fis.plugin()**

插件调用接口

语法
```javascript
fis.plugin(name [, props [, position]])
```
属性：name插件名，插件名需要特殊说明一下，fis3固定了插件扩展点，每一个插件都有个类型，体现在插件发布的npm包名字上；比如fis-parser-less插件，parser指的是在parser扩展点做了个解析.less 的插件。

那么设置插件的时候，插件名less，比如设置一个parser类型的插件是这么设置的；
```javascript
  fis.match('*.less', {
      parser: fis.plugin('less', {}) //属性 parser 表示了插件的类型
  })
```
props：对象，给插件设置用户属性
```
fis.match('*.less', {
   parser: fis.plugin('less', {});
});
```
position：设置插件位置，如果目标文件已经设置了某插件，默认再次设置会覆盖掉。如果希望在已设插件执行之前插入或者之后插入，请传入prepend或者append
```javascript
fis.match('*.less', {
   parser: fis.plugin('another', null, 'append');
});
```

配置属性
-------

**全局属性**

全局属性通过fis.set设置，通过fis.get获取；

**内置的默认配置**

```javascript
var DEFAULT_SETTINGS = {
  project: {
    charset: 'utf8',
    md5Length: 7,
    md5Connector: '_',
    files: ['**'],
    ignore: ['node_modules/**', 'output/**', '.git/**', 'fis-conf.js']
  },

  component: {
    skipRoadmapCheck: true,
    protocol: 'github',
    author: 'fis-components'
  },

  modules: {
    hook: 'components',
    packager: 'map'
  },

  options: {}
};

```

**project.charset**

解释：指定项目编译后产出文件的编码。
值类型：string
默认值：utf8
用法：在项目的fis-conf.js里可以覆盖为
```
  fis.set('project.charset', 'gbk');
```
使用charset编码需要使用encoding插件发布编译结果

**project.md5Length**

解释：文件MD5戳长度。
值类型：number
默认值：7
用法：在项目的fis-conf.js里可以修改为
```
  fis.set('project.md5Length', 8);
```

**project.md5Connector**

解释：设置md5与文件的连字符。
值类型：string
默认值：_
用法：在项目的fis-conf.js里可以修改为
```
  fis.set('project.md5Connector ', '.');
```

**project.files**

解释：设置项目源码文件过滤器。
值类型：Array
默认值：'**'
用法：
```
  fis.set('project.files', ['*.html']);
```

**project.ignore**

解释：排除某些文件
值类型：Array
默认值：['node_modules/**', 'output/**', 'fis-conf.js']
用法
```
  fis.set('project.ignore', ['*.bak']); // set 为覆盖不是叠加
```

**project.fileType.text**

解释：追加文本文件后缀列表。
值类型：Array | string
默认值：无
说明：fis系统在编译时会对文本文件和图片类二进制文件做不同的处理，文件分类依据是后缀名。虽然内部已列出一些常见的文本文件后缀，但难保用户有其他的后缀文件，内部已列入文本文件后缀的列表为： [ 'css', 'tpl', 'js', 'php', 'txt', 'json', 'xml', 'htm', 'text', 'xhtml', 'html', 'md', 'conf', 'po', 'config', 'tmpl', 'coffee', 'less', 'sass', 'jsp', 'scss', 'manifest', 'bak', 'asp', 'tmp' ]，用户配置会 追加，而非覆盖内部后缀列表。
用法：编辑项目的fis-conf.js配置文件
```
  fis.set('project.fileType.text', 'tpl, js, css');
```

**project.fileType.image**

解释：追加图片类二进制文件后缀列表。
值类型：Array | string
默认值：无
说明：fis系统在编译时会对文本文件和图片类二进制文件做不同的处理，文件分类依据是后缀名。虽然内部已列出一些常见的图片类二进制文件后缀，但难保用户有其他的后缀文件，内部已列入文本文件后缀的列表为： [ 'svg', 'tif', 'tiff', 'wbmp', 'png', 'bmp', 'fax', 'gif', 'ico', 'jfif', 'jpe', 'jpeg', 'jpg', 'woff', 'cur' ]，用户配置会追加，而非覆盖内部后缀列表。
用法：编辑项目的fis-conf.js配置文件
```
  fis.set('project.fileType.image', 'swf, cur, ico');
```

**文件属性**

fis3以文件属性控制文件的编译合并以及各种操作；文件属性包括基本属性和插件属性，插件属性是为了方便在不同的插件扩展点设置插件；

**基本属性**

release、packTo、packOrder、query、id、url、charset、isHtmlLike、isCssLike、isJsLike、useHash、domain、rExt、useMap、isMod、extras、requires、useSameNameRequire、useCache

**release**

解释：设置文件的产出路径。默认是文件相对项目根目录的路径，以/开头。该值可以设置为false，表示为不产出（unreleasable）文件。
值类型：string
默认值：无
```javascript
  fis.match('/widget/{*,**/*}.js', {
      isMod: true,
      release: '/static/$0'
  });
```

**packTo**

解释：分配到这个属性的文件将会合并到这个属性配置的文件中
值类型：string
默认值：无
```javascript
  fis.match('/widget/{*,**/*}.js', {
      packTo: '/static/pkg_widget.js'
  })
```
widget目录下的所有js文件将会被合并到/static/pkg_widget.js中。packTo设置的是源码路径，也会受到已经设置的fis.match规则的影响，比如可以配置fis.match来更改packTo的产出路径或者url；
```javascript
  fis.match('/static/pkg_widget.js', {
      release: '/static/${namespace}/pkg/widget.js' // fis.set('namespace', 'home'),
      url: '/static/new/${namespace}/pkg/widget.js'
  })
```

**packOrder**

解释：用来控制合并时的顺序，值越小越在前面。配合packTo一起使用。
值类型：Integer
默认值：0
```javascript
fis.match('/*.js', {
  packTo: 'pkg/script.js'
})
fis.match('/mod.js', {
  packOrder: -100
})
```

**query**

解释：指定文件的资源定位路径之后的query，比如'?t=123124132'。
值类型：string
默认值：无
```javascript
  fis.set('new date', Date.now());
  fis.match('*.js', {
      query: '?=t' + fis.get('new date')
  });
```

**id**

解释：指定文件的资源id。默认是namespace + subpath 的值
值类型：string
默认值：namespace + subpath

如下方例子，假设 /static/lib/jquery.js 设定了特定的 id jquery, 那么在使用这个组件的时候，可以直接用这个id；
```javascript
  fis.match('/static/lib/jquery.js', {
      id: 'jquery',
      isMod: true
  });
```
使用
```javascript
  var $ = require('jquery');
```

**moduleId**

解释：指定文件资源的模块id。在插件fis3-hook-module里面自动包裹define的时候会用到，默认是id的值。
类型：string
默认值：namespace + subpath
```javascript
  fis.match('/static/lib/a.js', {
      id: 'a',
      moduleId: 'a'
      isMod: true
  });
```
编译前

  exports.a = 10
编译后

  define('a',function(require,exports,module){
    exports.a = 10
  })


**Fis3常用配置**

制定目录规范

相信在前端工程化开发中，目录规范是必不可少的，比如哪些目录下是组件，哪些目录下的js要被特殊的插件处理，满足特殊的需求，比如对commonjs、AMD 的支持。

这一节给大家介绍目录规范的制定，把它跟部署目录衔接起来；

源码目录规范

```
.
├── page
│   └── index.html
├── static
│   └── lib
├── test
└── widget
    ├── header
    ├── nav
    └── ui
```

page 放置页面模板
widget 一切组件，包括模板、css、js、图片以及其他前端资源
test 一些测试数据、用例
static 放一些组件公用的静态资源
static/lib 放置一些公共库，例如 jquery, zepto, lazyload 等
当编译产出时，产出结果目录是这样的；

```
.
├── static
├── template
└── test
```

static 所有的静态资源都放到这个目录下
template 所有的模板都放到这个目录下
test 还是一些测试数据、用例
那么，我们的源码目录规范的指定是为了我们好维护，其产出目录规范是为了我们容易部署。

用fis3可以很方便的搞定这个事情；

fis-conf.js

```
// 所有的文件产出到static/ 目录下
fis.match('*', {
    release: '/static/$0'
});
// 所有模板放到 tempalte 目录下
fis.match('*.html', {
    release: '/template/$0'
});
// widget源码目录下的资源被标注为组件
fis.match('/widget/**/*', {
    isMod: true
});
// widget下的 js 调用 jswrapper 进行自动化组件化封装
fis.match('/widget/**/*.js', {
    postprocessor: fis.plugin('jswrapper', {
        type: 'commonjs'
    })
});
// test 目录下的原封不动产出到 test 目录下
fis.match('/test/**/*', {
    release: '$0'
});
```

这样就完成了目录规范的制定

等等，可能我们还需要做一些优化，来实现对整个工程的优化；

需要做以下几个方面的事情

js, css 在开发时不压缩，但在产品发布时压缩
代码进行合理的合并处理
```
// 所有的文件产出到 static/ 目录下
fis.match('*', {
    release: '/static/$0'
});

// 所有模板放到 tempalte 目录下
fis.match('*.html', {
    release: '/template/$0'
});

// widget源码目录下的资源被标注为组件
fis.match('/widget/**/*', {
    isMod: true
});

// widget下的 js 调用 jswrapper 进行自动化组件化封装
fis.match('/widget/**/*.js', {
    postprocessor: fis.plugin('jswrapper', {
        type: 'commonjs'
    })
});

// test 目录下的原封不动产出到 test 目录下
fis.match('/test/**/*', {
    release: '$0'
});

// optimize
fis.media('prod')
    .match('*.js', {
        optimizer: fis.plugin('uglify-js', {
            mangle: {
                expect: ['require', 'define', 'some string'] //不想被压的
            }
        })
    })
    .match('*.css', {
        optimizer: fis.plugin('clean-css', {
            'keepBreaks': true //保持一个规则一个换行
        })
    });

// pack
fis.media('prod')
    // 启用打包插件，必须匹配 ::package
    .match('::package', {
        packager: fis.plugin('map'),
        spriter: fis.plugin('csssprites', {
            layout: 'matrix',
            margin: '15'
        })
    })
    .match('*.js', {
        packTo: '/static/all_others.js'
    })
    .match('*.css', {
        packTo: '/staitc/all_others.css'
    })
    .match('/widget/**/*.js', {
        packTo: '/static/all_comp.js'
    })
    .match('/widget/**/*.css', {
        packTo: '/static/all_comp.css'
    });
```

发布 fis3 release prod，进行合并、压缩等优化
发布 fis3 release 不做压缩不做合并


部署远端测试机

由于前端项目的特殊性，一般都需要放到服务器上去运行，那么在本地开发完成后，需要把编译产出部署到测试远端机器上面去，这节就给大家分享一下在fis3这个操作怎么做；

在fis3中用fis.media提供各个状态区分，那么我们也可以轻松制定不同状态下的发布方式；比如要部署到qa 的机器上抑或是rd的机器；

准备工作，我们先选定自己需要使用的deploy插件，在fis3部署方式都是用插件实现的；
```
fis3-deploy-http-push
```
这个插件就是以 HTTP 提交的方式来完成远端部署的，当然由于安全性等原因这种方式只适用于测试阶段，请勿直接拿来上线；

HTTP提交的方式上传就得有一个接受端，http-push提供了一个php版本的接收端receiver.php，其他后端可以模仿实现一个。这个接收端需要放到你的 Web服务WWW目录下，并且可以被访问到；

部署好接收端，并且它能正常被访问到，比如url是http:///receiver.php 其配置如下
```
fis.media('qa').match('**', {
    deploy:  fis.plugin('http-push', {
        receiver: 'http:///receiver.php',
        to: '/home/work/www'
    })
});
```
fis3 release qa 当执行时就会部署到配置的qa的机器上。

异构语言 less 的使用
```
fis.match('**.less', {
    parser: fis.plugin('less'), // invoke `fis-parser-less`,
    rExt: '.css'
});
```
异构语言 sass 的使用
```
fis.match('**.sass', {
    parser: fis.plugin('sass'), // invoke `fis-parser-sass`,
    rExt: '.css'
});
```
前端模板的使用
```
fis.match('**.tmpl', {
    parser: fis.plugin('utc'), // invoke `fis-parser-utc`
    isJsLike: true    
});
```
某些资源不产出
```
fis.match('*.inline.css', {
  // 设置release 为 FALSE，不再产出此文件
  release: false
})
```
某些资源从构建中去除
FIS3 会读取全部项目目录下的资源，如果有些资源不想被构建，通过以下方式排除。
```
fis.set('project.ignore', [
  'output/**',
  'node_modules/**',
  '.git/**',
  '.svn/**'
]);
```


**更多配置**

fis3 通过配置来决定代码、资源该如何处理，包括配置、压缩、CDN、合并等；

配置API

fis.set()

设置一些配置，如系统内置属性project、namespace、modules、settings。 fis.set设置的值通过fis.get()获取

```
fis.set(key, value)
```

key 任意字符串，但系统占用了 project、namespace、modules、settings 它们在系统中有特殊含义，详见

当字符串以 . 分割的，.字符后的字符将会是字符前字符同名对象的健

value 任意变量

```
fis.set('namespace', 'home');
fis.set('my project namespace', 'common');
fis.set('a.b.c', 'some value'); // fis.get('a') => {b: {c: 'some value'}}
```

fis.get()

获取已经配置的属性，和fis.set()成对使用

fis.get(key)

key 任意字符串

```
// fis.set('namespace', 'common')
var ns = fis.get('namespace');
// fis.set('a.b.c', 'd')
fis.get('a'); // => {b:{c: 'd'}}
fis.get('a.b'); // => {c:'d'}
fis.get('a.b.c'); // => 'd'
```

fis.match()

给匹配到的文件分配属性，文件属性决定了这个文件进行怎么样的操作；

fis.match 模拟一个类似 css 的覆盖规则，负责给文件分配规则属性，这些规则属性决定了这个文件将会被如何处理；

就像css的规则一样，后面分配到的规则会覆盖前面的；如
```
fis.match('{a,b}.js', {
    release: '/static/$0'
});

fis.match('b.js', {
    release: '/static/new/$0'
});
```

b.js 最终分配到的规则属性是

```
{
  release: '/static/new/$0'
}
```

那么 b.js 将会产出到 /static/new 目录下；
```
fis.match(selector, props[, important])
```

selector glob 或者是任意正则

props 文件属性

important bool 设置了这个属性为true，即表示设置的规则无法被覆盖；具体行为可参考css !important

```
fis.match('*.js', {
  useHash: true,
  release: '/static/$0'
});
```

fis.media()

fis.media是模仿自css的@media，表示不同的状态。这是fis3中的一个重要概念，其意味着有多份配置，每一份配置都可以让fis3进行不同的编译；

比如开发时和上线时的配置不同，比如部署测试机时测试机器目录不同，比如测试环境和线上机器的静态资源domain不同，一切这些不同都可以设定特定的fis.media来搞定；
```
fis.media(mode)
```
参数，mode 

string mode，设定不同状态，比如 rd、qa、dev、production

返回值 `fis` 对象

```
fis.media('dev').match('*.js', {
    optimizer: null
});
fis.media('rd').match('*.js', {
  domain: 'http://rd-host/static/cdn'
});
```

fis.plugin()

插件调用接口

语法

```
fis.plugin(name [, props [, position]])
```

属性

name

插件名，插件名需要特殊说明一下，fis3固定了插件扩展点，每一个插件都有个类型，体现在插件发布的npm包名字上；比如fis-parser-less插件，parser指的是在parser扩展点做了个解析.less 的插件。

那么设置插件的时候，插件名 less，比如设置一个parser类型的插件是这么设置的；

```
fis.match('*.less', {
  parser: fis.plugin('less', {}) //属性 parser表示了插件的类型
})
```

props

对象，给插件设置用户属性
```
fis.match('*.less', {
  parser: fis.plugin('less', {});
});
```
position

设置插件位置，如果目标文件已经设置了某插件，默认再次设置会覆盖掉。如果希望在已设插件执行之前插入或者之后插入，请传入prepend或者append

```
fis.match('*.less', {
   parser: fis.plugin('another', null, 'append');
});
```

**glob**

FIS3中支持的glob规则，FIS3使用node-glob提供glob支持。

```
简要说明：

node-glob 中的使用方式有很多，如果要了解全部，请前往 node-glob。

这里把常用的一些用法做说明。

* 匹配0或多个除了 / 以外的字符
? 匹配单个除了 / 以外的字符
** 匹配多个字符包括 /
{} 可以让多个规则用 , 逗号分隔，起到或者的作用
! 出现在规则的开头，表示取反。即匹配不命中后面规则的文件
需要注意的是，fis 中的文件路径都是以 / 开头的，所以编写规则时，请尽量严格的以 / 开头。

当设置规则时，没有严格的以 / 开头，比如 a.js, 它匹配的是所有目录下面的 a.js, 包括：/a.js、/a/a.js、/a/b/a.js。 如果要严格只命中根目录下面的 /a.js, 请使用 fis.match('/a.js')。

另外 /foo/*.js， 只会命中 /foo 目录下面的所有 js 文件，不包含子目录。 而 /foo/**/*.js 是命中所有子目录以及其子目录下面的所有 js 文件，不包含当前目录下面的 js 文件。 如果需要命中 foo 目录下面以及所有其子目录下面的 js 文件，请使用 /foo/**.js。
```

```
扩展的规则:

假设匹配widget目录下以及其子目录下的所有 js 文件，使用 node-glob 需要这么写

widget/{*.js,**/*.js}

这样写起来比较麻烦，所以扩展了这块的语法，以下方式等价于上面的用法

widget/**.js

node-glob 中没有捕获分组，而fis中经常用到分组信息，如下面这种正则用法：

//让a目录下面的js发布到b目录下面，保留原始文件名。
fis.match(/^\/a\/(.*\.js$)/i, {
 release: '/b/$1'
});

由于原始node-glob不支持捕获分组，所以做了对括号用法的扩展，如下用法和正则用法等价。

// 让a目录下面的js发布到b目录下面，保留原始文件名。
fis.match('/a/(**.js)', {
 release: '/b/$1'
});
```

```
捕获分组:

使用node-glob捕获的分组，可以用于其他属性的设定，如release, url, id等。使用的方式与正则替换类似，我们可以用 $1, $2, $3 来代表相应的捕获分组。其中 $0 代表的是match到的整个字符串。

fis.match('/a/(**.js)', {
 release: '/b/$1' // $1 代表 (**.js) 匹配的内容
});
fis.match('/a/(**.js)', {
 release: '/b/$0' // $0 代表 /a/(**.js) 匹配的内容
});

```

```
特殊用法（类 css 伪类）

::package 用来匹配 fis 的打包过程。
::text 用来匹配文本文件。

默认识别这类后缀的文件。

[
'css', 'tpl', 'js', 'php',
'txt', 'json', 'xml', 'htm',
'text', 'xhtml', 'html', 'md',
'conf', 'po', 'config', 'tmpl',
'coffee', 'less', 'sass', 'jsp',
'scss', 'manifest', 'bak', 'asp',
'tmp', 'haml', 'jade', 'aspx',
'ashx', 'java', 'py', 'c', 'cpp',
'h', 'cshtml', 'asax', 'master',
'ascx', 'cs', 'ftl', 'vm', 'ejs',
'styl', 'jsx', 'handlebars'
]

如果你希望命中的文件类型不在列表中，请通过fis.set('project.fileType.text') 扩展，多个后缀用 , 分割。

fis.set('project.fileType.text', 'cpp,hhp');

::image 用来匹配文件类型为图片的文件。

默认识别这类后缀的文件。

[
'svg', 'tif', 'tiff', 'wbmp',
'png', 'bmp', 'fax', 'gif',
'ico', 'jfif', 'jpe', 'jpeg',
'jpg', 'woff', 'cur', 'webp',
'swf', 'ttf', 'eot', 'woff2'
]

如果你希望命中的文件类型不在列表中，请通过 fis.set('project.fileType.image') 扩展，多个后缀用 , 分割。

fis.set('project.fileType.image', 'raw,bpg');

*.html:js 用来匹配命中的html文件中的内嵌的js部分。

fis3 htmlLike 的文件内嵌的js内容也会走单文件编译流程，默认只做标准化处理，如果想压缩，可以进行如下配置。

fis.match('*.html:js', {
  optimizer: fis.plugin('uglify-js')
});

*.html:css 用来匹配命中的html文件中内嵌的css部分。

fis3 htmlLike 的文件内嵌的css内容也会走单文件编译流程，默认只做标准化处理，如果想压缩，可以进行如下配置。

fis.match('*.html:css', {
  optimizer: fis.plugin('clean-css')
});

*.html:inline-style 用来匹配命中的html文件中的内联样式。可以配置些auto prefix之类的插件。

*.html:scss 用来命中 html 文件中的scss部分，具体请参考fis3-demo中的use-xlang

```


属性
-----

全局属性

全局属性通过 fis.set 设置，通过 fis.get 获取；

内置的默认配置

```javascript
var DEFAULT_SETTINGS = {
  project: {
    charset: 'utf8',
    md5Length: 7,
    md5Connector: '_',
    files: ['**'],
    ignore: ['node_modules/**', 'output/**', '.git/**', 'fis-conf.js']
  },

  component: {
    skipRoadmapCheck: true,
    protocol: 'github',
    author: 'fis-components'
  },

  modules: {
    hook: 'components',
    packager: 'map'
  },

  options: {}
};
```

project.charset
解释：指定项目编译后产出文件的编码。
值类型：string
默认值：'utf8'
用法：在项目的fis-conf.js里可以覆盖为fis.set('project.charset', 'gbk');

project.md5Length
解释：文件MD5戳长度。
值类型：number
默认值：7
用法：在项目的fis-conf.js里可以修改为fis.set('project.md5Length', 8);

project.md5Connector
解释：设置md5与文件的连字符。
值类型：string
默认值：_
用法：在项目的fis-conf.js里可以修改为fis.set('project.md5Connector ', '.');

project.files
解释：设置项目源码文件过滤器。
值类型：Array
默认值：'**'
用法：fis.set('project.files', ['*.html']);

project.ignore
解释：排除某些文件
值类型：Array
默认值：['node_modules/**', 'output/**', 'fis-conf.js']
用法fis.set('project.ignore', ['*.bak']); //set为覆盖不是叠加

project.fileType.text
解释：追加文本文件后缀列表。
值类型：Array | string
默认值：无
说明：fis系统在编译时会对文本文件和图片类二进制文件做不同的处理，文件分类依据是后缀名。虽然内部已列出一些常见的文本文件后缀，但难保用户有其他的后缀文件，内部已列入文本文件后缀的列表为： [ 'css', 'tpl', 'js', 'php', 'txt', 'json', 'xml', 'htm', 'text', 'xhtml', 'html', 'md', 'conf', 'po', 'config', 'tmpl', 'coffee', 'less', 'sass', 'jsp', 'scss', 'manifest', 'bak', 'asp', 'tmp' ]，用户配置会 追加，而非覆盖内部后缀列表。
用法：编辑项目的fis-conf.js配置文件fis.set('project.fileType.text', 'tpl, js, css');

project.fileType.image
解释：追加图片类二进制文件后缀列表。
值类型：Array | string
默认值：无
说明：fis系统在编译时会对文本文件和图片类二进制文件做不同的处理，文件分类依据是后缀名。虽然内部已列出一些常见的图片类二进制文件后缀，但难保用户有其他的后缀文件，内部已列入文本文件后缀的列表为： [ 'svg', 'tif', 'tiff', 'wbmp', 'png', 'bmp', 'fax', 'gif', 'ico', 'jfif', 'jpe', 'jpeg', 'jpg', 'woff', 'cur' ]，用户配置会 追加，而非覆盖内部后缀列表。
用法：编辑项目的fis-conf.js配置文件fis.set('project.fileType.image', 'swf, cur, ico');

**文件属性**

fis3以文件属性控制文件的编译合并以及各种操作；文件属性包括基本属性和插件属性，插件属性是为了方便在不同的插件扩展点设置插件；

基本属性：

release
解释：设置文件的产出路径。默认是文件相对项目根目录的路径，以 / 开头。该值可以设置为 false ，表示为不产出（unreleasable）文件。
值类型：string
默认值：无
```
fis.match('/widget/{*,**/*}.js', {
  isMod: true,
  release: '/static/$0'
});
```

packTo
解释：分配到这个属性的文件将会合并到这个属性配置的文件中
值类型：string
默认值：无
```
  fis.match('/widget/{*,**/*}.js', {
      packTo: '/static/pkg_widget.js'
  })
```

widget目录下的所有js文件将会被合并到/static/pkg_widget.js中。packTo设置的是源码路径，也会受到已经设置的fis.match规则的影响，比如可以配置fis.match来更改packTo的产出路径或者 url；

```
  fis.match('/static/pkg_widget.js', {
      release: '/static/${namespace}/pkg/widget.js' // fis.set('namespace', 'home'),
      url: '/static/new/${namespace}/pkg/widget.js'
  })
```

packOrder
解释：用来控制合并时的顺序，值越小越在前面。配合packTo一起使用。
值类型：Integer
默认值：0
```
fis.match('/*.js', {
  packTo: 'pkg/script.js'
})
fis.match('/mod.js', {
  packOrder: -100
})
```

query
解释：指定文件的资源定位路径之后的query，比如'?t=123124132'。
值类型：string
默认值：无
```
  fis.set('new date', Date.now());
  fis.match('*.js', {
      query: '?=t' + fis.get('new date')
  });
```

id
解释：指定文件的资源id。默认是namespace + subpath 的值
值类型：string
默认值：namespace + subpath

如下方例子，假设/static/lib/jquery.js 设定了特定的id jquery, 那么在使用这个组件的时候，可以直接用这个id；
```
fis.match('/static/lib/jquery.js', {
  id: 'jquery',
  isMod: true
});
```
使用
```
  var $ = require('jquery');
```


moduleId
解释：指定文件资源的模块id。在插件fis3-hook-module里面自动包裹define的时候会用到，默认是id的值。
类型：string
默认值：**namespace + subpath**
```
fis.match('/static/lib/a.js', {
  id: 'a',
  moduleId: 'a'
  isMod: true
});
```
编译前
```
exports.a = 10
```
编译后
```
define('a',function(require,exports,module){
  exports.a = 10
})
```


url
解释：指定文件的资源定位路径，以 / 开头。默认是release 的值，url可以与发布路径release不一致。
值类型：string
默认值：无
```
fis.match('*.{js,css}', {
  release: '/static/$0',
  url: '/static/new_project/$0'
})
```

charset
解释：指定文本文件的输出编码。默认是 utf8，可以制定为 gbk 或 gb2312等。
值类型：string
默认值：无
```
fis.match('some/file/path', {
  charset: 'gbk'
});
```
使用 charset 编码需要使用encoding插件发布编译结果


isHtmlLike
解释：指定对文件进行html相关语言能力处理
值类型：bool
默认值：无

isCssLike
解释：指定对文件进行css相关的语言能力处理
值类型：bool
默认值：无

isJsLike
解释：指定对文件进行js相关的语言能力处理
值类型：string
默认值：无

useHash
解释：文件是否携带md5戳
值类型：bool
默认值：false
说明：文件分配到此属性后，其url及其产出带md5戳；
```
  fis.match('*.css', {
      useHash: false
  });
  fis.media('prod').match('*.css', {
      useHash: true
  });
```
fis3 release 时不带hash
fis3 release prod 时带 hash


domain
解释：给文件URL设置domain信息
值类型：string
默认值：无
说明：如果需要给某些资源添加cdn，分配到此属性的资源url会被添加domain；
```
fis.media('prod').match('*.js', {
  domain: 'http://cdn.baidu.com/'
});
```
fis3 release prod 时添加cdn


rExt
解释：设置最终文件产出后的后缀
值类型：string
默认值：无
说明：分配到此属性的资源的真实产出后缀
```
fis.match('*.less', {
  rExt: '.css'
});
```
源码为.less文件产出后修改为.css文件；


useMap
解释：文件信息是否添加到map.json
值类型：bool
默认值：无
说明：分配到此属性的资源出现在静态资源表中，现在对js、css等文件默认加入了静态资源表中；
```
fis.match('logo.png', {
  useMap: true
});
```

isMod
解释：标示文件是否为组件化文件。
值类型：bool
默认值：无
说明：标记文件为组件化文件。被标记成组件化的文件会入map.json表。并且会对js文件进行组件化包装。
```
fis.match('/widget/{*,**/*}.js', {
  isMod: true
});
```

extras
注释：在[静态资源映射表][]中的附加数据，用于扩展[静态资源映射表][]表的功能。
值类型：Object
默认值：无
说明：无
```
fis.match('/page/layout.tpl', {
  extras: {
      isPage: true
  }
});
```

requires
注释：默认依赖的资源id表
值类型：Array
默认值：无
说明：
```
fis.match('/widget/*.js', {
  requires: [
      'static/lib/jquery.js'
  ]
});
```


useSameNameRequire
注释：开启同名依赖
值类型：bool
默认值：false
说明：当设置开启同名依赖，模板会依赖同名css、js；js会依赖同名css，不需要显式引用。
```
fis.match('/widget/**', {
  useSameNameRequire: true
});
```

useCache
注释：文件是否使用编译缓存
值类型：bool
默认值：true
说明：当设置使用编译缓存，每个文件的编译结果均会在磁盘中保存以供下次编译使用。设置为false后，则该文件每次均会被编译。
```
fis.match('**.html', {
  useCache: false
});
```

插件属性

插件属性决定了匹配的文件进行哪些插件的处理；

lint

启用 lint 插件进行代码检查
```
fis.match('*.js', {
    lint: fis.plugin('js', {

    })
})
```

http://npmsearch.com/?q=fis-lint%20fis3-lint


parser
启用parser插件对文件进行处理；
如编译less文件
```
fis.match('*.less', {
   parser: fis.plugin('less'), //启用fis-parser-less插件
   rExt: '.css'
});
```

如编译sass文件
```
fis.match('*.sass', {
    parser: fis.plugin('node-sass'), //启用fis-parser-node-sass插件
    rExt: '.css'
});
```

http://npmsearch.com/?q=fis-parser%20fis3-parser


preprocessor
标准化前处理
```
fis.match('*.{css,less}', {
    preprocessor: fis.plugin('image-set')
});
```

http://npmsearch.com/?q=fis-preprocessor%20fis3-preprocessor


standard
自定义标准化，可以自定义uri、embed、require等三种能力，可自定义三种语言能力的语法；

http://npmsearch.com/?q=fis-standard%20fis3-standard


postprocessor
标准化后处理
```
fis.match('*.{js,tpl}', {
   postprocessor: fis.plugin('require-async')
});
```

http://npmsearch.com/?q=fis-postprocessor%20fis3-postprocessor


optimizer
启用优化处理插件，并配置其属性
```
fis.match('*.css', {
    optimizer: fis.plugin('clean-css')
});
```

http://npmsearch.com/?q=fis-optimizer%20fis3-optimizer



打包阶段插件

打包阶段插件设置时必须分配给所有文件，设置时必须match ::package，不然不做处理。
```
fis.match('::package', {
    packager: fis.plugin('map'),
    spriter: fis.plugin('csssprites')
});
```

prepackager
解释：打包预处理插件
值类型：Array | fis.plugin | function
默认值：无
用法：
```
fis.match('::package', {
  prepackager: fis.plugin('plugin-name')
})
```

packager
解释：打包插件
值类型：Array | fis.plugin | function
默认值：无
用法：
```
  fis.match('::package', {
      packager: fis.plugin('map')
  })
```

例子
```
fis.media('prod').match('::package', {
  packager: fis.plugin('map')
});
```

fis3 release prod 当在 prod 状态下进行打包


spriter
解释：打包后处理csssprite的插件。
值类型：Array | fis.plugin | function
默认值：无
用法：
```
  fis.match('::package', {
      spriter: fis.plugin('csssprites')
  })
```
例子
```
  fis.media('prod').match('::package', {
      spriter: fis.plugin('csssprites')
  });
```
fis3 release prod 当在 prod 状态下进行 csssprites 处理


postpackager
解释：打包后处理插件。
值类型：Array | fis.plugin | function
默认值：无
用法：
```
fis.match('::package', {
  postpackager: fis.plugin('plugin-name')
})
```
例子
```
fis.media('prod').match('::package', {
  postpackager: fis.plugin('plugin-name')
});
```
fis3 release prod 当在 prod 状态下调用打包后处理插件


deploy
解释：设置项目发布方式
值类型：Array | fis.plugin | function
默认值：fis.plugin('local-deliver')
说明：编译打包后，新增发布阶段，这个阶段主要决定了资源的发布方式，而这些方式都是以插件的方式提供的。比如你想一键部署到远端或者是把文件打包到 Tar/Zip 又或者是直接进行 Git 提交，都可以通过设置此属性，调用相应的插件就能搞定了。
用法：

假设项目开发完后，想部署到其他机器上，我们选择http提交数据的方式部署
```
fis.match('**', {
  deploy: fis.plugin('http-push', {
      receiver: 'http://target-host/receiver.php', // 接收端
      to: '/home/work/www' // 将部署到服务器的这个目录下
  })
})
```

```
常用插件
local-deliver
http-push
replace
encoding
```









