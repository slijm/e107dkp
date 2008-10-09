<?php
class CTRTAttendee {
	
	public function __construct($attendee, $jointime, $leavetime) {
		if (!$attendee instanceof SimpleXMLElement)
			throw new Exception("The parameter passed was not a valid SimpleXMLElement object.");
			
		$this->setName($attendee->name);
		$this->setRace($attendee->race);
		$this->setGuild($attendee->guild);
		$this->setClass($attendee->class);
		$this->setLevel($attendee->level);
		$this->setJoinTime($jointime);
		$this->setLeaveTime($leavetime);
	}

	public function getName() {
		return $this->name;
	}
	
	public function getRace() {
		return $this->race;
	}
	
	public function getGuild() {
		return $this->guild;
	}
	
	public function getClass() {
		return $this->class;
	}
	
	public function getLevel() {
		return $this->level;
	}

	public function getJoinTime() {
		return $this->jointime;
	}
	
	public function getLeaveTime() {
		return $this->leavetime;
	}

	public function save() {
		
	}

	private function setName($name) {
		$this->name = $name;
	}
	
	private function setRace($race) {
		$this->race = $race;
	} 
	
	private function setGuild($guild) {
		$this->guild = $guild;
	}
	
	private function setClass($class) {
		$this->class = $class;
	}
	
	private function setLevel($level) {
		$this->level = $level;
	}
	
	private function setJoinTime($jointime) {
		$this->jointime = $jointime;
	}
	
	private function setLeaveTime($leavetime) {
		$this->leavetime = $leavetime;
	}
	
}
?>