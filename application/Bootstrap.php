<?php

require_once("Sam/Acl/Ini.php");
require_once("Sam/Auth/Plugin.php");
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	public function __construct($application){
		 parent::__construct($application);
		
		
		/* ANTIGA CONEXÃO 
		private function connectDatabase(){
			$resource = $this->getPluginResource('db');
			$db = $resource->getDbAdapter();
			Zend_Registry::set('db',$db);
		} 
		
		
		$resource = $bootstrap->getPluginResource('multidb');
		$db1 = $resource->getDb('db1');
		$db2 = $resource->getDb('db2');
		*/

		$resource = $this->getPluginResource('multidb');
        $resource->init();
	  
		$config = new Zend_Config_Ini(APPLICATION_PATH .'/configs/application.ini','production');
		Zend_Registry::set('config', $config);
		 

		//$db = Zend_Db::factory($config->resources->db);
		//$db = Zend_Db::factory($config->resources->multidb->db1);
		Zend_Registry::set('db', $resource->getDb('db1') );
        Zend_Registry::set('dbcardio', $resource->getDb('db2') );
		
		$acl_ini =  APPLICATION_PATH . '/configs/roles.ini' ;  
        $this->_acl  = new Sam_Acl_Ini($acl_ini) ;
        Zend_Registry::set('zend_acl', $this->_acl);
		
		$front = Zend_Controller_Front::getInstance();		
		$front->registerPlugin(new Sam_Auth_Plugin($this->_acl)) ;  
		
		$this->_auth = Zend_Auth::getInstance() ;
	    
	    $user=null;
		if ($this->_auth->hasIdentity()) {
		   // yes ! we get his role
		   $user = $this->_auth->getStorage()->read() ;
		   $role = $user->perfil ;
		  
		 } else {
		   // no = guest user
		   $role = 'guest';
		 }
		 Zend_Registry::set('zend_auth_user',$user);
	 Zend_Registry::set('role', $role);
		
		

	}


}

