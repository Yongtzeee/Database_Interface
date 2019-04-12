<?php
	require "../db.php";
	
	?>
	<h2>Search Actor</h2>

    <form action = "select_actor.php" method = "get">
    Actor ID:<br>
    <input type = "text" name = "id" value = "<?php if (!empty($_GET["id"])) echo $_GET["id"];?>">
    <br>
    First Name: <br>
    <input type = "text" name = "fname" value = "<?php if (!empty($_GET["fname"])) echo $_GET["fname"];?>">
    <br>
    Last Name: <br>
    <input type = "text" name = "lname" value = "<?php if (!empty($_GET["lname"])) echo $_GET["lname"];?>">
    <br>
    <br>
    <input type = "submit" value = "Submit">
    </form>
    
    <input type="button" value="Insert new data" onclick="redirect()"><br><br>
    
    <script>
        function redirect(){
            window.location.href="../insert/insert_actor.php";
        }
    </script>
    
    <a href="../index.html"><input type="button" value="Homepage"></a><br><br>
    
	
<?php
	if (empty($_GET["id"]) && empty($_GET["fname"]) && empty($_GET["lname"])){
	$sql = "SELECT * FROM actor";
	}else {
	$sql = "SELECT * FROM actor WHERE actor_id = '";
	if(!empty($_GET["id"])){
		$sql = $sql . $_GET["id"]; 
	}
	$sql = $sql . "' OR `first_name` LIKE '";
	if(!empty($_GET["fname"])){
		$sql = $sql . "%" . $_GET["fname"] . "%";
	}
	$sql = $sql . "' OR `last_name` LIKE '";
	if(!empty($_GET["lname"])){
		$sql = $sql .  "%" .$_GET["lname"]. "%";
	}	
	$sql = $sql . "' ORDER BY 'actor_id' ASC ";
	}
	echo $sql;
	//echo "Showing results for ID" . $_GET["id"] . " title " . $_GET["name"]; 
	echo "<br>";
	$result = $conn->query($sql);
	echo "<table border=1>";
	
	if ($result->num_rows > 0) {
		echo "<tr><th>Actor ID</th><th>First Name</th><th>Last Name</th><th>Update</th><th>Delete</th></tr>";
			
		while($row = $result->fetch_assoc()) {
	
			echo "<tr> <td>" . $row["actor_id"]. "</td><td>" . $row["first_name"].  "</td><td>" . $row["last_name"].  "</td><td>" ;
			echo '<a target="_blank" href=update_actor.php?actor_id=' . $row["actor_id"] . ">Update this actor</a>"."</td><td>";
			echo '<a target="_blank" href=../delete/delete_actor.php?actorid=' . $row["actor_id"] . ">Delete this actor</a>"."</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	else {
		echo "0 results";
	}
	$conn->close();
?>