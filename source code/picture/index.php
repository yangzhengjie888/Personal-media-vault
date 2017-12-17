<html>
	<head>
	<meta charset="utf-8" />
		<title>在线相册管理</title>
	</head>
	<body>
		<center>
		<?php include("menu.php")?>
		<h3>发布相册信息</h3>
			<form action="doadd.php" method="post" enctype="multipart/form-data">
			<table width="200" border="0">
				<tr>
					<td>名称：</td>
					<td><input type="text" name="name"/></td>
				</tr>
				<tr>
					<td>图片：</td>
					<td><input type="file" name="pic"/></td>
				</tr>
				<tr>
					<td>说明：</td>
					<td><input type="text" name="info"/></td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<input type="submit" value="发布"/>
					</td>
				</tr>
				
			</form>
		</center>
	</body>
</html>