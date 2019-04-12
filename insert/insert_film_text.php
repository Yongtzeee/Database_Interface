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
<form method="get" action="insert_film_text.php">
	Film ID:
	<?php
		require "../db.php";
		
		$sql = "SELECT * FROM film WHERE 1";
		$result = $conn->query($sql);
		
		echo '<select name="film_id">';
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo '<option value="' . $row["film_id"] . '">' . $row["film_id"] . " - " . $row["title"] . "</option>";
			}
		}
		//$result->close();
		echo '</select> <span style="color:red">*</span> <br/>';
	?>
	Title: <input type="text" name="title"> <span style="color:red">*</span> <br/>
	Description: <input type="text" name="description"> <span style="color:red">*</span> <br/>
	<input type="submit"><br><br>
</form>

<input type="button" value="Go back" onclick="redirect()"><br>
    
<script>
    function redirect(){
        window.location.href="../select/select_film.php";
    }
</script>


<?php

require "../db.php";

$validate = 0;

$sql = "INSERT INTO `film_text` (`film_id`, `title`, `description`) VALUES (";

if(!empty($_GET["film_id"])){
	$sql = $sql . $_GET["film_id"] . ", ";
	$validate++;
}
if(!empty($_GET["title"])){
	$sql = $sql . "\"" . $_GET["title"] . "\"" . ", ";
	$validate++;
}
if(!empty($_GET["description"])){
	$sql = $sql . "\"" . $_GET["description"] . "\"" . ")";
	$validate++;
}

if($validate < 3){
    echo '<p style="color:red; font-weight:bold">Please enter all the requried fields.</p>';
}
else{
    echo '<p style="color:green; font-weight:bold">Table updated. Press "Go back" to return to main page.</p>';
}


echo $sql;

$conn->query($sql);

?>

</body>
</html>
