简介
-----

工具官网 https://www.charlesproxy.com/

原文地址 http://blog.devtang.com/2015/11/14/charles-introduction/

Charles是在Mac下常用的网络封包截取工具，在做移动开发时，我们为了调试与服务器端的网络通讯协议，常常需要截取网络封包来分析。
Charles通过将自己设置成系统的网络访问代理服务器，使得所有的网络访问请求都通过它来完成，从而实现了网络封包的截取和分析。
除了在做移动开发中调试端口外，Charles也可以用于分析第三方应用的通讯协议。配合Charles的SSL功能，Charles还可以分析Https协议。
Charles是收费软件，可以免费试用30天。试用期过后，未付费的用户仍然可以继续使用，但是每次使用时间不能超过30分钟，并且启动时将会有10秒种的延时。因此，该付费方案对广大用户还是相当友好的，即使你长期不付费，也能使用完整的软件功能。只是当你需要长时间进行封包调试时，会因为Charles强制关闭而遇到影响。

Charles主要的功能包括：

1. 截取Http和Https网络封包。
2. 支持重发网络请求，方便后端调试。
3. 支持修改网络请求参数。
4. 支持网络请求的截获并动态修改。
5. 支持模拟慢速网络。

安装Charles
-----------

去Charles的官方网站下载最新版的Charles安装包，是一个dmg后缀的文件。打开后将Charles拖到Application目录下即完成安装。

将Charles设置成系统代理
-----------------------

之前提到，Charles是通过将自己设置成代理服务器来完成封包截取的，所以使用Charles的第一步是将其设置成系统的代理服务器。
启动Charles后，第一次Charles会请求你给它设置系统代理的权限。你可以输入登录密码授予Charles该权限。你也可以忽略该请求，然后在需要将Charles设置成系统代理时，选择菜单中的“Proxy”->“Mac OS X Proxy”来将Charles设置成系统代理。

之后，你就可以看到源源不断的网络请求出现在Charles的界面中。

需要注意的是，Chrome和Firefox浏览器默认并不使用系统的代理服务器设置，而Charles是通过将自己设置成代理服务器来完成封包截取的，所以在默认情况下无法截取Chrome和Firefox浏览器的网络通讯内容。如果你需要截取的话，在Chrome中设置成使用系统的代理服务器设置即可，或者直接将代理服务器设置成127.0.0.1:8888也可达到相同效果。

Charles主界面介绍
-----------------

两种视图模式：Structure、Sequence。
Charles主要提供两种查看封包的视图，分别名为“Structure”和“Sequence”。
Structure视图将网络请求按访问的域名分类。
Sequence视图将网络请求按访问的时间排序。

大家可以根据具体的需要在这两种视图之前来回切换。请求多了有些时候会看不过来，Charles提供了一个简单的Filter功能，可以输入关键字来快速筛选出URL中带指定关键字的网络请求。

对于某一个具体的网络请求，你可以查看其详细的请求内容和响应内容。如果请求内容是POST的表单，Charles会自动帮你将表单进行分项显示。如果响应内容是JSON格式的，那么Charles可以自动帮你将JSON内容格式化，方便你查看。如果响应内容是图片，那么Charles可以显示出图片的预览。


过滤网络请求
------------

通常情况下，我们需要对网络请求进行过滤，只监控向指定目录服务器上发送的请求。对于这种需求，以下几种办法：

方法一：在主界面的中部的Filter栏中填入需要过滤出来的关键字。例如我们的服务器的地址是：http://yuantiku.com , 那么只需要在Filter栏中填入
yuantiku即可。

方法二：在Charles的菜单栏选择“Proxy”->”RecordingSettings”，然后选择Include栏，选择添加一个项目，然后填入需要监控的协议，主机地址，端口号。这样就可以只截取目标网站的封包了。

通常情况下，我们使用方法一做一些临时性的封包过滤，使用方法二做一些经常性的封包过滤。

方法三：在想过滤的网络请求上右击，选择“Focus”，之后在Filter一栏勾选上Focussed一项。
这种方式可以临时性的，快速地过滤出一些没有通过关键字的一类网络请求。

截取iPhone上的网络封包
----------------------

Charles通常用来截取本地上的网络封包，但是当我们需要时，我们也可以用来截取其它设备上的网络请求。
下面我就以iPhone为例，讲解如何进行相应操作。

**Charles 上的设置**

要截取iPhone上的网络请求，我们首先需要将Charles的代理功能打开。在Charles的菜单栏上选择“Proxy”->”Proxy Settings”，填入代理端口 8888，并且勾上“Enable transparent HTTP proxying”就完成了在Charles上的设置。

**iPhone 上的设置**

首先我们需要获取Charles运行所在电脑的IP地址，Charles的顶部菜单的“Help”->”Local IP Address”，即可在弹出的对话框中看到IP地址。

在iPhone的“设置“->”无线局域网“中，可以看到当前连接的wifi名，通过点击右边的详情键，可以看到当前连接上的wifi的详细信息，包括IP地址，子网掩码等信息。在其最底部有「HTTP 代理」一项，我们将其切换成手动，然后填上Charles运行所在的电脑的IP，以及端口号8888。

设置好之后，我们打开iPhone上的任意需要网络通讯的程序，就可以看到Charles弹出iPhone请求连接的确认菜单，点击 “Allow” 即可完成设置。

截取Https通讯信息
-----------------

**安装证书**

如果你需要截取分析 Https 协议相关的内容。那么需要安装Charles的CA证书。具体步骤如下。
首先我们需要在Mac电脑上安装证书。点击Charles的顶部菜单，选择“Help”->“SSL Proxying”->“Install Charles Root Certificate”，
然后输入系统的帐号密码，即可在KeyChain看到添加好的证书。

需要注意的是，即使是安装完证书之后，Charles默认也并不截取Https网络通讯的信息，如果你想对截取某个网站上的所有Https网络请求，可以在该请求上右击，选择SSL proxy。这样，对于该Host的所有SSL请求可以被截取到了。

**截取移动设备中的Https通讯信息**

如果我们需要在iOS或Android机器上截取Https协议的通讯内容，还需要在手机上安装相应的证书。
点击Charles的顶部菜单，选择 “Help” -> “SSL Proxying” -> “Install Charles Root Certificate on a Mobile Device or Remote Browser”，然后就可以看到Charles弹出的简单的安装教程。

按照我们之前说的教程，在设备上设置好Charles为代理后，在手机浏览器中访问地址： http://charlesproxy.com/getssl ，即可打开证书安装的界面，安装完证书后，就可以截取手机上的Https通讯内容了。不过同样需要注意，默认情况下Charles并不做截取，你还需要在要截取的网络请求上右击，选择SSL proxy菜单项。

模拟慢速网络
------------




