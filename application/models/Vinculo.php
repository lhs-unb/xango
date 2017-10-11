<?php

class Xango_Model_Vinculo extends Xango_AbstractModel {
	protected $_name = "tbl_vinculos";
    protected $_prefix = "vnc_";
	protected $_primary = "vnc_id";
    protected $_sequence = "vnc_id";
	
	public function getVinculos($ato) {
		$sql = "SELECT DISTINCT vnc_id, vnc_direcao, tpv_id, gif_id_vinculante, gif_id_vinculado, gi.ato_id
					FROM tbl_vinculos v
					
					JOIN tbl_grupos_informacao gi
						ON v.gif_id_vinculante = gi.gif_id
					
					WHERE gi.ato_id = ". $ato ."
		";
		
		$stmt2 = $this->db->query($sql);
		return $stmt2->fetchAll();
	}
}