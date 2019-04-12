<?php
	require "../db.php";

	if(!empty($_GET["update"]) && $_GET["update"] == 1){
	    if(empty($_GET["first_name"]) || empty($_GET["last_name"])){
	        echo '<script> alert("ERROR! \nFields cannot be empty.");window.close();</script>';
	        exit;
	    }
		$updatesql = "UPDATE actor SET last_update=CURRENT_TIMESTAMP,first_name = '" . $_GET["first_name"] . "', last_name = '" . $_GET["last_name"] . "' WHERE actor_id = " . $_GET["actor_id"] . ";" ; 
		echo $updatesql;
		$conn->query($updatesql);
		echo 'Success <br>';
		echo '<a href="update_actor.php?actor_id=' . $_GET["actor_id"] . '">Click here to Go back </a>';
		exit;
	}
	
	
	$sql = "SELECT * FROM actor WHERE actor_id = '";
	if(!empty($_GET["actor_id"])){
		$sql = $sql . $_GET["actor_id"]; 
	}
	$sql = $sql . "';";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo '<form action="update_actor.php?actor_id=' . $_GET["actor_id"] . '">';
			echo '<input type="hidden" name="update" value="1" />';
			echo '<input type="hidden" name="actor_id" value="'  . $_GET["actor_id"] . '"/>';

			echo "<b> First Name: </b>" . '<input type="text" name="first_name" value="'.$row["first_name"].'"><br>';
			echo "<b> Last Name: </b>" . '<input type="text" name="last_name" value="'.$row["last_name"].'"><br>';
		}

	}
	echo '<input type="submit">';

	echo "<br><br><br>";
	echo '<br><br><a href="select_actor.php">Back</a> <br>';

	$conn->close();
?>