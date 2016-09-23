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

* Use NAMES_LIKE_THIS for constant values.
* Use @const to indicate a constant (non-overwritable) pointer (a variable or property).
* Never use the const keyword as it's not supported in Internet Explorer.

常量的形式如: NAMES_LIKE_THIS, 即使用大写字符, 并用下划线分隔. 你也可用 @const 标记来指明它是一个常量. 但请永远不要使用 const 关键词.


Constant values

If a value is intended to be constant and immutable, it should be given a name in CONSTANT_VALUE_CASE. ALL_CAPS additionally implies @const (that the value is not overwritable).

Primitive types (number, string, boolean) are constant values.

Objects' immutability is more subjective — objects should be considered immutable only if they do not demonstrate observable state change. This is not enforced by the compiler.

Constant pointers (variables and properties)

The @const annotation on a variable or property implies that it is not overwritable. This is enforced by the compiler at build time. This behavior is consistent with the const keyword (which we do not use due to the lack of support in Internet Explorer).

A @const annotation on a method additionally implies that the method cannot not be overridden in subclasses.

A @const annotation on a constructor implies the class cannot be subclassed (akin to final in Java).

Examples

Note that @const does not necessarily imply CONSTANT_VALUES_CASE. However, CONSTANT_VALUES_CASE does imply @const.

/**
 * Request timeout in milliseconds.
 * @type {number}
 */
goog.example.TIMEOUT_IN_MILLISECONDS = 60;
The number of seconds in a minute never changes. It is a constant value. ALL_CAPS also implies @const, so the constant cannot be overwritten.

The open source compiler will allow the symbol to be overwritten because the constant is not marked as @const.

/**
 * Map of URL to response string.
 * @const
 */
MyClass.fetchedUrlCache_ = new goog.structs.Map();
/**
 * Class that cannot be subclassed.
 * @const
 * @constructor
 */
sloth.MyFinalClass = function() {};
In this case, the pointer can never be overwritten, but value is highly mutable and not constant (and thus in camelCase, not ALL_CAPS).



对于基本类型的常量, 只需转换命名.

```javascript
/**
 * The number of seconds in a minute.
 * @type {number}
 */
goog.example.SECONDS_IN_A_MINUTE = 60;
```
对于非基本类型, 使用 @const 标记.

```javascript
/**
 * The number of seconds in each of the given units.
 * @type {Object.<number>}
 * @const
 */
goog.example.SECONDS_TABLE = {
  minute: 60,
  hour: 60 * 60,
  day: 60 * 60 * 24
}
```
这标记告诉编译器它是常量.

至于关键词 const, 因为 IE 不能识别, 所以不要使用.

