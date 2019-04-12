<?php
	require "../db.php";

	//echo "Connected successfully <br> <br>";

?>

<form action="select_film.php" target="_self" method="GET">
  id:<br>
  <input type="text" name="id" value = "<?php if(!empty($_GET["id"])) echo $_GET["id"]; ?>">
  <br>
  title:<br>
  <input type="text" name="title" value = "<?php if(!empty($_GET["title"])) echo $_GET["title"]; ?>">
  <br>
  year:<br>
  <input type="text" name="year" value = "<?php if(!empty($_GET["year"])) echo $_GET["year"]; ?>">
  <br>
  category:<br>
<?php

	$catsql = "SELECT * from category";
	$catresult = $conn->query($catsql);
	echo '<select name="category_id">';
	echo '<option value=""> --Not Selected-- </option>';
	while($catrow = $catresult->fetch_assoc()) {
		if($catrow["category_id"] == $_GET["category_id"]) echo '<option value="' . $catrow["category_id"] . '" selected="selected" >' . $catrow["name"] . '</option>';
		else echo '<option value="' . $catrow["category_id"] . '">' . $catrow["name"] . '</option>';	}
	echo "</select><br><br>";
?>
  <input type="submit" value="Submit">
</form>

<input type="button" value="Insert new data" onclick="redirect()"><br><br>
    
<a href="../index.html"><input type="button" value="Homepage"></a><br><br>

<script>
    function redirect(){
        window.location.href="../insert/insert_film.php";
    }
</script>


<?php
	if (empty($_GET["id"]) && empty($_GET["title"]) && empty($_GET["release_year"]) && empty($_GET["category_id"])){
	$sql = "SELECT b.*,a.name,d.name 'catname' FROM film AS b JOIN language as a ON (b.language_id=a.language_id) JOIN film_category as c ON (b.film_id = c.film_ID) JOIN category as d ON (c.category_id = d.category_id) ORDER BY `b`.`film_id` ASC";
	}else{
	$sql = "SELECT b.*,a.name,d.name 'catname' FROM film AS b JOIN language as a ON (b.language_id=a.language_id) JOIN film_category as c ON (b.film_id = c.film_ID) JOIN category as d ON (c.category_id = d.category_id) WHERE `b`.`film_id` = '";
	if(!empty($_GET["id"])){
		$sql = $sql . $_GET["id"]; 
	}
	$sql = $sql . "' OR `title` LIKE '";
	if(!empty($_GET["title"])){
		$sql = $sql . "%" . $_GET["title"] . "%";
	}
	$sql = $sql . "' OR `release_year` = '";
	if(!empty($_GET["year"])){
		$sql = $sql .  $_GET["year"];
	}	
	$sql = $sql . "' OR d.category_id = '";
	if(!empty($_GET["category_id"])){
		$sql = $sql .  $_GET["category_id"];
	}	
	
	$sql = $sql . "' ORDER BY 'film_id' ASC ";
    }
	echo $sql;
	//echo "Showing results for ID" . $_GET["id"] . " title " . $_GET["title"]; 
	echo "<br>";
	$result = $conn->query($sql);
	echo "<table border=1>";
	
	if ($result->num_rows > 0) {
		echo "<tr><th>Film ID</th><th>Title</th><th>Description</th><th>Release Year</th><th>Language</th><th>Rating</th><th>Category</th><th>More</th><th>Delete</th></tr>";
			
		while($row = $result->fetch_assoc()) {
	
			echo "<tr> <td>" . $row["film_id"]. "</td><td>" . $row["title"].  "</td><td>" . $row["description"] ."</td><td>" . $row["release_year"] . "</td><td>";
			echo $row["name"] . "</td><td>";
			echo $row["rating"]. "</td><td>";
			echo $row["catname"] ."</td><td>";
			echo '<a target="_blank" href=info_film.php?id=' . $row["film_id"] . ">More Info</a>"."</td><td>";
			echo '<a target="_blank" href=../delete/delete_film.php?filmid=' . $row["film_id"] . ">Delete this Film</a>"."</td>";

			echo "</tr>";
		}
		echo "</table>";
	}
	else {
		echo "0 results";
	}
	$conn->close();
?>