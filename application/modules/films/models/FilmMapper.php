<?php

class Films_Model_FilmMapper
{
    protected $_dbTable;

    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }

    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Films_Model_DbTable_Films');
        }
        return $this->_dbTable;
    }

    public function save(Films_Model_Entity_Film $film)
    {
        $data = array(
        	'idfilm' => $film->getId(),
            'iduser'   => $film->getIduser(),
            'title' => $film->getTitle(),
            'director' => $film->getDirector(),
        );
        
        //Zend_Debug::dump($film->getId());
        //die;

        if (0 === ($id = $film->getId())) {
            unset($data['idfilm']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('idfilm = ?' => $id));
        }
    }

    public function find($id, Films_Model_Entity_Film $film)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        
        $film->setId($row->idfilm)
                  ->setIduser($row->iduser)
                  ->setTitle($row->title)
                  ->setDirector($row->director);
        return $film;
    }
    
    public function fetchAll()
    {
    	 
    	$resultSet = $this->getDbTable()->fetchAll();
    	$cacheManager=Zend_Registry::get("cache");
    	$cache = $cacheManager->getCache('coreCache');
    	$id = 'rs';
    
    	$films   = array();
    	foreach ($resultSet as $row) {
    		$film = new Films_Model_Entity_Film();
    		$film->setId($row->idfilm)
    		->setIduser($row->iduser)
    		->setTitle($row->title)
    		->setDirector($row->director);
    		$films[] = $film;
    	}
    
    	if(false === ($entries = $cache->load($id))){
    
    		$cache->save($films, $id);
    	}
    	return $films;
    }
    
	public function delete($id)
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $this->getDbTable()->delete('idfilm =' . (int)$id);
    }
}

