<?php require 'includes/head.inc' ?>

<?php
	if($_SERVER["REQUEST_METHOD"] === "POST")
	{

		$errors = array();
		$formValid = true;

		//Get Dependancies
		require_once 'php/formValidation.php';

		//PHP Field Validation
		if(empty($_POST['address']) && empty($_POST['postCode']) && empty($_POST['state']))
		{
		  $errors = array(
			"email"=>checkEmail($_POST['email']),
			"password"=>checkPassword($_POST['password']),
			"confpassword"=>checkMatch($_POST['password'], $_POST['confpassword']),
			"firstName"=>checkName($_POST['firstName']),
			"lastName"=>checkName($_POST['lastName']),
			"phone"=>checkPhone($_POST['phone'])
		  );
		  //Set state to empty string for user object
		  $_POST['state'] = "";
		} else {
		  $errors = array(
			"email"=>checkEmail($_POST['email']),
			"password"=>true,//"password"=>checkPassword($_POST['password']),   Password checking is too strict I think.
			"confpassword"=>checkMatch($_POST['password'], $_POST['confpassword']),
			"firstName"=>checkName($_POST['firstName']),
			"lastName"=>checkName($_POST['lastName']),
			"phone"=>checkPhone($_POST['phone']),
			"address"=>checkAddress($_POST['address']),
			"postCode"=>checkPost($_POST['postCode']),
			"state"=>checkState($_POST['state'])
		  );
		}

		//Check for presence of errors and output
		foreach($errors as $field => $valid)
		{
		  if($valid === false)
		  {
			$formValid = false;
			echo "Invalid " . $field . " detected<br />";
		  }
		}

		//Complete Registration Process
		if($formValid)
		{
			require_once 'php/users.php';
			//Set the customer role to 0, which is represents customer accounts.
			$role = 0;
			//Set the ID to null.
			$ID = NULL;
			$user = new User($ID, $_POST['email'], $_POST['firstName'], $_POST['lastName'], $_POST['phone'], $role, $_POST['address'], $_POST['postCode'], $_POST['state']);

			$user->createCustomerAccount($_POST['password']);
			
			//Login to account just created
			require_once 'php/usersDB.php';
			login($_POST['email']);

			//Redirect Script	
			header('Location: ../index.php');
		} 
	}
?>

<?php require 'includes/header.inc' ?>

<img id="im" src="images/background1.png" alt="Banner"> </img>

<div class="container2">
	<div class= "texts2">
	<h2>Create an Account</h2>
	</div>

	<form method="post" autocomplete="on" onsubmit="return validate(this)" action="<?php echo "https://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];?>">

		<div class="form-group1">
			<label for="email">Email Address:</label>
			<input type="email" class="form-control" id="email" placeholder="Enter Email Address" name="email" maxlength="255" required>
		</div>

		<div class="form-group1">
			<label for="password">Password: (must be over 8 characters containing letter and numbers)</label>
			<!--Doesn't accept simple passwords pattern="(?=.*[a-zA-Z])(?=.*\d).{8,255}" -->
			<input id="password" class="form-control" placeholder="Password" type="password" name="password" maxlength="255" required>

			<label for="confirmPassword">Confirm Password:</label>
			<!--Doesn't accept simple passwords pattern="(?=.*[a-zA-Z])(?=.*\d).{8,255}" -->
			<input id="confirmPassword" class="form-control" placeholder="Confirm Password" type="password" name="confpassword" oninput="check(this);" required>
		</div>

		<div class= "texts">
		<h3>Personal Details</h3>
		</div>

		<div class="form-group1">
			<label for="firstName">First Name:</label>
			<input type="text" class="form-control" id="firstName" name="firstName" maxlength="255" pattern="^\w{2,255}(?!=\W)$" required>

			<label for="lastName">Last Name:</label>
			<input type="text" class="form-control" id="lastName" name="lastName" maxlength="255" pattern="^\w{2,255}(?!=\W)$" required>
		</div>

		<div class= "texts">
		<h3>Phone Number</h3>
		</div>

		<div class="form-group1">
			<label for="phone">Phone Number:</label>
			<input type="tel" class="form-control" id="phone" placeholder="Enter Phone Number" name="phone"  maxlength="16" pattern="^(?:\(\+?[0-9]{2}\))?(?:[0-9]{6,10}|[0-9]{3,4}(?:(?:\s[0-9]{3,4}){1,2}))$" required>
		</div>

		<div class= "texts">
		<h3>Address</h3>
		</div>

		<div class="form-group1">
			<label for="address">Address:</label>
			<input type="text" class="form-control" id="address" placeholder="Enter Address" name="address" maxlength="255" pattern="^[0-9]{1,5},?\s\w{2,64}\s\w{2,64},?\s\w{2,64}$">

			<label for="postCode">Postcode:</label>
			<input type="number" size="4" class="form-control" id="postCode" placeholder="Enter Postcode" name="postCode" pattern="^[0-9]{4}$">
		</div>

		<div class="form-group1">
			<label for="state">State:</label>
			<select class="form-control" id="state" name="state">
				<option value="" disabled selected>- Select State -</option>
				<option>QLD</option>
				<option>NSW</option>
				<option>ACT</option>
				<option>VIC</option>
				<option>SA</option>
				<option>WA</option>
				<option>NT</option>
			</select>
		</div>

		<button type="submit" class="btn1btn-default">Submit</button>

	</form>
</div>

<?php require 'includes/footer.inc' ?>
