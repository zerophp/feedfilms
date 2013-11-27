<?php

/**
 * IndexController.php is the default controller for developers module
 *
 * This module is required. Is the developers module of
 * backend. Is used for very simple developers demostration tasks.
 *
 * @author     Agustín Calderón <agustincl@gmail.com>
 * @copyright  Copyright 2013 Elementaweb.net All Rights Reserved.
 * @license    http://creativecommons.org/licenses/by-nc-nd/3.0/es/  CC-NC-ND
 * @category   developers
 * @package    Developers
 * @subpackage file
 * @version    2013-11-27 agustincl 
 *
 */

/**
 * Developers_IndexController
 *
 * @category   developers
 * @uses       Zend_Controller_Action
 * @package    Developers
 * @subpackage Controller
 * 
 */
class Developers_IndexController extends Zend_Controller_Action 
{
	private $_acl = array();
	protected $_form;
	protected $_redirector = null;
    
	public function init()
    {
		$this->_helper->layout->setLayout('backend');			
		$uri = $this->_request->getPathInfo();
		//$activeNav = $this->view->navigation()->findByUri($uri);
		//$activeNav->active=true;
				
		//$this->_redirector = $this->_helper->getHelper('Redirector');
		
    }     
	
    public function indexAction() 
    {    
    	$this->_helper->flashMessenger->addMessage('Task saved');
    	
    	$this->view->messages = $this->_helper->flashMessenger->getMessages();
    	$this->view->title = "Index"; 
						
    }  

        
}