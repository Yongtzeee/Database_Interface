<?php
	require "../db.php";

	if(!empty($_GET["update"]) && $_GET["update"] == 1){
	    if(empty($_GET["name"])){
	        echo '<script> alert("ERROR! \nFields cannot be empty.");window.close();</script>';
	        exit;
	    }
		$updatesql = "UPDATE category SET last_update=CURRENT_TIMESTAMP,name = '" . $_GET["name"] ."' WHERE category_id ='" . $_GET["category_id"] . "';" ; 
		//echo $updatesql;
		$conn->query($updatesql);
		echo 'Success <br>';
		echo '<a href="update_category.php?category_id=' . $_GET["category_id"] . '">Click here to Go back </a>';
		exit;
	}
	
	
	$sql = "SELECT * FROM category WHERE category_id = '";
	if(!empty($_GET["category_id"])){
		$sql = $sql . $_GET["category_id"]; 
	}
	$sql = $sql . "';";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo '<form action="update_category.php?actor_id=' . $_GET["category_id"] . '">';
			echo '<input type="hidden" name="update" value="1" />';
			echo '<input type="hidden" name="category_id" value="'  . $_GET["category_id"] . '"/>';

			echo "<b> Name </b>" . '<input type="text" name="name" value="'.$row["name"].'"><br>';
		}

	}
	echo '<input type="submit">';

	echo "<br><br><br>";
	echo '<br><br><a href="select_category.php">Back</a> <br>';

	$conn->close();
?>