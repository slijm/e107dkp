<?php
require_once("../../class2.php");

if(!getperms("P")){ header("location:".e_BASE."index.php"); }
require_once(e_ADMIN."auth.php");

global $ns, $sql;

$text = "<div style=\"text-align: center;\">";

if ($sql->db_Count("plugin", "(*)", "WHERE plugin_path = 'cxlib' AND plugin_installflag = 1")) {
	$sql->db_Select("plugin", "plugin_version", "plugin_path = 'cxlib' AND plugin_installflag = 1");
	extract($sql->db_Fetch());
	if ($plugin_version < "1.1") {
		$text .= "
			<h1>You are unable to run this plugin until you have the correct version of the CodeXscape Library installed. You currently have version $plugin_version installed but e107dkp requires version 1.1 to run. Head to <a href=\"http://codexscape.com\">Codexscape</a> for more details.</h1>
		";
	} else {
		$text .= "
		<div style=\"text-align: center;\">
			<div style=\"float: left;\">
				<table border=\"1\" class=\"fborder\" cellspacing=\"0\" cellpadding=\"0\">
					<tr>
						<td colspan=\"2\" class=\"forumheader3\"><img src=\"images/icons/home.png\" border=\"0\" align=\"middle\"/>&nbsp;&nbsp;<b>e107DKP</b></td>
					</tr>
					<tr>
						<td colspan=\"2\" bgcolor=\"#000000\">&nbsp;</td>
					</tr>
					<tr>
						<td><a href=\"admin_databases.php\" title=\"Database Management\"><img src=\"".e_PLUGIN."/e107dkp/images/icons/database-32.png\"/></a></td><td><a href=\"admin_databases.php\" title=\"Database Management\">Database Management</a></td>
					</tr>
					<tr>
							<td><a href=\"admin_raids.php\" title=\"Raid Management\"><img src=\"".e_PLUGIN."/e107dkp/images/icons/raid.png\"/></a></td><td><a href=\"admin_raids.php\" title=\"Raid Management\">Raid Management</a></td>
						</tr>
					<tr>
						<td><a href=\"admin_zones.php\" title=\"Zone Management\"><img src=\"".e_PLUGIN."/e107dkp/images/icons/keys.png\"/></a></td><td><a href=\"admin_zones.php\" title=\"Zone Management\">Zone Management</a></td>
					</tr>
					<tr>
						<td><a href=\"admin_parserconfiguration.php\" title=\"Parser Configuration\"><img src=\"".e_PLUGIN."/e107dkp/images/icons/configuration.png\"/></a></td><td><a href=\"admin_parserconfiguration.php\" title=\"Parser Configuration\">Parser Configuration</a></td>
					</tr>
				</table>
				<p>Thank you for trying out this early release version of e107dkp. Please remember that this is a very early version of the plugin so there are likely to be a large amount of bugs and \"quirks\". If you do spot any issues please report them on the codexscape forum. Additionally you can report bugs and feature requests on the plugin tracker at <a href=\"http://e107dkp.lighthouseapp.com\">Lighthouse</a> (Registration required).</p>
			</div>
		</div>
		";
	}
} else {
	$text .= "
		<h1>You are unable to run this plugin until you have the CodeXscape Library installed. Please ensure you install version 1.1 or higher. Head to <a href=\"http://codexscape.com\">Codexscape</a> for more details.</h1>
	";
}

$text .= "</div>";

$ns->tablerender("<img src=\"images/icons/home-small.png\"/>&nbsp;&nbsp;Main Menu", $text);

require_once(e_ADMIN."footer.php"); 
?>
