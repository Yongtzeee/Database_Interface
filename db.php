<?php

// hfyty1_sakila1 is for accessing hfyty1_sakila
// hfyty1_sakila2 is for accessing hfyty1_sakila_assignment
// both have the same password

$server = "hfyty1.mercury.nottingham.edu.my";
$username = "hfyty1_sakila2";
$password = "TestForNewPassword";

$conn = new mysqli($server,$username,$password);

if($conn->connect_error){
	die("Connection failed: " . $conn->connect_error);
}


$sql = "USE hfyty1_test";
$conn->query($sql);

$sqldisable_fkyc = "SET FOREIGN_KEY_CHECKS = 0;";
$conn->query($sqldisable_fkyc);

echo '<link rel="stylesheet" href="../styles.css">';
echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
/*
$server = "localhost";
$username = "root";

$conn = new mysqli($server,$username);

if($conn->connect_error){
	die("Connection failed: " . $conn->connect_error);
}
*/
?>