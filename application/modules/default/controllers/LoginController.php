<?php
class LoginController extends Xango_AbstractController {

    public function init() {
        parent::init();
		$this->objUsuario = new Xango_Model_Usuario();
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
				
				
				// buscar todas a permissões
				$gts_tmp = $this->objUsuario->getGtsByUser($objStorage->usu_id);
				$is_leader = 0;
				$is_monitor = 0;
				
				foreach($gts_tmp as $gt) {
					$gts[$gt->gtr_id] = $gt->aug_papel;
					if($is_leader == 0 && $gt->aug_papel == 1) {
						$is_leader = 1;
						$is_monitor = 1;
					} 
					elseif($is_monitor == 0 && $gt->aug_papel == 2)
						$is_monitor = 1;
				}
				
				$objStorage->gts = $gts;
				$objStorage->is_leader = $is_leader;
				$objStorage->is_monitor = $is_monitor;
								
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