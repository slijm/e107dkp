<?php
class CTRTItem {
	
	private $itemname;
	private $itemid;
	private $icon;
	private $class;
	private $subclass;
	private $color;
	private $count;
	private $player;
	private $time;
	private $zone;
	private $boss;
	
	public function __construct($loot) {
		if (!$loot instanceof SimpleXMLElement)
			throw new Exception("The parameter passed was not a valid SimpleXMLElement object.");
			
		$this->setItemName($loot->ItemName);
		$this->setItemId($loot->ItemId);
		$this->setIcon($loot->Icon);
		$this->setClass($loot->Class);
		$this->setSubClass($loot->SubClass);
		$this->setColor($loot->Color);
		$this->setCount($loot->Count);
		$this->setPlayer($loot->Player);
		$this->setTime($loot->Time);
		$this->setZone((string)$loot->Zone);
		$this->setBoss($loot->Boss);
	}
	
	public function getItemName() {
		return $this->itemname;
	}
	
	public function getItemId() {
		return $this->itemid;
	}
	
	public function getIcon() {
		return $this->icon;
	}
	
	public function getClass() {
		return $this->class;
	}
	
	public function getSubClass() {
		return $this->subclass;
	}
	
	public function getColor() {
		return $this->color;
	}
	
	public function getCount() {
		return $this->count;
	}
	
	public function getPlayer() {
		return $this->player;
	}
	
	public function getTime() {
		return $this->time;
	}
	
	public function getZone() {
		return $this->zone;
	}
	
	public function getBoss() {
		return $this->boss;
	}
	
	private function setItemName($itemname) {
		$this->itemname = $itemname;
	}
	
	private function setItemId($itemid) {
		$this->itemid = $itemid;
	}
	
	private function setIcon($icon) {
		$this->icon = $icon;
	}
	
	private function setClass($class) {
		$this->class = $class;
	}
	
	private function setSubClass($subclass) {
		$this->subclass = $subclass;
	}
	
	private function setColor($color) {
		$this->color = $color;
	} 
	
	private function setCount($count) {
		$this->count = $count;
	}
	
	private function setPlayer($player) {
		$this->player = $player;
	}
	
	private function setTime($time) {
		$this->time = $time;
	}
	
	private function setZone($zone) {
		$this->zone = $zone;
	}
	
	private function setBoss($boss) {
		$this->boss = $boss;
	}
}
?>