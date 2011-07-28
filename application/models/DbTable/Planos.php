<?php

/**
 * Processos
 * 
 * @author Ronaldo
 * @version 
 */

require_once 'Zend/Db/Table/Abstract.php';

class Application_Model_DbTable_Planos extends Zend_Db_Table_Abstract {
	/**
	 * The default table name 
	 */
	protected $_name = 'pla_plano';
	protected $_primary ='pla_id';


}

?>
