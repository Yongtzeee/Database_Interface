<?php
	require "../db.php";

    $id = $_GET["categoryid"];

    
  
    $sql = "DELETE FROM `category` WHERE category_id"." = ". $_GET["categoryid"];
    $conn->query($sql);
    $sql = "DELETE FROM `film_category` WHERE category_id"." = ". $_GET["categoryid"];
    $conn->query($sql);
    

	$conn->close();
	
    echo "<script>window.close();</script>";

?>
