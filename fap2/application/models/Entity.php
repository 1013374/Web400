<?php

class Application_Model_Entity
{

	public function __construct(array $options = null) 
	{
		$methods = get_class_methods($this);
		foreach ($options as $key => $value) {
			$method = 'set' . $key;
			if (in_array($method, $methods)) {
				$this->method($value);
			}
		}
		return $this;
	}
	
	public function toArray() 
	{
		return $this->_data;
	}

	
	public function __isset($name) 
	{
		return isset($this->_data[$name]);
	}
	
	public function __unset($name) 
	{
		if (isset($this->_data[$name])) {
			unset($this->_data[$name]);
		}
	}

}

