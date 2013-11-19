<?php

class AuthorController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }


    public function loginAction()
    {
    	$this->_helper->layout->setLayout('login');
    }
    public function logoutAction()
    {
    	$this->_helper->layout->setLayout('login');
    }
    public function registerAction()
    {
    	$this->_helper->layout->setLayout('login');
    }
}

