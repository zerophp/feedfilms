<?php

class Application_Form_Login extends Zend_Form
{

    public function init()
    {
        // Set the method for the display form to POST
       $this->setMethod('post')
        	 ->setName('login')
			 ->setDecorators(array(array('ViewScript', array(
		        		'viewScript' => 'forms/_element_form.phtml',
			 			'h2' => "Please Sign in",
			 			'css' => "form-signin"
		        ))));
		
        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('Email')
		        ->setRequired(true)
		        ->addValidator('NotEmpty', true)
		        ->addFilter('StripTags')
		        ->addFilter('StringTrim')
		        ->addValidator('StringLength',false,array(3,200))
		        ->addValidator('emailAddress', true)
		        ->setAttrib('size', 30)
		        ->setAttrib('maxlength', 80)
		        ->setAttrib('placeholder', 'Email...')
		        ->setOptions(array('class'=>'form-control'))
		        ->setDecorators(array(array('ViewScript', array(
		        		'viewScript' => 'forms/_element_text.phtml'
		        ))));
		        ;
     
        $password = new Zend_Form_Element_Password('password');
        $password->setLabel('Password')
        ->setRequired(true)
        ->addValidator('NotEmpty', true)
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
        ->addValidator('StringLength',false,array(3,20))
        ->setAttrib('size', 30)
        ->setAttrib('maxlength', 80)
        ->setAttrib('placeholder', 'Password...')
        ->setOptions(array('class'=>'form-control'))
        ->setDecorators(array(array('ViewScript', array(
		        		'viewScript' => 'forms/_element_text.phtml'
		        ))));
        
        $privateKey = Zend_Registry::get("PrivateKey");
        $publicKey = Zend_Registry::get("PublicKey");
        $recaptcha = new Zend_Service_ReCaptcha($publicKey, $privateKey);
        
        // create the captcha control
        $captcha = new Zend_Form_Element_Captcha('captcha',
        		array('captcha' => 'ReCaptcha',
        				'captchaOptions' => array(
        						'captcha' => 'ReCaptcha',
        						'service' => $recaptcha)));
        
       
       
        $submit = new Zend_Form_Element_Submit('submit');
		$submit->setAttrib('id', 'submitbutton')
				->setDecorators(array(array('ViewScript', array(
				'viewScript' => 'forms/_element_button.phtml'
				))));
		
		$this->addElements(array(
								$email,
								$password,
								$captcha,
								$submit
								)
							);
		
		// And finally add some CSRF protection
		$this->addElement('hash', 'csrf', array(
				'ignore' => true,
		));
    }
  
}
