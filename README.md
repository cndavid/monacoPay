
### MonacoPay 项目介绍
***
> 运行环境要求PHP > 5.6以上(推荐7.0.*)。

使用系统前请：

>详细开发文档参考 [ThinkPHP5完全开发手册](http://www.kancloud.cn/manual/thinkphp5)

### 项目结构

```
project                             应用部署目录
│
├─application                       应用目录
│  ├─admin                          后台模块目录
│  ├─api                            API模块目录
│  ├─common                         公共模块目录
│  ├─index                          前端模块目录
│  ├─command.php                    命令行工具配置文件
│  ├─common.php                     应用公共（函数）文件
│  ├─config.php                     应用（公共）配置文件
│  ├─database.php                   数据库配置文件
│  ├─tags.php                       应用行为扩展定义文件
│  ├─route.php                      路由配置文件
│  └─...
├─data                              数据存储目录
│  ├─cret                           证书文件
│  ├─crond                          Cron定时文件
│  ├─extend                         拓展类库
│  ├─runtime                        系统运行runtime目录
│  ├─supervisord                    supervisord配置目录
│  └─...
├─public                            Web 部署目录（对外访问目录）
│  ├─static                         静态资源存放目录(css,js,image)
│  ├─upload                         系统文件上传存放目录
│  ├─index.php                      入口文件
│  ├─.htaccess                      用于 apache 的重写
│  └─...
├─build.php                         自动生成定义文件（参考）
├─composer.json                     composer 定义文件
├─LICENSE.txt                       授权说明文件
├─README.md                         README 文件
└─think                             命令行入口文件
```
