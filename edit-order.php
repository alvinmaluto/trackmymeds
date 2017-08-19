<?php require 'includes/head.inc' ?>

<?php
  //Verify User Permission to View Page
  require_once 'php/permissions.php';

  if(isset($_SESSION['role']))
  {
    if(checkPermission($_SESSION['role'], 'edit-order.php') === false)
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


<?php
	require_once 'php/ordersDB.php';
	require_once 'php/usersDB.php';
	$orderObject = getOrderObject(htmlspecialchars($_GET["orderID"]));
	$userObject = getUserObjectFromID($orderObject->userID);

	if($_SERVER["REQUEST_METHOD"] === "POST")
	{

		$errors = array();
		$formValid = true;

		//Get Dependancies
		require_once 'php/formValidation.php';

		//PHP Field Validation
		$errors = array(
		"description"=>checkDescription($_POST['description']),
		"signature"=>checkSet($_POST['signature']),
		"priority"=>checkSet($_POST['priority']),
		"pickupAddress"=>checkAddress($_POST['pickupAddress']),
		//"pickupTime"=>checkTime($_POST['pickupTime']),
		"deliveryAddress"=>checkAddress($_POST['deliveryAddress']),
		"deliveryState"=>checkState($_POST['deliveryState']),
		"recipientName"=>checkFullName($_POST['recipientName']),
		"recipientPhone"=>checkPhone($_POST['recipientPhone']),
	);

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
		require_once 'php/orders.php';
		require_once 'php/users.php';
		require_once 'php/packages.php';
		require_once 'php/usersDB.php';
		require_once 'php/status.php';

		$user = unserialize($_SESSION['user']);

		$order = new Order((htmlspecialchars($_GET["orderID"])), getID($_POST['email']), Status::Ordered, $_POST['description'], $_POST['signature'], 
		$_POST['priority'], $_POST['pickupAddress'], $_POST['pickupPostCode'], $_POST['pickupState'], $_POST['pickupTime'], 
		$_POST['deliveryAddress'], $_POST['deliveryPostCode'], $_POST['deliveryState'], $_POST['deliveryTime'], 
		$_POST['recipientName'], $_POST['recipientPhone']);

		$orderID = $order->editOrder();
		
		//Create arrays containing all package descriptions and weights
		$packageDescriptions = $_POST['packageDescription'];
		$packageWeights = $_POST['weight'];
		$packageIDs = $_POST['hiddenPackageID'];

		//Loop through all packages and add them to the database
		$i = 0;
		while($i < sizeof($packageDescriptions)){
			//Note that '0' is given as package id, only to indicate that it has not been set yet
			$package = new Package($packageIDs[$i], $orderID, $packageWeights[$i], $packageDescriptions[$i]);
			$package->updateToDB();
			$i++;
		}

		//Redirect Script
		//header('Location: view-order.php?orderID='.$_GET['orderID']);
	}
}
?>

<?php require 'includes/header.inc' ?>



<div class="container1">

	<div class="row1">
		<div class="col-sm-2 col-xs-2">
		<img id="shortcut3" src="images/1icon.png" alt="1"></img>
		</div>
		<div class="col-sm-10 col-xs-10">
		<h3>Order Details</h3>
		</div>
	</div>
	<form method="post" autocomplete="on" onsubmit="return validate(this)">
		<!--Customer Email-->
		<div class="form-group">
			<label for="inputEmail" class="sr-only">Customer email address</label>
			<input value="<?php echo $userObject->email ?>" type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
		</div>
		
		<!--Order Description-->
		<div class="form-group">
			<label for="comment">Description:</label>
			<textarea class="form-control" rows="5" id="comment" maxlength="140" name="description"><?php echo $orderObject->description ?></textarea>*max 140 characters
		</div>

		<!--Signature Required-->
		<div class="form-group">
			<label>Require Signature Upon Delivery?</label>
			<label class="radio-inline">
				<input <?php if($orderObject->signature == "1"){echo "checked='checked'";}  ?> type="radio" name="signature" value="1">
			Yes</label>
			<label class="radio-inline">
				<input <?php if($orderObject->signature == "0"){echo "checked='checked'";}  ?> type="radio" name="signature" value="0">
			No</label>
		</div>

		<!--Priority (Order Type)-->
		<div class="form-group">
			<label>Delivery Priority</label>
			<div class="radio">
				<label><input <?php if($orderObject->priority == "Express"){echo "checked='checked'";}  ?> type="radio" name="priority" value="Express">Express (1-2 Business Days)</label>
			</div>
			<div class="radio">
				<label><input <?php if($orderObject->priority == "Standard"){echo "checked='checked'";}  ?> type="radio" name="priority" value="Standard">Standard (5-7 Business Days)</label>
			</div>
		</div>
		
		<?php 
		
		displayPackageInputs($orderObject->orderID); 
		?>

		<div class="row">
		    <div class="col-sm-2 col-xs-2">
		  	<img id="shortcut3" src="images/2icon.png" alt="2"></img>
			</div>
			<div class="col-sm-10 col-xs-10">
		    	<h3>Pick Up</h3>
		  	</div>
		</div>

		<!--Pickup Time-->
		<div class="form-group">
			<label for="pickupTime">Preferred Pickup Time:</label>
			<input value="<?php echo str_replace(' ', 'T', $orderObject->pickupTime); ?>" type="datetime-local" type="datetime-local" class="form-control" id="pickupTime" name="pickupTime"
			<?php
			  date_default_timezone_set('Australia/Brisbane');
			  $dateMin = date('Y-m-d TH:i:s a');
			  echo "min='".$dateMin."'";

			  $date = date_create($dateMin);
			  date_modify($date,"+1 year");
			  $dateMax = date_format($date, "Y-m-d TH:i:s a");
			  echo " max='".$dateMax."'";
			?>>
		</div>

		<!--Pickup Address-->
		<div class="form-group">
			<label>Pickup Address:</label>
			<input value="<?php echo $orderObject->pickupAddress ?>" type="text" class="form-control" id="pickupAddress" name="pickupAddress">
		</div>
		
		<!--Pickup PostCode-->
		<div class="form-group">
			<label for="email">Postcode:</label>
			<input value="<?php echo $orderObject->pickupPostcode ?>" type="number" class="form-control" id="email" placeholder="Enter Postcode" name="pickupPostCode" pattern="^[0-9]{4}$">
		</div>
		
		<!--Pickup State-->
		<div class="form-group">
			<label for="state">State:</label>
			<select class="form-control" id="state" name="pickupState">
				<option <?php if($orderObject->pickupState == "QLD"){echo 'selected';}?> >QLD</option>
				<option <?php if($orderObject->pickupState == "NSW"){echo 'selected';}?> >NSW</option>
				<option <?php if($orderObject->pickupState == "ACT"){echo 'selected';}?> >ACT</option>
				<option <?php if($orderObject->pickupState == "VIC"){echo 'selected';}?> >VIC</option>
				<option <?php if($orderObject->pickupState == "SA"){echo 'selected';}?> >SA</option>
				<option <?php if($orderObject->pickupState == "WA"){echo 'selected';}?> >WA</option>
				<option <?php if($orderObject->pickupState == "NT"){echo 'selected';}?> >NT</option>
			</select>
		</div>

		<div class="row">
      			<div class="col-sm-2 col-xs-2">
			<img id="shortcut3" src="images/3icon.png" alt="3"></img>
			</div>
			<div class="col-sm-10 col-xs-10">
			<h3>Recipient Details</h3>
			</div>
		</div>
		
		<!--Fullname of Recipient-->
		<div class="form-group">
			<label for="recipientName">Recipient Name:</label>
			<input value="<?php echo $orderObject->recipientName ?>" type="text" class="form-control" id="recipientName" placeholder="Enter Recipient Name" name="recipientName" maxlength="255" pattern="^[\w]{2,255}(?:\s[\w]{2,255})*(?!=\W)$" required>
		</div>

		<!--Recipient's Phone Number-->
		<div class="form-group">
			<label for="recipientPhone">Recipient Phone Number:</label>
			<input value="<?php echo $orderObject->recipientPhone ?>" type="tel" class="form-control" id="recipientPhone" placeholder="Enter Phone Number" name="recipientPhone" maxlength="16" pattern="^(?:\(\+?[0-9]{2}\))?(?:[0-9]{6,10}|[0-9]{3,4}(?:(?:\s[0-9]{3,4}){1,2}))$" required>
		</div>

		<div class="row">
			<div class="col-sm-2 col-xs-2">
			<img id="shortcut3" src="images/4icon.png" alt="4"></img>
			</div>
			<div class="col-sm-10 col-xs-10">
			<h3>Delivery</h3>
			</div>
		</div>
		
		<!--delivery Time-->
		<div class="form-group">
			<label for="pickupTime">Preferred Pickup Time:</label>
			<input value="<?php echo str_replace(' ', 'T', $orderObject->deliveryTime); ?>" type="datetime-local" class="form-control" id="deliveryTime" name="deliveryTime"
			<?php
			  date_default_timezone_set('Australia/Brisbane');
			  $dateMin = date('Y-m-d TH:i:s a');
			  echo "min='".$dateMin."'";

			  $date = date_create($dateMin);
			  date_modify($date,"+1 year");
			  $dateMax = date_format($date, "Y-m-d TH:i:s a");
			  echo " max='".$dateMax."'";
			?>>
		</div>

		<!--Delivery Address-->
		<div class="form-group">
			<label for="deliveryAddress">Delivery Address:</label>
			<input value="<?php echo $orderObject->deliveryAddress ?>" type="text" class="form-control" id="deliveryAddress" placeholder="Enter Delivery Address" name="deliveryAddress" maxlength="255" pattern="^[0-9]{1,5},?\s\w{2,64}\s\w{2,64},?\s\w{2,64}$" required>
		</div>

		<!--Delivery PostCode-->
		<div class="form-group">
			<label for="deliveryPostCode">Postcode:</label>
			<input value="<?php echo $orderObject->deliveryPostcode ?>" type="number" class="form-control" id="email" placeholder="Enter Postcode" name="deliveryPostCode" pattern="^[0-9]{4}$">
		</div>

		<!--Delivery State-->
		<div class="form-group">
			<label for="state">State:</label>
			<?php echo $orderObject->deliveryState.'<br>'.$orderObject->deliveryState == "NSW"; ?>
			<select class="form-control" id="state" name="deliveryState">
				<option <?php if($orderObject->deliveryState == "QLD"){echo 'selected';}?> >QLD</option>
				<option <?php if($orderObject->deliveryState == "NSW"){echo 'selected';}?> >NSW</option>
				<option <?php if($orderObject->deliveryState == "ACT"){echo 'selected';}?> >ACT</option>
				<option <?php if($orderObject->deliveryState == "VIC"){echo 'selected';}?> >VIC</option>
				<option <?php if($orderObject->deliveryState == "SA"){echo 'selected';}?> >SA</option>
				<option <?php if($orderObject->deliveryState == "WA"){echo 'selected';}?> >WA</option>
				<option <?php if($orderObject->deliveryState == "NT"){echo 'selected';}?> >NT</option>
			</select>
		</div>

		<button type="submit" class="btnbtn-default">Submit</button>

	</form>
</div>

<?php require 'includes/footer.inc' ?>