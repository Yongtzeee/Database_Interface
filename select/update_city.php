<?php
	require "../db.php";

	
	if(!empty($_GET["update"]) && $_GET["update"] == 1){
	   if(empty($_GET["city"])){
	        echo '<script> alert("ERROR! \nFields cannot be empty.");window.close();</script>';
	        exit;
	    }
		$updatesql = "UPDATE city SET last_update=CURRENT_TIMESTAMP,city='" . $_GET["city"] . "',country_id='" . $_GET["country_id"]. "' WHERE city_id=" . $_GET["city_id"] . ";";
		$conn->query($updatesql);
		echo $updatesql;

		echo 'Success <br>';
		echo '<a href="update_city.php?city_id=' . $_GET["city_id"] . '">Click here to Go back </a>';
		exit;
	}
	
	
	$sql = "SELECT * FROM city WHERE city_id = '";
	if(!empty($_GET["city_id"])){
		$sql = $sql . $_GET["city_id"]; 
	}
	$sql = $sql . "'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo '<form action="update_city.php?city_id=' . $_GET["city_id"] . '">';
			echo '<input type="hidden" name="update" value="1" />';
			echo '<input type="hidden" name="city_id" value="'  . $_GET["city_id"] . '"/>';
			
			echo "<b> City: </b>" .'<input type="text" name="city" value="'.$row["city"].'"><br>';			
			//echo "<b> city_id: </b>" . '<input type="text" name="city_id" value="'.$row["city_id"].'"><br>';
			$countrysql = "SELECT * from country";
			$countryresult = $conn->query($countrysql);
			echo '<b> Country: </b><select name="country_id">';			
			while($countryrow = $countryresult->fetch_assoc()) {
				if($countryrow["country_id"] == $row["country_id"]) echo '<option value="' . $countryrow["country_id"] . '" selected="selected" >' . $countryrow["country"] . '</option>';
				else echo '<option value="' . $countryrow["country_id"] . '">' . $countryrow["country"] . '</option>';
			}
			echo '</select><br>';			

		}

	}
	echo '<input type="submit"> <br/><br/>';
	
	echo '<a href="select_city.php">Go back</a> <br/>';


	$conn->close();
?>