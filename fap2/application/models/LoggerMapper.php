<?php

class Application_Model_LoggerMapper
{
	protected $_dbTable;
	
	public function setDbTable($dbTable)
	{
		if (is_string($dbTable)) {
			$dbTable = new $dbTable();
		}
		
		$this->_dbTable = $dbTable;
		return $this;
	}
	
	public function getDbTable()
	{
		if (null == $this->_dbTable) {
			$this->_dbTable = new Application_Model_DbTable_Logger();
		}
		return $this->_dbTable;
	}
	
	public function save(Application_Model_Logger $logger)
	{
		if (!$logger instanceof Application_Model_Logger) {
			return;
		}
		
		$data = array(
			'message' => $logger->getMessage(),
			'team_id' => $logger->getTeam(),
			'team_name' => $logger->getTeamName(),
			'hijacking_team' => $logger->getHijacking(),
			'action' => $logger->getAction(),
			'object_type' => $logger->getObjectType(),
			'object_id' => $logger->getObjectId(),
			'amount' => $logger->getAmount(),
			'created' => date('Y-m-d H:i:s'),
		);
	
		$this->getDbTable()->insert($data);
	}


}

