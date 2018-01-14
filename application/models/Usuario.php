<?php

class Xango_Model_Usuario extends Xango_AbstractModel {
	protected $_name = "tbl_usuarios";
    protected $_prefix = "usu_";
	protected $_primary = "usu_id";
    protected $_sequence = "usu_id";
	protected $base_exp = 75;
	protected $factor_exp = 2;
	
	public function addScore($user, $points = 1) {
		
		/*
		if($user->usu_score > ($this->base_exp*pow($user->usu_level,$this->factor_exp)) ) {
			die("sobe");
		}
		else {
			die("nao sobe");
		}
			
		die;
		*/
				
		$sql = "UPDATE tbl_usuarios SET usu_score = usu_score + ". $points ." WHERE usu_id = ". $user->usu_id;
		return $this->db->query($sql);
	}
	
	
	// Return the Research Groups to which a one belongs and one's respective role
	public function getGtsByUser($id) {
		$sql = "SELECT gtr_id, aug_papel
					FROM tbl_assoc_usuario_grupo_trabalho
					WHERE usu_id = ". $id;
		
		$stmt2 = $this->db->query($sql);
		$gts = $stmt2->fetchAll();
		return $gts;
	}
}