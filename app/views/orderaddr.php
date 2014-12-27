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
                     <div id="list">
                        <ul>
                            <li id="addAddress" class="mar10">
                                <a href="#"></a>
                            </li>
                            <?php foreach($addressees as $addressee): ?>
                            <li class="mar10">
                                <span class="fl">
                                    <p class="address"><?php echo $addressee->address; ?></p>
                                    <span class="name"><?php echo $addressee->name; ?></span>，<span class="phoneNumber"><?php echo $addressee->phone; ?></span>
                                </span>
                                <?php echo $addressee->id==$checked ? '<span class="fr checked addressChecked"></span>' : ''; ?>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        <span class="tips fr"><i></i>请确认无误后保存</span>
                    </div>

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
