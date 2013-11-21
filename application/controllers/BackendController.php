<?php

/**
 * BackendZendController
 * 
 * @author
 * @version 
 */

class BackendController extends Zend_Controller_Action {
	
	public function init() {
	
		$this->_helper->layout->setLayout('backend');
	
	}
	/**
	 * The default action - show the home page
	 */
	public function indexAction() {
		// TODO Auto-generated BackendZendController::indexAction() default action
	}
}
