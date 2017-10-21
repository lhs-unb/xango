<?php
class UsuariosController extends Xango_AbstractController {

    public function init() {
		$this->debug = true;

		parent::init();
        $this->objUsuario = new Xango_Model_Usuario();
        $this->objGroup = new Xango_Model_GrupoTrabalho();
		$this->view->title = 'Usuários';
	}

	function indexAction() {
		$this->view->usuarios = $this->objUsuario->fetchAll(null, "usu_nome");
	}
	function editAction() {
		$this->lightbox();
		if($id = $this->getRequest()->getParam("id")) {
			$this->view->usuario = $this->objUsuario->fetchRowById($id)->toArray();
		}
	}
	function groupAction() {
        $this->lightbox();
        $id = $this->getRequest()->getParam("id");
        $nome = $this->getRequest()->getParam("nome");

        $data = $this->objGroup->usuGrupoTrabalho($id);

        $group = $this->objGroup->selectGroupoTrabalho();
        $dataView = [
            'nome' => $nome,
            'dados' => $data,
            'grupo' => $group
        ];
        $this->view->usuario = $dataView;
    }
    function saveGroupAction(){
        if($this->getRequest()->isPost()){
            $data = $this->getRequest()->getPost();
            print_r($data);
            die();
        }
    }
	
	function saveAction() {
		if($this->getRequest()->isPost()) {
			$data = $this->getRequest()->getPost();
			/*
			$this->db->getProfiler()->setEnabled(true);
			$profiler = $this->db->getProfiler();
			*/
			// pega os dados do usuário
			$usuario = $this->user;
            // verifica se a senha enviada para atulizar é diferente de null, caso contrário retira do array de update
			if($data["usu_senha"] != null )
				$data["usu_senha"] = md5($data["usu_senha"]);
			else
			    unset($data["usu_senha"]);
			if(empty($data["usu_admin"]))
				$data["usu_admin"] = 0;
			// verifica se o usuário está desativando alguém que não seja ele mesmo, caso contrário permanece usu_ativo = 1
			if(empty($data["usu_ativo"]) && $data["usu_id"] != $usuario->usu_id )
				$data["usu_ativo"] = 0;

			$this->db->beginTransaction();
			try {
				$this->objUsuario->save($data);
				$this->db->commit();
				$this->setRedirect('/usuarios', 1, 1);
			} catch (Exception $e) {
				/*
				$query  = $profiler->getLastQueryProfile();
				$params = $query->getQueryParams();
				$querystr  = $query->getQuery();

				foreach ($params as $par) {
					$querystr = preg_replace('/\\?/', "'" . $par . "'", $querystr, 1);
				}
				echo $querystr;
				die;
				*/

				$this->db->rollBack();
				$this->setRedirectException('/usuarios', $e);
			}
		}
	
	}
	
	function deleteAction() {
		if($id = $this->getRequest()->getParam("id")) {
			$this->db->beginTransaction();
			try {
				$this->objUsuario->deleteById($id);
				$this->db->commit();
				$this->setRedirect('/usuarios', 1, 1);		
			} catch (Exception $e) {
				$this->db->rollBack();
				$this->setRedirectException('/usuarios', $e);
			}
		}		
	}
}