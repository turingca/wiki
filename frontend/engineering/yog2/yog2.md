[yog2](http://fex.baidu.com/yog2/)

[github](https://github.com/fex-team/yog2)

yog2 是一个专注于 Node.js UI 中间层的应用框架。它基于 express 和 fis 开发，在享受 express 的灵活扩展能力和 fis 强大的前端工程化能力的同时，引入了自动路由、app 拆分以及后端服务管理模块来保证UI中间层的快速开发与稳定可靠。

```
npm install -g yog2
```

```
yog2 init project
# prompt: Enter your project name:  (yog)

cd yog

npm install

yog2 run

yog2 run debug
```

由于启动yog2-project后会一直占用控制台，因此我们需要另外开启一个控制台去部署app

```
yog2 init app
# prompt: Enter your app name:  (home)

cd home
yog2 release --dest debug

yog2 release --dest dev --watch
```
