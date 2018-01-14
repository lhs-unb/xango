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
		$this->objPredefinition = new Xango_Model_Predefinition();
        $this->objTask = new Xango_Model_Task();
		
		$this->view->title = 'Fontes';
    }

	function indexAction() {
		$this->view->fontes = $this->objFonte->getAllDocuments();
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
				$id = $this->objFonte->save($data);
				$redirect .= "/id/". $id;
				
				// In case is a new Document, it also adds a Task (supervision) for the User how added it.
				if(empty($data["ftn_id"])) {
					$task['ftn_id'] = $id;
					$task['tar_tipo'] = 3; // Supervision
					$task['tar_status'] = 4; // Developing
					$task['tar_ordem'] = 0;
					$task['tar_alteracao'] =  new Zend_Db_Expr("NOW()");
					$task['usu_id_mandante'] = $this->user->usu_id;
					$task['usu_id_encarregado'] = $this->user->usu_id;

					$this->objTask->save($task);
				}
				
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
			$this->view->predefinitions = $this->objPredefinition->fetchAll(null, "pre_name");
			$this->view->tasks = $this->objTask->getFullTasks("tar.ftn_id = ". $id ." AND tar.tar_status IN (1,2,4)");
			$this->view->fonte = $this->objFonte->getFonteFull($id);
		}	
	}
	
	function atoEditAction() {
		$this->lightbox();
				
		if($ftn_id = $this->getRequest()->getParam("ftn_id"))
			$this->view->ftn_id = $ftn_id;
		if($ato_id = $this->getRequest()->getParam("ato_id"))
			$this->view->ato_id = $ato_id;
		
		// in case of a predefinitions, the system creates a new Act based on the template
		$this->db->beginTransaction();
		try {
			if($predef = $this->getRequest()->getParam("predef")) {
				$predefinition = $this->objPredefinition->fetchRowById($predef)->toArray();
				$json = json_decode(file_get_contents("uploads/predefinitions/". $predefinition['pre_file']), true);
				
				if(empty($json)) {
					throw new Exception('JSON inválido.');
				}
				
				// adding Act
				$act = array("ato_referencia" => "atualizar", "ftn_id" => $ftn_id, "tpa_id" => $json['act']);
				$ato_id = $this->objAto->save($act);
				$js['act'] = $json['attributes'];
				
				// adding Entities
				foreach($json['entities'] as $key => $info) {
					$entity = array("ato_id" => $ato_id, "tpf_id" => $key);
					for($i=0;$i<$info[0];$i++) {
						$gif_id = $this->objGrupoInformacao->save($entity);
						$js['entities'][$gif_id] = array_slice($info,1);
					}
				}
				$this->view->ato_id = $ato_id;
				$this->view->js = $js;
				$this->db->commit();
			}
		} catch (Exception $e) {
			$this->db->rollBack();
			echo "error";
			//$this->setRedirectException('/fontes/transcription/id/'. $ftn_id, $e);
		}
		
		// Load data
		$this->view->tipos_ato = $this->objTipoAto->fetchAll(null, "tpa_nome");
		$this->view->tipos_atibuto = $this->objTipoAtributo->fetchAll(null, "ttr_nome");
		$this->view->tipos_funcao = $this->objTipoFuncao->fetchAll(null, "tpf_nome");
		$this->view->tipos_vinculo = $this->objTipoVinculo->fetchAll(null, "tpv_nome");
		
		if($id = $ato_id) {
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
				$data['aat_valor'] = trim($data['aat_valor']);
				
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
				$data['gia_valor'] = trim($data['gia_valor']);
				
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
	
	
	// Check if a Entity is valid (exists in the database) or not
	// return "true" or "false" 
	function giValidationAction() {
		$this->ajax();
		if($this->getRequest()->isPost()) {
			$data = $this->getRequest()->getPost();
		//if($this->getRequest()->isGet()) {
		//	$data = $_GET;
			$check = $this->objGrupoInformacao->fetchRow("gif_id = ". $data['gi'] ." AND ato_id = ". $data['ato']);
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
	
	
	/*
	similarity function
	*/
	function consolidateNamesAction() {
		//thresholds
		$similarity = 18;
		$levenshtein = 6;
		
		if($id = $this->getRequest()->getParam("id")) {			
			$type = "nome";
			$attrs = $this->objAtributoGrupoInformacao->attrBySrc(array($id), $type);
			
			$results = array();			
			foreach($attrs as $attr) {
				$results[$attr->gia_id]['gia_valor'] = $attr->gia_valor;
				$results[$attr->gia_id]['ato_id'] = $attr->ato_id;
				$results[$attr->gia_id]['ato_referencia'] = $attr->ato_referencia;
				$results[$attr->gia_id]['attrs'] = $this->objAtributoGrupoInformacao->attrByEntity($attr->gif_id);
				
				foreach($attrs as $attr2) {
					if($attr->gia_id == $attr2->gia_id || $attr->gia_valor == $attr2->gia_valor)
						continue;
					
					if(similar_text($attr->gia_valor, $attr2->gia_valor) > $similarity ||
						levenshtein($attr->gia_valor, $attr2->gia_valor) < $levenshtein) {
						$results[$attr->gia_id]['similar'][$attr2->gia_id] = $attr2;
						
						$results[$attr->gia_id]['similar'][$attr2->gia_id]->attrs = $this->objAtributoGrupoInformacao->attrByEntity($attr2->gif_id);
					}
					
				}
			}
		}
		/*
		echo "<pre>";
		print_r($results);
		die;
		*/
		
		$this->view->matches = $results;
		$this->view->ftn_id = $id;
	}
	
	/*
	Order the acts according to a specific pattern
	*/	
	function orderActsAction() {
		$this->lightbox();
		if($id = $this->getRequest()->getParam("id")) {
			$this->view->ftn_id = $id;
		}		
	}
	
	function orderActsSaveAction() {
		if($this->getRequest()->isPost()) {
			$data = $this->getRequest()->getPost();
			$acts = $this->objAto->fetchAll("ftn_id = ". $data['ftn_id']);
			$items = array();
			
			// Preparing the data for sorting
			foreach($acts as $act) {
				// remove prefix and suffix and split
				$temp_array = explode($data['divide'], trim(str_replace($data['suffix'], '', str_replace($data['prefix'], '', $act->ato_referencia))));
				$items[$act->ato_id]['ato_id'] = $act->ato_id;
				
				// iterate through beginning and end points and extract front and verso markings
				foreach($temp_array as $key => $temp_item) {
					$point = ($key == 1) ? 'end' : 'init';					
					$items[$act->ato_id][$point .'_val'] = filter_var($temp_item, FILTER_SANITIZE_NUMBER_INT);
					
					// create array with front and verso
					if(!empty($data['front']) && strpos($temp_item, $data['front']))
						$items[$act->ato_id][$point .'_mark'] = 1;
					elseif(!empty($data['verso']) && strpos($temp_item, $data['verso']))
						$items[$act->ato_id][$point .'_mark'] = 3;
					else
						$items[$act->ato_id][$point .'_mark'] = 2;
					
					//if not end point, end equals beginning
					if(!isset($items[$act->ato_id]['end_val'])) {
						$items[$act->ato_id]['end_val'] = $items[$act->ato_id]['init_val'];
						$items[$act->ato_id]['end_mark'] = $items[$act->ato_id]['init_mark'];
					}
				}
			}
			
			// Sorting the data			
			foreach ($items as $key => $row) {
				$init_val[$key]  = $row['init_val'];
				$init_mark[$key]  = $row['init_mark'];
				$end_val[$key]  = $row['end_val'];
				$end_mark[$key]  = $row['end_mark'];
			}
			
			array_multisort(	$init_val, SORT_ASC, SORT_NUMERIC, 
								$init_mark, SORT_ASC, SORT_NUMERIC, 
								$end_val, SORT_ASC,  SORT_NUMERIC, 
								$end_mark, SORT_ASC,  SORT_NUMERIC, 
								$items);
			
			// updating database
			$this->db->beginTransaction();
			try {
				foreach($items as $order => $item) {
					$edit = array("ato_id" => $item['ato_id'], 'ato_ordem' => $order);					
					$this->objAto->save($edit);
				}
				$this->db->commit();
				$this->setRedirect('/fontes/transcription/id/'. $data['ftn_id'], 1, 1);		
			} catch (Exception $e) {
				$this->db->rollBack();
				$this->setRedirectException('/fontes/transcription/id/'. $data['ftn_id'], $e);
			}
		}
	}
	
	
	/*
	Validate the Attributes of the Entitys, offering a easy and fast way to check if they are correct
	*/	
	function validateEntityAttrAction() {
		$this->lightbox();
		if($id = $this->getRequest()->getParam("id")) {
			$this->view->ftn_id = $id;
			$this->view->types = $this->objAtributoGrupoInformacao->attrTypesBySrc(array($id));
		}
	}
	
	function listEntityAttrAction() {
		if($this->getRequest()->isPost()) {
			$data = $this->getRequest()->getPost();
			$this->view->attrs = $this->objAtributoGrupoInformacao->attrBySrc(array($data['ftn_id']), $data['ttr_id'], "a.ato_ordem");
			$this->view->ftn_id = $data['ftn_id'];
		}
	}
}