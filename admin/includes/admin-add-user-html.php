<?php  
if(isset($_POST['create_user'])) {
	$user_firstname = $_POST['user_firstname'];
	$user_lastname = $_POST['user_lastname'];
	$user_role = $_POST['user_role'];
	$username = $_POST['username'];
	$user_email = $_POST['user_email'];
	$user_password = md5($_POST['user_password']);


	$insert_user_sql = "INSERT INTO `users`(`username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`,`role`) VALUES ('$username', '$user_password', '$user_firstname', '$user_lastname', '$user_email', '$user_role')";
	$execute_insert_query = mysqli_query($connect, $insert_user_sql);
	if($execute_insert_query) {
		$_SESSION['add_user'] = '<p class="alert alert-success">The user has been added successfully</p>';
		header("Location: users.php");
	}
	

}
?>
<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="user_firstname">Firstname</label>
		<input type="text" name="user_firstname" class="form-control">
	</div>
	<div class="form-group">
		<label for="user_lastname">Lastname</label>
		<input type="text" name="user_lastname" class="form-control">
	</div>
	<div class="form-group">
		<select name="user_role">
			<option value="subscriber">Select Options</option>
			<option value="admin">Admin</option>
			<option value="subscriber">Subscriber</option>
		</select>
	</div>	
	<div class="form-group">
		<label for="username">Username</label>
		<input type="text" name="username" class="form-control">
	</div>
	<div class="form-group">
		<label for="user_email">Email</label>
		<input type="email" name="user_email" class="form-control">
	</div>
	<div class="form-group">
		<label for="user_password">Password</label>
		<input type="password" name="user_password" class="form-control">
	</div>
	<div class="form-group">
		<input type="submit" name="create_user" value="Create user" class="btn btn-primary">
	</div>
</form>