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
    <title><?php echo $product->title;?> - 大腔调</title>
<link rel="stylesheet" href="/css/contentStyle.css">
</head>
<body class="sme">
    <div id="content">
        <div class="content-wrap">
            <div class="main" id="product">
                <div class="wrap">

                    <!-- 视频 -->
                    <div id="slide" class="overft">
                        <div class="slide-img">
                            <img src="<?php echo $product->mainImage()->resize(320, 200);?>" alt="">
                        </div>
                    </div>

                    <!-- price -->
                    <div class="maincontent overft">

                        <div class="fl">
                            <h2><?php echo $product->title; ?></h2>
                            <?php if($product->reservation_day>0):?>
                            <span class="order">提前<?php echo $product->reservation_day; ?>天预订</span>
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
                        <img src="<?php echo $image->resize(320, 200); ?>" alt="">
                        <?php endforeach; ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <?php require_once __DIR__.'/../footer.php'; ?>
    <header>
        <div class="wrap">
            <a class="toHome fl" href="/">
            </a>
            <h1><?php echo $product->title;?></h1>
            <a class="toUser fr" href="/profile"></a>
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
