<?php

class BackendController extends Zend_Controller_Action
{

    public function init()
    {
        $this->_helper->layout()->setLayout("backend-layout");
    }

    public function indexAction()
    {
        // action body
    }


}

