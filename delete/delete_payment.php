<?php
	require "../db.php";


	$result = $conn->query($sql);
    $id = $_GET["paymentid"];

    
  
    $sql = "DELETE FROM `payment` WHERE payment_id=". $_GET["paymentid"];
    $conn->query($sql);

	$conn->close();
	
    echo "<script>window.close();</script>";

?>