<?php
global $ns;

$zone = Zone::loadById($_GET['id']);

$text .= "
<script type=\"application/javascript\">
function submitEditZone() {
	if (document.editzone.zonename.value == \"\") {
		alert(\"You must specify a zone name.\");
		document.editzone.zonename.style.border = \"3px solid #FF0000\";
	} else {
		document.editzone.submit();
	}
}
</script>
<div style=\"text-align: center;\">
<h2>Edit Zone</h2>
<form name=\"editzone\" method=\"post\" action=\"".e_SELF."?action=update\">
<table>
<tr><td><label for=\"zonename\">Zone Name</label></td><td><input type=\"text\" name=\"zonename\" value=\"".$zone->getName()."\"/></td></tr>
<tr><td colspan=\"2\"><input type=\"button\" value=\"Reset Form\" onclick=\"javascript: document.editzone.reset();\"/><input type=\"button\" value=\"Edit Zone\" onclick=\"javascript: submitEditZone();\"/></td></tr>
</table>
<input type=\"hidden\" name=\"zoneid\" value=\"".$zone->getId()."\"/>
</form>
";
$text .= "<a href=\"admin_e107dkp.php\">Main Menu</a>";
$text .= "</div>";

$ns->tableRender("<a href=\"admin_e107dkp.php\">Main Menu</a> -> <a href=\"".e_SELF."\">Manage Zones</a> -> Edit Zone", $text);
?>