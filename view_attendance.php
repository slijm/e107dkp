<?php
if(!defined("e107_INIT")) {
	require_once("../../class2.php");
}
require_once(HEADERF);
require_once(e_PLUGIN."e107dkp/includes/config.php");
global $pref;

if ($pref['wcm_version']) {
	require_once(e_PLUGIN."wcm/includes/config.php");
//	if (WCMCheckCharAdmin()) {

	$text .= '
<table width="100%" border="0" cellspacing="1" cellpadding="2">
  <tr>
	<th align="center"  colspan="5" nowrap="nowrap"><u>: Attendance Report :</u></th>
  </tr>
  <tr>
    <td class="row2" width="40%" nowrap="nowrap"><b>Name</b>:</td>
	<td class="row2" width="20%" nowrap="nowrap"><b>30 Days</b>:</td>
	<td class="row2" width="20%" nowrap="nowrap"><b>60 Days</b>:</td>
	<td class="row2" width="20%" nowrap="nowrap"><b>90 Days</b>:</td>
  </tr>';
  
	$sql99 = new db;
	$sql99->db_Select(WCMDB_TABLE_CHARS,"*","char_status='1' ORDER BY char_name ASC");
	
//    $query = 'SELECT member_name
//            FROM ' . MPREFIX . DKPDB_TABLE_RAID_A . "
//            WHERE raid_id='".$raid."'
//            ORDER BY member_name";	
	
    while ($row99 = $sql99->db_Fetch()) {
        $char_name = stripslashes($row99['char_name']);
		list($thirty, $sixty, $ninty) = DKPraidCount(utf8_decode($char_name));
		$text .= '
  <tr>
    <td class="row2" width="40%" nowrap="nowrap"><a href="view_member.php?n='.$char_name.'">'.$char_name.'</a></td>
	<td class="row2" width="20%" nowrap="nowrap"><span class="positive">'.$thirty.'%</span></td>
	<td class="row2" width="20%" nowrap="nowrap"><span class="positive">'.$sixty.'%</span></td>
	<td class="row2" width="20%" nowrap="nowrap"><span class="positive">'.$ninty.'%</span></td>
  </tr>';	
	}
	$text .= '
</table>';
	
//	}
}
else {
	$text .= 'You do not appear to have WOW Character Manager installed<br>';
}

// Render the value of $text in a table.
$title = "<b>RAID POINTS & ATTENDANCE</b>";
$ns -> tablerender($title, $text);

require_once(FOOTERF);
?>