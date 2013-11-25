<?php 
class Decorator_Roomswl extends Zend_Form_Decorator_Abstract
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
		Zend_Debug::dump($options, "options", false);

		$output='';
		$last_quantity=null;
 		$selected=array();
		foreach($options as $option){	
			 $current_quantity=$option[4].$option[5];
			 if($last_quantity==null)
			 	$last_quantity=$current_quantity;
			 	if($current_quantity!=$last_quantity){
			 	$last_quantity=$current_quantity;
			 	$output.="<hr/>";
			 }	
			 // If quantity not cero
			 if($option[6]!=0)
			 	array_push($selected,$option[0]);
			 $output.='<table class="not_selected" width="445" border="0" cellspacing="0" cellpadding="0">
			              <tr>
			                <th scope="row" width="30px">'.$element->getView()->$helper(
		            $element->getName().'['.$current_quantity.']',		// Radio name
		            $selected,											// Radio default value						
		            $element->getAttribs(),								// Radio attibutes
		            array($option[0]=>'')								// Radio label
		        ).'</th>
			                <td width="370"><strong>'.$option[1].'</strong>
			                  '.$option[2].'</td>
			                <td width="70" style="text-align:right"><span class="blu">'.$option[3].' €</span></td>
			              </tr>
			            </table>';
		    
				 
		}
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
        $output5.='</div>
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