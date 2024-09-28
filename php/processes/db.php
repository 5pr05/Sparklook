<?php
/**
* This file connect to database
* @author Isfandiyar Akhmedbayev
*/

$servername= "localhost";
$username = "akhmeisf";
$password = "webove aplikace";
$dbname = "akhmeisf";

$connection = mysqli_connect($servername,$username,$password,$dbname);

if(!$connection){
	die("Error connecting to server". mysqli_connect_error());
}	
?>
