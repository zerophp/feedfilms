<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $this->_helper->layout->setLayout('frontend');
        $this->view->title = "Feed Films";
    }

    public function indexAction()
    {
        // action body
        $this->view->subtitle = "Inicio";
    }
    
    public function aboutAction()
    {
        // about 
        $this->view->subtitle = "Acerca de";
    }

    public function contactAction()
    {
        // about
        $this->view->subtitle = "Contacto";
    }
}

