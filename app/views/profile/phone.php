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
    <title>修改号码</title>
<link rel="stylesheet" href="/css/myOrder.css">
</head>
<body class="sme">
    <div id="content">
        <div class="content-wrap">
            <div class="main">
                <div class="wrap">
                    
                    <form action="profile" method="POST">
                        <input type="text" name="phone" value="<?php echo $user->phone; ?>">
                        <input type="submit" value="保存">
                        <span class="tips fr"><i></i>请确认无误后保存</span>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <header>
        <div class="wrap">
            <a class="headBack fl" href="/profile">
            </a>
            <h1>修改号码</h1>
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
    <script type="text/javascript" src="js/base.js"></script>
</body>
</html>
