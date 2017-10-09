<?php
class TiposFuncaoController extends Xango_AbstractController {
		
    public function init() {		
        parent::init();
        $this->objTipoFuncao = new Xango_Model_TipoFuncao();
		$this->view->title = 'Tipos de Função';
    }

	function indexAction() {
		$this->view->tipos = $this->objTipoFuncao->fetchAll(null, "tpf_nome");
	}
	
	function editAction() {	
		$this->lightbox();
		if($id = $this->getRequest()->getParam("id")) {
			$this->view->tipo = $this->objTipoFuncao->fetchRowById($id)->toArray();
		}
	}
	
	function saveAction() {
		if($this->getRequest()->isPost()) {
			$data = $this->getRequest()->getPost();
			$this->db->beginTransaction();
			try {
				$this->objTipoFuncao->save($data);	
				$this->db->commit();
				$this->setRedirect('/tipos-funcao', 1, 1);		
			} catch (Exception $e) {
				$this->db->rollBack();
				$this->setRedirectException('/tipos-funcao', $e);
			}
		}
	}
	
	function deleteAction() {
		if($id = $this->getRequest()->getParam("id")) {
			$this->db->beginTransaction();
			try {
				$this->objTipoFuncao->deleteById($id);
				$this->db->commit();
				$this->setRedirect('/tipos-funcao', 1, 1);		
			} catch (Exception $e) {
				$this->db->rollBack();
				$this->setRedirectException('/tipos-funcao', $e);
			}
		}		
	}
}