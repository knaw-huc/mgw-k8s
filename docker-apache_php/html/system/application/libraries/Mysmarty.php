<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require "Smarty/Smarty.class.php";

/**
* @file system/application/libraries/Mysmarty.php
*/
class Mysmarty extends Smarty {
	
	function Mysmarty() {	
		$this->Smarty();
		$this->compile_dir = BASEPATH . 'cache/templates_c/';
		$this->template_dir = APPPATH . 'views/templates/';
	}
}

?>