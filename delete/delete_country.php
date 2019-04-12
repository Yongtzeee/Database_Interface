<?php
	require "../db.php";


	$result = $conn->query($sql);
    $id = $_GET["countryid"];

    
  
    $sql = "DELETE FROM `country` WHERE country_id=". $_GET["countryid"];
    $conn->query($sql);
    $sql = "UPDATE `city` SET country_id=NULL WHERE country_id=" . $_GET["countryid"];
    $conn->query($sql);
    echo $sql;

	$conn->close();
	
    echo "<script>window.close();</script>";

?>
