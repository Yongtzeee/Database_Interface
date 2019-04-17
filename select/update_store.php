<?php
	require "../db.php";

	if(!empty($_GET["update"]) && $_GET["update"] == 1){
		$updatesql = "UPDATE store SET last_update=CURRENT_TIMESTAMP,manager_staff_id = '" . $_GET["staff_id"] . "',address_id = '" . $_GET["address_id"] . "' WHERE store_id ='" . $_GET["store_id"] . "';" ; 
		echo $updatesql;
		$conn->query($updatesql);
		echo 'Success <br>';
		echo '<a href="update_store.php?store_id=' . $_GET["store_id"] . '">Click here to Go back </a>';
		exit;
	}
	
	
	$sql = "SELECT * FROM store WHERE store_id = '";
	if(!empty($_GET["store_id"])){
		$sql = $sql . $_GET["store_id"]; 
	}
	$sql = $sql . "';";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo '<form action="update_store.php?actor_id=' . $_GET["store_id"] . '">';
			echo '<input type="hidden" name="update" value="1" />';
			echo '<input type="hidden" name="store_id" value="'  . $_GET["store_id"] . '"/>';
			$staffsql = "SELECT * from staff";
			$staffresult = $conn->query($staffsql);
			echo '<b> Manager: </b><select name="staff_id">';			
			while($staffrow = $staffresult->fetch_assoc()) {
				if($staffrow["staff_id"] == $row["staff_id"]) echo '<option value="' . $staffrow["staff_id"] . '" selected="selected" >' . $staffrow["first_name"] . " " . $staffrow["last_name"] . '</option>';
				else echo '<option value="' . $staffrow["staff_id"] . '">' . $staffrow["first_name"] . " " . $staffrow["last_name"] . '</option>';
			}
			echo '</select><br>';		
			$addresssql = "SELECT * from address";
			$addressresult = $conn->query($addresssql);
			echo '<b> Address: </b><select name="address_id">';			
			while($addressrow = $addressresult->fetch_assoc()) {
				if($addressrow["address_id"] == $row["address_id"]) echo '<option value="' . $addressrow["address_id"] . '" selected="selected" >' . $addressrow["address"] . '</option>';
				else echo '<option value="' . $addressrow["address_id"] . '">' . $addressrow["address"] . '</option>';
			}
			echo '</select><br>';			
		}

	}
	echo '<input type="submit">';

	echo "<br><br><br>";
	echo '<br><br><a href="select_store.php">Back</a> <br>';

	$conn->close();
?>