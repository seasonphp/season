<?php

class AdminController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

	public function indexAction()
	{		
		
		$empresa =  new Application_Model_DbTable_Empresa();
		
		$select = $empresa->select();
		$select->where('id = ?', Zend_Auth::getInstance()->getStorage()->read()->id);
		
		
		
		$request = $this->getRequest();		
		
		if($request->getParam('nome') != null){
			$usuario = array(	"nome" 		=> $request->getParam('nome'),
								"cnpj"		=> $request->getParam('cnpj'),
								"endereco"	=> $request->getParam('endereco'),
								"usuario"	=> $request->getParam('usuario'),
								"email"		=> $request->getParam('email'),
								"site"		=> $request->getParam('site'));
			
			$where = "id = ".$request->getParam('id');
			
			$empresa->update($usuario,$where);
			
			$this->view->mensagem = "Usuario alterado com sucesso";
		}
		
		$this->view->empresa = $empresa->fetchAll($select);
		
    }
	
	public function altsenhaAction()
	{
		$empresa =  new Application_Model_DbTable_Empresa();
	
		//RECEBER O PARAMETRO QUE ALTERA A SENHA 
	    $request = $this->getRequest();
	    
		
		
		$dados = array(	
						"senha" 		=> $request->getParam('senha'),
					);	
					
			
	
			
		$where = "id = ".$request->getParam('id');
			
		$empresa->update($dados,$where);
			
			
	
			
		echo "1";
		exit;
		
		
	
	}
	
}



?>