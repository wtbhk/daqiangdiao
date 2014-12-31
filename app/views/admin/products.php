<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0">
	<meta name="author" content="zvenshy@gmail.com">
	<title>后台管理</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/style.min.css">
</head>
<body>
	<div class="row-fluid">
		<div class="span10 offset1">
			<legend>后台管理<small></legend>
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
						<tr>
							<td><input type="text" disabled="disabled" value="标题2"></td>
							<td><input type="text" disabled="disabled" value="描述2"></td>
							<td><input type="text" disabled="disabled" value="内容2"></td>
							<td><input type="text" disabled="disabled" value="22.5"></td>
							<td><input type="text" disabled="disabled" value="3"></td>
							<td><input type="text" disabled="disabled" value="20"></td>
							<td><input type="checkbox" disabled="disabled" checked="checked"></td>
							<td><input type="text" disabled="disabled" value="2"></td>
						</tr>
						<tr id="0">
							<td>    
								<span class="btn btn-success fileinput-button">
						        <span>Select files...</span>
							        <input class="fileupload" type="file" name="files[]" disabled="disabled" multiple>
							    </span>
						    </td>
						    <td>    
						    	<table role="presentation" class="table table-striped">
							      <tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery">
							      </tbody>
							    </table>
							</td>
							<td></td>
							<td></td>
							<td><input type="submit" class="change" value="修改"><input type="submit" class="save hidden" value="保存"></td>
							<td><input type="submit" class="del" value="删除"><input type="submit" class="chanle hidden" value="取消"></td>
							<td></td>
							<td></td>
						</tr>

						<tr>
							<td><input type="text" disabled="disabled" name="title" value="标题1"></td>
							<td><input type="text" disabled="disabled" name="description" value="描述1"></td>
							<td><input type="text" disabled="disabled" name="content" value="内容1"></td>
							<td><input type="text" disabled="disabled" name="price" value="22.5"></td>
							<td><input type="text" disabled="disabled" value="3"></td>
							<td><input type="text" disabled="disabled" value="20"></td>
							<td><input type="checkbox" disabled="disabled" checked="checked"></td>
							<td><input type="text" disabled="disabled" value="2"></td>
						</tr>
						<tr id="1">
							<td>    
								<span class="btn btn-success fileinput-button">
						        <span>Select files...</span>
							        <input class="fileupload" type="file" name="files[]" disabled="disabled" multiple>
							    </span>
						    </td>
						    <td>    
						    	<table role="presentation" class="table table-striped">
							      <tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery">
							      </tbody>
							    </table>
							</td>
							<td></td>
							<td></td>
							<td><input type="submit" class="change" value="修改"><input type="submit" class="save hidden" value="保存"></td>
							<td><input type="submit" class="del" value="删除"><input type="submit" class="chanle hidden" value="取消"></td>
							<td></td>
							<td></td>
						</tr>

				</tbody>
			</table>
		</div>
	</div>
	
	<script src="js/jquery.min.js"></script>
	<script src="js/jquery.ui.widget.js"></script>
	<script src="js/load.img.js"></script>
	<script src="js/canvas.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.iframe-transport.js"></script>
	<script src="js/jquery.fileupload.js"></script>
	<script src="js/temp.js"></script>
	<script src="js/main.js"></script>
</body>
</html>