<?php
    require "../db.php";
?>
<h2>Search inventory</h2>
<form action = "select_inventory.php" method = "get">
    Inventory ID:<br>
    <input type = "text" name = "id" value =  "<?php if (!empty($_GET["id"])) echo $_GET["id"];?>">
    <br>
    Film Title:<br>
    <input type = "text" name = "title" value = "<?php if (!empty($_GET["title"])) echo $_GET["title"];?>">
    <br>
    Store ID:<br>
    <input type = "text" name = "store_id" value = "<?php if (!empty($_GET["store_id"])) echo $_GET["store_id"];?>">
    <br><br>
    <input type = "submit" value = "Submit">
</form>

<input type="button" value="Insert new data" onclick="redirect()"><br><br>
    
<a href="../index.html"><input type="button" value="Homepage"></a><br><br>

<script>
    function redirect(){
        window.location.href="../insert/insert_inventory.php";
    }
</script>


<?php
    if (empty($_GET["id"]) && empty($_GET["title"]) && empty($_GET["store_id"])){
        $sql = "SELECT * FROM inventory LEFT OUTER JOIN film_text ON (inventory.film_id = film_text.film_id) ORDER BY inventory.inventory_id ASC";
    }else{
        $sql = "SELECT * FROM inventory LEFT OUTER JOIN film_text ON (inventory.film_id = film_text.film_id) WHERE inventory_id = '";
        if (!empty($_GET["id"])){
            $sql = $sql . $_GET["id"];
        }
        if (!empty($_GET["title"])){
            $sql = $sql . "' OR `title` LIKE '";
	    	$sql = $sql . "%" . $_GET["title"] . "%";
        }
        if (!empty($_GET["store_id"])){
            $sql = $sql . "' OR `store_id` = '";
	    	$sql = $sql . $_GET["store_id"];
        }
        $sql = $sql . "' ORDER BY inventory.inventory_id ASC ";
    }
    echo $sql;
	echo "<br>";

	$result = $conn->query($sql);
	echo "<table border=1>";
	if ($result->num_rows > 0) {
		echo "<tr><th>Inventory ID</th><th>Film Title</th><th>Store ID</th><th>Update</th><th>Delete</th></tr>";
		while($row = $result->fetch_assoc()) {
			echo "<tr> <td>" . $row["inventory_id"]. "</td><td>" . $row["title"].  "</td><td>" . $row["store_id"] ."</td><td>";
			echo '<a target="_self" href=update_inventory.php?inventory_id=' . $row["inventory_id"] . ">Update this Inventory</a></td><td>";
			echo '<a target="_self" href=../delete/delete_inventory.php?inventoryid=' . $row["inventory_id"] . ">Delete this Inventory</a>"."</td>";
			echo "</tr>";
		
		}
		echo "</table>";
	}
	else {
		echo "0 results";
	}
	


	$conn->close();
?>