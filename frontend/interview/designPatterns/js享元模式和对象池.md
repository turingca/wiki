## 享元模式的替代方案 —— 对象池
对象池是另外一种性能优化方案，它跟享元模式有一些相似之处，但没有分离内部状态和外 部状态这个过程。对象池维护一个装载空闲对象的池子，如果需要对象的时候，不是直接 new，而是转从对象池里获取。如 果对象池里没有空闲对象，则创建一个新的对象，当获取出的对象完成它的职责之后， 再进入 池子等待被下次获取。

## 通用对象池代码实现

```
/*通用的对象池,iframe空闲后会重复利用*/
var objectPoolFactory = function( createObjFn ){ 
    var objectPool = [];
    return {
        create: function() {
            var obj = objectPool.length === 0 ? createObjFn.apply( this, arguments ) : objectPool.shift();
            return obj; 
        },
        recover: function( obj ) {
            objectPool.push( obj );
        }
    } 
};
var iframeFactory = objectPoolFactory( function(){ 
    var iframe = document.createElement( 'iframe' );
    document.body.appendChild( iframe );
    iframe.onload = function(){
        iframe.onload = null; // 防止 iframe 重复加载的 bug
        iframeFactory.recover( iframe );// iframe 加载完成之后回收节点
    }
    return iframe;
});
var iframe1 = iframeFactory.create(); 
iframe1.src = 'http:// baidu.com';
var iframe2 = iframeFactory.create(); 
iframe2.src = 'http:// QQ.com';
// 三秒后如果空闲会重复利用
setTimeout(function() {
    var iframe3 = iframeFactory.create();
    iframe3.src = 'http:// 163.com'; 
}, 3000);
```



## Reference

https://github.com/MuYunyun/blog/blob/master/BasicSkill/%E8%AE%BE%E8%AE%A1%E6%A8%A1%E5%BC%8F/%E4%BA%AB%E5%85%83%E6%A8%A1%E5%BC%8F.md

https://juejin.im/post/5c1902e751882546150aef0c
