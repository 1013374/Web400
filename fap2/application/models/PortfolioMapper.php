<?php

class Application_Model_PortfolioMapper
{
	
	protected $_dbtable;
	
	public function setDbTable($dbTable)
	{
		if (is_string($dbTable)) {
			$dbTable = new $dbTable();
		}
		if (!$dbTable instanceof Zend_Db_Table_Abstract) {
			throw new Exception ("Not a table data gateway.");
		}
		$this->_dbtable = $dbTable;
		return $this;
	}
	
	public function getDbTable()
	{
		if (null === $this->_dbtable) {
			$this->setDbTable('Application_Model_DbTable_Portfolio');
		}
		return $this->_dbtable;
	}
	
	public function fetchAll(Application_Model_User $user)
	{
		if (!$user instanceof Application_Model_User) {
			throw new Exception ("Must pass object");
		}
		$stockMapper = new Application_Model_StockMapper();
		$portfolios = array();
		$sql = "SELECT * FROM stocks_owned WHERE u_id = ?";
		$bind = (array)$user->getId();
		$resultSet = $this->getDbTable()->getAdapter()->fetchAll($sql, $bind);
		//var_dump($resultSet);
		foreach ($resultSet as $row) //$row['u_id'], $row['s_id'], $row['amount'] 
		{
			$portfolio = new Application_Model_Portfolio();
			$portfolio->setUser($user);
			$portfolio->setStock($stockMapper->find($row['s_id'], $stock = new Application_Model_Stock()));
			$portfolio->setOwned($row['amount']);
			$portfolios[] = $portfolio;
		}
		return $portfolios;
	}
	
	public function getPortfolio($user, $stock)
	{
		if (!$user instanceof Application_Model_User || !$stock instanceof Application_Model_Stock) {
			exit;
		}
		
		$result = $this->getDbTable()->find($user->getId(), $stock->getId());
		
		$row = $result->current();
		$portfolio = new Application_Model_Portfolio();
		$portfolio->setUser($user);
		$portfolio->setStock($stock);
		if (isset($row->amount)) {
			$portfolio->setOwned($row->amount); }
		return $portfolio;
	}
	
	public function save(Application_Model_Portfolio $portfolio)
	{
		$result = $this->getDbTable()->find($portfolio->getUser()->getId(), $portfolio->getStock()->getId());
		if (0 === count($result)) {
			$data = array('u_id' => $portfolio->getUser()->getId(), 's_id' => $portfolio->getStock()->getId(), 'amount' => $portfolio->getOwned());
			
			$this->getDbTable()->insert($data);
		}
		else {
			$data = array('amount' => $portfolio->getOwned());
			$where[] = $this->getDbTable()->getAdapter()->quoteInto('u_id = ?', $portfolio->getUser()->getId());
			$where[] = $this->getDbTable()->getAdapter()->quoteInto('s_id = ?', $portfolio->getStock()->getId());
			
			$this->getDbTable()->update($data, $where);
		}
	}
}

