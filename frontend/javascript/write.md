第12章 服务器端javascript
-------------------------

前面的章节已经介绍了javascript语言核心，我们即将开始本书的第二部分，该部分会介绍javascript嵌入web浏览器的原理，并涵盖庞杂的客户端JavaScript API。可以说javascript是基于web的编程语言，因为绝大部分javascript代码是为web浏览器而编写的。但是作为一门高效和通用的语言，javascript理所当然能用于其他编程工作。所以在过渡到服务端javascript之前，我们先快速了解一下另外两种javascript嵌入。
Rhino是基于Java的javascript解析器，实现了通过javascript程序访问整个Java API，12.1节将会介绍它。
Node是Google的V8 javascript解析器的一个特别版本，它在底层绑定了POSIX（Unix）API，包括文件、进程、流和套接字等，并侧重于异步I/O、网络和HTTP。12.2节将会介绍它。Node是其官方名字，Node.js是非官方的名字，用于和其他node区分，[具体内容见](https://www.github.com/joyent/node/wiki/FAQ)

本章标题表明本章是关于“服务器端”的javascript，Node和Rhino常用于创建脚本服务器。但“服务器”这个词也意味着“Web浏览器之外的任何事情”。Rhino程序能使用Java的Swing框架创建图形UI，而Node上运行的javascript程序可以像shell脚本那样去操作文件。

本章非常简短，仅准备重点介绍在web浏览器之外使用javascript的一些方式；不会尝试全面介绍Rhino和Node，第三部分也不会包涵这里讨论的API；并且不会详细介绍Java平台或POSIX API，接下来关于Rhino的章节假定读者有一定的Java经验，关于Node的章节假定读者有一定的底层Unix API的经验。
