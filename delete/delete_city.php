<?php
	require "../db.php";


	$result = $conn->query($sql);
    $id = $_GET["cityid"];

    
  
    $sql = "DELETE FROM `city` WHERE city_id=". $_GET["cityid"];
    $conn->query($sql);
    $sql = "UPDATE `actor` SET city_id=NULL WHERE city_id=" . $_GET["cityid"];
    $conn->query($sql);
    $sql = "UPDATE `customer` SET city_id=NULL WHERE city_id=" . $_GET["cityid"];
    $conn->query($sql);
    $sql = "UPDATE `staff` SET city_id=NULL WHERE city_id=" . $_GET["cityid"];
    $conn->query($sql);
    $sql = "UPDATE `store` SET city_id=NULL WHERE city_id=" . $_GET["cityid"];
    $conn->query($sql);
    echo $sql;

	$conn->close();
	
    echo "<script>window.close();</script>";

?>