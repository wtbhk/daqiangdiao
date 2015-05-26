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
    <title>饕餮点单 - 大腔调</title>
    <link rel="stylesheet" href="css/productlist.css">
</head>
<body class="sme">
    <div id="content">
        <?php foreach($categories as $category): ?>
        <?php
            $count = count($category->products);
            $type = 1;
            if(in_array($count, array(1,2,3,6,9)))
                $type = 3;
            if(in_array($count, array(4,8)) || $count>=10)
                $type = 4;
            if($count == 5)
                $type = 5;
            $mod = $count % $type;
            $i = 0;
            $type = 3;//强行
        ?>
        <?php if($type==3): ?>
        <div class="imglist-3">
            <h2><?php echo $category->text; ?></h2>
            <ul class="imgbox">
                <?php foreach($category->products as $product): ?>
                <li <?php if($i%$type==0&&$i!=0) echo 'class="first"'; ?> id="<?php echo $product->id; ?>">
                    <img src="<?php echo $product->mainImage()->resize(300,200); ?>" alt="">
                    <h3 class="productname"><div><span><?php echo $product->title; ?></span></div></h3>
                    <!-- 详情点击 -->
                    <a class="s" href="/product/<?php echo $product->id;?>"><i class="fa fa-share"></i></a>
                    <!-- 购物车内 -->
                    <?php if($product->inCart()) echo '<a class="checked" href=""><i class="fa fa-check fa-2x"></i></a>';?>
                </li>
                <?php $i++; ?>
                <?php endforeach; ?>
            </ul>
            <div class="clear"></div>
        </div>
        <?php endif; ?>
        <?php if($type==4): ?>
        <div class="imglist-4">
            <h2><?php echo $category->text; ?></h2>
            <ul>
                <?php foreach($category->products as $product): ?>
                <li <?php if($i%$type==0&&$i!=0) echo 'class="first"'; ?>><a href=""><img src="<?php echo $product->mainImage()->resize(300,200); ?>" alt=""></a><div class="s"><i class="<?php if($product->inCart()){echo 'yes';}else{echo 'fa fa-circle-o';} ?>"></i></div></li>
                <?php $i++; ?>
                <?php endforeach; ?>
            </ul>
             <div class="clear"></div>
        </div>
        <?php endif; ?>
        <?php if($type==5): ?>
        <div class="imglist-5">
            <h2><?php echo $category->text; ?></h2>
            <div class="box">
                <?php
                    $products = $category->products;
                    $first = $products->shift();
                ?>
                <div class="fl"><img src="<?php echo $first->mainImage()->resize(400,400); ?>" alt=""></div>
                <ul class="fr">
                    <?php foreach($products as $product): ?>
                    <li><a href=""><img src="<?php echo $product->mainImage()->resize(300,200); ?>" alt=""></a><div class="s"><i class="<?php if($product->inCart()){echo 'yes';}else{echo 'fa fa-circle-o';} ?>"></i></div></li>
                    <?php endforeach; ?>
                </ul>
                 <div class="clear"></div>
             </div>
        </div>
        <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <?php require_once __DIR__.'/footer.php'; ?>
</body>
</html>