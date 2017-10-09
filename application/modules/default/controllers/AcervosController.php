<?php
class AcervosController extends Xango_AbstractController {
		
    public function init() {		
        parent::init();
        $this->objAcervo = new Xango_Model_Acervo();
		$this->view->title = 'Acervos';
    }

	function indexAction() {
		$this->view->acervos = $this->objAcervo->fetchAll(null, "acv_nome");
	}
	
	function editAction() {
		$this->lightbox();
		$this->view->acervos = $this->objAcervo->fetchAll();
		if($id = $this->getRequest()->getParam("id")) {
			$this->view->acervo = $this->objAcervo->fetchRowById($id)->toArray();
		}
	}
	
	function saveAction() {	
		if($this->getRequest()->isPost()) {
			$data = $this->getRequest()->getPost();
			if (empty($data['acv_id_pai'])) { unset($data['acv_id_pai']); }
			
			$this->db->beginTransaction();
			try {
				$this->objAcervo->save($data);	
				$this->db->commit();
				$this->setRedirect('/acervos', 1, 1);		
			} catch (Exception $e) {
				$this->db->rollBack();
				$this->setRedirectException('/acervos', $e);
			}
		}
	}
	
	function deleteAction() {
		if($id = $this->getRequest()->getParam("id")) {
			$this->db->beginTransaction();
			try {
				$this->objAcervo->deleteById($id);
				$this->db->commit();
				$this->setRedirect('/acervos', 1, 1);		
			} catch (Exception $e) {
				$this->db->rollBack();
				$this->setRedirectException('/acervos', $e);
			}
		}		
	}
}