<?php
class Parser {
	private $ctrtdata, $starttime, $endtime, $zone, $loot, $attendees;
	
	public function __construct($ctrtstring = "") {
		$this->ctrtdata = simplexml_load_string($ctrtstring);
		$this->loot = array();
		$this->attendees = array();
		$this->parse();
	}
	
	public function parse() {
		$this->fetchStartTime();
		$this->fetchEndTime();
		$this->fetchAttendees();
		$this->fetchLoot();
		$this->fetchZone();
	}
	
	public function getDate() {
		return date("Y-m-d", $this->starttime);
	}
	
	public function getStartTime() {
		return date("H:m", $this->starttime);
	}
	
	public function getEndTime() {
		return date("H:m", $this->endtime);
	}
	
	public function getZone() {
		return $this->zone;
	}
	
	public function getLoot() {
		$loot = array();
		foreach ($this->loot->children() as $loot) {
			$item['item'] = (string)$loot->ItemName;
			$item['member'] = (string)$loot->Player;
			if (isset($loot->Costs)) 
				$item['cost'] = (string)$loot->Costs;
			$loot[] = $item;
		}
		return $loot;
	}
	
	public function getAttendees() {
		$attendees = array();
		foreach ($this->attendees->children() as $attendee) {
			$attendees[] = (string)$attendee->name;
		}
		return $attendees;
	}
	
	private function fetchStartTime() {
		$this->starttime = $this->ctrtdata->start;
		$this->startitme = strtotime($this->starttime);
	}
	
	private function fetchEndTime() {
		$this->endtime = $this->ctrtdata->end;
		$thsi->endtime = strtotime($this->endtime);
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
}
?>