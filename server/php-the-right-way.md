
PHP The Right Way
=================

前言
-----------------

```
英文原文：http://www.phptherightway.com/
```
```
中文翻译：http://laravel-china.github.io/php-the-right-way/
```

Welcome
-------
There’s a lot of outdated information on the Web that leads new PHP users astray, propagating bad practices and insecure code. PHP: The Right Way is an easy-to-read, quick reference for PHP popular coding standards, links to authoritative tutorials around the Web and what the contributors consider to be best practices at the present time.

There is no canonical way to use PHP. This website aims to introduce new PHP developers to some topics which they may not discover until it is too late, and aims to give seasoned pros some fresh ideas on those topics they’ve been doing for years without ever reconsidering. This website will also not tell you which tools to use, but instead offer suggestions for multiple options, when possible explaining the differences in approach and use-case.

This is a living document and will continue to be updated with more helpful information and examples as they become available.

Code Style Guide
----------------

PHP社区百花齐放，拥有大量的函数库、框架和组件。PHP开发者通常会在自己的项目中使用若干个外部库，因此PHP代码遵循（尽可能接近）同一个代码风格就非常重要，这让开发者可以轻松地将多个代码库整合到自己的项目中。

PHP标准组提出并发布了一系列的风格建议。其中有部分是关于代码风格的，即PSR-0,PSR-1,PSR-2和PSR-4。这些推荐只是一些被其他项目所遵循的规则，如 Drupal,Zend,Symfony,CakePHP,phpBB,AWS SDK,FuelPHP,Lithium等。你可以把这些规则用在自己的项目中，或者继续使用自己的风格。

通常情况下，你应该遵循一个已知的标准来编写PHP代码。可能是PSR的组合或者是PEAR或Zend编码准则中的一个。这代表其他开发者能够方便的阅读和使用你的代码，并且使用这些组件的应用程序可以和其他第三方的组件保持一致。

* [阅读 PSR-0](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md)
* [阅读 PSR-1](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md)
* [阅读 PSR-2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md)
* [阅读 PSR-4](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader.md)
* [阅读 PEAR 编码准则](http://pear.php.net/manual/en/standards.php)
* [阅读 Symfony 编码准则](http://symfony.com/doc/current/contributing/code/standards.html)

你可以使用[PHP_CodeSniffer](http://pear.php.net/package/PHP_CodeSniffer/)来检查代码是否符合这些准则，文本编辑器SublimeText的插件也可以提供实时检查。

你可以通过以下两个工具来自动修正你的程序语法，让它符合标准。
一个是[PHP Coding Standards Fixer](http://cs.sensiolabs.org/)，它具有良好的测试。
另外一个工具是[php.tools](https://github.com/dericofilho/php.tools)，它是SublimeText的一个非常流行的插件sublime-phpfmt，虽然比较新，但是在性能上有了很大的提高，这意味着实时的修复语法会更加的流畅。

你也可以手动运行phpcs命令：
```
  phpcs -sw --standard=PSR2 file.php
```
它会显示出相应的错误以及如何修正的方法。同样地，这条命令也可以用在git hook中，如果你的分支代码不符合选择的代码标准则无法提交。

所有的变量名称以及代码结构建议用英文编写。注释可以使用任何语言，只要让现在以及未来的小伙伴能够容易阅读理解即可。
