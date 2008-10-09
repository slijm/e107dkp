<?php
require_once(dirname(__FILE__)."/Dkp.php");
require_once(dirname(__FILE__)."/Raid.php");
class DkpEarned extends Dkp
{
	private $_raid;
	
	public static function loadByRaidId($raidid) {
		global $sql;
		$sql->db_Select("e107dkp_earneddkp", "*", "raid=$raidid");
		$dkpearned = array();
		while ($row = $sql->db_Fetch()) {
			$dkpearned[] = new DkpEarned($row['dkp'], $row['owner'], $row['raid'], $row['id']);
		}
		return $dkpearned;
	}
	
	public static function loadByOwnerId($ownerid) {
		global $sql;
		$sql->db_Select("e107dkp_earneddkp", "*", "owner=$ownerid");
		$dkpearned = array();
		while ($row = $sql->db_Fetch()) {
			$dkpearned[] = new DkpEarned($row['dkp'], $row['owner'], $row['raid'], $row['id']);
		}
		return $dkpearned;
	}
	
	public static function loadAll() {
		global $sql;
		$sql->db_Select("e107dkp_earneddkp");
		$dkpearned = array();
		while ($row = $sql->db_Fetch()) {
			$dkpearned[] = new DkpEarned($row['dkp'], $row['owner'], $row['raid'], $row['id']);
		}
		return $dkpearned;
	}
	
	public function __construct($dkp, $owner, $raid, $id = null) {
		parent::__construct($dkp, $owner, $id);
		$this->_setRaid($raid);
	}
	
	public function getRaid() {
		return $this->_raid;
	}
	
	private function _setRaid($raid) {
		if ($raid instanceof Raid)
			$this->_raid;
		else
			$this->_raid = Raid::loadById($raid);
	}
	
	public function save() {
		global $sql;
		if ($this->getId())
			$sql->db_Update("e107dkp_earneddkp", "raid=".$this->_raid->getId().", owner=".$this->getOwner()->getId().", dkp=".$this->getDkp()." WHERE id=".$this->getId());
		else
			$sql->db_Insert("e107dkp_earneddkp", array('raid' => $this->_raid->getId(), 'owner' => $this->getOwner()->getId(), 'dkp' => $this->getDkp()));
			$sql->db_Select("e107dkp_earneddkp", "id", "owner='".$this->_owner->getId()."'AND raid=".$this->_raid->getId()."AND dkp=".$this->_dkp);
			$row = $sql->db_Fetch();
			$this->_setId($row['id']);
	}
}
?>