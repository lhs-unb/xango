<?php

class Xango_Model_Memo extends Xango_AbstractModel {
	protected $_name = "tbl_memos";
    protected $_prefix = "mem_";
	protected $_primary = "mem_id";
    protected $_sequence = "mem_id";

	public function getFullMemos($where = "1=1") {
		$sql = "SELECT mem.mem_id, mem.mem_descricao, mem.mem_alteracao,
						mem.usu_id, usu.usu_nome
					FROM tbl_memos AS mem
					JOIN tbl_usuarios AS usu
						ON usu.usu_id = mem.usu_id
					WHERE ". $where ."
					ORDER BY mem.mem_alteracao ASC";					
					
		$stmt2 = $this->db->query($sql);
		return $stmt2->fetchAll();
	}
}