<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION["username"])) {
	header("Location: index.php");
	exit();
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	// Validate form data
	if (empty($_POST["username"])) {
		$_SESSION["error_message"] = "Please enter a username.";
		header("Location: signup.php");
		exit();
	}

	if (empty($_POST["password"])) {
		$_SESSION["error_message"] = "Please enter a password.";
		header("Location: signup.php");
		exit();
	}

	if ($_POST["password"] !== $_POST["confirm_password"]) {
		$_SESSION["error_message"] = "The passwords do not match.";
		header("Location: signup.php");
		exit();
	}

	// Sanitize form data
	$username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
	$password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);

	// Hash the password
	$hashed_password = password_hash($password, PASSWORD_DEFAULT);

	// Connect to the database
	$conn = mysqli_connect("localhost", "yourusername", "yourpassword", "yourdatabase");

	// Check if the username already exists
	$sql = "SELECT id FROM users WHERE username = ? LIMIT 1";
	$stmt = mysqli_prepare($conn, $sql);
	mysqli_stmt_bind_param($stmt, "s", $username);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_store_result($stmt);
	if (mysqli_stmt_num_rows($stmt) > 0) {
		$_SESSION["error_message"] = "The username is already taken.";
		header("Location: signup.php");
		exit();
	}

	// Insert the user into the database
	$sql = "INSERT INTO users (username, password) VALUES (?, ?)";
	$stmt = mysqli_prepare($conn, $sql);
	mysqli_stmt_bind_param($stmt, "ss", $username, $hashed_password);
	if (mysqli_stmt_execute($stmt)) {
		$_SESSION["success_message"] = "You have successfully registered.";
		header("Location: login.php");
		exit();
	} else {
		$_SESSION["error_message"] = "There was an error registering your account. Please try again later.";
		header("Location: signup.php");
		exit();
	}

	// Close the database connection
	mysqli_stmt_close($stmt);
	mysqli_close($conn);

} else {
	// The form wasn't submitted, redirect to the sign-up page
	header("Location: signup.php");
	exit();
}
?>
