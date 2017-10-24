<?php

class Xango_Model_GrupoTrabalho extends Xango_AbstractModel {
	protected $_name = "tbl_grupos_trabalho";
    protected $_prefix = "gtr_";
	protected $_primary = "gtr_id";
    protected $_sequence = "gtr_id";
	
	public function fetchAll($where = NULL, $order = NULL, $count = NULL, $offset = NULL) {
		$results = parent::fetchAll($where, $order, $count, $offset);
		
		if($results)
			$results = $results->toArray();
					
		foreach($results as $key => $result) {
			$sql = "SELECT usu.usu_nome, usu.usu_id, augt.aug_papel
						FROM tbl_usuarios usu
						JOIN tbl_assoc_usuario_grupo_trabalho augt
							ON augt.usu_id = usu.usu_id
						WHERE augt.gtr_id = ". $result['gtr_id']."
						ORDER BY augt.aug_papel, usu.usu_nome";
			$membros = $this->db->fetchAll($sql);
			$results[$key]['gtr_membros'] = ($membros) ? $membros : array();
		}
		return $results;
	}

	public function usuGrupoTrabalho($id){
	    $sql = "SELECT  gtr.gtr_nome, gtr.gtr_descricao, augt.aug_papel, gtr.gtr_id
                FROM tbl_assoc_usuario_grupo_trabalho augt INNER JOIN tbl_grupos_trabalho gtr
                ON augt.gtr_id = gtr.gtr_id WHERE augt.usu_id = ".$id;
        $result = $this->db->fetchAll($sql);
        return $result;
    }

    public function selectGroupoTrabalho(){
	    $sql = "SELECT * FROM tbl_grupos_trabalho ORDER BY gtr_nome";
	    $result = $this->db->fetchAll($sql);
	    return $result;
    }

    public function atualizaDadosGrupoUsuario($data){
        $id = isset($data['usu_id']) ? $data['usu_id'] : null;
        unset($data['usu_id']);
        if($id != null ){
            $sqlDelete = "DELETE FROM tbl_assoc_usuario_grupo_trabalho WHERE usu_id = $id";
            $this->db->query($sqlDelete);
            foreach($data as $dados){
                $gtr_id = $dados['gtr_id'];
                if($dados['aug_papel'] === 'lider'){
                    $aug_papel = 1;
                }
                elseif($dados['aug_papel'] === 'monitor'){
                    $aug_papel = 2;
                }
                elseif($dados['aug_papel'] === 'operador'){
                    $aug_papel = 3;
                }
                $sqlInsert = "INSERT INTO tbl_assoc_usuario_grupo_trabalho(gtr_id,usu_id,aug_papel) VALUES ($gtr_id,$id,$aug_papel)";
                    $this->db->query($sqlInsert);
            }
        }
    }

}