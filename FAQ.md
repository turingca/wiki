FAQ
====

简介
----
本分类只要介绍本系统使用的过程可能遇到的一些问题.

如果系统存在bug，请在issue中提交

准备工作
----
1.首先你要有一颗积极热爱组织的心，愿意为大家贡献分享的心

2.你要有一台能上网的电脑和一定的使用基础（你需要学会使用git,githu, 一定的英文能力以及markdown能力

3.你需要，需要的东西有点多，不过不用怕，经过下面的教程你可以很快的掌握以上技能。


开始
----
1.首先你可以访问本站整理的[Git教程](platform/Git.md)  或者自行寻找方法比如
[www.bootcss.com/p/git-guide/](www.bootcss.com/p/git-guide/)

2.学会使用之后就可以使用github了,如果你不喜欢或者不习惯输入命令来进行仓库管理，你可以在
[Desktop for github](https://desktop.github.com/)下载github图形化客户端工具不过仍然需要一定的英语能力

3.首先访问[https://github.com/turingca/wiki](https://github.com/turingca/wiki) 点击右上角的**fork**按钮
然后在你的自己项目列表中就会有一个样的项目出现
我们先将这个项目~~下载~~克隆到自己电脑上然后切换到-dev分支

```
git clone https://github.com/turingca/wiki.git

```
```

git checkout dev

```

4.对你要修改或者新增的东西进行操作，(修改之前一定确认好自己本地项目和主分支的项目一样，记得要保存哦,书写内容一定要符合规范，不可以乱写哦，做什么事情都要按照基本法的！)

5.将本地修改提交到你的github仓库
```
git add *

git commit -m '修改的内容描述替换成自己的'

git push origin dev

```
6.提交完成之后 到github你的项目界面发起pull request填写内容然后提交等待审核即可

是不是很简单啊 想不想试试啦？快来一起加入我们吧！！


常见问题
----
这里收集了，在使用过程中常见的问题以及解决办法如果你有新的解决问题的方法和新的问题已经自己解决的经验要和大家分享
你可以修改此目录，如果只是有问题但不知打怎么解决请在issue中提出我们会及时解决然后发布。

>创建自己的问题集的话可以通过在FAQ目录下创建自己的名字的文件夹比如我的就是FAQ/jearyvon/index.md
>然后我只需要在这个页面添加链接即格式为问题名 然后连接到你的问题

问题集
----

[本地分支项目和我们仓库的不一样怎么办](http://wiki.turingca.com#!FAQ/jearyvon/index.md#本地分支项目和我们仓库的不一样怎么办)





 

