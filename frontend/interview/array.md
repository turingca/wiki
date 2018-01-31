# for

```js
(function() {
    for(var i=0, len=demoArr.length; i<len; i++) {
        if (i == 2) {
            // return;   // 函数执行被终止
            // break;    // 循环被终止
            continue; // 循环被跳过
        };
        console.log('demoArr['+ i +']:' + demoArr[i]);
    }
})();
```

关于for循环，有以下几点需要注意

for循环中的i在循环结束之后任然存在于作用域中，为了避免影响作用域中的其他变量，使用函数自执行的方式将其隔离起来。

避免使用
```
for(var i=0; i<demo1Arr.length; i++){}
```
的方式，这样的数组长度每次都被计算，效率低于上面的方式。也可以将变量声明放在for的前面来执行，提高阅读性
```
var i = 0, len = demo1Arr.length;
for(; i<len; i++) {};
```

跳出循环的方式有如下几种

- return 函数执行被终止
- break 循环被终止
- continue 循环被跳过

# for...in...

`for(var item in arr|obj){}` 可以用于遍历数组和对象

遍历数组时，item表示索引值， arr[item]表示当前索引值对应的元素 
遍历对象时，item表示key值，obj[item]表示key值对应的value值

```js
(function() {
    for(var i in demoArr) {
        if (i == 2) {
            return; // 函数执行被终止
            // break;  // 循环被终止
            // continue;  // 循环被跳过
        };
        console.log('demoArr['+ i +']:' + demoArr[i]);
    }
    console.log('-------------');
})();
```

关于`for in`，有以下几点需要注意：

在for循环与`for in`循环中，i值都会在循环结束之后保留下来。因此使用函数自执行的方式避免。
使用return，break，continue跳出循环都与for循环一致，不过关于return需要注意，在函数体中，return表示函数执行终止，就算是循环外面的代码，也不再继续往下执行。而break仅仅只是终止循环，后面的代码会继续执行。

```
function res() {
    var demoArr = ['Javascript', 'Gulp', 'CSS3', 'Grunt', 'jQuery', 'angular'];

    for(var item in demoArr) {
        if (item == 2) {
            return;
        };
        console.log(item, demoArr[item]);
    }
    console.log('desc', 'function res'); //不会执行
}
```

# forEach

`demoArr.forEach(function(arg) {})`

参数arg表示数组每一项的元素，实例如下

```
demoArr.forEach(function(val, index) {
    if (val == 'CSS3') {
        return;  // 循环被跳过
        // break;   // 报错
        // continue;// 报错
    };
    console.log(val, index);
})
```

具体有以下需要注意的地方

- 回调函数中有2个参数，分别表示值和索引，这一点与jQuery中的`$.each`相反
- forEach无法遍历对象
- forEach无法在IE中使用，firefox和chrome实现了该方法
- forEach无法使用break，continue跳出循环，使用时会报错
- forEach使用return时，效果和在for循环中使用continue一致

> ES5中新增的几个数组方法，forEach, map, filter, reduce等，可以理解为依次对数组的每一个子项进行一个处理(回调函数中的操作)，他们是对简单循环的更高一层封装，因此与单纯的循环在本质上有一些不同，所以才会导致return, continue, break的不同。

- 最重要的一点，可以添加第二参数为一个数组，而且回调函数中的this会指向这个数组。而如果没有第二参数，则this会指向window。

```
var newArr = [];
demoArr.forEach(function(val, index) {
    this.push(val); // 这里的this指向newArr
}, newArr)
```

虽然在原生中forEach循环的局限性很多，但是了解他的必要性在于，很多第三方库会扩展他的方法，使其能够应用在很多地方，比如angular的工具方法中，也有forEach方法，其使用与原生的基本没有差别，只是没有了局限性，可以在IE下使用，也可以遍历对象。

# do/while

不建议使用do/while的方式来遍历数组

函数具体的实现方式如下，不过有一点值得注意的是，当使用continue时，如果你将i++放在了后面，那么i++的值将一直不会改变，最后陷入死循环。因此使用do/while一定要小心谨慎一点。

```
// 直接使用while
(function() {
    var i = 0,
        len = demoArr.length;
    while(i < len) {
        if (i == 2) {
            // return; // 函数执行被终止
            // break;  // 循环被终止
            // continue;  // 循环将被跳过，因为后边的代码无法执行，i的值没有改变，因此循环会一直卡在这里，慎用！！
        };
        console.log('demoArr['+ i +']:' + demoArr[i]);
        i++;
    }
    console.log('------------------------');
})();
```

```
// do while
(function() {
    var i = 0,
        len = demo3Arr.length;
    do {
        if (i == 2) {
            break; // 循环被终止
        };
        console.log('demo2Arr['+ i +']:' + demo3Arr[i]);
        i++;
    } while(i<len);
})();
```

# $.each

`$.each(demoArr|demoObj, function(e, ele))`

可以用来遍历数组和对象，其中e表示索引值或者key值，ele表示value值

```
$.each(demoArr, function(e, ele) {
    console.log(e, ele);
})
```

这里有很多需要注意的地方：

- 使用return或者return true为跳过一次循环，继续执行后面的循环
- 使用return false为终止循环的执行，但是并不终止函数执行
- 无法使用break与continue来跳过循环
- 循环中this值输出类似如下

```
console.log(this);
//String {0: "C", 1: "S", 2: "S", 3: "3", length: 4, [[PrimitiveValue]]: "CSS3"}
console.log(this == ele);
// true
```

关于上面的this值，遍历一下

```
$.each(this, function(e, ele) {
    console.log(e, ele);
})

// 0 c
// 1 s
// 2 s
// 4 3
```

为什么length 和 [[PrimitiveValue]]没有遍历出来？突然灵光一动，在《javascript高级编程》中找到了答案，大概意思就是javascript的内部属性中，将对象数据属性中的Enumerable设置为了false

```
// 查看length的内部属性
console.log(Object.getOwnPropertyDescriptor(this, 'length'));
// Object {value: 4, writable: false, enumerable: false, configurable: false}
```

$.each 中的 $(this) 与this有所不同，不过遍历结果却是一样，你可以在测试代码中打印出来看看

# $(selecter).each

专门用来遍历DOMList

```
$('.list li').each(function(i, ele) {
    console.log(i, ele);
    // console.log(this == ele); // true
    $(this).html(i);
    if ($(this).attr('data-item') == 'do') {
        $(this).html('data-item: do');
    };
})
```

- i: 序列值 ele: 只当前被遍历的DOM元素
- this 当前被遍历的DOM元素，不能调用jQuery方法
- $(this) == $(ele) 当前被遍历元素的jquery对象，可以调用jquery的方法进行dom操作

# 使用for in遍历DOMList

因为domList并非数组，而是一个对象，只是因为其key值为0，1，2... 而感觉与数组类似，但是直接遍历的结果如下

```
var domList = document.getElementsByClassName('its');
for(var item in domList) {
    console.log(item, ':' + domList[item]);
}
// 0: <li></li>
// 1: <li></li>
//    ...
// length: 5
// item: function item() {}
// namedItem: function namedItem() {}
```

因此我们在使用for in 遍历domList时，需要将domList转换为数组

```
var res = [].slice.call(domList);
for(var item in res) {}
```

类似这样的对象还有函数的属性arguments对象，当然字符串也是可以遍历的，但是因为字符串其他属性的enumerable被设置成了false，因此遍历出来的结果跟数组是一样的，也就不用担心这个问题了

# other

如果你发现有些人写函数这样搞，不要惊慌，也不要觉得他高大上鸟不起

```
+function(ROOT, Struct, undefined) {
    ... 
}(window, function() {
    function Person() {}
})
```

()(), !function(){}() +function(){}() 三种函数自执行的方式

# related

https://segmentfault.com/a/1190000003968126
