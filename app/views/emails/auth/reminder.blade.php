<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>密码重置</h2>

		<div>
			要重置您的密码，请填写表单: {{ URL::to('password/reset', array($token)) }}.
		</div>
	</body>
</html>