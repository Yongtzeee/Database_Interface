<?php
	require "../db.php";

	
	if(!empty($_GET["update"]) && $_GET["update"] == 1){
		$updatesql = "UPDATE inventory SET last_update=CURRENT_TIMESTAMP,film_id='" . $_GET["film_id"]. "',store_id='" . $_GET["store_id"] . "' WHERE inventory_id=" . $_GET["inventory_id"] .";";
		$conn->query($updatesql);
		echo $updatesql;

		echo 'Success <br>';
		echo '<a href="update_inventory.php?inventory_id=' . $_GET["inventory_id"] . '">Click here to Go back </a>';
		exit;
	}
	
	
	$sql = "SELECT * FROM inventory WHERE inventory_id = '";
	if(!empty($_GET["inventory_id"])){
		$sql = $sql . $_GET["inventory_id"]; 
	}
	$sql = $sql . "'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo '<form action="update_inventory.php?inventory_id=' . $_GET["inventory_id"] . '">';
			echo '<input type="hidden" name="update" value="1" />';
			echo '<input type="hidden" name="inventory_id" value="'  . $_GET["inventory_id"] . '"/>';
			
			//echo "<b> inventory_id: </b>" . '<input type="text" name="inventory_id" value="'.$row["inventory_id"].'"><br>';
			$filmsql = "SELECT * from film";
			$filmresult = $conn->query($filmsql);
			echo '<b> Film: </b><select name="film_id">';			
			while($filmrow = $filmresult->fetch_assoc()) {
				if($filmrow["film_id"] == $row["film_id"]) echo '<option value="' . $filmrow["film_id"] . '" selected="selected" >' . $filmrow["title"] . '</option>';
				else echo '<option value="' . $filmrow["film_id"] . '">' . $filmrow["title"] . '</option>';
			}
		    echo '</select><br>';			

			$storesql = "SELECT * from store";
			$storeresult = $conn->query($storesql);
			echo '<b> Store: </b><select name="store_id">';			
			while($storerow = $storeresult->fetch_assoc()) {
			if($storerow["store_id"] == $row["store_id"]) echo '<option value="' . $storerow["store_id"] . 'selected="selected" >' . $storerow["store_id"] . '</option>';
			else echo '<option value="' . $storerow["store_id"] . '">' . $storerow["store_id"] . '</option>';
			}
			echo '</select><br>';			

		    }
		}

	echo '<input type="submit"> <br/><br/>';
	
	echo '<a href="select_inventory.php">Go back</a>';


	$conn->close();

?>
