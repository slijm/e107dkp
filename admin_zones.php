<?php
require_once("../../class2.php");

if(!getperms("P")){ header("location:".e_BASE."index.php"); }
require_once(e_ADMIN."auth.php");
require_once(e_PLUGIN."e107dkp/includes/models/Zone.php");

if (isset($_GET['action']) && $_GET['action'] != '')
	$action = $_GET['action'];
else
	$action = "index";

require_once(e_PLUGIN."e107dkp/admin/zones/$action.php");

require_once(e_ADMIN."footer.php");
?>