<?php
	include 'MySQL.php';

	$username = htmlspecialchars($_POST['user']);
	$password = htmlspecialchars($_POST['password']);
	$flag = htmlspecialchars($_POST['flag']);

	if($flag == "LOGIN"){
		$make = new MySQL();
		$make->login($username, $password);
	}else if($flag == "MAKE_ACCOUNT"){
		$make = new MySQL();
		$make->makeAccount($username, $password);
	}
?>