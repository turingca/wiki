Html5
------

Markdown
--------

Markdown 是一种轻量级的「标记语言」，它的优点很多，目前也被越来越多的写作爱好者，撰稿者广泛使用。看到这里请不要被「标记」、「语言」所迷惑，Markdown 的语法十分简单。常用的标记符号也不超过十个，这种相对于更为复杂的HTML标记语言来说，Markdown可谓是十分轻量的，学习成本也不需要太多，且一旦熟悉这种语法规则，会有一劳永逸的效果。

移动端
-------

通用input输入框（限制字数，正则匹配粘贴或输入的内容）

```
<input placeholder="请输入手机号码" maxlength="11" pattern="[0-9]*" onafterpaste="this.value=this.value.replace(/\D/g,'');" oninput="this.value=this.value.replace(/\D/g,'');">
```

页面窗口
--------

[meta标签](html/meta.md)

[viewport解读](html/viewports.md)





