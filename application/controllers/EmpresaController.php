<?php

class EmpresaController extends Zend_Controller_Action
{

	public function init(){
        /* Initialize action controller here */
    }
		
    public function indexAction(){
  		 /*
		if ( ! Zend_Auth::getInstance()->hasIdentity() ){ 
		   $this->_redirect('/auth/login');
		}
		*/
		
    }

	public function configAction(){
		$empresa = new Application_Model_DbTable_Empresa();
		
		$request = $this->getRequest();	
				
			if ($request->getParam('id') != '' ){			   
				$nome = array(	"nome" 			=>$request->getParam('nome'),
								"cnpj"			=>$request->getParam('cnp'),
								"endereco"		=>$request->getParam('endereco'),
								"usuario"		=>$request->getParam('usuario'),
								"senha"			=>$request->getParam('senha'),
								"email"			=>$request->getParam('email'),
								"contratante"	=>$request->getParam('contratante'),
								"site"			=>$request->getParam('site'));
								
				$where = "id = ".$request->getParam('id');
				
				$empresa->update($nome,$where);
				
		   }else{
				$nome = array(	"nome" 			=>$request->getParam('nome'),
								"cnpj"			=>$request->getParam('cnp'),
								"endereco"		=>$request->getParam('endereco'),
								"usuario"		=>$request->getParam('usuario'),
								"senha"			=>$request->getParam('senha'),
								"email"			=>$request->getParam('email'),
								"contratante"	=>$request->getParam('contratante'),
								"site"			=>$request->getParam('site'));
				
				$empresa->insert($nome);
		   }

		
	}
	
	public function jsonusuarioAction(){
	
	
		$empresa = new Application_Model_DbTable_Empresa();
		
		$tab = $empresa->fetchAll();

        $data['page'] = 1;

		$x=0;

		foreach($tab as $id=>$row) {

			$rows[] = array(

				"id" => $row['id'],

				"cell" => array(
					$row['id']
					,$row['nome']
					,$row['cnpj']
					,$row['usuario']
					,$row['senha']
					,$row['email']
					,$row['contratante']
					,$row['site']
				)

			);

			$x++;

			if ($x > 50) break;

		}
		$data['rows'] = $rows;

		echo json_encode($data);

		exit;
		
	}

	public function importarAction(){
	//faz nada
	}
	
	public function empresasAction(){
		
		$dbCardio = Zend_Registry::get('dbcardio');
		
		$select = $dbCardio	->select();
		$select ->from(array('p' => 'Pessoa'), array('p.AutoId','p.Nome','p.NomeReduzido','p.Cnp','p.Url'))  
           		->where('p.tipo = ?', 1)
				->where('p.classe = ?', 3)
				->where('p.AutoId > 660');
	
	
		$tab = $dbCardio->fetchAll($select);
		
		$this->view->teste = $tab;
		
        $data['page'] = 1;
		
		foreach($tab as $id=>$row) {
			$rows[] = array(
				"id" => $row['AutoId'],
				"cell" => array(
					$row['Nome'],
					$row['Cnp'],
					$row['Url'],
				)
			);
		}
		
		$data['rows'] = $rows;

		echo json_encode($data);
		exit;
	
	
	}

	public function adicionarAction(){
	
	$empresa = new Application_Model_DbTable_Empresa();
	
	$pegaId = $this->getRequest();
	$empresaId = $pegaId->getParam('id');
 
        $this->view->empresa = $empresaId;
	
	$dbCardio = Zend_Registry::get('dbcardio');
	
        //PEGANDO DADOS NO DB DO CARDIO
	$select = $dbCardio	->select();
	$select ->from(array('p' => 'Pessoa'), array('p.AutoId','p.Nome','p.NomeReduzido','p.Cnp','p.Url'))  
           	->where('p.AutoId = ?', $empresaId);
	
	$essaEmpresa = $dbCardio->fetchall($select);
	
	foreach($essaEmpresa as $key=>$row) {
            
            $autoid = $row['AutoId'];
            
                $inserir = array(                      
                        "contratante"           => $row['AutoId'],
                        "nome"                  => $row['Nome'],
                        "site"                  => $row['Url'],
                        "usuario" 		=> $autoid,
                        "senha"			=> "unimed");
               
                
                    $select = $empresa->select();
                    $select->where('usuario = ?', $autoid);
                     
                   if($empresa->fetchall($select)->count() > 0){                   
                
                       echo "<b style='color:#f00'>ERRO</b><br> EMPRESA JA EXISTE NO SISTEMA<br> 
                           <br><a href='/empresa/importar' /> CLIQUE PARA VOLTAR </a>";
                       exit;
                       
                       /*
                       $this->view->resultado = '1';
                       $this->_redirect('/empresa/importar');
                        }else{
                        $empresa->insert($inserir);
                         }
                   }
                        *  */

                   
                   
                           
                   }

            }
        

	 
	 $this->view->empresaAtual = $essaEmpresa;
	
	}

	public function enviaAction(){
		// ENVIAR DADOS 
            
            	$request = $this->getRequest();
		
		$login = $request->getParam('id');
                $nome = $request->getParam('nome');
		$email1 = $request->getParam('email1');
		$email2 = $request->getParam('email2');
		$email3 = $request->getParam('email3');
                
                
                require_once 'Zend/Mail.php';


                //criando objeto $email
                $email = new Zend_Mail();
                $email->setBodyHtml('Ola '. $nome . '<br><br>
                        Cadastramento efetuado no sistema Movimentacoes Cadastrais UNIMED 
                        <br><br>
                        <b> Usuario:</b>'.$nome. 
                        '<b> Senha:</b> unimed 
                         <br>
                         Para acessar o sistema <a href="http://empresas.unimedsantos.com.br"> clique aqui</a><br><br>
                         Atenciosamente<br>
                         UNIMED SANTOS');
                
                $email->setFrom('desenvolvimento@unimedsantos.com.br', 'UNIMED SANTOS');
                $email->addTo($email1, $nome);
                $email->setSubject('Cadastramento UNIMED Santos');
                //disparando e-mail
                $email->send();

                
                /*
                 * FORMA ANTIGA
                 
		
		require_once 'Zend/Mail.php';
		require_once 'Zend/Mail/Transport/Smtp.php';
		
		
		$request = $this->getRequest();
		
		$login = $request->getParam('id');
		$email1 = $request->getParam('email1');
		$email2 = $request->getParam('email2');
		$email3 = $request->getParam('email3');
		
		
		$smtp = "smtp.gmail.com";
		$conta = "paverde@gmail.com";
		$senha = "pvseason";
		$de = "paverde@gmail.com";
		$para = "paulo.gomes@seaosn.com.br";
		$assunto = "Teste de envio de email SISTEMA UNIMED.";
		$mensagem = "Isso é apenas um teste de envio utilizando o Zend_Mail().";

			try {
			$config = array (
			'auth' => 'login',
			'username' => $conta,
			'password' => $senha,
			'ssl' => 'ssl',
			'port' => '465'
			);

			$mailTransport = new Zend_Mail_Transport_Smtp($smtp, $config);

			$mail = new Zend_Mail();
			$mail->setFrom($de);
			$mail->addTo($para);
			$mail->setBodyText($mensagem);
			$mail->setSubject($assunto);
			$mail->send($mailTransport);

			echo "Email enviado com SUCESSSO!";
			} catch (Exception $e){
			echo ($e->getMessage());
			}
		
            */
		 
	}
	
}