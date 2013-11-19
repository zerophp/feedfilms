<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initDoctype()
    {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('HTML5');
    }
    
    protected function _initNavigation(){
    	
    	$this->bootstrap('view');
    	$view = $this->getResource('view');
    	
    	$config = new Zend_Config_Xml(APPLICATION_PATH . '/configs/navigation.xml', 'nav');
    	$navigation = new Zend_Navigation($config);
    	$view->navigation($navigation);
    }
}

