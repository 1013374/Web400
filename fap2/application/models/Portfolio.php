<?php

class Application_Model_Portfolio
{
	protected $_user;
	protected $_stock;
	protected $_amount;
	protected $_owned;
	
	
	public function setUser(Application_Model_User $user)
	{
		if (!$user instanceof Application_Model_User) {
			throw new Exception ("User must be object");
		}
		$this->_user = $user;
	}
	
	public function setStock(Application_Model_Stock $stock) 
	{
		if (!$stock instanceof Application_Model_Stock) {
			throw new Exception ("Stock must be object");
		}
		$this->_stock = $stock;
	}
	
	public function setOwned($owned)
	{
		$this->_owned = $owned;
	}
	
	public function setAmount($amount) 
	{
		$this->_amount = $amount;
	}
	
	public function getUser()
	{
		return $this->_user;
	}
	
	public function getStock()
	{
		return $this->_stock;
	}
	
	public function getOwned()
	{
		return $this->_owned;
	}
	
	public function getAmount($amount)
	{
		return $this->_amount;
	}
			
	public function buy($amount, $commission)
	{	
		//take care of decimal numbers
		if (is_float($amount))
		{
			$amount = 0;
		}
		
		//take care of negatives, but leave room for '--'
		if (substr($amount, 0, 1) == '-')
		{
			$new = (string)$amount;
			$new = substr($new, 1);
			$amount = $new;
		}
		
		$user = $this->getUser();
		$stock = $this->getStock();
		
		$cost = (float)$amount * ($stock->getPrice());
		if($commission == 1) {
			$c = $this->commission($cost);
			$cost = $cost + $c;
		}
		
		if ($cost > ($user->getBalance())) {
			echo "<div id='message'>Insufficient funds.</div>";
			return;
		}
		
		//subtract cost from current user balance, set user balance to new total
		
		$user->setOldBalance($user->getBalance());
		$user->setBalance(($user->getBalance()) - $cost);
		$this->setOwned(($this->getOwned()) + $amount);
		
		//update user balance
		
		$mapper = new Application_Model_UserMapper();
		$mapper->save($user);
		
		//update user stock count
		
		$mapper = new Application_Model_PortfolioMapper();
		$mapper->save($this);
		
		echo "<div id='message'>Charged commission of: $".$c."</div>";
	}
	
	public function sell($amount)
	{
		if (strlen((string)$amount) > 4) {
		   return;
	    }
		
		//take care of decimal numbers
		if (is_float($amount))
		{
			$amount = 0;
		}
		
		//take care of negatives, but leave room for '--'
		if (substr($amount, 0, 1) == '-')
		{
			$new = (string)$amount;
			$new = substr($new, 1);
			$amount = $new;
		}
		//check if trying to sell more stock than owned
		if ($amount > ($this->getOwned())) {
			echo "<div id='message'>Can't sell more than you own.</div>";
			return;
		}
		//determine profit to be made from sales
		$user = $this->getUser();
		$stock = $this->getStock();
		$profit = (float)$amount * ($stock->getPrice());
		
		//add profit to user balance, set user balance to new total
		$user->setOldBalance($user->getBalance());
		$user->setBalance(($user->getBalance()) + $profit);
		$this->setOwned(($this->getOwned()) - $amount);
		//save user balance
		$userMapper = new Application_Model_UserMapper();
		$userMapper->save($user);
		
		//update stock amount for this user
		$portfolioMapper = new Application_Model_PortfolioMapper();
		$portfolioMapper->save($this);
	}
	
	public function commission($cost)
	{
		$interest = 0.10;
		if($cost < 1) {
			$newcost = (string)$cost;
			//strip negative
			$newcost = substr($newcost, 1);
			$interest = 0.75;
			return $commission = $newcost * $interest;
		}
		$commission = $cost * $interest;
		return $commission;
	}
	
	public function transfer(Application_Model_User $from, Application_Model_User $to, $amount)
    {  	
	   	if (substr($amount, 0, 1) == '-')
		{
			$new = (string)$amount;
			$new = substr($new, 1);
			$amount = $new;
		}
		
		if ($amount < 1)
		{
			$new = (string)$amount;
			$amount = substr($new, 0, 3);
		}
       
       if ($amount > (($from->getBalance())/2)) {
            echo "<div id='message'>Can't transfer more than half your balance.</div>";
            return;
       }
       
       if (($from->getID()) == ($to->getID())) {
		   echo "<div id='message'>Can't transfer money to yourself.</div>";
		   return;
	   }
	   
	   if((($to->getBalance()) + $amount) < 0) {
		   echo "<div id='message'>At least show SOME pity.  Can't overdraw other team.  Asshole.</div>";
		   return;
	   }
       
       $from->setBalance(($from->getBalance()) - $amount);
       $to->setBalance(($to->getBalance()) + $amount);
                
       $userMapper = new Application_Model_UserMapper();
       $userMapper->save($from);
       $userMapper->save($to);
   }


	
	
}

