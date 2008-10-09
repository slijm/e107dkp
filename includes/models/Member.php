<?php
require_once(dirname(__FILE__)."/DkpEarned.php");
require_once(dirname(__FILE__)."/DkpSpent.php");

class Member {

	private $_name, $_parent, $_id, $_dkpEarned, $_dkpSpent, $_dkpAdjustments;

	public static function loadByName($name) {
		global $sql;
		$sql->db_Select("e107dkp_members", "*", "name='$name'");
		$row = $sql->db_Fetch();
		if ($row != false) {
			$parent = ($row['parent'] ? $row['parent'] : null);
			return new Member($row['name'], $parent, $row['id']);
		} else {
			return false;
		}
	}

	public static function loadById($id) {
		global $sql;
		$sql->db_Select("e107dkp_members", "*", "name='$$id'");
		$row = $sql->db_Fetch();
		if (count($row)) {
			$parent = ($row['parent'] != '' ? $row['parent'] : null);
			return new Member($row['name'], $parent, $row['id']);
		} else {
			return false;
		}
	}
	
	public static function loadAll() {
		global $sql;
		$sql->db_Select("e107dkp_members");
		$members = array();
		while ($row = $sql->db_Fetch()) {
			$parent = ($row['parent'] ? $row['parent'] : null);
			$members[] = new Member($row['name'], $parent, $row['id']);
		}
		return $members;
	}

	public function __construct($name, $parent = null, $id = null) {
		$this->_setName($name);
		$this->_setParent($parent);
		$this->_setId($id);
		if ($this->_id != null)
			$this->_fetchDkp();
	}
	
	public function calculateCurrentDkp() {
		$currentDkp = 0;
		foreach ($this->_dkpEarned as $dkp)
			$currentDkp += $dkp->getDkp();
			
		foreach ($this->_dkpSpent as $dkp)
			$spentDkp -= $dkp->getDkp();
			
		return $currentDkp;
	}
	
	public function getEarnedDkp() {
		return $this->_dkpEarned;
	}
	
	public function getSpentDkp() {
		return $this->_dkpSpent;
	}
	
	public function getName() {
		return $this->_name;
	}
	
	public function getParent() {
		return $this->_parent;
	}
	
	public function getId() {
		return $this->_id;
	}
	
	private function _setName($name) {
		$this->_name = $name;
	}
	
	private function _setParent($id) {
		if ($id != null)
			$this->_parent = Member::loadById($id);
		else
			$this->_parent = null;
	}
	
	private function _setId($id) {
		$this->_id = $id;
	}
	
	private function _fetchDkp() {
		$this->_dkpEarned = DkpEarned::loadByOwnerId($this->_id);
		$this->_dkpSpent = DkpSpent::LoadByOwnerId($this->_id);
	}
	
	public function save() {
		global $sql;
		if ($this->_id != null) {
			$sql->db_Update("e107dkp_members", "name='".$this->_name."', parent=".$this->_parent->getId()." WHERE id=".$this->_id);
		} else {
			if ($this->_parent != null)
				$sql->db_Insert("e107dkp_members", array('name' => $this->_name, 'parent' => $this->_parent->getId()));
			else
				$sql->db_Insert("e107dkp_members", array('name' => $this->_name));
			$sql->db_Select("e107dkp_members", "id", "name='".$this->_name."'");
			$row = $sql->db_Fetch();
			$this->_setId($row['id']);
		}
	}
}
?>