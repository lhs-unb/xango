<?php
class LoginController extends Xango_AbstractController {

    public function init() {
        parent::init();
    }
	
	public function indexAction() {
		if ($this->data) {
			$authAdapter = new Zend_Auth_Adapter_DbTable($this->db);
			$authAdapter->setTableName('tbl_usuarios')
						->setIdentityColumn('usu_login')
						->setCredentialColumn('usu_senha');
			
			$authAdapter->setIdentity($this->data['usu_login']);
			$authAdapter->setCredential(md5($this->data['usu_senha']));
			
            $result = $this->auth->authenticate($authAdapter);
			
            if ($result->getCode() == Zend_Auth_Result::SUCCESS) {
				$objStorage = $authAdapter->getResultRowObject(null, "usu_senha");
				$this->auth->getStorage()->write($objStorage);				
				$this->_redirect('/');
            }
			else {
				$this->setRedirect('/login', 3, 2);
			}
		}
		
		$this->_helper->_layout->setLayout('login');
	}
	
	public function logoutAction() {
		$this->auth->clearIdentity();
		$this->_redirect('/');
	}
}