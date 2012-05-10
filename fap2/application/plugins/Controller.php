<?php

class Application_Plugin_Controller extends Zend_Controller_Plugin_Abstract
{
	private $_whitelist;
	
	public function __construct()
	{
		$this->_whitelistController = array('index', 'auth', 'trader', 'error');
		$this->_whitelistAction = array('index', 'login', 'logout', 'buy', 'sell', 'transfer');
	}
	
	public function preDispatch(Zend_Controller_Request_Abstract $request)
	{
		$controller = $request->getControllerName();
		$action = $request->getActionName();

		if (!in_array($controller, $this->_whitelistController) || !in_array($action, $this->_whitelistAction)) 
		{
			$request::setDispatched(false);
			$request->setControllerName('index');
			$request->setActionName('index');
		}
	}
}
