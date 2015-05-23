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
    <title>封厨榜 - 大腔调</title>
    <link rel="stylesheet" href="/css/cheflist.css">

</head>
<body>
    <div id="content">
        <div id="cheflist">
            <ul>
                <?php foreach($chefs as $chef): ?>
                <li>
                    <div class="avatar"><img src="<?php echo $chef->avatar()->resize(100,100); ?>" alt=""></div>
                    <div class="rank"><img src="/images/rank.jpg" alt=""></div>
                    <div class="header">
                        <span class="name"><?php echo $chef->name; ?></span>
                        <p class="profile"><?php echo $chef->profile; ?></p>
                    </div>
                    <div class="imglist">
                        <?php foreach($chef->products as $product): ?>
                        <img src="<?php echo $product->mainImage()->resize(150,100); ?>" alt="">
                        <?php endforeach; ?>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <?php require_once __DIR__.'/footer.php'; ?>
</body>
</html>