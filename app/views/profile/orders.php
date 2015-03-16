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
<link rel="stylesheet" href="/css/myOrder.css">
</head>
<body class="sme">
    <div id="content">
        <div class="content-wrap">
            <div class="main">
                <div class="wrap">
                    
                    <div id="list">
                        <ul>
                            <?php foreach($orders as $order): ?>
                            <li class="mar10">
                                <span class="fl">
                                    <span class="type"><?php echo $order->status_chn(); ?></span>
                                    <span class="totalPrice">￥<?php echo $order->total; ?></span>
                                </span>
                                <span class="fr time"><?php echo $order->created_at; ?></span>   
                            </li>
                            <?php foreach($order->orderitems as $item): ?>
                            <li>
                                <div class="fl">
                                    <img src="<?php echo $item->image; ?>" alt="">
                                    <div class="foodName">
                                        <h3><?php echo $item->title; ?></h3>
                                        <span class="ignore"><?php echo $item->amount; ?>份</span>
                                    </div>
                                </div>
                                <div class="fr">
                                    <span class="price">￥<?php echo $item->total; ?></span>
                                </div>
                            </li>
                            <?php endforeach; ?>
                            <div class="clear shareOrder">
                                    <a href="">一键晒单</a>
                                </div>
                            <?php endforeach; ?>

                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <header>
        <div class="wrap">
            <a class="headBack fl" href="/profile">
            </a>
            <h1>我的订单</h1>
            <a class="toUser fr" href="/profile"></a>
        </div>
    </header>
</body>
</html>
