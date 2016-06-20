前言
------
本文修摘自《HTML5数据推送应用开发》，本书使用或提到的源码文件可以从 https://github.com/DarrenCook/ssebook 下载
O'Reilly专属网页 http://oreil.ly/data-push-apps-html5-sse
```
"Data Push Apps with HTML5 SSE by Darren Cook(O'Reily).Copyright 2014 Darren Cook,978-1-449-37193-7"
```

第一章
------
SSE（Server-Sent Event，服务器推送事件）是一种允许服务端向客户端推送新数据的HTML5技术。与由客户端每隔几秒从服务端轮询拉取新数据相比，这是一种更优的解决方案。在写本书时，65%的桌面和移动浏览器原生支持这项技术，但是，本书将介绍如何开发支持超过99%桌面浏览器和移动浏览器的向后兼容解决方案。顺便说一下，10年前我只能用Flash来实现这种数据推送，事情进展太迅速了，本书中已不会有任何用Flash实现的方案。

本书中提到的浏览器占有比数据来自超赞的“Can I Use”网站，网址是 http://caniuse.com/eventsource 。而该网站的数据则来自StatCounterGlobalStats，网址是gs.statcounter.com 
