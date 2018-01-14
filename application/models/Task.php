<?php

class Xango_Model_Task extends Xango_AbstractModel {
	protected $_name = "tbl_tarefas";
    protected $_prefix = "tar_";
	protected $_primary = "tar_id";
    protected $_sequence = "tar_id";

	public function getFullTasks($where = "1=1") {
		$sql = "SELECT tar.tar_id, tar.tar_descricao, tar.tar_status, tar.tar_tipo, tar.tar_alteracao,
						tar.usu_id_encarregado, tar.usu_id_mandante, tar.ftn_id,
						usu.usu_nome AS mandante, usu2.usu_nome AS encarregado, ftn_nome, ftn_cota
					FROM tbl_tarefas AS tar
					JOIN tbl_usuarios AS usu
						ON usu.usu_id = tar.usu_id_mandante
					JOIN tbl_usuarios AS usu2
						ON usu2.usu_id = tar.usu_id_encarregado
					JOIN tbl_fontes AS ftn
						ON ftn.ftn_id = tar.ftn_id
					WHERE ". $where ."
					ORDER BY tar.tar_status, tar.tar_alteracao ASC";
					
					
		$stmt2 = $this->db->query($sql);
		return $stmt2->fetchAll();
	}
	
}