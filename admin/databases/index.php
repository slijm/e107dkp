<?php
global $ns;

$databases = Database::fetchAll();

$text = "<h2>".LAN_ADMIN_DATABASES_INDEX_TITLE."</h2>";

if (count($databases))
{
	$text .= "
<table>
<tr><th>".LAN_ADMIN_DATABASES_INDEX_THDATABASENAME."</th><th>".LAN_ADMIN_COMMON_EDIT."</th><th>".LAN_ADMIN_COMMON_DELETE."</th></tr>";

foreach ($databases as $database) {
	$text .= "<tr><td>".$database->getName()."</td><td><a href=\"".e_SELF."?action=edit&id=".$database->getId()."\"/>".LAN_ADMIN_COMMON_EDIT."</a></td><td><a href=\"".e_SELF."?action=delete&id=".$database->getId()."\" onclick=\"javascript: return confirm('".LAN_ADMIN_DATABASES_INDEX_CONFIRMDELETE."');\">".LAN_ADMIN_COMMON_DELETE."</a></td></tr>";
}

$text .= "</table>";
}
else
{
	$text .= "<p>".LAN_ADMIN_DATABASES_INDEX_NODATABASESREGISTERED."</p>";
}

$text .= "<input type=\"button\" value=\"".LAN_ADMIN_DATABASES_INDEX_ADDDATABASEBUTTON."\" onclick=\"javascript: window.location='".e_SELF."?action=add'\"/>";

$ns->tableRender("<a href=\"admin_e107dkp.php\">Main Menu</a> -> <img src=\"images/icons/database-16.png\"/> Database Management", "<div style=\"text-align: center\">$text</div>");
?>
