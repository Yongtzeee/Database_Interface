<?php
	require "../db.php";

	
	if(!empty($_GET["add_actor"])){
	    $checksql = "SELECT actor_id FROM film_actor where film_id=";
	    $checksql = $checksql . $_GET["id"];
	    $checkresult = $conn->query($checksql);
	    //echo $checksql;
        if ($checkresult->num_rows > 0) {
    		while($checkrow = $checkresult->fetch_assoc()) {
    		    //echo $checkrow["actor_id"];
    		    if($checkrow["actor_id"] == $_GET["add_actor"]){
    		        echo 'Error, the actor is already an actor for this movie <br>';
    	        	echo '<a href="update_film_actor.php?id=' . $_GET["id"] . '">Click here to Go back </a>';
    	        	exit;
    		    }
    		}
        }
		$disablefc = "SET FOREIGN_KEY_CHECKS=0;";
		$conn->query($disablefc);
		$addsql = "INSERT INTO film_actor(actor_id,film_id,last_update) VALUES (" . $_GET["add_actor"]. "," . $_GET["id"] . "," . CURRENT_TIMESTAMP . ");";
		//echo $addsql;
		$conn->query($addsql);
		echo 'Success <br>';
		echo '<a href="update_film_actor.php?id=' . $_GET["id"] . '">Click here to Go back </a>';
		exit;
	}


	$sql = "SELECT * FROM actor";
	$result=$conn->query($sql);
	echo "<br>";
	$result = $conn->query($sql);
	echo '<br><br><a href="update_film_actor.php?id=' . $_GET["id"] . '">Back</a> <br>';
	echo "<table style=\"width:100%\" border=1>";
	if ($result->num_rows > 0) {
		echo "<tr><th>Actor</th><th>First Name</th><th>Last Name</th><th>ADD</th>";
		while($row = $result->fetch_assoc()) {
			echo "<tr> <td>" . $row["actor_id"] . "</td><td>" . $row["first_name"] . "</td><td>" . $row["last_name"] . "</td><td>";
			echo '<a target="_self" href=add_film_actor.php?id=' . $_GET["id"] . "&add_actor=" . $row["actor_id"] . ">Add this Actor</a>"."</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	
    echo '<br><a target="_blank" href="../insert/insert_actor.php">Add a new Actor</a><br>';
	
	$conn->close();
?>