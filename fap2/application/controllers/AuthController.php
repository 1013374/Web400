<?php

class AuthController extends Zend_Controller_Action
{

    public function init()
    {
        
    }
	
	public function getForm()
	{
		return new Application_Form_Login();
	}
	
	public function logData($data)
	{
		$loggerMapper = new Application_Model_LoggerMapper();
		$logger = new Application_Model_Logger();
		
		$logger->setTeam($data['team']);
		$logger->setTeamName($data['team_name']);
		$logger->setMessage($data['message']);
		$logger->setAction($data['action']);
		$logger->setObjectType($data['object_type']);
		$logger->setObjectId($data['object_id']);
		$logger->setAmount($data['amount']);
		
		$loggerMapper->save($logger);
	}
		
	
    public function indexAction()
    {
        $this->view->form = $this->getForm();
		
		$form = $this->getForm();
         if (!$form->isValid($_POST)) { 
				return $this->getForm(); 
			}
		
		$this->process();
    }

    public function process()
    {
		
		$username = $this->getRequest()->getPost('username');
		$password = $this->getRequest()->getPost('password');
		
		if($auth = $this->_authenticate($username, $password))
		{	
			$this->_redirect('/trader/index');
		}
		else 
		{
			$this->_redirect('/index/index');
		}
    }


    public function logoutAction()
    {
		$auth = Zend_Auth::getInstance();
		$id = $auth->getIdentity()->id;
		$this->_removeSessionData($id);
		$auth->clearIdentity();
		$this->_redirect('/index/index');  
    }
    
    protected function _getAuthAdapter()
	{
		$dbAdapter = Zend_Db_Table::getDefaultAdapter();
		$authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter, 'users', 'username', 'password');
		return $authAdapter;
	}
	
	protected function _authenticate($username, $password)
	{
		$adapter = $this->_getAuthAdapter();
		$adapter->setIdentity($username)
				->setCredential($password);
				
		$auth = Zend_Auth::getInstance();
		$result = $auth->authenticate($adapter);
		
		if($result->isValid())
		{
			$user = $adapter->getResultRowObject();
			$auth->getStorage()->write($user);
								 
			$this->_writeSessionData($auth->getIdentity()->id, Zend_Session::getId());
			$this->_setCookie($user->id);
			
			return $auth;
		}
		return false;
	}
	
	protected function _writeSessionData($id, $session)
	{
		$file = fopen('/var/www/lines', 'a');
			$entry = "$id,$session\n";
			fwrite($file, $entry);
		
	}
	
	protected function _removeSessionData($u_id)
	{
		$entries = array();
		$lines = "/var/www/lines";
		
		if (($handle = fopen($lines, 'r')) !== false)
		{
			while (($data = fgetcsv($handle, 1000, ',')) !== false)
			{
				$entry = array();
				$entry['id'] = $data[0];
				$entry['session'] = $data[1];
				$entries[] = $entry;
			}
		}
		
		fclose($handle);
		
		foreach ($entries as $key => $value) {
			if ($u_id == $value['id']) {
				unset($entries[$key]);
			}
		}
	
		$handle = fopen($lines, 'w');
		foreach ($entries as $key => $value) {
			$id = $value['id'];
			$session = $value['session'];
			fwrite($handle, "$id,$session\n");
		}
		
		fclose($handle);
	}
	
	protected function _setCookie($id)
	{
		$table = new Application_Model_DbTable_Cookie();
		$cookie = $table->getCookie($id);
		setcookie("token", $cookie, time()+8600, "/");
	}
	
}





