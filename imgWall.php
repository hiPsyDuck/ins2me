<?php

require_once dirname(__FILE__) . '/Spider.php';

use ins2me\Spider;

$imgFileNames = unserialize(base64_decode(trim(htmlspecialchars($_GET['imgFileNames']))));
if (empty($imgFileNames)) {
    $errorHtml = "
        <style>
           .error{ width: 500px;height: 70px;background: #80989b;box-shadow: #eee 2px 3px 5px;border: 1px #ddd solid; margin: 0 auto; margin-top: 10%; text-align: center}
           .error span{ color: #fff; line-height: 70px;}
           .error a{ color: #bbb; }
        </style>
        <div class='error'>
            <span>获取数据出错了，重新试试</span>
            <p>  <a href='javascript:void(0);' onclick='self.location=document.referrer;'>返回</a></p>
        </div>
    ";
    echo $errorHtml;
    exit;
}

$html = '
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0, width=device-width" >
    <meta http-equiv="content-type" content="text/html; charset=utf-8" >
    <link rel="icon" type="image/png" href="https://www.liujiayang.cn/cuntutu/basicprofile.jpg" >
    <link href="https://www.liujiayang.cn/cuntutu/basicprofile.jpg" rel="icon" >
    <link rel="apple-touch-icon-precomposed" href="https://www.liujiayang.cn/cuntutu/basicprofile.jpg" >
    <meta name="description" content="粘贴ins图片链接，一键下载图片" >
    <meta name="keywords" content="存图图,下载ins图片" >
    <title>存图图</title>
    <link rel="stylesheet" href="css/dmaku.css" media="screen" type="text/css" />
</head>
<body>

<div class="clearfix" >
    <h1>点击图片保存</h1>
   <button class="send" onclick="self.location=document.referrer;">返回</button>
</div >
<ul >
';

foreach ($imgFileNames as $imgFileName) {
    $html .= '<li><a href="' . $imgFileName . '" download="ins.png"><img src="' . $imgFileName . '" /></a></li>';
}

$html .= '   
</ul>

</body>
</html>
';

echo $html;