<?php

class Application_Model_UserTypeMapper
{
    protected $_dbTable;

    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data usertype provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }

    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_UserType');
        }
        return $this->_dbTable;
    }


    public function find($id, Application_Model_User $usertype)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $user->setIdusertype($row->idusertype);
        $user->setUsertype($row->usertype);
        
        return $row->toArray();
    }
   

    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as  $row) {
            $entry = new Application_Model_UserType();
            $entry->setIdusertype($row->idusertype);
            $entry->setUsertype($row->usertype);
            
            $entries[$entry->getIdusertype()] = $entry->getUsertype();
        }
        return $entries;
    }
    

}

