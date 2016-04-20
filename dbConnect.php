<?php

$servername='localhost';
$username='php';
$password='willybilly';

$conn = new mysqli($servername, $username, $password);

if($conn->connect_error){
	die("Connection Failed: " . $conn->connect_error);
}

$data = $conn->query("SELECT * FROM seandb.seantable;");

$cols = $conn->query("SHOW COLUMNS IN seandb.seantable");

$conn->close();

?>
