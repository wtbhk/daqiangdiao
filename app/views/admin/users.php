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
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row-fluid"><div class="wrap"><div class="alert">正在处理...</div></div></div>
    <div class="row-fluid">

        <div id="userManager" class="span10 offset1">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class='span2'>昵称</th>
                        <th class='span2'>微信号</th>
                        <th class='span3'>内容</th>
                        <th class='span1'>内容</th>
                        <th class='span1'>内容</th>
                        <th class='span1'>内容</th>
                        <th class='span1'>余额</th>
                        <th class='span1'>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" disabled="disabled" value="昵称昵称昵称昵称昵称昵称"></td>
                        <td><input type="text" disabled="disabled" value="testtest"></td>
                        <td><input type="text" disabled="disabled" value="test"></td>
                        <td><input type="text" disabled="disabled" value="test"></td>
                        <td><input type="text" disabled="disabled" value="test"></td>
                        <td><input type="text" disabled="disabled" value="test"></td>
                        <td><input class="balance" type="text" disabled="disabled" value="200"></td>
                        <td><input class="change btn btn-primary" type="submit" value="修改"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <form class="hidden" action="" method="POST">
        <input class="real-balance" name="balance" type="text" value="">
    </form>
    
    <script src="/manage/js/jquery.min.js"></script>
    <script src="/manage/js/main.js"></script>
</body>
</html>