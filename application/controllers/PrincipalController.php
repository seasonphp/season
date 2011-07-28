<?php
/**
 * Principal Controller 

 * @author Raphael Valério

 * @version 

 */
require_once 'Zend/Controller/Action.php';


class PrincipalController extends Zend_Controller_Action {


	public function indexAction() {

	$user = Zend_Registry::get('zend_auth_user');
	$noticia = new Application_Model_DbTable_Noticias();
	$beneficiario = new Application_Model_DbTable_Beneficiario();
	
	$select = $noticia->select();
	$select ->order('idNoticias desc')
			->limit(15);
			
	$this->view->teste = $noticia->fetchall($select);
	
	$dbCardio = Zend_Registry::get('dbcardio');
		
	$select_tit = $dbCardio	->select();
	$select_tit ->from(array('b' => 'Beneficiario'), array('b.AutoId'))
            ->where('b.contrato = ? and b.RDP=0', $user->contrato)
			->where('not exists( select 1 from suspensaovinculo sv
                                      where sv.vinculorescindido=1 and sv.Beneficiario=b.AutoId)');


    $tab_tit = $dbCardio->fetchAll($select_tit);
    $tab_tit = count($tab_tit);
    $this->view->tab_tit = $tab_tit;

	$select_dep = $dbCardio	->select();
	$select_dep ->from(array('b' => 'Beneficiario'), array('b.AutoId'))
            ->where('b.contrato = ? and b.RDP<>0', $user->contrato)
			->where('not exists( select 1 from suspensaovinculo sv
                                      where sv.vinculorescindido=1 and sv.Beneficiario=b.AutoId)');

    $tab_dep = $dbCardio->fetchAll($select_dep);
    $tab_dep = count($tab_dep);
    $this->view->tab_dep = $tab_dep;
	
	$select_inat = $dbCardio	->select();
	$select_inat ->from(array('b' => 'Beneficiario'), array('b.AutoId'))
            ->where('b.contrato = ?', $user->contrato)
			->where('exists( select 1 from suspensaovinculo sv
                                      where sv.vinculorescindido=1 and sv.Beneficiario=b.AutoId)');

    $tab_inat = $dbCardio->fetchAll($select_inat);
    $tab_inat = count($tab_inat);
    $this->view->tab_inat = $tab_inat;
	
	$select = $beneficiario->select();
	$select ->where('contrato = ?',$user->contrato)
			->where('status is not null')
			->order('idBeneficiario desc')
			->limit(15);
			
	$this->view->ultima = $beneficiario->fetchAll($select);
	
	/*
	$unicontrato = new Application_Model_DbTable_Unicontrato();
	$reg = $unicontrato->find(6);
	$reg=$reg->current();
	$this->view->contrato =$reg ;

	$this->view->benefs = $reg->findDependentRowset('Application_Model_DbTable_Unibeneficiario');
    */
	 
	}
	
	public function exibenoticiaAction(){
	
		$request = $this->getRequest();
		
	//	$user = Zend_Registry::get('zend_auth_user');
		$noticia = new Application_Model_DbTable_Noticias();
	
		$select = $noticia->select();
		$resultado = $select->where('idNoticias = ?',$request->getParam('noticia'))->limit(1);
		
		$this->view->noticia = $noticia->fetchall($resultado);
		
		
	
	
	}

}