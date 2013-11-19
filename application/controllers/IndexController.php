<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    	$this->_helper->layout->setLayout("frontend");
    }

    public function indexAction()
    {
        // action body
    	
    }
    
    public function aboutAction()
    {
    	$this->render("index");
    }
    
    public function contactAction()
    {
    	$this->render("index");
    }


}

