<?php
Database::delete($_GET['id']);

header("Location: ".e_SELF);
?>
