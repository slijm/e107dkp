<?php
global $ns;

$text .= "
<script type=\"application/javascript\">
function submitCreateZone() {
	if (document.createzone.zonename.value == \"\") {
		alert(\"You must specify a zone name.\");
		document.createzone.zonename.style.border = \"3px solid #FF0000\";
	} else {
		document.createzone.submit();
	}
}
</script>
<div style=\"text-align: center;\">
<h2>Create Zone</h2>
<form name=\"createzone\" method=\"post\" action=\"".e_SELF."?action=create\">
<table>
<tr><td><label for=\"zonename\">Zone Name</label></td><td><input type=\"text\" name=\"zonename\"/></td></tr>
<tr><td colspan=\"2\"><input type=\"button\" value=\"Reset Form\" onclick=\"javascript: document.createzone.reset();\"/><input type=\"button\" value=\"Create Zone\" onclick=\"javascript: submitCreateZone();\"/></td></tr>
</table>
</form>
";
$text .= "<a href=\"admin_e107dkp.php\">Main Menu</a>";
$text .= "</div>";

$ns->tableRender("<a href=\"admin_e107dkp.php\">Main Menu</a> -> <a href=\"".e_SELF."\">Manage Zones</a> -> Create Zone", $text);
?>