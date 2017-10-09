<?php

class Xango_Model_GrupoInformacao extends Xango_AbstractModel {
	protected $_name = "tbl_grupos_informacao";
    protected $_prefix = "gif_";
	protected $_primary = "gif_id";
    protected $_sequence = "gif_id";
	
	function getGrupoInformacaoFull($ato_id) {
	
		$sql = "
		SELECT gif.gif_id, tpf.tpf_id, tpf.tpf_nome
		
			FROM tbl_grupos_informacao gif
			
			JOIN tbl_tipos_funcao tpf
				ON tpf.tpf_id = gif.tpf_id
				
			WHERE gif.ato_id = ". $ato_id;
	
		$stmt = $this->db->query($sql);
		$gis = (array)$stmt->fetchAll();
		
		foreach($gis as $k => $gi) {
			$sql = "
			SELECT gia.gia_id, gia.gia_valor, gia.gia_metadata, gia.gia_tipo_dado, ttr.ttr_id, ttr.ttr_nome
			
				FROM tbl_gi_atributo gia
				
				JOIN tbl_tipos_atributo ttr
					ON ttr.ttr_id = gia.ttr_id
					
				WHERE gia.gif_id = ". $gi->gif_id ."
				
				ORDER BY ttr_nome
			";
			
			
			$stmt2 = $this->db->query($sql);
			$gis[$k]->atributos = (array)$stmt2->fetchAll();
			$stmt2 = null;
		}
		
		return $gis;
	}
}