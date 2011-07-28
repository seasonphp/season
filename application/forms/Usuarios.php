<?php
class Application_Form_Usuarios extends Zend_Form
{
	public function init()
	{
		$this->setName('usuario');

		$id = new Zend_Form_Element_Hidden('usu_id');
		$id->addFilter('Int');

		$usuario = new Zend_Form_Element_Text('usu_email');
		$usuario->setLabel('Usuario')
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('NotEmpty');

		$nome = new Zend_Form_Element_Text('usu_nome');
		$nome->setLabel('Nome')
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('NotEmpty');
			
		$senha = new Zend_Form_Element_Password('usu_senha');
		$senha->setLabel('Senha')
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('NotEmpty');
			
		$cidade = new Zend_Form_Element_Text('usu_cidade');	
		$cidade->setLabel('Cidade')
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim');
			
		$estado = new Zend_Form_Element_Text('usu_estado');	
		$estado->setLabel('Estado')
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim');
			
	
		
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setAttrib('id', 'submitbutton');
		
		$this->addElements(array($id, $usuario, $nome, $senha, $cidade, $estado, $submit));
	}
}