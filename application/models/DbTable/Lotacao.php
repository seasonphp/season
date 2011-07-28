<?php
/**
 * 
 * 
 * @author Pv
 * @version 
 */

require_once 'Zend/Db/Table/Abstract.php';

class Application_Model_DbTable_Lotacao extends Zend_Db_Table_Abstract {

	/**
	 * The default table name
	 */

	protected $_name = 'lotacao';

	protected $_primary ='idLotacao';

}
?>