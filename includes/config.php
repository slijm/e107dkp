<?php
// ==============================================================================================
// WCM Database configuration
// If you wish to change the tables that EVERY WOW Character Manager query looks for, change them
// here!!!
// ==============================================================================================
//
// DEBUG OPTIONS
//
// ==============================================================================================
// set this to '1' if you wish to turn debugging on - this is used for when the developers 
// request it
define("DKP_DEBUG", "0");
//
// ==============================================================================================
//
// DB TABLES
//
// ==============================================================================================
// table where the raids for eqdkp are stored
define("DKPDB_TABLE_RAIDS", "eqdkp_raids");
// table where the raid attendees for eqdkp are stored
define("DKPDB_TABLE_RAID_A", "eqdkp_raid_attendees");
// table where the items for eqdkp are stored
define("DKPDB_TABLE_ITEMS", "eqdkp_items");
// table where the members for eqdkp are stored
define("DKPDB_TABLE_MEMBERS", "eqdkp_members");
// table where the ranks for eqdkp are stored
define("DKPDB_TABLE_MEMBER_RANKS", "eqdkp_member_ranks");
// table where the classes for eqdkp are stored
define("DKPDB_TABLE_CLASSES", "eqdkp_classes");


//
// DO NOT EDIT ANYTHING BELOW THIS LINE!
require_once(e_PLUGIN."e107dkp/includes/core.php");
?>
