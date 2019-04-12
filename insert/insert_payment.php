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
<form method="get" action="insert_payment.php">
	Customer ID:
	<?php
		require "../db.php";
		
		$sql = "SELECT * FROM customer WHERE 1";
		$result = $conn->query($sql);
		
		echo '<select name="customer_id">';
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo '<option value="' . $row["customer_id"] . '">' . $row["customer_id"] . ' - ' . $row["first_name"] . ' ' . $row["last_name"] . "</option>";
			}
		}
		//$result->close();
		echo '</select> <span style="color:red">*</span> <br/>';
	?>
	Staff ID:
	<?php
		require "../db.php";
		
		$sql = "SELECT * FROM staff WHERE 1";
		$result = $conn->query($sql);
		
		echo '<select name="staff_id">';
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo '<option value="' . $row["staff_id"] . '">' . $row["staff_id"] . ' - ' . $row["first_name"] . ' ' . $row["last_name"] . "</option>";
			}
		}
		//$result->close();
		echo '</select> <span style="color:red">*</span> <br/>';
	?>
	Rental ID:
	<?php
		require "../db.php";
		
		$sql = "SELECT * FROM rental WHERE 1";
		$result = $conn->query($sql);
		
		echo '<select name="rental_id">';
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo '<option value="' . $row["rental_id"] . '">' . $row["rental_id"] . ' - ' . $row["inventory_id"] . "</option>";
			}
		}
		//$result->close();
		echo '</select> <span style="color:red">*</span> <br/>';
	?>
	Amount: <input type="text" name="amount"> <span style="color:red">*</span> <br/>
	Payment Date: <input type="text" name="payment_date"> <span style="color:red">*</span> <br/>
	<input type="submit"><br><br>
</form>

<input type="button" value="Go back" onclick="redirect()"><br>
    
<script>
    function redirect(){
        window.location.href="../select/select_payment.php";
    }
</script>


<?php

require "../db.php";

$validate = 0;

$sql = "INSERT INTO `payment` (`customer_id`, `staff_id`, `rental_id`, `amount`, `payment_date`, `last_update`) VALUES (";

if(!empty($_GET["customer_id"])){
	$sql = $sql . $_GET["customer_id"] . ", ";
	$validate++;
}
if(!empty($_GET["staff_id"])){
	$sql = $sql . $_GET["staff_id"] . ", ";
	$validate++;
}
if(!empty($_GET["rental_id"])){
	$sql = $sql . $_GET["rental_id"] . ", ";
	$validate++;
}
if(!empty($_GET["amount"])){
	$sql = $sql . $_GET["amount"] . ", ";
	$validate++;
}
if(!empty($_GET["payment_date"])){
	$sql = $sql . "\"" . $_GET["payment_date"] . "\"" . ", ";
	$validate++;
}

// add last_update
$sql = $sql . "CURRENT_TIMESTAMP)";

if($validate < 5){
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
