<?php
class IndexController extends Xango_AbstractController {

    public function init() {
        parent::init();
        $this->objUsuario = new Xango_Model_Usuario();	
        $this->objTask = new Xango_Model_Task();	
    }

	function indexAction() {
		$this->view->params = $this->getRequest()->getParams();
		
		//echo print_r($this->config['appSettings']['user']);
		$this->view->usuarios = $this->objUsuario->fetchAll("usu_ativo = 1", "usu_score DESC");
		$this->view->tasks = $this->objTask->getFullTasks("usu_id_encarregado = ". $this->user->usu_id ." AND tar_status IN (1,4)");		
	}
}