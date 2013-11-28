<?php
/**
 * Created by PhpStorm.
 * User: AULA 4
 * Date: 28/11/13
 * Time: 17:50
 */

class Twitter extends Zend_Form{
    public function init()
    {
        $this->setMethod('post');
        $this->setName('twitter');

        $hashtag = new Zend_Form_Element_Text('hashtag');
        $hashtag->setLabel('Hashtag')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');

        $this->addElements(array($hashtag, $submit));
    }

} 