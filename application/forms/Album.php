<<<<<<< HEAD
<?php
class Application_Form_Album extends Zend_Form
{
 public function init()
 {
 $this->setName('album');
 $id = new Zend_Form_Element_Hidden('id');
 $id->addFilter('Int');
 $artist = new Zend_Form_Element_Text('artist');
 $artist->setLabel('Artist')
 ->setRequired(true)
 ->addFilter('StripTags')
 ->addFilter('StringTrim')
 ->addValidator('NotEmpty');
 $title = new Zend_Form_Element_Text('title');
 $title->setLabel('Title')
 ->setRequired(true)
 ->addFilter('StripTags')
 ->addFilter('StringTrim')
 ->addValidator('NotEmpty');
 $submit = new Zend_Form_Element_Submit('submit');
 $submit->setAttrib('id', 'submitbutton');
 $this->addElements(array($id, $artist, $title, $submit));
 }
=======
<?php 

class Application_Form_Album extends Zend_Form
{
	public function init()
	{
		$this->setName('album');
		
		$id = new Zend_Form_Element_Hidden('id');
		$id->addFilter('Int');
		
		$artist = new Zend_Form_Element_Text('artist');
		$artist->setLabel('Artist')
				->setRequired(true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty');
		
		$title = new Zend_Form_Element_Text('title');
		$title->setLabel('Title')
				->setRequired(true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty');
		
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setAttrib('id', 'submitbutton');
		
		$this->addElements(array($id, $artist, $title, $submit));
	}
>>>>>>> 563200625e36a74adc27e59dfb53c2d1f6d350fc
}