<?
class Default_Model_Xhtmls extends Zend_Form_Element
{
	private $_content;

	public function setContent($content)
	{
    	$this->_content = $content;
	}

	public function render(Zend_View_Interface $view = null)
    {
    	if(null !== $view) {
        	$this->setView($view);
		}
        return $this->_content;
	}   
}