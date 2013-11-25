<?php 

class Application_Form_Festival extends Zend_Form
{
	public function init()
	{
		$this->setName('festival');
		
		$id = new Zend_Form_Element_Hidden('idfestival');
		$id->addFilter('Int');
		
		$name = new Zend_Form_Element_Text('name');
		$name->setLabel('Name')
				->setRequired(true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty');
		
		$description = new Zend_Form_Element_Textarea('description');
		$description->setLabel('Description')
				->addFilter('StringTrim')
				->addValidator('NotEmpty');
		
		$date = new Zend_Form_Element_Text('date');
		$date->setLabel('Date')
				->addFilter('StringTrim')
				->addValidator('date', 'MM/dd/YYYY', array('MM/dd/YYYY'))
				->addValidator('NotEmpty');

		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setAttrib('id', 'submitbutton');
		
		$this->addElements(array($id, $name, $description, $date, $submit));
	}
}
