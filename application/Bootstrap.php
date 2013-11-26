<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected function _initDoctype()
    {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('HTML5');        
    }
    
    protected function _initAutoload()
    {
    	$autoloader = Zend_Loader_Autoloader::getInstance();
    }
    
    
    
    
    protected function _initSession()
    {
    	Zend_Session::start();
    	$zfip = new Zend_Session_Namespace('app');
    	
    }
    
    protected function _initFrontRegistry()
    {
    	$front = $this->bootstrap('frontController')->getResource('frontController');
    	$front->setParam('registry', $this->getContainer());
    }
    
    protected function _initDatabase()
    {
    	$this->bootstrapDb();
    	$db = $this->getResource('db');
    	$db->setFetchMode(Zend_Db::FETCH_OBJ);
    	$db->query("SET NAMES 'utf8'");
    	$db->query("SET CHARACTER SET 'utf8'");
    	Zend_Registry::set("db", $db);
    
    	return $db;
    }
    
    
    protected function _initLang()
    {
    	// TODO
    	// Set cache for speedup
    	
    	//$translate = new Zend_Translate('tmx', dirname(__FILE__) .'/languages/info.xml', $_SESSION['default']['language']);
    	//Zend_Registry::set('Zend_Translate', $translate);
    }

    protected function _initEmail()
    {
    	$emailconf = $this->getOption('email');
    	$transport = new Zend_Mail_Transport_Smtp($emailconf['server'], $emailconf);
    	Zend_Registry::set("transport", $transport);
    	return $transport;
    }
    
    protected function _initGoogleMap()
    {
    	$gmap = $this->getOption('maps');
    	Zend_Registry::set("APIKey", $gmap['APIKey']);
    }
}














