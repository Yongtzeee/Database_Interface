<?php
	require "../db.php";


	$result = $conn->query($sql);
    $id = $_GET["filmid"];

    
  
    $sql = "DELETE FROM `film_text` WHERE film_id=". $_GET["filmid"];
    $conn->query($sql);

	$conn->close();
	
    echo "<script>window.close();</script>";

?>