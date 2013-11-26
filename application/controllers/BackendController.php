<?php

class BackendController extends Zend_Controller_Action
{

    public function init()
    {
        $this->_helper->layout()->setLayout("backend");
        $this->view->messages = $this->_helper->flashMessenger->getMessages();

    }

    public function indexAction()
    {
        // action body
    }


}

