<?php
	session_start();
	//Get current user information
	require_once '../php/users.php';
	$thisUser = unserialize($_SESSION['user']);
	//If the user has an address copy that to address, otherwise set it to nothing.
	$address = ($thisUser->address == "") ? "" : $thisUser->address; 
	//Return (sort of) the address as output.
	echo $address; 
?>