<?php
	require "../db.php";


	$result = $conn->query($sql);
    $id = $_GET["storeid"];

    
  
    $sql = "DELETE FROM `store` WHERE store_id=". $_GET["storeid"];
    $conn->query($sql);
	$sql = "UPDATE `inventory` SET store_id=NULL WHERE store_id=" . $_GET["storeid"];
    $conn->query($sql);
	
	$conn->close();
	
    echo "<script>window.close();</script>";

?>