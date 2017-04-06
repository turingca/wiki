https://github.com/philipwalton/flexbugs

A community-curated list of flexbox issues and cross-browser workarounds for them.
Flexbox问题的社区策略列表和跨浏览器解决方法

##Flexbugs

This repository is a community-curated list of flexbox issues and cross-browser workarounds for them. The goal is that if you're building a website using flexbox and something isn't working as you'd expect, you can find the solution here.
这个仓库是Flexbox问题的社区策略列表和跨浏览器解决方法。目标是，如果你使用flexbox构建一个网站，有些东西不能正常工作，你可以在这里找到解决方案。

As the spec continues to evolve and vendors nail down their implementations, this repo will be updated with newly discovered issues and remove old issues as they're fixed or become obsolete. If you discover a bug that's not listed here, please report it so everyone else can benefit.
随着规范的不断发展和供应商确定他们的实施，这个repo将更新新发现的问题并删除旧问题，因为它们是固定的或已过时。如果您发现这里没有列出的错误，请报告，以便其他人都能受益。

##The bugs and their workarounds

bugs和他们的解决方案

1. Minimum content sizing of flex items not honored
没有遵守flex项目的最小内容大小

When flex items are too big to fit inside their container, those items are instructed (by the flex layout algorithm) to shrink, proportionally, according to their flex-shrink property. But contrary to what most browsers allow, they're not supposed to shrink indefinitely. They must always be at least as big as their minimum height or width properties declare, and if no minimum height or width properties are set, their minimum size should be the default minimum size of their content.
当flex项目太大而不能容纳在其容器内时，这些项目被指示（通过flex布局算法）根据它们的flex-shrink属性按比例收缩.但与大多数浏览器允许的相反，它们不应该无限地缩小。它们必须始终至少与其最小高度或宽度属性声明一样大，如果未设置最小高度或宽度属性，则它们的最小大小应为其内容的默认最小大小。

According to the current flexbox specification:By default, flex items won’t shrink below their minimum content size (the length of the longest word or fixed-size element). To change this, set the min-width or min-height property.
根据当前flexbox规范：默认情况下，flex项不会缩小到最小内容大小（最长字或固定大小元素的长度）以下。要更改此值，请设置min-width或min-height属性。

Workaround:The flexbox spec defines an initial flex-shrink value of 1 but says items should not shrink below their default minimum content size. You can usually get this same behavior by setting a flex-shrink value of 0 (instead of the default 1) and a flex-basis value of auto. That will cause the flex item to be at least as big as its width or height (if declared) or its default content size.

解决方法：flexbox规范定义了一个初始的flex-shrink值为1，但是项目不应该缩小到默认的最小内容大小以下。通常可以通过设置flex-shrink值为0（而不是默认值1）和基于flex的auto值来获得相同的行为。这将导致flex项至少与其宽度或高度（如果声明）或其默认内容大小一样大。


其他：
https://isux.tencent.com/flexbox.html
https://css-tricks.com/dont-overthink-flexbox-grids/
https://blog.serenader.me/css3-flexbox-guide/












