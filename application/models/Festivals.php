<?php

class Application_Model_Festivals
{
    protected $_idfestival;
    protected $_name;
    protected $_description;
    protected $_date;
    protected $_update;
    protected $_create;

    public function __construct(array $options = null)
    {
    	if (is_array($options)) {
    		$this->setOptions($options);
    	}
    }
    
    public function __set($name, $value)
    {
    	$method = 'set' . $name;
    	if (('mapper' == $name) || !method_exists($this, $method)) {
    		throw new Exception('Invalid festival property');
    	}
    	$this->$method($value);
    }
    
    public function __get($name)
    {
    	$method = 'get' . $name;
    	if (('mapper' == $name) || !method_exists($this, $method)) {
    		throw new Exception('Invalid festival property');
    	}
    	return $this->$method();
    }
    
    public function setOptions(array $options)
    {
    	$methods = get_class_methods($this);
    	foreach ($options as $key => $value) {
    		$method = 'set' . ucfirst($key);
    		if (in_array($method, $methods)) {
    			$this->$method($value);
    		}
    	}
    	return $this;
    }
    
    /**
	 * @return the $_idfestival
	 */
	public function getIdfestival() {
		return $this->_idfestival;
	}

	/**
	 * @return the $_name
	 */
	public function getName() {
		return $this->_name;
	}

	/**
	 * @return the $_description
	 */
	public function getDescription() {
		return $this->_description;
	}

	/**
	 * @return the $_date
	 */
	public function getDate() {
		return $this->_date;
	}

	/**
	 * @return the $_date
	 */
	public function getCreate() {
		return $this->_create;
	}

	/**
	 * @return the $_date
	 */
	public function getUpdate() {
		return $this->_update;
	}
	
	/**
	 * @param field_type $_idfestival
	 */
	public function setIdfestival($_idfestival) {
		$this->_idfestival = $_idfestival;
		return $this;
	}

	/**
	 * @param field_type $_name
	 */
	public function setName($_name) {
		$this->_name = $_name;
		return $this;
	}

	/**
	 * @param field_type $_description
	 */
	public function setDescription($_description) {
		$this->_description = $_description;
		return $this;
	}

	/**
	 * @param field_type $_date
	 */
	public function setDate($_date) {
		$this->_date = $_date;
		return $this;
	}

	/**
	 * @param field_type $_date
	 */
	public function setCreate($_date) {
		$this->_create = $_date;
		return $this;
	}

	/**
	 * @param field_type $_date
	 */
	public function setUpdate($_date) {
		$this->_update = $_date;
		return $this;
	}

	public function __toArray() {
		return array(
			'idfestival' => $this->_idfestival,
			'name' => $this->_name,
			'description' => $this->_description,
			'date' => $this->_date,
			'update' => $this->_update,
			'create' => $this->create,
		);
	}
}

