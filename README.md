# ins2me
爬取ins图片

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