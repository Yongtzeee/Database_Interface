<?php
	require "../db.php";

	
	if(!empty($_GET["update"]) && $_GET["update"] == 1){
		$updatesql = "UPDATE address SET last_update=CURRENT_TIMESTAMP,address='" . $_GET["address"] . "',address2='" . $_GET["address2"] . "',district='" . $_GET["district"] . "',city_id='" . $_GET["city_id"] ."',postal_code='" . $_GET["postal_code"] ."',phone='" . $_GET["phone"] . "' WHERE address_id=" . $_GET["address_id"] . ";";
		$conn->query($updatesql);
		//echo $updatesql;

		echo 'Success <br>';
		echo '<a href="update_address.php?address_id=' . $_GET["address_id"] . '">Click here to Go back </a>';
		exit;
	}
	
	
	$sql = "SELECT * FROM address WHERE address_id = '";
	if(!empty($_GET["address_id"])){
		$sql = $sql . $_GET["address_id"]; 
	}
	$sql = $sql . "'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo '<form action="update_address.php?address_id=' . $_GET["address_id"] . '">';
			echo '<input type="hidden" name="update" value="1" />';
			echo '<input type="hidden" name="address_id" value="'  . $_GET["address_id"] . '"/>';
			
			echo "<b> Address: </b>" .'<input type="text" name="address" value="'.$row["address"].'"><br>';			
			echo "<b> Address2: </b>" . '<input type="text" name="address2" value="'.$row["address2"].'"><br>';
			echo "<b> District: </b>" . '<input type="text" name="district" value="'.$row["district"].'"><br>';
			//echo "<b> city_id: </b>" . '<input type="text" name="city_id" value="'.$row["city_id"].'"><br>';
			$citysql = "SELECT * from city";
			$cityresult = $conn->query($citysql);
			echo '<b> City: </b><select name="city_id">';			
			while($cityrow = $cityresult->fetch_assoc()) {
				if($cityrow["city_id"] == $row["city_id"]) echo '<option value="' . $cityrow["city_id"] . '" selected="selected" >' . $cityrow["city"] . '</option>';
				else echo '<option value="' . $cityrow["city_id"] . '">' . $cityrow["city"] . '</option>';
			}
			echo '</select><br>';			
			echo "<b> Postal Code: </b>" . '<input type="text" name="postal_code" value="'.$row["postal_code"].'"><br>';
			echo "<b> Phone: </b>" . '<input type="text" name="phone" value="'.$row["phone"].'"><br>';	
		
		}

	}
	echo '<input type="submit"> <br/><br/>';
	
	echo '<a href="select_address.php">Go back</a> <br/>';


	$conn->close();
?>