<?php require 'includes/head.inc' ?>


<!--the header, see the file for the code-->
<?php require 'includes/header.inc' ?>

<!--Handle login-->
<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){

		$email = $_POST['email'];
		$password = $_POST['password'];

		require 'php/usersDB.php';
		
		if (verifyPassword($email, $password)){

			//Login and set session variables
			login($email);

			//Redirect Script
			echo "
				<script>
					window.location.href = 'index.php';
				</script>";

		}else{
			echo'
			<script>
				window.onload = function var1() {
					document.getElementById(\'error\').innerHTML = \'Your username or password is incorrect!\';
				};
			</script>';
		}
	}
?>

<div class="container">
	<section id="login">
		<div class="loginform">
			<form method="POST" class="form-signin">
			<img src="images/login.png" alt="Login">
			<h2 class="form-signin-heading">LOG IN</h2>
			<div id="error"></div>
			<label for="inputEmail" class="sr-only">Email address</label>
			<input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
	  
			<label for="inputPassword" class="sr-only">Password</label>
			<input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
	  
			<div class="checkbox">
			  <label>
				<input type="checkbox" value="remember-me"> Remember me
			  </label>
	  
			</div>
			<button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
			<br>
			</form>

			<a href="create-account.php">Create an account?</a> | <a href"">Forgotten Password?</a>
		</div>
	</section>
  </div> <!-- /container -->

<?php require 'includes/footer.inc' ?>
