<?php
class FontesController extends Xango_AbstractController {
		
    public function init() {		
        parent::init();
        $this->objFonte = new Xango_Model_Fonte();
        $this->objAcervo = new Xango_Model_Acervo();
		$this->objGrupoTrabalho = new Xango_Model_GrupoTrabalho();
		$this->objTipoAto = new Xango_Model_TipoAto();
		$this->objTipoAtributo = new Xango_Model_TipoAtributo();
		$this->objTipoFuncao = new Xango_Model_TipoFuncao();
		$this->objTipoVinculo = new Xango_Model_TipoVinculo();
		$this->objAto = new Xango_Model_Ato();
		$this->objAtributoAto = new Xango_Model_AtributoAto();
		$this->objAtributoGrupoInformacao = new Xango_Model_AtributoGrupoInformacao();
		$this->objGrupoInformacao = new Xango_Model_GrupoInformacao();
		$this->objVinculo = new Xango_Model_Vinculo();
		$this->objUsuario = new Xango_Model_Usuario();
		
		$this->view->title = 'Fontes';
    }

	function indexAction() {
		$this->view->fontes = $this->objFonte->fetchAll(null, "ftn_nome");
	}
	
	function editAction() {		
		$this->lightbox();
		
		$this->view->gts = $this->objGrupoTrabalho->fetchAll(null, "gtr_nome");
		$this->view->acervos = $this->objAcervo->fetchAll(null, "acv_nome");
		$this->view->redirect = ($redirect = $this->getRequest()->getParam("redirect")) ? $redirect : "index";
		
		if($id = $this->getRequest()->getParam("id")) {
			$this->view->fonte = $this->objFonte->fetchRowById($id)->toArray();
		}		
	}
	
	function saveAction() {
		if($this->getRequest()->isPost()) {
			$data = $this->getRequest()->getPost();
			
			$this->db->beginTransaction();
			if(!isset($data["ftn_status"]))
				$data["ftn_status"] = 1;
			
			$redirect = $data['redirect'];
			unset($data['redirect']);
			
			try {
				$redirect .= "/id/". $this->objFonte->save($data);				
				$this->db->commit();
				$this->setRedirect('/fontes/'. $redirect, 1, 1);		
			} catch (Exception $e) {
				$this->db->rollBack();
				$this->setRedirectException('/fontes'. $redirect, $e);
			}
		}	
	}
	
	function deleteAction() {
		if($id = $this->getRequest()->getParam("id")) {			
			$this->db->beginTransaction();
			try {
				$this->objFonte->deleteById($id);
				$this->db->commit();
				$this->setRedirect('/fontes', 1, 1);		
			} catch (Exception $e) {
				$this->db->rollBack();
				$this->setRedirectException('/fontes', $e);
			}
		}
	}
	
	function transcriptionAction() {
		if($id = $this->getRequest()->getParam("id")) {
			$this->view->fonte = $this->objFonte->getFonteFull($id);
		}	
	}
	
	function atoEditAction() {
		$this->lightbox();
		
		if($ftn_id = $this->getRequest()->getParam("ftn_id"))
			$this->view->ftn_id = $ftn_id;
		if($ato_id = $this->getRequest()->getParam("ato_id"))
			$this->view->ato_id = $ato_id;
		
		$this->view->tipos_ato = $this->objTipoAto->fetchAll(null, "tpa_nome");
		$this->view->tipos_atibuto = $this->objTipoAtributo->fetchAll(null, "ttr_nome");
		$this->view->tipos_funcao = $this->objTipoFuncao->fetchAll(null, "tpf_nome");
		$this->view->tipos_vinculo = $this->objTipoVinculo->fetchAll(null, "tpv_nome");
		
		if($id = $this->getRequest()->getParam("ato_id")) {
			$this->view->ato = $this->objAto->getAtoFull($id);
			$this->view->gis = $this->objGrupoInformacao->getGrupoInformacaoFull($id);
			$this->view->vinculos = $this->objVinculo->getVinculos($id);
		}
	}
	
	function atoSaveAction() {
		$this->ajax();
		if($this->getRequest()->isPost()) {
			$data = $this->getRequest()->getPost();	
			$this->db->beginTransaction();
			try {
				$data['ato_id'] = $this->objAto->save($data);
				$this->db->commit();
				echo json_encode($data);
			} catch (Exception $e) {
				$this->db->rollBack();
				echo "error";
			}
		}
	}
	
	function atoDeleteAction() {
		$this->_helper->viewRenderer->setNoRender();
		if($id = $this->getRequest()->getParam("ato_id")) {			
			$this->db->beginTransaction();
			try {
				$ato = $this->objAto->fetchRowById($id);
								
				$this->objAtributoAto->delete("ato_id = ". $id);
				$this->objVinculo->delete("ato_id = ". $id);
				$this->objAtributoGrupoInformacao->deleteByAto($id);
				$this->objGrupoInformacao->delete("ato_id = ". $id);
				$this->objAto->deleteById($id);
				
				$this->db->commit();
				$this->setRedirect('/fontes/transcription/id/'. $ato->ftn_id, 1, 1);		
			} catch (Exception $e) {
				$this->db->rollBack();				
				$this->setRedirectException('/fontes/transcription/id/'. $ato->ftn_id, $e);
			}
		}
	}
	
	function atributoAtoSaveAction() {
		$this->ajax();
		if($this->getRequest()->isPost()) {
			$data = $this->getRequest()->getPost();
			
			$data['aat_metadata'] = (isset($data['aat_metadata'])) ? $data['aat_metadata'] : 0;
			
			$this->db->beginTransaction();
			try {
				
				if(empty($data['aat_id'])) {
					$this->objUsuario->addScore($this->user);
				}
				$data['aat_id'] = $this->objAtributoAto->save($data);
								
				$this->db->commit();
				echo json_encode($data);
			} catch (Exception $e) {
				$this->db->rollBack();
				echo "error";
			}
		}
	}
	
	function atributoAtoDeleteAction() {
		$this->ajax();
		if($id = $this->getRequest()->getParam("aat_id")) {			
			$this->db->beginTransaction();
			try {
				$this->objAtributoAto->deleteById($id);
				$this->db->commit();
				echo "success";
			} catch (Exception $e) {
				$this->db->rollBack();
				echo "error";
			}
		}
	}
	
	function giSaveAction() {
		$this->ajax();
		if($this->getRequest()->isPost()) {
			$data = $this->getRequest()->getPost();			
			$this->db->beginTransaction();
			try {
				$data['gif_id'] = $this->objGrupoInformacao->save($data);
				$this->db->commit();
				echo json_encode($data);
			} catch (Exception $e) {
				$this->db->rollBack();
				echo "error";
			}
		}
	}
	
	function giDeleteAction() {
		$this->ajax();
		if($id = $this->getRequest()->getParam("gif_id")) {			
			$this->db->beginTransaction();
			try {
				$this->objAtributoGrupoInformacao->delete("gif_id = ". $id);
				$this->objGrupoInformacao->deleteById($id);
				$this->db->commit();
				echo "success";
			} catch (Exception $e) {
				$this->db->rollBack();
				echo "error";
			}
		}
	}

	function atributoGiSaveAction() {
		$this->ajax();
		if($this->getRequest()->isPost()) {
			$data = $this->getRequest()->getPost();
			
			$data['gia_metadata'] = (isset($data['gia_metadata'])) ? $data['gia_metadata'] : 0;
			
			$this->db->beginTransaction();
			try {				
				if(empty($data['aat_id'])) {
					$this->objUsuario->addScore($this->user);
				}
				$data['gia_id'] = $this->objAtributoGrupoInformacao->save($data);
				$this->db->commit();
				echo json_encode($data);
			} catch (Exception $e) {
				$this->db->rollBack();
				echo "error";
				echo $e->getMessage();
			}
		}
	}
	
	function atributoGiDeleteAction() {
		$this->ajax();
		if($id = $this->getRequest()->getParam("gia_id")) {			
			$this->db->beginTransaction();
			try {
				$this->objAtributoGrupoInformacao->deleteById($id);
				$this->db->commit();
				echo "success";
			} catch (Exception $e) {
				$this->db->rollBack();
				echo "error";
			}
		}
	}
	
	function giValidationAction() {
		$this->ajax();
		if($this->getRequest()->isPost()) {
			$data = $this->getRequest()->getPost();
			$check = $this->objGrupoInformacao->fetchRowById($data['gi']);			
			echo (!empty($check)) ? "true" : "false";
		}	
	}
	
	function vinculoSaveAction() {
		$this->ajax();
		if($this->getRequest()->isPost()) {
			$data = $this->getRequest()->getPost();
						
			$this->db->beginTransaction();
			try {
				$data['vnc_id'] = $this->objVinculo->save($data);
				$this->db->commit();
				echo json_encode($data);
			} catch (Exception $e) {
				$this->db->rollBack();
				echo "error";
				echo $e->getMessage();
			}
		}
	}
	
	function vinculoDeleteAction() {
		$this->ajax();
		if($id = $this->getRequest()->getParam("vnc_id")) {			
			$this->db->beginTransaction();
			try {
				$this->objVinculo->deleteById($id);
				$this->db->commit();
				echo "success";
			} catch (Exception $e) {
				$this->db->rollBack();
				echo "error";
			}
		}
	}
}