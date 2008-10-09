<?php
require_once(dirname(__FILE__)."/Zone.php");
require_once(dirname(__FILE__)."/Attendee.php");

class Raid {
	
	private $_id, $_date, $_zone, $_starttime, $_endtime, $_attendees;
	
	public static function loadById($id) {
		global $sql;
		$sql->db_Select("e107dkp_raids", "*", "id=$id");
		$row = $sql->db_Fetch();
		return new Raid($row['date'], $row['zone'], $row['starttime'], $row['endtime'], $id);
	}
	
	public static function loadByZone($zone) {
		global $sql;
		
		if ($zone instanceof Zone)
			$zone = $zone->getId();
		
		$sql->db_Select("e107dkp_raids", "*", "zone=$zone ORDER BY date DESC");
		$raids = array();
		while ($row = $sql->db_Fetch()) {
			$raids[] = new Raid($row['date'], $row['zone'], $row['starttime'], $row['endtime'], $row['id']);
		}
		return $raids;
	}
	
	public static function loadByDate($date) {
		global $sql;
		$sql->db_Select("e107dkp_raids", "*", "date='$date' ORDER BY starttime DESC");
		$raids = array();
		while ($row = $sql->db_Fetch()) {
			$raids[] = new Raid($row['date'], $row['zone'], $row['starttime'], $row['endtime'], $row['id']);
		}
		return $raids;
	}
	
	public static function loadByMember($member) {
		global $sql;
		
		if ($member instanceof Member)
			$member = $member->getId();
		
		$sql->db_Select("e107dkp_attendees", "raid", "member=$member");
		$raids = array();
		while ($row = $sql->db_Fetch())
			$raids = Raid::loadById($row['raid']);
		
		return $raids;
	}
	
	public static function loadAll() {
		global $sql;
		$sql->db_Select("e107dkp_raids", "*", "ORDER BY date DESC", "no-where");
		$raids = array();
		while ($row = $sql->db_Fetch()) {
			$raids[] = new Raid($row['date'], $row['zone'], $row['starttime'], $row['endtime'], $row['id']);
		}
		return $raids;
	}
	
	public function __construct($date, $zone, $starttime, $endtime, $id = null) {
		$this->_setDate($date);
		$this->_setZone($zone);
		$this->_setStartTime(strtotime($starttime));
		$this->_setEndTime(strtotime($endtime));
		$this->_setId($id);
		$this->_attendees = array();
		if ($id != null) {
			$this->_loadAttendees();
		}
	}
	
	public function addAttendee($attendee) {
		if ($this->_id == null)
			$this->_save();
			
		if ($attendee instanceof Attendee)
			$this->_attendees[] = $attendee;
		else
			$this->_attendees[] = new Attendee($attendee, $this->_id);
	}
	
	public function removeAttendee($attendee) {
		for ($i = 0; $i < count($this->_attendees); $i++) {
			if ($this->_attendees[$i]->getId() == $attendee) {
				unset($this->_attendees[$i]);
				break;
			}
		}
	}
	
	public function getDate() {
		return $this->_date;
	}
	
	public function getZone() {
		return $this->_zone;
	}
	
	public function getStartTime() {
		return date("H:m", $this->_starttime);
	}
	
	public function getEndTime() {
		return date("H:m", $this->_endtime);
	}
	
	public function getAttendees() {
		return $this->_attendees;
	}
	
	private function _setDate($date) {
		$this->_date = $date;
	}
	
	private function _setZone($zone) {
		if ($zone instanceof Zone)
			$this->_zone = $zone;
		else
			$this->_zone = Zone::loadById($zone);
	}
	
	private function _setStartTime($starttime) {
		$this->_starttime = $starttime;
	}
	
	private function _setEndTime($endtime) {
		$this->_endtime = $endtime;
	}
	
	private function _setId($id) {
		$this->_id = $id;
	}
	
	private function _loadAttendees() {
		$this->_attendees = Attendee::loadByRaid($this->_id);
	}
	
	public function save() {
		global $sql;
		if ($this->_id != null) {
			$sql->db_Update("e107dkp_raids", "date='".$this->_date."', zone=".$this->_zone->getId().", starttime='".date("H:m", $this->_starttime)."', endtime='".date("H:m", $this->_endtime)."' WHERE id=".$this->_id);
			foreach ($this->_attendees as $attendee)
				$attendee->save();
		} else {
			$sql->db_Insert("e107dkp_raids", array('date' => $this->_date, 'zone' => $this->_zone->getId(), 'starttime' => date("H:m", $this->_starttime), 'endtime' => date("H:m", $this->_endtime)));
			foreach ($this->_attendees as $attendee)
				$attendee->save();
			$sql->db_Select("e107dkp_raids", "id", "date='".$this->_date."' AND zone=".$this->_zone->getId());
			$row = $sql->db_Fetch();
			$this->_setId($row['id']);
		}
	}
	
}
?>