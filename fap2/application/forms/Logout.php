<?php

class Application_Form_Logout extends Zend_Form
{

    public function init()
    {
        $this->setAction('/auth/logout');
		
		$logout = new Zend_Form_Element_Submit('submit');
		$logout->setLabel('Logout');
		$logout->setAttrib('id', 'submitbutton');
		
		$this->addElement($logout);
    }


}

