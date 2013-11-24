<?php 

class Application_Form_Album extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');
		$this->setName('album');
		
		$destination=realpath($_SERVER['DOCUMENT_ROOT']);
		
		
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
				->addValidator('StringLength',false,array(3,20))
				->setAttrib('size', 30)
				->setAttrib('maxlength', 80);
		
		$status = new Zend_Form_Element_Select('status');
		$status->setLabel('Status')
				->setRequired(true)
				->addValidator('NotEmpty', true)
				->setmultiOptions(array('1'=>'Activo', '0'=>'Inactivo'))
				->setAttrib('maxlength', 200)
				->setAttrib('size', 1);
		
		$role_id = new Zend_Form_Element_Select('role_id');
		$role_id->setLabel('Role')
				->setRequired(true)
				->addValidator('NotEmpty', true)
				->setmultiOptions($this->_selectOptions())
				->setAttrib('maxlength', 200)
				->setAttrib('size', 1);
		
		$regimens = new Zend_Form_Element_Radio('regimen');
		$regimens->setLabel('Selecciona un regimen')
				->setMultiOptions(array('1'=>'Activo', '0'=>'Inactivo'))
				->setRequired(true)
				->addValidator('NotEmpty', true);
		
		$artist = new Zend_Form_Element_Text('artist');
		$artist->setLabel('Artist')
				->setRequired(true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty');
		
		$webservice = new Zend_Form_Element_MultiCheckbox('webservice');
		$webservice->setLabel('Webservices:')
				->setRequired(true)
				->setValue('all')
				->addValidator('NotEmpty', true, array('messages'=>array(Zend_Validate_NotEmpty::IS_EMPTY=>'Valor requerido')))
				->setmultiOptions(array('all'=>'All', 'none'=>'None'))
				->setAttrib('maxlength', 200)
				->setAttrib('size', 1);
		
		$title = new Zend_Form_Element_Text('title');
		$title->setLabel('Title')
				->setRequired(true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty');
		
		$description = new Zend_Form_Element_Textarea('description');
		$description->setLabel('Descripción')
						->setRequired(true)
						->addValidator('NotEmpty', true)
						->addFilter('StripTags')
						->addFilter('StringTrim')
						->setAttrib('size', 1);
		
		
		$image = new Zend_Form_Element_File('photo');
		$image->setLabel('Image (512kb size, jpg,png,gif)')
					->addValidator('NotEmpty', true)
					->setDestination($destination)
					->addFilter('StripTags')
					->addFilter('StringTrim')
					->addValidator('NotExists', false, array($destination))
					->addValidator('Count', false, array(1))
					->addValidator('Extension', true, array('jpg,png,gif'))
					->addValidator('Size', false, array(512000));
		
		
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setAttrib('id', 'submitbutton');

		$this->addElements(array($id,
								$artist,
								$title,
								$submit	
		));
	}
	
	
	protected function _selectOptions()
	{
		$result = array(1=>'Admin', 2=>'User', 3=>'Guest');
		return $result;
	}


}