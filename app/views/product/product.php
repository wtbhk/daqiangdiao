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
                            <img src="<?php echo $product->one_image_url();?>" alt="">
                        </div>
                    </div>

                    <!-- price -->
                    <div class="maincontent overft">

                        <div class="fl">
                            <h2><?php echo $product->title; ?></h2>
                            <?php if($product->reservation_day>0):?>
                            <span class="order">提前<?php echo $product->reservation_day; ?>天订单</span>
                            <?php endif;?>
                            <span class="remain">
                                <span class="today">今</span>
                                <span><strong><?php echo $product->inventory_today(); ?></strong>份</span>
                            </span>
                        </div>
                        <div class="fr">
                            <div class="priceBox" id="<?php echo $product->id; ?>">
                                <span class="del">—</span>
                                <span class="number"><?php echo $qty; ?></span>
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
            <a class="delivery fr" href="/cart">￥<?php echo $minimum_amount; ?>元 起送</a>
        </div>
    </footer>
    <header>
        <div class="wrap">
            <a class="set fl" href="/">
                <p></p>
                <p></p>
                <p></p>
            </a>
            <h1>标题</h1>
            <span class="toUser fr"></span>
        </div>
    </header>
    <div id="modal" class="hidden">
        <div id="errorBox">
            这里是错误提示这里是错误提示这里是错误提示
            <div id="modalClose">&times</div>
        </div>

        <div id="mask"></div>
    </div>
    <script type="text/javascript" src="/js/jquery-2.1.0.min.js"></script>
    <script type="text/javascript" src="/js/base.js"></script>
</body>
</html>
