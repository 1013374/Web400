<?php

class Application_Model_Logger
{
	protected $_message = '';
	protected $_team = '';
	protected $_teamname = '';
	protected $_hijacking = '';
	protected $_action = '';
	protected $_objecttype = '';
	protected $_objectid = '';
	protected $_amount = '';
	
	public function setMessage($message) 
	{
		$this->_message = $message;
	}
	
	public function setTeam($team) 
	{
		$this->_team = $team;
	}
	
	public function setTeamName($name)
	{
		$this->_teamname = $name;
	}
	
	public function setHijacking($team)
	{
		$this->_hijacking = $team;
	}
	
	public function setAction($action)
	{
		$this->_action = $action;
	}
	
	public function setObjectType($objecttype)
	{
		$this->_objecttype = $objecttype;
	}
	
	public function setObjectId($objectid) 
	{
		$this->_objectid = $objectid;
	}
	
	public function setAmount($amount)
	{
		$this->_amount = $amount;
	}
	
	public function getMessage()
	{
		return $this->_message;
	}
	
	public function getTeam()
	{
		return $this->_team;
	}
	
	public function getTeamName()
	{
		return $this->_teamname;
	}
	
	public function getHijacking()
	{
		return $this->_hijacking;
	}
	
	public function getAction()
	{
		return $this->_action;
	}
	
	public function getObjectType()
	{
		return $this->_objecttype;
	}
	
	public function getObjectId()
	{
		return $this->_objectid;
	}
	
	public function getAmount()
	{
		return $this->_amount;
	}

}

