<?php

class Mgw extends Controller {

	private $_letters;
	private $_provincies;
	
	function __construct() {	

		parent::Controller();
		$this->load->library('mysmarty');
		$this->mysmarty->assign('base_url', base_url());
		$this->mysmarty->assign('hostname', $_SERVER['SERVER_NAME']);
		$this->mysmarty->assign('letters', $this->MGW_model->getLetters());
		$this->mysmarty->assign('provincies', $this->MGW_model->getProvincies());
		$this->mysmarty->assign('typen', $this->MGW_model->getMaten());
	}
	
	function index() {
		$this->mysmarty->display('index.tpl');
	}

	function plaatsen($beperking = NULL) {

		if (is_null($beperking)) {
			$this->index();
			return;
		}

		$plaatsen = $this->MGW_model->getPlaatsen($beperking);
		$this->mysmarty->assign('plaatsen', $plaatsen);
		$this->mysmarty->display('resultaten.tpl');
	}
	
	function maten($beperking = NULL) {

		if (is_null($beperking)) {
			$this->index();
			return;
		}

		$maten = $this->MGW_model->getMaten($beperking);
		if (! is_null($beperking)) {
			$maattype =  $this->MGW_model->getMaatType($beperking);
			$this->mysmarty->assign('maattype', $maattype);			
		}
		$this->mysmarty->assign('maten', $maten);
		$this->mysmarty->display('resultaten.tpl');
	}
	
	function plaats($id = NULL) {
	
		if (is_null($id)) {
			$this->index();
			return;
		}

		$plaats = $this->MGW_model->getPlaatsen($id);
		
		if ($plaats === FALSE) {
			$this->index();
			return;
		}
		
		$maten = $this->MGW_model->getMatenPerPlaats($id);
		
		foreach($maten as $k => $maat) {
			$type_omschrijving = preg_replace('!<zie="(.+?)">(.+)</zie>!', "<a href=\"/mgw/plaats/\\1/\">\\2</a>", $maat['type_omschrijving']);
			$maten[$k]['type_omschrijving'] = $type_omschrijving;
		}
		
		$this->mysmarty->assign('plaatsnaam', $plaats['plaats']);
		$this->mysmarty->assign('regio', $plaats['regio']);
		$this->mysmarty->assign('provincie', $plaats['provincie']);
		$this->mysmarty->assign('matenperplaats', $maten);
		$this->mysmarty->display('resultaten.tpl');
	}
	
	function maat($id = NULL) {

		if (is_null($id)) {
			$this->index();
			return;
		}
		
		list($maattype, $maatnaam) = $this->MGW_model->getMaatTypeEnNaam($id);
		$plaatsen = $this->MGW_model->getPlaatsenPerMaat($id);
		$this->mysmarty->assign('maattype', $maattype);
		$this->mysmarty->assign('maatnaam', $maatnaam);		
		$this->mysmarty->assign('plaatsenpermaat', $plaatsen);
		$this->mysmarty->display('resultaten.tpl');		
	}
	
	function literatuur() {
		$this->mysmarty->display('literatuur.tpl');
	}
	
	function _remap($method) {

		if (! method_exists($this, $method)) {
			$this->index();
		} else {
			$param = $this->uri->rsegment(3);
			if ($param === FALSE) {
				$this->$method();
			} else {
				$this->$method($param);		
			}
		}
	}
}

?>