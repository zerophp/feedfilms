<?php 

class Application_Form_Film extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');
		$this->setName('film');
	
		
		$id = new Zend_Form_Element_Hidden('id');
		$id->addFilter('Int');
		
		
		
		$user_id = new Zend_Form_Element_Select('iduser');
		$user_id->setLabel('User')
				->setRequired(true)
				->addValidator('NotEmpty', true)
				->setmultiOptions($this->_selectOptions());
		
		$title = new Zend_Form_Element_Text('title');
		$title->setLabel('Title')
				->setRequired(true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty');
		
		
		$director = new Zend_Form_Element_Text('director');
		$director->setLabel('Director')
				->setRequired(true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty');
		
		
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setAttrib('id', 'submitbutton');
		

		$this->addElements(array($id,
								$user_id,
								$title,
								$director,
								$submit	
		));
	}
	
	
	protected function _selectOptions()
	{
		$result = array(1=>'Alex', 2=>'Agustin');
		return $result;
		
		$result = array();
		$usertype = new Application_Model_UserMapper();
		$result=$usertype->fetchAll();
			
			
		return $result;
	}

	
	
	
	
	
	
	
	
	
	
}