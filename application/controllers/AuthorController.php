<?php

class AuthorController extends Zend_Controller_Action
{

	public function init()
	{
		/* Initialize action controller here */
		//$this->_helper->layout->setLayoutInstance("frontend");
		$this->_helper->layout->setLayout("login");
	}

	public function indexAction()
	{
		// action body
		
	}
	
	public function loginAction()
	{
		$this->render("index");
	
	}

	public function logoutAction()
	{
		$this->render("index");
	
	}
	
	public function registerAction()
	{
		$this->render("index");
	
	}

}