<?php
	require "../db.php";

	if(!empty($_GET["update"]) && $_GET["update"] == 1){
	    if(empty($_GET["country"])){
	        echo '<script> alert("ERROR! \nFields cannot be empty.");window.close();</script>';
	        exit;
	    }
		$updatesql = "UPDATE country SET last_update=CURRENT_TIMESTAMP,country='" . $_GET["country"] . "' WHERE country_id=" . $_GET["country_id"] . ";";
		$conn->query($updatesql);
		echo $updatesql;

		echo 'Success <br>';
		echo '<a href="update_country.php?country_id=' . $_GET["country_id"] . '">Click here to Go back </a>';
		exit;
	}
	
	
	$sql = "SELECT * FROM country WHERE country_id = '";
	if(!empty($_GET["country_id"])){
		$sql = $sql . $_GET["country_id"]; 
	}
	$sql = $sql . "'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo '<form action="update_country.php?country_id=' . $_GET["country_id"] . '">';
			echo '<input type="hidden" name="update" value="1" />';
			echo '<input type="hidden" name="country_id" value="'  . $_GET["country_id"] . '"/>';
			
			echo "<b> Country: </b>" .'<input type="text" name="country" value="'.$row["country"].'"><br>';			

			echo '</select><br>';			

		}

	}
	echo '<input type="submit"> <br/><br/>';
	
	echo '<a href="select_country.php">Go back</a>';


	$conn->close();
?>