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
<link rel="stylesheet" href="/css/check.css">
</head>
<body class="sme">
    <div id="content">
        <div class="content-wrap">
            <div class="main">
                <div class="wrap">
                    
                    <div id="list">
                        <ul>
                            <li class="mar10">
                                <span class="fl">
                                    <p class="address">华东交通大学华东交通大学</p>
                                    <span class="name">李艳呀</span>，<span class="phoneNumber">1234567890</span>
                                </span>
                                <span class="fr more"></span>
                            </li>

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


                            <li class="mar10">
                                <span class="fl">货到付款</span>
                                <span class="fr checked"></span>
                            </li>
                            <li>
                                <span class="fl">
                                    <p>余额</p>
                                    <p class="ignore">剩余￥<?php echo $balance; ?></p>
                                </span>
                            </li>

                        </ul>
                    </div>


                    <form action="">
                        <input type="hidden" name="today" value="true">
                        <input type="hidden" name="time" value="">
                        <input type="hidden" name="items[0][id]" value="">
                        <input type="hidden" name="items[0][qty]" value="">
                        <input type="hidden" name="items[1][id]" value="">
                        <input type="hidden" name="items[1][qty]" value="">
                        <input type="hidden" name="items[2][id]" value="">
                        <input type="hidden" name="items[2][qty]" value="">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <footer class="foot-fixed">
        <div class="wrap">
            <input type="submit" value="确认订单">
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
    <div id="modal" class="hidden">
        <div id="errorBox">
            这里是错误提示这里是错误提示这里是错误提示
            <div id="modalClose">&times</div>
        </div>

        <div id="mask"></div>
    </div>
    <script type="text/javascript" src="js/jquery-2.1.0.min.js"></script>
    <script type="text/javascript" src="js/jqueryui.js"></script>
    <script type="text/javascript" src="js/jqueryui-timepicker.js"></script>
    <script type="text/javascript" src="js/base.js"></script>
</body>
</html>
