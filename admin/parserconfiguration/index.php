<?php
global $ns;

$parsers = Parser::loadAll();

$text .= "<h2>Parser Configuration</h2>";

if (count($parsers) > 0) {
	$text .= "<table>";
	$text .= "<tr><th>Name</th><th>Internal Name</th><th>Author</th></tr>";
	foreach ($parsers as $parser) {
		$text .= "<tr><td>".$parser->getName()."</td><td>".$parser->getInternalName()."</td><td>".$parser->getAuthor()."</td></tr>";
	}
	$text .= "</table>";
}

$text .= "<p><a href=\"".e_SELF."?action=scan\">Scan For New Parsers</a></p>";

$ns->tableRender("<a href=\"admin_e107dkp.php\">Main Menu</a> -> Parser Configuration", "<div style=\"text-align: center;\">".$text."</div>");
?>