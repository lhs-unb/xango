<?php

class Xango_AbstractController extends Zend_Controller_Action {

	//TODO: Criar arquivo de mensagens
	protected $msgs = array(
		00001 => 'Operação realizado com sucesso.',
		00002 => 'Operação não pode ser realizada.',
		00003 => 'Usuário ou senha inválidos.',
		00004 => 'Operação não pode ser realizada pois há dependências atreladas a este objeto.',
		00005 => 'Formato de arquivo inválido. Use apenas arquivos JSON.'
	);
	
	
	public function init() {		
        $this->db = Xango_AbstractModel::getDefaultAdapter();		
		$this->session = new Zend_Session_Namespace('XangoSession');
		
        $this->auth = Zend_Auth::getInstance();
		$this->auth->setStorage(new Zend_Auth_Storage_Session('XangoAuth'));
		
		// Stores post in the variable $data
		$this->data = ($this->getRequest()->isPost()) ? $this->getRequest()->getPost() : false;
		
		// In case of delete action, do not load the layout and the view script
		if($this->getRequest()->getActionName() == "delete") {
			$this->_helper->layout->disableLayout();
			$this->_helper->viewRenderer->setNoRender(true);		
		}
		
		// Load config files
		$this->config = $this->getInvokeArg('bootstrap')->getOptions();
		
		// User information
		$this->user = $this->auth->getIdentity();
		$this->view->user = $this->user;
		
		$this->objUsuario = new Xango_Model_Usuario();
	}
	
	public function preDispatch() {
		if (isset($this->session->system_message)) {
       		$this->view->system_message = $this->session->system_message;
        }
		
        if (!$this->auth->hasIdentity()) {
			if($this->getRequest()->getControllerName() != 'login')
                $this->_redirect('login');
		}
    }

    public function postDispatch() {
        if (isset($this->session->system_message)) {
            unset($this->session->system_message);
        }
    }
	
	/*
	type:
	1 - Success
	2 - Error
	3 - Alert
	4 - Notice
	*/
	public function setRedirect($target, $msg = null, $type = 4) {
		if($msg)
			$this->setSystemMessage($msg, $type);
		
		$this->_redirect($target);
	}
	
	public function setRedirectException($target, $e, $alt = null) {
	
		$code = $e->getCode();
		switch($code) {
			default:
				$msg = 2;
				$msg = $e->getMessage();
				break;
			case '23000': // SQL Integrity violation
				$msg = 4;
				break;
		}
		
		$this->setRedirect($target, $msg, 2);
	}
	
	public function setSystemMessage ($msg, $type = false) {
		if(is_int($msg))
			$msg_text = $this->msgs[$msg];
		else
			$msg_text = $msg;
        
		$this->session->system_message = array('msg' => $msg_text, 'type' => $type);		
		return true;
	}
	
	public function lightbox() {
		$this->_helper->layout->setLayout('lightbox');
	}
	
	public function ajax() {
		$this->_helper->layout->disableLayout();
		$this->_helper->viewRenderer->setNoRender();
	}
}