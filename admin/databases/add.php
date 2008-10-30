<?php
global $ns;

$text = "<h2>".LAN_ADMIN_DATABASES_ADD_TITLE."</h2>";

$text .= "
<form method=\"post\" action=\"".e_SELF."?action=create\">
<table>
<tr><td><label for=\"name\">".LAN_ADMIN_DATABASES_ADD_LABELNAME."</label></td><td><input type=\"text\" name=\"name\"/></td></tr>
<tr colspan=\"2\"><td style=\"text-align: right;\"><input type=\"submit\" value=\"".LAN_ADMIN_DATABASES_ADD_SUBMIT."\"/></td></tr>
</table>
</form>";

$ns->tableRender("<a href=\"admin_e107dkp.php\">Main Menu</a> -> <a href=\"".e_SELF."\"><img src=\"images/icons/database-16.png\"/> Database Management</a> -> ".LAN_ADMIN_DATABASES_ADD_TITLE, "<div style=\"text-align: center\">$text</div>");
?>
