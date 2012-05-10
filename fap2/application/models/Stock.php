<?php

class Application_Model_Stock
{

	protected $_id = '';
	protected $_name = '';
	protected $_abbv = '';
	protected $_desc = '';
	protected $_price = '';
	protected $_oldprice = '';
	
	public function setId($id) 
	{
		$this->_id = $id;
	}
	
	public function setName($name)
	{
		$this->_name = $name;
	}
	
	public function setAbbv($abbv) 
	{
		$this->_abbv = $abbv;
	}
	
	public function setDesc($desc)
	{
		$this->_desc = $desc;
	}
	
	public function setPrice($price)
	{
		$this->_price = $price;
	}
	
	public function setOldPrice($price)
	{
		$this->_oldprice = $price;
	}
	
	public function getId()
	{
		return $this->_id;
	}
	
	public function getName()
	{
		return $this->_name;
	}
	
	public function getAbbv()
	{
		return $this->_abbv;
	}
	
	public function getDesc()
	{
		return $this->_desc;
	}
	
	public function getPrice()
	{
		return $this->_price;
	}
	
	public function getOldPrice()
	{
		return $this->_oldprice;
	}
	

}

