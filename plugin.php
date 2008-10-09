<?php
if (!defined('e107_INIT')) { die("This file should not be accessed directly."); }
 
// Plugin info  
$eplug_name    = "e107dkp";
$eplug_version = "0.1";
$eplug_author  = "Heavy, cuscus";
 
$eplug_description = "The one stop shop for all of your DKP needs.";
$eplug_compatible  = "e107 v0.7";
$eplug_readme      = "docs/readme.html";        
 
// Name of the plugin's folder
$eplug_folder = "e107dkp";
 
// Name of the admin configuration file  
$eplug_conffile = "admin_e107dkp.php";
 
// List of preferences
$eplug_prefs = array(
	"dkp_version" => "0.1"
);
$eplug_table_names = array('e107dkp_raids', 'e107dkp_members', 'e107dkp_attendees', 'e107dkp_earneddkp', 'e107dkp_spentdkp', 'e107dkp_adjusteddkp', 'e107dkp_zones', 'e107dkp_items', 'e107dkp_ignoreditems', 'e107dkp_parsers');
$eplug_tables = array(
"CREATE TABLE ".MPREFIX."e107dkp_raids (
	`id` int(11) PRIMARY KEY AUTO_INCREMENT,
	`date` DATE NOT NULL,
	`zone` int(11) NOT NULL,
	`starttime` TIME NOT NULL,
	`endtime` TIME NOT NULL
) ENGINE = MyISAM;",
"CREATE TABLE ".MPREFIX."e107dkp_members (
	`id` int(11) PRIMARY KEY AUTO_INCREMENT,
	`name` VARCHAR(64) NOT NULL,
	`parent` int(11)
) ENGINE = MyISAM;",
"CREATE TABLE ".MPREFIX."e107dkp_attendees (
	`id` int(11) PRIMARY KEY AUTO_INCREMENT,
	`raid` int(11) NOT NULL,
	`member` int(11) NOT NULL
) ENGINE = MyISAM;",
"CREATE TABLE ".MPREFIX."e107dkp_earneddkp (
	`id` int(11) PRIMARY KEY AUTO_INCREMENT,
	`raid` int(11) NOT NULL,
	`owner` int(11) NOT NULL,
	`dkp` int(11) NOT NULL DEFAULT 0
) ENGINE = MyISAM;",
"CREATE TABLE ".MPREFIX."e107dkp_spentdkp (
	`id` int(11) PRIMARY KEY AUTO_INCREMENT,
	`raid` int(11) NOT NULL,
	`owner` int(11) NOT NULL,
	`item` int(11),
	`dkp` int(11) NOT NULL DEFAULT 0
) ENGINE = MyISAM;",
"CREATE TABLE ".MPREFIX."e107dkp_adjusteddkp (
	`id` int(11) PRIMARY KEY AUTO_INCREMENT,
	`dkp` int(11) NOT NULL DEFAULT 0,
	`owner` int(11) NOT NULL,
	`reason` VARCHAR(256) NOT NULL DEFAULT '',
	`adjustedBy` VARCHAR(128) NOT NULL DEFAULT ''
) ENGINE = MyISAM;",
"CREATE TABLE ".MPREFIX."e107dkp_zones (
	`id` int(11) PRIMARY KEY AUTO_INCREMENT,
	`name` varchar(128) NOT NULL,
	`imagename` varchar(128) DEFAULT ''
) ENGINE = MyISAM;",
"CREATE TABLE ".MPREFIX."e107dkp_items (
	`id` int(11) PRIMARY KEY AUTO_INCREMENT,
	`name` varchar(128) NOT NULL,
	`cost` int(11) NOT NULL DEFAULT 0
) ENGINE = MyISAM;",
"CREATE TABLE ".MPREFIX."e107dkp_ignoreditems (
	`item` int(11) NOT NULL
) ENGINE = MyISAM;",
"CREATE TABLE ".MPREFIX."e107dkp_parsers (
	`id` int(11) PRIMARY KEY AUTO_INCREMENT,
	`name` varchar(128) NOT NULL,
	`internalname` varchar(128) NOT NULL,
	`author` varchar(128) NOT NULL
) ENGINE = MyISAM;"
); 
 
// Create a link in main menu (yes=TRUE, no=FALSE) 
$eplug_link = FALSE;
 
// Text to display after plugin successfully installed 
$eplug_done           = "e107dkp has been installed successfully.";
$eplug_uninstall_done = "e107dkp has been uninstalled successfully.";

?>