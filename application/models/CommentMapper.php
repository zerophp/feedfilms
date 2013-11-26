<?php

class Application_Model_CommentMapper
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
            $this->setDbTable('Application_Model_DbTable_Comment');
        }
        return $this->_dbTable;
    }

    public function save(Application_Model_Comments $comment)
    {
        $data = array(
        	'idcomment'   => $comment->getId(),
            'iduser'   => $comment->getIduser(),
        	'idparentcomment'   => $comment->getIdParentComment(),
        	'idfilm'   => $comment->getIdFilm(),
        	'body'   => $comment->getBody(),
        	'rating'   => $comment->getRating(),
        	'review'   => $comment->getReview(),
        	'dateadd'   => date('Y-m-d H:i:s', time())
        );

        if (null === ($id = $comment->getId())) {
            unset($data['id']);
            $this->getDbTable()->addComment($data);
        } else {
        	
            $this->getDbTable()->updateComment($data);
        }
    }

    public function find($id)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
//         $comment = new Application_Model_Comments();
//         $comment->setId($row->idcomment)
//                    ->setIduser($row->iduser)
// 		        	->setIdParentComment($row->idparentcomment)
// 		        	->setIdFilm($row->idfilm)
// 		        	->setBody($row->body)
// 		        	->setRating($row->rating)
// 		        	->setReview($row->review)
// 		        	->setDateAdd($row->dateadd);
        
        return $row->toArray();
    }

    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Comment();
            $entry->setIduser($row->iduser)
		        	->setIdParentComment($row->idparentcomment)
		        	->setIdFilm($row->idfilm)
		        	->setBody($row->body)
		        	->setRating($row->rating)
		        	->setReview($row->review)
		        	->setDateAdd($row->dateadd);
            $entries[] = $entry;
        }
        return $entries;
    }
    
    public function delete($id)
    {
//     	$this->delete('idcomment =' . (int)$id);
		$this->_dbTable->deleteComment($id);
    }
}

