<?php
/**
 * Relatorio Controller 

 * @author Paulo Victor

 * @version 

 */
require_once 'Zend/Controller/Action.php';


class RelatorioController extends Zend_Controller_Action {


	public function indexAction() {

		$user = Zend_Registry::get('zend_auth_user');
		$contrato = $user->contrato;
		
		$lote = new Application_Model_DbTable_Lote();
		$pdf = new Application_Model_DbTable_Pdf();
		
		$select = $pdf->select();
		$select ->where('contrato = ?', $contrato)
				->order('idPdf desc');
		
		$dado = $pdf->fetchall($select);
		
		$this->view->lotes = $dado;
		
		
	 
	}

}