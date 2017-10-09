<?php
class IndexController extends Xango_AbstractController {

    public function init() {
        parent::init();
        $this->objUsuario = new Xango_Model_Usuario();	
    }

	function indexAction() {
		//echo print_r($this->config['appSettings']['user']);
		$this->view->usuarios = $this->objUsuario->fetchAll("usu_ativo = 1", "usu_score DESC");
		
	}
}