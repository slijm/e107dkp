<?php
global $ns;

$text .= "
<script type=\"application/javascript\">
function checkForm()
{
	var formValid = true;
	if (\$F('database') == '') {
		formValid = false;
		$('database-error').innerHTML = \"".LAN_ADD_RAID_DATABASESELECTERROR."\";
	}

	return formValid;
}
</script>
<style type=\"text/css\">
td.error-msg {
	width: 100px;
}
</style>
";

$text .= "<div style=\"text-align: center;\">
<h2>".LAN_ADD_RAID_TITLE."</h2>
<form name=\"createraid\" method=\"post\" action=\"?action=create\" onsubmit=\"return checkForm();\">
<table class=\"raid-form\">
<tr><td><label for=\"database\">".LAN_ADD_RAID_DATABASESELECT."</label></td><td><select name=\"database\" id=\"database\"><option></option>";

foreach (Database::fetchAll() as $database) {
	$text .= "<option value=\"".$database->getId()."\">".$database->getName()."</option>";
}

$text .= "</select></td><td id=\"database-error\" class=\"error-msg\"></td></tr>
<tr><td>".LAN_ADD_RAID_RAIDSTART."</td><td><input type=\"text\" id=\"raidstart-day\" name=\"raidstart-day\" style=\"width: 20px;\" value=\"dd\" onfocus=\"javascript: \$('raidstart-day').value = ''\"/>-
<select id=\"raidstart-month\" name=\"raidstart-month\">
<option value=\"1\">".LAN_ADMIN_COMMON_JAN."</option>
<option value=\"2\">".LAN_ADMIN_COMMON_FEB."</option>
<option value=\"3\">".LAN_ADMIN_COMMON_MAR."</option>
<option value=\"4\">".LAN_ADMIN_COMMON_APR."</option>
<option value=\"5\">".LAN_ADMIN_COMMON_MAY."</option>
<option value=\"6\">".LAN_ADMIN_COMMON_JUN."</option>
<option value=\"7\">".LAN_ADMIN_COMMON_JUL."</option>
<option value=\"8\">".LAN_ADMIN_COMMON_AUG."</option>
<option value=\"9\">".LAN_ADMIN_COMMON_SEP."</option>
<option value=\"10\">".LAN_ADMIN_COMMON_OCT."</option>
<option value=\"11\">".LAN_ADMIN_COMMON_NOV."</option>
<option value=\"12\">".LAN_ADMIN_COMMON_DEC."</option>
</select>-
<input type=\"text\" name=\"raidstart-year\" id=\"raidstart-year\" value=\"yyyy\" onfocus=\"javascript: \$('raidstart-year').value = ''\" style=\"width: 40px;\"/>
<input type=\"text\" id=\"raidstart-hour\" name=\"raidstart-hour\" style=\"width: 20px;\" value=\"hh\" onfocus=\"javascript: \$('raidstart-hour').value = ''\"/>:<input type=\"text\" id=\"raidstart-minute\" name=\"raidstart-minute\" style=\"width: 20px;\" value=\"dd\" onfocus=\"javascript: \$('raidstart-minute').value = ''\"/>
</td><td id=\"raidstart-error\"></td></tr>
<tr><td>".LAN_ADD_RAID_RAIDEND."</td><td><input type=\"text\" id=\"raidend-day\" name=\"raidend-day\" style=\"width: 20px;\" value=\"dd\" onfocus=\"javascript: \$('raidend-day').value = ''\"/>-
<select id=\"raidend-month\" name=\"raidend-month\">
<option value=\"1\">".LAN_ADMIN_COMMON_JAN."</option>
<option value=\"2\">".LAN_ADMIN_COMMON_FEB."</option>
<option value=\"3\">".LAN_ADMIN_COMMON_MAR."</option>
<option value=\"4\">".LAN_ADMIN_COMMON_APR."</option>
<option value=\"5\">".LAN_ADMIN_COMMON_MAY."</option>
<option value=\"6\">".LAN_ADMIN_COMMON_JUN."</option>
<option value=\"7\">".LAN_ADMIN_COMMON_JUL."</option>
<option value=\"8\">".LAN_ADMIN_COMMON_AUG."</option>
<option value=\"9\">".LAN_ADMIN_COMMON_SEP."</option>
<option value=\"10\">".LAN_ADMIN_COMMON_OCT."</option>
<option value=\"11\">".LAN_ADMIN_COMMON_NOV."</option>
<option value=\"12\">".LAN_ADMIN_COMMON_DEC."</option>
</select>-
<input type=\"text\" name=\"raidend-year\" id=\"raidend-year\" value=\"yyyy\" onfocus=\"javascript: \$('raidend-year').value = ''\" style=\"width: 40px;\"/>
<input type=\"text\" id=\"raidend-hour\" name=\"raidend-hour\" style=\"width: 20px;\" value=\"hh\" onfocus=\"javascript: \$('raidend-hour').value = ''\"/>:<input type=\"text\" id=\"raidend-minute\" name=\"raidend-minute\" style=\"width: 20px;\" value=\"dd\" onfocus=\"javascript: \$('raidend-minute').value = ''\"/>
</td><td id=\"raidend-error\"></td></tr>
<tr><td>".LAN_ADD_RAID_ZONE."</td><td>
<select name=\"zone\" id=\"zone\">
<option></option>";
foreach (Zone::fetchAll() as $zone) {
	$text .= "<option value=\"".$zone->getId()."\">".$zone->getName()."</option>";
}
$text .= "
</select>
</td><td id=\"raidzone-error\"></td></tr>
</table>
<input type=\"submit\" value=\"".LAN_ADD_RAID_SUBMIT."\"/>
</form>
</div>";

$ns->tableRender("<a href=\"admin_e107dkp.php\">Main Menu</a> -> <a href=\"".e_SELF."\">Raid Management</a> -> Add Raid", $text);
?>
