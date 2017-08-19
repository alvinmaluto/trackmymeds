<?php

  /**
   *
   */
class Order{

  	public $orderID;
  	public $userID;
  	public $status;
  	public $description;
  	public $signature;
  	public $priority;
	
  	public $pickupAddress;
	public $pickupPostcode;
	public $pickupState;
	public $pickupTime;
	
  	public $deliveryAddress;
	public $deliveryPostcode;
	public $deliveryState;
	public $deliveryTime;
	
  	public $recipientName;
    public $recipientPhone;

    /**
  	 * Constructor
  	 * Precondition: Argument must be either user table row
  	 * or a verified set of client order information
  	 */
  	function __construct()
  	{
  		# code...
  		//Construct Order according to the arguments provided
  		$args = func_get_args();
      $numArgs = func_num_args();
        //Construct Order from scratch

  		//Set user defined fields
		/*$this->userID = $args[0];
		$this->description = $args[1];
		$this->signature = $args[2];
		$this->priority = $args[3];
		$this->pickupAddress = $args[4];
		$this->pickupTime = $args[5];
		$this->deliveryAddress = $args[6];
		$this->recipientName = $args[7];
		$this->recipientPhone = $args[8];
		$this->orderID = $args[9];*/
		
		$this->orderID = $args[0];
		$this->userID = $args[1];
		$this->status = $args[2];
		$this->description = $args[3];
		$this->signature = $args[4];
		$this->priority = $args[5];
		
		$this->pickupAddress = $args[6];
		$this->pickupPostcode = $args[7];
		$this->pickupState = $args[8];
		$this->pickupTime = $args[9];
		
		$this->deliveryAddress = $args[10];
		$this->deliveryPostcode = $args[11];
		$this->deliveryState = $args[12];
		$this->deliveryTime = $args[13];
		
		$this->recipientName = $args[14];
		$this->recipientPhone = $args[15];
		
		

        //Set Default Status
        $this->status = "Ordered";
  		
  	}

	//Function to edit the 
	function editOrder()
   {
	    require 'pdo.inc';
		try
		{
			// Prepare Query
			$stmt = $pdo->prepare(
			"UPDATE orders
			SET userID = :userID,
			orderStatus = :orderStatus, 
			description = :description, 
			signature = :signature, 
			deliveryPriority = :deliveryPriority, 
			pickupAddress = :pickupAddress, 
			pickupPostcode = :pickupPostcode, 
			pickupState = :pickupState, 
			pickupTime = :pickupTime, 
			deliveryAddress = :deliveryAddress, 
			deliveryPostcode = :deliveryPostcode, 
			deliveryState = :deliveryState, 
			deliveryTime = :deliveryTime, 
			recipientName = :recipientName, 
			recipientPhone = :recipientPhone
			WHERE orderID = :orderID;"
			);

			//Bind query parameter with it's given variable
			$stmt->bindParam(':userID', $this->userID);
			$stmt->bindParam(':orderStatus', $this->status);
			$stmt->bindParam(':description', $this->description);
			$stmt->bindParam(':signature', $this->signature);
			$stmt->bindParam(':deliveryPriority', $this->priority);
			$stmt->bindParam(':pickupAddress', $this->pickupAddress);
			$stmt->bindParam(':pickupPostcode', $this->pickupPostcode);
			$stmt->bindParam(':pickupState', $this->pickupState);
			$stmt->bindParam(':pickupTime', $this->pickupTime);
			$stmt->bindParam(':deliveryAddress', $this->deliveryAddress);
			$stmt->bindParam(':deliveryPostcode', $this->deliveryPostcode);
			$stmt->bindParam(':deliveryState', $this->deliveryState);
			$stmt->bindParam(':deliveryTime', $this->deliveryTime);
			$stmt->bindParam(':recipientName', $this->recipientName);
			$stmt->bindParam(':recipientPhone', $this->recipientPhone);
			$stmt->bindParam(':orderID', $this->orderID);

			//Run query
			$stmt->execute();
			//get id of newly inserted row
			$last_id = $pdo->lastInsertId();

			//Close connection
			$stmt = null;
			//Destroy PDO Object
			$pdo = null;
			//Return id of newly inserted row
			return $last_id;

		}catch(PDOException $e){
			//Output Error
			echo $e->getMessage();
			echo '<p>'.$e.'</p>';
		}
	}
	
	function createOrder()
    {
		require 'pdo.inc';
		try
		{
			// Prepare Query
			$stmt = $pdo->prepare(
			"INSERT INTO orders (userID, orderStatus, description, signature, 
			deliveryPriority, pickupAddress, pickupPostcode, pickupState, 
			pickupTime, deliveryAddress, deliveryPostcode, deliveryState, 
			deliveryTime, recipientName, recipientPhone) 
			
			VALUES (:userID, :orderStatus, :description, :signature, :deliveryPriority, 
			:pickupAddress, :pickupPostcode, :pickupState, :pickupTime, :deliveryAddress, 
			:deliveryPostcode, :deliveryState, :deliveryTime, :recipientName, :recipientPhone
			)");

			//Bind query parameter with it's given variable
			$stmt->bindParam(':userID', $this->userID);
			$stmt->bindParam(':orderStatus', $this->status);
			$stmt->bindParam(':description', $this->description);
			$stmt->bindParam(':signature', $this->signature);
			$stmt->bindParam(':deliveryPriority', $this->priority);
			$stmt->bindParam(':pickupAddress', $this->pickupAddress);
			$stmt->bindParam(':pickupPostcode', $this->pickupPostcode);
			$stmt->bindParam(':pickupState', $this->pickupState);
			$stmt->bindParam(':pickupTime', $this->pickupTime);
			$stmt->bindParam(':deliveryAddress', $this->deliveryAddress);
			$stmt->bindParam(':deliveryPostcode', $this->deliveryPostcode);
			$stmt->bindParam(':deliveryState', $this->deliveryState);
			$stmt->bindParam(':deliveryTime', $this->deliveryTime);
			$stmt->bindParam(':recipientName', $this->recipientName);
			$stmt->bindParam(':recipientPhone', $this->recipientPhone);

			//Run query
			$stmt->execute();
			//get id of newly inserted row
			$last_id = $pdo->lastInsertId();

			//Close connection
			$stmt = null;
			//Destroy PDO Object
			$pdo = null;
			//Return id of newly inserted row
			return $last_id;

		}catch(PDOException $e){
			//Output Error
			echo $e->getMessage();
			echo '<p>'.$e.'</p>';
		}
	}
	
	//return an array containing all the package objects in this order
	function getPackages(){
		require_once 'ordersDB.php';
		//get a pdo statement containing all of the package info
		$stmtPackages = getPackages($this->orderID);
		//store all the info into package objects, and put them into an array
		$i = 0;
		foreach($stmtPackages as $package){
			$packages[$i] = new Package($package['packageID'], $package['packageWeight'], $package['packageDescription']);
			$i++;
		}
		
		return $packages;
	}
}
?>
