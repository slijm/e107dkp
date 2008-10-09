<?php
if(!defined("e107_INIT")) {
	require_once("../../class2.php");
}
if(file_exists(e_PLUGIN."e107dkp/language/".e_LANGUAGE.".php")){
	require_once(e_PLUGIN."e107dkp/language/".e_LANGUAGE.".php");
}

function DKPraidCount($character_name) {
	$sql99 = new db;
	$count30_total = $sql99->db_Count(DKPDB_TABLE_RAIDS,"(*)","WHERE (raid_date BETWEEN '".mktime(0, 0, 0, date('m'), date('d')-30, date('Y'))."' AND '".time()."')");
	$count60_total = $sql99->db_Count(DKPDB_TABLE_RAIDS,"(*)","WHERE (raid_date BETWEEN '".mktime(0, 0, 0, date('m'), date('d')-60, date('Y'))."' AND '".time()."')");
	$count90_total = $sql99->db_Count(DKPDB_TABLE_RAIDS,"(*)","WHERE (raid_date BETWEEN '".mktime(0, 0, 0, date('m'), date('d')-90, date('Y'))."' AND '".time()."')");
	$sql99->db_Select_gen("SELECT count(*) FROM ".MPREFIX.DKPDB_TABLE_RAIDS." r, ".MPREFIX.DKPDB_TABLE_RAID_A." ra WHERE (ra.raid_id = r.raid_id) AND (ra.member_name='" . $character_name . "') AND (r.raid_date BETWEEN ".mktime(0, 0, 0, date('m'), date('d')-30, date('Y'))." AND ".time().")");
	while ($row99 = $sql99->db_Fetch()) {
		$count30_member = $row99['count(*)'];
	}	
	$sql99->db_Select_gen("SELECT count(*) FROM ".MPREFIX.DKPDB_TABLE_RAIDS." r, ".MPREFIX.DKPDB_TABLE_RAID_A." ra WHERE (ra.raid_id = r.raid_id) AND (ra.member_name='" . $character_name . "') AND (r.raid_date BETWEEN ".mktime(0, 0, 0, date('m'), date('d')-60, date('Y'))." AND ".time().")");	
	while ($row99 = $sql99->db_Fetch()) {
		$count60_member = $row99['count(*)'];
	}	
	$sql99->db_Select_gen("SELECT count(*) FROM ".MPREFIX.DKPDB_TABLE_RAIDS." r, ".MPREFIX.DKPDB_TABLE_RAID_A." ra WHERE (ra.raid_id = r.raid_id) AND (ra.member_name='" . $character_name . "') AND (r.raid_date BETWEEN ".mktime(0, 0, 0, date('m'), date('d')-90, date('Y'))." AND ".time().")");	
	while ($row99 = $sql99->db_Fetch()) {
		$count90_member = $row99['count(*)'];
	}	

	$percent30 = ( $count30_total > 0 ) ? round(($count30_member / $count30_total) * 100) : 0;
	$percent60 = ( $count60_total > 0 ) ? round(($count60_member / $count60_total) * 100) : 0;
	$percent90 = ( $count90_total > 0 ) ? round(($count90_member / $count90_total) * 100) : 0;

	$return_array = array();
	array_push($return_array, $percent30, $percent60, $percent90);	
	return $return_array;
}

?>