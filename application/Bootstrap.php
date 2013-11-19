<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initDoctype()
    {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('XHTML1_STRICT');
    }
    
    /*
     * void _initNavigation
     * La clase se llama Zend_navigation( a partir de un XML )
     */
    protected function _initNavigation()
    {
        
    }
    
    protected function _initDormir()
    {
        //echo 'zZzZZzZzZZzZZzZZZzzZZ';
    }
}

