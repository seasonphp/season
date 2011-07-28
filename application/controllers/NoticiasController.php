<?php

class NoticiasController extends Zend_Controller_Action
{

	private function dataSql($data){
	   if ($data=="")
	      return null;
	   else	  {
	   $date = DateTime::createFromFormat('d/m/Y', $data);
       return $date->format('Y-m-d');

	   }
	}

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {	
		$noticias 		= new Application_Model_DbTable_Noticias();
		
		$select = $noticias->select();
		$select -> order('idNoticias desc');
		
		$this->view->resultado = $noticias->fetchAll($select);
		
		
    }
	
	public function inserirAction(){
	
	$noticias 		= new Application_Model_DbTable_Noticias();
	
	$request = $this->getRequest();
	
	 // Capturamos aqui o dados enviados via post
     //$data = $this->_request->getPost();
   
     // Instancia o adaptador do Zend para tranferência de arquivos via
     $upload_adapter = new Zend_File_Transfer_Adapter_Http();
     //FORMA ANTIGA CARREGANDO IMG NO APPLICATON $upload_adapter->setDestination( APPLICATION_PATH.'/noticias/imagens' );
	 //FORMA NOVA, CARREGANDO NA PUBLIC
     $upload_adapter->setDestination( 'imagens/noticias/imagens' );
	 
	 //CARREGA NO SERVIDOR
	 $upload_adapter->receive();
  
	//var_dump($upload_adapter); exit;
	 $imagem = basename($upload_adapter->getFileName());
	 
	/*PEGA OS DADOS DO BENEFICIARIO*/
		$inserir = array(	
							"titulo"		=> $request->getParam('titulo'),
							"data"			=> $this->dataSql($request->getParam('data')),
							"descricao"		=> $request->getParam('descricao'),
							"img"			=> "/noticias/imagens/".$imagem,
							);
		

		$cadastraNoticia = $noticias->insert($inserir);
		
		if($cadastraNoticia){
			$this->_redirect('/'); 
		}else{
			echo "<script> alert('ERRO'); </script> ";
		}
	
	}
	
	public function deletaAction(){
		
		$noticias 		= new Application_Model_DbTable_Noticias();
		
		$request = $this->getRequest();
		
		$where = "idNoticias = ". $request->getParam('id');
		
		$arquivo = $request->getParam('img');
		
		if( file_exists( $arquivo ) )
		unlink( $arquivo );

		
		
		$resultado = $noticias->delete($where);
	
		if($resultado){
			echo "<script> alert('ERRO'); </script>";
			$this->_redirect('/'); }
		else{
			echo "<script> alert('ERRO'); </script> " ;
		}

		
	}
	
	public function configAction(){
		$noticias = new Application_Model_DbTable_Noticias();
		
		$request = $this->getRequest();	
		
		if ($this->getRequest()->isPost()) {
			$formData = $this->getRequest()->getPost();
				if ( $request->getParam('idNoticias') != '' ){			   
					$nome = array(	"titulo" 	=>$request->getParam('titulo'),
									"data"		=>$request->getParam('data'),
									"descricao"	=>$request->getParam('descricao'),
									"img"		=>$request->getParam('img'));
									
					$where = "idNoticias = ".$request->getParam('idNoticias');
					
					$noticias->update($nome,$where);
					
			   }else{
					$nome = array(  "idNoticias" =>$request->getParam('idNoticias'),	
									"titulo" 	=>$request->getParam('titulo'),
									"data"		=>$request->getParam('data'),
									"descricao"	=>$request->getParam('descricao'),
									"img"		=>$request->getParam('img'));
									
					$noticias->insert($nome);
			   }
		}
		
	}
	
	
	
	public function jsonnoticiaAction(){
	
		$noticias = new Application_Model_DbTable_Noticias();
		
		$tab = $noticias->fetchAll();

        $data['page'] = 1;

		$x=0;

		foreach($tab as $id=>$row) {

			$rows[] = array(

				"idNoticias " => $row['idNoticias'],

				"cell" => array(
					$row['idNoticias']
					,$row['titulo']
					,$row['data']
					,$row['descricao']
					,$row['img']
				)

			);

			$x++;

			if ($x > 50) break;

		}
		$data['rows'] = $rows;

		echo json_encode($data);

		exit;
		
	}


	public function inserenoticiaAction(){
	
	
		// Instancia o formulário
        $objFormImageUpload = new Application_Form_UploadImage();
		
 
        // Envia para a view
        $this->view->objFormUploadImage = $objFormImageUpload;
 
        // Verifica se foi uma requisição POST
        if( !$this->_request->isPost() )
            return false;
 
        // Capturamos aqui o dados enviados via post
        $data = $this->_request->getPost();
 
        // Verifica se os dados do formulário são válidos
        if( !$objFormImageUpload->isValid($data) )
            return false;
 
        // Instancia o adaptador do Zend para tranferência de arquivos via
        // protocolo Http e definine o destino do arquivo
        $upload_adapter = new Zend_File_Transfer_Adapter_Http();
        $upload_adapter->setDestination( APPLICATION_PATH .'/noticias/imagens' );
 
        if( $upload_adapter->receive() )
            echo 'Upload efetuado com sucesso';
        else
            echo 'Ops! Ocorreu um erro ao enviar o arquivo';
			exit;
	
	}
	
	
}

