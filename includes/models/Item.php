<?php
class Item
{
	private $_id, $_name, $_cost;
	
	public static function loadByName($name) {
		global $sql;
		$sql->db_Select("e107dkp_items", "*", "name='$name'");
		$row = $sql->db_Fetch();
		if ($row != false) {
			return new Item($row['name'], $row['cost'], $row['id']);
		} else {
			return false;
		}
	}
	
	public static function loadById($id) {
		global $sql;
		$sql->db_Select("e107dkp_items", "*", "id=$id");
		$row = $sql->db_Fetch();
		if ($row != false) {
			return new Item($row['name'], $row['cost'], $row['id']);
		} else {
			return false;
		}
	}
	
	public static function loadAll() {
		global $sql;
		$sql->db_Select("e107dkp_items");
		$items = array();
		while ($row = $sql->db_Fetch()) {
			$items[] = new Item($row['name'], $row['cost'], $row['id']);
		}
		return $items;
	}
	
	public static function ignoreItem($id) {
		global $sql;
		if ($sql->db_Count("e107dkp_ignoreditems", "(*)", "WHERE item=$id") > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	public function __construct($name, $cost, $id = null) {
		$this->_setName($name);
		$this->_setCost($cost);
		if ($id != null)
			$this->_setId($id);
	}
	
	public function getName() {
		return $this->_name;
	}
	
	public function getCost() {
		return $this->_cost;
	}
	
	public function getId() {
		return $this->_id;
	}
	
	private function setName($name) {
		$this->_name = $name;
	}
	
	private function setCost($cost) {
		$this->_cost = $cost;
	}
	
	private function setId($id) {
		$this->_id = $id;
	}
	
	public function save() {
		global $sql;
		if ($this->_id != null) {
			$sql->db_Update("e107dkp_items", "name='".$this->_name."', cost=".$this->_cost." WHERE id=".$this->_id);
		} else {
			$sql->db_Insert("e107dkp_items", array('name' => $this->_name, 'cost' => $this->_cost));
			$sql->db_Select("e107dkp_items", "id", "name='".$this->_name."' AND cost=".$this->_cost);
			$row = $sql->db_Fetch();
			$this->_id = $row['id'];
		}
	}
}
?>