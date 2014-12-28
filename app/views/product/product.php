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
<link rel="stylesheet" href="/css/contentStyle.css">
</head>
<body class="sme">
    <div id="content">
        <div class="content-wrap">
            <div class="main">
                <div class="wrap">

                    <!-- 视频 -->
                    <div id="slide" class="overft">
                        <div class="slide-img">
                            <img src="/images/slideImg1.jpg" alt="">
                        </div>
                    </div>

                    <!-- price -->
                    <div class="maincontent overft">

                        <div class="fl">
                            <h2><?php echo $product->title; ?></h2>
                            <span class="order">提前<?php echo $product->reservation_day; ?>天订单</span>
                            <span class="remain">
                                <span class="today">jin</span>
                                <span><strong><?php echo $product->inventory_today(); ?></strong>份</span>
                            </span>
                        </div>
                        <div class="fr">
                            <div class="priceBox">
                                <span class="del">—</span>
                                <span class="number">0</span>
                                <span class="price">￥<?php echo $product->price; ?></span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- 详细描述 -->
                    <div id="description">
                        <h2>菜品介绍</h2>
                        <p><?php echo $product->content; ?></p>
                        <?php foreach($product->images as $image): ?>
                        <img src="<?php echo $image->file; ?>" alt="">
                        <?php endforeach; ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <footer class="foot-fixed">
        <div class="wrap">
            <span class="get fl"></span>
            <span class="delivery fr">￥<?php echo $minimum_amount; ?>元 起送</span>
        </div>
    </footer>
    <header>
        <div class="wrap">
            <span class="set fl">
                <p></p>
                <p></p>
                <p></p>
            </span>
            <h1>标题</h1>
            <span class="toUser fr"></span>
        </div>
    </header>
</body>
</html>
