<?php
$raids = Raid::loadAll();

global $ns;

$text .= "<div style=\"text-align: center;\">";
if (count($raids)) {
	$text .= "<table>
	<tr><th>Raid Date</th><th>Raid Zone</th><th>Raid Start Time</th><th>Edit</th><th>Delete</th></tr>";
	foreach ($raids as $raid) {
		$text .= "<tr><td>".$raid->getDate()."</td><td>".$raid->getZone()->getName()."</td><td>".$raid->getStartTime()."</td><td><a href=\"?action=edit&id=".$raid->getId()."\">Edit</a></td><td><a href=\"?action=delete&id=".$raid->getId()."\" onclick=\"return confirm('Are you sure you wish to delete the raid to ".$raid->getZone()->getName()." on ".$raid->getDate()."? All DKP earned and spent during this raid will be deleted and cannot be recovered. IF YOU PRESS OK THE OPERATION WILL EXECUTE!');\">Delete</a></td></tr>";
	}
	$text .= "</table>";
} else {
	$text .= "<p>No raids currently recorded.</p>";
}
$text .= "<p><a href=\"?action=add\">Add Raid</a></p>
<p><a href=\"admin_e107dkp.php\">Main Menu</a></p>
</div>";

$ns->tableRender("<a href=\"admin_e107dkp.php\">Main Menu</a> -> Raid Management", $text);
?>