<?php
class PredefinitionsController extends Xango_AbstractController {
		
    public function init() {		
        parent::init();
        $this->objPredefinition = new Xango_Model_Predefinition();
		$this->view->title = 'Predefinições';
    }

	function indexAction() {
		$this->view->predefinitions = $this->objPredefinition->fetchAll(null, "pre_name");
	}
	
	function editAction() {	
		$this->lightbox();
		if($id = $this->getRequest()->getParam("id")) {
			$this->view->predefinition = $this->objPredefinition->fetchRowById($id)->toArray();
		}
	}
	
	function saveAction() {
		if($this->getRequest()->isPost()) {
			$data = $this->getRequest()->getPost();
			$this->db->beginTransaction();
			try {				
				if(isset($_FILES['pre_file']) && !empty($_FILES['pre_file']['name'])) {
					$filename = explode('.', $_FILES['pre_file']['name']);
					
					/*
					$file_ext = strtolower($filename[count($filename)-1]);
					$extensions = array("json");
					
					if(in_array($file_ext, $extensions) === false){
						$this->setRedirectException('/predefinitions', 5, 2);
					}
					*/
					
					$data['pre_file'] = $_FILES['pre_file']['name'];
					move_uploaded_file($_FILES['pre_file']['tmp_name'], "uploads/predefinitions/".$_FILES['pre_file']['name']);
				}
				else {
					unset($data['pre_file']);
				}
				
				$this->objPredefinition->save($data);	
				$this->db->commit();
				$this->setRedirect('/predefinitions', 1, 1);		
			} catch (Exception $e) {
				$this->db->rollBack();
				$this->setRedirectException('/predefinitions', $e);
			}
		}
	}
	
	function deleteAction() {
		if($id = $this->getRequest()->getParam("id")) {
			$this->db->beginTransaction();
			try {
				$this->objPredefinition->deleteById($id);
				$this->db->commit();
				$this->setRedirect('/predefinitions', 1, 1);		
			} catch (Exception $e) {
				$this->db->rollBack();
				$this->setRedirectException('/predefinitions', $e);
			}
		}		
	}
}