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
    <title>添加地址</title>
<link rel="stylesheet" href="/css/myOrder.css">
</head>
<body class="sme">
    <div id="content">
        <div class="content-wrap">
            <div class="main">
                <div class="wrap">
                    
                    <form action="" method="POST">
                        <input type="text" name="address" value="" placeholder="收货地址">
                        <input class="mar5" type="text" name="name" value="<?php echo $user->name; ?>" placeholder="联系人">
                        <input class="next" type="text" name="phone" value="<?php echo $user->phone; ?>" placeholder="联系方式">
                        <input type="hidden" name="redirect_to" value="<?php echo $redirect_to; ?>">
                        <input type="submit" value="保存">
                        <span class="tips fr"><i></i>请确认无误后保存</span>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <header>
        <div class="wrap">
            <a class="headBack fl" href="/">
            </a>
            <h1>添加地址</h1>
        </div>
    </header>
</body>
</html>
