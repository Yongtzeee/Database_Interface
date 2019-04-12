<?php
	require "../db.php";

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
    
    echo "<script>window.close();</script>";

	$conn->close();
?>
