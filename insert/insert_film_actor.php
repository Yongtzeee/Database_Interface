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
<form method="get" action="insert_film_actor.php">
	Actor ID:
	<?php
		require "../db.php";
		
		$sql = "SELECT * FROM actor WHERE 1";
		$result = $conn->query($sql);
		
		echo '<select name="actor_id">';
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo '<option value="' . $row["actor_id"] . '">' . $row["actor_id"] . " - " . $row["first_name"] . ' ' . $row["last_name"] . "</option>";
			}
		}
		//$result->close();
		echo '</select> <span style="color:red">*</span> <br/>';
	?>
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

$sql = "INSERT INTO `film_actor` (`actor_id`, `film_id`, `last_update`) VALUES (";

if(!empty($_GET["actor_id"])){
	$sql = $sql . $_GET["actor_id"] . ", ";
	$validate++;
}
if(!empty($_GET["film_id"])){
	$sql = $sql . $_GET["film_id"] . ", ";
	$validate++;
}

// add last_update
$sql = $sql . "CURRENT_TIMESTAMP)";

if($validate < 2){
    echo '<p style="color:red; font-weight:bold">Please enter all the required fields.</p>';
}
else{
    echo '<p style="color:green; font-weight:bold">Table updated. Press "Go back" to return to main page.</p>';
}

echo $sql;

$conn->query($sql);

?>

</body>
</html>
