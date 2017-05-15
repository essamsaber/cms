<?php require_once "includes/header-html.php"; ?>

<!-- Include navigation -->
<?php require_once "includes/navigation-html.php" ?>
<!-- Page Content -->
<?php  
if(isset($_POST['submit'])) {
	if(!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password']) ) {
		$username = mysqli_real_escape_string($connect, $_POST['username']);
		$email = mysqli_real_escape_string($connect, $_POST['email']);
		$password = mysqli_real_escape_string($connect, $_POST['password']);
		$password = md5($password);
		$register_sql = "INSERT INTO users (username, user_password, user_email) VALUES ('$username', '$password', '$email')";
		$exec_register_sql = mysqli_query($connect, $register_sql);
		if($exec_register_sql) {
			$_SESSION['registerMsg'] = "<p class='alert alert-success'>Registration successful.. <a href='index.php'>Go to login page</a></p>";
		}

	} else {
		$_SESSION['registerMsg'] = "<p class='alert alert-danger'>All fields are required !</p>";
	}
}
?>
<div class="container">
	<section id="login">
		<div class="container">
			<div class="row">
				<div class="col-xs-6 col-xs-offset-3">
					<div class="form-wrap">
						<h1>Register</h1>
						<form role="form" action="registeration.php" method="post" id="login-form" autocomplete="off">
						<?php if(isset($_SESSION['registerMsg'])) echo $_SESSION['registerMsg']; unset($_SESSION['registerMsg']); ?>
							<div class="form-group">
								<label for="username" class="sr-only">username</label>
								<input type="text" name="username" id="username" class="form-control" placeholder="Enter username" value="<?php if(isset($_POST['username'])) echo $_POST['username']; ?>">
							</div>
							<div class="form-group">
								<label for="email" class="sr-only">Email</label>
								<input type="email" name="email" id="email" class="form-control" placeholder="name@example.com" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>">
							</div>
							<div class="form-group">
								<label for="password" class="sr-only">Password</label>
								<input type="password" name="password" id="password" class="form-control">
							</div>
							<input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<?php require_once "includes/footer-html.php"; ?>