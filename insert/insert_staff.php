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
<form method="get" action="insert_staff.php">
	First Name: <input type="text" name="first_name"> <span style="color:red">*</span> <br/>
	Last Name: <input type="text" name="last_name"> <span style="color:red">*</span> <br/>
	Address ID:
	<?php
		require "../db.php";
		
		$sql = "SELECT * FROM address WHERE 1";
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
	Picture (URL): <input type="text" name="picture"><br/>
	Email: <input type="text" name="email"> <span style="color:red">*</span> <br/>
	Store ID:
	<?php
		require "../db.php";
		
		$sql = "SELECT * FROM store WHERE 1";
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
	Active:
	<select name="active">
		<option value="0" <?php if($row["active"] == "0") echo 'selected="selected"' ?>>Inactive</option>
		<option value="1" <?php if($row["active"] == "1") echo 'selected="selected"' ?>>Active</option>
	</select> <span style="color:red">*</span> <br/>
	Username: <input type="text" name="username"> <span style="color:red">*</span> <br/>
	Password: <input type="text" name="password"> <span style="color:red">*</span> <br/>
	<input type="submit"><br><br>
</form>

<input type="button" value="Go back" onclick="redirect()"><br>
    
<script>
    function redirect(){
        window.location.href="../select/select_staff.php";
    }
</script>


<?php

require "../db.php";

$validate = 0;

$sql = "INSERT INTO `staff` (`first_name`, `last_name`, `address_id`, `picture`, `email`, `store_id`, `active`, `username`, `password`, `last_update`) VALUES (";

if(!empty($_GET["first_name"])){
	$sql = $sql . "\"" . $_GET["first_name"] . "\"" . ", ";
	$validate++;
}
if(!empty($_GET["last_name"])){
	$sql = $sql . "\"" . $_GET["last_name"] . "\"" . ", ";
	$validate++;
}
if(!empty($_GET["address_id"])){
	$sql = $sql . $_GET["address_id"] . ", ";
	$validate++;
}
if(!empty($_GET["picture"])){
	$img = file_get_contents($_GET["picture"]); 
	$data = bin2hex($img); 
	$sql = $sql ."'" . $data ."',";
}
else{
	$sql = $sql . "NULL" . ", ";
}
if(!empty($_GET["email"])){
	$sql = $sql . "\"" . $_GET["email"] . "\"" . ", ";
	$validate++;
}
if(!empty($_GET["store_id"])){
	$sql = $sql . $_GET["store_id"] . ", ";
	$validate++;
}

$sql = $sql . $_GET["active"] . ", ";

if(!empty($_GET["username"])){
	$sql = $sql . "\"" . $_GET["username"] . "\"" . ", ";
	$validate++;
}
if(!empty($_GET["password"])){
	$sql = $sql . "\"" . $_GET["password"] . "\"" . ", ";
	$validate++;
}

// add last_update
$sql = $sql . "CURRENT_TIMESTAMP)";

if($validate < 7){
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
