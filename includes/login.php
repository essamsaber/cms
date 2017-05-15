<?php 
require_once "db.php";

if(isset($_POST['login'])) {
	$username = mysqli_real_escape_string($connect, $_POST['username']);
	$password = mysqli_real_escape_string($connect, $_POST['password']);
	$password = md5($password);
	$user_login_sql = "SELECT * FROM users WHERE username = '{$username}' AND user_password = '{$password}'";
	$exec_user_login = mysqli_query($connect, $user_login_sql);
	if(mysqli_num_rows($exec_user_login) > 0) {
		$user = mysqli_fetch_object($exec_user_login); 
		$_SESSION['user_role'] = $user->role;
		$_SESSION['username'] = $user->username;
		$_SESSION['user_id'] = $user->user_id;
		header("Location:../admin/");
	} else {
		$_SESSION['loginMsg'] = "<p class='alert alert-danger'>Username or password is invalid</p>";
		header("Location: ../index.php");
	}	
}