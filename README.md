##Objective
welcome to [wiki.turingca.com](http://wiki.turingca.com) the guide book

domain name binding:
CNAME wiki.turingca.com 
nslookup turingca.github.io
wiki A ip

Drived By TCA&MDWiki 

TCA All Rights Reserved

##给年轻程序员的几点建议：

1. 打造你的工具箱

工欲善其事，必先利其器。每个开发者都应该有一把自己的瑞士军刀，在将来漫长的职业生涯中，这些工具可以为你省下宝贵的时间，并帮助你更好的组织个人知识库。举两个例子:
* 一套高效的开发环境
* 一个信息采集器和一本笔记本

高效的开发环境

我们可以从编缉器谈起，这里有IDE vs Text Editor，有Vim vs Emacs，有Sublime vs Atom，那该如何选择呢？
在做选择之前，我们先想想自己的目标。我们希望这是一个长期的投资，这款编缉器能被长期使用，在这个过程不断的打磨，使其能完全适合自己的习惯，最大化编缉效率。如果程序员是侠客，编缉器则是他手中的剑。

虽然我是Vim的重度用户，但我觉得当年选择Vim时有欠考虑。如果让我重选一次，我的第一选择会是Emacs，第二选择会是Atom。

Emacs已存在30年，社区仍然活跃，其可扩展性在编缉器中无人能出其右。Emacs的脚本语言elisp又是lisp的一种dialect，我觉得对lisp的学习可以提升程序员对编程核心思想的理解。另一个加分点是Emacs由于其本身的高门槛及lisp特质，吸引了大批高质素的程序员，其社区可谓藏龙卧虎，更诞生了像Org-mode这样神级的插件。

反观Vim，Vim的精髓在于Mode editing，这是值得学习的，可以极大提高文本编缉的效率。但当你熟悉了这一理念后，我觉得可以转投其他编缉器，因为Vim的架构与Vimscript限制了其扩展性。Emacs通过Evil插件非常完整的支持了Mode editing，其他主流的编辑器也有类似插件，所以你一旦掌握了这个理念，在别的编辑器中也可以发挥作用。可能有人会说没有一个Vim emulator能做到Vim 100%的功能，但重点不在于某条指令是否被移植，而是mode editing思想的精髓能否被移植，我觉得答案是肯定的。

再看Atom vs Sublime，Atom的可扩展性非常好，它的大部分核心功能也是以插件的方式实现，这点与Emacs有异曲同工之妙。并且其开源的特性，使我相信它有比Sublime更持久的生命力。

关于IDE，我的看法是，我不排斥IDE，但每个IDE都是为了某个特定的任务或是编程语言服务的。做为一个有追求的程序员，可以用IDE，但依然需要精通一个强大的通用编缉器。

类似编缉器，高效的开发环境还包括Shell，Launcher，窗口管理器，文档阅读器等等。其中有一部分只需要你化很少的时间就可以完成配置，它们的投资回报率是非常高。

