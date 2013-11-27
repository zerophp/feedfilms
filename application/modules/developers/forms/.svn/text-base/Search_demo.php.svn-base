<?php

class Developers_Form_Search extends Zend_Form
{
	
	protected $_zfip;

    public function init()
    {    

    	Zend_Dojo::enableForm($this);
    	$model = new Hotels_Model_Ajax();
        $model->initSessionZfip();
        
        //$this->setMethod('post');
        //$front = Zend_Controller_Front::getInstance();
        //$this->setAction($front->getBaseUrl().'/hotels/index/searching');
        
         $this->_zfip = new Zend_Session_Namespace('Zfip');
        
        $webservice = new Zend_Form_Element_MultiCheckbox('webservice');
		$webservice->setLabel('Webservices:')
						 ->setRequired(true)
						 ->setValue('all')
                         ->addValidator('NotEmpty', true, array('messages'=>array(Zend_Validate_NotEmpty::IS_EMPTY=>'Valor requerido')))
                         ->setmultiOptions(array('all'=>'All', 'th'=>'Transhotel', 'gta'=>'Gta', 'pl'=>'Primera Línea', 'al'=>'Aloja'))
						 ->setAttrib('maxlength', 200)
						 ->setAttrib('size', 1)
						 ;
						 
        
        $pais = new Zend_Form_Element_Select('pais');
		$pais->setLabel('Pais:')
						 ->setRequired(true)
                         ->addValidator('NotEmpty', true, array('messages'=>array(Zend_Validate_NotEmpty::IS_EMPTY=>'Valor requerido')))
                         ->setValue('ES')
                         ->setmultiOptions($this->_selectOptions())
                     	 ->setAttrib('maxlength', 200)
                     	 ->setOptions(array('onChange'=>'javascript:                     	 								
                     	 								/*dojo.byId("pobId").value = dojo.byId("pais").value;*/
                     	 								dijit.byId("pobId").store = close();
                     	 								var sStore = new dojo.data.ItemFileReadStore({url: "/hotels/index/poblationlist/id/" + this.value });
                     	 								dijit.byId("pobId").store = sStore;
                     	 								getAjaxResponse("/hotels/index/setcountry/id/"+dojo.byId("pais").value,"containerID");
                     	 								'))
                         ->setAttrib('size', 1);

                         
		$pobId = new Zend_Dojo_Form_Element_FilteringSelect('pobId');
		$pobId->setLabel('Destino:')
		            ->setAutoComplete(true)		            
		            ->setStoreType('dojo.data.ItemFileReadStore')
		            ->setStoreId('pob')
		            ->setStoreParams(array('url'=>'/hotels/index/poblationlist/','clearOnClose'=>'true'))		            
		            ->setAttrib("searchAttr", "POBLACION")
		            
		            ->setAttrib('onChange', 'javascript:
		            						/*alert("dddd");*/
		            						/*dijit.byId("pobId").store = close();*/
		            						/*new dojo.data.ItemFileReadStore({url: "/hotels/index/poblationlist/id/" + this.value });*/
		            						')		            		            
		            ->setAttrib("hasDownArrow", "true")
		            ->setRequired(true);
				                       
		$entrada = new Zend_Dojo_Form_Element_DateTextBox('entrada');
		$entrada->setLabel('Entrada:')
				->setRequired(true)
				->addValidator('NotEmpty', true, array('messages'=>array(Zend_Validate_NotEmpty::IS_EMPTY=>'Valor requerido')))
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 76)
				->setAttrib('maxlength', 255)
                ->setOptions(array(
                                    'formatLength'   => 'long',
                                    "style"=> "width:200px; height:1.6em",
                                ));
		
        $salida = new Zend_Dojo_Form_Element_DateTextBox('salida');
		$salida->setLabel('Salida:')
				->setRequired(true)
                ->addValidator('NotEmpty', true, array('messages'=>array(Zend_Validate_NotEmpty::IS_EMPTY=>'Valor requerido')))
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->setAttrib('size', 76)
				->setAttrib('maxlength', 255)
                ->setOptions(array(
                                    'formatLength'   => 'long',
                                    "style"=> "width:200px; height:1.6em",
                                ));
		
		$regimen = new Zend_Form_Element_Select('regimen');
		$regimen->setLabel('Régimen:')
                ->setmultiOptions(array('ALL'=>'Cualquiera', 'SA'=>'Solo alojamiento', 'DE'=>'Alojam. y desay.', 'ME'=>'Media pensión', 'PC'=>'Pensió;n completa', 'TI'=>'Todo incluido'))
				->setAttrib('maxlength', 200)
				->setAttrib('size', 1)
				->setRequired(true)
                ->addValidator('NotEmpty', true, array('messages'=>array(Zend_Validate_NotEmpty::IS_EMPTY=>'Valor requerido')));

        $rooms = new Zend_Form_Element_Select('rooms');
		$rooms->setLabel('Habitaciones:')
                ->setmultiOptions(array('1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5', '6'=>'6'))
				->setAttrib('maxlength', 200)
				->setAttrib('size', 1)
				->setRequired(true)
				->setOptions(array('onChange'=>'javascript:
                     	 								getAjaxResponse("/hotels/index/search/rooms/"+dojo.byId("rooms").value,"roomy");
                     	 								'))
                ->addValidator('NotEmpty', true, array('messages'=>array(Zend_Validate_NotEmpty::IS_EMPTY=>'Valor requerido')));

             
        $submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('Buscar');
        
		$numbers = new Zend_Form_SubForm(); 
		//$numbers = new Zend_Dojo_Form_SubForm();
		//$numbers->setMethod('post');
		$numbers->setDecorators(array(
						    'FormElements',
						    array('HtmlTag', array('tag' => 'div')),
						    'Form'
						));
		
			
		$this->addSubForm($numbers, 'numbers');
				
		$this->addElements(array($webservice,$pais,$pobId,$entrada,$salida,
								 $regimen,$rooms,$submit));

    }
    
    
	protected function _selectOptions()
    {
        $sql="SELECT PK_PAIS, PAIS
    	      FROM ter_paises";
    	$db=Zend_Registry::get('db');
    	$result = $db->fetchPairs($sql);
    	return $result;
    }
    
	public function addRooms($num_rooms)
    {
		$numbers = new Zend_Form_SubForm();
		$numbers->setIsArray(true);		
		$numbers->setAttribs(array(
			'name'   => 'rooms'
//			'legend' => 'Rooms',
//			'dijitParams' => array(
//					'title' => 'Rooms',
//					'id'=>'rooms'
//				),
			)); 
		$numbers->removeDecorator('FieldSet');

        $rooms = new Zend_Form_Element_Select('rooms');
		$rooms->setLabel('Habitaciones:')
                ->setmultiOptions(array('1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5'))
				->setAttrib('maxlength', 200)
				->setAttrib('size', 1)
				->setRequired(true)
				->setOptions(array('onChange'=>'javascript:Searchhotels__DoRooms();'))
                ->addValidator('NotEmpty', true, array('messages'=>array(Zend_Validate_NotEmpty::IS_EMPTY=>'Valor requerido')))
				->setDecorators(array(
					'ViewHelper',
					'Description',
					'Errors',
					array(array('data'=>'HtmlTag'), array('tag' => 'dd')),
					array('Label', array('tag' => 'dt')),
					array(array('row'=>'HtmlTag'),array('tag'=>'div','style'=>'width:100px;float:left;','id'=>'div_rooms'))
				));
		$numbers->addElements(array($rooms));

		$roomgroupheader=new Default_Model_Xhtmls("roomgrouphead");
		$roomgroupheader->setContent("<div style='float:left'>");
		$roomgroupfooter=new Default_Model_Xhtmls("roomgroupfooter");
		$roomgroupfooter->setContent("</div><div style='clear:both; height:15px'></div>");

		$numbers->addElements(array($roomgroupheader));
		
    	for ($a=1; $a<=$num_rooms; $a++)
		{			
			
/*        	$datrooms = new Zend_Form_SubForm();
			$datrooms->setIsArray(true);		
			$datrooms->setAttribs(array(
				'name'   => 'rooms',
				'legend' => 'Rooms'.(string)$a,
				'dijitParams' => array(
						'title' => 'Rooms',
						'id'=>'rooms'
					),
				));*/

			$roomnumber= new Default_Model_Xhtmls("room".$a);
			$roomnumber->setContent("<div style='clear:both;float:left;width:80px'><b>hab. ".$a."</b></div>");
		
 			$adults = new Zend_Form_Element_Select('adults'.(string)$a);
			$adults->setLabel('Adultos:')
                ->setmultiOptions(array('1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5', '6'=>'6'))
				->setAttrib('maxlength', 200)
				->setAttrib('size', 1)
				->setRequired(true)				
                ->addValidator('NotEmpty', true, array('messages'=>array(Zend_Validate_NotEmpty::IS_EMPTY=>'Valor requerido')))
				->setDecorators(array(
					'ViewHelper',
					'Description',
					'Errors',
					array(array('data'=>'HtmlTag'), array('tag' => 'dd')),
					array('Label', array('tag' => 'dt')),
					array(array('row'=>'HtmlTag'),array('tag'=>'div','style'=>'width:80px;float:left;','id'=>'div_adults'))
				));				
			
            $childs = new Zend_Form_Element_Select('childs'.(string)$a);
			$childs->setLabel('Niños:')
                ->setmultiOptions(array('1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5', '6'=>'6'))
				->setAttrib('maxlength', 200)
				->setAttrib('size', 1)
				->setRequired(true)
//				->setOptions(array('onChange'=>'javascript:
//                     	 								getAjaxResponse("/hotels/index/search/rooms/"+dojo.byId("rooms").value,"roomy");
//                     	 								'))
                ->addValidator('NotEmpty', true, array('messages'=>array(Zend_Validate_NotEmpty::IS_EMPTY=>'Valor requerido')))
				->setDecorators(array(
					'ViewHelper',
					'Description',
					'Errors',
					array(array('data'=>'HtmlTag'), array('tag' => 'dd')),
					array('Label', array('tag' => 'dt')),
					array(array('row'=>'HtmlTag'),array('tag'=>'div','style'=>'width:80px;float:left;','id'=>'div_adults'))
				));				
			
//            $datrooms->addElements(array($adults,$childs));
//            $numbers->addSubForm($datrooms, 'datroom'.(string)$a);
            $numbers->addElements(array($roomnumber,$adults,$childs));
								 
		}		
		$numbers->addElements(array($roomgroupfooter));		
		echo $numbers;
    }
    

		
}