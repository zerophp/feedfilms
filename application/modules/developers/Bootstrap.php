<?php

/**
 * Bootstrap.php is the admin module bootstrap

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
 * Admin_Bootstrap
 *
 * @category   developers
 * @uses       Zend_Application_Module_Bootstrap
 * @package    Developers
 * @subpackage Bootstrap
 *
 */
class Developers_Bootstrap extends Zend_Application_Module_Bootstrap
{
	
	/**
	 * Initialize configuration
	 *
	 * Read configuration file.
	 * Store configuration in registry.
	 *
	 * @return void
	 */
	protected function _initConfiguration()
	{
		$configFile = dirname(__FILE__) . '/config.ini';
		$admin_config = new Zend_Config_Ini($configFile,'developers');
		Zend_Registry::set("admin_config", $admin_config);
		//Zend_Debug::dump('admin');
	}
	
}
