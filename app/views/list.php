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

                    <?php foreach($products as $product): ?>
                    <a href="/product/<?php echo $product->id;?>">
                    <div class="foodBox">
                        <div class="food-img">
                            <img src="<?php echo $product->one_image_url(); ?>" alt="">
                            <h2><?php echo $product->title; ?></h2>
                        </div>
                        <!-- price -->
                        <div class="maincontent overft">
                            <div class="left fl">
                                <h3><?php echo $product->description; ?></h3>
                                <p>请提前<?php echo $product->chineseReservation(); ?>天预订</p>
                            </div>
                            <div class="tag fr">
                                <div class="priceBox">
                                    <span class="price">￥<?php echo $product->price; ?></span>
                                </div>
                                <span class="remain">
                                    <span class="today">今</span>
                                    <span>剩<strong><?php echo $product->inventory_today(); ?></strong>份</span>
                                </span>
                            </div>
                        </div>
                    </div>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <?php require_once __DIR__.'/footer.php'; ?>
    <header>
        <div class="wrap">
            <a class="toHome fl" href="/">
            </a>
            <h1>所有菜品</h1>
            <a class="toUser fr" href="/profile"></a>
        </div>
    </header>
</body>
</html>
