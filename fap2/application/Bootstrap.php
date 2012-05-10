<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	public function _initPlugins()
	{
		$this->bootstrap('FrontController');
		$front = $this->getResource('FrontController');
		
		$forceAuth = new Application_Plugin_ForceAuth();
		$checkToken = new Application_Plugin_Checker();
		$checkController = new Application_Plugin_Controller();
		$logger = new Application_Plugin_Logger();
		
		$front->registerPlugin($forceAuth);
		$front->registerPlugin($checkController);
		$front->registerPlugin($checkToken);
		$front->registerPlugin($logger);
	}
	
	public function _initLogger()
	{
		$logger = new Application_Model_Logger();
		$loggerMapper = new Application_Model_LoggerMapper();
		
		Zend_Registry::set('logger', $logger);
		Zend_Registry::set('loggerMapper', $loggerMapper);
	}
		

}

