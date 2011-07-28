<?php

/**
 * 
 * 
 * @author Pv
 * @version 
 */

require_once 'Zend/Db/Table/Abstract.php';

class Application_Model_DbTable_Telefone extends Zend_Db_Table_Abstract {
	/**
	 * The default table name 
	 */
	protected $_name = 'telefone';
	protected $_primary ='idTelefone';

}

?>
