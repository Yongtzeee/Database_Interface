


<?php
	require "../db.php";


	$result = $conn->query($sql);
    $id = $_GET["filmid"];

    
  
    $sql = "DELETE FROM `film` WHERE film_id = ". $_GET["filmid"];
    $conn->query($sql);
    $sql = "DELETE FROM `film_category` WHERE film_id = ". $_GET["filmid"];
    $conn->query($sql);
    $sql = "DELETE FROM `film_text` WHERE film_id = ". $_GET["filmid"];
    $conn->query($sql);
    $sql = "DELETE FROM `film_actor` WHERE film_id = ". $_GET["filmid"];
    $conn->query($sql);

    echo($sql);
  

	$conn->close();
	
    echo "<script>window.close();</script>";

?>


