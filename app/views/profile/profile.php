<!DOCTYPE HTML>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <meta name="keywords" content="rcss">
    <meta name="description" content="商店demo">
    <meta name="author" content="zvenshy@gmail.com">
    <title>商店demo</title>
<link rel="stylesheet" href="css/userStyle.css">
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
                            <li id="phoneNumber">
                                <span class="fl">手机号码</span>
                                <span class="fr">
                                    <span><?php echo $user->phone; ?></span>
                                    <span class="more"></span>
                                </span>
                            </li>
                            <li>
                                <span class="fl">收货地址</span>
                                <span class="fr add"></span>
                                <i class="y"></i>
                            </li>
                            <?php foreach($user->addressees() as $addressee): ?>
                            <li>
                                <span class="fl">
                                    <p class="address"><?php echo $addressee->address; ?></p>
                                    <span class="name"><?php echo $addressee->name; ?></span>，<span class="phoneNumber"><?php echo $addressee->phone; ?></span>
                                </span>
                                <span class="fr del"></span>
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
            <span class="set fl">
                <p></p>
                <p></p>
                <p></p>
            </span>
            <h1>用户中心</h1>
        </div>
    </header>
</body>
</html>
