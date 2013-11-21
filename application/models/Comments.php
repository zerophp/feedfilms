<?php

class Application_Model_Comments
{
    protected $_idcomment;
    protected $_iduser;
    protected $_idparentcomment;
    protected $_idfilm;
    protected $_body;
    protected $_rating;
    protected $_review;
    protected $_dateadd;

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
            throw new Exception('Invalid comments property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid comments property');
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

    public function setIduser($iduser)
    {
        $this->_iduser = (int) $iduser;
        return $this;
    }

    public function getIduser()
    {
        return $this->_iduser;
    }
    
    public function setIdparentcomment($idparent)
    {
    	$this->_idparentcomment = (int) $idparent;
    	return $this;
    }
    
    public function getIdparentcomment()
    {
    	return $this->_idparentcomment;
    }
    
    public function setIdfilm($idfilm)
    {
    	$this->_idfilm = (int) $idfilm;
    	return $this;
    }
    
    public function getIdfilm()
    {
    	return $this->_idfilm;
    }

    public function setBody($body)
    {
        $this->_body = (string) $body;
        return $this;
    }

    public function getBody()
    {
        return $this->_body;
    }

    public function setRating($rating)
    {
    	$this->_rating = (int) $rating;
    	return $this;
    }
    
    public function getRating()
    {
    	return $this->_rating;
    }
    
    public function setReview($review)
    {
    	$this->_review = (int) $review;
    	return $this;
    }
    
    public function getReview()
    {
    	return $this->_review;
    }
    
    public function setDateadd($ts)
    {
        $this->_dateadd = $ts;
        return $this;
    }

    public function getDateadd()
    {
        return $this->_dateadd;
    }

    public function setId($id)
    {
        $this->_idcomment = (int) $id;
        return $this;
    }

    public function getId()
    {
        return $this->_idcomment;
    }
}

