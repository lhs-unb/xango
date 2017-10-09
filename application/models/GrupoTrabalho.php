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
}