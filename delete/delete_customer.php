<?php
	require "../db.php";


	$result = $conn->query($sql);
    $id = $_GET["customerid"];

    
  
    $sql = "DELETE FROM `customer` WHERE customer_id=". $_GET["customerid"];
    $conn->query($sql);
    $sql = "UPDATE `payment` SET customer_id=NULL WHERE customer_id=" . $_GET["customerid"];
    $conn->query($sql);
  
    echo $sql;

	$conn->close();
	
    echo "<script>window.close();</script>";

?>
