<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
	<style>
		body {
			background-color: #FFFFFF;
			font-family: Arial, sans-serif;
			font-size: 14px;
			margin: 0;
			padding: 0;
		}

		form {
			margin: 20px;
			padding: 20px;
			border: 1px solid #CCCCCC;
			background-color: #F0F0F0;
			max-width: 500px;
			display: flex;
			flex-direction: column;
		}

		label {
			margin-bottom: 10px;
			font-weight: bold;
		}

		input[type="text"],
		input[type="password"] {
			padding: 5px;
			margin-bottom: 20px;
			font-size: 16px;
			border: none;
			border-radius: 3px;
		}

		input[type="submit"] {
			background-color: #336699;
			color: #FFFFFF;
			padding: 10px;
			border: none;
			border-radius: 3px;
			font-size: 16px;
			cursor: pointer;
		}

		input[type="submit"]:hover {
			background-color: #003366;
		}
	</style>
</head>
<body>
	<form action="register.php" method="post">
		<label for="username">Username:</label>
		<input type="text" id="username" name="username" required>

		<label for="password">Password:</label>
		<input type="password" id="password" name="password" required>

		<label for="confirm_password">Confirm Password:</label>
		<input type="password" id="confirm_password" name="confirm_password" required>

		<input type="submit" value="Register">
	</form>
</body>
</html>
