<?php
if(!defined("e107_INIT")) {
	require_once("../../class2.php");
}
require_once(HEADERF);
require_once(e_PLUGIN."e107dkp/includes/config.php");
global $pref;

$character = utf8_decode($_GET['n']);
$userID = USERID;

if (!$_GET['n']) {
	header("Location: /index.php");
}

if ($pref['wcm_version']) {
	require_once(e_PLUGIN."wcm/includes/config.php");
	$charID = WCMgetCharInfoByName($character,"char_id");
	if ((WCMCheckChar($userID,$charID)) || (WCMCheckCharAdmin())) {
		list($thirty, $sixty, $ninty) = DKPraidCount($character);
		// give our attendence and points
		$text = '
		<table width="100%" border="0" cellspacing="1" cellpadding="2">
		  <tr>
			<th align="center"  colspan="6" nowrap="nowrap"><u>: '.utf8_encode($character).' :</u></th>
		  </tr>
		  <tr>
			<td class="row1" width="20%" nowrap="nowrap"><b>Earned</b>: <span class="positive">0.00</span></td>
		
			<td class="row2" width="20%" nowrap="nowrap"><b>Spent</b>: <span class="negative">0.00</span></td>
			<td class="row1" width="20%" nowrap="nowrap"><b>Adjustment</b>: <span class="neutral">0.00</span></td>
			<td class="row2" width="40%" nowrap="nowrap"><b>Current</b>: <span class="neutral">0.00</span></td>
		  </tr>	
		  <tr>
			<td class="row2" width="20%" nowrap="nowrap"><b>30 Days</b>: <span class="positive">'.$thirty.'%</span></td>
			<td class="row1" width="20%" nowrap="nowrap"><b>60 Days</b>: <span class="positive">'.$sixty.'%</span></td>
			<td class="row2" width="20%" nowrap="nowrap"><b>90 Days</b>: <span class="positive">'.$ninty.'%</span></td>
			<td class="row1" width="40%" nowrap="nowrap"><b>&nbsp;</td>
		  </tr>
		  </tr>
		</table><br><br>';
			
		// give our raid history
		$text .= '
		<table width="100%" border="0" cellspacing="1" cellpadding="2">
		  <tr>
			<th align="center" colspan="5"><u>Raid Attendance History</u></th>		
		  </tr>
		  <tr>
			<th align="left" width="70" nowrap="nowrap">Date</th>
			<th align="left" width="35%">Name</th>
			<th align="left" width="65%">Note</th>
			<th align="left" width="60" nowrap="nowrap">Earned</th>
			<th align="left" width="70" nowrap="nowrap">Current</th>	
		  </tr>';
			  
		$query = 'SELECT r.raid_id, r.raid_name, r.raid_date, r.raid_note, r.raid_value
				  FROM '.MPREFIX.DKPDB_TABLE_RAIDS.' r, '.MPREFIX.DKPDB_TABLE_RAID_A." ra
				  WHERE (ra.raid_id = r.raid_id)
				  AND (ra.member_name='".$character."')
				  ORDER BY r.raid_date DESC
				  LIMIT 50";
			
		/*
					'ROW_CLASS'      => $eqdkp->switch_row_class(),
					'DATE'           => ( !empty($raid['raid_date']) ) ? date($user->style['date_notime_short'], $raid['raid_date']) : '&nbsp;',
					'U_VIEW_RAID'    => 'viewraid.php'.$SID.'&amp;' . URI_RAID . '='.$raid['raid_id'],
					'NAME'           => ( !empty($raid['raid_name']) ) ? stripslashes($raid['raid_name']) : '&lt;<i>Not Found</i>&gt;',
					'NOTE'           => ( !empty($raid['raid_note']) ) ? stripslashes($raid['raid_note']) : '&nbsp;',
					'EARNED'         => $raid['raid_value'],
					'CURRENT_EARNED' => sprintf("%.2f", $current_earned))
		*/
			
		$sql99 = new db;
		$sql99->db_Select_gen($query); 
		while ($row99 = $sql99->db_Fetch()) {
			// nothing yet....
			$raid_id = $row99['raid_id'];
			$raid_name = $row99['raid_name'];
			$raid_date = $row99['raid_date'];
			$raid_note = $row99['raid_note'];
			$raid_value = $row99['raid_value'];
				
			$text .= '
		  <tr class="row2">
			<td width="70" nowrap="nowrap">'.strftime($pref['shortdate'], $raid_date).'</td>
			<td width="35%"><a href="view_raid.php?r=39">'.stripslashes($raid_name).'</a></td>
			<td width="65%">'.stripslashes($raid_note).'</td>
			<td width="60" nowrap="nowrap" class="positive">'.$raid_value.'</td>
			<td width="70" nowrap="nowrap" class="positive">'.$raid_current.'</td>
		  </tr>';		
		}
			  
		$text .= '
		</table><br><br>
		<table width="100%" border="0" cellspacing="1" cellpadding="2">
		  <tr>
			<th align="center" colspan="5"><u>Item Purchase History</u></th>
		  </tr>
		  <tr>
			<th align="left" width="70" nowrap="nowrap">Date</th>
			<th align="left" width="50%">Name</th>
			<th align="left" width="50%">Raid</th>
			<th align="left" width="60" nowrap="nowrap">Spent</th>
			<th align="left" width="70" nowrap="nowrap">Current</th>
		  </tr>
		';
			
		$query = 'SELECT i.item_id, i.item_name, i.item_value, i.item_date, i.raid_id, r.raid_name
				  FROM ( '.MPREFIX.DKPDB_TABLE_ITEMS.' i
				  LEFT JOIN '.MPREFIX.DKPDB_TABLE_RAIDS." r
				  ON r.raid_id = i.raid_id )
				  WHERE (i.item_buyer='".$character."')
				  ORDER BY i.item_date DESC
				  LIMIT 50";

		$sql99 = new db;
		$sql99->db_Select_gen($query); 
		while ($row99 = $sql99->db_Fetch()) {
			// nothing yet....
			$item_id = $row99['item_id'];
			$item_name = $row99['item_name'];
			$item_value = $row99['item_value'];
			$item_date = $row99['item_date'];
			$raid_id = $row99['raid_id'];
			$raid_name = $row99['raid_name'];
			$text .= '
		  <tr class="row1">
			<td width="70" nowrap="nowrap">'.strftime($pref['shortdate'], $item_date).'</td>
			';
			if ($pref['as_version']) {
				require_once(e_PLUGIN."armorystats/includes/config.php");
				// they have armorystats.. make it an item link!
				$text .= '
			<td width="50%"><a href="view_item.php?i='.$item_id.'">'.getItemByName(stripslashes($item_name),e_PLUGIN."e107dkp/view_item.php?i=".$item_id).'</a></td>';
			}
			else {
				$text .= '
			<td width="50%"><a href="view_item.php?i='.$item_id.'">'.stripslashes($item_name).'</a></td>';
			}
			$text .= '
			<td width="50%"><a href="view_raid.php?r=37">'.stripslashes($raid_name).'</a></td>
			<td width="60" nowrap="nowrap" class="negative">'.$item_value.'</td>
			<td width="70" nowrap="nowrap" class="negative">0.00</td>
		  </tr>';	
		}
		
		$text .= '
		</table><br><br>';
	}
	else {
		$text .= 'You do not have the correct permissions to view this character data<br>';
	}
}
else {
	$text .= 'You do not appear to have WOW Character Manager installed<br>';
}

// Render the value of $text in a table.
$title = "<b>RAID POINTS & ATTENDANCE</b>";
$ns -> tablerender($title, $text);

require_once(FOOTERF);

?>
