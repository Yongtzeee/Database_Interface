<?php
	require "../db.php";

	$sql = "SELECT b.*,a.name 'langname',d.name 'catname' FROM film AS b JOIN language as a ON (b.language_id=a.language_id) JOIN film_category as c ON (b.film_id = c.film_ID) JOIN category as d ON (c.category_id = d.category_id) WHERE b.film_id = '";
	if(!empty($_GET["id"])){
		$sql = $sql . $_GET["id"]; 
	}
	$sql = $sql . "'";
	//echo $sql;
	//echo "Showing results for ID" . $_GET["id"] . " title " . $_GET["title"]; 
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo "<b> Title: </b>" . $row["title"]."<br>";
			echo "<b> Rating: </b>" . $row["rating"]."<br>";
			echo "<b> Category: </b>" . $row["catname"]."<br>";
			echo "<b> Description: </b>" . $row["description"]."<br>";
			echo "<b> Releast Year: </b>" . $row["release_year"]."<br>";
			echo "<b> Language: </b>" . $row["langname"]."<br>";
			echo "<b> Rental Duration: </b>" . $row["rental_duration"]."<br>";
			echo "<b> Rental Rate: </b>" . $row["rental_rate"]."<br>";
			echo "<b> Length: </b>" . $row["length"]."<br>";
			echo "<b> Replacement Cost: </b>" . $row["replacement_cost"]."<br>";
			echo "<b> Special Features: </b>" . $row["special_features"]."<br>";
		}

	}
	echo "<br><b> Actor(s): </b><br>";
	$actorsql = "SELECT a.first_name,a.last_name FROM film_actor AS b JOIN actor as a ON (b.actor_id=a.actor_id) WHERE film_id ='";
	$actorsql = $actorsql . $_GET["id"] . "'";
	//echo $actorsql;
	$actorresult = $conn->query($actorsql);
	if ($actorresult->num_rows > 0) {
		while($actorrow = $actorresult->fetch_assoc()) {
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$actorrow["first_name"]." ";
			echo $actorrow["last_name"]."<br>";
		}
	}
	echo "<br><br>";
	echo '<a href="update_film.php?id=' . $_GET["id"] . '"> Update Info </a> <br>'  ;
	echo '<a href="update_film_actor.php?id=' . $_GET["id"] . '"> Update Actor Info </a> <br/>';
	echo '<a href="select_film.php">Go Back</a> <br/>';

	echo "<br><br>";
	
	
	$conn->close();
?>