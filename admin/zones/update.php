<?php
$zonename = $_POST['zonename'];
$zone = Zone::loadById($_POST['zoneid']);
$zone->setName($zonename);
$zone->save();
header("Location: ".e_SELF);
?>