前言
-----

Ubuntu Server操作经验

1993年具有Linux血统的Debian操作系统诞生了，2004年10月Debian的衍生操作系统Ubuntu诞生。

Ubuntu坚持每半年发布一个版本至今，其版本号命名方法是年份+月份，Ubuntu 04.10（2004年10月）。

LTS版本（Long Term Support），长期支持版，LTS版本至少提供4年的系统更新服务，而普通的版本只提供半年的更新服务。

中文乱码
--------

一般原因如下: 

1. 未安装中文语言包

使用locale -a |grep zh_CN查看系统是否已经安装了中文语言包 ,如果没有执行下面语句安装中文语言包

apt-get install language-pack-zh-hans 或 apt-get install language-pack-zh-hans language-pack-zh-hans-base

http://packages.ubuntu.com/search?keywords=language-pack-zh

2. 未设置正确的默认语言

查看系统的默认语言 echo $LANG

3. SSH 终端未正确配置

LAMP
-----

LAMP并不是一个软件，它是经过多年的Web技术发展，在业内被广泛使用的一种Web服务器解决方案之一（LNMP也非常受欢迎），由一些独立的系统或软件组合而成。通常认为，Linux＋Apache＋MySql＋PHP。并非只有Apache可以通过扩展支持PHP的解析，Nginx，LightHttpd等其它软件同样可以。

LAMP工作原理:

Ubuntu管理员权限解读：

为了安全，Ubuntu官方不推荐使用root账户远程登陆，在系统安装过程中，系统会强制要求设置一个普通用户。

普通账户没有管理员权限。

默认情况下root账户无法登陆，默认密码为空，为空不能登陆。

su（Switch User）切换到超级管理员，当前用户身份完全切换到root账户，使用root账户密码登录，除非执行exit退出登录，否则超级权限将一直有效。

sudo（Switch User and DO）以超级管理员身份执行，当前用户身份没有改变，使用自身密码获取授权，超级权限是临时的。

sudo弥补了su产生的多账户安全问题，使用su命令所有管理员都必须知道root账户的密码，sudo使得普通管理员使用自己的密码也可以获得超级管理员权限。

命令行：用户名@主机名:当前目录 用户类型标记，$表示普通用户，#表示超级管理员

通过passwd命令修改账户密码：sudo passwd root。

Passwd命令必须拥有系统超级权限才可以执行，所以当使用非root账户登录系统时执行passwd命令必须在命令前加上sudo前缀，使用root账户登陆服务器时已经拥有了超级权限，执行passwd命令时无需加sudo前缀。

apt-get 安装软件

apt-get update 更新软件源列表

apt-get install 安装软件

apt-get install apache2 

apache2 -v

apt-get install php5

php5 -v

cat /etc/apache2/mods-enabled/php5.load

出现LoadModule php5_module /usr/lib/apache2/modules/libphp5.so 说明libphp5模块已经被apache加载了

apt-get install mysql-server

cat /etc/php5/conf.d/mysql.ini

cat: /etc/php5/conf.d/mysql.ini: No such file or directory   php安装过程中默认不安装mysql扩展

apt-get install php5-mysql 安装php的mysql扩展

service mysql restart  重启mysql

多个软件一起安装：apt-get install apache2 php5 mysql-server php5-mysql

一步安装套件：tasksel install lamp-server

cd /var/www  apache默认根目录

vim info.php 写入如下检测内容

```php
<?php
header('Content-type:text/html;charset=utf-8');
echo mysql_connect('localhost','root','123456')?'数据库连接成功':'数据库连接失败';
phpinfo();
```

给php添加常用扩展：

apt-get install php5-gd curl libcurl4-openssl-dev php5-curl

LAMP环境文件目录

通过apt-get工具安装的软件配置文件均放置在/etc下，并为每个软件建立一个以软件名称为名的文件夹用于区分不同软件的配置文件。

ubuntu通过apt-get安装的目录的配置文件一般都在/etc文件下

系统配置文件目录：/etc

各个组件配置文件目录：Apache——/etc/apache2;MySQL——/etc/mysql;

LAMP环境配置-Apache

Apache加载配置时会首先加载apache.conf文件（配置文件的入口）apache.conf文件以include关键字将其他配置文件包含在其中，这有助于修改配置，按照一定的属性分开放置，配置灵活。

Apache核心配置：

mods-*** 存放Apache模块配置文件

sites-*** 存放虚拟主机的配置文件

关键词available表示可以使用；enabled表示已启用的

enabled通过ln -s命令建立available的软连接

Apache会在加载配置过程中将所有软连接一次性全部加载，以方便软连接误删时再次建立软连接启动模块

MySQL核心配置文件：my.cnf

PHP核心配置文件：php.ini

Apache虚拟主机（Virtual-Host）原理

在Apache中配置虚拟主机

sudo service apache restart 完成配置后重启apache

LNMP
-----

linux主机共享文件夹
---------------------------

windows上的共享文件夹

mount -t cifs -o username=,password="" //本机ip/共享目录  /home/fjc/www

mac上的共享文件夹


