<?php
//////////////////////////////////////////////////////////////////////////
// Criacao...........: 07/2009
// Sistema...........: Loja Virtual
// Analistas.........: Marilene Esquiavoni & Denny Paulista Azevedo Filho
// Desenvolvedores...: Marilene Esquiavoni & Denny Paulista Azevedo Filho
// Copyright.........: Marilene Esquiavoni & Denny Paulista Azevedo Filho
//////////////////////////////////////////////////////////////////////////

	include 'config.php';
	$fname = $_POST["fname"];
	$lname = $_POST["lname"];
	$address = $_POST["address"];
	$city = $_POST["city"];
	$pin = $_POST["pin"];
	$email = $_POST["email"];
	$pwd = $_POST["pwd"];
	if($mysqli->query("INSERT INTO users (fname, lname, address, city, pin, email, password) VALUES('$fname', '$lname', '$address', '$city', $pin, '$email', '$pwd')")){
		echo 'Data inserted';
		echo '<br/>';
	}
	header ("location:login.php");
?>
