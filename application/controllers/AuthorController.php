<?php

/**
 * AuthorController
 * 
 * @author
 * @version 
 */

class AuthorController extends Zend_Controller_Action {
	
	public function init() {
		
		$this->_helper->layout->setLayout('author');
		
	}
	/**
	 * The default action - show the home page
	 */
	public function loginAction() {
		// TODO Auto-generated AuthorController::indexAction() default action
	}
}
