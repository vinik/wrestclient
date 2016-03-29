<?php

class Parametro_model extends CI_Model {

	private $id;
	
	private $id_comando;

	private $nome;
	
	private $valor_padrao;

	public function getId() {

		return $this->id;
	}

	public function setId($id) {

		$this->id = $id;
	}

	public function getIdComando() {

		return $this->id_comando;
	}

	public function setIdComando($idComando) {

		$this->id_comando = $idComando;
	}

	public function getNome() {

		return $this->nome;
	}

	public function setNome($nome) {

		$this->nome = $nome;
	}

	public function getValorPadrao() {

		return $this->valor_padrao;
	}

	public function setValorPadrao($v) {

		$this->valor_padrao = $v;
	}
	
	

	public function search() {

		$lista = array();
		
		$this->db->select('*');
		$this->db->from('parametro');
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			foreach($query->result() as $row) {
				$parametro = new Parametro_model();
				$parametro->setId($row->id);
				$parametro->setIdComando($row->id_comando);
				$parametro->setNome($row->nome);
				$parametro->setValorPadrao($row->valor_padrao);
				
				array_push($lista, $parametro);
			}
		}
		
		return $lista;
	}

	public function load($id) {

		$this->db->select('*');
		$this->db->from('parametro');
		$this->db->where('id', $id);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			$row = $query->row();
			$this->setId($row->id);
			$this->setIdComando($row->id_comando);
			$this->setNome($row->nome);
			$this->setValorPadrao($row->valor_padrao);
			return true;
		} else {
			return false;
		}
	}
}