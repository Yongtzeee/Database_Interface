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
<form method="get" action="insert_language.php">
	Language Name: <input type="text" name="name"> <span style="color:red">*</span> <br/>
	<input type="submit"><br><br>
</form>

<input type="button" value="Go back" onclick="redirect()"><br>
    
<script>
    function redirect(){
        window.location.href="../select/select_language.php";
    }
</script>


<?php

require "../db.php";

$validate = 0;

$sql = "INSERT INTO `language` (`name`, `last_update`) VALUES (";

if(!empty($_GET["name"])){
	$sql = $sql . "\"" . $_GET["name"] . "\"" . ", ";
	$validate++;
}
// add last_update
$sql = $sql . "CURRENT_TIMESTAMP)";

if($validate < 1){
    echo '<p style="color:red; font-weight:bold">Please enter all the required fields.</p>';
}
else{
    echo '<p style="color:green; font-weight:bold">Table updated. Press "Go back" to return to main page.</p>';
}

echo $sql;

$conn->query($sql);

?>

</body>
</html>
