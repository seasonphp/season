<?php 
class Application_Form_UploadImage extends Zend_Form
{
    public function init()
    {
        // Seta a action do formulário
        $this->setAction('');
 
        // Seta o método de envio do formulário como POST
        $this->setMethod( Zend_Form::METHOD_POST );
 
        // Seta o enctype do formulário para upload de arquvos
        $this->setEnctype( Zend_form::ENCTYPE_MULTIPART );
 
        // Inicia aqui a criação e configuração do campo file_image
        $file_image   = new Zend_Form_Element_File('file_image');
        $file_image ->setLabel('Selecione a imagem')
                    ->setRequired(true);
                    //->addValidator( new Zend_Validate_File_Extension('jpeg','jpg','gif','png') );
 
        // Inicia aqui a criação e configuração do botão de submit
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Inserir noticia');
		
		
		$titulo = new Zend_Form_Element_Text('titulo');
		$titulo->setLabel('Titulo da noticia')
			->setRequired(true)
			->addFilter('StripTags')
			->addValidator('NotEmpty');		
			
			
		$descricao = new Zend_Form_Element_Text('descricao');
		$descricao->setLabel('Texto completo')
			->setRequired(true)
			->addFilter('StripTags')
			->addValidator('NotEmpty');
 
        // Adiciona os elementos ao formulário
        $this->addElements(array(
			$titulo,
			$descricao,
            $file_image,
            $submit
        ));
    }
}