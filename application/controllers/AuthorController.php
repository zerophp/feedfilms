<?php

class AuthorController extends Zend_Controller_Action
{

	public function init()
	{
		$this->view->messages = $this->_helper->flashMessenger->getMessages();
	}

	public function loginAction()
	{
		// action body
		$this->_helper->layout->setLayout("layout2");
		$this->view->title="Login";

        $form = new Application_Form_Author();
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $db = $this->_getParam('db');
                $authAdapter = new Zend_Auth_Adapter_DbTable(
                    $db,
                    'users',
                    'email',
                    'password'
                );
                $authAdapter->setIdentity($formData['email'])->setCredential( $formData['password']);
                $auth = Zend_Auth::getInstance();
                $result = $auth->authenticate($authAdapter);
                if ($result->isValid()){
                    $this->_helper->FlashMessenger('Succesful login');
                    $this->_helper->redirector->goToSimple('index', 'backend');
                }
                $this->_helper->FlashMessenger('Bad credentials!!!');
            } else {
                $form->populate($formData);
            }
        }

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


