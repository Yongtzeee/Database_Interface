<?php
	require "../db.php";
	
?>
    <h2>Search Country</h2>
    <form action = "select_country.php" method = "get">
        Country ID:<br>
        <input type = "text" name = "id" value = "<?php if (!empty($_GET["id"])) echo $_GET["id"];?>">
        <br>
        Country Name:<br>
        <input type = "text" name = "name" value = "<?php if (!empty($_GET["name"])) echo $_GET["name"];?>">
        <br>
        <input type ="submit" value = "Submit">
    </form>

<input type="button" value="Insert new data" onclick="redirect()"><br><br>
    
<a href="../index.html"><input type="button" value="Homepage"></a><br><br>

<script>
    function redirect(){
        window.location.href="../insert/insert_country.php";
    }
</script>


<?php
    if (empty($_GET["id"]) && empty($_GET["name"])){
	   $sql = "SELECT * FROM country";
}
else{
        $sql = "SELECT * FROM country WHERE country_id = '";
	if(!empty($_GET["id"])){
		$sql = $sql . $_GET["id"]; 
	}
	$sql = $sql . "' OR `country` LIKE '";
	if(!empty($_GET["name"])){
		$sql = $sql . "%" . $_GET["name"] . "%";
	}
	$sql = $sql . "' ORDER BY 'country_id' ASC ";
}
	echo $sql;
	//echo "Showing results for ID" . $_GET["id"] . " title " . $_GET["name"]; 
	echo "<br>";
	$result = $conn->query($sql);

	echo "<table border=1>";
	
	if ($result->num_rows > 0) {
		echo "<tr><th>Country ID</th><th>Country Name</th><th>Update</th><th>Delete</th></tr>";
			
		while($row = $result->fetch_assoc()) {
	
			echo "<tr> <td>" . $row["country_id"]. "</td><td>" . $row["country"].  "</td><td>" ;
			echo '<a target="_blank" href=update_country.php?country_id=' . $row["country_id"] . ">Update this country</a>"."</td><td>";
			echo '<a target="_blank" href=../delete/delete_country.php?countryid=' . $row["country_id"] . ">Delete this country</a>"."</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	else {
		echo "0 results";
	}
    
	$conn->close();
?>