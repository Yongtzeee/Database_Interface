<?php
	require "../db.php";

	//echo "Connected successfully <br> <br>";

?>
<h2>Search Payment</h2>
<form action="select_payment.php" target="_self" method="GET">
  Payment ID:<br>
  <input type="text" name="paymend_id" value = "<?php if(!empty($_GET["paymend_id"])) echo $_GET["paymend_id"]; ?>">
  <br>
  Customer:<br>
<?php
	$cussql = "SELECT * from customer";
	$cusresult = $conn->query($cussql);
	echo '<select name="customer_id">';
	echo '<option value=""> --Not Selected-- </option>';
	while($cusrow = $cusresult->fetch_assoc()) {
		if($cusrow["customer_id"] == $_GET["customer_id"]) echo '<option value="' . $cusrow["customer_id"] . '" selected="selected" >' . $cusrow["first_name"] . " " . $cusrow["last_name"] . '</option>';
		else echo '<option value="' . $cusrow["customer_id"] . '">' . $cusrow["first_name"] . " " . $cusrow["last_name"] . '</option>';	}
	echo "</select><br>";
?>
  Rental ID:<br>
  <input type="text" name="rental_id" value = "<?php if(!empty($_GET["rental_id"])) echo $_GET["rental_id"]; ?>">
  <br>
  <input type="submit" value="Submit">
</form>

<input type="button" value="Insert new data" onclick="redirect()"><br><br>
    
<a href="../index.html"><input type="button" value="Homepage"></a><br><br>

<script>
    function redirect(){
        window.location.href="../insert/insert_payment.php";
    }
</script>


<?php
	$sql = "SELECT p.*,c.first_name 'cfname',c.last_name 'clname',s.first_name 'sfname',s.last_name 'slname' FROM payment AS p LEFT OUTER JOIN customer as c ON (p.customer_id=c.customer_id) LEFT OUTER JOIN staff as s ON (p.staff_id = s.staff_id) WHERE p.payment_id = '";
	if(!empty($_GET["paymend_id"])){
		$sql = $sql . $_GET["paymend_id"]; 
	}
	$sql = $sql . "' OR c.customer_id = '";
	if(!empty($_GET["customer_id"])){
		$sql = $sql . $_GET["customer_id"];
	}
	$sql = $sql . "' OR p.rental_id = '";
	if(!empty($_GET["rental_id"])){
		$sql = $sql . $_GET["rental_id"];
	}
	$sql = $sql . "' ORDER BY 'payment_id' ASC ";
	echo $sql;
	//echo "Showing results for ID" . $_GET["id"] . " title " . $_GET["title"]; 
	echo "<br>";
	$result = $conn->query($sql);
	echo "<table border=1>";
	
	if ($result->num_rows > 0) {
		echo "<tr><th>Payment ID</th><th>Customer</th><th>Staff</th><th>Rental ID</th><th>Amount</th>><th>Delete</th></tr>";
			
		while($row = $result->fetch_assoc()) {
	
			echo "<tr> <td>" . $row["payment_id"]. "</td><td>" . $row["cfname"]. " " . $row["clname"].  "</td><td>" . $row["sfname"]. " " . $row["slname"]. "</td><td>" . $row["rental_id"] . "</td><td>";
			echo $row["amount"] . "</td><td>";;
			echo '<a target="_blank" href=../delete/delete_payment.php?paymentid=' . $row["film_id"] . ">Delete this payment</a>"."</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	else {
		echo "0 results";
	}
	$conn->close();
?>