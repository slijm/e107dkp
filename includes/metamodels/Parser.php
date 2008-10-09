<?php
class Parser {
	
	private $_id, $_name, $_author, $_internalname;
	
	public static function loadById($id) {
		global $sql;
		$sql->db_Select("e107dkp_parsers", "*", "id=$id");
		$row = $sql->db_Fetch();
		if ($row == false) {
			return false;
		} else {
			return new Parser($row['name'], $row['internalname'], $row['author'], $row['id']);
		}
	}
	
	public static function loadByInternalName($internalname) {
		global $sql;
		$sql->db_Select("e107dkp_parsers", "*", "internalname='$internalname'");
		$row = $sql->db_Fetch();
		if ($row == false) {
			return false;
		} else {
			return new Parser($row['name'], $row['internalname'], $row['author'], $row['id']);
		}
	}
	
	public static function loadAll() {
		global $sql;
		$parsers = array();
		$sql->db_Select("e107dkp_parsers");
		while ($row = $sql->db_Fetch()) {
			$parsers[] = new Parser($row['name'], $row['internalname'], $row['author'], $row['id']);
		}
		return $parsers;
	}
	
	public function __construct($name, $internalname, $author, $id = null) {
		$this->_setName($name);
		$this->_setInternalName($internalname);
		$this->_setAuthor($author);
		$this->_setId($id);
	}
	
	public function getId() {
		return $this->_id;
	}
	
	public function getName() {
		return $this->_name;
	}
	
	public function getInternalName() {
		return $this->_internalname;
	}
	
	public function getAuthor() {
		return $this->_author;
	}
	
	public function setName($name) {
		$this->_setName($name);
	}
	
	public function setInternalName($internalname) {
		$this->_setInternalName($internalname);
	}
	
	public function setAuthor($author) {
		$this->_setAuthor($author);
	}
	
	private function _setId($id) {
		$this->_id = $id;
	}
	
	private function _setName($name) {
		$this->_name = $name;
	} 
	
	private function _setInternalName($internalname) {
		$this->_internalname = $internalname;
	}
	
	private function _setAuthor($author) {
		$this->_author = $author;
	}
	
	public function save() {
		global $sql;
		if ($this->getId() != null) {
			$sql->db_Update("e107dkp_parsers", "name='".$this->getName()."', internalname='".$this->getInternalName()."', author='".$this->getAuthor()."' WHERE id=".$this->getId());
		} else {
			$sql->db_Insert("e107dkp_parsers", array('name' => $this->getName(), 'internalname' => $this->getInternalName(), 'author' => $this->getAuthor()));
			$sql->db_Select("e107dkp_parsers", "id", "name='".$this->getName()."' AND internalname='".$this->getInternalName()."' AND author='".$this->getAuthor()."'");
			$row = $sql->db_Fetch();
			$this->_setId($row['id']);
		}
	}
}
?>