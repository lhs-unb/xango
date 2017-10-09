<?php
class TiposAtoController extends Xango_AbstractController {
		
    public function init() {		
        parent::init();
        $this->objTipoAto = new Xango_Model_TipoAto();
		$this->view->title = 'Tipo de Atos';
    }

	function indexAction() {
		$this->view->tipos = $this->objTipoAto->fetchAll(null, "tpa_nome");
	}
	
	function editAction() {	
		$this->lightbox();
		if($id = $this->getRequest()->getParam("id")) {
			$this->view->tipo = $this->objTipoAto->fetchRowById($id)->toArray();
		}
	}
	
	function saveAction() {
		if($this->getRequest()->isPost()) {
			$data = $this->getRequest()->getPost();
			$this->db->beginTransaction();
			try {
				$this->objTipoAto->save($data);	
				$this->db->commit();
				$this->setRedirect('/tipos-ato', 1, 1);		
			} catch (Exception $e) {
				$this->db->rollBack();
				$this->setRedirectException('/tipos-ato', $e);
			}
		}
	}
	
	function deleteAction() {
		if($id = $this->getRequest()->getParam("id")) {
			$this->db->beginTransaction();
			try {
				$this->objTipoAto->deleteById($id);
				$this->db->commit();
				$this->setRedirect('/tipos-ato', 1, 1);		
			} catch (Exception $e) {
				$this->db->rollBack();
				$this->setRedirectException('/tipos-ato', $e);
			}
		}		
	}
}