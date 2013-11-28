<?php

class Backend_IndexController extends Zend_Controller_Action
{

	public $_auth;
	
    public function init()
    {
        $this->_helper->layout()->setLayout("backend");
        $this->view->messages = $this->_helper->flashMessenger->getMessages();
        $this->_auth = Zend_Auth::getInstance();
        if(!$this->_auth->hasIdentity())
        {
        	$this->_helper->redirector('login', 'index', 'author');        	 
        }
        

    }

    public function indexAction()
    {
        // action body
    }

	
}

