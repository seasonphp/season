<?php

/**
 * Beneficiario
 * 
 * @author Raphael
 * @version 
 */

require_once 'Zend/Db/Table/Abstract.php';

class Application_Model_DbTable_Unipessoa extends Zend_Db_Table_Abstract {
	/**
	 * The default table name 
	 */

	protected $_name = 'Pessoa';
	protected $_primary ='AutoId';
	
	protected $_dependentTables = array('Application_Model_DbTable_Unibeneficiario');

		
		 public function __construct(){
	    $this->_db = Zend_Registry::get('dbcardio');
		parent::__construct();
	 }	
	
}