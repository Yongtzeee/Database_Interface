<?php
	require "../db.php";
?>
<h2>Search Language</h2>
<input type="button" value="Insert new data" onclick="redirect()"><br><br>
    
<a href="../index.html"><input type="button" value="Homepage"></a><br><br>

<script>
    function redirect(){
        window.location.href="../insert/insert_language.php";
    }
</script>


<?php
	$sql = "SELECT * FROM language";
	$result=$conn->query($sql);
	echo "<br>";
	$result = $conn->query($sql);
	echo "<table border=1>";
	if ($result->num_rows > 0) {
		echo "<tr><th>ID</th><th>Name</th><th>Update</th><th>Delete</th></tr>";
		while($row = $result->fetch_assoc()) {
			echo "<tr> <td>" . $row["language_id"]. "</td><td>" . $row["name"].  "</td><td>";
			echo '<a target="_self" href=update_language.php?language_id=' . $row["language_id"] . ">Update this Language</a>"."</td><td>";
			echo '<a target="_self" href=../delete/delete_language.php?languageid=' . $row["language_id"] . ">Delete this Language</a>"."</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	else {
		echo "0 results";
	}
	$conn->close();
?>