<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form action="/test1" method="post">
	@csrf
		<table>
			<tr>
				<td>名字</td>
				<td><input type="text" name="name"></td>
			</tr>
			<tr>
				<td>电话</td>
				<td><input type="text" name="tel"></td>
			</tr>
			<tr>
				<td></td>
				<td><button>提交</button></td>
			</tr>		
		</table>
	</form>
</body>
</html>