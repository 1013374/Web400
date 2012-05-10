<?php

class Application_Plugin_Checker extends Zend_Controller_Plugin_Abstract
{
	public function preDispatch(Zend_Controller_Request_Abstract $request)
	{
		$team = '';
		if (isset($_COOKIE['token'])) {
			$set = $_COOKIE['token'];
		}
		$table = new Application_Model_DbTable_Cookie();
		$auth = Zend_Auth::getInstance();
		$controller = $request->getControllerName();
		$action = $request->getActionName();
		
		if ($auth->hasIdentity()) {
			$team = $auth->getIdentity()->id;
			$real = $table->getCookie($team);
			if ($set !== $real) {
				if(is_null($team = $table->getId($set))) {
					//$request::setDispatched(false);
					//$request->setControllerName($controller);
					//$request->setActionName($action);
					$request->setParam("message", "Improper Token");
					return;
				}
				
				//$requst::setDispatched(false);
				//$request->setControllerName($controller);
				//$request->setActionName($action);
				$request->setParam("message", "Session Hijacked");
				$request->setParam("hijacking_team", $team);
			}
			
			//$request::setDispatched(false);
			//$request->setControllerName($controller);
			//$request->setActionName($action);
			$request->setParam("message", "Regular Transaction");

		}
	}
}
			
			
