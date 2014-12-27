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
<link rel="stylesheet" href="css/myOrder.css">
</head>
<body class="sme">
    <div id="content">
        <div class="content-wrap">
            <div class="main">
                <div class="wrap">
                    
                    <form action="">
                        <input type="text" value="" placeholder="收货地址">
                        <input class="mar5" type="text" value="<?php echo $user->name; ?>" placeholder="联系人">
                        <input class="next" type="text" value="<?php echo $user->phone; ?>" placeholder="联系方式">
                        <input type="submit" value="保存">
                        <span class="tips fr"><i></i>请确认无误后保存</span>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <header>
        <div class="wrap">
            <span class="headBack fl">
            </span>
            <h1>添加地址</h1>
            <span class="toUser fr"></span>
        </div>
    </header>
</body>
</html>
