<?php

class Application_Form_Pesquisa extends Zend_Dojo_Form
{

    public function init()
    {
        $this->setName('frmPesquisa');
		$this->setMethod('post');


		
		$codigo = new Zend_Form_Element_Text('contrato');
		$codigo->setLabel('Contrato')
		   ->setRequired(true)
		   ->addFilter('StripTags')
		   ->addFilter('StringTrim')
		   ->addValidator('NotEmpty');
		   
		   
		   
		 $cpf = new Zend_Form_Element_Text('cnp');
		 $cpf->setLabel('Cpf')
		   ->setRequired(true)
		   ->addFilter('StripTags')
		   ->addFilter('StringTrim')
		   ->addValidator('NotEmpty');  
		   
		$nome = new Zend_Form_Element_Text('nomeBene');
		 $nome->setLabel('Nome')
		   ->setRequired(true)
		   ->addFilter('StripTags')
		   ->addFilter('StringTrim')
		   ->addValidator('NotEmpty');  
		   

		$matricula = new Zend_Form_Element_Text('matricula');
		$matricula->setLabel('Matricula')
		   ->setRequired(true)
		   ->addFilter('StripTags')
		   ->addFilter('StringTrim')
		   ->addValidator('NotEmpty');  
		   
		   
		   
		   
		$submit = new Zend_Dojo_Form_Element_SubmitButton('Pesquisar');

		$this->addElements(array($codigo,$cpf,$nome,$matricula,$submit));   
		   
		
    }


}

