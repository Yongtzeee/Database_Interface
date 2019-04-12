
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}
</style>
<body>
<p style="color:red">* required</p>
<form method="get" action="insert_actor.php">
	First Name: <input type="text" name="first_name" > <span style="color:red">*</span> <br/>
	Last Name: <input type="text" name="last_name" > <span style="color:red">*</span> <br/>
	<input type="submit"><br/><br/>
</form>

<input type="button" value="Go back" onclick="redirect()"><br>
    
<script>
    function redirect(){
        window.location.href="../select/select_actor.php";
    }
</script>

<?php

require "../db.php";

$sql = "INSERT INTO `actor` (`first_name`,`last_name`, `last_update`) VALUES (";

$validate = 0;

if(!empty($_GET["first_name"])){
	$sql = $sql . "\"" . $_GET["first_name"] . "\"" . ", ";
	$validate++;
}

if(!empty($_GET["last_name"])){
	$sql = $sql . "\"" . $_GET["last_name"] . "\"" . ", ";
	$validate++;
}

if($validate < 2){
    echo '<p style="color:red; font-weight:bold">Please enter all the required fields.</p>';
}
else{
    echo '<p style="color:green; font-weight:bold">Table updated. Press "Go back" to return to main page.</p>';
}

$sql = $sql . "CURRENT_TIMESTAMP)";

echo $sql;

$conn->query($sql);

?>

</body>
</html>
