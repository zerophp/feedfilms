<?php

class AuthorController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    	$this->_helper->layout->setLayout('login');
    }

    public function indexAction()
    {
        // action body       
    }
    
    public function loginAction()
    {
    	// action body
    }
    
    public function logoutAction()
    {
    	// action body
    }
    
    public function registerAction()
    {
    	// action body
    }

}

