<?php
if (isset($_POST['name']) && $_POST['name'] != "")
{
	$database = new Database($_POST['name']);
	$database->save();
}
header("Location: ".e_SELF); 
?>
