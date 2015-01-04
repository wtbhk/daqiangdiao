<!DOCTYPE HTML>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <meta name="keywords" content="rcss">
    <meta name="description" content="大腔调">
    <meta name="author" content="zvenshy@gmail.com">
    <title>用户中心</title>
<link rel="stylesheet" href="/css/userStyle.css">
</head>
<body class="sme">
    <div id="content">
        <div class="content-wrap">
            <div class="main">
                <div class="wrap">

                    <div id="banner"></div>

                    <div id="user">
                        <div class="fl"><img src="<?php echo $user->headimgurl; ?>" alt=""></div>
                        <div class="fr">
                            <span id="name"><?php echo $user->name ? $user->name : $user->nickname; ?></span>
                        </div>
                    </div>

                    <div id="list">
                        <ul>
                            <li id="extra">
                                <span class="fl">余额</span>
                                <span class="fr">￥<?php echo $user->balance; ?></span>
                            </li>
                            <a href="/phone"><li id="phoneNumber">
                                <span class="fl">手机号码</span>
                                <span class="fr">
                                    <span><?php echo $user->phone; ?></span>
                                    <span class="more"></span>
                                </span>
                            </li></a>
                            <li>
                                <span class="fl">收货地址</span>
                                <a class="fr add" href="address?redirect_to=/profile"></a>
                                <i class="y"></i>
                            </li>
                            <?php foreach($addressees as $addressee): ?>
                            <li>
                                <span class="fl">
                                    <p class="address"><?php echo $addressee->address; ?></p>
                                    <span class="name"><?php echo $addressee->name; ?></span>，<span class="phoneNumber"><?php echo $addressee->phone; ?></span>
                                </span>
                                <a class="fr del" href="/address/<?php echo $addressee->id;?>/delete"></a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>


                </div>
            </div>
        </div>
    </div>


    <header>
        <div class="wrap">
            <a class="set fl" href="/">
                <p></p>
                <p></p>
                <p></p>
            </a>
            <h1>用户中心</h1>
        </div>
    </header>
</body>
</html>
