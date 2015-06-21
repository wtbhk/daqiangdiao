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
    <title>封厨榜单 - 大腔调</title>
    <link rel="stylesheet" href="/css/cheflist.css">

</head>
<body>
    <div id="content">
        <div id="cheflist">
            <ul>
                <?php foreach($chefs as $chef): ?>
                <a class="chefhref" href="/chef/<?php echo $product->id; ?>">
                    <li>
                        <div class="avatar"><img src="<?php echo $chef->avatar()->resize(100,100); ?>" alt=""></div>
                        <div class="rank"><img src="images/rank.png" alt=""></div>
                        <div class="header">
                            <span class="name"><?php echo $chef->name; ?></span>
                            <p class="profile"><?php echo $chef->profile; ?></p>
                        </div>
                        <div class="imglist">
                             <ul class="imgbox">
                                <?php $i=0; ?>
                                <?php foreach($chef->products as $product): ?>
                                <?php if($i==3) break; ?>
                                <li id="<?php echo $product->id; ?>">
                                    <img src="<?php echo $product->mainImage()->resize(300,200); ?>" alt="">
                                    
                                    <!-- 详情点击 -->
                                    <!-- <a class="s" href="/product/<?php echo $product->id;?>"><i class="fa fa-share"></i></a> -->
                                    <!-- 购物车内 -->
                                    <?php if($product->inCart()) echo '<span class="checked"><i class="fa fa-check fa-2x"></i></span>';?>
                                </li>
                                <?php $i++; ?>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </li>
                </a>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <?php require_once __DIR__.'/footer.php'; ?>
    <script type="text/javascript" src="/js/jquery-2.1.0.min.js"></script>
    <script type="text/javascript" src="/js/base.js"></script>
</body>
</html>