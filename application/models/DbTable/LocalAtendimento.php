<?php
/**
 * 
 * 
 * @author Pv
 * @version 
 */

require_once 'Zend/Db/Table/Abstract.php';

class Application_Model_DbTable_LocalAtendimento extends Zend_Db_Table_Abstract {

	/**
	 * The default table name
	 */

	protected $_name = 'localatendimento';

	protected $_primary ='idlcat';

}
?>