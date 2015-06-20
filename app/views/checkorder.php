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
    <title>订单 - 大腔调</title>
<link rel="stylesheet" href="/css/check.css">
</head>
<body class="sme">
    <div id="content">
        <div class="content-wrap">
            <div class="main">
                <div class="wrap">
                    
                    <div id="list">
                        <ul>
                            <?php if(!$addressee): ?>
                            <a href="orderaddr"><li class="mar10">
                                <span class="fl">添加收货地址</span>
                                <span class="fr add" style="margin-top:7px;"></span>
                            </li></a>
                            <?php else: ?>
                            <a href="orderaddr"><li class="mar10">
                                <span class="fl">
                                    <p class="address"><?php echo $addressee->address; ?></p>
                                    <span class="name"><?php echo $addressee->name; ?></span>，<span class="phoneNumber"><?php echo $addressee->phone; ?></span>
                                </span>
                                <span class="fr more"></span>
                            </li></a>
                            <?php endif; ?>

                            <li class="mar10">
                                <span class="fl">送达时间</span>
                                <?php if($date==date('Y-m-d')): ?>
                                <span class="fr ignore">立即送达</span>
                                <?php else: ?>
                                <span class="fr ignore"><?php echo $date; ?></span>
                                <?php endif; ?>
                            </li>
                            <li>
                                <span class="fl">订单总价</span>
                                <span class="fr price">￥<?php echo $price; ?></span>   
                            </li>


                            <li class="mar10" id="payment">
                                <span class="fl">货到付款</span>
                                <span class="fr checked"></span>
                            </li>
                            <li id="balance">
                                <span class="fl">
                                    <p>余额支付</p>
                                    <p class="ignore">剩余￥<?php echo $balance; ?></p>
                                </span>
                                <span class="fr"></span>
                            </li>

                        </ul>
                    </div>


                    <form id="checkorder" action="" method="POST">
                            <input type="hidden" name="payment" value="cash">
                            <input type="hidden" name="addressee" value="<?php echo $addressee ? $addressee->id : ''; ?>">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <footer class="foot-fixed">
        <div class="wrap">
            <input id="subCheckOrder" type="submit" value="确认订单">
        </div>
    </footer>
<!--     <header>
    <div class="wrap">
        <a class="headBack fl" href="/cart">
        </a>
        <h1>订单</h1>
        <a class="toUser fr" href="/profile"></a>
    </div>
</header> -->
    <div id="modal" <?php if(!$errors->first('message')) echo 'class="hidden"';?>>
        <div id="errorBox">
            <?php if($errors->first('message')) echo $errors->first('message');?>
            <div id="modalClose">&times</div>
        </div>

        <div id="mask"></div>
    </div>
    <script type="text/javascript" src="js/jquery-2.1.0.min.js"></script>
    <script type="text/javascript" src="js/base.js"></script>
</body>
</html>
