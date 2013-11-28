<?php

class Backend_IndexController extends Zend_Controller_Action
{

	public $_auth;
	
    public function init()
    {
        $this->_helper->layout()->setLayout("backend");
        $this->view->messages = $this->_helper->flashMessenger->getMessages();

        $this->_auth = Zend_Auth::getInstance();
        if(!$this->_auth->hasIdentity())
        {
        	$this->_helper->redirector('login', 'index', 'author');        	 
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

