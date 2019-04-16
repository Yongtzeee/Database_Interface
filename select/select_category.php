<?php
	require "../db.php";
?>
<h2>Searh Category</h2>
<input type="button" value="Insert new data" onclick="redirect()"><br><br>
    
<a href="../index.html"><input type="button" value="Homepage"></a><br><br>

<script>
    function redirect(){
        window.location.href="../insert/insert_category.php";
    }
</script>


<?php
	$sql = "SELECT * FROM category";
	$result=$conn->query($sql);
	echo "<br>";
	$result = $conn->query($sql);
	echo "<table border=1>";
	if ($result->num_rows > 0) {
		echo "<tr><th>ID</th><th>Name</th><th>Update</th><th>Delete</th></tr>";
		while($row = $result->fetch_assoc()) {
			echo "<tr> <td>" . $row["category_id"]. "</td><td>" . $row["name"].  "</td><td>";
			echo '<a target="_self" href=update_category.php?category_id=' . $row["category_id"] . ">Update this Category</a>"."</td><td>";
			echo '<a target="_self" href=../delete/delete_category.php?categoryid=' . $row["category_id"] . ">Delete this Category</a>"."</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	else {
		echo "0 results";
	}
	$conn->close();
?>