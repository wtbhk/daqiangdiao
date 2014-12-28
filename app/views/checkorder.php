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
<link rel="stylesheet" href="/css/check.css">
</head>
<body class="sme">
    <div id="content">
        <div class="content-wrap">
            <div class="main">
                <div class="wrap">
                    
                    <div id="list">
                        <ul>
                            <li class="mar10">
                                <span class="fl">
                                    <p class="address">华东交通大学华东交通大学</p>
                                    <span class="name">李艳呀</span>，<span class="phoneNumber">1234567890</span>
                                </span>
                                <span class="fr more"></span>
                            </li>

                            <li class="mar10">
                                <span class="fl">送达时间</span>
                                <?php if($date==date('Y-m-d')): ?>
                                <span class="fr ignore">立即送达</span>
                                <?php else: ?>
                                <span class="fr ignore"><?php echo $date; ?></span>
                                <?php endif; ?>
                            </li>
                            <li>
                                <span class="fl">订单总价</span>
                                <span class="fr price">￥<?php echo $price; ?></span>   
                            </li>


                            <li class="mar10">
                                <span class="fl">收货地址</span>
                                <span class="fr checked"></span>
                            </li>
                            <li>
                                <span class="fl">
                                    <p>余额</p>
                                    <p class="ignore">剩余￥<?php echo $balance; ?></p>
                                </span>
                            </li>

                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <footer class="foot-fixed">
        <div class="wrap">
            <input type="submit" value="确认订单">
        </div>
    </footer>
    <header>
        <div class="wrap">
            <span class="set fl">
                <p></p>
                <p></p>
                <p></p>
            </span>
            <h1>订单</h1>
            <span class="toUser fr"></span>
        </div>
    </header>
</body>
</html>
