<?php

class Application_Model_DbTable_Festivals extends Zend_Db_Table_Abstract
{
	protected $_name = 'festivals';

	public function getFestival($id)
	{
		$id = (int)$id;
		$row = $this->fetchRow('idfestival = ' . $id);
		if (!$row) {
			throw new Exception("Could not find row $id");
		}
		return $row->toArray();
	}

	public function addFestival($name, $description, $date)
	{
		$zdate = new Zend_Date($date);
		$data = array(
				'name' => $name,
				'description' => $description,
				'date' => $zdate->toString('YYYY-MM-dd hh:mm:ss'),
				'create' => date('Y-m-d H:i:s', time()),
				'update' => date('Y-m-d H:i:s', time())
		);
		$this->insert($data);
	}

	public function updateFestival($id, $name, $description, $date)
	{
		$zdate = new Zend_Date($date);
		$data = array(
				'name' => $name,
				'description' => $description,
				'date' => $zdate->toString('YYYY-MM-dd hh:mm:ss'),
				'update' => date('Y-m-d H:i:s', time())
		);
		$this->update($data, 'idfestival = '. (int)$id);
	}

	public function deleteFestival($id)
	{
		$this->delete('idfestival =' . (int)$id);
	}
}
