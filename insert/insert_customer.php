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
<form method="get" action="insert_customer.php">
	Store ID:
	<?php
		require "../db.php";
		
		$sql = "SELECT * FROM `store` WHERE 1";
		$result = $conn->query($sql);
		
		echo '<select name="store_id">';
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo '<option value="' . $row["store_id"] . '">' . $row["store_id"] . "</option>";
			}
		}
		//$result->close();
		echo '</select> <span style="color:red">*</span> <br/>';
	?>
	First Name: <input type="text" name="first_name"> <span style="color:red">*</span> <br/>
	Last Name: <input type="text" name="last_name"> <span style="color:red">*</span> <br/>
	Email: <input type="text" name="email"> <span style="color:red">*</span> <br/>
	Address ID:
	<?php
		require "../db.php";
		
		$sql = "SELECT * FROM `address` WHERE 1";
		$result = $conn->query($sql);
		
		echo '<select name="address_id">';
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo '<option value="' . $row["address_id"] . '">' . $row["address_id"] . ' - ' . $row["address"] . ', ' . $row["address2"] . "</option>";
			}
		}
		//$result->close();
		echo '</select> <span style="color:red">*</span> <br/>';
	?>
	Active:
	<select name="active">
		<option value="0" <?php if($row["active"] == "0") echo 'selected="selected"' ?>>Inactive</option>
		<option value="1" <?php if($row["active"] == "1") echo 'selected="selected"' ?>>Active</option>
	</select> <span style="color:red">*</span> <br/>
	Date Created: <input type="text" name="create_date"> <span style="color:red">*</span> <br/>
	<input type="submit"><br><br>
</form>

<input type="button" value="Go back" onclick="redirect()"><br>
    
<script>
    function redirect(){
        window.location.href="../select/select_customer.php";
    }
</script>



<?php

require "../db.php";

$validate = 0;

$sql = "INSERT INTO `customer` (`store_id`, `first_name`, `last_name`, `email`, `address_id`, `active`, `create_date`, `last_update`) VALUES (";

if(!empty($_GET["store_id"])){
	$sql = $sql . $_GET["store_id"] . ", ";
	$validate++;
}
if(!empty($_GET["first_name"])){
	$sql = $sql . "\"" . $_GET["first_name"] . "\"" . ", ";
	$validate++;
}
if(!empty($_GET["last_name"])){
	$sql = $sql . "\"" . $_GET["last_name"] . "\"" . ", ";
	$validate++;
}
if(!empty($_GET["email"])){
	$sql = $sql . "\"" . $_GET["email"] . "\"" . ", ";
	$validate++;
}
if(!empty($_GET["address_id"])){
	$sql = $sql . $_GET["address_id"] . ", ";
	$validate++;
}
if(!empty($_GET["active"])){
	$sql = $sql . $_GET["active"] . ", ";
}
else{
    $sql = $sql . "0, ";
}
if(!empty($_GET["create_date"])){
	$sql = $sql . "'" . $_GET["create_date"] . "'" . ", ";
	$validate++;
}

// add last_update
$sql = $sql . "CURRENT_TIMESTAMP)";

if($validate < 6){
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
