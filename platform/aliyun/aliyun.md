个人服务器Ubuntu 14.04.2 LTS
https://market.aliyun.com/products/53398003/jxsc000210.html
https://shop483r9571.market.aliyun.com/?spm=5176.730006-jxsc000210.content.8.cockOv
阿里云服务器一键安装环境实践






## 用阿里云的免费 SSL 证书让网站从 HTTP 换成 HTTPS

https://ninghao.net/blog/4449

## Let's Encrypt：用免费的 SSL 证书，让网站支持 HTTPS

https://letsencrypt.org/

https://ninghao.net/blog/5592

## https

http://www.cnblogs.com/yanghuahui/archive/2012/06/25/2561568.html

https://www.linuxidc.com/Linux/2011-11/47477.htm

https://blog.csdn.net/sean_cd/article/details/38738599

`nginx -V`查看nginx的ssl配置有没有`–with-http_ssl_module`。


如果没有发现–with-http_ssl_module这个编译参数,说明不支持。Nginx默认是不支持SSL的,需要加入–with-http_ssl_module参数重新编译。

### 生成证书

apt-get install openssl 
cd /etc/nginx/

创建服务器私钥,命令会让你输入一个口令: 
openssl genrsa -des3 -out server.key 1024
创建签名请求的证书(CSR) 
openssl req -new -key server.key -out server.csr
在加载SSL支持的Nginx并使用上述私钥时除去必须的口令: 
openssl rsa -in server.key -out server_nopwd.key


配置nginx
最后标记证书使用上述私钥和CSR：

$ openssl x509 -req -days 365 -in server.csr -signkey server.key -out server.crt
修改Nginx配置文件，让其包含新标记的证书和私钥：

server {
  server_name YOUR_DOMAINNAME_HERE;
  listen 443;
  ssl on;
  ssl_certificate /usr/local/nginx/conf/server.crt;
  ssl_certificate_key /usr/local/nginx/conf/server.key;
}

证书文件放置路径ssl_certificate
私钥文件放置路径ssl_certificate_key

`nginx -t`测试nginx主配置文件是否正确

`nginx -s reload`平滑重启nginx


## cerbot

Ubuntu14.04

```
$ sudo apt-get update
$ sudo apt-get install software-properties-common
$ sudo add-apt-repository ppa:certbot/certbot
$ sudo apt-get update
$ sudo apt-get install python-certbot-nginx 
```

ubuntu中由apt-get获得的文件包保存在/var/cache/apt/archives目录下

## let's encrypt

在Let's Encrypt执行过程在中我们需要解决几个问题。

- 域名DNS和解析问题。在配置Let's Encrypt免费SSL证书的时候域名一定要解析到当前VPS服务器，而且DNS必须用到海外域名DNS，如果用国内免费DNS可能会导致获取不到错误。

- 安装Let's Encrypt部署之前需要服务器支持PYTHON2.7以及GIT环境，要不无法部署。

- Let's Encrypt默认是90天免费，需要手工或者自动续期才可以继续使用。

## related

[Let's Encrypt](https://letsencrypt.org/)

[Cerbot](https://certbot.eff.org/)

[实战申请Let's Encrypt永久免费SSL证书过程教程及常见问题](https://www.cnblogs.com/tv151579/p/8268356.html)

[Ubuntu apt-get彻底卸载软件包](https://blog.csdn.net/get_set/article/details/51276609)

[https搭建：ubuntu nginx配置 SSL证书](https://blog.csdn.net/hanshileiai/article/details/54317276)

[阿里云Ubuntu 14.04 + Nginx + let's encrypt 搭建https访问](https://www.cnblogs.com/maomishen/p/6112721.html)

[Ubuntu14.04下 安装OpenSSL 部署腾讯云免费版DV SSL证书](https://blog.csdn.net/u013693367/article/details/78800523)

[腾讯云证书安装指引](https://cloud.tencent.com/document/product/400/4143)

1_video.turingca.com_bundle.crt
2_video.turingca.com.key