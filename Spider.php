<?php

namespace ins2me;

class Spider
{
    //本次下载的图片
    public static $imgFileNames = [];

    //图片保存路径
    private static $path = './img/';

    /** 获取图片url  **/
    public function imgSpider($url)
    {
        $ch = curl_init();
        self::curlSetOpt($ch, $url);
        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);
        if ($httpCode == 200 && $result) {
            return $result;
        }else{
            return $this->imgSpider($url);
        }
    }

    public function getImgUrl($url)
    {
        $htmlContent = self::imgSpider($url);
        if ($htmlContent) {
            /*利用正则表达式得到图片链接*/
            $reg_tag = '/display_url\":\"(.*?)\"/';
            $ret = preg_match_all($reg_tag, $htmlContent, $match_result);
            unset($htmlContent);
            if (!empty($match_result[1])) {
                $imgUrls = array_unique($match_result[1]);
                return $imgUrls;
            }
            return false;
        }
    }

    private function curlSetOpt(&$ch, $httpUrl)
    {
        curl_setopt($ch, CURLOPT_PROXY, "ip"); //代理服务器地址
        curl_setopt($ch, CURLOPT_PROXYPORT, port); //代理服务器端口
        curl_setopt($ch, CURLOPT_PROXYUSERPWD, "user:pwd"); //http代理认证帐号
        curl_setopt($ch, CURLOPT_PROXYTYPE, 7); //使用http代理模式
        curl_setopt($ch, CURLOPT_URL, $httpUrl);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    }

    /** 下载图片到img目录 **/
    public function downloadImage($imgUrl)
    {
        $ch = curl_init();
        self::curlSetOpt($ch, $imgUrl);
        $file = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);
        if ($httpCode == 200 && $file) {
            $this->saveAsImage($imgUrl, $file);
        }else{
            return $this->downloadImage($imgUrl);
        }
    }

    public function saveAsImage($url, $file)
    {
        $now = date('Y/m/d', time());
        $dir = self::$path . $now;
        if (is_dir($dir) !== true) {
            mkdir($dir, 0777, true);
            chmod($dir, 0777);
        }
        $path = $dir . '/';
        $filename = strchr(pathinfo($url, PATHINFO_BASENAME), '?', true);
        if (file_exists($path . $filename) === false) {
            $resource = fopen($path . $filename, 'a');
            $res = fwrite($resource, $file);
            if (false !== $res) {
                //记录本次下载的图片
                array_push(self::$imgFileNames, $path . $filename);
            }
        } else {
            array_push(self::$imgFileNames, $path . $filename);
        }
    }

    public function resolveImgFile($images)
    {
        foreach ($images as $image) {
            self::downloadImage($image);
        }
//        return self::$imgFileNames;
    }


}


