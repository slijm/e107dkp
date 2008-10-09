<?php
if(!defined("e107_INIT")) {
	require_once("../../class2.php");
}
require_once(HEADERF);
require_once(e_PLUGIN."e107dkp/includes/config.php");
global $pref;

$raid = $_GET['r'];
$userID = USERID;

if (!$_GET['r']) {
	header("Location: /index.php");
}

    $query = 'SELECT raid_id, raid_name, raid_date, raid_note, raid_value, raid_added_by, raid_updated_by
            FROM ' . MPREFIX . DKPDB_TABLE_RAIDS . "
            WHERE raid_id='".$raid."'";
	$sql99 = new db;
	$sql99->db_Select_gen($query);
	while ($row99 = $sql99->db_Fetch()) {
		$raid_name = stripslashes($row99['raid_name']);
		$raid_date = $row99['raid_date'];
		$raid_note = stripslashes($row99['raid_note']);
		$raid_value = $row99['raid_value'];
		$raid_added_by = $row99['raid_added_by'];
		$raid_updated_by = $row99['raid_updated_by'];
	}

	$text .= '
<table width="100%" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <th align="center" colspan="2">Members Present at '.$raid_name.' on '.strftime($pref['shortdate'], $raid_date).'</th>
  </tr>
  <tr>
    <td class="row2" width="50%"><b>Added By:</b>&nbsp;'.$raid_added_by.'</td>

    <td class="row1" width="50%"><b>Updated By:</b>'.$raid_updated_by.'</td>
  </tr>
  <tr>
    <td class="row2" width="50%"><b>Note:</b>&nbsp;'.$raid_note.'</td>
    <td class="row1" width="50%"><b>DKP Value:</b> <span class="positive">'.$raid_value.'</span></td>
  </tr>
</table>
<br />';

    // Attendees
	$text .= '
<table width="100%" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <th align="center" colspan="5">Attendees</th>
  </tr>';
    $query = 'SELECT member_name
            FROM ' . MPREFIX . DKPDB_TABLE_RAID_A . "
            WHERE raid_id='".$raid."'
            ORDER BY member_name";
    $query2 = 'SELECT count(*)
            FROM ' . MPREFIX . DKPDB_TABLE_RAID_A . "
            WHERE raid_id='".$raid."'
            ORDER BY member_name";			
			
	$sql99 = new db;
	$sql99->db_Select_gen($query2);
	while ($row99 = $sql99->db_Fetch()) {
		$attendee_count = $row99['count(*)'];
	}		
	$sql99->db_Select_gen($query); 
	$i = 0;
	while ($row99 = $sql99->db_Fetch()) {
		if ($i == "0") {
			$text .= '
  <tr>';
  		}
  		$text .= '
    <td align="left" width="20%"><a href="'.e_PLUGIN.'e107dkp/view_member.php?n='.utf8_encode($row99['member_name']).'">'.utf8_encode($row99['member_name']).'</a></td>';
		if ($i == "4") {
			$text .= '
  </tr>';
  			$i = 0;
		}
		else {
			$i++;
		}
        //$attendees[] = addslashes($row99['member_name']);
	}
	$text .= '
  <tr>
    <th colspan="3" class="footer">... found '.$attendee_count.' attendee(s)</th>
  </tr>
</table>';	

    // Get each attendee's rank
	
	// READ: THIS NEEDS TO BE REPLACED WITH INFORMATION FROM WOW GUILD MANAGER

    // Drops
	$text .= '
<table width="100%" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <th align="center" colspan="3">Drops</th>

  </tr>
  <tr>
    <th align="left" width="150" nowrap="nowrap">Buyer</th>
    <th align="left" width="100%">Item</th>
    <th align="left" width="60" nowrap="nowrap">Spent</th>
  </tr>';
    $query = 'SELECT item_id, item_buyer, item_name, item_value
            FROM ' . MPREFIX . DKPDB_TABLE_ITEMS . "
            WHERE raid_id='".$raid."'";
    $query2 = 'SELECT count(*)
            FROM ' . MPREFIX . DKPDB_TABLE_ITEMS . "
            WHERE raid_id='".$raid."'";
	$sql99 = new db;
	$sql99->db_Select_gen($query2);
	while ($row99 = $sql99->db_Fetch()) {
		$item_count = $row99['count(*)'];
	}	
	$sql99->db_Select_gen($query);
	while ($row99 = $sql99->db_Fetch()) {
		$text .= '
  <tr class="row2">
    <td width="150" nowrap="nowrap"><a href="'.e_PLUGIN.'e107dkp/view_member.php?n='.$row99['item_buyer'].'">'.$row99['item_buyer'].'</a></td>';
		if ($pref['as_version']) {
			require_once(e_PLUGIN."armorystats/includes/config.php");
			// they have armorystats.. make it an item link!
			$text .= '
	<td width="100%"><a href="view_item.php?i='.$row99['item_id'].'">'.getItemByName(stripslashes($row99['item_name']),e_PLUGIN."e107dkp/view_item.php?i=".$row99['item_id']).'</a></td>';
		}
		else {
			$text .= '
	<td width="100%"><a href="view_item.php?i='.$row99['item_id'].'">'.stripslashes($row99['item_name']).'</a></td>';
		}	
		$text .= '
    <td width="60" class="negative">'.$row99['item_value'].'</td>
  </tr>';
    }
	$text .= '
  <tr>
    <th colspan="3" class="footer">... found '.$item_count.' drop(s)</th>
  </tr>
</table>';

    //
    // Class distribution
    //
    // If an element is false, that class didn't attend this raid
    // New for 1.3 - grab class information from the database

    $eq_classes = array();
    $total_attendees = sizeof($attendees);

    // Get each attendee's class
    $query = 'SELECT m.member_name, c.class_name AS member_class
            FROM ' . MPREFIX . DKPDB_TABLE_MEMBERS . ' m, ' . MPREFIX . DKPDB_TABLE_CLASSES ." c
	    	WHERE m.member_class_id = c.class_id 
            AND member_name IN ('" . implode("', '", $attendees) . '\')';
	$sql99 = new db;
	$sql99->db_Select_gen($query);
	while ($row99 = $sql99->db_Fetch()) {
        $member_name = $row99['member_name'];
		$member_class = $row99['member_class'];
        if ( $member_name != '' ) {
            $html_prefix = ( isset($ranks[$member_name]) ) ? $ranks[$member_name]['prefix'] : '';
            $html_suffix = ( isset($ranks[$member_name]) ) ? $ranks[$member_name]['suffix'] : '';
            $eq_classes[ $row99['member_class'] ] .= " " . $html_prefix . $member_name . $html_suffix .",";
	    	$class_count[ $row99['member_class'] ]++;
        }
    }
    unset($ranks);
    

$title = "<b>RAID POINTS & ATTENDANCE</b>";
$ns -> tablerender($title, $text);

require_once(FOOTERF);
?>
