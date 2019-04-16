<?php
	require "../db.php";

	//echo "Connected successfully <br> <br>";

?>
<h2>Search Rental</h2>

<form action = "select_rental.php" target = "_self" method = "GET">
    Rental id:<br>
    <input type ="text" name="id" value = "<?php if(!empty($_GET["id"])) echo $_GET["id"]; ?>">
     <br>
  Rental date:<br>
  <input type="text" name="rental_date" value = "<?php if(!empty($_GET["rental_date"])) echo $_GET["rental_date"]; ?>">
  <br>
    Return date:<br>
    <input type ="text" name="return_date" value = "<?php if(!empty($_GET["return_date"])) echo $_GET["rental_date"]; ?>">
     <br><br>
      Film:<br>
  <?php
    $filsql = "SELECT * from film";
	$filresult = $conn->query($filsql);
	echo '<select name="film_id">';
	echo '<option value=""> --Not Selected-- </option>';
	while($filrow = $filresult->fetch_assoc()) {
		if($filrow["film_id"] == $_GET["film_id"]) echo '<option value="' . $filrow["film_id"] . '" selected="selected" >' . $filrow["title"] . '</option>';
		else echo '<option value="' . $filrow["film_id"] . '">' . $filrow["title"] . '</option>';	}
	echo "</select><br><br>";
    ?>
  Customer:<br>
  <?php
    $cussql = "SELECT * from customer";
	$cusresult = $conn->query($cussql);
	echo '<select name="customer_id">';
	echo '<option value=""> --Not Selected-- </option>';
	while($cusrow = $cusresult->fetch_assoc()) {
		if($cusrow["customer_id"] == $_GET["customer_id"]) echo '<option value="' . $cusrow["customer_id"] . '" selected="selected" >' . $cusrow["first_name"] . ' ' . $cusrow["last_name"] . '</option>';
		else echo '<option value="' . $cusrow["customer_id"] . '">' . $cusrow["first_name"] . ' ' . $cusrow["last_name"] .  '</option>';	}
	echo "</select><br><br>";
    ?>
    Staff:<br>
  <?php
    $stasql = "SELECT * from staff";
	$staresult = $conn->query($stasql);
	echo '<select name="staff_id">';
	echo '<option value=""> --Not Selected-- </option>';
	while($starow = $staresult->fetch_assoc()) {
		if($starow["staff_id"] == $_GET["staff_id"]) echo '<option value="' . $starow["staff_id"] . '" selected="selected" >' . $starow["first_name"] . '</option>';
		else echo '<option value="' . $starow["staff_id"] . '">' . $starow["first_name"] . '</option>';	}
	echo "</select><br><br>";
    ?>
<input type ="submit" value = "Submit">
</form>

<input type="button" value="Insert new data" onclick="redirect()"><br><br>
    
<a href="../index.html"><input type="button" value="Homepage"></a><br><br>

<script>
    function redirect(){
        window.location.href="../insert/insert_rental.php";
    }
</script>


<?php

	$sql = "SELECT rental.rental_id,film.title,rental.rental_date,rental.return_date, customer.first_name, customer.last_name , staff.first_name as 'staff_first_name' FROM rental LEFT OUTER JOIN inventory ON (rental.inventory_id=inventory.inventory_id) LEFT OUTER JOIN film ON (film.film_id = inventory.film_id) LEFT OUTER JOIN customer ON (rental.customer_id=customer.customer_id) LEFT OUTER JOIN staff ON (rental.staff_id=staff.staff_id) WHERE rental.rental_id = '";
	if(!empty($_GET["id"])){
		$sql = $sql . $_GET["id"]; 
	}
	$sql = $sql . "' OR rental.customer_id = '";
	if(!empty($_GET["customer_id"])){
		$sql = $sql . $_GET["customer_id"];
	}
	$sql = $sql . "' OR rental.rental_date LIKE '";
	if(!empty($_GET["rental_date"])){
		$sql = $sql . "%" .  $_GET["rental_date"] . "%";
	}
	$sql = $sql . "' OR rental.return_date LIKE '";
	if(!empty($_GET["return_date"])){
		$sql = $sql . "%" .  $_GET["return_date"] . "%";
	}
	$sql = $sql . "' OR rental.inventory_id = '";
	if(!empty($_GET["inventory_id"])){
		$sql = $sql .  $_GET["inventory_id"];
	}
	$sql = $sql . "' OR rental.inventory_id = '";
	if(!empty($_GET["inventory_id"])){
		$sql = $sql .  $_GET["inventory_id"];
	}	
	$sql = $sql . "' OR rental.staff_id = '";
	if(!empty($_GET["staff_id"])){
		$sql = $sql .  $_GET["staff_id"];
	}	
	$sql = $sql . "' OR inventory.film_id = '";
	if(!empty($_GET["film_id"])){
		$sql = $sql .  $_GET["film_id"];
	}
	$sql = $sql . "' ORDER BY rental.rental_id ASC ";
	

	echo $sql;
	//echo "Showing results for ID" . $_GET["id"] . " title " . $_GET["rental_date"]; 
	echo "<br>";
	$result = $conn->query($sql);
	echo "<table border=1>";
	
	if ($result->num_rows > 0) {
		echo "<th>Rental ID</th><th>Rented By</th><th>Rental date</th><th>Return date</th><th>Title</th><th>Staff</th><th>Update</th><th>Delete</th>";
			
		while($row = $result->fetch_assoc()) {
	
			echo "<tr> <td>" . $row["rental_id"]. "</td><td>" . $row["first_name"] . ' ' . $row["last_name"].  "</td><td>" . $row["rental_date"].  "</td><td>" . $row["return_date"].  "</td><td>" . $row["title"].  "</td><td>" . $row["staff_first_name"].  "</td><td>" ;
			echo '<a target="_blank" href=update_rental.php?rental_id=' . $row["rental_id"] . ">Update this rental</a>"."</td><td>";
			echo '<a target="_blank" href=../delete/delete_rental.php?rentalid=' . $row["rental_id"] . ">Delete this rental</a>"."</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	else {
		echo "0 results";
	}
	$conn->close();
?>