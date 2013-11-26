<?php 

class Application_Form_Author extends Zend_Form
{
	public function init()
	{
		
		
		
		$this->setMethod('post');
		$this->setName('album');

		$id = new Zend_Form_Element_Hidden('id');
		$id->addFilter('Int');

        $email = new Zend_Form_Element_Text('email');
		$email->setLabel('Email')
				->setRequired(true)
				->addValidator('NotEmpty', true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('StringLength',false,array(3,200))
				->addValidator('emailAddress', true)
				->setAttrib('size', 30)
				->setAttrib('maxlength', 80);
		
		$password = new Zend_Form_Element_Password('password');
		$password->setLabel('Password')
				->setRequired(true)
				->addValidator('NotEmpty', true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('StringLength',false,array(6,20))
				->setAttrib('size', 30)
				->setAttrib('maxlength', 80);
		
		
		
		$recaptcha = new Zend_Service_ReCaptcha(
					Zend_Registry::get("recaptcha.public"), 
					Zend_Registry::get("recaptcha.private"));
		
		$captcha = new Zend_Form_Element_Captcha('captcha',
				array(
						'captcha'       => 'ReCaptcha',
						'captchaOptions' => array(
								'captcha' => 'ReCaptcha', 
								'service' => $recaptcha),
						'ignore' => true
				)
		);
		
		
        

        $submit = new Zend_Form_Element_Submit('submit');
		$submit->setAttrib('id', 'submitbutton');

		$this->addElements(array($id,
                                $email,
                                $password,
								$captcha,
                                $submit
		));
		// And finally add some CSRF protection
		$this->addElement('hash', 'csrf', array(
				'ignore' => true,
		));
	}
}