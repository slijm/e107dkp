<?php
global $ns;

$text .= "<pre>";

$parserDirectories = array();
$dir = dir(e_PLUGIN."e107dkp/includes/parsers");
while (false !== ($entry = $dir->read())) {
	if ($entry == "." || $entry == "..")
		continue;
		
	$path = $dir->path."/".$entry;
	if (is_dir($path)) {
		$parserDirectories[] = $path;
	}
}
$dir->close();
$text .= "Found ".count($parserDirectories)." potential parser".(count($parserDirectories) == 1 ? "" : "s").".\n";
for ($i=0; $i<count($parserDirectories); $i++) {
	$text .= "Validating '".$parserDirectories[$i]."'...\n";
	if (!file_exists($parserDirectories[$i]."/Manifest.xml")) {
		$text .= "Manifest file not found... validation FAILED.\n";
		continue;
	}
	
	if (false === ($manifest = simplexml_load_file($parserDirectories[$i]."/Manifest.xml"))) {
		$text .= "Failed to parse manifest... validation FAILED.\n";
		continue;
	}
	$text .= "Manifest file found for ".$manifest->name."(".$manifest->internalname.").\n";
	
	if (!file_exists($parserDirectories[$i]."/Parser.php")) {
		$text .= "Unable to find parser file... validation FAILED.\n";
		continue;
	}
	
	$file = file_get_contents($parserDirectories[$i]."/Parser.php");
	$parserValid = true;
	
	if (!preg_match("/function __construct\s*(.*)/", $file)) {
		$parserValid = false;
		$text .= "'__construct($xml)' function could not be found in the parser.\n";
	}
	
	if (!preg_match("/function getDate\s*()/", $file)) {
		$parserValid = false;
		$text .= "'getDate()' function could not be found in the parser.\n";
	}
	
	if (!preg_match("/function getStartTime\s*()/", $file)) {
		$parserValid = false;
		$text .= "'getStartTime()' function could not be found in the parser.\n";
	}
	
	if (!preg_match("/function getEndTime\s*()/", $file)) {
		$parserValid = false;
		$text .= "'getEndTime()' function could not be found in the parser.\n";
	}
	
	if (!preg_match("/function getZone\s*()/", $file)) {
		$parserValid = false;
		$text .= "'getZone()' function could not be found in the parser.\n";
	}
	
	if (!preg_match("/function getLoot\s*()/", $file)) {
		$parserValid = false;
		$text .= "'getLoot()' function could not be found in the parser.\n";
	}
	
	if (!preg_match("/function getAttendees\s*()/", $file)) {
		$parserValid = false;
		$text .= "'getAttendees()' function could not be found in the parser.\n";
	}
	
	if (!$parserValid) {
		$text .= "Validation of ".$manifest->name." has FAILED.\n";
		continue;
	}
	
	$parser = Parser::loadByInternalName($manifest->internalname);
	if ($parser == false)
		$parser = new Parser((string)$manifest->name, (string)$manifest->internalname, (string)$manifest->author);
		
	$parser->save();
	$text .= "Validation of ".$manifest->name." succeeded. It is now available for use.\n========\n\n";
}


$text .= "</pre>
<p><a href=\"".e_SELF."?action=scan\">Rerun Test</a></p>
<p><a href=\"".e_SELF."\">Return to Parser Configuration</a></p>";

$ns->tableRender("<a href=\"admin_e107dkp.php\">Main Menu</a> -> <a href=\"".e_SELF."\">Parser Configuration</a> -> Parser Validation", "<div style=\"text-align: center;\">".$text."</div>");
?>