<?php
require_once(e_PLUGIN."e107dkp/includes/parsers/".$_POST['parser']."/Parser.php");
require_once(e_PLUGIN."e107dkp/includes/models/Member.php");

global $ns;

$parser = new Parser($_POST['raidlog']);

// Report new members created.
$text .= "<h2>Raid Log Parse Report</h2>";
$text .= "<h3>Attendee Parsing Messages</h3><ul style=\"list-style: none;\">";
$attendees = array();
foreach ($parser->getAttendees() as $attendee) {
	$member = Member::loadByName($attendee->name);
	if (!$member) {
		$member = new Member($attendee->name);
		$member->save();
		$text .= "<li>The attendee, ".$member->getName().", has not been seen before. A new record has been created.</li>";
		$attendees[] = $member;
	} else {
		$attendees[] = $member;
	}
		
}
$text .= "</ul>";
$text .= "<h3>Zone Parsing Messages</h3><ul style=\"list-style: none;\">";

$zone = Zone::loadByName($parser->getZone());
if ($zone == false) {
	$zone = new Zone($parser->getZone());
	$zone->save();
	$text .= "<p>The zone, ".$zone->getName().", has not been seen before. A new record has been created.</p>";
}

$text .= "</ul>";

$text = "<div style=\"text-align: center;\">".$text."</div>";

$ns->tableRender("<a href=\"admin_e107dkp.php\">Main Menu</a> -> <a href=\"".e_SELF."\">Raid Management</a> -> Raid Creation Results", $text);
?>