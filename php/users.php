<?php

/**
 * Class for User related functionality
 */
class User
{

	//User Variables
	public $id;
	public $email;
	public $password;
	public $salt;
	public $role;
	public $firstName;
	public $lastName;
	public $phone;
	public $address;
	public $postcode;
	public $state;

	/**
	 * Constructor
	 * Precondition: Argument must be either user table row
	 * or a verified set of client registration information
	 */
	function __construct()
	{
		//Construct User according to the arguments provided
		$args = func_get_args();
		$numArgs = func_num_args();

		if($numArgs === 9){
			//Construct User from scratch
			//Set user defined fields
			$this->id = $args[0];
			$this->email = $args[1];
			$this->firstName = $args[2];
			$this->lastName = $args[3];
			$this->phone = $args[4];
			$this->role = $args[5];
			$this->address = $args[6];
			$this->postcode = $args[7];			
			$this->state = $args[8];
		} else {
			echo 'User created with wrong number of arguments';
		}
	}

	//Create a customer account that has the role hard coded to '0'
	function createCustomerAccount($password)
	{
		require 'pdo.inc';

		//Generate Salt
		$salt = uniqid(mt_rand(), true);

		try
		{
		  // Prepare Query to update user table
		  $stmt = $pdo->prepare(
			"INSERT INTO users (email, password, salt, firstName, lastName, phoneNumber, address, postcode, state)
			VALUES (:email, SHA2(CONCAT(:password, :salt), 0), :salt, :firstName, :lastName, :phoneNumber, :address, :postcode, :state)"
		  );

		  //Bind query parameter with it's given variable
		  $stmt->bindParam(':email', $this->email);
		  $stmt->bindParam(':password', $password);
		  $stmt->bindParam(':salt', $salt);
		  $stmt->bindParam(':firstName', $this->firstName);
		  $stmt->bindParam(':lastName', $this->lastName);
		  $stmt->bindParam(':phoneNumber', $this->phone);
		  $stmt->bindParam(':address', $this->address);
		  $stmt->bindParam(':postcode', $this->postcode);
		  $stmt->bindParam(':state', $this->state);

		  //Run query
		  $stmt->execute();

		  //Close connection
		  $stmt = null;

		  //Prepare query to update role table
		  $stmt = $pdo->prepare(
				"INSERT INTO roles (userID, role)
			SELECT userID, 0
				FROM users
				WHERE email = :email;"
		  );

		  //Bind query parameter with it's given variable
		  $stmt->bindParam(':email', $this->email);

		  //Run query
		  $stmt->execute();

		  //Close connection
		  $stmt = null;

		  //Destroy PDO Object
		  $pdo = null;

		}catch(PDOException $e){
			//Output Error
			echo $e->getMessage();
			echo '<p>'.$e.'</p>';
		}
	}

	//Create a user account that has a role
	function createStaffAccount($password)
	{
		require 'pdo.inc';

		//Generate Salt
		$salt = uniqid(mt_rand(), true);

		try
		{
		  // Prepare Query to update user table
		  $stmt = $pdo->prepare(
			"INSERT INTO users (email, password, salt, firstName, lastName, phoneNumber, address, postcode, state)
			VALUES (:email, SHA2(CONCAT(:password, :salt), 0), :salt, :firstName, :lastName, :phoneNumber, :address, :postcode, :state)"
		  );

		  //Bind query parameter with it's given variable
		  $stmt->bindParam(':email', $this->email);
		  $stmt->bindParam(':password', $password);
		  $stmt->bindParam(':salt', $salt);
		  $stmt->bindParam(':firstName', $this->firstName);
		  $stmt->bindParam(':lastName', $this->lastName);
		  $stmt->bindParam(':phoneNumber', $this->phone);
		  $stmt->bindParam(':address', $this->address);
		  $stmt->bindParam(':postcode', $this->postcode);
		  $stmt->bindParam(':state', $this->state);

		  //Run query
		  $stmt->execute();

		  //Close connection
		  $stmt = null;

		  //Prepare query to update role table
		  $stmt = $pdo->prepare(
				"INSERT INTO roles (userID, role)
			SELECT userID, :role
				FROM users
				WHERE email = :email;"
		  );

		  //Bind query parameter with it's given variable
		  $stmt->bindParam(':role', $this->role);
		  $stmt->bindParam(':email', $this->email);

		  //Run query
		  $stmt->execute();

		  //Close connection
		  $stmt = null;

		  //Destroy PDO Object
		  $pdo = null;

		}catch(PDOException $e){
			//Output Error
			echo $e->getMessage();
			echo '<p>'.$e.'</p>';
		}
	}

	function updateUser()
	{
		require 'php/pdo.inc';

		try
		{
			// Prepare Query to update user table
			$stmt = $pdo->prepare(
				"UPDATE users
				SET email = :email,
				firstName = :firstName,
				lastName = :lastName,
				phoneNumber = :phoneNumber,
				address = :address,
				postcode = :postcode,
				state = :state
				WHERE userID = :userID;"
			);

			//Bind query parameter with it's given variable
			$stmt->bindParam(':email', $this->email);
			$stmt->bindParam(':firstName', $this->firstName);
			$stmt->bindParam(':lastName', $this->lastName);
			$stmt->bindParam(':phoneNumber', $this->phone);
			$stmt->bindParam(':address', $this->address);
			$stmt->bindParam(':postcode', $this->postcode);
			$stmt->bindParam(':state', $this->state);
			$stmt->bindParam(':userID', $this->id);

			//Run query
			$stmt->execute();

			//Close connection
			$stmt = null;

			//Destroy PDO Object
			$pdo = null;

		}catch(PDOException $e){
			//Output Error
			echo $e->getMessage();
			echo '<p>'.$e.'</p>';
		}
	}

	function updateAccount() {
		updateUser($this);
	}
}

?>
