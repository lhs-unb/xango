<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

	protected $_docRoot;

	protected function _initPath()
	{
		$this->_docRoot = realpath(APPLICATION_PATH . '/../');
		Zend_Registry::set('docRoot', $this->_docRoot);
	}

	protected function _initLoaderResource()
	{
		$resourceLoader = new Zend_Loader_Autoloader_Resource(array(
				'basePath' => $this->_docRoot . '/application',
				'namespace' => 'Xango'
			));
		$resourceLoader->addResourceTypes(array(
			'model' => array(
				'namespace' => 'Model',
				'path' => 'models'
			)
		));
		
		//echo "<pre>";
		//print_r($resourceLoader);
		//die;
	}

	protected function _initLog()
	{
		$writer = new Zend_Log_Writer_Stream(APPLICATION_PATH . '/../data/logs/error.log');
		return new Zend_Log($writer);
	}

	protected function _initView()
	{
		$view = new Zend_View();
		
		return $view;
	}
	
    protected function _initDoctype()
    {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('XHTML1_STRICT');
    }
	
	protected function _initDb() {
		// Only attempt to cache the metadata if we have a cache available
		if (!is_null($this->_cache)) {
			try {
				Zend_Db_Table_Abstract::setDefaultMetadataCache($this->_cache);
			} catch(Zend_Db_Table_Exception $e) {
				print $e->getMessage();
			}
		}
		
		$db = $this->getPluginResource('db')->getDbAdapter();
		 
		// Set the default fetch mode to object throughout the application
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		 
		// Force the initial connection to handle error relating to caching etc.
		try {
			$db->getConnection();
		} catch (Zend_Db_Adapter_Exception $e) {
			// perhaps a failed login credential, or perhaps the RDBMS is not running
				print $e->getMessage();
		} catch (Zend_Exception $e) {
			// perhaps factory() failed to load the specified Adapter class
				print $e->getMessage();
		}
		 
		Zend_Db_Table::setDefaultAdapter($db);
		Zend_Registry::set('db', $db);
		
		return $db;
	}
	
    public function _initSession() {
		Zend_Session::start();
		$session = new Zend_Session_Namespace('XangoSession');
    }
}