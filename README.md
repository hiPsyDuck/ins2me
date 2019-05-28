<<<<<<< HEAD

#ins图片爬虫程序

1. 克隆到本地后在 *spider.php* 的 `curlSetOpt` 函数中填入你的socks5代理IP端口，代理怎么搞就不说了。

2.访问 index.php

在线使用：
https://cuntutu.liujiayang.cn/

小程序版：
![小程序码][1]  
[1]: https://www.liujiayang.cn/cuntutu/gh_c83a5fccd1be_430.jpg
=======
# ins2me
爬取ins图片
这里只上传了爬取图片的那部分代码，可直接运行抓取。

在线使用：
https://cuntutu.liujiayang.cn/

1. *spider.php* 的 `curlSetOpt` 函数中填入你的socks5代理，代理怎么搞就不说了。

2. *index.php* 中实例化测试：

```php
/* **
 *
 *  测试
 *
 * **/

$url = ''; //填入你从ins复制的链接
$index = new index($url);
$index->index();

```
>>>>>>> f579f4de9d791d734fa012cab711049dc079d8f2
