<?php

class Application_Model_DbTable_Cookie extends Zend_Db_Table_Abstract
{

    protected $_name = 'cookies';
	
	public function getCookie($team)
	{
		$cookie = null;
		$result = $this->find($team);
		$row = $result->current();
		if (isset($row->token)) {
			$cookie = $row->token;
		}
		return $cookie;
	}
	
	public function getId($token)
	{
		$team = null;
		$where = $this->getAdapter()->quoteInto('token = ?', $token);
		$result = $this->fetchAll($where);
		$row = $result->current();
		if (isset($row->id)) {
			$team = $row->id;
		}
		return $team;
	}
		

}

