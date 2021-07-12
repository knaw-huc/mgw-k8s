<?php

class MGW_model extends Model {

	function __construct() {
		parent::Model();
	}
	
	function getMatenPerPlaats($id) {
		
		$query = $this->db->query("SELECT type, type_omschrijving, naam, REPLACE(TRIM(TRAILING '.' FROM TRIM(TRAILING '0' FROM CAST(metrieke_waarde AS CHAR(7)))),'.',',') AS metrieke_waarde , eenheid, bron FROM maat WHERE recordnr=? ORDER BY id", array($id));
		$maten = $query->result_array();
		
		return $maten;
	}


	function getPlaatsenPerMaat($id) {
		
		$query = $this->db->query("SELECT id, CONCAT(l.plaats, ' (', IF(l.regio <> '', CONCAT(l.regio, ', '),''), l.provincie, ')') AS locatie, m.type, m.type_omschrijving, m.naam, REPLACE(TRIM(TRAILING '.' FROM TRIM(TRAILING '0' FROM CAST(m.metrieke_waarde AS CHAR(7)))),'.',',') AS metrieke_waarde, m.hoeveelheid, m.eenheid, m.bron FROM maat AS m, locatie AS l WHERE m.maat_id=? AND l.recordnr=m.recordnr ORDER BY l.plaats", array($id));
		$plaatsen = $query->result_array();
		
		$retval = array();
		foreach($plaatsen as $plaats) {
			$retval[$plaats['locatie']][] = array(	'type' => $plaats['type'],
													'type_omschrijving' => $plaats['type_omschrijving'],
// 													'hoeveelheid' => $this->_getHoeveelheid($plaats['id'], $plaats['hoeveelheid']),
													'naam' => $plaats['naam'],
													'metrieke_waarde' => $plaats['metrieke_waarde'],
													'eenheid' => $plaats['eenheid'],
													'bron' => $plaats['bron']);
		}
		
		return $retval;
	}

	function getPlaatsen($beperking = NULL) {

		$plaatsen = array();

		if (is_null($beperking)) {
			$query = $this->db->query('SELECT recordnr, plaats FROM locatie ORDER BY sorteernaam');
			foreach ($query->result() as $rij) {
				$plaatsen[$rij->recordnr] = $rij->plaats;
			}
		} elseif (is_numeric($beperking)) {
			// id van plaats
			$query =  $this->db->query('SELECT recordnr, plaats, regio, provincie FROM locatie where recordnr = ?', array($beperking));
			
			if ($query->num_rows() == 0) {
				return FALSE;
			}
			
			$rij = $query->row();
			$plaatsen['plaats'] = $rij->plaats;
			$plaatsen['regio'] = $rij->regio;
			$plaatsen['provincie'] = $rij->provincie;
		} elseif (strlen($beperking) == 1) {
			// beginletter van plaats
			$query = $this->db->query("SELECT recordnr, plaats, regio, provincie FROM locatie WHERE sorteernaam LIKE '" . $this->db->escape_like_str($beperking) . "%'  ORDER BY sorteernaam");
			foreach ($query->result() as $rij) {
				$plaatsen[$rij->recordnr] = array(	'plaats' => $rij->plaats,
													'regio' => $rij->regio,
													'provincie' => $rij->provincie);
			}
		} else {
			// naam van provincie
			$query = $this->db->query("SELECT recordnr, plaats, regio, provincie FROM locatie WHERE provincie = ? ORDER BY sorteernaam", array($beperking));
			foreach ($query->result() as $rij) {
				$plaatsen[$rij->recordnr] = array(	'plaats' => $rij->plaats,
													'regio' => $rij->regio,
													'provincie' => $rij->provincie);
			}			
		}

		return $plaatsen;
	}

	function getLetters() {
		$query = $this->db->query('SELECT DISTINCT LEFT(`sorteernaam`, 1) AS pl FROM locatie ORDER BY `sorteernaam`');		
		return $this->_createCol($query->result_array());
	}

	function getProvincies() {
		$query = $this->db->query("SELECT provincie FROM provincie ORDER BY id");
		return $this->_createCol($query->result_array());
	}

	function getMaten($beperking = NULL) {

		if (is_null($beperking)) {
			$query = $this->db->query("SELECT id, type FROM maattype ORDER BY type");
			return $query->result_array();
		} else {
			$query = $this->db->query('SELECT m.id, m.naam, t.type FROM maatnaam AS m, maattype AS t WHERE t.id = ? AND m.type_id=t.id ORDER BY m.naam', array($beperking));
			return $query->result_array();		
		}
	}
	
	function getMaatType($id) {
		$query = $this->db->query('SELECT type FROM maattype WHERE id = ?', array($id));
		$col = $this->_createCol($query->result_array());

		return $col[0];
	}
	
	function getMaatTypeEnNaam($id) {
		$query = $this->db->query('SELECT t.type, m.naam FROM maatnaam AS m, maattype AS t WHERE m.type_id=t.id AND m.id = ?', array($id));
		$row = $query->result_array();

		return array($row[0]['type'], $row[0]['naam']);
	}
	
	private function _createCol($array) {

		$col = array();
		foreach($array as $waarde) {
			$col[] = array_shift($waarde);
		}

		return $col;
	}
	
	private function _getHoeveelheid($id, $hoeveelheid) {

		if (strpos($hoeveelheid, '=') !== 0) {
			return $hoeveelheid;
		} else {
			// in de 'vorige' rij staat hetgene dat voor de '=' in 'hoeveelheid' hoort te staan
			$query = $this->db->query("SELECT naam FROM maat WHERE id = ?", array($id - 1));
			$row = $query->row();
			return '1 ' . $row->naam . ' ' . $hoeveelheid;
		}
	}

}

?>