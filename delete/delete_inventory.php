<?php
	require "../db.php";


	$result = $conn->query($sql);
    $id = $_GET["addressid"];

    
  
    $sql = "DELETE FROM `address` WHERE address_id=". $_GET["addressid"];
    $conn->query($sql);
    $sql = "UPDATE `actor` SET address_id=NULL WHERE address_id=" . $_GET["addressid"];
    $conn->query($sql);
    $sql = "UPDATE `customer` SET address_id=NULL WHERE address_id=" . $_GET["addressid"];
    $conn->query($sql);
    $sql = "UPDATE `staff` SET address_id=NULL WHERE address_id=" . $_GET["addressid"];
    $conn->query($sql);
    $sql = "UPDATE `store` SET address_id=NULL WHERE address_id=" . $_GET["addressid"];
    $conn->query($sql);
    echo $sql;

	$conn->close();
	
    echo "<script>window.close();</script>";

?>
