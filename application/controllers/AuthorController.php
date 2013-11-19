<?php

class AuthorController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $this->_helper->layout->setLayout('login');
        $this->view->title = "Feed Films";
    }

    public function loginAction()
    {
        // action body
        $this->view->subtitle = "Inicio";
    }
    
    public function logoutAction()
    {
        // about 
        $this->view->subtitle = "Acerca de";
    }

    public function registerAction()
    {
        // about
        $this->view->subtitle = "Contacto";
    }

}

