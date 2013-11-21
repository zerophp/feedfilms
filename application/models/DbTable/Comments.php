<?php

class Application_Model_DbTable_Comments extends Zend_Db_Table_Abstract
{
	protected $_name = 'comments';

	public function getComment($id)
	{
		$id = (int)$id;
		$row = $this->fetchRow('idcomment = ' . $id);
		if (!$row) {
			throw new Exception("Could not find row $id");
		}
		return $row->toArray();
	}

	public function addComment($comment)
	{
				
// 		$data = array(
// 				'idcomment' => $comment->getId(),
// 				'iduser' =>$comment->getIduser(),
// 				'idparentcomment' => $comment->getIdparentcomment(),
// 				'idfilm' => $comment->getIdfilm(),
// 				'body' => $comment->getBody(),
// 				'rating' => $comment->getRating(),
// 				'review' => $comment->getReview(),
// 				'dateadd' => $comment->getDateadd()				
// 		);
		$this->insert($comment);
	}

	public function updateComment($comment)
	{
// 		$data = array(
// 				'iduser' =>$comment->getIduser(),
// 				'idparentcomment' => $comment->getIdparentcomment(),
// 				'idfilm' => $comment->getIdfilm(),
// 				'body' => $comment->getBody(),
// 				'rating' => $comment->getRating(),
// 				'review' => $comment->getReview(),
// 				'dateadd' => $comment->getDateadd()	
// 		);
		
		$this->update($comment, 'idcomment = '. (int)$comment['idcomment']);
	}

	public function deleteComment($id)
	{
		$this->delete('idcomment =' . (int)$id);
	}
}
