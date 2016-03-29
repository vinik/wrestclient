<?php

class Tipo_equipamento_model extends CI_Model {

	private $id;

	private $nome;

	public function getId() {

		return $this->id;
	}

	public function setId($id) {

		$this->id = $id;
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
		$this->db->from('tipo_equipamento');
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			foreach($query->result() as $row) {
				$tipo_equipamento = new Tipo_equipamento_model();
				$tipo_equipamento->setId($row->id);
				$tipo_equipamento->setNome($row->nome);
				
				array_push($lista, $tipo_equipamento);
			}
		}
		
		return $lista;
	}

	public function load($id) {

		$this->db->select('*');
		$this->db->from('tipo_equipamento');
		$this->db->where('id', $id);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			$row = $query->row();
			$this->setId($row->id);
			$this->setNome($row->nome);
			return true;
		} else {
			return false;
		}
	}

	public function listaComandos() {
		$lista = array();

		$this->db->select('*');
		$this->db->from('comando');
		$this->db->join('comando_tipo_equipamento_xref', 'id=id_comando');
		$this->db->where('id_tipo_equipamento', $this->getId());
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0) {
			foreach($query->result() as $row) {
				$comando = new Comando_model();
				$comando->setId($row->id);
				$comando->setNome($row->nome);
				$comando->setUrlBase($row->url_base);
				
				array_push($lista, $comando);
			}
		}
		
		return $lista;
	}

}