<?php

namespace ins2me;

class Spider
{
<<<<<<< HEAD
    //本次下载的图片
    public static $imgFileNames = [];

    //图片保存路径
    private static $path = './img/';

    /** 获取图片url  **/
    public function imgSpider($url)
    {
=======
    public static $downloadNumber = 0;
    public static $imgFileNames = [];
    private static $path = './img/';

    /** 获取图片url  **/
    public function imgSpider($url) {
>>>>>>> f579f4de9d791d734fa012cab711049dc079d8f2
        $ch = curl_init();
        self::curlSetOpt($ch, $url);
        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);
        if ($httpCode == 200 && $result) {
<<<<<<< HEAD
=======
            echo "数据获取成功，正在提取图片...\n";
>>>>>>> f579f4de9d791d734fa012cab711049dc079d8f2
            return $result;
        }else{
            return $this->imgSpider($url);
        }
    }

<<<<<<< HEAD
    public function getImgUrl($url)
    {
=======
    public function getImgUrl($url) {
>>>>>>> f579f4de9d791d734fa012cab711049dc079d8f2
        $htmlContent = self::imgSpider($url);
        if ($htmlContent) {
            /*利用正则表达式得到图片链接*/
            $reg_tag = '/display_url\":\"(.*?)\"/';
            $ret = preg_match_all($reg_tag, $htmlContent, $match_result);
            unset($htmlContent);
            if (!empty($match_result[1])) {
                $imgUrls = array_unique($match_result[1]);
<<<<<<< HEAD
=======
                echo "图片提取成功，正在下载...\n";
>>>>>>> f579f4de9d791d734fa012cab711049dc079d8f2
                return $imgUrls;
            }
            return false;
        }
    }

<<<<<<< HEAD
    private function curlSetOpt(&$ch, $httpUrl)
    {
        curl_setopt($ch, CURLOPT_PROXY, "ip"); //代理服务器地址
        curl_setopt($ch, CURLOPT_PROXYPORT, port); //代理服务器端口
        curl_setopt($ch, CURLOPT_PROXYUSERPWD, "user:pwd"); //http代理认证帐号
        curl_setopt($ch, CURLOPT_PROXYTYPE, 7); //使用http代理模式
=======
    private function curlSetOpt(&$ch, $httpUrl) {
        curl_setopt($ch, CURLOPT_PROXY, 'ip:port'); //使用socks5 代理，填入代理ip和端口
        curl_setopt($ch, CURLOPT_PROXYTYPE, 7); //socks5
        curl_setopt($ch, CURLOPT_PROXYUSERPWD, 'user:password'); //代理账号密码（如果有）
>>>>>>> f579f4de9d791d734fa012cab711049dc079d8f2
        curl_setopt($ch, CURLOPT_URL, $httpUrl);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
<<<<<<< HEAD
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
=======
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
>>>>>>> f579f4de9d791d734fa012cab711049dc079d8f2
    }


}


