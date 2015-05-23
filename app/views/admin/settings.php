<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0">
    <meta name="author" content="zvenshy@gmail.com">
    <title>后台管理</title>
    <link href="/manage/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
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
    <div class="span10 offset3" style="margin-top: 30px;">
        <form class="form-horizontal">
            <div class="control-group">
                <label class="control-label" for="inputEmail">起送价格: </label>
                <div class="controls"><input id="inputEmail" placeholder="￥" type="text" /></div>
            </div>

        <div class="control-group">
            <div class="controls"><button class="btn" type="submit">确定</button></div>
        </div>
        </form>
    </div>
</body>
</html>