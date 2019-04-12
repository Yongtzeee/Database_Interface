<?php
	require "../db.php";

		
	if(!empty($_GET["remove_actor"])){
		$disablefc = "SET FOREIGN_KEY_CHECKS=0;";
		$conn->query($disablefc);
		$removesql = "DELETE FROM film_actor WHERE actor_id=" . $_GET["remove_actor"] . " AND film_id = " . $_GET["id"] . ";";
		$conn->query($removesql);
		$enablefc = "SET FOREIGN_KEY_CHECKS=1;";
		$conn->query($enablefc);
		//echo $removesql;
		echo 'Success <br>';
		echo '<a href="update_film_actor.php?id=' . $_GET["id"] . '">Click here to Go back </a>';
		exit;
	}
	
	echo "<br><b> Actor(s): </b><br>";
	$actorsql = "SELECT a.first_name,a.last_name,a.actor_id FROM film_actor AS b JOIN actor as a ON (b.actor_id=a.actor_id) WHERE film_id ='";
	$actorsql = $actorsql . $_GET["id"] . "'";
	//echo $actorsql;
	$actorresult = $conn->query($actorsql);
	if ($actorresult->num_rows > 0) {
		while($actorrow = $actorresult->fetch_assoc()) {
			echo $actorrow["first_name"]." ";
			echo $actorrow["last_name"];
			echo '&nbsp;&nbsp;<a href="update_film_actor.php?id=' . $_GET["id"] . '&remove_actor=' . $actorrow["actor_id"] . '">Remove</a> <br>';
		}
	}

	echo '<br><br><a href="add_film_actor.php?id=' . $_GET["id"] . '">Add a new actor for this movie</a> <br>';
	echo '<br><br><a href="info_film.php?id=' . $_GET["id"] . '">Back</a> <br>';
	
	$conn->close();
?>