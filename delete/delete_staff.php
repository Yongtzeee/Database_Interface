<?php
	require "../db.php";


	$result = $conn->query($sql);
    $id = $_GET["staffid"];

    
  
    $sql = "DELETE FROM `staff` WHERE staff_id=". $_GET["staffid"];
    $conn->query($sql);
	$sql = "UPDATE `payment` SET staff_id=NULL WHERE staff_id=" . $_GET["staffid"];
    $conn->query($sql);
	$sql = "UPDATE `rental` SET staff_id=NULL WHERE staff_id=" . $_GET["staffid"];
    $conn->query($sql);
	

	$conn->close();

    echo "<script>window.close();</script>";

?>