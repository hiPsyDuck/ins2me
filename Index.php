<?php

namespace ins2me;
require_once dirname(__FILE__) . '/Spider.php';
use ins2me\Spider;

class Index
{
    public $httpUrl;

    public function __construct($httpUrl) {
        //要抓取的ins图片的页面链接
        $this->httpUrl = $httpUrl;
    }

    public function index()
    {
        $spider = new Spider();
        $images = $spider->getImgUrl($this->httpUrl);
        if (is_array($images)){
            $spider->resolveImgFile($images);
        }
    }
}

