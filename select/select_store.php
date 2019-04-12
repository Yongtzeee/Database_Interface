<?php
	require "../db.php";
?>

<input type="button" value="Insert new data" onclick="redirect()"><br><br>
    
<a href="../index.html"><input type="button" value="Homepage"></a><br><br>

<script>
    function redirect(){
        window.location.href="../insert/insert_store.php";
    }
</script>


<?php
	$sql = "SELECT *,first_name,last_name,address FROM store JOIN staff ON (staff.staff_id = store.manager_staff_id) JOIN address on (address.address_id = store.address_id)";
	$result=$conn->query($sql);
	echo "<br>";
	$result = $conn->query($sql);
	echo "<table border=1>";
	if ($result->num_rows > 0) {
		echo "<tr><th>ID</th><th>Manager</th><th>Address</th><th>Update</th><th>Delete</th>";
		while($row = $result->fetch_assoc()) {
			echo "<tr> <td>" . $row["store_id"]. "</td><td>" . $row["last_name"]. " " . $row["last_name"]. "</td><td>" . $row["address"]  .  "</td><td>";
			echo '<a target="_self" href=update_store.php?store_id=' . $row["store_id"] . ">Update this Store</a>"."</td><td>";
			echo '<a target="_self" href=../delete/delete_store.php?storeid=' . $row["store_id"] . ">Delete this Store</a>"."</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	else {
		echo "0 results";
	}
	$conn->close();
?>