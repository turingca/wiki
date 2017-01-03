touch事件

移动端touch事件和click事件的区别：

在移动端，手指点击一个元素，会经过touchstart->touchmove->scroll()->touchend->click(不一定触发)

touchstart和click的触发条件就有区别，对于手持设备的浏览器：
1.touchstart在这个dom（或冒泡到这个dom）上手指触摸开始即能触发
2.click在这个dom（或冒泡到这个dom）上手指触摸开始，且手指未曾在屏幕上移动（某些浏览器允许移动一个非常小的位移值），且在这个在这个dom上手指离开屏幕，且触摸和离开屏幕之间的间隔时间较短（某些浏览器不检测间隔时间，也会触发click）才能触发。

preventDefault()方法，可以阻止后面事件的触发，如在touch事件中即可阻止click和scroll事件。

构造函数touch()

属性

Touch.identifier此Touch对象的唯一标识符. 一次触摸动作(我们值的是手指的触摸)在平面上移动的整个过程中, 该标识符不变. 可以根据它来判断跟踪的是否是同一次触摸过程. 只读属性.

Touch.screenX触点相对于屏幕左边沿的的X坐标. 只读属性.
Touch.screenY触点相对于屏幕上边沿的的Y坐标. 只读属性.

Touch.clientX触点相对于可见视区(visual viewport)左边沿的X坐标. 不包括任何滚动偏移. 只读属性.
Touch.clientY触点相对于可见视区(visual viewport)上边沿的Y坐标. 不包括任何滚动偏移. 只读属性.

Touch.pageX触点相对于HTML文档左边沿的X坐标. 当存在水平滚动的偏移时, 这个值包含了水平滚动的偏移. 只读属性.
Touch.pageY触点相对于HTML文档上边沿的的Y坐标. 当存在垂直滚动的偏移时, 这个值包含了垂直滚动的偏移. 只读属性.

Touch.radiusX能够包围用户和触摸平面的接触面的最小椭圆的水平轴(X轴)半径. 这个值的单位和 screenX相同. 只读属性.
Touch.radiusY能够包围用户和触摸平面的接触面的最小椭圆的垂直轴(Y轴)半径. 这个值的单位和 screenY相同. 只读属性.

Touch.rotationAngle它是这样一个角度值：由radiusX和radiusY描述的正方向的椭圆，需要通过顺时针旋转这个角度值，才能最精确地覆盖住用户和触摸平面的接触面. 只读属性.

Touch.force手指挤压触摸平面的压力大小, 从0.0(没有压力)到1.0(最大压力)的浮点数. 只读属性.











