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

        $captcha = new Zend_Form_Element_Captcha('foo', array(
            'label' => "Please verify you're a human",
            'captcha' => 'Figlet',
            'captchaOptions' => array(
                'captcha' => 'Figlet',
                'wordLen' => 6,
                'timeout' => 300,
            ),
        ));

        $submit = new Zend_Form_Element_Submit('submit');
		$submit->setAttrib('id', 'submitbutton');

		$this->addElements(array($id,
                                $email,
                                $password,
								$captcha,
                                $submit
		));
	}
}