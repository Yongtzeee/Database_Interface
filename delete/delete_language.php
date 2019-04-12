<?php
	require "../db.php";


	$result = $conn->query($sql);
    $id = $_GET["languageid"];

    
  
    $sql = "DELETE FROM `language` WHERE language_id=". $_GET["languageid"];
    $conn->query($sql);
    $sql = "UPDATE `film` SET language_id=NULL WHERE language_id=" . $_GET["languageid"];
    $conn->query($sql);
    echo $sql;



	$conn->close();
	
    echo "<script>window.close();</script>";

?>
