<?php
require_once(dirname(__FILE__)."/Dkp.php");
require_once(dirname(__FILE__)."/Raid.php");
require_once(dirname(__FILE__)."/Item.php");
class DkpSpent extends Dkp
{
	private $_raid, $_item;
	
	public static function loadByRaidId($raidid) {
		global $sql;
		$sql->db_Select("e107dkp_spentdkp", "*", "raid=$raidid");
		$dkpspent = array();
		while ($row = $sql->db_Fetch()) {
			$dkpspent[] = new DkpEarned($row['dkp'], $row['owner'], $row['raid'], $row['id']);
		}
		return $dkpspent;
	}
	
	public static function loadByOwnerId($ownerid) {
		global $sql;
		$sql->db_Select("e107dkp_spentdkp", "*", "owner=$ownerid");
		$dkpspent = array();
		while ($row = $sql->db_Fetch()) {
			$dkpspent[] = new DkpEarned($row['dkp'], $row['owner'], $row['raid'], $row['id']);
		}
		return $dkpspent;
	}
	
	public static function loadAll() {
		global $sql;
		$sql->db_Select("e107dkp_spentdkp");
		$dkpspent = array();
		while ($row = $sql->db_Fetch()) {
			$dkpspent[] = new DkpEarned($row['dkp'], $row['owner'], $row['raid'], $row['id']);
		}
		return $dkpspent;
	}
	
	public function __construct($dkp, $owner, $raid, $item, $id = null) {
		parent::__construct($dkp, $owner, $id);
		$this->_setItem($item);
		$this->_setRaid($raid);
	}
	
	public function getRaid() {
		return $this->_raid;
	}
	
	public function getItem() {
		return $this->_item;
	}
	
	private function _setRaid($raid) {
		if ($raid instanceof Raid)
			$this->_raid = $raid;
		else
			$this->_raid = Raid::loadById($raid);
	}
	
	private function _setItem($item) {
		if ($item instanceof Item)
			$this->_item = $item;
		else
			$this->_item = Item::loadById($item);
	}
	
	public function save() {
		global $sql;
		if ($this->getId())
			$sql->db_Update("e107dkp_spentdkp", "raid=".$this->_raid->getId().", owner=".$this->getOwner()->getId().", dkp=".$this->getDkp().", item=".$this->getItem()->getId()." WHERE id=".$this->getId());
		else
			$sql->db_Insert("e107dkp_spentdkp", array('raid' => $this->_raid->getId(), 'owner' => $this->getOwner()->getId(), 'dkp' => $this->getDkp(), 'item' => $this->getItem()->getId()));
			$sql->db_Select("e107dkp_spentdkp", "id", "owner='".$this->_owner->getId()."' AND raid=".$this->_raid->getId()."AND dkp=".$this->_dkp." AND item=".$this->getItem()->getId());
			$row = $sql->db_Fetch();
			$this->_setId($row['id']);
	}
}
?>