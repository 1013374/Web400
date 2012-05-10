<?php

class Application_Plugin_ForceAuth extends Zend_Controller_Plugin_Abstract
{
	private $_whitelist;
	
	function __construct() 
	{
		$this->_whitelist = array(
			'index/index',
			'auth/index',
		  );
		  
	 }
	 
	 function preDispatch (Zend_Controller_Request_Abstract $request)
	 {
		 $controller = strtolower($request->getControllerName());
		 $action = strtolower($request->getActionName());
		 $route = $controller . '/'. $action;
		 
		 if (in_array($route, $this->_whitelist))
		 {
			 return;
		 }
		 
		 $auth = Zend_Auth::getInstance();
		 if($auth->hasIdentity()) {
			 return;
		 }
		 
		 $request->setControllerName('index');
		 $request->setActionName('index');
	 }
 }
