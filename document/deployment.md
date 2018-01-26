# XO UAT部署文档



## 依赖

__应用__

|名称|类型|版本|备注|
|:----|:----|:----|:----:|
|Nginx|服务器||或Openresty等其他nginx系列服务器|
|PHP|语言|7.0.22以上||
|MySQL|数据库|5.7 以上||
|Redis|缓存|推荐`4.0.1`以上||
|Composer|语言包管理||全局安装|
|gearmand|守护进程||
|supervisor|进程管理|||
|cronie|计划任务|||

__服务__

|名称|类型|版本|备注|
|:----|:----|:----|:----:|
|UCenter|用户中心|||
|Xunsearch|迅搜|||
|Convert|转码服务||待补充,可参考线上|
|Download|存储与下载||待补充,可参考线上|
|Rtmp|流媒体||待补充,可参考线上|



## Nginx

__配置`nginx.conf`__

```
# 运行用户
user nobody;
# 或其他用户名，和php等环境保持一致即可
```

```
# 请求体大小
client_max_body_size = 1024M
# 除了上面这个,ngx,php还有其他请求大小限制,请参考网上运维资料,尽量开大一些
```

```
# 注释掉默认404
#error_page 404 /404.html;
```

```
# php转发
location ~ \.php$ {
  try_files $uri /index.php =404;
  fastcgi_split_path_info ^(.+\.php)(/.+)$;
  fastcgi_pass 127.0.0.1:9000;
  fastcgi_index index.php;
  fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
  include fastcgi_params;
}
# 官方配置里默认注释,打开即可
# 127.0.0.1:9000是本地php-fpm服务默认ip:端口,也可以改
```

```
# 跨域等根据实际需求配置
```

__ngx配置站点__

```
# 参数
# 根路径, 指向代码下的public目录
# 首页, index.php
```

```
# 格式
# 标准laravel配置, 和线上或网盘一样,可以从运维同事那里复制一份
```

```
# 数量
# 有几个站就配置几个,也可以等拉完代码再配置
```



## PHP

__包__

```
# 默认包
php php-opcache php-devel php-mcrypt php-mysqlnd

# 扩展包（一般必须，请根据具体需求选择）
OpenSSL, GD, gearman, memcached（不是 memcache）, OpenSSL, PDO, Mbstring, Tokenizer

# 查看扩展安装信息
php -r 'phpinfo();' | grep 扩展名称
```

__配置__

```
# /etc/php.ini
post_max_size = 2048M
upload_max_filesize = 2048M
# 请根据需求变更，类似这句注释不用配置
```

```
# /etc/php-fpm.d/www.conf
user = nobody
group = nobody
listen = /var/run/php5-fpm.sock #注意版本,指向真实存在的.sock,这里只是例子
listen.owner = nobody
listen.group = nobody
listen.mode = 0660
# nobody只是本文档示例，可以自定义为其他用户名，保持一致即可
```



## MySQL

__配置__

```
# 端口、用户名、密码
# 如果是公网环境,切勿使用123456、111、abcdef等过于简单的密码
```



## Redis缓存

__配置__

|名称|项|安全环境|公网环境|
|:----|:----|:----:|:----:|
|端口|port|默认|推荐，修改|
|授权访问密码|requirepass|默认|必需，高强度|
|用户|运行|默认|推荐，避免root|
|来源ip|防火墙|默认|推荐，限制白名单|



## 用户中心

__说明__

+ 用户中心UCenter是一个独立服务, 代码独立, 用go语言开发, 运维同事关心它的ip:端口即可.
+ 仓库地址与配置方式, 请咨询用户中心开发者.
+ 如果暂时没有用户中心代码, 可以跳过,先部署网站.



## 迅搜

__说明__

+ 迅搜是一个独立服务, 第三方开发, 我们关心它的ip:端口即可.
+ 官方网站 http://www.xunsearch.com/ , 里面有官方代码与详细部署教程.
+ 可以跳过,先部署网站.

__环境依赖__
```
centos7.2.1511 开发环境是这个, 也可以是其他linux服务器
```

__工具依赖__
```
epel-release
tar
vim
wget
telnet
zlib-devel
supervisor
等
```

__下载代码__
```
wget http://www.xunsearch.com/download/xunsearch-full-latest.tar.bz2
```

__解压__
```
tar -xjf xunsearch-full-latest.tar.bz2
```

__安装__
```
cd xunsearch-full-*
echo -e "\n" | sh setup.sh
```

__配置__

```
# 以下是docker命令，请根据实际需要复制
COPY ./etc /etc
COPY ./run.sh /run.sh
```

__监听端口__

```
# xunsearch默认监听
8383 8384
```



## 网站代码

__说明__

+ b站,c站群, 它们的代码相同, 服务器环境相同, 只是代码里配置的参数不同
+ 可以参考线上配置.

__git clone代码__

```
# 以b站为例
```

```
# 拉取代码
cd your_path_任意新建命名_配置里指向正确即可
git clone git@gitlab.kobe.com:IEXO/net-disk.git master
# 具体仓库地址可能会被IT映射改写, 如果失败, 请咨询IT
```

```
# 修改权限
# 代码文件夹的用户与用户组
chown -R nobody:nobody /usr/local/apvideo-portal
# nobody:nobody只是本文档示例，请与nginx、php的实际配置保持一致
```

__复制配置__

```
# 复制config文件夹
cp ./example/config/* ./config/
# 仅首次部署允许复制文件夹
# 今后都禁止直接复制文件夹，如果有需要,请单个修改
```

```
# 复制.env
cp ./example/.env ./
# 禁止直接复制，请根据单个需求增量修改
# 仅首次部署允许全量复制
```

__修改配置__

```
# `config/commin`
cp ./example/.env ./
# 禁止直接复制，请根据单个需求增量修改
# 仅首次部署允许全量复制
```


## `.env`配置

__基本配置__

```
# 使用平台
platform=portal # 用户系
platform=admin # 管理系统api
```

```
# 环境
.env
APP_ENV=local # 根据线上情况修改，如 testing, production
APP_DEBUG=false # 关闭debug打印
APP_KEY= # 如果需要，可以重新生成APP_KEY
```

```
# 管理平台信息（portal、admin系统都要配置）
ADMIN_DOMAIN='http://10.72.2.41:4041'
ADMIN_IMAGE_URL='http://10.72.2.41:4041'
```

__文件权限__

```
chmod 给予php用户读写权限
包括且不限于/storage、/public目录
```

__nginx配置__

```
# 首页配置
public/index.php
```

__composer__

```
composer install
```

__概述__

    + b站: 1个前台portal, 1个后台admin, 共计2个网站.
    + c站群: 1个前台portal, 1个后台admin, 至少2个网站. 如果有要求, 也可以每个c站单独配置, n个c站配置n个.


## 数据库

__代码`.env`配置__
```
# mysql链接设置
DB_CONNECTION=mysql
DB_HOST=mysql # 数据库地址
DB_PORT=3306 # 建议使用其他端口
DB_DATABASE=apvideo # 可以改成其他名字
DB_USERNAME=root # 建议使用其他用户
DB_PASSWORD=111 # 务必改成强密码
```

__库迁移__
```
# 在用户或管理员代码目录执行
php artistan migrate
```

__库数据__
```
# 在用户或管理员代码目录执行
# 仅首次部署执行全部，以后只允许执行单个文件
# 请确认.env的APP_ENV不是local
php artisan db:seed
```

```
# 如果遇到seed类找不到，尝试刷新自动加载
composer dump-autoload
```

```
# 如果不小心执行了local下的test数据，可以修改.env的APP_ENV为生产环境，
# 重新执行migrate
php artisan migrate:refresh --seed
# 也可以单独执行某一个seeder文件
php artisan db:seed --class=XXXXXXXSeeder
```

## 用户中心服务

__代码`.env`配置__
```
# 用户中心
AUTH_USER_URL=http://www.usercenter.com     #用户中心域名
AUTH_KEY=e4a86cfcd723a957eccb48800e3855c6   #用户中心key
AUTH_UID=1499850328                         #用户中心UID
# 请根据真实配置，以上只是示例
```

__代码`.env`配置__
```
# redis配置
REDIS_HOST=redis    #redis服务地址
REDIS_PORT=6379     #建议修改
REDIS_PASSWORD=111  #务必修改
CACHE_DRIVER=redis
QUEUE_DRIVER=sync
# 修改配置后，请确认生效
```



__代码`.env`配置__
```
# 迅搜
SCOUT_DRIVER='xunsearch' #不用改
XUNSEARCH_INDEX_HOST='xunsearch:8383' #迅搜索引服务的地址和端口
XUNSEARCH_SEARCH_HOST='xunsearch:8384' #迅搜搜索服务的地址和端口
XUNSEARCH_SCHEMA_BRAND='config/user_files.ini' #不用改
```

__刷新索引__

```
# 刷新索引
# 在用户系统代码目录执行
php artisan scout:import "App\Model\UserFile"
php artisan scout:flush "App\Model\UserFile"
```


