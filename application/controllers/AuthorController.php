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
    	$this->_helper->layout->setLayout('frontend');
    }
    
    public function loginAction()
    {
    	 
    	// action body
    	$this->_helper->layout->setLayout('author');
    }
    

}

