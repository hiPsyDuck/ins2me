<html>
<head>
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0, width=device-width">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <link rel="icon" type="image/png" href="https://www.liujiayang.cn/cuntutu/basicprofile.jpg">
    <link href="https://www.liujiayang.cn/cuntutu/basicprofile.jpg" rel="icon">
    <link rel="apple-touch-icon-precomposed" href="https://www.liujiayang.cn/cuntutu/basicprofile.jpg">
    <meta name="description" content="粘贴ins图片链接，一键下载图片">
    <meta name="keywords" content="存图图,下载ins图片">
    <title>存图图</title>
    <style type="text/css">

        .useIntro{
            right: 25px;
            top: 25px;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            background: #80989b;
            border: 1px #aaa solid;
            text-align: center;
            position: absolute;
        }

        .useIntro button:hover{
            cursor: pointer;
        }

        .useIntro button{
            color: #fff;
            font-size: 11px;
            width: 50px;
            height: 50px;
            background: none;
            border-radius: 50%;
            border: 3px #80989b solid;
        }

        .pic {
            padding-top: 12%;
            text-align: center;
            margin-bottom: 30px;
        }

        .logo {
            height: 130px;
            width: 130px;
        }

        .search {
            text-align: center;
        }

        .input {
            width: 30%;
            height: 36px;
            border-radius: 50px;
        }

        .btn {
            border: 0;
            width: 80px;
            height: 40px;
            background: #80989b;
            font-size: 15px;
            color: #fff;
            border-radius: 50px;
        }
        .btn:hover{
            cursor: pointer;
        }
    </style>
    <style>
        .spinner {
            margin: 100px auto;
            width: 50px;
            height: 60px;
            text-align: center;
            font-size: 10px;
            display: none;
        }

        .spinner > div {
            background-color: #80989b;
            height: 100%;
            width: 6px;
            display: inline-block;

            -webkit-animation: stretchdelay 1.2s infinite ease-in-out;
            animation: stretchdelay 1.2s infinite ease-in-out;
        }

        .spinner .rect2 {
            -webkit-animation-delay: -1.1s;
            animation-delay: -1.1s;
        }

        .spinner .rect3 {
            -webkit-animation-delay: -1.0s;
            animation-delay: -1.0s;
        }

        .spinner .rect4 {
            -webkit-animation-delay: -0.9s;
            animation-delay: -0.9s;
        }

        .spinner .rect5 {
            -webkit-animation-delay: -0.8s;
            animation-delay: -0.8s;
        }

        .spinner p{
            color: #aaaaaa;
        }

        @-webkit-keyframes stretchdelay {
            0%, 40%, 100% { -webkit-transform: scaleY(0.4) }
            20% { -webkit-transform: scaleY(1.0) }
        }

        @keyframes stretchdelay {
            0%, 40%, 100% {
                transform: scaleY(0.4);
                -webkit-transform: scaleY(0.4);
            }
            20% {
                transform: scaleY(1.0);
                -webkit-transform: scaleY(1.0);
            }
        }
    </style>
</head>

<body>
<div>
<div class="body">
    <div class="useIntro">
        <button onclick="showIntro()">
            使用教程
        </button>
    </div>
    <div class="pic">
        <img class="logo" src="https://www.liujiayang.cn/cuntutu/gh_c83a5fccd1be_430.jpg">
        <p class="phoneText" style="display: none">手机用户请长按识别小程序码进入小程序</p>
    </div>
    <div class="search">
        <form action="getPost.php" method="post" onsubmit="return loading()">
            <input class="input" type="text" name="httpUrl" value=""/>
            <input class="btn" type="submit" value="找图"/>
        </form>
    </div>
</div>

<div class="spinner">
    <div class="rect1"></div>
    <div class="rect2"></div>
    <div class="rect3"></div>
    <div class="rect4"></div>
    <div class="rect5"></div>
    <p>请稍等..</p>
</div>

</body>
</html>
<script src="https://cdn.bootcss.com/jquery/3.1.1/jquery.min.js"></script>
<script>
    function loading() {

    }

    function showIntro() {
        window.open("https://www.liujiayang.cn/cuntutu/存图图使用说明.jpg");
    }


    (function() {
        var sUserAgent = navigator.userAgent;
        if (sUserAgent.indexOf('Android') > -1 || sUserAgent.indexOf('iPhone') > -1 || sUserAgent.indexOf('iPad') > -1 || sUserAgent.indexOf('iPod') > -1 || sUserAgent.indexOf('Symbian') > -1) {
            $(".useIntro").css('display','none');
            $(".search").css('display','none');
            $(".phoneText").css('display','block');
        } else {}
    })();

</script>