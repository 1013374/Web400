<?php

class Application_Form_Login extends Zend_Form
{
	public $elementDecorators = array(
		'ViewHelper',
		'Description',
		'Errors',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td')),
		array(array('row'=>'HtmlTag'),array('tag'=>'tr'))
    );

    public $buttonDecorators = array(
        'ViewHelper',
        array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'element')),
        array(array('label' => 'HtmlTag'), array('tag' => 'td', 'placement' => 'prepend')),
        array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
	);
	
    public function init()
    {
		$this->setName('login')
             ->setMethod('post');
            
        $token = new Zend_Form_Element_Hash('token');
        $token->setSalt(md5(uniqid(rand(), TRUE)));
        $token->setTimeout(60);
        $this->addElement($token);
             
        $username= new Zend_Form_Element_Text('username');
        $username->setLabel('Username')
        		 ->addValidator('Alnum')
        		 ->setAttrib('autocomplete', 'off')
        		 ->setDecorators($this->elementDecorators)
                 ->setRequired(true);
              
        $this->addElement($username);
        
        $password= new Zend_Form_Element_Password('password');
        $password->setLabel('Password')
        		 ->addValidator('Alnum')
        		 ->setAttrib('autocomplete', 'off')
        		 ->setDecorators($this->elementDecorators)
                 ->setRequired(true);
                  
        $this->addElement($password);
        
        $submit= new Zend_Form_Element_Submit('Send');
        $submit->setDecorators($this->elementDecorators);
        $this->addElement($submit);   
    }


}

