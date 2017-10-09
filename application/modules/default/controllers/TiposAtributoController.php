<?php
class TiposAtributoController extends Xango_AbstractController {
		
    public function init() {		
        parent::init();
        $this->objTipoAtributo = new Xango_Model_TipoAtributo();
		$this->view->title = 'Tipos de Atributos';
    }

	function indexAction() {
		$this->view->tipos = $this->objTipoAtributo->fetchAll(null, "ttr_nome");
	}
	
	function editAction() {	
		$this->lightbox();
		if($id = $this->getRequest()->getParam("id")) {
			$this->view->tipo = $this->objTipoAtributo->fetchRowById($id)->toArray();
		}
	}
	
	function saveAction() {
		if($this->getRequest()->isPost()) {
			$data = $this->getRequest()->getPost();
			$this->db->beginTransaction();
			try {
				$this->objTipoAtributo->save($data);	
				$this->db->commit();
				$this->setRedirect('/tipos-atributo', 1, 1);		
			} catch (Exception $e) {
				$this->db->rollBack();
				$this->setRedirectException('/tipos-atributo', $e);
			}
		}
	}
	
	function deleteAction() {
		if($id = $this->getRequest()->getParam("id")) {
			$this->db->beginTransaction();
			try {
				$this->objTipoAtributo->deleteById($id);
				$this->db->commit();
				$this->setRedirect('/tipos-atributo', 1, 1);		
			} catch (Exception $e) {
				$this->db->rollBack();
				$this->setRedirectException('/tipos-atributo', $e);
			}
		}		
	}
}