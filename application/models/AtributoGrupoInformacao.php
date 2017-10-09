<?php

class Xango_Model_AtributoGrupoInformacao extends Xango_AbstractModel {
	protected $_name = "tbl_gi_atributo";
    protected $_prefix = "gia_";
	protected $_primary = "gia_id";
	protected $_sequence = "gia_id";
	protected $_zeros = array("gia_metadata");
	
	public function deleteByAto($ato_id) {
		$sql = "DELETE FROM tbl_gi_atributo WHERE gif_id IN (SELECT gif_id FROM tbl_grupos_informacao WHERE ato_id = ". $ato_id .")";
		return $this->db->query($sql);
	}
}

