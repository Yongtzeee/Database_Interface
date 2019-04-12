<?php
	require "../db.php";
?>

<input type="button" value="Insert new data" onclick="redirect()"><br><br>
    
<a href="../index.html"><input type="button" value="Homepage"></a><br><br>

<script>
    function redirect(){
        window.location.href="../insert/insert_staff.php";
    }
</script>


<?php
	$sql = "SELECT * FROM staff";
	$result=$conn->query($sql);
	echo "<br>";
	$result = $conn->query($sql);
	echo "<table style=\"width:100%\" border=1>";
	if ($result->num_rows > 0) {
		echo "<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Picture</th><th>Update</th><th>Delete</th>";
		while($row = $result->fetch_assoc()) {
			if($row["picture"] != ""){
				echo "<tr> <td>" . $row["staff_id"]. "</td><td>" . $row["first_name"] .  "</td><td>" . $row["last_name"] . "</td><td>" . '<image height="121" width="121" src="data:image/png;base64,'. base64_encode(pack("H*",$row["picture"])).'"/>' . "</td><td>";
			}
			else{
				echo "<tr> <td>" . $row["staff_id"]. "</td><td>" . $row["first_name"] .  "</td><td>" . $row["last_name"] . "</td><td>" . "</td><td>";
			}
			echo '<a target="_self" href=update_staff.php?staff_id=' . $row["staff_id"] . ">Update this Staff</a>"."</td><td>";
			echo '<a target="_blank" href=../delete/delete_staff.php?staffid=' . $row["staff_id"] . ">Delete this staff</a></td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	else {
		echo "0 results";
	}
	$conn->close();
?>