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
       $this->view->title="home";

    }
    
    public function aboutAction()
    {
    	// action body
    	$this->_helper->viewRenderer->setResponseSegment('heading');
    	$this->view->title="about";
    	$this->render("index");
    }
    
    public function contactAction()
    {
    	// action body
    	$this->view->title="contact";
    	$this->render("index");
    }
    
    public function carouselAction()
    {
    	// action body
    	$this->view->title="Carousel";
    	
    }


}
