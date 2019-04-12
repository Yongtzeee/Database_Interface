<?php
	require "../db.php";


	$result = $conn->query($sql);
    $id = $_GET["rentalid"];

    
  
    $sql = "DELETE FROM `rental` WHERE rental_id=". $_GET["rentalid"];
    $conn->query($sql);
	$sql = "UPDATE `payment` SET rental_id=NULL WHERE rental_id=" . $_GET["rentalid"];
    $conn->query($sql);
	
	$conn->close();
	
    echo "<script>window.close();</script>";

?>