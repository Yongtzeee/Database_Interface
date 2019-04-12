<?php
	require "../db.php";

	if(!empty($_GET["update"]) && $_GET["update"] == 1){
	    if(empty($_GET["title"])){
	        echo '<script> alert("ERROR! \nFields cannot be empty.");window.close();</script>';
	        exit;
	    }
		$updatesql = "UPDATE film SET last_update=CURRENT_TIMESTAMP,title = '" . $_GET["title"] . "', rating = '" . $_GET["rating"] . "', description = '" . $_GET["description"] . "', language_id = '" . $_GET["language_id"] . "', release_year = '" . $_GET["release_year"] . "', rental_duration = '" . $_GET["rental_duration"] . "', rental_rate = '" . $_GET["rental_rate"] . "', replacement_cost = '" . $_GET["replacement_cost"] . "', special_features = '" . $_GET["special_features"] . "' WHERE film_id = " . $_GET["id"] . ";" ; 
		//echo $updatesql;
		$conn->query($updatesql);
		$updatesql = "UPDATE film_category SET category_id=" . $_GET["category_id"] . " WHERE film_id=" . $_GET["id"] . ";";
		$conn->query($updatesql);
		echo 'Success <br>';
		echo '<a href="update_film.php?id=' . $_GET["id"] . '">Click here to Go back </a>';
		exit;
	}
	
	
	$sql = "SELECT b.*,a.name 'langname',d.name 'catname' FROM film AS b JOIN language as a ON (b.language_id=a.language_id) JOIN film_category as c ON (b.film_id = c.film_ID) JOIN category as d ON (c.category_id = d.category_id) WHERE b.film_id = '";
	if(!empty($_GET["id"])){
		$sql = $sql . $_GET["id"]; 
	}
	$sql = $sql . "'";
	//echo $sql;
	//echo "Showing results for ID" . $_GET["id"] . " title " . $_GET["title"]; 
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo '<form action="update_film.php?id=' . $_GET["id"] . '">';
			echo '<input type="hidden" name="update" value="1" />';
			echo '<input type="hidden" name="id" value="'  . $_GET["id"] . '"/>';
			echo "<b> Title: </b>" .'<input type="text" name="title" value="'.$row["title"].'"><br>';
?>
<b> Rating: </b> 
<select name="rating">
	<option value="G" <?php if($row["rating"] == "G") echo 'selected="selected"' ?>>G</option>
	<option value="PG" <?php if($row["rating"] == "PG") echo 'selected="selected"' ?>>PG</option>
	<option value="PG-13" <?php if($row["rating"] == "PG-13") echo 'selected="selected"' ?>>PG-13</option>
	<option value="NC-17" <?php if($row["rating"] == "NC-17") echo 'selected="selected"' ?>>NC-17</option>
	<option value="R" <?php if($row["rating"] == "R") echo 'selected="selected"' ?>>R</option>
</select>
<br>
<?php
			echo "<b> Category: </b>";
			echo '<select name="category_id">';
			$catsql = "SELECT * from category";
			$catresult = $conn->query($catsql);
		
			$filmcatsql = "SELECT category_id from film_category WHERE film_id =" . $_GET["id"] . ';';
			$filmcatresult = $conn->query($filmcatsql);
			$filmcatrow = $filmcatresult->fetch_assoc();
			
			while($catrow = $catresult->fetch_assoc()) {
				if($catrow["category_id"] == $filmcatrow["category_id"]) echo '<option value="' . $catrow["category_id"] . '" selected="selected" >' . $catrow["name"] . '</option>';
				else echo '<option value="' . $catrow["category_id"] . '">' . $catrow["name"] . '</option>';
			}
			echo '</select><br>';
			echo "<b> Description: </b> <br>" . '<textarea type="text" cols="40" rows="5" name="description" >' .$row["description"]. '</textarea><br>';
			echo "<b> Releast Year: </b>" . '<input type="text" name="release_year" value="'.$row["release_year"].'"><br>';

			echo "<b> Language: </b>";
			echo '<select name="language_id">';			
			$langsql = "SELECT * from language";
			$langresult = $conn->query($langsql);
			while($langrow = $langresult->fetch_assoc()) {
				if($langrow["language_id"] == $row["language_id"]) echo '<option value="' . $langrow["language_id"] . '" selected="selected" >' . $langrow["name"] . '</option>';
				else echo '<option value="' . $langrow["language_id"] . '">' . $langrow["name"] . '</option>';
			}
			echo '</select><br>';
			echo "<b> Rental Duration: </b>" . '<input type="text" name="rental_duration" value="'.$row["rental_duration"].'"><br>';
			echo "<b> Rental Rate: </b>" . '<input type="text" name="rental_rate" value="'.$row["rental_rate"].'"><br>';
			echo "<b> Length: </b>" . '<input type="text" name="length" value="'.$row["length"].'"><br>';
			echo "<b> Replacement Cost: </b>" . '<input type="text" name="replacement_cost" value="'.$row["replacement_cost"].'"><br>';
			echo "<b> Special Features: </b>" . '<input type="text" name="special_features" value="'.$row["special_features"].'"><br>';	
		
		}

	}
	echo '<input type="submit">';

	echo "<br><br><br>";
	echo '<br><br><a href="info_film.php?id=' . $_GET["id"] . '">Back</a> <br>';

	$conn->close();
?>