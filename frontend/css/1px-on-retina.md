前言
-------

原文地址有删改： http://efe.baidu.com/blog/1px-on-retina/

一直以来我们实现边框的方法都是设置
```
border: 1px solid #ccc
```
但是在retina屏上因为设备像素比的不同，边框在移动设备上的表现也不相同：1px可能会被渲染成1.5px,2px,2.5px,3px....，在用户体验上略差，所以现在要解决的问题就是在retina屏幕实现1px边框。

如果你去google类似问题，诚然会找到所谓的”答案“，然后很开森的用到项目中了。运气好的话，Yeah成功模拟1px了，运气不好了可能遇到各种奇葩的表现让你抓狂。这篇文章总结了目前常用的模拟1px的方法，并分析各个方法的利弊。

实现方案
--------

**软图片**

软图片，即通过CSS渐变模拟，代码如下：

```css
background-image:
    -webkit-linear-gradient(270deg, @top, @top 50%, transparent 50%),
    -webkit-linear-gradient(180deg, @right, @right 50%, transparent 50%),
    -webkit-linear-gradient(90deg, @bottom, @bottom 50%, transparent 50%),
    -webkit-linear-gradient(0, @left, @left 50%, transparent 50%);
background-image:
    linear-gradient(180deg, @top, @top 50%, transparent 50%),
    linear-gradient(270deg, @right, @right 50%, transparent 50%),
    linear-gradient(0deg, @bottom, @bottom 50%, transparent 50%),
    linear-gradient(90deg, @left, @left 50%, transparent 50%);
```



