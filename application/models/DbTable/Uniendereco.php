<?php

/**
 * Beneficiario
 * 
 * @author Raphael
 * @version 
 */

require_once 'Zend/Db/Table/Abstract.php';

class Application_Model_DbTable_Uniendereco extends Zend_Db_Table_Abstract {
	/**
	 * The default table name 
	 */

	protected $_name = 'EnderecoPessoa';
	protected $_primary ='AutoId';
	
		
	public function __construct(){
	    $this->_db = Zend_Registry::get('dbcardio');
		parent::__construct();
	}	
	
}