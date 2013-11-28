<?php

class Developers_ArestController extends Zend_Rest_Controller
{
	public function init()
	{
		$this->_helper->viewRenderer->setNoRender(true);
		$this->_helper->layout->disableLayout();
	}

	public function indexAction()
	{			
		$albums = new Application_Model_DbTable_Albums();
		$this->_helper->json->sendJson($albums->fetchAll());
	}
		
	public function	getAction()
	{
		$this->getResponse()
		->appendBody("From getAction() returning the requested article");
	}
	
	public function	postAction()
	{
		$this->getResponse()
		->appendBody("From postAction() creating the requested article");
	}
	
	public function	putAction()
	{
		$this->getResponse()
		->appendBody("From putAction() updating the requested article");
	}
	
	public function	deleteAction()
	{
		$this->getResponse()
		->appendBody("From deleteAction() deleting the requested article");
	}
	
	public function	headAction()
	{
		$this->getResponse()
		->appendBody("From deleteAction() deleting the requested article");
	}

}

