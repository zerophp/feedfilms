<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
   
    protected function _initAutoload()
    {
    	$autoloader = Zend_Loader_Autoloader::getInstance();
    }
    
    protected function _initFrontRegistry()
    {
    	$front = $this->bootstrap('frontController')->getResource('frontController');
    	$front->setParam('registry', $this->getContainer());
    }
    
    protected function _initView()
    {
   		// Initialize view
    	$this->bootstrap('layout');
    	$layout = $this->getResource('layout');
    	$view = $layout->getView();
    
    	$view->doctype('HTML5');
    	$view->headTitle('');
    
    	// Enable dojo on layout
    	$view->addHelperPath('Zend/Dojo/View/Helper/', 'Zend_Dojo_View_Helper');
    	$view->addHelperPath(APPLICATION_PATH . '/views/helpers', 'Zend_View_Helper_NavMenu');
    	$view->addHelperPath(APPLICATION_PATH . '/views/helpers', 'Zend_View_Helper_AclLink');
    	$view->addHelperPath(APPLICATION_PATH . '/views/helpers', 'Zend_View_Helper_AdminTemplateDir');
    	$view->addBasePath(APPLICATION_PATH . '/views');
    
    	// Return it, so that it can be stored by the bootstrap
    	return $view;
    }
    
 	protected function _initNavigation()
    {
		$config = $this->getOptions();
        $layout = $this->getResource('layout');
		$view = $layout->getView();
		$confignav = new Zend_Config_Xml($config['navigationMenu'], 'nav');
		$container = new Zend_Navigation($confignav);	
		$view->navigation($container);
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
    
    protected function _initLocale()
    {
    	$locale = new Zend_Locale('en_EN');
    	Zend_Registry::set('Zend_Locale', $locale);
    	return $locale;
    }    
    
    
    protected function _initSession()
    {
    	Zend_Session::start();
    	$zfip = new Zend_Session_Namespace('app');
    }
    
    protected function _initLang()
    {   	
    	
    	$translate = new Zend_Translate(
    			array(
    					'adapter' => 'gettext',
    					'content' => dirname(__FILE__) .'/languages/es_ES.mo',
    					'locale'  => $_SESSION['default']['language']
    			)
	);
    	 
    	
    	$translate->addTranslation(
    			array(
    					'content' => dirname(__FILE__) .'/languages/en_EN.mo',
    					'locale'  => 'en_EN'
    			)
    	);
    	 
    	/*$translate->addTranslation(
    			array(
    					'content' => dirname(__FILE__) .'/languages/fr_FR.mo',
    					'locale'  => 'fr_FR'
    			)
    	);*/
    	 
    	
    	//$translate = new Zend_Translate('tmx', dirname(__FILE__) .'/languages/info.xml', $_SESSION['default']['language']);
    	Zend_Registry::set('Zend_Translate', $translate);
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
    
    protected function _initCaptcha()
    {
    	$captcha = $this->getOption('captcha');
    	Zend_Registry::set("PrivateKey", $captcha['privateKey']);
    	Zend_Registry::set("PublicKey", $captcha['publicKey']);
    }
    
    protected function _initSeoUrl()
    {
    	$router = $this->bootstrap('frontController')->getResource('frontController')->getRouter();
    	$route = new Zend_Controller_Router_Route_Regex(
    			'home/inicio',
    			array(
    					'action' => 'index',
    					'controller' => 'index',
    					'module' => 'index'
    			),array(
    						
    			),
    			'home/inicio');
    	$router->addRoute('home', $route);
    }
    
    protected function _initVerify()
    {
    	$verify = $this->getOption('verify');
    	Zend_Registry::set("signature", $verify['signature']);
    	Zend_Registry::set("timeout", $verify['timeout']);
    }
    
    protected function _initReCaptcha()
    {
    	$recaptcha = $this->getOption('recaptcha');
    	Zend_Registry::set("recaptcha.public", $recaptcha['public']);
    	Zend_Registry::set("recaptcha.private", $recaptcha['private']);
    }
    
    protected function initRestRoute()
    {
    	$this->bootstrap('frontController');
    	$frontController = Zend_Controller_Front::getInstance();
    	$restRoute = new Zend_Rest_Route($frontController);
    	$frontController->getRouter()->addRoute('default', $restRoute);
    }
    
    protected function _initCache()
    {
    	$cacheini = $this->getOption('cache');
    	$frontend=array("lifetime"=>$cacheini['lifetime'],"automatic_serialization"=>$cacheini['automatic_serialization']);
    	$backend=array("cache_dir"=>$cacheini['cache_dir']);
    	$cacheManager = new Zend_Cache_Manager();
    	$cache=Zend_Cache::factory('Core','File',$frontend, $backend);
    	 
    	$cacheManager->setCache('coreCache', $cache);
    
    	Zend_Registry::set("cache", $cacheManager);
    	return $cache;
    }
}
