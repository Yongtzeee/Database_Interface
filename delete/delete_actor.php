

<?php
	require "../db.php";

    $id = $_GET["actorid"];

    
  
    $sql = "DELETE FROM `actor` WHERE actor_id"." = ". $_GET["actorid"];
    echo $sql;
    $conn->query($sql);
    $sql = "DELETE FROM `film_actor` WHERE actor_id"." = ". $_GET["actorid"];
    $conn->query($sql);


	$conn->close();
	
	echo "<script>window.close();</script>";
?>
