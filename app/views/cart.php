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
    <title>购物车</title>
<link rel="stylesheet" href="/css/bootstrap.min.css">
<link rel="stylesheet" href="/css/checkOrder.css">
</head>
<body class="sme">
    <div id="content">
        <div class="content-wrap">
            <div class="main" id="cart">
                <div class="wrap">
                    
                    <div id="list">
                        <ul>

                            <li class="mar10" id="now">
                                <span class="fl">立即送达</span>
                                <span class="fr <?php echo $today ? 'checked' : ''; ?>"></span>
                            </li>
                            <li class="selectTime">
                                <span class="fl">选择时间</span>
                                <span class="fr more"></span>
                                <div class="form-group <?php if($today) echo 'hidden'; ?> fr" id="timepicker">
                                    <div class="input-group date form_time" data-date-format="hh:ii" data-link-field="hidden-date" data-link-format="yyyy-mm-dd hh:ii">
                                        <input id="time" class="form-control" size="20" data-link-field="hidden-date" type="text" <?php if(!$today) echo 'value="'.$date.'"'; ?> readonly>
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </li>

                            <?php foreach($cart as $item): ?>
                            <li class="order mar10">
                                <div class="ordertitle">
                                    <h3><?php echo $item->product->title; ?></h3>
                                    <?php if(!$item->product->checkReservation($date)):?>
                                    <span class="ignore">提前<strong class="day"><?php echo $item->product->reservation_day;?></strong>天预订</span>
                                    <?php endif;?>
                                </div>
                                <div class="imgs">
                                    <?php $j=0; ?>
                                    <?php $images = $item->product->images; ?>
                                    <?php foreach($images as $image): ?>
                                    <?php if($j==3) break; ?>
                                    <?php $j++; ?>
                                    <span><img src="<?php echo $image->resize(320, 200); ?>" alt=""></span>
                                    <?php endforeach; ?>
                                </div>
                                <div class="fl">
                                    <span class="ignore">还剩<strong class="liu"><?php echo $item->product->inventory_in($date)->inventory; ?></strong>份</span>
                                </div>
                                <div class="fr">
                                    <div class="priceBox" id="<?php echo $item->id; ?>">
                                        <span class="delNum">—</span>
                                        <span class="number"><?php echo $item->qty; ?></span>
                                        <span class="price">￥<?php echo $item->product->price; ?></span>
                                    </div>
                                </div>
                            </li>
                            <?php endforeach; ?>
                            <form action="" method="POST">
                                <input type="hidden" name="today" value="<?php echo $today ? true : false; ?>">
                                <input type="hidden" name="date" id="hidden-date" value="<?php echo $today ? '' : $date; ?>">
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
            <input id="sub" type="submit" value="确认购物车">
        </div>
    </footer>
    <header>
        <div class="wrap">
            <a class="toHome fl" href="/">
            </a>
            <h1>购物车</h1>
            <a class="toUser fr" href="/profile"></a>
        </div>
    </header>
    <div id="modal" <?php if(!$errors->first('message')) echo 'class="hidden"'; ?>>
        <div id="errorBox">
            <?php if($errors->first('message')) echo $errors->first('message'); ?>
            <div id="modalClose">&times</div>
        </div>

        <div id="mask"></div>
    </div>
    <script type="text/javascript" src="/js/jquery-2.1.0.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="/js/base.js"></script>
</body>
</html>
