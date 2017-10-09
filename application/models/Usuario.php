<?php

class Xango_Model_Usuario extends Xango_AbstractModel {
	protected $_name = "tbl_usuarios";
    protected $_prefix = "usu_";
	protected $_primary = "usu_id";
    protected $_sequence = "usu_id";
	protected $base_exp = 75;
	protected $factor_exp = 2;
	
	public function addScore($user) {
		
		
		if($user->usu_score > ($this->base_exp*pow($user->usu_level,$this->factor_exp)) ) {
			die("sobe");
		}
		else {
			die("nao sobe");
		}
			
		die;
				
		$sql = "UPDATE tbl_usuarios SET usu_score = usu_score+1 WHERE usu_id = ". $user->usu_id;
		return $this->db->query($sql);
	}
}