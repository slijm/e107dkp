<?php
if(!defined("e107_INIT")) {
	require_once("../../class2.php");
}
require_once(HEADERF);
require_once(e_PLUGIN."e107dkp/includes/config.php");
global $pref;

$item = $_GET['i'];
$userID = USERID;

if (!$_GET['i']) {
	header("Location: /index.php");
}

if ($pref['wcm_version']) {
	require_once(e_PLUGIN."wcm/includes/config.php");
	$charID = WCMgetCharInfoByName($character,"char_id");
	if ((WCMCheckChar($userID,$charID)) || (WCMCheckCharAdmin())) {
		$sql99 = new db;
		$sql99->db_Select(DKPDB_TABLE_ITEMS,"item_name", "item_id='".$item."'");
		while ($row99 = $sql99->db_Fetch()) {
			$item_name = $row99["item_name"];
		}
		if (empty($item_name)) {
			$text .= "No item data could be located with the name provided: $item_name<br>";
		}
		else {
		
			$text .= '
<table width="100%" border="0" cellspacing="1" cellpadding="2">
  <tr class="rowhead">
    <th align="center" colspan="4"><u>Purchase History for '.$item_name.'</u></th>
  </tr>
  
  <tr>
    <th align="left" width="90" nowrap="nowrap">Date</th>
    <th align="left" width="35%">Buyer</th>

    <th align="left" width="65%" class="header">Raid</th>
    <th align="left" width="60" nowrap="nowrap">Value</th>
  </tr>';
		
			$query = 'SELECT i.item_id, i.item_name, i.item_value, i.item_date, i.raid_id, i.item_buyer, r.raid_name
					  FROM '.MPREFIX.DKPDB_TABLE_ITEMS.' i, '.MPREFIX.DKPDB_TABLE_RAIDS." r
					  WHERE (r.raid_id = i.raid_id) AND (i.item_name='".addslashes($item_name)."')";
			$query2 = 'SELECT count(*)
 					   FROM '.MPREFIX.DKPDB_TABLE_ITEMS.' i, '.MPREFIX.DKPDB_TABLE_RAIDS." r
 					   WHERE (r.raid_id = i.raid_id) AND (i.item_name='".addslashes($item_name)."')";
			$sql99->db_Select_gen($query2);
			while ($row99 = $sql99->db_Fetch()) {
				$item_count = $row99['count(*)'];
			}	
			$sql99->db_Select_gen($query);
			while ($row99 = $sql99->db_Fetch()) {
				$item_buyer = $row99["item_buyer"];
				$raid_id = $row99["raid_id"];
				$raid_name = $row99["raid_name"];
				$item_date = $row99["item_date"];
				$item_value = $row99["item_value"];
				$text .= '
  <tr class="row1">
    <td width="90" nowrap="nowrap">'.strftime($pref['shortdate'], $item_date).'</td>
    <td width="35%"><a href="view_member.php?n='.utf8_encode($item_buyer).'">'.utf8_encode($item_buyer).'</a></td>';
				if (WCMCheckCharAdmin()) {
					$text .= '
    <td width="65%"><a href="view_raid.php?r='.$raid_id.'">'.stripslashes($raid_name).'</a></td>';
				}
				else {
					$text .= '
    <td width="65%">'.stripslashes($raid_name).'</td>';				
				}
				$text .= '
    <td width="60" nowrap="nowrap" class="negative">'.$item_value.'</td>
  </tr>';	
			}
			$text .= '
  <tr>
    <th colspan="4" class="footer">... found '.$item_count.' item(s)</th>

  </tr>
</table>';		
		}
	}
	else {
		$text .= 'You do not have the correct permissions to view this item data<br>';
	}
}
else {
	$text .= 'You do not appear to have WOW Character Manager installed<br>';
}

// Render the value of $text in a table.
$title = "<b>e107dkp - ITEM DETAIL</b>";
$ns -> tablerender($title, $text);
require_once(FOOTERF);
?>