<?php
/**
 * Created by PhpStorm.
 * User: AULA 4
 * Date: 27/11/13
 * Time: 20:12
 */

class Twitter_IndexController extends Zend_Controller_Action{

    public function init()
    {
        $this->_helper->layout()->setLayout("backend");
    }

    public function indexAction(){

        $options = Zend_Registry::get('twitter_api');
        $accessToken = new Zend_Oauth_Token_Access();
        $accessToken->setToken($options->get('token'));
        $accessToken->setTokenSecret($options->get('tokenSecret'));
        $twitter = new Zend_Service_Twitter(
            array(
                'username' => $options->get('account'),
                'accessToken' => $accessToken,
                'oauthOptions' => array(
                    'consumerKey' => $options->get('consumerKey'),
                    'consumerSecret' => $options->get('consumerKeySecret'),
                )
            )
        );
        $hashtags = Zend_Registry::get('twitter_hashtags');
        $cols = array();
        foreach ($hashtags as $hashtag) {
            $cols[] = $twitter->searchTweets('#' . $hashtag)->toValue();
        }
        $this->view->cols = $cols;
    }
}
