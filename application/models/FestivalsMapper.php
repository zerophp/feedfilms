<?php

class Application_Model_FestivalsMapper
{
    protected $_dbTable;

    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data festivals provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }

    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Festivals');
        }
        return $this->_dbTable;
    }

    public function save(Application_Model_Festivals $festival)
    {
        $data = array(
        	'idfestival'  => ($festival->getIdfestival() ? $festival->getIdfestival() : NULL),
            'name'   => $festival->getName(),
        	'description' => $festival->getDescription(),
        	'date' => $festival->getDate(),
        	'update' => date('Y-m-d H:i:s', time())
        );

        if (NULL == ($id = $data['idfestival'])) {
            unset($data['idfestival']);
            $data['create'] = date('Y-m-d H:i:s', time());
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('idfestival = ?' => $id));
        }
    }

    public function find($id)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $festival = new Application_Model_Festivals($row->toArray());
        return $festival;
    }

    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Festivals($row->toArray());
            $entries[] = $entry;
        }
        return $entries;
    }
    
    public function delete($id)
    {
    	$user = new Application_Model_DbTable_User();
    	$where = $user->getAdapter()->quoteInto('idfestival = ?', (int)$id);
    	$this->getDbTable()->delete($where);
    }
}

