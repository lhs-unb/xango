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
	
	/*
	Fetch all Attributes of a certain type ($type) from a specific set of sources ($sources)
	*/
	public function attrBySrc($sources = array(), $type = 'nome', $order = "gia.gia_valor") {
		$sql = "SELECT DISTINCT f.ftn_id, f.ftn_nome, f.ftn_cota, gi.gif_id, gia.gia_id, a.ato_id, a.ato_referencia, gia.ttr_id,
					REPLACE(REPLACE(REPLACE(REPLACE(gia.gia_valor, '[', ''), ']', ''), '{', ''), '}', '') AS gia_valor, gia.gia_original

					FROM tbl_fontes AS f
					JOIN tbl_atos AS a
						ON f.ftn_id = a.ftn_id
					JOIN tbl_grupos_informacao AS gi
						ON a.ato_id = gi.ato_id
					JOIN tbl_gi_atributo AS gia
						ON gia.gif_id = gi.gif_id
					
					
					WHERE f.ftn_id IN (". implode(",", $sources) .")
					AND ttr_id = '". $type ."'
					
					ORDER BY ". $order;
		
		$stmt2 = $this->db->query($sql);
		$attributes = $stmt2->fetchAll();
		return $attributes;
	}
	
	/*
	Fetch all Attribute types from a specific set of sources ($sources)
	*/
	public function attrTypesBySrc($sources = array()) {
		$sql = "SELECT DISTINCT gia.ttr_id, ttr.ttr_nome, count(gia.gia_valor) as total
					FROM tbl_gi_atributo AS gia
					JOIN tbl_tipos_atributo AS ttr
						ON gia.ttr_id = ttr.ttr_id
					JOIN tbl_grupos_informacao AS gif
						ON gia.gif_id = gif.gif_id
					JOIN tbl_atos AS ato
						ON gif.ato_id = ato.ato_id
					WHERE ato.ftn_id IN (". implode(",", $sources) .")
                    group by gia.ttr_id, ttr.ttr_nome
					ORDER BY ttr.ttr_nome";
		
		$stmt2 = $this->db->query($sql);
		$types = $stmt2->fetchAll();
		return $types;
	}
	
	
	/*
	Fetch all Attributes of a certain Entity
	*/
	public function attrByEntity($id) {
		$sql = "SELECT gia.gia_id, ttr.ttr_nome, gia.gia_valor
					FROM tbl_gi_atributo AS gia
					JOIN tbl_tipos_atributo AS ttr
						ON ttr.ttr_id = gia.ttr_id
					WHERE gif_id = ". $id;
		$stmt2 = $this->db->query($sql);
		$attributes = $stmt2->fetchAll();
		return $attributes;
	}
}