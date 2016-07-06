前言
-----------------------------

```
Google JavaScript Style Guid  https://google.github.io/styleguide/javascriptguide.xml
```

JavaScript Language Rules
---------------------------

JavaScript语言规范

**var变量**

Declarations with var: Always
声明变量必须加上var关键字

When you fail to specify var, the variable gets placed in the global context, potentially clobbering existing values. Also, if there's no declaration, it's hard to tell in what scope a variable lives (e.g., it could be in the Document or Window just as easily as in the local scope). So always declare with var.

当你没有写var，变量就会暴露在全局上下文中，这样很可能会和现有变量冲突。另外，如果没有加上很难明确该变量的作用域是什么,变量也很可能像在局部作用域中，很轻易地泄漏到Document或者Window中，所以务必用var去声明变量。

**Constants常量**
