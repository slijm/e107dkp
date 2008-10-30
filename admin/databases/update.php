<?php
if (isset($_POST['name']) && $_POST['name'] != '')
{
	$database = Database::fetchById($_POST['id']);
	$database->setName($_POST['name']);
	$database->save();
}
header("Location: ".e_SELF);
?>
