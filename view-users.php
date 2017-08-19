<?php require 'includes/head.inc' ?>

<?php
  //Verify User Permission to View Page
  require_once 'php/permissions.php';

  if(isset($_SESSION['role']))
  {
    if(checkPermission($_SESSION['role'], 'view-users.php') === false)
    {
	  echo '<script> alert('.$_SERVER['PHP_SELF'].');</script>';
      //Insufficient Role, Redirect User to Forbidden Error Page
      header("Location:login.php");
    }
  }else{
    //Error: User not logged in
    header("Location:login.php");
  }
?>

<?php require 'includes/header.inc' ?>

<section id="filter-users">
	<div class="container">
		<div class="row">
			<div class="col-md-9">
				<form method="POST" class="form-order-lookup form-horizontal">
					<div class="form-group">
						<h2 class="form-order-lookup">Orders</h2>
						<div id="error"></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="inputEmail">User Email</label>
						<div class="col-sm-10">
							<input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" autofocus>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="inputUserName">Name</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="inputUserName" placeholder="Customer Name" name="name" maxlength="255" pattern="^[\w]{2,255}(?:\s[\w]{2,255})*(?!=\W)$">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label" for="inputRole">Role</label>
						<div class="col-sm-10">
							<select class="form-control" id="inputRole" name="role">
								<option value="" selected="">- Select Role -</option>
								<option value=0>Customer</option>
								<option value=1>Driver</option>
								<option value=2>Coordinator</option>
								<option value=3>Manager</option>
								<option value=4>Admin</option>
							</select>
						</div>
					</div>

					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-default">Search</button>
					</div>
				</form>
			</div>

      <?php
        if($_SERVER["REQUEST_METHOD"] === "POST")
        {
          $errors = array();
          $formValid = true;

          //Get Dependancies
          require_once 'php/formValidation.php';

          //PHP Field Validation
          $errors = array();

          /*
            Check for Set Search Filters and Validate
            their respective input values
          */
          if(isset($_POST['email']) && !empty($_POST['email']))
          {
            $errors["email"] = checkEmail($_POST['email']);
          }
          if(isset($_POST['name']) && !empty($_POST['name']))
          {
            $errors["name"] = checkFullName($_POST['name']);
          }
          if(isset($_POST['role']) && !empty($_POST['role']))
          {
            $errors["role"] = checkIntID($_POST['role']);
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

          //Check Form is Valid
          if($formValid)
          {
            require_once 'php/usersDB.php';

            //Run Search Query and Output Results
            displayUsers(searchUsers($_POST['email'], $_POST['name'], $_POST['role']));
          }
        }
        
       ?>
    </div>
  </section>

<?php require 'includes/footer.inc' ?>
