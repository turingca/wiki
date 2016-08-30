什么是GitHooks？
----------------
话说，如同其他许多的版本控制系统一样，Git也具有在特定事件发生之前或之后执行特定脚本代码功能（从概念上类比，就与监听事件、触发器之类的东西类似）。Git Hooks就是那些在Git执行特定事件（如commit、push、receive等）后触发运行的脚本。
按照Git Hooks脚本所在的位置可以分为两类：

本地Hooks，触发事件如commit、merge等。
服务端Hooks，触发事件如receive等。
