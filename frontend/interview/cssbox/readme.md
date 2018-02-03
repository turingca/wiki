css盒模型

border,padding,margin,content

基本概念：标准模型和IE模型

标准模型和IE模型区别：

标准模型的宽高是content的宽高。
IE模型的宽高是盒子的宽高。

css如何设置这两种模型：

box-sizing:content-box; (标准模型)
box-sizing:border-box;（IE模型）

js如何设置获取盒模型对应的宽和高

dom.style.width/height
dom.currentStyle.widht/height(IE支持)
window.getComputeStyle(dom).width/height
dom.getBoundingClientRect().width/height


实例题（根据盒模型解释边距重叠）

BFC块级格式化上下文（边距重叠解决方案）

BFC的基本概念：块级格式化上下文

BFC的原理：

如何创建BFC：
overflow
position不为static或relative
display

BFC的使用场景：

IFC有兴趣看下
