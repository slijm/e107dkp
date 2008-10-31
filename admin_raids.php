<?php
require_once("../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); }
require_once(e_ADMIN."auth.php");

require_once(e_PLUGIN."e107dkp/includes/models/Database.php");
require_once(e_PLUGIN."e107dkp/includes/models/Raid.php");
require_once(e_PLUGIN."e107dkp/includes/models/Zone.php");

if (isset($_GET['action']) && $_GET['action'] != '')
	$action = $_GET['action'];
else
	$action = "index";

if (!include_once(e_PLUGIN."/e107dkp/language/".e_LANGUAGE."/admin/raids/$action.php"))
	require_once(e_PLUGIN."/e107dkp/language/English/admin/raids/$action.php");
if (!include_once(e_PLUGIN."/e107dkp/language/".e_LANGUAGE."/admin/common.php"))
	require_once(e_PLUGIN."/e107dkp/language/English/admin/common.php");

require_once(e_PLUGIN."e107dkp/admin/raids/$action.php");

require_once(e_ADMIN."footer.php");
?>
