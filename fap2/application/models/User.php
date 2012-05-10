<?php

class Application_Model_User
{

	protected $_id = '';
	protected $_username = '';
	protected $_balance = '';
	protected $_newsfeed = '';
	protected $_oldbalance = '';
	
	public function setId($id) 
	{
		$this->_id = $id;
	}
	
	public function setUsername($username) 
	{
		$this->_username = $username;
	}
	
	public function setBalance($balance)
	{
		$this->_balance = $balance;
	}
	
	public function setNews($news) 
	{
		$this->_newsfeed = $news;
	}
	
	public function setOldBalance($balance)
	{
		$this->_oldbalance = $balance;
	}
	
	public function getId()
	{
		return $this->_id;
	}
	
	public function getUsername()
	{
		return $this->_username;
	}
	
	public function getBalance()
	{
		return $this->_balance;
	}
	
	public function getNews()
	{
		return $this->_newsfeed;
	}
	
	public function getOldBalance()
	{
		return $this->_oldbalance;
	}
	
}

