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
            <a class="btn btn-success fileinput-button" id="modal-383601" href="#modal-container-383601" role="button"  data-toggle="modal">添加</a>
        </div>
    </div>
    <div class="row-fluid"><div class="wrap"><div class="alert">正在处理...</div></div></div>
    <div class="row-fluid">

        <div id="chefManager" class="span10 offset1">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class='span1'>序号</th>
                        <th class="span1">头像</th>
                        <th class='span2'>姓名</th>
                        <th class='span2'>手机号</th>
                        <th class="span3">个性签名</th>
                        <th class='span1'>权重</th>
                        <th class='span2'>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($chefs as $chef): ?>
                    <tr>
                        <td><input type="text" class="id" disabled="disabled" value="<?php echo $chef->id; ?>"</td>
                        <td><img class="avatar" src="<?php echo $chef->avatar()->resize(100,100); ?>" alt="avatar"></td>
                        <td><input type="text" class="name" disabled="disabled" value="<?php echo $chef->name; ?>" placeholder="姓名" required></td>
                        <td><input type="number" class="phone" disabled="disabled" value="<?php echo $chef->phone; ?>" placeholder="手机号" required></td>
                        <td><input type="text" class="profile" disabled="disabled" value="<?php echo $chef->profile; ?>"></td>
                        <td><input type="text" class="rank" disabled="disabled" value="<?php echo $chef->rank; ?>"></td>
                        <td>
                            <button class="btn btn-primary change" type="button">修改</button>
                            <button class="btn btn-danger delete" type="button">删除</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- modal for add a chef -->
    <div class="view">
    <div id="modal-container-383601" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <h3 id="myModalLabel">添加厨师</h3>
        </div>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="modal-body">           
                    <input type="text" name="name" placeholder="厨师名">
                    <input type="text" name="phone" placeholder="手机号">
                    <input type="text" name="profile" placeholder="个性签名">
                    <input type="text" name="rank" placeholder="排序">
                    <input type="file" name="avatar" accept="image/*">
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
                <button class="btn btn-primary" type="submit">提交</button>
            </div>
        </form>
    </div>
    </div>
    <!-- this is a hidden form for Ajax -->
    <form class="hidden" action="" method="POST" enctype="multipart/form-data">
        <input type="text" name="id">
        <input type="file" name="avatar" accept="image/*">
        <input type="text" name="name">
        <input type="text" name="phone">
        <input type="text" name="profile">
        <input type="text" name="rank">
    </form>
    
    <script src="/manage/js/jquery.min.js"></script>
    <script src="/manage/js/bootstrap.min.js"></script>
    <script src="/manage/js/main.js"></script>
</body>
</html>