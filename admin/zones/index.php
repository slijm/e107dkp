<?php
global $ns;

$text .= "<div style=\"text-align: center;\">";

$zones = Zone::loadAll();
if (count($zones)) {
	$text .= "<table>";
	$text .= "<tr><th>Zone Name</th><th>Edit</th><th>Delete</th></tr>";
	foreach ($zones as $zone) {
		$text .= "<tr><td>".$zone->getName()."</td><td><a href=\"?action=edit&id=".$zone->getId()."\">Edit</a></td><td><a href=\"?action=delete&id=".$zone->getId()."\" onclick=\"javascript: return confirm('Are you sure you want to delete ".$zone->getName()."?');\">Delete</a></td></tr>";
	}
	$text .= "</table>";
} else {
	$text .= "<p>There are currently no zones setup.</p>";
}

$text .= "<a href=\"?action=add\">Create A Zone</a><br/><br/>";
$text .= "<a href=\"admin_e107dkp.php\">Main Menu</a>";
$text .= "</div>"; 

$ns->tableRender("<a href=\"admin_e107dkp.php\">Main Menu</a> -> Manage Zones", $text);

?>