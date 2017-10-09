<?php

class Xango_AbstractModel extends Zend_Db_Table {
	
	public function init() {
		$this->db = $this->getDefaultAdapter();
    }

	public function save(array $data) {		
        $primary = $this->getPrimary();
		
		/* Null values */
		foreach($data as $k => $v) {
			if(isset($this->_zeros) && !in_array($k, $this->_zeros)) {
				if(empty($v) && $k != $primary)
					unset($data[$k]);
					//$data[$k] = new Zend_Db_Expr("NULL");
			}
		}
		
		/* Date values */
		if(isset($this->_dates)) {
			foreach($this->_dates as $campo) {
				if(isset($data[$campo]) && !is_object($data[$campo]))
					$data[$campo] = new Zend_Db_Expr("to_date('". $data[$campo] ."', 'dd/mm/yyyy')");
			}
		}
		
		/* Datetime values */
		if(isset($this->_datetimes)) {
			foreach($this->_datetimes as $campo) {
				if(isset($data[$campo]) && !is_object($data[$campo]))
					$data[$campo] = new Zend_Db_Expr("to_timestamp('". $data[$campo] ."', 'dd/mm/yyyy hh24:mi:ss')");
			}
		}
		
		if( (!isset($data[$primary]) || empty($data[$primary]))
			|| ($this->emptyKey($data[$primary]) && !$this->isSequence())) {
			$this->insert($data);
			return $this->db->lastInsertId();
        } else {
			$where = "{$primary} = '{$data[$primary]}'";
            $pk = $data[$primary];
            unset ($data[$primary]);
	        $this->update($data, $where);			
            return $pk;
        }
    }
	
    public function fetchRowById($id){
        $primary = $this->getPrimary();

        $where = "{$primary} = '{$id}'";
		
        return parent::fetchRow($where);
    }
	
    public function deleteById($id){
        $primary = $this->getPrimary();

        $where = "{$primary} = '{$id}'";
        return parent::delete($where);
    }
	
    private function getPrimary(){
		return ( $this->_sequence != 1)
			? $this->_sequence
			: $this->_primary;
    }
	
    private function isSequence(){	
		return ($this->_sequence != 1)
			? true
			: false;
    }
	
	private function emptyKey($key){
		$fetch = $this->fetchRowById($key);
		return ($fetch) ? false : true;		
	}
}