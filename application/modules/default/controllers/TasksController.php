<?php
class TasksController extends Xango_AbstractController {

    public function init() {
		$this->debug = true;

		parent::init();
        $this->objFonte = new Xango_Model_Fonte(); 
        $this->objTask = new Xango_Model_Task();
		$this->view->title = 'Tarefas';
	}

	function indexAction() {
		die("error");
	}
	function docAction() {
		$this->lightbox();
		if($id = $this->getRequest()->getParam("id")) {
			$this->view->users = $this->objFonte->setUsersGroup($id);
			$this->view->doc = $id;
		}
	}
	
	function docSaveAction() {
		if($this->getRequest()->isPost()) {
			$data = $this->getRequest()->getPost();
			
			$this->db->beginTransaction();
			try {
				$data['tar_status'] = 1;
				$data['tar_ordem'] = 0;
				$data['tar_alteracao'] =  new Zend_Db_Expr("NOW()");
				$data['usu_id_mandante'] = $this->user->usu_id;
	
				$this->objTask->save($data);
				$this->db->commit();
				$this->setRedirect('/fontes/transcription/id/'. $data['ftn_id'], 1, 1);
			} catch (Exception $e) {
				$this->db->rollBack();
				$this->setRedirectException('/fontes', $e);
			}
		}
	
	}
	
	function startAction() {
		if($id = $this->getRequest()->getParam("id")) {
			$this->db->beginTransaction();
			try {
				
				$data['tar_id'] = $id;
				$data['tar_status'] = 4;
				$data['tar_alteracao'] =  new Zend_Db_Expr("NOW()");
				
				$task = $this->objTask->fetchRowById($data['tar_id'])->toArray();
	
				$this->objTask->save($data);
				$this->db->commit();
				$this->setRedirect('/fontes/transcription/id/'. $task['ftn_id'], 1, 1);
			} catch (Exception $e) {
				$this->db->rollBack();
				$this->setRedirectException('/fontes', $e);
			}
		}		
	}
	
	function approveAction() {
		if($id = $this->getRequest()->getParam("id")) {
			$this->db->beginTransaction();
			try {
				
				$data['tar_id'] = $id;
				$data['tar_status'] = 2;
				$data['tar_alteracao'] =  new Zend_Db_Expr("NOW()");
				
				$task = $this->objTask->fetchRowById($data['tar_id'])->toArray();
	
				$this->objTask->save($data);
				$this->db->commit();
				$this->setRedirect('/fontes/transcription/id/'. $task['ftn_id'], 1, 1);
			} catch (Exception $e) {
				$this->db->rollBack();
				$this->setRedirectException('/usfontesuarios', $e);
			}
		}		
	}
	
	function cancelAction() {
		if($id = $this->getRequest()->getParam("id")) {
			$this->db->beginTransaction();
			try {
				
				$data['tar_id'] = $id;
				$data['tar_status'] = 3;
				$data['tar_alteracao'] =  new Zend_Db_Expr("NOW()");
				
				
				$task = $this->objTask->fetchRowById($data['tar_id'])->toArray();
	
				$this->objTask->save($data);
				$this->db->commit();
				$this->setRedirect('/fontes/transcription/id/'. $task['ftn_id'], 1, 1);
			} catch (Exception $e) {
				$this->db->rollBack();
				$this->setRedirectException('/usfontesuarios', $e);
			}
		}		
	}
}