<?php

class AuthController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function loginAction()
    {
		//instancia o formulario de login
		$form = new Application_Form_Login();
		
        if ($this->getRequest()->isPost()) {
   		    $formData = $this->getRequest()->getPost();
			if ($form->isValid($formData)) {
			
			 /**
         * Instancia o Auth Db Table Adapter
         *
         * Quando se instancia este objeto, precisamos informar as configurações
         * do BD, nome da tabela onde os dados de login estão, o campo do nome
         * do usuário, e o campo da senha na tabela.
         */
		 
				$auth = Zend_Auth::getInstance();
				
				//$conexao = $this->getInvokeArg('bootstrap')->getDb('db2'); 

				//Zend_Db_Table::setDefaultAdapter($conexao);
				
				//$resource = $bootstrap->getPluginResource('multidb');
				//$db1 = $resource->getDb('db1');
				//$db2 = $resource->getDb('db2');

				$auth->clearIdentity();
				
                $dbAdapter = Zend_Registry::get('db');
				
				$adapter = new Zend_Auth_Adapter_DbTable(
								$dbAdapter,
								'empresa',
								'usuario',
								'senha'
								);
								
				// Configura as credencias informadas pelo usuário
				$adapter->setIdentity($form->getValue('txtUserName'));
				$adapter->setCredential($form->getValue('txtPassword'));
	 
	 			// Cria uma instancia de Zend_Auth
	            //$auth = Zend_Auth::getInstance();
				
				// Tenta autenticar o usuário
				$result = $auth->authenticate($adapter);
	            
				
				 /**
				 * Se o usuário for autenticado redireciona para a index e grava seu email,
				 * caso contrário exibe uma mensagem de alerta na página
				 */
				if ($result->isValid()) {
                    $data = $adapter->getResultRowObject((array('id','nome','cnpj','endereco','usuario','senha','email','site','perfil','contratante')));
				   
				 //$data->listacontratos="1,2";  
				    
				 // Armazena os dados do usuário
				$auth->getStorage()->write($data);				
				    
					//echo "Login efetuado com sucesso";
					 $this->_redirect('/');
					
				} else {
                    $this->view->message = 'Usuario/senha invalidos. ERRO';
                }
				
            }
		}
		$this->view->form = $form;
 
    }
    function logoutAction()
	{
		Zend_Auth::getInstance()->clearIdentity();
		$this->_redirect('/');
	}

}



?>