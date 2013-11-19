<?php

class AuthorController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    	$this->_helper->layout()->setLayout('login-layout');
    }

    public function indexAction()
    {
        // action body
    	$this->view->title = "HELLO FEEDFILMS";
       
    }


}