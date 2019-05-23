<?php

namespace app\demo\controller;

use app\demo\controller\Spider;

class Index
{
    public function index()
    {
        
        $spider = new Spider;
        //要抓取的ins图片的链接
        $httpUrl = "";
        $images = $spider->getImgUrl($httpUrl);
        foreach ($images as $image) {
            $spider->downloadImage($image);
        }
        
    }
}
