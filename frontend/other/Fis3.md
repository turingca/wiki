前言
------
```
官方文档：http://fis.baidu.com/fis3/docs/beginning/intro.html
```
```
Github：https://github.com/fex-team
```

FIS3 是面向前端的工程构建工具。解决前端工程中性能优化、资源加载（异步、同步、按需、预加载、依赖管理、合并、内嵌）、模块化开发、自动化工具、开发规范、代码部署等问题。

安装Node和NPM
-------------

node -v 查看当前node版本
node -h 查看nodejs的帮助 

NPM（node package manager）

[对npm的介绍](http://www.92fenxiang.com/175.html)

npm -v  查看当前npm版本
npm config ls -l  查看所有 NPM 的设置
npm prefix -g     查看全局安装路径
npm cache clean   清理缓存

安装Fis3
----------

[NPM安装FIS遇到的问题](https://github.com/fex-team/fis/issues/565)

npm install -g fis3 安装到全局目录，如果 npm 长时间运行无响应，推荐使用 cnpm 来安装

npm install -g fis3 --disturl=http://registry.npm.taobao.org/mirrors/node --registry=http://registry.npm.taobao.org

升级Fis3
--------

npm update -g fis3

重装 npm install -g fis3
