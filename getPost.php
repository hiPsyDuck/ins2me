<?php

namespace ins2me;
require_once dirname(__FILE__) . '/getInsImg.php';

use ins2me\getInsImg;

$postUrl = trim(htmlspecialchars(filter_input(INPUT_POST, 'httpUrl', FILTER_VALIDATE_URL)));
$reg = preg_match('/https:\/\/www\.instagram\.com\/(\S)+/', $postUrl);
if ($reg) {
    $getInsImg = new getInsImg($postUrl);
    $imgFileNames = $getInsImg->get();
    if (!empty($imgFileNames)) {
        $baseUrl = base64_encode(serialize($imgFileNames));
        header('location:imgWall.php?imgFileNames=' . $baseUrl);
    } else {
        $html = "
        <style>
           .error{ width: 500px;height: 70px;background: #80989b;box-shadow: #eee 2px 3px 5px;border: 1px #ddd solid; margin: 0 auto; margin-top: 10%; text-align: center}
           .error span{ color: #fff; line-height: 70px;}
           .error a{ color: #bbb; }
        </style>
        <div class='error'>
            <span>网络（富强民主文明和谐）请求失败，请返回重试</span>
            <p> <a href='javascript:void(0);' onclick='self.location=document.referrer;'>返回</a></p>
        </div>
        ";
        echo $html;
    }
} else {
    $html = "
        <style>
           .error{ width: 500px;height: 70px;background: #80989b;box-shadow: #eee 2px 3px 5px;border: 1px #ddd solid; margin: 0 auto; margin-top: 10%; text-align: center}
           .error span{ color: #fff; line-height: 70px;}
           .error a{ color: #bbb; }
        </style>
        <div class='error'>
            <span>请输入正确的链接</span>
            <p> <a href='javascript:void(0);' onclick='self.location=document.referrer;'>返回</a></p>
        </div>
    ";
    echo $html;
}

