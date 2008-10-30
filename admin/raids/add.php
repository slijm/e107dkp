<?php
global $ns;

$text .= "<div style=\"text-align: center;\">
<h2>".LAN_ADD_RAID_TITLE."</h2>
<form name=\"createraid\" method=\"post\" action=\"?action=create\">
<table>
<tr><td><label for=\"database\">".LAN_ADD_DATABASE_SELECT."</label></td><td><select name=\"database\"><option></option>";

foreach (Database::fetchAll() as $database) {
	$text .= "<option value=\"".$database->id."\">".$database->name."</option>";
}

$text .= "</select></td></tr>
</table>
<input type=\"submit\" value=\"".LAN_ADD_RAID_SUBMIT."\"/>
</form>
</div>";

$ns->tableRender("<a href=\"admin_e107dkp.php\">Main Menu</a> -> <a href=\"".e_SELF."\">Raid Management</a> -> Add Raid", $text);
?>
