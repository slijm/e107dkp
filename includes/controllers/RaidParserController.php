<?
require_once(dirname(__FILE__)."/../parsers/".$pref['e107dkp_default_parser']."/Parser.php");
require_once(dirname(__FILE__)."/../scoringsystems/".$pref['e107dkp_default_score_system']."/ScoringSystem.php");

class RaidParserController
{
	public static function doRaidParse() {
		$parser = new Parser();
	}
	
	public static function saveRaidData() {
		
	}
}
?>