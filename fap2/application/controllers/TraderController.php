<?php

class TraderController extends Zend_Controller_Action
{
	private $_auth;
	private $_tokens;
	public $message = null;
	public $user;
	public $userMapper;
	public $stockMapper;
	public $portfolioMapper;
	
    public function init()
    {
		$this->initAuth();
		$this->initMappers();
		$this->initModels();
		$this->getSessions();
		$this->checkWinner();
	}
	
	private function initAuth()
    {
		$this->_auth = Zend_Auth::getInstance();
	}
	
	private function initModels()
	{
		if($this->_auth->hasIdentity()) {
        	$this->user = $this->userMapper->find($this->_auth->getIdentity()->id);
  		}
	}
	
	private function initMappers()
	{
		$this->userMapper = new Application_Model_UserMapper();
		$this->stockMapper = new Application_Model_StockMapper();
		$this->portfolioMapper = new Application_Model_PortfolioMapper();
	}

    public function indexAction()
    {
        $this->view->stocks = $this->stockMapper->fetchAll();
		$this->view->portfolios = $this->portfolioMapper->fetchAll($this->user);
		$this->view->user = $this->user;
    }

    public function buyAction()
    {
        $stock = new Application_Model_Stock();
        $stock = $this->stockMapper->find(($this->_getParam('id')), $stock);
        
        $portfolio = $this->portfolioMapper->getPortfolio($this->user, $stock);
		$this->view->portfolio = $portfolio;
                        
        $buyForm = new Application_Form_Stocks();
        $buyForm->submit->setLabel('Buy');
        $this->view->form = $buyForm;
                        
        if($this->_request->isPost()) {
			if($buyForm->isValid($this->_request->getPost())) {
				$formData = $this->_request->getPost();
				$portfolio->buy($formData['amount'], $formData['commission']);
			}
		}
    }

    public function sellAction()
    {
		$stock = new Application_Model_Stock();
        $stock = $this->stockMapper->find(($this->_getParam('id')), $stock);

        $portfolio = $this->portfolioMapper->getPortfolio($this->user, $stock);
        $this->view->portfolio = $portfolio;
                
        $form = new Application_Form_Stocks();
        $form->submit->setLabel('Sell');
        $this->view->form = $form;

        if ($this->_request->isPost()) {
			if($form->isValid($this->_request->getPost())) {
				$formData = $this->_request->getPost();
				$portfolio->sell($formData['amount']);
			}
		}
    }

    public function transferAction()
    {
        $sessions = $this->getSessions();
        $users = $this->userMapper->fetchAll();
        $loggedIn = $this->getLoggedIn($users);	
        $this->view->tokens = $this->_tokens;
        
        $form = $this->getTransferForm($loggedIn);
		$this->view->form = $form;
        		
		 if($this->_request->isPost()){	
			if($form->isValid($this->getRequest()->getPost())) {
				$portfolio = new Application_Model_Portfolio();
				$formData = $this->_request->getPost();
				$to = $this->userMapper->find($formData['users']);
				$portfolio->transfer($this->user, $to, $formData['amount']);
			}
		}
	}
    
	protected function getSessions()
	{
		$sessions = array();
		
		if (($handle = fopen('/var/www/lines', 'r')) !== false) {
			while (($data = fgetcsv($handle, 1000, ',')) !== false) {
				$entry['id'] = $data[0];
				$entry['hash'] = $data[1];
				$sessions[] = $entry;
			}
		}
		$this->_tokens = $sessions;
	}
	
	private function getLoggedIn($users)
	{
		$sessions = $this->_tokens;
		$userIds = array();
        $sessionIds = array();
        $erase = array();
  
        foreach ($users as $user) {
			$userIds[] = $user->getID();
		}
        
        foreach ($sessions as $id => $session) {
			$sessionIds[] = $session['id'];
		}
		
		foreach ($userIds as $id) {
			if(!in_array($id, $sessionIds)) {
				$erase[] = $id;
			}
		}
		
		foreach ($users as $key => $user) {
			foreach ($erase as $id) {
				if($id == $user->getID()) {
					unset($users[$key]);
				}
			}
		}
		
		return $users;
	}
	
	private function getTransferForm($loggedIn)
	{
		$form = new Application_Form_Transfer();
		foreach ($loggedIn as $id => $user) {
			$form->users->addMultiOption($user->getID(), $user->getUsername().", Balance: ".$user->getBalance());
		}
		return $form;
	}
	
	private function checkWinner()
	{
		if ($this->user->getBalance() >= 1000000) {
			$this->view->flag = "FLAG: QnBtbCF6VXF2dzQ1Rml2bG1uJDF1eG1aQnFuaS5UfDA4";
			$this->userMapper->delete($this->user);
		}
	}
		
}







