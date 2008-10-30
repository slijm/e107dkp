<?php
class Database 
{

	public static function fetchAll()
	{
		global $sql;
		$sql->db_Select("e107dkp_databases");
		$databases = array();
		while ($row = $sql->db_Fetch())
		{
			$databases[] = new Database($row['name'], $row['id']);	
		}
		return $databases;
	}

	public static function fetchById($id)
	{
		global $sql;
		$sql->db_Select("e107dkp_databases", "*", "id=$id");
		$row = $sql->db_Fetch();
		return new Database($row['name'], $row['id']);
	}

	public static function delete($id)
	{
		global $sql;
		$sql->db_Delete("e107dkp_databases", "id=$id");
	}

	private $_id, $_name; 

	public function __construct($name, $id = null)
	{
		$this->_id = $id;
		print($this->_id);
		$this->_name = $name;
	}

	public function setName($name)
	{
		$this->_name = $name;
	}

	public function getId()
	{
		return $this->_id;
	}

	public function getName()
	{
		return $this->_name;
	}

	public function save()
	{
		global $sql;
		if ($this->_id) {
			$sql->db_Update("e107dkp_databases", "name='".$this->_name."' WHERE id=".$this->_id);	
		} else {
			$sql->db_Insert("e107dkp_databases", array('name' => $this->_name));
			$sql->db_Select("e107dkp_databases", "*", "name='".$this->_name."'");
			$row = $sql->db_Fetch();
			$this->_id = $row['id'];
		}
	}

}
