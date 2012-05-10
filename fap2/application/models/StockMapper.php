<?php

class Application_Model_StockMapper
{
	protected $_dbTable;
	
	public function setDbTable($dbTable)
	{
		if (is_string($dbTable)) {
			$dbTable = new $dbTable();
		}
		if (!$dbTable instanceof Zend_Db_Table_Abstract) {
			throw new Exception ('Not a table data gateway');
		}
		
		$this->_dbTable = $dbTable;
		return $this;
	}
	
	public function getDbTable()
	{
		if (null === $this->_dbTable) {
			$this->setDbTable('Application_Model_DbTable_Stock');
		}
		
		return $this->_dbTable;
	}
	
	public function find($id, Application_Model_Stock $stock)
	{
		$result = $this->getDbTable()->find($id);
		if (0 == count($result)) {
			return;
		}
		
		$row = $result->current();
		$stock->setId($row->id);
		$stock->setName($row->name);
		$stock->setAbbv($row->abbv);
		$stock->setDesc($row->description);
		$stock->setPrice($row->price);
		
		return $stock;
	}
	
	public function fetchAll()
	{
		$resultSet = $this->getDbTable()->fetchAll();
		$stocks = array();
		if(!$resultSet) {
			return $stocks = "Did not return values";
		}
		else {
		foreach ($resultSet as $row) {
			$stock = new Application_Model_Stock();
			$stock->setId($row->id);
			$stock->setName($row->name);
			$stock->setAbbv($row->abbv);
			$stock->setDesc($row->description);
			$stock->setPrice($row->price);
			$stock->setOldPrice(($row->price) - ($row->old_price));
			$stocks[] = $stock; 
		  }
			return $stocks;
		}
	}

}

