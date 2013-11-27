<?php

class Author_IndexController extends Zend_Controller_Action
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
		
		$this->view->headTitle("Login", 'APPEND');
		$request = $this->getRequest();
		 
		$form    = new Application_Form_Author();
		$form->setName('registration');
	
		if (!$this->getRequest()->isPost()) {
			$this->view->form = $form;
			return;
		} elseif (!$form->isValid($_POST)) {
			$this->view->failedValidation = true;
			$this->view->form = $form;
			return;
		}
		 
		$values = $form->getValues();
	
		// Setup DbTable adapter
		$adapter = new Zend_Auth_Adapter_DbTable(Zend_Registry::get('db'));
		$adapter->setTableName('users');
		$adapter->setIdentityColumn('email');
		$adapter->setCredentialColumn('password');
		$adapter->setIdentity($values['email']);
		$adapter->setCredential(hash('SHA256', $values['password']));
	
		// authentication attempt
		$auth = Zend_Auth::getInstance();
		$result = $auth->authenticate($adapter);
		//$table = new Users_Model_DbTable_Users;
		// authentication succeeded
		if ($result->isValid()) {
			 
			//$status=$adapter->getResultRowObject()->status;
			//Zend_debug::dump($status);
			 
			//if($status==1){
				$auth->getStorage()
				->write($adapter->getResultRowObject(null, 'password'));
				$this->view->passedAuthentication = true;
				//$rowset = $table->fetchRow("email ='".$values['name']."'");
				//$role = new Users_Model_DbTable_Roles;
				//$rowset_role = $role->fetchRow("role_id ='".$rowset['role_id']."'");
	
	
				/*if($rowset_role['prefered_uri']!='0')
				{
					$this->_redirect("http://".$_SERVER['HTTP_HOST'].'/'.$rowset_role['prefered_uri']);
				}
				else
				{
					$this->_redirect("http://".$_SERVER['HTTP_HOST'].'/admin');
				}
				return;*/
				$this->_redirect('/backend');
			//}
			/*else{
				$this->view->statusState = true;
				$this->view->email=$values['name'];
			}*/
		} else { // or not! Back to the login page!
			$this->view->failedAuthentication = true;
			/*$rowset = $table->fetchRow("email ='".$values['name']."' and status=1");
			$rowCount = count($rowset);
			if ($rowCount > 0) {
				//echo "found $rowCount rows";
				$this->view->email=$values['name'];
				$this->view->emailExist = true;
			} else {
				$this->_helper->redirector('index', 'index', 'admin');
			}*/
			$this->_helper->redirector('login', 'index', 'author');
			$this->view->loginForm = $form;
		}
	}
	
	/*
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
	*/

 	public function logoutAction()
    {
    	Zend_Auth::getInstance()->clearIdentity();
    	//Zend_Session::destroy();
        $this->_helper->redirector('index', 'index', 'index');
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


