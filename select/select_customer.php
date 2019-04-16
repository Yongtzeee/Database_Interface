<?php
	require "../db.php";

	//echo "Connected successfully <br> <br>";

?>
<h2>Search Customer</h2>

<form action = "select_customer.php" target = "_self" method = "GET">
    Customer id:<br>
    <input type ="text" name="id" value = "<?php if(!empty($_GET["id"])) echo $_GET["id"]; ?>">
     <br>
  First name:<br>
  <input type="text" name="first_name" value = "<?php if(!empty($_GET["first_name"])) echo $_GET["first_name"]; ?>">
  <br>
    Last name:<br>
    <input type ="text" name="last_name" value = "<?php if(!empty($_GET["last_name"])) echo $_GET["last_name"]; ?>">
     <br>
      Store:<br>
  <?php
    $consql = "SELECT * from store";
	$conresult = $conn->query($consql);
	echo '<select name="store_id">';
	echo '<option value=""> --Not Selected-- </option>';
	while($conrow = $conresult->fetch_assoc()) {
		if($conrow["store_id"] == $_GET["store_id"]) echo '<option value="' . $conrow["store_id"] . '" selected="selected" >' . $conrow["store_id"] . '</option>';
		else echo '<option value="' . $conrow["store_id"] . '">' . $conrow["store_id"] . '</option>';	}
	echo "</select><br><br>";
    ?>
  Address:<br>
  <?php
    $consql = "SELECT * from address";
	$conresult = $conn->query($consql);
	echo '<select name="address_id">';
	echo '<option value=""> --Not Selected-- </option>';
	while($conrow = $conresult->fetch_assoc()) {
		if($conrow["address_id"] == $_GET["address_id"]) echo '<option value="' . $conrow["address_id"] . '" selected="selected" >' . $conrow["address"] . '</option>';
		else echo '<option value="' . $conrow["address_id"] . '">' . $conrow["address"] . '</option>';	}
	echo "</select><br><br>";
    ?>
<input type ="submit" value = "Submit">
</form>

<input type="button" value="Insert new data" onclick="redirect()"><br><br>
    
<a href="../index.html"><input type="button" value="Homepage"></a><br><br>

<script>
    function redirect(){
        window.location.href="../insert/insert_customer.php";
    }
</script>


<?php
    if (empty($_GET["id"]) && empty($_GET["first_name"]) && empty($_GET["last_name"]) && empty($_GET["store_id"]) && empty($_GET["country_id"]) && empty($_GET["address_id"])){
        $sql = "SELECT * FROM customer LEFT OUTER JOIN address ON (customer.address_id = address.address_id) LEFT OUTER JOIN store ON (customer.store_id = store.store_id) ORDER BY customer.customer_id ASC";
    }else
	{

	$sql = "SELECT customer.*, address.address, store.store_id FROM customer LEFT OUTER JOIN address ON (customer.address_id=address.address_id)  LEFT OUTER JOIN store ON (customer.store_id=store.store_id) WHERE customer_id = '";
	if(!empty($_GET["id"])){
		$sql = $sql . $_GET["id"]; 
	}
	$sql = $sql . "' OR `first_name` LIKE '";
	if(!empty($_GET["first_name"])){
		$sql = $sql . "%" . $_GET["first_name"] . "%";
	}
	$sql = $sql . "' OR `last_name` LIKE '";
	if(!empty($_GET["last_name"])){
		$sql = $sql . "%" . $_GET["last_name"] . "%";
	}
	$sql = $sql . "' OR store.store_id = '";
	if(!empty($_GET["store_id"])){
		$sql = $sql .  $_GET["store_id"];
	}	
	$sql = $sql . "' OR address.address_id = '";
	if(!empty($_GET["address_id"])){
		$sql = $sql .  $_GET["address_id"];
	}	
	$sql = $sql . "' ORDER BY customer.customer_id ASC ";
	}

	echo $sql;
	//echo "Showing results for ID" . $_GET["id"] . " title " . $_GET["first_name"]; 
	echo "<br>";
	$result = $conn->query($sql);
	echo "<table border=1>";
	
	if ($result->num_rows > 0) {
		echo "<tr><th>Customer ID</th><th>Store ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Create Date</th><th>Address</th><th>Active?</th><th>Update</th><th>Delete</th></tr>";
			
		while($row = $result->fetch_assoc()) {
	
			echo "<tr> <td>" . $row["customer_id"]. "</td><td>" . $row["store_id"].  "</td><td>" . $row["first_name"].  "</td><td>" . $row["last_name"].  "</td><td>" . $row["email"].  "</td><td>" . $row["create_date"]. "</td><td>" . $row["address"].  "</td><td>"; 
			if ($row["active"] == 1) {
                echo "Yes";
			}
			else 
			{
			    echo "No";
			    
			}
			echo "</td><td>" ;
			echo '<a target="_blank" href=update_customer.php?customer_id=' . $row["customer_id"] . ">Update this customer</a>"."</td><td>";
			echo '<a target="_blank" href=../delete/delete_customer.php?customerid=' . $row["customer_id"] . ">Delete this customer</a>"."</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	else {
		echo "0 results";
	}
	$conn->close();
?>

