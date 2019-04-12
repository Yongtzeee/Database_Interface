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
<form method="get" action="insert_address.php">
	Address: <input type="text" name="address"> <span style="color:red">*</span> <br/>
	Address2: <input type="text" name="address2"><br/>
	District: 
	<?php
		require "../db.php";
		
		$sql = "SELECT DISTINCT district FROM address ORDER BY district ASC";
		$result = $conn->query($sql);
		
		echo '<select name="district">';
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo '<option value="' . $row["district"] . '">' . $row["district"] . "</option>";
			}
		}
		//$result->close();
		echo '</select> <span style="color:red">*</span> <br/>';
	?>
	City ID: 
	<?php
		require "../db.php";
		
		$sql = "SELECT * FROM city WHERE 1";
		$result = $conn->query($sql);
		
		echo '<select name="city_id">';
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo '<option value="' . $row["city_id"] . '">' . $row["city_id"] . " - " . $row["city"] . "</option>";
			}
		}
		//$result->close();
		echo '</select> <span style="color:red">*</span> <br/>';
	?>
	Postal Code: <input type="text" name="postal_code"> <span style="color:red">*</span> <br/>
	Phone: <input type="text" name="phone"> <span style="color:red">*</span> <br/>
	<input type="submit"><br><br>
</form>

<input type="button" value="Go back" onclick="redirect()"><br>
    
<script>
    function redirect(){
        window.location.href="../select/select_address.php";
    }
</script>


<?php

require "../db.php";

$sql = "INSERT INTO `address` (`address`,`address2`, `district`, `city_id`, `postal_code`, `phone`, `last_update`) VALUES (";

$validate = 0;

if(!empty($_GET["address"])){
	$sql = $sql . "\"" . $_GET["address"] . "\"" . ", ";
	$validate++;
}
if(!empty($_GET["address2"])){
	$sql = $sql . "\"" . $_GET["address2"] . "\"" . ", ";
}
else{
	$sql = $sql . "NULL" . ", ";
}
if(!empty($_GET["district"])){
	$sql = $sql . "\"" . $_GET["district"] . "\"" . ", ";
	$validate++;
}
if(!empty($_GET["city_id"])){
	$sql = $sql . $_GET["city_id"] . ", ";
	$validate++;
}
if(!empty($_GET["postal_code"])){
	$sql = $sql . $_GET["postal_code"] . ", ";
	$validate++;
}
if(!empty($_GET["phone"])){
	$sql = $sql . '"' . $_GET["phone"] . '", ';
	$validate++;
}

if($validate < 5){
    echo '<p style="color:red; font-weight:bold">Please enter all the required fields.</p>';
}
else{
    echo '<p style="color:green; font-weight:bold">Table updated. Press "Go back" to return to main page.</p>';
}

// add last_update
$sql = $sql . "CURRENT_TIMESTAMP)";

echo $sql;

$conn->query($sql);

?>

</body>
</html>
