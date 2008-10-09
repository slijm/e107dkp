<?php
class Zone
{
	private $_id, $_name, $_imageName;
	
	public static function loadByName($name) {
		global $sql;
		$sql->db_Select("e107dkp_zones", "*", "name = '$name'");
		$row = $sql->db_Fetch();
		if ($row != false) {
			return new Zone($row['name'], $row['imagename'], $row['id']);
		} else {
			return false;
		}
	}
	
	public static function loadById($id) {
		global $sql;
		$sql->db_Select("e107dkp_zones", "*", "id = $id");
		extract($sql->db_Fetch());
		return new Zone($name, $imagename, $id);
	}
	
	public static function loadAll() {
		global $sql;
		$sql->db_Select("e107dkp_zones");
		$zones = array();
		while ($row = $sql->db_Fetch()) {
			$zones[] = new Zone($row['name'], $row['imagename'], $row['id']);
		}
		return $zones;
	}
	
	public static function delete($id) {
		global $sql;
		$sql->db_Delete("e107dkp_zones", "id=$id");
	}
	
	public function __construct($name, $imageName = "", $id = null) {
		$this->_setName($name);
		if ($imageName != "")
			$this->_setImageName($imageName);
		else
			$this->_setImageName("");
			
		if ($id)
			$this->_setId($id);
	}
	
	public function getId() {
		return $this->_id;
	}
	
	public function getName() {
		return $this->_name;
	}
	
	public function setName($name) {
		$this->_setName($name);
	}
	
	public function getImagePath() {
		return e_PLUGIN."/e107dkp/images/zones/".$this->_imageName;
	}
	
	private function _setName($name) {
		$this->_name = $name;
	}
	
	private function _setImageName($imageName) {
		$this->_imageName = $imageName;
	}
	
	private function _setId($id) {
		$this->_id = $id;
	}
	
	public function save() {
		global $sql;
		if ($this->_id != null) {
			$sql->db_Update("e107dkp_zones", "name='".$this->_name."', imagename='".$this->_imageName."' WHERE id=".$this->_id);
		} else {
			$sql->db_Insert("e107dkp_zones", array('name' => $this->_name, 'imagename' => $this->_imageName));
			$sql->db_Select("e107dkp_zones", "*", "name='".$this->_name."'");
			$row = $sql->db_Fetch();
			$this->_id = $row['id'];
		}
	}
}
?>