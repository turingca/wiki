最后修改于2015年10月19日，alpha version。

javascript是一门高端的、动态的、弱类型的编程语言，非常适合面向对象和函数式的编程风格。javascript的语法源自java，它的一等函数
（first-class function）来自于Scheme，它的基于原型（prototype-based）的继承来自于Self。javascript和java是完全不同的两种编程语言，
javascript早已超越了其“脚本语言”本身的范畴，而成为一种集健壮性、高效性和通用性为一身的编程语言。最新的语言语言版本为严谨的大型软件
开发定义了诸多新的特性。

javascript是一种面向对象的编程语言，但又和传统的面向对象又有很大的区别。

javascript语言核心，修摘自《javascript权威指南第六版》
=====================================================

词法结构
--------
编程语言的词法结构是一套基础性规则，用来描述如何使用这门语言来编写程序。作为语法的基础，它规定了诸如变量名是什么样的、怎么写注释，以及程序语句之间如何分隔等规则。

字符集javascript程序是用Unicode字符集编写的。Unicode是ASCII和Latin-1的超集，并支持地球上几乎所有在用的语言。ECMAScript 3要求Javascript的实现必须支持Unicode 2.1及后续版本，ECMAScript 5则要求支持Unicode 3及后续版本。可以参考3.2节的“边栏”来了解更多关于Unicode和Javascript的信息。

