<?php

class Application_Form_Login extends Zend_Dojo_Form
{

    public function init()
    {
        $this->setName('frmLogin');
		$this->setMethod('post');
		$username = new Zend_Dojo_Form_Element_ValidationTextBox('txtUserName');
		$username->setLabel('Usuario: ')->setRequired(true)->setRegExp("[\w\d]*");
		$password = new Zend_Dojo_Form_Element_PasswordTextBox('txtPassword');
		$password->setLabel('Senha: ')->setRequired(true)->setRegExp("[\d\w]*");
		

		$submit = new Zend_Dojo_Form_Element_SubmitButton('Acessar');

		$this->addElements(array($username,$password,$submit));
    }


}

