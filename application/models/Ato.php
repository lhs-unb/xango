<?php

class Xango_Model_Ato extends Xango_AbstractModel {
	protected $_name = "tbl_atos";
    protected $_prefix = "ato_";
	protected $_primary = "ato_id";
    protected $_sequence = "ato_id";
	
	function getAtoFull($id) {
		$ato = $this->fetchRowById($id)->toArray();
		
		$sql = "SELECT aat.aat_id, aat.aat_valor, aat.aat_metadata, ttr.ttr_id
		
		FROM tbl_ato_atributo aat
		
		JOIN tbl_tipos_atributo ttr
			on ttr.ttr_id = aat.ttr_id
		
		WHERE aat.ato_id = ". $id ."
		
		ORDER BY ttr.ttr_tipo
		";
		
		$stmt2 = $this->db->query($sql);
		$ato['atributos'] = (array)$stmt2->fetchAll();
		
		return $ato;
	}
}