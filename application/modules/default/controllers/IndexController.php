<?php

/**
 * Default_IndexController is the default controller for default module
 *
 * This module is required. Is the default module of the entire site.
 * Is used to operate a jump to the iptours old index file.
 *
 * @author     Agustín Calderón <agustincl@gmail.com>
 * @copyright  Copyright 2013 Elementaweb.net All Rights Reserved.
 * @license    http://creativecommons.org/licenses/by-nc-nd/3.0/es/  CC-NC-ND
 * @category   default
 * @package    Default
 * @subpackage file
 * @version    2013-11-27 agustincl 
 *
 */

class Default_IndexController extends Zend_Controller_Action
{
	/**
	 * The default action - show the home page
	 */
    public function indexAction() 
    {
 		//$this->_forward('index', 'index', 'frontend');       
    }

    public function __call($method, $args)
	{
    	// If an unmatched 'Action' method was requested, pass on to the
    	// default action method:
// 		Zend_Debug::dump($args, "requestIndexDefault", true);
		if ('Action' == substr($method, -6)) {
            return $this->indexAction();
        }

        throw new Zend_Controller_Exception('Invalid method called');
    }


    public function changelanguageformAction()
    {
        $this->_helper->viewRenderer->setNoRender(true);

        $request = $this->getRequest();
        include_once(APPLICATION_PATH . '/modules/default/forms/Languages.php'); 
        $form = new Default_Form_Languages();
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {            	
            	$locale = new Zend_Locale($request->getPost('language'));            	
                $default = new Zend_Session_Namespace('default');
                $default->language = $locale->getLanguage();
                $default->locale = $locale->getRegion();
                $this->_redirect($request->getPost('refer'));
            }
        }
    	else {
			return;
		}
        return;       
    }
    
	public function changelanguageAction()
    {
        $this->_helper->viewRenderer->setNoRender(true);

        $request = $this->getRequest();
        include_once(APPLICATION_PATH . '/modules/default/forms/Languages.php'); 
		if ($this->getRequest()->isPost()) {                        	
            	$locale = new Zend_Locale($request->getPost('language'));            	
                $default = new Zend_Session_Namespace('default');
                $default->language = $locale->getLanguage();
                $default->locale = $locale->getRegion();
                $this->_redirect($request->getPost('refer'));            
        }
    	else {
			return;
		}
        return;       
    }
}
