<?php

class User_Model_UserType
{
 
    protected $_idusertype;
    protected $_usertype;


    
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
    		throw new Exception('Invalid user type property');
    	}
    	$this->$method($value);
    }
    
    public function __get($name)
    {
    	$method = 'get' . $name;
    	if (('mapper' == $name) || !method_exists($this, $method)) {
    		throw new Exception('Invalid user type property');
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
	 * @return the $_idusertype
	 */
	public function getIdusertype() {
		return $this->_idusertype;
	}

	/**
	 * @return the $_usertype
	 */
	public function getUsertype() {
		return $this->_usertype;
	}

	/**
	 * @param field_type $_idusertype
	 */
	public function setIdusertype($_idusertype) {
		$this->_idusertype = $_idusertype;
	}

	/**
	 * @param field_type $_usertype
	 */
	public function setUsertype($_usertype) {
		$this->_usertype = $_usertype;
	}

    
   
	

   
}

