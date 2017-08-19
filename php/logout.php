<?php
	session_start();
	unset($_SESSION['login']);
  unset($_SESSION['firstname']);
	unset($_SESSION['user']);
	unset($_SESSION['role']);
	header('Location: ../index.php');
	exit();
?>
