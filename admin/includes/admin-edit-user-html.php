<?php  
// Get user information 
$user_id = $_GET['id'];
$get_user_by_id = "SELECT * FROM users WHERE user_id = $user_id";
$execute_get_user = mysqli_query($connect, $get_user_by_id);
$user = mysqli_fetch_object($execute_get_user);

// Check if the Update button is clicked the execute the code below 
if(isset($_POST['update_user'])) {
	$user_firstname = $_POST['user_firstname'];
	$user_lastname = $_POST['user_lastname'];
	$user_role = $_POST['user_role'];
	$username = $_POST['username'];
	$user_email = $_POST['user_email'];
	$user_password = md5($_POST['new_password']);
	if(empty($_POST['new_password'])) {
		$user_password = $_POST['old_password'];
	}

	$update_user_sql = "UPDATE users SET username = '$username', user_password = '$user_password', user_firstname = '$user_firstname', user_lastname = '$user_lastname', user_email = '$user_email', role = '$user_role' WHERE user_id = $user_id";
	$execute_update_user = mysqli_query($connect, $update_user_sql);

	confirmQuery($execute_update_user);
	header("Location: users.php");

}
?>
<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="user_firstname">Firstname</label>
		<input value="<?= $user->user_firstname;?>" type="text" name="user_firstname" class="form-control">
	</div>
	<div class="form-group">
		<label for="user_lastname">Lastname</label>
		<input value="<?= $user->user_lastname;?>" type="text" name="user_lastname" class="form-control">
	</div>
	<div class="form-group">
		<select name="user_role">
			<?php  
				if($user->role === 'admin') echo '<option value="admin">Admin</option><option value="subscriber">Subscriber</option>'; 
				else echo '<option value="subscriber">Subscriber</option><option value="admin">Admin</option>';
			?>
		</select>
	</div>	
	<div class="form-group">
		<label for="username">Username</label>
		<input value="<?= $user->username;?>" type="text" name="username" class="form-control">
	</div>
	<div class="form-group">
		<label for="user_email">Email</label>
		<input value="<?= $user->user_email;?>" type="email" name="user_email" class="form-control">
	</div>
	<div class="form-group">
		<label for="user_password">Password</label>
		<input type="password" name="new_password" class="form-control">
		<input type="hidden" name="old_password" value="<?= $user->user_password;?>">
	</div>
	<div class="form-group">
		<input type="submit" name="update_user" value="Update user" class="btn btn-primary">
	</div>
</form>