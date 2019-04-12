<?php
	require "../db.php";
	
?>
    <h2>Search Address</h2>
    <form action = "select_address.php" method = "get">
        Address ID: <br>
        <input type = "text" name = "id" value = "<?php if (!empty($_GET["id"])) echo $_GET["id"];?>">
        <br>
        Address: <br>
         <input type = "text" name = "address" value = "<?php if (!empty($_GET["address"])) echo $_GET["address"];?>">
         <br>
        District: <br>
         <input type = "text" name = "district" value = "<?php if (!empty($_GET["district"])) echo $_GET["district"];?>">
         <br>
        City Name: <br>
         <input type = "text" name = "city" value = "<?php if (!empty($_GET["city"])) echo $_GET["city"];?>">
         <br>
        Postal Code: <br>
         <input type = "text" name = "postal" value = "<?php if (!empty($_GET["postal"])) echo $_GET["postal"];?>">
         <br>
         <input type ="submit" value = "Submit"><br>
    </form>

    <input type="button" value="Insert new data" onclick="redirect()"><br><br>
    
    <a href="../index.html"><input type="button" value="Homepage"></a><br><br>
    
    <script>
        function redirect(){
            window.location.href="../insert/insert_address.php";
        }
    </script>

<?php
	if (empty($_GET["id"]) && empty($_GET["address"]) && empty($_GET["district"]) && empty($_GET["city"]) && empty($_GET["postal"])){
	    $sql = "SELECT * FROM address JOIN city ON (address.city_id = city.city_id) ORDER BY address.address_id ASC";
	}else{
	$sql = "SELECT * FROM address JOIN city ON (address.city_id = city.city_id) WHERE address_id = '";
	if(!empty($_GET["id"])){
		$sql = $sql . $_GET["id"]; 
	}
	if(!empty($_GET["address"])){
	    $sql = $sql . "' OR `address` LIKE '";
		$sql = $sql . "%" . $_GET["address"] . "%";
	}
	if(!empty($_GET["district"])){
	    $sql = $sql . "' OR `district` LIKE '";
		$sql = $sql . "%" . $_GET["district"] . "%";
	}
	if(!empty($_GET["city"])){
	    $sql = $sql . "' OR `city` LIKE '";
		$sql = $sql . "%" . $_GET["city"] . "%";
	}
	if(!empty($_GET["postal"])){
	    $sql = $sql . "' OR `postal_code` = '";
		$sql = $sql . $_GET["postal"] ;
	}
	$sql = $sql . "' ORDER BY address.address_id ASC ";
	}
	echo $sql;
	$result=$conn->query($sql);
	echo "<br>";
	$result = $conn->query($sql);
	echo "<table border=1>";
	if ($result->num_rows > 0) {
		echo "<tr><th>address id</th><th>address</th><th>address2</th><th>district</th><th>city name</th><th>postal code</th><th>phone</th><th>Update</th><th>Delete</th></tr>";
		while($row = $result->fetch_assoc()) {
			echo "<tr> <td>" . $row["address_id"]. "</td><td>" . $row["address"].  "</td><td>" . $row["address2"] ."</td><td>". $row["district"] ."</td><td>". $row["city"] ."</td><td>". $row["postal_code"] ."</td><td>". $row["phone"] ."</td><td>";
			echo '<a target="_self" href=update_address.php?address_id=' . $row["address_id"] . ">Update this Address</a></td><td>";
			echo '<a target="_self" href=../delete/delete_address.php?addressid=' . $row["address_id"] . ">Delete this Address</a>"."</td>";
			echo "</tr>";
		
		}
		echo "</table>";
	}
	else {
		echo "0 results";
	}
	


	$conn->close();
?>
