<?php
require_once(dirname(__FILE__)."/Member.php");
require_once(dirname(__FILE__)."/Raid.php");

class Attendee {
	
	private $_id, $_member, $_raid;
	
	public function __construct($member, $raid, $id = null) {
		$this->_setMember($member);
		$this->_setRaid($raid);
		$this->_setId($id);
	}
	
	public function getId() {
		return $this->_id;
	}
	
	public function getMember() {
		return $this->_member;
	}
	
	public function getRaid() {
		return $this->_raid;
	}
	
	private function _setMember($member) {
		if ($member instanceof Member)
			$this->_member = $member;
		else
			$this->_member = Member::loadById($member);
	}
	
	private function _setRaid($raid) {
		if ($raid instanceof Raid)
			$this->_raid = $raid;
		else
			$this->_raid = Raid::loadById($raid);
	}
	
	private function _setId($id) {
		$this->_id = $id;
	}
	
	public function save() {
		global $sql;
		if ($this->_id != null)
			$sql->db_Update("e107dkp_attendees", "*", "member=".$this->_member->getId().", raid=".$this->_raid->getId()." WHERE id=".$this->_id);
		else
			$this->db_Insert("e107dkp_attendees", array('member' => $this->_member->getId(), 'raid' => $this->_raid->getId()));
			$sql->db_Select("e107dkp_attendees", "id", "member='".$this->_member->getId()."' AND raid=".$this->_raid->getId());
			$row = $sql->db_Fetch();
			$this->_setId($row['id']);
	}
	
}
?>