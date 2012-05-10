<?php

class Application_Model_UserMapper
{

	protected $_dbTable;
	
	public function setDbTable($dbTable)
	{
		if (is_string($dbTable)) {
			$dbTable = new $dbTable();
		}
		//if (!$dbTable instanceof Zend_Db_Table_Abstract) {
			//throw new Exception ("Not a table data gateway.");
		//}
		$this->_dbTable = $dbTable;
		return $this;
	}
	
	public function getDbTable()
	{
		if (null == $this->_dbTable) {
			$this->_dbTable = new Application_Model_DbTable_User();
		}
		return $this->_dbTable;
	}
	
	public function find($id, Application_Model_User $user = null)
	{
		
		$result = $this->getDbTable()->find($id);
		if (0 == count($result)) {
			return;
		}
		
		if (null === $user) {
			$user = new Application_Model_User();
		}
		
		$row = $result->current();
		$user->setId($row->id);
		$user->setUsername($row->username);
		$user->setBalance($row->balance);
		$user->setNews($row->news_stream);
		$user->setOldBalance($row->old);
		
		return $user;
	}
	
	public function fetchAll()
	{
		$resultSet = $this->getDbTable()->fetchAll();
		$users = array();
		if(!$resultSet) {
			throw new Exception ("Did not return any users.");
		}
		else {
			foreach ($resultSet as $row) {
				$user = new Application_Model_User();
				$user->setId($row->id);
				$user->setUsername($row->username);
				$user->setBalance($row->balance);
				$user->setNews($row->news_stream);
				$user->setOldBalance($row->old);
				$users[] = $user;
			}
			return $users;
		}
	}
	
	public function save(Application_Model_User $user)
	{
		if (!$user instanceof Application_Model_User) {
			throw new Exception ("Cannot save non-object " . $user);
		}
		
		$data = array(
			'balance' => $user->getBalance(),
			'old' => $user->getOldBalance()
		);
		$where = $this->getDbTable()->getAdapter()->quoteInto('id = ?', $user->getId());
		$this->getDbTable()->update($data, $where);
	}
	
	public function delete(Application_Model_User $user)
	{
		if (!$user instanceof Application_Model_User) {
			return;
		}
		
		$where = $this->getDbTable()->getAdapter()->quoteInto('id = ?', $user->getId());
		$this->getDbTable()->delete($where);
	}
			
	

}

