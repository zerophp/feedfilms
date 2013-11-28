<?php

class User_UserController extends Zend_Controller_Action
{

    public function init()
    {
      $this->_helper->layout()->setLayout("backend");
    }
	
    public function getListAction() {
    	$user 		= new User_Model_UserMapper();
    	$usersList 	= $user->fetchAll();
    	if (count($usersList) == 0) return;
    	
    	$pdf 	= new Zend_Pdf();
    	$page	= new Zend_Pdf_Page(Zend_Pdf_Page::SIZE_A4);
    	$style	= new Zend_Pdf_Style();
    	$style->setFillColor(new Zend_Pdf_Color_Rgb(0, 0, 0));
    	$style->setFont(Zend_Pdf_Font::fontWithName(Zend_Pdf_Font::FONT_COURIER), 10);
    	$page->setStyle($style);
    	$content = Zend_Debug::dump($usersList, null, false);
    	foreach (explode("\n", $content) as $i => $line)
    		$page->drawText($line, 20, 820 - $i * 10, 'UTF-8');
    	$pdf->pages[] = $page;
    	
    	// Return response
    	$this->_helper->layout()->disableLayout();
    	$this->getResponse()->setHeader("Content-Type", "application/pdf");
    	$this->getResponse()->setHeader("Content-Disposition", 'attachment;filename="list.pdf"');
    	$rendering = $pdf->render();
    	$this->getResponse()->setHeader("Content-Length", strlen($rendering));
    	$this->getResponse()->setBody($rendering);
    }
    
    public function indexAction()
    {
    	$user = new User_Model_UserMapper();
    	$this->view->entries = $user->fetchAll();
    }

    function addAction()
    {
    	$form = new User_Form_User();
    
    	$form->submit->setLabel('Add');
    	$this->view->form = $form;
    	
    	if ($this->getRequest()->isPost()) {
    		$formData = $this->getRequest()->getPost();
    		if ($form->isValid($formData)) {
    			
    			$userdata = new User_Model_User();
    			$userdata->setEmail($form->getValue('email'));
    			$userdata->setPassword($form->getValue('password'));
    			$userdata->setDisplay_name($form->getValue('display_name'));
    			$userdata->setState($form->getValue('state'));
    			$userdata->setIdusertype($form->getValue('idusertype'));
    			
    			$user = new User_Model_UserMapper();
    			$user->save($userdata);
    			$this->_helper->redirector('index');
    		} else {
    			$form->populate($formData);
    		}
    	}
    	
    }   
    function editAction()
    {
    	$form = new User_Form_User();
    
    	$form->submit->setLabel('Add');
    	$this->view->form = $form;
    	 
    	if ($this->getRequest()->isPost()) 
    	{
    		$formData = $this->getRequest()->getPost();
    		if ($form->isValid($formData))
    		 {
    			 
    			$userdata = new User_Model_User();
    			$userdata->setIduser($form->getValue('iduser'));
    			$userdata->setEmail($form->getValue('email'));
    			$userdata->setPassword($form->getValue('password'));
    			$userdata->setDisplay_name($form->getValue('display_name'));
    			$userdata->setState($form->getValue('state'));
    			$userdata->setIdusertype($form->getValue('idusertype'));
    			 
    			$user = new User_Model_UserMapper();
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
    			$user = new User_Model_UserMapper();
    			$userdata = new User_Model_User();
    			
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
    			$user = new User_Model_UserMapper();
    			$user->delete($id);
    		}
    		$this->_helper->redirector('index');
    	} else {
    		$id = $this->_getParam('iduser', 0);
    		$user = new User_Model_UserMapper();
    		$userdata = new User_Model_User();
    		$this->view->user =$user->find($id, $userdata);
    	}
    }


}



