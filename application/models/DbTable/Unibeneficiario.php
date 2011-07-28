<?php

/**
 * Beneficiario
 * 
 * @author Raphael
 * @version 
 */

require_once 'Zend/Db/Table/Abstract.php';

class Application_Model_DbTable_Unibeneficiario extends Zend_Db_Table_Abstract {
	/**
	 * The default table name 
	 */

	protected $_name = 'Beneficiario';
	protected $_primary ='AutoId';
	
	
		protected $_referenceMap    = array(
        'Contrato' => array(
            'columns'           => 'Contrato',
            'refTableClass'     => 'Application_Model_DbTable_Unicontrato',
            'refColumns'        => 'AutoId'
        ),
		'Pessoa' => array(
            'columns'           => 'Pessoa',
            'refTableClass'     => 'Application_Model_DbTable_Unipessoa',
            'refColumns'        => 'AutoId'
        ) 		);
		
		 public function __construct(){
	    $this->_db = Zend_Registry::get('dbcardio');
		parent::__construct();
	 }	
	
}