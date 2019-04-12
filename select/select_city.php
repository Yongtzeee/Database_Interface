<?php
	require "../db.php";

	//echo "Connected successfully <br> <br>";

?>
<h2>Search City</h2>

<form action = "select_city.php" target = "_self" method = "GET">
    City id:<br>
    <input type ="text" name="id" value = "<?php if(!empty($_GET["id"])) echo $_GET["id"]; ?>">
     <br>
  City name:<br>
  <input type="text" name="name" value = "<?php if(!empty($_GET["name"])) echo $_GET["name"]; ?>">
  <br>
  Country:<br>
  <?php
    $consql = "SELECT * from country";
	$conresult = $conn->query($consql);
	echo '<select name="country_id">';
	echo '<option value=""> --Not Selected-- </option>';
	while($conrow = $conresult->fetch_assoc()) {
		if($conrow["country_id"] == $_GET["country_id"]) echo '<option value="' . $conrow["country_id"] . '" selected="selected" >' . $conrow["country"] . '</option>';
		else echo '<option value="' . $conrow["country_id"] . '">' . $conrow["country"] . '</option>';	}
	echo "</select><br><br>";
    ?>
<input type ="submit" value = "Submit">
</form>

<input type="button" value="Insert new data" onclick="redirect()"><br><br>
    
<a href="../index.html"><input type="button" value="Homepage"></a><br><br>

<script>
    function redirect(){
        window.location.href="../insert/insert_city.php";
    }
</script>


<?php
    if (empty($_GET["id"]) && empty($_GET["name"]) && empty($_GET["country_id"])){
        $sql = "SELECT * FROM city JOIN country ON (city.country_id = country.country_id) ORDER BY city.city_id ASC";
    }else
	{

	$sql = "SELECT city.city_id, city.city, country.country FROM city JOIN country ON (city.country_id=country.country_id) WHERE city_id = '";
	if(!empty($_GET["id"])){
		$sql = $sql . $_GET["id"]; 
	}
	$sql = $sql . "' OR `city` LIKE '";
	if(!empty($_GET["name"])){
		$sql = $sql . "%" . $_GET["name"] . "%";
	}
	$sql = $sql . "' OR country.country_id = '";
	if(!empty($_GET["country_id"])){
		$sql = $sql .  $_GET["country_id"];
	}	
	$sql = $sql . "' ORDER BY city.city_id ASC ";
	}

	echo $sql;
	//echo "Showing results for ID" . $_GET["id"] . " title " . $_GET["name"]; 
	echo "<br>";
	$result = $conn->query($sql);
	echo "<table border=1>";
	
	if ($result->num_rows > 0) {
		echo "<tr><th>City ID</th><th>City Name</th><th>Country Name</th><th>Update</th><th>Delete</th></tr>";
			
		while($row = $result->fetch_assoc()) {
	
			echo "<tr> <td>" . $row["city_id"]. "</td><td>" . $row["city"].  "</td><td>" . $row["country"].  "</td><td>" ;
			echo '<a target="_blank" href=update_city.php?city_id=' . $row["city_id"] . ">Update this city</a>"."</td><td>";
			echo '<a target="_blank" href=../delete/delete_city.php?cityid=' . $row["city_id"] . ' onclick="location.reload();">Delete this city</a>'."</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	else {
		echo "0 results";
	}
	$conn->close();
?>


