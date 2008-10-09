<?php
$zonename = $_POST['zonename'];
$zone = new Zone($zonename);
$zone->save();
header("Location: ".e_SELF);
?>