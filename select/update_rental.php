<?php
	require "../db.php";

	
	if(!empty($_GET["update"]) && $_GET["update"] == 1){
		$updatesql = "UPDATE rental SET last_update=CURRENT_TIMESTAMP,rental_date='" . $_GET["rental_date"] . "',return_date='" . $_GET["return_date"] . "' WHERE rental_id=" . $_GET["rental_id"] . ";";
		$conn->query($updatesql);
		echo $updatesql;

		echo 'Success <br>';
		echo '<a href="update_rental.php?rental_id=' . $_GET["rental_id"] . '">Click here to Go back </a>';
		exit;
	}
	
	
	$sql = "SELECT * FROM rental WHERE rental_id = '";
	if(!empty($_GET["rental_id"])){
		$sql = $sql . $_GET["rental_id"]; 
	}
	$sql = $sql . "'";
	echo $sql;
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo '<form action="update_rental.php?rental_id=' . $_GET["rental_id"] . '">';
			echo '<input type="hidden" name="update" value="1" />';
			echo '<input type="hidden" name="rental_id" value="'  . $_GET["rental_id"] . '"/>';
			
			echo "<b> Rental Date: </b>" . '<input type="text" name="rental_date" value="'.$row["rental_date"].'"><br>';
			echo "<b> Return Rate: </b>" . '<input type="text" name="return_date" value="'.$row["return_date"].'"><br>';
		

		}

	}
	echo '<input type="submit"> <br/><br/>';
	
	echo '<a href="select_rental.php">Go back</a>';


	$conn->close();
	
?>