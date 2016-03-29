<?php

class Api_model extends CI_Model {

	private $id;
	
	private $url;

	private $nome;

	public function getId() {

		return $this->id;
	}

	public function setId($id) {

		$this->id = $id;
	}

	public function getUrl() {

		return $this->url;
	}

	public function setUrl($Url) {

		$this->url = $Url;
	}

	public function getNome() {

		return $this->nome;
	}

	public function setNome($nome) {

		$this->nome = $nome;
	}

	public function search() {

		$lista = array();
		
		$this->db->select('*');
		$this->db->from('api');
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			foreach($query->result() as $row) {
				$parametro = new Api_model();
				$parametro->setId($row->id);
				$parametro->setUrl($row->url);
				$parametro->setNome($row->nome);
				
				array_push($lista, $parametro);
			}
		}
		
		return $lista;
	}

	public function load($id) {

		$this->db->select('*');
		$this->db->from('api');
		$this->db->where('id', $id);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			$row = $query->row();
			$this->setId($row->id);
			$this->setUrl($row->url);
			$this->setNome($row->nome);
			return true;
		} else {
			return false;
		}
	}
}