<?php
$raids = Raid::loadAll();

global $ns;

$text .= "<div style=\"text-align: center;\">
<h2>".LAN_ADMIN_RAIDS_INDEX_TITLE."</h2>";
if (count($raids)) {
	$text .= "<table>
	<tr><th>Raid Date</th><th>Raid Zone</th><th>Raid Start Time</th><th>Edit</th><th>Delete</th></tr>";
	foreach ($raids as $raid) {
		$text .= "<tr><td>".$raid->getDate()."</td><td>".$raid->getZone()->getName()."</td><td>".$raid->getStartTime()."</td><td><a href=\"?action=edit&id=".$raid->getId()."\">Edit</a></td><td><a href=\"?action=delete&id=".$raid->getId()."\" onclick=\"return confirm('Are you sure you wish to delete the raid to ".$raid->getZone()->getName()." on ".$raid->getDate()."? All DKP earned and spent during this raid will be deleted and cannot be recovered. IF YOU PRESS OK THE OPERATION WILL EXECUTE!');\">Delete</a></td></tr>";
	}
	$text .= "</table>";
} else {
	$text .= "<p>".LAN_ADMIN_RAIDS_INDEX_NORAIDSEXIST."</p>";
}
$text .= "<p><a href=\"?action=add\">".LAN_ADMIN_RAIDS_INDEX_ADDRAIDOPTION."</a></p>
<p><a href=\"admin_e107dkp.php\">".LAN_ADMIN_COMMON_MAINMENU."</a></p>
</div>";

$ns->tableRender("<a href=\"admin_e107dkp.php\">".LAN_ADMIN_COMMON_MAINMENU."</a> -> Raid Management", $text);
?>
