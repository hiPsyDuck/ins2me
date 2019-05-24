<?php

namespace ins2me;

class Spider
{
    public static $downloadNumber = 0;
    public static $imgFileNames = [];
    private static $path = './img/';

    /** 获取图片url  **/
    public function imgSpider($url) {
        $ch = curl_init();
        self::curlSetOpt($ch, $url);
        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($httpCode == 200 && $result) {
            echo "数据获取成功，正在提取图片...\n";
            return $result;
        }
    }

    public function getImgUrl($url) {
        $htmlContent = self::imgSpider($url);
        if ($htmlContent) {
            /*利用正则表达式得到图片链接*/
            $reg_tag = '/src\":\"(.*?)\"/';
            $ret = preg_match_all($reg_tag, $htmlContent, $match_result);
            unset($htmlContent);
            if (!empty($match_result[1])) {
                $imgUrls = array_unique($match_result[1]);
                echo "图片提取成功，正在下载...\n";
                return $imgUrls;
            }
            return false;
        }
    }

    private function curlSetOpt(&$ch, $httpUrl) {
        curl_setopt($ch, CURLOPT_PROXY, 'ip:port'); //使用socks5 代理，填入代理ip和端口
        curl_setopt($ch, CURLOPT_PROXYTYPE, 7); //socks5
        curl_setopt($ch, CURLOPT_PROXYUSERPWD, 'user:password'); //代理账号密码（如果有）
        curl_setopt($ch, CURLOPT_URL, $httpUrl);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    }

    /** 下载图片到img目录 **/
    public function downloadImage($imgUrl) {
        $ch = curl_init();
        self::curlSetOpt($ch, $imgUrl);
        $file = curl_exec($ch);
        curl_close($ch);
        $this->saveAsImage($imgUrl, $file);
    }

    public function saveAsImage($url, $file) {
        $filename = strchr(pathinfo($url, PATHINFO_BASENAME), '?', true);
        if (file_exists(self::$path . $filename)) {
            //如果已存在则删除（用来获取最大尺寸的图片）
            unlink(self::$path . $filename);
        }
        $resource = fopen(self::$path . $filename, 'a');
        $res = fwrite($resource, $file);
        if (false !== $res && !in_array($filename, self::$imgFileNames)) {
            //记录本次下载的图片
            array_push(self::$imgFileNames, $filename);
            echo "成功下载 " . ++self::$downloadNumber . " 张...\n";
        }
    }

    public function resolveImgFile($images) {
        foreach ($images as $image) {
            self::downloadImage($image);
        }
        echo "下载完成！";
    }


}


