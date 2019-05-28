<?php

require_once dirname(__FILE__) . '/getInsImg.php';

use ins2me\getInsImg;

$postUrl = trim(htmlspecialchars(filter_input(INPUT_POST, 'httpUrl', FILTER_VALIDATE_URL)));
$reg = preg_match('/https:\/\/www\.instagram\.com\/(\S)+/', $postUrl);

if ($reg) {
    $getInsImg = new getInsImg($postUrl);
    $imgFileNames = $getInsImg->get();
    if (!empty($imgFileNames)) {
        $imgFileUrl = array();
        foreach ($imgFileNames as $imgFileName) {
            $imgFileUrl[] = 'https://' . $_SERVER['HTTP_HOST'] . substr($imgFileName, 1);
        }
        codeStatus($imgFileUrl, 1);
    } else {
        codeStatus('网络开小差了，请重试');
    }
} else {
    codeStatus('请输入正确的链接');
}


function codeStatus($data, $no = -1)
{
    print_r(json_encode(array('no' => $no, 'msg' => $data)));
    exit;
}
