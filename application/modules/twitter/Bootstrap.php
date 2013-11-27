<?php 
class Twitter_Bootstrap extends Zend_Application_Module_Bootstrap
{

    function _initConfiguration() {
        $configFile = dirname(__FILE__) . '/config.ini';
        $twitter_config = new Zend_Config_Ini($configFile);
        Zend_Registry::set('twitter_api', $twitter_config->twitter->api);
        Zend_Registry::set('twitter_hashtags', $twitter_config->twitter->hashtags);
    }

}
