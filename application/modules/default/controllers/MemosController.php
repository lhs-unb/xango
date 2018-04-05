<?php
class MemosController extends Xango_AbstractController {

    public function init() {
		$this->debug = true;

		parent::init();
		$this->objMemo = new Xango_Model_Memo();
		$this->view->title = 'Memos';
	}

	function indexAction() {
		die("error");
	}
	
	function editAction() {
		$this->lightbox();
		if($id = $this->getRequest()->getParam("id")) {
			$this->view->memo = $this->objMemo->fetchRowById($id)->toArray();
			$this->view->ftn_id = $this->view->memo['ftn_id'];
		}
		elseif($ftn_id = $this->getRequest()->getParam("ftn_id")) {
			$this->view->ftn_id = $ftn_id;
		}
	}
	
	function saveAction() {	
		if($this->getRequest()->isPost()) {
			$data = $this->getRequest()->getPost();
			$this->db->beginTransaction();
			try {
				$data['mem_descricao'] = nl2br($data['mem_descricao']);
				$data['mem_ordem'] = 0;
				$data['mem_alteracao'] =  new Zend_Db_Expr("NOW()");
				$data['usu_id'] = $this->user->usu_id;
								
				$this->objMemo->save($data);	
				$this->db->commit();
				$this->setRedirect('/fontes/transcription/id/'. $data['ftn_id'], 1, 1);
			} catch (Exception $e) {
				$this->db->rollBack();
				$this->setRedirect('/fontes/transcription/id/'. $data['ftn_id'], 1, 1);
			}
		}
	}
	
	function deleteAction() {
		if($id = $this->getRequest()->getParam("id")) {
			$this->db->beginTransaction();
			try {				
				$data = $this->objMemo->fetchRowById($id)->toArray();
				$this->objMemo->deleteById($id);
				$this->db->commit();
				$this->setRedirect('/fontes/transcription/id/'. $data['ftn_id'], 1, 1);
			} catch (Exception $e) {
				$this->db->rollBack();
				$this->setRedirect('/fontes/transcription/id/'. $task['ftn_id'], 1, 1);
			}
		}		
	}
}