<?php
global $ns;

$text .= "<div style=\"text-align: center;\">
<form name=\"createraid\" method=\"post\" action=\"?action=create\">
<textarea name=\"raidlog\"></textarea>
<p>Tracker Name:
	<select name=\"parser\">
		<option value=\"ctrt\">CT Raid Tracker</option>
	</select>
</p>
<input type=\"submit\" value=\"Parse Log\"/>
</form>
</div>";

$ns->tableRender("<a href=\"admin_e107dkp.php\">Main Menu</a> -> <a href=\"".e_SELF."\">Raid Management</a> -> Add Raid", $text);
?>