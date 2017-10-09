<?php
class GruposTrabalhoController extends Xango_AbstractController {

    public function init() {
		parent::init();
        $this->objGrupoTrabalho = new Xango_Model_GrupoTrabalho();
		$this->view->title = 'Grupos de Trabalho';
	}

	function indexAction() {
		$this->view->gts = $this->objGrupoTrabalho->fetchAll(null, "gtr_nome");
	}
	
	function editAction() {
		$this->lightbox();		
		if($id = $this->getRequest()->getParam("id")) {
			$this->view->gt = $this->objGrupoTrabalho->fetchRowById($id)->toArray();
		}
	}
	
	function saveAction() {
		if($this->getRequest()->isPost()) {
			$data = $this->getRequest()->getPost();
			$this->db->beginTransaction();
			
			$data["gtr_individual"] = 1; // TODO
			
			try {
				$this->objGrupoTrabalho->save($data);	
				$this->db->commit();
				$this->setRedirect('/grupos-trabalho', 1, 1);		
			} catch (Exception $e) {				
				$this->db->rollBack();
				$this->setRedirectException('/grupos-trabalho', $e);
			}
		}	
	}
	
	function deleteAction() {
		if($id = $this->getRequest()->getParam("id")) {
			$this->db->beginTransaction();
			try {
				$this->objGrupoTrabalho->deleteById($id);
				$this->db->commit();
				$this->setRedirect('/grupos-trabalho', 1, 1);		
			} catch (Exception $e) {
				$this->db->rollBack();
				$this->setRedirectException('/grupos-trabalho', $e->getCode());
			}
		}		
	}
}