<?php 
class Application_Form_Comment extends Zend_Form
{
	
	const ID_COMMENT 		= "idcomment";
	const ID_USER 			= "iduser";
	const ID_PARENT_COMMENT	= "idparentcomment";
	const ID_FILM 			= "idfilm";
	const BODY 				= "body";
	const RATING 			= "rating";
	const REVIEW 			= "review";
	const DATE_ADD 			= "dateadd";
	const SUBMIT 			= "submit";
	
	public function init()
	{
		$this->setName('comment');
		
		$id = new Zend_Form_Element_Hidden(self::ID_COMMENT);
		$id->addFilter('Int');
		
		//$user = new Zend_Form_Element_Select(self::ID_USER);
		$user = new Zend_Form_Element_Text(self::ID_USER);
		$user->setLabel('User')
			 ->setRequired(true);
		
		//$parentComment = new Zend_Form_Element_Select(self::ID_PARENT_COMMENT);
		$parentComment = new Zend_Form_Element_Text(self::ID_PARENT_COMMENT);
		$parentComment->setLabel('Parent comment');
		
		//$film = new Zend_Form_Element_Select(self::ID_FILM);
		$film = new Zend_Form_Element_Text(self::ID_FILM);
		$film->setLabel('Film')
			 ->setRequired(true);
		
		$body = new Zend_Form_Element_Textarea(self::BODY);
		$body->setLabel('Body')
			 ->setRequired(true)
			 ->addFilter('StripTags')
			 ->addFilter('StringTrim')
			 ->addValidator('NotEmpty');
		
		$options = array();
		for ($i = 1; $i <= 100; $i++)
			$options[] = $i;
		
		$rating = new Zend_Form_Element_Select(self::RATING);
		$rating->setMultiOptions($options)
			   ->setLabel("Rating")
			   ->setRequired(true);
		
		$review = new Zend_Form_Element_Select(self::REVIEW);
		$review->setMultiOptions($options)
			   ->setLabel("Review")
			   ->setRequired(true);
		
// 		$date = new Zend_Form_Element_Text(self::DATE_ADD);
// 		$date->setLabel('Date')
// 			 ->setRequired(true)
// 			 ->addFilter('StripTags')
// 			 ->addFilter('StringTrim')
// 			 ->addValidator('NotEmpty');
		
		$submit = new Zend_Form_Element_Submit(self::SUBMIT);
		$submit->setAttrib('id', self::SUBMIT);
		
		//$this->addElements(array($id, $user, $parentComment, $film, $body, $rating, $review, $date, $submit));
		$this->addElements(array($id, $user, $parentComment, $film, $body, $rating, $review, $submit));
	}
}