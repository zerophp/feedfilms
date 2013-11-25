<?php 
class Decorator_Regimen extends Zend_Form_Decorator_Abstract
{
    public function buildLabel()
    {
        $element = $this->getElement();
        $label = $element->getLabel();
        if ($translator = $element->getTranslator()) {
            $label = $translator->translate($label);
        }
        if ($element->isRequired()) {
            $label .= '';
        }
        $label .= '';
        return $element->getView()
                       ->formLabel($element->getName(), $label);
    }
 
    public function buildInput()
    {
        $element = $this->getElement();
        $helper  = $element->helper;
//        return $element->getView()->$helper(
//            $element->getName(),
//            $element->getValue(),
//            $element->getAttribs(),
//            $element->options
//        );
		$options = $element->getMultiOptions();
		$output='';
		foreach($options as $option){		
			 $output.='<table class="not_selected" border="0" cellspacing="0" cellpadding="0">
			              <tr>
			                <th scope="row">'.$element->getView()->$helper(
		            $element->getName(),
		            '',
		            $element->getAttribs(),
		            array($option[0]=>'')
		        ).'</th>
			                <td><strong>'.$option[1].'</strong><br/>
			                  '.$option[2].'</td>
			                <td><span class="blu">'.$option[3].' €</span></td>
			              </tr>
			            </table>';
		}
		Zend_Debug::dump($options, "view", false);        
        return $output;
    }
 
    public function buildErrors()
    {
        $element  = $this->getElement();
        $messages = $element->getMessages();
        if (empty($messages)) {
            return '';
        }
        return '<div class="errors">' .
               $element->getView()->formErrors($messages) . '</div>';
    }
 
    public function buildDescription()
    {
        $element = $this->getElement();
        $desc    = $element->getDescription();
        if (empty($desc)) {
            return '';
        }
        return '<div class="description">' . $desc . '</div>';
    }
 
    public function render($content)
    {
        $element = $this->getElement();
        if (!$element instanceof Zend_Form_Element) {
            return $content;
        }
        if (null === $element->getView()) {
            return $content;
        }
 
        $separator = $this->getSeparator();
        $placement = $this->getPlacement();
        $label     = $this->buildLabel();
        $input     = $this->buildInput();
        $errors    = $this->buildErrors();
        $desc      = $this->buildDescription();
  		
        $output5='<div class="titleSez">'.$label.'</div>
        			<div class="content_box clearfix">'.$desc.'
          				<div id="tablas_regimen">';
        $output= $label.$input
                . $errors;
        $output5.='		<div style="clear:both"></div>
					</div>
					<div style="clear:both"></div>
        		</div>';
                
        switch ($placement) {
            case (self::PREPEND):
                return $output . $separator . $content;
            case (self::APPEND):
            default:
                return $content . $separator . $output;
        }
    }
}