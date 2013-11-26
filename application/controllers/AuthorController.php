<?php

class AuthorController extends Zend_Controller_Action
{
	protected $signature;
	protected $time;
	
	public function init()
	{
		$this->view->messages = $this->_helper->flashMessenger->getMessages();
		$this->_helper->layout->setLayout("layout2");
		$this->signature = Zend_Registry::get("signature");
		$this->time = Zend_Registry::get("timeout");
	}

	public function loginAction()
	{
		
		
		Zend_Debug::dump($_POST);
		
		// action body
		$this->_helper->layout->setLayout("layout2");
		$this->view->title="Login";

        $form = new Application_Form_Author();
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $db = $this->_getParam('db');
                $authAdapter = new Zend_Auth_Adapter_DbTable(
                    $db,
                    'users',
                    'email',
                    'password'
                );
                $authAdapter->setIdentity($formData['email'])->setCredential( $formData['password']);
                $auth = Zend_Auth::getInstance();
                $result = $auth->authenticate($authAdapter);
                if ($result->isValid()){
                    $this->_helper->FlashMessenger('Succesful login');
                    $this->_helper->redirector->goToSimple('index', 'backend');
                }
                $this->_helper->FlashMessenger('Bad credentials!!!');
            } else {
                $form->populate($formData);
            }
        }

	}

	public function logoutAction()
	{
		$this->render("login");
		 
	}

	public function registerAction()
	{
		$form = new Application_Form_Register();	
		
		
		
		if ($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
		
			if ($form->isValid($formData))
			{
				$userdata = new Application_Model_User();
				$userdata->setEmail($form->getValue('email'));
				$userdata->setPassword($form->getValue('password'));
				$userdata->setDisplay_name($form->getValue('display_name'));
				$userdata->setState($form->getValue('state'));
				//$userdata->setTimestamp($this->time);
				$userdata->setToken($this->setToken($form->getValue('email')));
				$userdata->setIdusertype("1");
				 
				$user = new Application_Model_UserMapper();
				$user->save($userdata);
				$this->sendEmail($userdata);
		
				//$this->_helper->redirector('index');
			} else {
				$form->populate($formData);
			}
		}
		$this->view->form = $form;
		$this->render("register");
	}
	
	private function setToken($email){
		return $token = md5($email.$this->time.$this->signature);
	}
	
	private function sendEmail($user){
		$urlactivate = 'http://feedfilms.local/author/verify/'.$user->getEmail().'/'.$user->getToken();
		$transport = Zend_Registry::get("transport");
		$mail = new Zend_Mail();
		$mail->addTo("alemail04@gmail.com", 'Test');
		
		$mail->setSubject('Activate your account');
		$mail->setBodyText("Activate your account ".$urlactivate);
		$mail->send($transport);
	}


}


