<?php

//Entity

class Application_Model_Entity_Film
{
    protected $_iduser;
    protected $_title;
    protected $_director;
    protected $_id;

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
            throw new Exception('Invalid film property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid film property');
        }
        return $this->$method();
    }

    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            print_r($value). "<br>";
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }

    public function setIduser($iduser)
    {
        $this->_iduser = (int) $iduser;
        return $this;
    }

    public function getIduser()
    {
        return $this->_iduser;
    }
    
    public function setTitle($text)
    {
        $this->_title = (string) $text;
        return $this;
    }

    public function getTitle()
    {
        return $this->_title;
    }
    
    public function setDirector($text)
    {
        $this->_director = $text;
        return $this;
    }

    public function getDirector()
    {
        return $this->_director;
    }

    public function setId($id)
    {
        $this->_id = (int) $id;
        return $this;
    }

    public function getId()
    {
        return $this->_id;
    }
}

