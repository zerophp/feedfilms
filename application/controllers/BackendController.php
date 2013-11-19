<?php

class BackendController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    	$this->_helper->layout()->setLayout('backend-layout');
    }

    public function indexAction()
    {
        // action body
    	$this->view->title = "HELLO FEEDFILMS";
       
    }


}

