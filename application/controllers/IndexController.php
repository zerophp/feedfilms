<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
       $this->_helper->layout->setLayout("layout1");
       $this->view->title="Hola holita vecinito";
    }
    
    public function aboutAction()
    {
    	// action body
    	$this->_helper->layout->setLayout("layout1");
    	$this->view->title="about";
    	$this->render("index");
    	
    }
    
    public function contactAction()
    {
    	// action body
    	$this->_helper->layout->setLayout("layout1");
    	$this->view->title="contact";
    	$this->render("index");
    }


}

