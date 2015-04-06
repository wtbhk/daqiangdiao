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
			<legend>后台管理</legend>
			<div id="new"><a href="#loginModal" role="button" data-toggle="modal">新建</a></div>
		</div>
	</div>
	<div class="row-fluid"><div class="wrap"><div class="alert">正在处理...</div></div></div>
	<div class="row-fluid">

		<div id="score" class="span10 offset1">
			<table class="table table-hover">
				<thead>
					<tr>
						<th class='span2'>标题</th>
						<th class='span2'>描述</th>
						<th class='span3'>内容</th>
						<th class='span1'>价格</th>
						<th class='span1'>提前</th>
						<th class='span1'>库存</th>
						<th class='span1'>忽略</th>
						<th class='span1'>排序</th>
					</tr>
				</thead>
				<tbody>
                    <?php foreach($products as $product): ?>
						<tr>
                            <td><input type="text" disabled="disabled" name="title" value="<?php echo $product->title; ?>"></td>
							<td><input type="text" disabled="disabled" name="description" value="<?php echo $product->description; ?>"></td>
							<td><input type="text" disabled="disabled" name="content" value="<?php echo $product->content; ?>"></td>
							<td><input type="text" disabled="disabled" name="price" value="<?php echo $product->price; ?>"></td>
							<td><input type="text" disabled="disabled" name="reservation_day" value="<?php echo $product->reservation_day; ?>"></td>
							<td><input type="text" disabled="disabled" name="inventory_per_day" value="<?php echo $product->inventory_per_day; ?>"></td>
							<td><input type="checkbox" disabled="disabled" name="ignore_inventory" <?php if($product->ignore_inventory) echo 'checked="checked"'; ?>></td>
							<td><input type="text" disabled="disabled" name="rank" value="<?php echo $product->rank; ?>"></td>
						</tr>
						<tr id="<?php echo $product->id; ?>">
							<td>    
								<span class="btn btn-success fileinput-button">
						        <span>选择图片</span>
							        <input class="fileupload" type="file" name="image" disabled="disabled" multiple>
							    </span>
						    </td>
						    <td>    
						    	<table role="presentation" class="table table-striped">
							      <tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery">
							      </tbody>
							    </table>
							</td>
							<td>
								<ul class="imglist">
									<?php foreach($product->images as $image): ?>
									<li class="fl"><img id="<?php echo $image->id ;?> " src="<?php echo $image->resize(160,100) ;?>" alt=""></li>
									<?php endforeach; ?>
								</ul>
							</td>
							<td></td>
							<td><input type="submit" class="change" value="修改"><input type="submit" class="save hidden" value="保存"></td>
							<td><input type="submit" class="del" value="删除"><input type="submit" class="chanle hidden" value="取消"></td>
							<td></td>
							<td></td>
						</tr>
                                                <?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
	
	<script src="/manage/js/jquery.min.js"></script>
	<script src="/manage/js/jquery.ui.widget.js"></script>
	<script src="/manage/js/load.img.js"></script>
	<script src="/manage/js/canvas.js"></script>
	<script src="/manage/js/bootstrap.min.js"></script>
	<script src="/manage/js/jquery.iframe-transport.js"></script>
	<script src="/manage/js/jquery.fileupload.js"></script>
	<script src="/manage/js/temp.js"></script>
	<script src="/manage/js/main.js"></script>
</body>
</html>
