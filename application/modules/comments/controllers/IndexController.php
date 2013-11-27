<?php

class Comments_IndexController extends Zend_Controller_Action
{
	protected $comment;
	
	public function init()
	{
		$this->comment = new Comments_Model_CommentMapper();
		$this->comment->setDbTable(new Comments_Model_DbTable_Comments());
		$this->_helper->layout()->setLayout("backend");
		//TODO move to correct location
		date_default_timezone_set('Europe/Madrid');
	}

	public function indexAction()
	{
		$comments = new Comments_Model_DbTable_Comments();
		$this->view->comments = $comments->fetchAll();
	}
	
	function addAction()
	{
		$form = new Comments_Form_Comment();

		$form->submit->setLabel('Add');
		$this->view->form = $form;
		if ($this->getRequest()->isPost()) {
			$formData = $this->getRequest()->getPost();
			if ($form->isValid($formData)) {
				$comm= new Comments_Model_Comments();
				//$comm->setId($form->getValue('idcomment'));
				$comm->setIduser($form->getValue('iduser'));
				$comm->setIdparentcomment($form->getValue('idparentcomment'));
				$comm->setIdfilm($form->getValue('idfilm'));
				$comm->setBody($form->getValue('body'));
				$comm->setRating($form->getValue('rating'));
				$comm->setReview($form->getValue('review'));
				$comm->setDateadd($form->getValue('dateadd'));

				$this->comment->save($comm);
				$this->_helper->redirector('index');
			} else {
				$form->populate($formData);
			}
		}
	}
	
	function editAction()
	{
		$form = new Comments_Form_Comment();
		$form->submit->setLabel('Save');
		$this->view->form = $form;
		if ($this->getRequest()->isPost()) {
			$formData = $this->getRequest()->getPost();
			if ($form->isValid($formData)) {
				$comm = new Comments_Model_Comments();
				$comm->setId($form->getValue('idcomment'));
				$comm->setIduser($form->getValue('iduser'));
				$comm->setIdparentcomment($form->getValue('idparentcomment'));
				$comm->setIdfilm($form->getValue('idfilm'));
				$comm->setBody($form->getValue('body'));
				$comm->setRating($form->getValue('rating'));
				$comm->setReview($form->getValue('review'));
				$comm->setDateadd($form->getValue('dateadd'));
				
				$this->comment->save($comm);
				$this->_helper->redirector('index');
			} else {
				$form->populate($formData);
			}
		} else {
			$id = $this->_getParam('id', 0);
			if ($id > 0) {
				$data = $this->comment->find($id);
				$form->populate($data);
			}
		}
	}
	
	public function deleteAction()
	{
		if ($this->getRequest()->isPost()) {
			$del = $this->getRequest()->getPost('del');
			if ($del == 'Yes') {
				$id = $this->getRequest()->getPost('idcomment');
				//$albums = new Comments_Model_DbTable_Albums();
				$this->comment->delete($id);
			}
			$this->_helper->redirector('index');
		} else {
			$id = $this->_getParam('id', 0);
			//$albums = new Comments_Model_DbTable_Albums();
			$this->view->comment = $this->comment->find($id);
		}
	}

}
