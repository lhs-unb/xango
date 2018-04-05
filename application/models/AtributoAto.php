<?php

class Xango_Model_AtributoAto extends Xango_AbstractModel {
	protected $_name = "tbl_ato_atributo";
    protected $_prefix = "aat_";
	protected $_primary = "aat_id";
	protected $_sequence = "aat_id";
	protected $_zeros = array("aat_metadata");

	/*
	Fetch all Attributes of a certain type ($type) from a specific set of sources ($sources)
	*/
	public function attrBySrc($sources = array(), $type = 'nome', $order = "a.ato_ordem") {
		$sql = "SELECT DISTINCT f.ftn_id, f.ftn_nome, f.ftn_cota, aat.aat_id, a.ato_id, a.ato_referencia, a.ato_ordem, aat.ttr_id,
					aat.aat_valor, REPLACE(REPLACE(REPLACE(REPLACE(aat.aat_valor, '[', ''), ']', ''), '{', ''), '}', '') AS aat_valor_cleaned, 
					aat.aat_original

					FROM tbl_fontes AS f
					JOIN tbl_atos AS a
						ON f.ftn_id = a.ftn_id
					JOIN tbl_ato_atributo AS aat
						ON aat.ato_id = a.ato_id
										
					WHERE f.ftn_id IN (". implode(",", $sources) .")
					AND aat.ttr_id = '". $type ."'
					
					ORDER BY ". $order;
		
		$stmt2 = $this->db->query($sql);
		$attributes = $stmt2->fetchAll();
		return $attributes;
	}	
	
}