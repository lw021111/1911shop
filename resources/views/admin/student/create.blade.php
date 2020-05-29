<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>学生添加</title>
</head>
<body>
	<form action="store" method="post">
	@csrf
		<table>
			<tr>
				<td>姓名</td>
				<td><input type="text" name="name"></td>
			</tr>
			<tr>
				<td>电话</td>
				<td><input type="text" name="tel"></td>
			</tr>
			<tr>
				<td></td>
				<td><button>添加</button></td>
			</tr>
		</table>
	</form>
</body>
</html>