<?php
session_start();

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	// Validate form data
	if (empty($_POST["username"])) {
		$_SESSION["error_message"] = "Please enter your username.";
		header("Location: login.php");
		exit();
	}

	if (empty($_POST["password"])) {
		$_SESSION["error_message"] = "Please enter your password.";
		header("Location: login.php");
		exit();
	}

	// Sanitize form data
	$username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
	$password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);

	// Connect to the database
	$conn = mysqli_connect("localhost", "yourusername", "yourpassword", "yourdatabase");

	// Check if the username exists
	$sql = "SELECT id, password FROM users WHERE username = ? LIMIT 1";
	$stmt = mysqli_prepare($conn, $sql);
	mysqli_stmt_bind_param($stmt, "s", $username);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $user_id, $hashed_password);
	mysqli_stmt_fetch($stmt);
	mysqli_stmt_close($stmt);

	if (isset($user_id)) {
		// Verify the password
		if (password_verify($password, $hashed_password)) {
			// Password is correct, set session variables
			$_SESSION["user_id"] = $user_id;
			$_SESSION["username"] = $username;
			$_SESSION["success_message"] = "You have successfully logged in.";
			header("Location: index.php");
			exit();
		} else {
			// Password is incorrect
			$_SESSION["error_message"] = "Incorrect password.";
			header("Location: login.php");
			exit();
		}
	} else {
		// Username doesn't exist
		$_SESSION["error_message"] = "The username does not exist.";
		header("Location: login.php");
		exit();
	}

	// Close the database connection
	mysqli_close($conn);

} else {
	// The form wasn't submitted, redirect to the login page
	header("Location: login.php");
	exit();
}
?>
