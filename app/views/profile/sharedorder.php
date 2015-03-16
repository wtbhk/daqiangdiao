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
    <title>晒单分享</title>
<link rel="stylesheet" href="css/shai.css">
</head>
<body class="sme">
    <div id="content">

        <div id="shai">
            <div id="img_upload">
                <div id="before" <?php echo $image ? 'class="hidden"' : ''; ?>
                    <div>
                        <span>点击上传照片</span>
                    </div>
                </div>
                <div id="after" <?php echo $image ? '' : 'class="hidden"'; ?>><img src="<?php echo $image ? $image->file : ''; ?>" alt=""/></div>
            </div>
            <form action="" method="post">
                <input type="file" class="hidden" id="file" accept="image/*" capture="camera"/>
                <?php if($content): ?>
                <textarea id="write" type="text" value="" placeholder="<?php echo $content; ?>" disabled></textarea>
	            <?php else: ?>
                <textarea id="write" type="text" value="" placeholder="点击修改分享内容"></textarea>
	            <?php endif; ?>
	            <?php if(!$shared): ?>
                <button type="submit">晒单</button>
	            <?php endif; ?>
            </form>
        </div>

        <div id="imglists">
            <ul>
            	<?php foreach($orderitems as $item): ?>
                <li>
                    <h2><?php echo $item->title; ?></h2>
                    <div class="imgs">
                    	<?php foreach($item->product->images as $image): ?>
                        <span><img src="<?php echo $image->file; ?>" alt=""/></span>
	                    <?php endforeach;?>
                    </div>
                </li>
	            <?php endforeach; ?>
            </ul>
        </div>

    </div>
    <footer>
        <div class="wrap">
            <p>世界上的食材如此繁多而独特，</p>
            <p>不同的组合</p>
            <p>便有完全不同的味蕾满足。</p>
            <p>感谢大自然，</p>
            <p>给我们如此丰富的世界。</p>
            <p>美食与爱不可辜负，</p>
            <p>看着看着不开心的事情</p>
            <p>又抛到脑后了 :)</p>
            <a href="/">美食直达</a>
        </div>
    </footer>
    <header>
        <div class="wrap">
            <a href="/" class="toHome fl"></a>
            <h1>晒单</h1>
            <a class="toUser fr" href="/profile"></a>
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

<?php
    echo $shared;
    var_dump($orderitems);