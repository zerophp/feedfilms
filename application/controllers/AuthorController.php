<?php

class AuthorController extends Zend_Controller_Action
{

	public function init()
	{
		$this->_helper->layout->setLayout("layout2");
	}

	public function loginAction()
	{
		$this->view->title="Hola holita vecinito";
		$this->render("login");
	}

	public function logoutAction()
	{
		$this->render("login");
		 
	}

	public function registerAction()
	{
		$form = new Application_Form_Register();	
		$this->view->form = $form;
		$this->render("register");
	}


}


