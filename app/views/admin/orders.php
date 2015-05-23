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
    <!-- nav -->
    <div class="row-fluid">
        <div class="span10 offset1">
           <div class="navbar">
                <div class="navbar-inner">
                    <div class="container-fluid">
                        <a class="brand" href="/admin">大腔调后台管理</a>
                        <div class="nav-collapse collapse navbar-responsive-collapse">
                            <ul class="nav">
                                <li><a href="/admin/order">订单</a></li>
                                <li><a href="/admin/product">菜品</a></li>
                                <li><a href="/admin/user">用户</a></li>
                                <li><a href="/admin/chef">厨师</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row-fluid"><div class="wrap"><div class="alert">正在处理...</div></div></div>

    <div class="row-fluid">
    
        <div class="tabbable span10 offset1" id="tabs-470124"> <!-- Only required for left/right tabs -->
          <ul class="nav nav-tabs">
            <li class="<?php if($action=='today') echo 'active';?>"><a href="/admin/order/today">待处理</a></li>
            <li class="<?php if($action=='all') echo 'active';?>"><a href="/admin/order/all">所有订单</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="panel-684546">

                <div class="wait span8 offset1">
                    <ul>
                        <?php if($action=='today'):?>
                        <?php foreach($orders as $order):?>
                        <li>
                            <ul class="unstyled fl">
                                <li><span class="fl">收件人</span><span class="fr"><?php echo $order->addressee;?></span></li>
                                <li><span class="fl">电话</span><span class="fr"><?php echo $order->phone;?></span></li>
                                <li><span class="fl">地址</span><span class="fr"><?php echo $order->address;?></span></li>
                                <li><span class="fl">下单日期</span><span class="fr"><?php echo $order->created_at;?></span></li>
                                <li><span class="fl">送达时间</span><span class="fr"><?php echo $order->isDeliveryNow() ? '立即送达' : $order->delivery;?></span></li>
                            </ul>
                            <ul class="unstyled fr">
                                <?php foreach($order->orderitems as $item):?>
                                <li><span class="fl"><?php echo $item->title;?></span><span><?php echo $item->amount;?></span><span class="fr">￥<?php echo $item->total;?></span></li>
                                <?php endforeach;?>
                                <li><span class="fl">总价</span><span class="fr">￥<?php echo $order->price;?></span></li>
                                <li><span class="fl">在线支付</span><span class="fr"><?php echo $order->payment ? '是' : '否';?></span></li>
                            </ul>
                            <?php if($order->status!=Order::CLOSED and $order->status!=Order::COMPLETED):?>
                            <div class="btn-group">
                                <button class="btn btn-danger cOrder" type="button"><a href="/admin/order/<?php echo $order->id;?>/status/<?php echo Order::CLOSED; ?>">关闭</a></button>
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
                    <?php if($action=='all'):?>
                    <ul>
                        <?php foreach($orders as $order):?>
                        <li>
                            <ul class="unstyled fl">
                                <li><span class="fl">收件人</span><span class="fr"><?php echo $order->addressee;?></span></li>
                                <li><span class="fl">电话</span><span class="fr"><?php echo $order->phone;?></span></li>
                                <li><span class="fl">地址</span><span class="fr"><?php echo $order->address;?></span></li>
                                <li><span class="fl">下单日期</span><span class="fr"><?php echo $order->created_at;?></span></li>
                                <li><span class="fl">送达时间</span><span class="fr"><?php echo $order->isDeliveryNow() ? '立即送达' : $order->delivery;?></span></li>
                            </ul>
                            <ul class="unstyled fr">
                                <?php foreach($order->orderitems as $item):?>
                                <li><span class="fl"><?php echo $item->title;?></span><span><?php echo $item->amount;?></span><span class="fr">￥<?php echo $item->total;?></span></li>
                                <?php endforeach;?>
                                <li><span class="fl">总价</span><span class="fr">￥<?php echo $order->price;?></span></li>
                                <li><span class="fl">在线支付</span><span class="fr"><?php echo $order->payment ? 'YES' : 'NO';?></span></li>
                            </ul> 
                            <?php if($order->status!=Order::CLOSED and $order->status!=Order::COMPLETED):?>
                            <div class="btn-group">
                                <button class="btn btn-danger cOrder" type="button"><a href="/admin/order/<?php echo $order->id;?>/status/<?php echo Order::CLOSED; ?>">关闭</a></button>
                                <button class="btn btn-primary rOrder" type="button"><a href="/admin/order/<?php echo $order->id;?>/status/<?php echo $order->status+1;?>"><?php echo $order->next_step_chn();?></a></button>
                            </div>
                            <?php endif;?>
                        </li>
                        <?php endforeach;?>
                    </ul>
                    <div class="pagination" style="text-align: center;">
                        <?php echo $orders->links(); ?>
                    </div>
                    <?php endif;?>
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
