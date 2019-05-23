<?php

namespace app\demo\controller;

class Spider
{

    function imgSpider($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_PROXY, 'ip:port'); //使用socks5 代理，填入代理ip和端口
        curl_setopt($ch, CURLOPT_PROXYTYPE, 7); //socks5
        curl_setopt($ch, CURLOPT_PROXYUSERPWD, 'user:password'); //代理账号密码（如果有）
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($httpCode == 200 && $result) {
            echo "数据获取成功，正在提取图片...<br>";
            return $result;
        }
    }

    function getImgUrl($url)
    {
        $htmlContent = $this->imgSpider($url);
        if ($htmlContent) {
            /*利用正则表达式得到图片链接*/
            $reg_tag = '/src\":\"(.*?)\"/';
            $ret = preg_match_all($reg_tag, $htmlContent, $match_result);
            unset($htmlContent);
            if ($match_result[1]) {
                $imgUrls = array_unique($match_result[1]);
                echo "图片提取成功，正在下载...<br>";
                return $imgUrls;
            }
        }
    }

    public function downloadImage($imgUrl, $path = './static/img/')
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_PROXY, 'ip:port'); //使用socks5 代理，填入代理ip和端口
        curl_setopt($ch, CURLOPT_PROXYTYPE, 7); //socks5
        curl_setopt($ch, CURLOPT_PROXYUSERPWD, 'user:password'); //代理账号密码（如果有）
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        $file = curl_exec($ch);
        $this->saveAsImage($imgUrl, $file, $path);
    }

    public function saveAsImage($url, $file, $path)
    {
        // $filename = pathinfo($url, PATHINFO_BASENAME);
        $filename = 'img1.jpg';
        $resource = fopen($path . $filename, 'a');
        fwrite($resource, $file);
        echo '已下载：' . ++self::$succ_num . '张...<br>';
    }

}


