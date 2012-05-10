<?php

class Application_Form_Transfer extends Zend_Form
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
        $this->setMethod('post');
        $this->setName('transfer');
        
        $hidden = new Zend_Form_Element_Hidden('transfer hash');
        
        $select = new Zend_Form_Element_Select('users');
        
        $amount = new Zend_Form_Element_Text('amount');
        $amount->setLabel('Amount:')
			   ->setAttrib('autocomplete', 'off')
			   ->setDecorators($this->elementDecorators);
			   
		$token = new Zend_Form_Element_Hash('token');
        $token->setSalt(md5(uniqid(rand(), TRUE)));
        $token->setTimeout(60);
        $this->addElement($token);
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Transfer')
				->setDecorators($this->elementDecorators)
				->setAttrib('onsubmit', 'getHash(tokens)');
        
        $this->addElements(array($select, $amount, $submit, $hidden));
    }


}

