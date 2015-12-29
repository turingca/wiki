svn


|命令|说明|语句|例子|简写|
|-----|-----|---|----|----|
|checkout|将文件checkout到本地目录|svn checkout path|例如：svn checkout svn://192.168.1.1/pro/domain|简写：svn co|
|add|往版本库中添加新的文件|svn add file|例如：svn add test.php添加test.php  svn add *.php 添加当前目录下所有的php文件| |
|commit|将改动的文件提交到版本库|svn commit -m "LogMessage" [-N] [--no-unlock] path(如果选择了保持锁，就使用--no-unlock开关)|例如：svn commit -m "add test file for my test" test.php|简写：svn ci|

