<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $this->_helper->layout->setLayout('frontend');
    }
    public function aboutAction()
    {
    	$this->_helper->layout->setLayout('frontend');
    }
    public function contactAction()
    {
    	$this->_helper->layout->setLayout('frontend');
    }

}

