<?php

class Application_Model_UserMapper
{
    protected $_dbTable;

    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data user provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }

    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_User');
        }
        return $this->_dbTable;
    }

    public function save(Application_Model_User $user)
    {
        $data = array(
        	'iduser'  => $user->getIduser(),
            'email'   => $user->getEmail(),
        	'password' => $user->getPassword(),
        	'display_name' => $user->getDisplay_name(),
            'state' 	=> $user->getState(),
        	'token' => $user->getToken(),
            'idusertype' => $user->getIdusertype(),
        );

        if (null === ($id = $user->getIduser())) {
            unset($data['iduser']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('iduser = ?' => $id));
        }
    }

    public function find($id, Application_Model_User $user)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $user->setIduser($row->iduser);
        $user->setEmail($row->email);
        $user->setPassword($row->password);
        $user->setDisplay_name($row->display_name);
        $user->setState($row->state);
        $user->setIdusertype($row->idusertype);
        
        return $row->toArray();
    }
   

    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_User();
            $entry->setIduser($row->iduser);
            $entry->setPassword($row->password);
            $entry ->setEmail($row->email);
            $entry->setDisplay_name($row->display_name);
        	$entry->setState($row->state);
        	$entry->setIdusertype($row->idusertype);
            $entries[] = $entry;
        }
        return $entries;
    }
    
    public function delete($id)
    {
    	$user = new Application_Model_DbTable_User();
    	$where = $user->getAdapter()->quoteInto('iduser = ?', (int)$id);
    	$this->getDbTable()->delete($where);
    	
    }
}

