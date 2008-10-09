<?php
require_once(dirname(__FILE__)."/Member.php");
abstract class Dkp 
{
	private $_id, $_dkp, $_owner;
	
	public function __construct($dkp, $owner, $id = null) {
		$this->_setDkp($dkp);
		$this->_setOwner($owner);
		$this->_setId($id);
	}
	
	public function getDkp() {
		return $this->_dkp;
	}
	
	public function getOwner() {
		return $this->_owner;
	}
	
	public function getId() {
		return $this->id;
	}
	
	private function _setId($id) {
		$this->id = $id;
	}
	
	private function _setDkp($dkp) {
		$this->_dkp = $dkp;
	}
	
	private function _setOwner($owner) {
		if ($owner instanceof Member)
			$this->_owner = $owner;
		else
			$this->_owner = Member::loadById($owner);
	}
	
}
?>