<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
  		 // action body


	 // se não estiver autenticado tambem não mostra menu
	 if ( ! Zend_Auth::getInstance()->hasIdentity() ){
		  // NAO EXIBE MENU
				$this->_redirect('/auth/login');
		 } else {

		  if ( Zend_Auth::getInstance()->getStorage()->read()->perfil == 'A' ) {
			$this->_redirect('/noticias/index');
			}
		 }


	$this->view->teste = Zend_Auth::getInstance()->getStorage()->read()->contratante;


    }
/*
	if ( ! Zend_Auth::getInstance()->hasIdentity() ){
		   $this->_redirect('/auth/login');
		}
*/
    public function selecionaAction(){
	    $pegaContrato = $this->getRequest();

		$auth = Zend_Auth::getInstance() ;
		$user = $auth->getStorage()->read();

		/*$beneficiario =  new Application_Model_DbTable_Unibeneficiario();
		$select = $beneficiario->select();
		$select ->where('contrato = ?',$pegaContrato->getParam('id'));

		$listaContrato = $beneficiario->fetchAll($select);*/

	   /*if ( in_array($pegaContrato->getParam('id'),$listaContrato) ) {*/
		    $objcontrato =  new Application_Model_DbTable_Unicontrato();
		    $reg = $objcontrato->find($pegaContrato->getParam('id'));
		    $reg = $reg->current();
		    $contrato = $reg['AutoId'];
		    $codigo = $reg['Codigo'];
			$user->contrato = $contrato;
			$user->codigo = $codigo;
			$auth->getStorage()->write($user);

	     	$this->_redirect('/principal');
	   /* }
	    else {
	       $this->_redirect('/index');
	    }*/
    }
	public function jsonprocessoAction(){

		$dbCardio = Zend_Registry::get('dbcardio');

		$empresas = Zend_Auth::getInstance()->getStorage()->read()->contratante;

		$select = $dbCardio	->select()
                                        ->from(array('c' => 'contrato'), array('*'))
                                        ->joinLeft(array('m' => 'ModeloContrato'),'c.modelo = m.AutoId',array('Nome'))
                                        ->where('c.contratante = ?',$empresas)
                                        ->where('not exists( select 1 from suspensaovinculo sv
                                                 where sv.vinculorescindido=1 and sv.Contrato=c.AutoId)');

		$tab = $dbCardio->fetchAll($select);

        $data['page'] = 1;

		foreach($tab as $id=>$row) {
			$rows[] = array(
				"id" => $row['AutoId'],
				"codigo" => $row['Codigo'],
				"cell" => array(
				    //
					#ESSE É O VALOR QUE DEVE SER EXIBIDO
					$row['Codigo'],
					//
					$row['Contratante'],
					$row['Nome']
				)
			);
		}

		$data['rows'] = $rows;

		echo json_encode($data);
		exit;
	}


}