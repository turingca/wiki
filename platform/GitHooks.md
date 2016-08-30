前言
----

[官方文档](https://git-scm.com/book/zh/v2/%E8%87%AA%E5%AE%9A%E4%B9%89-Git-Git-%E9%92%A9%E5%AD%90)

什么是GitHooks？
----------------
话说，如同其他许多的版本控制系统一样，Git也具有在特定事件发生之前或之后执行特定脚本代码功能（从概念上类比，就与监听事件、触发器之类的东西类似）。GitHooks就是那些在Git执行特定事件（如commit、push、receive等）后触发运行的脚本。

按照GitHooks脚本所在的位置可以分为两类：

* 本地Hooks，触发事件如commit、merge等。
* 服务端Hooks，触发事件如receive等。

GitHooks能做什么？
-----------------
GitHooks是定制化的脚本程序，所以它实现的功能与相应的git动作相关；在实际工作中，GitHooks还是相对比较万能的。下面仅举几个简单的例子：

* pre-commit：检查每次的commit message是否有拼写错误，或是否符合某种规范。
* pre-receive：统一上传到远程库的代码的编码。
* post-receive：每当有新的提交的时候就通知项目成员（可以使用Email或SMS等方式）。
* post-receive：把代码推送到生产环境

更多的功能可以按照生产环境的需求写出来。

GitHooks是如何工作的？
---------------------
每一个Git仓库下都包含有.git/hoooks这个目录（没错，本地和远程都是这样），这里面就是放置Hooks的地方。你可以在这个目录下自由定制Hooks的功能，当触发一些Git行为时，相应地Hooks将被执行。

如何开始使用Git Hooks？
----------------------

好了，前面啰嗦一大堆，这里才是重点。

如图中所示的文件，是由本地执行的脚本语言写成的，尽管这些文件默认会是ShellScript，你完全可以给它替换成自己喜欢的Ruby，Python或者Perl。

关于这些脚本文件的命名，细心的读者就会发现图中的文件都是上面Git行为列表中列出的名称加上后缀.sample。没错就是这样，把那些文件的后缀去掉，或者以列表中的名字直接命名，就会把该脚本绑定到特定的Git行为上。

所以说，GitHooks的正确操作方式是：写脚本。

GitHooks项目介绍
------------------

* node-hooks: 一个命令行下的Git Hooks管理工具
* git-hooks: 一个全面的Git Hooks管理工具
* Git::Hooks: 一个实现Git Hooks的框架

GitHooks列表
------------

* applypatch-msg
* pre-applypatch
* post-applypatch
* pre-commit
* prepare-commit-msg
* commit-msg
* post-commit
* pre-rebase
* post-checkout
* post-merge
* pre-receive
* update
* post-receive
* post-update
* pre-auto-gc
* post-rewrite

这些脚本可以按照运行环境分为两类：本地Hooks与服务端Hooks。

Client Side
-----------

也就是上面提到的本地hooks。
其实本地hooks还是占大多数的，可以给它们分成三类：

* commit hooks
* e-mail hooks
* 其他

Commit Hooks
------------
与git commit相关的hooks一共有四个，均由git commit命令触发调用，按照一次发生的顺序分别是：

* pre-commit
* prepare-commit-msg
* commit-msg
* post-commit

其中，pre-commit是最先触发运行的脚本。在提交一个commit之前，该hook有能力做许多工作，比如检查待提交东西的快照，以确保这份提交中没有缺少什么东西、文件名是否符合规范、是否对这份提交进行了测试、代码风格是否符合团队要求等等。这个脚本可以通过传递--no-verify参数而禁用，如果脚本运行失败（返回非零值），git提交就会被终止。

prepare-commit-msg脚本会在默认的提交信息准备完成后但编辑器尚未启动之前运行。这个脚本的作用是用来编辑commit的默认提交说明。该脚本有1~3个参数：包含提交说明文件的路径，commit类型（message,template,merge,squash），一个用于commit的SHA1值。这个脚本用的机会不是太多，主要是用于能自动生成commit message的情况。不会因为--no-verify参数而禁用，如果脚本运行失败（返回非零值），git提交就会被终止。

commit-msg包含有一个参数，用来规定提交说明文件的路径。该脚本可以用来验证提交说明的规范性，如果作者写的提交说明不符合指定路径文件中的规范，提交就会被终止。该脚本可以通过传递--no-verify参数而禁用，如果脚本运行失败（返回非零值），git提交就会被终止。

post-commit脚本发生在整个提交过程完成之后。这个脚本不包含任何参数，也不会影响commit的运行结果，可以用于发送new commit通知。

需要注意到，这几个脚本并不会通过clone传到项目中，而且既然是完全运行在本地，那就无法完全保证验证能起到作用（可以随便修改），但为了保证一些项目的可靠性，还需要开发者们自觉遵守这些规则。

E-mail Hooks
------------

与git am相关的脚本有三个，均由git am触发运行，按顺序依次是：

* applypatch-msg
* pre-applypatch
* post-applypaych

如果在工作流中用不到这个命令，那也就无所谓了。不过，如果要用git format-patch命令通过Email提交补丁，这部分内容还是比较有用的。

applypatch-msg脚本最先被触发，它包含一个参数，用来规定提交说明文件的路径。该脚本可以修改文件中保存的提交说明，以便规范提交说明以符合项目标准。如果提交说明不符合规定的标准，脚本返回非零值，git终止提交。

说明一点，这个脚本看上去和commit-msg作用几乎一样。没错，默认情况下该脚本是这样写的：
```
#!/bin/sh
. git-sh-setup
test -x "$GIT_DIR/hooks/commit-msg" &&
    exec "$GIT_DIR/hooks/commit-msg" ${1+"$@"}
:
```
也就是说，该脚本会调用commit-msg并执行。实际上，这一切都是可修改的。

pre-applypatch会在补丁应用后但尚未提交前运行。这个脚本没有参数，可以用于对应用补丁后的工作区进行测试，或对git-tree进行检查。如果不能通过测试或检查，脚本返回非零值，git终止提交。同样需要注意，git提供的此默认脚本中只是简单调用了pre-commit，因此在实际工作中需要视情况修改。

post-applypatch脚本会在补丁应用并提交之后运行，它不包含参数，也不会影响git-am的运行结果。该脚本可以用来向工作组成员或补丁作者发送通知。

其他Hooks
---------

**pre-rebase**

由git rebase命令调用，运行在rebase执行之前，可以用来阻止任何已发生过的提交参与变基（字面意思，找不到合适的词汇了）。默认的pre-rebase确实是这么做的，不过脚本中的next是根据Git项目自身而写的分支名，在使用过程中应该将其改成自己的稳定分支名称。

**post-checkout**

由git checkout命令调用，在完成工作区更新之后执行。该脚本由三个参数：之前HEAD指向的引用，新的HEAD指向的引用，一个用于标识此次检出是否是分支检出的值（0表示文件检出，1表示分支检出）。

也可以被git clone触发调用，除非在克隆时使用参数--no-checkout。在由clone调用执行时，三个参数分别为null, 1, 1。

这个脚本可以用于为自己的项目设置合适的工作区，比如自动生成文档、移动一些大型二进制文件等，也可以用于检查版本库的有效性。

**post-merge**

由git merge调用，在merge成功后执行。该脚本有一个参数，标识合并是否为压缩合并。该脚本可以用于对一些Git无法记录的数据的恢复，比如文件权限、属主、ACL等。


Server Side
-----------

除了本地执行的Hooks脚本之外，还有一些放在GitServer上的Hooks脚本，作为管理员，可以利用这些服务端的脚本来强制确保项目的任何规范。这些运行在服务端的脚本，会在push命令发生的前后执行。pre系列的脚本可以在任何时候返回非零值来终止某次push，并向push方返回一个错误说明。

这里简单介绍这几个脚本：

**pre-receive**

由服务器端的git receive-pack命令调用，当从本地版本库完成一个推送之后，远端服务器开始批量更新之前，该脚本被触发执行。该脚本会从标准输入中读入一连串push过来的引用，如果这里面存在任何非零值，这批更新将不会被服务器接受。可以利用这个脚本来检查推送过来的提交是否合法。

**post-receive**

由服务器端的git receive-pack命令调用，当从本地版本库完成一个推送，并且在远程服务器上所有引用都更新完毕后执行。该脚本可以用于对其他镜像版本库的更新，或向用户发送提示（直接通过服务器端的echo命令）。如上文我提到的利用Git实现生产代码的自动化部署，就可以通过这个脚本完成。

**update**

这是一个强大的hook脚本。它和pre-recieve有些类似，只是它会为推送过来的更新中涉及到的每一个分支都做一次检查，而后者则至始至终只有一次检查。另外，它不是从标准输入中读取数据，而是包含三个参数：

* 要更新的引用或分支的名称
* 引用中保存的旧对象名称（SHA1）
* 将要保存到引用中的新对象名称(SHA1)

如果检查到返回非零值，之后返回非零值的引用会被拒绝，其他正常的引用更新都会被接受。除此之外，该脚本还可以用来防止引用被强制更新，因为它可以通过这些参数来检查新旧引用对象中是否存在继承关系，从而提供更细致的推送授权。

在Gitolite中，该脚本有更强大的应用实例。
