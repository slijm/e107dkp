<?php
class Parser {
	private $ctrtdata;
	private $starttime;
	private $endtime;
	private $zone;
	private $loot;
	private $attendees;
	private $jointimes;
	private $leavetimes;
	
	public function __construct($ctrtstring = "") {
		$this->ctrtdata = simplexml_load_string($ctrtstring);
		$this->loot = array();
		$this->attendees = array();
		$this->jointimes = array();
		$this->leavetimes = array();
		$this->parse();
	}
	
	public function parse() {
		$this->fetchStartTime();
		$this->fetchEndTime();
		$this->fetchAttendees();
		$this->fetchLoot();
		$this->fetchZone();
		$this->fetchJoinTimes();
		$this->fetchLeaveTimes();
	}
	
	public function getStartTime() {
		return $this->starttime;
	}
	
	public function getEndTime() {
		return $this->endtime;
	}
	
	public function getJoinTimes() {
		return $this->jointimes;
	}
	
	public function getLeaveTimes() {
		return $this->leavetimes;
	}
	
	public function getZone() {
		return $this->zone;
	}
	
	public function getLoot() {
		return $this->loot->children();
	}
	
	public function getAttendees() {
		return $this->attendees->children();
	}
	
	private function fetchStartTime() {
		$this->starttime = $this->ctrtdata->start;
	}
	
	private function fetchEndTime() {
		$this->endtime = $this->ctrtdata->end;
	}
	
	private function fetchZone() {
		$this->zone = (string)$this->ctrtdata->zone;
		if (strlen($this->zone) == 0) {
			// We were unable to track down a zone. 
			// Attempt to find it on a boss string.
			if (count($this->loot) > 0) {
				$items = $this->loot->children();
				$item = new CTRTItem($items[0]);
				$this->zone = $item->getZone();
			}
			// If it is still not located then mark the raid
			// zone as unknown.
			if (strlen($this->zone) == 0) {
				$this->zone = "Unknown";
			}
		}
	}
	
	private function fetchLoot() {
		$this->loot = $this->ctrtdata->Loot;
	}
	
	private function fetchAttendees() {
		$this->attendees = $this->ctrtdata->PlayerInfos;
	}
	
	private function fetchJoinTimes() {
		foreach ($this->ctrtdata->Join->children() as $join) {
			$player = (string)$join->player;
			if (!array_key_exists($player, $this->jointimes)) {
				$this->jointimes[$player] = (string)$join->time;
			}	
		}
	}
	
	private function fetchLeaveTimes() {
		foreach ($this->ctrtdata->Leave->children() as $leave) {
			$player = (string)$leave->player;
			$this->leavetimes[$player] = (string)$leave->time;
		}
	}
}
?>