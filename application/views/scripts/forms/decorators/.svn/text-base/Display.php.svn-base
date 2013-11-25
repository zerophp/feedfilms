<?php 

class Decorator_Display extends Zend_Form_Decorator_Abstract
{
    /**
     * Attribs that should be removed prior to rendering
     * @var array
     */
    public $stripAttribs = array(
        'action',
        'enctype',
        'helper',
        'method',
        'name',
    );

    /**
     * Fieldset legend
     * @var string
     */
    protected $_legend;

    /**
     * Default placement: surround content
     * @var string
     */
    protected $_placement = null;

    /**
     * Get options
     *
     * Merges in element attributes as well.
     *
     * @return array
     */
    public function getOptions()
    {        
    	$options = parent::getOptions();    
        if (null !== ($element = $this->getElement())) {
            $attribs = $element->getAttribs();
            $options = array_merge($options, $attribs);
            $this->setOptions($options);
        }
        return $options;
    }

    /**
     * Set legend
     *
     * @param  string $value
     * @return Zend_Form_Decorator_Fieldset
     */
    public function setLegend($value)
    {
        $this->_legend = (string) $value;
        return $this;
    }

    /**
     * Get legend
     *
     * @return string
     */
    public function getLegend()
    {
        $legend = $this->_legend;
        if ((null === $legend) && (null !== ($element = $this->getElement()))) {
            if (method_exists($element, 'getLegend')) {
                $legend = $element->getLegend();
                $this->setLegend($legend);
            }
        }
        if ((null === $legend) && (null !== ($legend = $this->getOption('legend')))) {
            $this->setLegend($legend);
            $this->removeOption('legend');
        }

        return $legend;
    }

    /**
     * Render a fieldset
     *
     * @param  string $content
     * @return string
     */
    public function render($content)
    {
        $element = $this->getElement();
        $view    = $element->getView();
        if (null === $view) {
            return $content;
        }

        $legend        = $this->getLegend();
        $description   = $element->getDescription();
        $attribs       = $this->getOptions();
        $name          = $element->getFullyQualifiedName();
        $class		   = @$attribs['class'];

        $id = $element->getId();
        if (!empty($id)) {
            $attribs['id'] = 'fieldset-' . $id;
        }

        if (null !== $legend) {
            if (null !== ($translator = $element->getTranslator())) {
                $legend = $translator->translate($legend);
            }

            $attribs['legend'] = $legend;
        }

        foreach (array_keys($attribs) as $attrib) {
            $testAttrib = strtolower($attrib);
            if (in_array($testAttrib, $this->stripAttribs)) {
                unset($attribs[$attrib]);
            }
        }

        //return $view->fieldset($name, $content, $attribs);
        
        $output='<div class="titleSez">'.$legend.'</div>
        			<div class="content_box clearfix">'.$description.'
          				<div id="'.$class.'">';
        //$output.= $name.$content.$attribs;
        $output.= $content;
        $output.='		<div style="clear:both"></div>
					</div>
					<div style="clear:both"></div>
        		</div>';
        
        return $output;
    }
}
