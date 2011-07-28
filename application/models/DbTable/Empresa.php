<?php



/**

 * 

 * 

 * @author Pv

 * @version 

 */



require_once 'Zend/Db/Table/Abstract.php';



class Application_Model_DbTable_Empresa extends Zend_Db_Table_Abstract {

	/**

	 * The default table name 

	 */

	protected $_name = 'empresa';

	protected $_primary ='id';



}



?>

