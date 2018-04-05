<?php

class Xango_Model_Fonte extends Xango_AbstractModel {
	protected $_name = "tbl_fontes";
    protected $_prefix = "ftn_";
	protected $_primary = "ftn_id";
    protected $_sequence = "ftn_id";
	
	public function getAllDocuments($gts = null) {
		$where = "";
		if($gts) {
			$where = "AND ftn.gtr_id IN (". implode(",", $gts) . ")";
		}		
		
		$sql = "SELECT ftn.ftn_id, ftn.ftn_nome, ftn.ftn_status, ftn.ftn_convencao, ftn.ftn_cota, ftn.ftn_descricao, ftn.gtr_id, ftn.acv_id,
		acv.acv_nome, gtr.gtr_nome
	
		FROM tbl_fontes AS ftn
		
		JOIN tbl_acervos AS acv
			ON acv.acv_id = ftn.acv_id
			
		JOIN tbl_grupos_trabalho AS gtr
			ON gtr.gtr_id = ftn.gtr_id
		
		WHERE 1=1
		". $where ."
		
		ORDER BY ftn.ftn_nome";
		
		$stmt2 = $this->db->query($sql);
		$documents = $stmt2->fetchAll();
		return $documents;
	}
	
	public function getFonteFull($id) {
		
		$sql = "
		SELECT ftn.ftn_id, ftn.ftn_nome, ftn.ftn_status, ftn.ftn_convencao, ftn.ftn_cota, ftn.ftn_descricao, ftn.gtr_id, ftn.acv_id,
			acv.acv_nome, gtr.gtr_nome
		
			FROM tbl_fontes AS ftn
			
			JOIN tbl_acervos AS acv
				ON acv.acv_id = ftn.acv_id
				
			JOIN tbl_grupos_trabalho AS gtr
				ON gtr.gtr_id = ftn.gtr_id
			
			WHERE ftn.ftn_id = ". $id;
			
		$stmt = $this->db->query($sql);
		$fonte = (array)$stmt->fetch();
		
		$sql = "
		SELECT ato.ato_id, ato.ato_referencia, ato.tpa_id, ato.ato_ordem, ato.ato_status, tpa.tpa_nome
		
			FROM tbl_atos AS ato
			
			JOIN tbl_tipos_ato tpa
				ON tpa.tpa_id = ato.tpa_id
				
			WHERE ato.ftn_id = ". $id ."
			
			ORDER BY ato.ato_ordem, ato.ato_id, ato.ato_referencia
		";
		
		//Xango_Model_Ato::getAtoFull($id);
		
		$stmt2 = $this->db->query($sql);
		$fonte['atos'] = (array)$stmt2->fetchAll();		
		return $fonte;
	}
	
	public function setUsersGroup($id) {
		$sql = "SELECT u.usu_id, u.usu_nome, u_gt.aug_papel
					FROM tbl_usuarios AS u
					JOIN tbl_assoc_usuario_grupo_trabalho u_gt
						ON u_gt.usu_id = u.usu_id
					JOIN tbl_fontes AS f
						ON f.gtr_id = u_gt.gtr_id
					WHERE u.usu_ativo = 1
					AND f.ftn_id = ". $id;
		
		$stmt2 = $this->db->query($sql);
		$users = $stmt2->fetchAll();
		return $users;
		// todo: tratar erro de retorno vazio
	}
}