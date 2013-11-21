<?php

class UserController extends Zend_Controller_Action
{

    public function init()
    {
       $this->_helper->layout()->setLayout("backend");
    }

    public function indexAction()
    {
        $user = new Application_Model_UserMapper();
        $this->view->entries = $user->fetchAll();
    }

    function addAction()
    {
    	$form = new Application_Form_User();
    
    	$form->submit->setLabel('Add');
    	$this->view->form = $form;
    	
    	if ($this->getRequest()->isPost()) {
    		$formData = $this->getRequest()->getPost();
    		if ($form->isValid($formData)) {
    			
    			$userdata = new Application_Model_User();
    			$userdata->setEmail($form->getValue('email'));
    			$userdata->setPassword($form->getValue('password'));
    			$userdata->setDisplay_name($form->getValue('display_name'));
    			$userdata->setState($form->getValue('state'));
    			$userdata->setIdusertype($form->getValue('idusertype'));
    			
    			$user = new Application_Model_UserMapper();
    			$user->save($userdata);
    			$this->_helper->redirector('index');
    		} else {
    			$form->populate($formData);
    		}
    	}
    	
    }   
    function editAction()
    {
    	$form = new Application_Form_User();
    
    	$form->submit->setLabel('Add');
    	$this->view->form = $form;
    	 
    	if ($this->getRequest()->isPost()) 
    	{
    		$formData = $this->getRequest()->getPost();
    		if ($form->isValid($formData))
    		 {
    			 
    			$userdata = new Application_Model_User();
    			$userdata->setIduser($form->getValue('iduser'));
    			$userdata->setEmail($form->getValue('email'));
    			$userdata->setPassword($form->getValue('password'));
    			$userdata->setDisplay_name($form->getValue('display_name'));
    			$userdata->setState($form->getValue('state'));
    			$userdata->setIdusertype($form->getValue('idusertype'));
    			 
    			$user = new Application_Model_UserMapper();
    			$user->save($userdata);
    			$this->_helper->redirector('index');
    		} 
    		else
    		{
    			$form->populate($formData);
    		}
    	}
    	else
    	 {
    	 	
    		$id = $this->_getParam('iduser', 0);
    		if ($id > 0) 
    		{
    			$user = new Application_Model_UserMapper();
    			$userdata = new Application_Model_User();
    			
    			$form->populate($user->find($id, $userdata));
    		}
    	 }
    	 
    }
    
    public function deleteAction()
    {
    	if ($this->getRequest()->isPost()) {
    		$del = $this->getRequest()->getPost('del');
    		if ($del == 'Yes') {
    			$id = $this->getRequest()->getPost('id');
    			$user = new Application_Model_UserMapper();
    			$user->delete($id);
    		}
    		$this->_helper->redirector('index');
    	} else {
    		$id = $this->_getParam('iduser', 0);
    		$user = new Application_Model_UserMapper();
    		$userdata = new Application_Model_User();
    		$this->view->user =$user->find($id, $userdata);
    	}
    }


}



