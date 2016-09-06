```
$ cp --h
Usage: cp [OPTION]... [-T] SOURCE DEST
  or:  cp [OPTION]... SOURCE... DIRECTORY
  or:  cp [OPTION]... -t DIRECTORY SOURCE...
Copy SOURCE to DEST, or multiple SOURCE(s) to DIRECTORY.

Mandatory arguments to long options are mandatory for short options too.
  -a, --archive                same as -dR --preserve=all
      --attributes-only        don't copy the file data, just the attributes
      --backup[=CONTROL]       make a backup of each existing destination file
  -b                           like --backup but does not accept an argument
      --copy-contents          copy contents of special files when recursive
  -d                           same as --no-dereference --preserve=links
  -f, --force                  if an existing destination file cannot be
                                 opened, remove it and try again (this option
                                 is ignored when the -n option is also used)
  -i, --interactive            prompt before overwrite (overrides a previous -n
                                  option)
  -H                           follow command-line symbolic links in SOURCE
  -l, --link                   hard link files instead of copying
  -L, --dereference            always follow symbolic links in SOURCE
  -n, --no-clobber             do not overwrite an existing file (overrides
                                 a previous -i option)
  -P, --no-dereference         never follow symbolic links in SOURCE
  -p                           same as --preserve=mode,ownership,timestamps
      --preserve[=ATTR_LIST]   preserve the specified attributes (default:
                                 mode,ownership,timestamps), if possible
                                 additional attributes: context, links, xattr,
                                 all
      --no-preserve=ATTR_LIST  don't preserve the specified attributes
      --parents                use full source file name under DIRECTORY
  -R, -r, --recursive          copy directories recursively
      --reflink[=WHEN]         control clone/CoW copies. See below
      --remove-destination     remove each existing destination file before
                                 attempting to open it (contrast with --force)
      --sparse=WHEN            control creation of sparse files. See below
      --strip-trailing-slashes  remove any trailing slashes from each SOURCE
                                 argument
  -s, --symbolic-link          make symbolic links instead of copying
  -S, --suffix=SUFFIX          override the usual backup suffix
  -t, --target-directory=DIRECTORY  copy all SOURCE arguments into DIRECTORY
  -T, --no-target-directory    treat DEST as a normal file
  -u, --update                 copy only when the SOURCE file is newer
                                 than the destination file or when the
                                 destination file is missing
  -v, --verbose                explain what is being done
  -x, --one-file-system        stay on this file system
  -Z                           set SELinux security context of destination
                                 file to default type
      --context[=CTX]          like -Z, or if CTX is specified then set the
                                 SELinux or SMACK security context to CTX
      --help     display this help and exit
      --version  output version information and exit

By default, sparse SOURCE files are detected by a crude heuristic and the
corresponding DEST file is made sparse as well.  That is the behavior
selected by --sparse=auto.  Specify --sparse=always to create a sparse DEST
file whenever the SOURCE file contains a long enough sequence of zero bytes.
Use --sparse=never to inhibit creation of sparse files.

When --reflink[=always] is specified, perform a lightweight copy, where the
data blocks are copied only when modified.  If this is not possible the copy
fails, or if --reflink=auto is specified, fall back to a standard copy.

The backup suffix is '~', unless set with --suffix or SIMPLE_BACKUP_SUFFIX.
The version control method may be selected via the --backup option or through
the VERSION_CONTROL environment variable.  Here are the values:

  none, off       never make backups (even if --backup is given)
  numbered, t     make numbered backups
  existing, nil   numbered if numbered backups exist, simple otherwise
  simple, never   always make simple backups

As a special case, cp makes a backup of SOURCE when the force and backup
options are given and SOURCE and DEST are the same name for an existing,
regular file.

GNU coreutils online help: <http://www.gnu.org/software/coreutils/>
Report cp translation bugs to <http://translationproject.org/team/>
Full documentation at: <http://www.gnu.org/software/coreutils/cp>
or available locally via: info '(coreutils) cp invocation'
```
```
用法：cp [选项]... [-T] 源文件 目标文件
　或：cp [选项]... 源文件... 目录
　或：cp [选项]... -t 目录 源文件...
将源文件复制至目标文件，或将多个源文件复制至目标目录。


长选项必须使用的参数对于短选项时也是必需使用的。
  -a, --archive			等于-dR --preserve=all
      --backup[=CONTROL		为每个已存在的目标文件创建备份
  -b				类似--backup 但不接受参数
      --copy-contents		在递归处理是复制特殊文件内容
  -d				等于--no-dereference --preserve=links
  -f, --force			如果目标文件无法打开则将其移除并重试(当 -n 选项
					存在时则不需再选此项)
  -i, --interactive		覆盖前询问(使前面的 -n 选项失效)
  -H				跟随源文件中的命令行符号链接
  -l, --link			链接文件而不复制
  -L, --dereference		总是跟随符号链接
  -n, --no-clobber		不要覆盖已存在的文件(使前面的 -i 选项失效)
  -P, --no-dereference		不跟随源文件中的符号链接
  -p				等于--preserve=模式,所有权,时间戳
      --preserve[=属性列表	保持指定的属性(默认：模式,所有权,时间戳)，如果
					可能保持附加属性：环境、链接、xattr 等
  -c                           same as --preserve=context
      --sno-preserve=属性列表	不保留指定的文件属性
      --parents			复制前在目标目录创建来源文件路径中的所有目录
  -R, -r, --recursive		递归复制目录及其子目录内的所有内容
      --reflink[=WHEN]		控制克隆/CoW 副本。请查看下面的内如。
      --remove-destination	尝试打开目标文件前先删除已存在的目的地
					文件 (相对于 --force 选项)
      --sparse=WHEN		控制创建稀疏文件的方式
      --strip-trailing-slashes	删除参数中所有源文件/目录末端的斜杠
  -s, --symbolic-link		只创建符号链接而不复制文件
  -S, --suffix=后缀		自行指定备份文件的后缀
  -t,  --target-directory=目录	将所有参数指定的源文件/目录
                                           复制至目标目录
  -T, --no-target-directory	将目标目录视作普通文件
  -u, --update                 copy only when the SOURCE file is newer
                                 than the destination file or when the
                                 destination file is missing
  -v, --verbose                explain what is being done
  -x, --one-file-system        stay on this file system
  -Z, --context=CONTEXT        set security context of copy to CONTEXT
      --help		显示此帮助信息并退出
      --version		显示版本信息并退出


默认情况下，源文件的稀疏性仅仅通过简单的方法判断，对应的目标文件目标文件也
被为稀疏。这是因为默认情况下使用了--sparse=auto 参数。如果明确使用
--sparse=always 参数则不论源文件是否包含足够长的0 序列也将目标文件创文
建为稀疏件。
使用--sparse=never 参数禁止创建稀疏文件。


当指定了--reflink[=always] 参数时执行轻量化的复制，即只在数据块被修改的
情况下才复制。如果复制失败或者同时指定了--reflink=auto，则返回标准复制模式。


备份文件的后缀为"~"，除非以--suffix 选项或是SIMPLE_BACKUP_SUFFIX
环境变量指定。版本控制的方式可通过--backup 选项或VERSION_CONTROL 环境
变量来选择。以下是可用的变量值：


  none, off       不进行备份(即使使用了--backup 选项)
  numbered, t     备份文件加上数字进行排序
  existing, nil   若有数字的备份文件已经存在则使用数字，否则使用普通方式备份
  simple, never   永远使用普通方式备份


有一个特别情况：如果同时指定--force 和--backup 选项，而源文件和目标文件
是同一个已存在的一般文件的话，cp 会将源文件备份。
```
