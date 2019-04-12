<?php
    require "../db.php";
?>

<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}
</style>
<body>
<p style="color:red">* required</p>
<form method="get" action="insert_film.php">
	Title: <input type="text" name="title"> <span style="color:red">*</span> <br/>
	Description: <input type="text" name="description"> <span style="color:red">*</span> <br/>
	Release Year: <input type="text" name="release_year"> <span style="color:red">*</span> <br/>
	Language ID:
	<?php
		
		$sql = "SELECT * FROM language WHERE 1";
		$result = $conn->query($sql);
		
		echo '<select name="language">';
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo '<option value="' . $row["language_id"] . '">' . $row["language_id"] . " - " . $row["name"] . "</option>";
			}
		}
		//$result->close();
		echo '</select> <span style="color:red">*</span> <br/>';
	?>
	Original Language ID:
	<?php
		
		$sql = "SELECT * FROM language WHERE 1";
		$result = $conn->query($sql);
		
		echo '<select name="original_language">';
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo '<option value="' . $row["language_id"] . '">' . $row["language_id"] . " - " . $row["name"] . "</option>";
			}
		} else {
			echo "<option></option>";
		}
		//$result->close();
		echo '</select> <span style="color:red">*</span> <br/>';
	?>
	Rental Duration: <input type="text" name="rental_duration"> <span style="color:red">*</span> <br/>
	Rental Rate: <input type="text" name="rental_rate"> <span style="color:red">*</span> <br/>
	Length: <input type="text" name="length"> <span style="color:red">*</span> <br/>
	Replacement Cost: <input type="text" name="replacement_cost"> <span style="color:red">*</span> <br/>
	Rating:
	<select name="rating">
		<option value="G" <?php if($row["rating"] == "G") echo 'selected="selected"' ?>>G</option>
		<option value="PG" <?php if($row["rating"] == "PG") echo 'selected="selected"' ?>>PG</option>
		<option value="PG-13" <?php if($row["rating"] == "PG-13") echo 'selected="selected"' ?>>PG-13</option>
		<option value="NC-17" <?php if($row["rating"] == "NC-17") echo 'selected="selected"' ?>>NC-17</option>
		<option value="R" <?php if($row["rating"] == "R") echo 'selected="selected"' ?>>R</option>
	</select> <span style="color:red">*</span> <br/>
	Special Features: <input type="text" name="special_features"> <span style="color:red">*</span> <br/>
	Category ID:
	<?php
		require "../db.php";
		
		$sql = "SELECT * FROM category WHERE 1";
		$result = $conn->query($sql);
		
		echo '<select name="category_id">';
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo '<option value="' . $row["category_id"] . '">' . $row["category_id"] . " - " . $row["name"] . "</option>";
			}
		}
		//$result->close();
		echo '</select> <span style="color:red">*</span> <br/>';
	?>
	<input type="submit"/><br><br>
</form>

<input type="button" value="Go back" onclick="redirect()"><br>
    
<script>
    function redirect(){
        window.location.href="../select/select_film.php";
    }
</script>


<?php

$validate = 0;

$sql = "INSERT INTO `film` (`title`, `description`, `release_year`, `language_id`, `original_language_id`, `rental_duration`, `rental_rate`, `length`, `replacement_cost`, `rating`, `special_features`, `last_update`) VALUES (";


if(!empty($_GET["title"])){
	$sql = $sql . "\"" . $_GET["title"] . "\"" . ", ";
	$validate++;
}
if(!empty($_GET["description"])){
	$sql = $sql . "\"" . $_GET["description"] . "\"" . ", ";
	$validate++;
}
if(!empty($_GET["release_year"])){
	$sql = $sql . $_GET["release_year"] . ", ";
	$validate++;
}
if(!empty($_GET["language"])){
	$sql = $sql . $_GET["language"] . ", ";
	$validate++;
}
if(!empty($_GET["original_language"])){
	$sql = $sql . $_GET["original_language"] . ", ";
	$validate++;
}
if(!empty($_GET["rental_duration"])){
	$sql = $sql . $_GET["rental_duration"] . ", ";
	$validate++;
}
if(!empty($_GET["rental_rate"])){
	$sql = $sql . $_GET["rental_rate"] . ", ";
	$validate++;
}
if(!empty($_GET["length"])){
	$sql = $sql . $_GET["length"] . ", ";
	$validate++;
}
if(!empty($_GET["replacement_cost"])){
	$sql = $sql . $_GET["replacement_cost"] . ", ";
	$validate++;
}
if(!empty($_GET["rating"])){
	$sql = $sql . '"' . $_GET["rating"] . '"' . ", ";
	$validate++;
}
if(!empty($_GET["special_features"])){
	$sql = $sql . "\"" . $_GET["special_features"] . "\"" . ", ";
	$validate++;
}
if(!empty($_GET["category_id"])){
	$validate++;
}

if($validate < 12){
    echo '<p style="color:red; font-weight:bold">Please enter all the required fields.</p>';
}
else{
    echo '<p style="color:green; font-weight:bold">Table updated. Press "Go back" to return to main page.</p>';
}

// add last_update
$sql = $sql . "CURRENT_TIMESTAMP);";

echo $sql;

$conn->query($sql);

$getFilmId = 'SELECT * FROM `film` WHERE `title` = "'. $_GET["title"] .'";' ;
echo $getFilmId;
$getFilmId = $conn->query($getFilmId);
$filmId = $getFilmId->fetch_assoc();
$getCategoryId = $_GET["category_id"];

$sql = "INSERT INTO `film_category` (`film_id`, `category_id`, `last_update`) VALUES (";
$sql = $sql . $filmId["film_id"] . ', ' . $getCategoryId . ', CURRENT_TIMESTAMP);';

echo $sql;

$conn->query($sql);

$sql = "INSERT INTO `film_text` (`film_id`, `title`, `description`) VALUES (";
$sql = $sql . $filmId["film_id"] . ', "' . $_GET["title"] . '", "' . $_GET["description"] . '");';

echo $sql;

$conn->query($sql);

?>

</body>
</html>
