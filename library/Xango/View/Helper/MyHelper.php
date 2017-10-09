<?php

class Xango_View_Helper_MyHelper extends Zend_View_Helper_Abstract
{
	public function myHelper($myParam1)
	{
		$html = 'teste de farinha';
		// some logic that fills in $html.
		return $html;
	}
}