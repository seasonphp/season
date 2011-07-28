<?php

/**
 * Beneficiario
 * 
 * @author Raphael
 * @version 
 */

require_once 'Zend/Db/Table/Abstract.php';

class Application_Model_DbTable_Beneficiario extends Zend_Db_Table_Abstract {
	/**
	 * The default table name 
	 */
	protected $_name = 'beneficiario';
	protected $_primary ='idBeneficiario';
	
}