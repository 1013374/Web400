<?php

class Application_Plugin_Logger extends Zend_Controller_Plugin_Abstract
{
	public function preDispatch(Zend_Controller_Request_Abstract $request)
	{
		$logger = Zend_Registry::get('logger');
		$loggerMapper = Zend_Registry::get('loggerMapper');
		$auth = Zend_Auth::getInstance();
		$params = array();
		
		if($request->isPost()) {
			if($auth->hasIdentity()) {
				$params = $request->getParams();
				
				$logger->setMessage($params['message']);
				$logger->setTeam($auth->getIdentity()->id);
				$logger->setTeamName($auth->getIdentity()->username);
				if (isset($params['team'])) {
					$logger->setHijacking($params['team']);
				}
				$logger->setAction($request->getActionName());
				if (isset($params['id'])) {
					$logger->setObjectId($params['id']);
				}
				
				if (isset($params['users'])) {
					$logger->setObjectId($params['users']);
				}
				
				$logger->setObjectType($request->getControllerName() == 'auth'|| $request->getActionName() == 'transfer' ? "team" : "stock"); 
				
				if (isset($params['amount'])) {
					$logger->setAmount($params['amount']);
				}
				
				$loggerMapper->save($logger);
			}
		}
	}
}
		
