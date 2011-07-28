<?php

/**
 * Processos
 * 
 * @author Ronaldo
 * @version 
 */

require_once 'Zend/Db/Table/Abstract.php';

class Application_Model_DbTable_Noticias extends Zend_Db_Table_Abstract {
	/**
	 * The default table name 
	 */
	protected $_name = 'noticias';
	protected $_primary ='idNoticias';


}

?>
