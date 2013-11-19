<?php

class AuthorController extends Zend_Controller_Action
{

	public function init()
	{
		/* Initialize action controller here */
	}

	public function loginAction()
	{
		// action body
		$this->_helper->layout->setLayout("layout2");
		$this->view->title="Hola holita vecinito";
	}

	public function logoutAction()
	{
		// action body
		$this->_helper->layout->setLayout("layout2");
		$this->view->title="logout";
		$this->render("login");
		 
	}

	public function registerAction()
	{
		// action body
		$this->_helper->layout->setLayout("layout2");
		$this->view->title="register";
		$this->render("login");
	}


}

