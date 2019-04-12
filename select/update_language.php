<?php
	require "../db.php";

	
	if(!empty($_GET["update"]) && $_GET["update"] == 1){
		$updatesql = "UPDATE language SET last_update=CURRENT_TIMESTAMP,name = '" . $_GET["name"] ."' WHERE language_id ='" . $_GET["language_id"] . "';" ; 
		//echo $updatesql;
		$conn->query($updatesql);
		echo 'Success <br>';
		echo '<a href="update_language.php?language_id=' . $_GET["language_id"] . '">Click here to Go back </a>';
		exit;
	}
	
	
	$sql = "SELECT * FROM language WHERE language_id = '";
	if(!empty($_GET["language_id"])){
		$sql = $sql . $_GET["language_id"]; 
	}
	$sql = $sql . "';";
	//echo $sql;
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo '<form action="update_language.php?actor_id=' . $_GET["language_id"] . '">';
			echo '<input type="hidden" name="update" value="1" />';
			echo '<input type="hidden" name="language_id" value="'  . $_GET["language_id"] . '"/>';

			echo "<b> Name </b>" . '<input type="text" name="name" value="'.$row["name"].'"><br>';
		}

	}
	echo '<input type="submit">';

	echo "<br><br><br>";
	echo '<br><br><a href="select_language.php">Back</a> <br>';

	$conn->close();
?>