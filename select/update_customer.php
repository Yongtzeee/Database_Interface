<?php
	require "../db.php";

	
	if(!empty($_GET["update"]) && $_GET["update"] == 1){
	    if(empty($_GET["first_name"]) || empty($_GET["last_name"])){
	        echo '<script> alert("ERROR! \nFields cannot be empty.");window.close();</script>';
	        exit;
	    }
		$updatesql = "UPDATE customer SET last_update=CURRENT_TIMESTAMP,store_id='" . $_GET["store_id"] . "',first_name='" . $_GET["first_name"] . "',last_name='" . $_GET["last_name"] . "',email='" . $_GET["email"] ."',address_id='" . $_GET["address_id"] ."',active='" . $_GET["active"] . "' WHERE customer_id=" . $_GET["customer_id"] . ";";
		$conn->query($updatesql);
		//echo $updatesql;

		echo 'Success <br>';
		echo '<a href="update_customer.php?customer_id=' . $_GET["customer_id"] . '">Click here to Go back </a>';
		exit;
	}
	
	
	$sql = "SELECT * FROM customer WHERE customer_id = '";
	if(!empty($_GET["customer_id"])){
		$sql = $sql . $_GET["customer_id"]; 
	}
	$sql = $sql . "'";
	echo $sql;
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo '<form action="update_customer.php?customer_id=' . $_GET["customer_id"] . '">';
			echo '<input type="hidden" name="update" value="1" />';
			echo '<input type="hidden" name="customer_id" value="'  . $_GET["customer_id"] . '"/>';
			echo "<b> Sore ID: </b>" . '<input type="text" name="store_id" value="'.$row["store_id"].'"><br>';
			echo "<b> First Name: </b>" . '<input type="text" name="first_name" value="'.$row["first_name"].'"><br>';	
			echo "<b> Last Name: </b>" . '<input type="text" name="last_name" value="'.$row["last_name"].'"><br>';	
			echo "<b> Email: </b>" . '<input type="text" name="email" value="'.$row["email"].'"><br>';	
			echo '<b> Address: </b><select name="address_id">';			
			$addresssql = "SELECT * from address";
			$addressresult = $conn->query($addresssql);
			while($addressrow = $addressresult->fetch_assoc()) {
				if($addressrow["address_id"] == $row["address_id"]) echo '<option value="' . $addressrow["address_id"] . '" selected="selected" >' . $addressrow["address"] . '</option>';
				else echo '<option value="' . $addressrow["address_id"] . '">' . $addressrow["address"] . '</option>';
			}
			echo '</select><br>';	
			echo '<a href="update_address.php?address_id=' . $row["address_id"] . '" target="_blan">Update Address Information for This Customer </a><br>';
			echo '<b> Active: </b><select name="active">';			
			if($row["active"] == 1) echo '<option value="1" selected="selected" > Yes </option> <option value="0"> No </option>';
			else echo '<option value="1"> Yes </option> <option value="0" selected="selected"> No </option>';
			echo '</select><br>';	
		}

	}
	echo '<input type="submit"> <br/><br/>';
    
    echo '<a href="select_customer.php">Go back</a>';

	$conn->close();
?>