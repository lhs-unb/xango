<?php
class TiposVinculoController extends Xango_AbstractController {
		
    public function init() {		
        parent::init();
        $this->objTipoVinculo = new Xango_Model_TipoVinculo();
		$this->view->title = 'Tipos de Vínculo';
    }

	function indexAction() {
		$this->view->tipos = $this->objTipoVinculo->fetchAll(null, "tpv_nome");
	}
	
	function editAction() {	
		$this->lightbox();
		if($id = $this->getRequest()->getParam("id")) {
			$this->view->tipo = $this->objTipoVinculo->fetchRowById($id)->toArray();
		}
	}
	
	function saveAction() {
		if($this->getRequest()->isPost()) {
			$data = $this->getRequest()->getPost();
			$this->db->beginTransaction();
			try {
				$this->objTipoVinculo->save($data);	
				$this->db->commit();
				$this->setRedirect('/tipos-vinculo', 1, 1);		
			} catch (Exception $e) {
				$this->db->rollBack();
				$this->setRedirectException('/tipos-vinculo', $e);
			}
		}
	}
	
	function deleteAction() {
		if($id = $this->getRequest()->getParam("id")) {
			$this->db->beginTransaction();
			try {
				$this->objTipoVinculo->deleteById($id);
				$this->db->commit();
				$this->setRedirect('/tipos-vinculo', 1, 1);		
			} catch (Exception $e) {
				$this->db->rollBack();
				$this->setRedirectException('/tipos-vinculo', $e);
			}
		}		
	}
}