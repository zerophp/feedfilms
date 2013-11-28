<?php

class Developers_AlbumsController extends Zend_Controller_Action
{
	public function init()
	{
		$this->_helper->layout()->setLayout("backend");
		$contextSwitch = $this->_helper->getHelper('contextSwitch');
		$contextSwitch->addActionContext('index', 'json')
					  ->initContext();
// 		$contextSwitch->getcontext();
// 		die("caca");
		
	}
	
	public function indexAction()
	{		
// 			Zend_Debug::dump($this->_helper->getHelper('contextSwitch'));
			$albums = new Application_Model_DbTable_Albums();
			$this->view->albums = $albums->fetchAll();
//  			$this->_helper->json->sendJson($albums->fetchAll());
	}
	
	function addAction()
	{
		$form = new Application_Form_Album();

		$form->submit->setLabel('Add');
		$this->view->form = $form;

		if ($this->getRequest()->isPost()) 
		{

			$formData = $this->getRequest()->getPost();
			if ($form->isValid($formData)) 
			{
				$artist = $form->getValue('artist');
				$title = $form->getValue('title');
				$albums = new Application_Model_DbTable_Albums();
				$albums->addAlbum($artist, $title);

				$this->_helper->redirector('index');

			} else {
				$form->populate($formData);
			}
		}
	}
	
	function editAction()
	{

		$form = new Application_Form_Album();
		$form->submit->setLabel('Save');
		$this->view->form = $form;

		if ($this->getRequest()->isPost()) {
			$formData = $this->getRequest()->getPost();
			if ($form->isValid($formData)) {
				$id = (int)$form->getValue('id');
				$artist = $form->getValue('artist');
				$title = $form->getValue('title');
				$albums = new Application_Model_DbTable_Albums();
				$albums->updateAlbum($id, $artist, $title);

				$this->_helper->redirector('index');
			} else {
				$form->populate($formData);
			}
		} else {
			$id = $this->_getParam('id', 0);
			if ($id > 0) {
				$albums = new Application_Model_DbTable_Albums();
				$form->populate($albums->getAlbum($id));
			}
		}
	}
	
	public function deleteAction()
	{
		if ($this->getRequest()->isPost()) {
			$del = $this->getRequest()->getPost('del');
			if ($del == 'Yes') {
				$id = $this->getRequest()->getPost('id');
				$albums = new Application_Model_DbTable_Albums();
				$albums->deleteAlbum($id);
			}
			$this->_helper->redirector('index');
		} else {
			$id = $this->_getParam('id', 0);
			$albums = new Application_Model_DbTable_Albums();
			$this->view->album = $albums->getAlbum($id);
		}
	}

}

