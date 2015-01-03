<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0">
    <meta name="author" content="zvenshy@gmail.com">
    <title>后台管理</title>
    <link href="/manage/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/manage/css/style.min.css">
</head>
<body>
    <div class="row-fluid">
        <div class="span10 offset1">
            <legend>后台管理<small></legend>
        </div>
    </div>
    <div class="row-fluid"><div class="wrap"><div class="alert">正在处理...</div></div></div>
    <div class="row-fluid">
        <div class="wait span7 offset2 topOrder">
            <h3>新订单</h3>
            <ul>
                <li>
                    <ul class="unstyled fl">
                        <li><span class="fl">收件人</span><span class="fr">李艳艳</span></li>
                        <li><span class="fl">电话</span><span class="fr">12345678909</span></li>
                        <li><span class="fl">地址</span><span class="fr">华东交大华东交大华东交大华东交大华东交大华东交大华东交大华东交大华东交大华东交大</span></li>
                        <li><span class="fl">下单日期</span><span class="fr">2014-10-12 20:12</span></li>
                        <li><span class="fl">送达时间</span><span class="fr">2014-10-13 14:00</span></li>
                    </ul>
                    <ul class="unstyled fr">
                        <li><span class="fl">物品1</span><span>2</span><span class="fr">￥50.0</span></li>
                        <li><span class="fl">物品2</span><span>2</span><span class="fr">￥50.0</span></li>
                        <li><span class="fl">物品3</span><span>2</span><span class="fr">￥50.0</span></li>
                        <li><span class="fl">总价</span><span class="fr">￥150</span></li>
                        <li><span class="fl">在线支付</span><span class="fr">2014-10-13 14:00</span></li>
                    </ul>
                    <div class="btn-group">
                        <button class="btn btn-danger cOrder" type="button">关闭</button>
                        <button class="btn btn-primary rOrder" type="button">接受</button>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="row-fluid">
    
        <div class="tabbable span10 offset1" id="tabs-470124"> <!-- Only required for left/right tabs -->
          <ul class="nav nav-tabs">
            <li class="<?php if($action=='today') echo 'active';?>"><a href="/admin/order/today">待处理</a></li>
            <li class="<?php if($action=='all') echo 'active';?>"><a href="/admin/order/all">所有订单</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane" id="panel-684546">

                <div class="wait span8 offset1">
                    <ul>
                        <?php if($action=='today'):?>
                        <?php foreach($orders as $order):?>
                        <li>
                            <ul class="unstyled fl">
                                <li><span class="fl">收件人</span><span class="fr"><?php echo $order->name;?></span></li>
                                <li><span class="fl">电话</span><span class="fr"><?php echo $order->phone;?></span></li>
                                <li><span class="fl">地址</span><span class="fr"><?php echo $order->address;?></span></li>
                                <li><span class="fl">下单日期</span><span class="fr"><?php echo $order->created_at;?></span></li>
                                <li><span class="fl">送达时间</span><span class="fr"><?php echo $order->delivery;?></span></li>
                            </ul>
                            <ul class="unstyled fr">
                                <?php foreach($order->orderitems as $item):?>
                                <li><span class="fl"><?php echo $item->title;?></span><span><?php echo $item->amount;?></span><span class="fr">￥<?php echo $item->price;?></span></li>
                                <?php endforeach;?>
                                <li><span class="fl">总价</span><span class="fr">￥<?php echo $order->price;?></span></li>
                                <li><span class="fl">在线支付</span><span class="fr"><?php echo $order->payment ? 'YES' : 'NO';?></span></li>
                            </ul>
                            <?php if($order->status!=Order::CLOSED and $order->status!=Order::COMPLETED):?>
                            <div class="btn-group">
                                <button class="btn btn-danger cOrder" type="button"><a href="/admin/order/<?php echo $order->id;?>/status/closed">关闭</a></button>
                                <button class="btn btn-primary rOrder" type="button"><a href="/admin/order/<?php echo $order->id;?>/status/<?php echo $order->status+1;?>"><?php echo $order->next_step_chn();?></a></button>
                            </div>
                            <?php endif;?>

                        </li>
                        <?php endforeach;?>
                        <?php endif;?>
                    </ul>
                </div>

            </div>
            <div class="tab-pane active" id="panel-726754">
                <div class="wait span8 offset1">
                    <ul>
                        <?php if($action=='all'):?>
                        <?php foreach($orders as $order):?>
                        <li>
                            <ul class="unstyled fl">
                                <li><span class="fl">收件人</span><span class="fr"><?php echo $order->addressee;?></span></li>
                                <li><span class="fl">电话</span><span class="fr"><?php echo $order->phone;?></span></li>
                                <li><span class="fl">地址</span><span class="fr"><?php echo $order->address;?></span></li>
                                <li><span class="fl">下单日期</span><span class="fr"><?php echo $order->created_at;?></span></li>
                                <li><span class="fl">送达时间</span><span class="fr"><?php echo $order->delivery;?></span></li>
                            </ul>
                            <ul class="unstyled fr">
                                <?php foreach($order->orderitems as $item):?>
                                <li><span class="fl"><?php echo $item->title;?></span><span><?php echo $item->amount;?></span><span class="fr">￥<?php echo $item->price;?></span></li>
                                <?php endforeach;?>
                                <li><span class="fl">总价</span><span class="fr">￥<?php echo $order->price();?></span></li>
                                <li><span class="fl">在线支付</span><span class="fr"><?php echo $order->payment ? 'YES' : 'NO';?></span></li>
                            </ul> 
                            <?php if($order->status!=Order::CLOSED and $order->status!=Order::COMPLETED):?>
                            <div class="btn-group">
                                <button class="btn btn-danger cOrder" type="button"><a href="/admin/order/<?php echo $order->id;?>/status/closed">关闭</a></button>
                                <button class="btn btn-primary rOrder" type="button"><a href="/admin/order/<?php echo $order->id;?>/status/<?php echo $order->status+1;?>"><?php echo $order->next_step_chn();?></a></button>
                            </div>
                            <?php endif;?>
                        </li>
                        <?php endforeach;?>
                        <?php endif;?>
                    </ul>
                </div>
            </div>
          </div>
        </div>

    </div>
    
    <script src="/manage/js/jquery.min.js"></script>
    <script src="/manage/js/temp.js"></script>
    <script src="/manage/js/bootstrap.min.js"></script>
    <script src="/manage/js/main.js"></script>
</body>
</html>
