<?php
class Application_Form_Config extends Zend_Form
{
	public function init()
	{
		$id = new Zend_Form_Element_Hidden('id');
		$id->addFilter('Int');
		
		$this->setName('config');

		$nome = new Zend_Form_Element_Text('nome');
		$nome->setLabel('Nome')
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('NotEmpty');
			
		$cnpj = new Zend_Form_Element_Password('cnpj');
		$cnpj->setLabel('CNPJ')
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->setRenderPassword(true)
			->addValidator('NotEmpty');
			
		$endereco = new Zend_Form_Element_Text('endereco');	
		$endereco->setLabel('Endereco')
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim');
			
		$usuario = new Zend_Form_Element_Text('usuario');	
		$usuario->setLabel('Usuario')
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim');
			
		$senha = new Zend_Form_Element_Text('senha');	
		$senha->setLabel('senha')
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim');
		
		$email = new Zend_Form_Element_Text('email');	
		$email->setLabel('E-mail')
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim');
			
		$site = new Zend_Form_Element_Text('site');	
		$site->setLabel('Site')
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim');
		
		$submit = new Zend_Form_Element_Submit('Enviar');
		$submit->setAttrib('id', 'submitbutton');
		
		$this->addElements(array($nome,$cnpj,$endereco,$usuario,$senha,$email,$site,$submit));
	}
}