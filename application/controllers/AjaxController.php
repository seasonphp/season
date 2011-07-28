<?php
/**
 * Principal Controller 

 * @author Raphael Valério

 * @version 

 */
require_once 'Zend/Controller/Action.php';


class AjaxController extends Zend_Controller_Action {


	public function indexAction() {

	 
	}
	
	private function removePonto($string) {
		$a = array('.','-');
		return str_replace($a,'',$string);
		//return preg_replace( '#[^0-9]#', '', $string );
	}
	
	public function testacpfAction(){
	
		$user = Zend_Registry::get('zend_auth_user');
        if ( $user==null or @$user->contrato==null ) exit;
		
		$request = $this->getRequest();
		
		$beneficiario   = new Application_Model_DbTable_Beneficiario();
		$pessoa			= new Application_Model_DbTable_Unipessoa();
		
		$cnp 		= $this->removePonto($request->getParam('Cnp'));
		$contrato 	= $user->contrato;
		
		/*NOSSO BANCO*/
		$select = $beneficiario->select();
		$select ->where('Cnp = ?',$cnp)
				->where('Contrato = ?',$contrato);
		
		$resultado = $beneficiario->fetchAll($select);
		
		/*BANCO UNIMED*/
		$select = $pessoa->select();
		$select ->setIntegrityCheck(false);
		$select	->from(array('p' => 'Pessoa'),array())
				->join(array('b' => 'Beneficiario'),'b.pessoa = p.autoid',array('*'))
				->where('Cnp = ?',$cnp)
				->where('Contrato = ?',$contrato);
		
		$resultadoUni = $pessoa->fetchAll($select);
		
		if($resultado->count() > 0 or $resultadoUni->count() > 0){
			
		}else{
			echo '1';
		}
		exit;
		
	}
	
	public function testardpAction(){
	
		$user = Zend_Registry::get('zend_auth_user');
		$contrato = $user->contrato;
	
		//TESTE DE RDP 
		$beneficiario = new Application_Model_DbTable_Beneficiario();
		
		//BD UNIMED 
		$unibeneficiario = new Application_Model_DbTable_Unibeneficiario();
		
		//pegando parametros enviados
	    $request = $this->getRequest();
		
		//familia
		$familia = $request->getParam('Familia');
		
		
		
		//PEGA O IDBENEFICIARIO
		$select = $beneficiario->select();
		$select	->where('RDP = ?', $request->getParam('RDP'))
				->where('Familia = ?', $familia)
				->where('Contrato = ?', $contrato);
				
		$select_uni = $unibeneficiario->select();
		$select_uni ->where('RDP = ?',$request->getParam('RDP'))
					->where('Familia = ?', $familia)
					->where('Contrato = ?', $contrato);
				
		$select1 = $beneficiario->fetchall($select);		
		$select2 = $unibeneficiario->fetchall($select_uni);
		
		if($select1->count() >= 1 or $select2->count() >= 1){
		echo "1" ;
		}
		
		
		exit;
		

	
	
	
	}

}