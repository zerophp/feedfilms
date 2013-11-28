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
    
    public function searchAction()
    {
    	 
    	$index=Zend_Search_Lucene::create('../application/data/index');
    	 
    	$festivales = new Festivals_Model_FestivalsMapper();
    	$records = $festivales->fetchAll();
    
    	foreach ($records as $record ){
    		$doc= new Zend_Search_Lucene_Document();
    		$doc->addField(Zend_Search_Lucene_Field::text('description',$record->getDescription(),'UTF-8'));
    		$doc->addField(Zend_Search_Lucene_Field::text('name',$record->getName(),'UTF-8'));
    		$index->addDocument($doc);
    	}
    
    	$index->commit();
    	$request=$this->getRequest();
    	if ($request->isPost()) {
    		$text= $request->getPost('searchtext');
    		$index=Zend_Search_Lucene::open('../application/data/index');
    		$results=$index->find($text);
    		$this->view->searchresults=$results;
    		$this->view->searchterm=$text;
    	}
    	else {
    		return;
    	}
    	 
    	return;
    }
    
    
    
    
	
}

