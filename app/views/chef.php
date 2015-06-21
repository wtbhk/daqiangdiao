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
    <link rel="stylesheet" href="css/chef.css">
</head>
<body class="sme">
    <div id="content">
        <div id="header">
            <div class="bg"></div>
            <div class="profile">
                <div class="avatar"><img src="<?php echo $chef->avatar()->resize(100,100); ?>" alt=""></div>
                <div id="chefname"><?php echo $chef->name; ?></div>
            </div>
        </div>

        <!-- 下面和list.php页面一样 -->
        <div class="imglist-3" id="productlist">
            <!-- <h2>菜品分类</h2> -->
            <ul class="imgbox">
                <?php $i=0;?>
                <?php $type=3;?>
                <?php foreach($chef->products as $product): ?>
                <li <?php if($i%$type==0&&$i!=0) echo 'class="first"'; ?> id="<?php echo $product->id; ?>">
                    <img src="<?php echo $product->mainImage()->resize(300,200); ?>" alt="">
                    <h3 class="productname"><div><span><?php echo $product->title; ?></span></div></h3>
                    <!-- 详情点击 -->
                    <a class="s" href="/product/<?php echo $product->id;?>"><i class="fa fa-share"></i></a>
                    <!-- 购物车内 -->
                    <?php if($product->inCart()) echo '<span class="checked"><i class="fa fa-check fa-2x"></i></span>';?>
                </li>
                <?php $i++; ?>
                <?php endforeach; ?>
            </ul>
            <div class="clear"></div>
        </div>
    </div>
    <?php require_once __DIR__.'/footer.php'; ?>
    <script type="text/javascript" src="js/jquery-2.1.0.min.js"></script>
    <script type="text/javascript" src="js/base.js"></script>
</body>
</html>