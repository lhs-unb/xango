<?php

class Xango_Model_AtributoAto extends Xango_AbstractModel {
	protected $_name = "tbl_ato_atributo";
    protected $_prefix = "aat_";
	protected $_primary = "aat_id";
	protected $_sequence = "aat_id";
	protected $_zeros = array("aat_metadata");
}