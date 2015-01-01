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
<link rel="stylesheet" href="/css/checkOrder.css">
</head>
<body class="sme">
    <div id="content">
        <div class="content-wrap">
            <div class="main">
                <div class="wrap">
                    
                    <div id="list">
                        <ul>

                            <li class="mar10" id="now">
                                <span class="fl">立即送达</span>
                                <span class="fr <?php echo $today ? 'checked' : ''; ?>"></span>
                            </li>
                            <li class="mar10 selectTime">
                                <span class="fl">选择时间</span>
                                <span class="fr more"></span>
                                <input type="text" id="time" class="<?php if($today) echo 'hidden'; ?> fr" placeholder <?php if(!$today) echo 'value="'.$date.'"'; ?>>

                            </li>

                            <?php foreach($cart as $item): ?>
                            <li class="order mar10">
                                <div class="fl">
                                    <img src="<?php echo $item->product->one_image_url(); ?>" alt="">
                                    <div class="foodName">
                                        <h3><?php echo $item->product->title; ?></h3>
                                        <span class="ignore">还剩<strong><?php echo $item->product->inventory_in($date); ?></strong>份</span>   
                                    </div>
                                </div>
                                <div class="fr">
                                    <div class="priceBox">
                                        <span class="delNum">—</span>
                                        <span class="number"><?php echo $item->qty; ?></span>
                                        <span class="price">￥<?php echo $item->product->price; ?></span>
                                    </div>
                                </div>
                            </li>
                            <?php endforeach; ?>
                            <form action="" method="POST">
                                <input type="hidden" name="today" value="true">
                                <input type="hidden" name="date" value="">
                                <?php 
                                $i = 0;
                                foreach($cart as $item):
                                ?>
                                <input type="hidden" name="items[<?php echo $i; ?>][id]" value="<?php echo $item->product->id; ?>">
                                <input type="hidden" name="items[<?php echo $i; ?>][qty]" value="<?php echo $item->qty; ?>">
                                <?php 
                                $i++;
                                endforeach; 
                                ?>
                            </form>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <footer class="foot-fixed">
        <div class="wrap">
            <input id="sub" type="submit" value="确认订单">
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
    <div id="modal" <?php if(!$errors) echo 'class="hidden"'; ?>>
        <div id="errorBox">
            <?php if($errors) var_dump($errors); ?>
            <div id="modalClose">&times</div>
        </div>

        <div id="mask"></div>
    </div>
    <script type="text/javascript" src="/js/jquery-2.1.0.min.js"></script>
    <script type="text/javascript" src="/js/jqueryui.js"></script>
    <script type="text/javascript" src="/js/jqueryui-timepicker.js"></script>
    <script type="text/javascript" src="/js/base.js"></script>
</body>
</html>
