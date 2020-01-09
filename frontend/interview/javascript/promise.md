```
Promise最直接的好处就是链式调用（chaining）

Promise新建后就会立即执行

then方法返回的是一个新的Promise实例（注意，不是原来那个Promise实例）。因此可以采用链式写法，即then方法后面再调用另一个then方法。

then方法指定的回调函数，将在当前脚本所有同步任务执行完才会执行

立即 resolved 的 Promise 是在本轮事件循环的末尾执行，总是晚于本轮循环的同步任务。

Promise 内部的错误不会影响到 Promise 外部的代码，通俗的说法就是“Promise 会吃掉错误”。

Promise 对象抛出的错误不会传递到外层代码

不管promise最后的状态，在执行完then或catch指定的回调函数以后，都会执行finally方法指定的回调函数。

立即resolve()的 Promise 对象，是在本轮“事件循环”（event loop）的结束时执行，而不是在下一轮“事件循环”的开始时。

Promise.reject(reason)方法也会返回一个新的 Promise 实例，该实例的状态为rejected。
```

日常review直接看阮一峰老师的[promise对象](http://es6.ruanyifeng.com/#docs/promise)


## 与promise相关的面试题


```
const promise = new Promise(function (resolve, reject) {
  resolve('ok');
  setTimeout(function () { throw new Error('test') }, 0)
});
promise.then(function (value) { console.log(value) });
```

```
setTimeout(function () {
  console.log('three');
}, 0);

Promise.resolve().then(function () {
  console.log('two');
});

console.log('one');

// one
// two
// three
```
setTimeout(fn, 0)在下一轮“事件循环”开始时执行，Promise.resolve()在本轮“事件循环”结束时执行，console.log('one')则是立即执行，因此最先输出。



## Promise类库、polyfill

[bluebird](http://bluebirdjs.com/docs/getting-started.html)

https://github.com/stefanpenner/es6-promise


## Promise/A+ 规范

[原址](https://promisesaplus.com/)

[中译](https://malcolmyu.github.io/2015/06/12/Promises-A-Plus/#note-4)

## promise.try proposal 提案

实际开发中，经常遇到一种情况：不知道或者不想区分，函数f是同步函数还是异步操作，但是想用 Promise 来处理它。因为这样就可以不管f是否包含异步操作，都用then方法指定下一步流程，用catch方法处理f抛出的错误。

[proposal](https://github.com/tc39/proposal-promise-try)

[What is Promise.try, and why does it matter?](http://cryto.net/~joepie91/blog/2016/05/11/what-is-promise-try-and-why-does-it-matter/)

## 参考

[JavaScript标志内置对象Promise](https://developer.mozilla.org/zh-CN/docs/Web/JavaScript/Reference/Global_Objects/Promise)

[使用promise](https://developer.mozilla.org/zh-CN/docs/Web/JavaScript/Guide/Using_promises)

[阮一峰Promise对象](http://es6.ruanyifeng.com/#docs/promise)

[JavaScript Promise：简介](https://developers.google.com/web/fundamentals/primers/promises)
