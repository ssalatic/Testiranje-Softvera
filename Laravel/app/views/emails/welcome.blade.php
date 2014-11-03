<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Account verification</h2>

		<div>
			To verify your account, follow this link:<br/>
			{{ URL::action('validate', array('token' => $token)) }}
		</div>
	</body>
</html>