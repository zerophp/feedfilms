<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initDoctype()
    {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('HTML5');
        
       
        
    }
    
    
    protected function _initSession()
    {
    	echo "CACA";
    	
//     	Zend_Debug::dump($view, "label", true);
    }
    
    
}

