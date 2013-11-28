<?php

class Backend_IndexController extends Zend_Controller_Action
{

	public $_auth;
	
    public function init()
    {
        
    	if ($this->getRequest()->isPost()) {
    		$post=$this->getRequest()->getPost();
    		if (isset($post['locale'])){
    			$lang=$post['locale'];
    			$_SESSION['default']['language']=$lang;
    			$translate=Zend_Registry::get('Zend_Translate');
    			$translate->setLocale($lang);
//    			$translate->setContent( dirname(__FILE__) .'/languages/'.$lang.'.mo');    			
    			 
    		}
    	}  	
    	
    	
    	$this->_helper->layout()->setLayout("backend");
        $this->view->messages = $this->_helper->flashMessenger->getMessages();
        
        $this->_auth = Zend_Auth::getInstance();
        if(!$this->_auth->hasIdentity()){
        	//Zend_Debug::dump($this->_auth->getIdentity(), "Identity", true);
        	$this->_helper->redirector('login', 'author');        	 
        }
        

    }

    public function indexAction()
    {
    	// action body
    }
    
    
    
	
}

