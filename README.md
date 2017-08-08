## 指南

### what?

- 各种常用知识点的代码清单
    - 常见代码库中的细节
- 尽可能的少依赖开源的包
    - 这样大家学习成本低，不用看很多包的内容，直接最直接学习底层的内容

### 项目清单

1. redis命令incr原子性
    - 使用shell批量启动多个进程，产生竞态的前置条件

### 启动项目
1. 安装php7
1. 进入项目目录
1. 安装composer依赖
    1. 如果没有安装composer，[点击这里](https://getcomposer.org/download/)
    1. `composer install`
1. 利用php内置server启动
    - `php -S 127.0.0.1:8888 -t ./`
1. 打开浏览器，输入地址
    - `http://127.0.0.1:8888/`
1. 运行结果
    - 列表
        - ![welcome](/images/welcome.jpeg)
    - 点击具体程序
        - 如原子性incr
            - ![atomic](/images/atomic.jpeg)