<?php

class Comando_model extends CI_Model {
	private $id;
	private $nome;
	private $url_base;
	private $method;
	private $comid;
	
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
	
	public function getUrlBase() {
		return $this->url_base;
	}
	
	public function setUrlBase($urlBase) {
		$this->url_base = $urlBase;
	}
	
	public function getMethod() {
		return $this->method;
	}
	
	public function setMethod($method) {
		$this->method = $method;
	}
	
	public function isComId() {
		return $this->comid ? true : false;
	}
	
	public function setComId($comId) {
		$this->comid = $comId;
	}
	
	public function search() {
	
		$lista = array();
	
		$this->db->select('*');
		$this->db->from('comando');
		$query = $this->db->get();
	
		if($query->num_rows() > 0) {
			foreach($query->result() as $row) {
				$comando = new Comando_model();
				$comando->setId($row->id);
				$comando->setNome($row->nome);
				$comando->setUrlBase($row->url_base);
				$comando->setMethod($row->method);
				$comando->setComId($row->comid ? true : false);
	
				array_push($lista, $comando);
			}
		}
	
		return $lista;
	}
	
	public function load($id) {
	
		$this->db->select('*');
		$this->db->from('comando');
		$this->db->where('id', $id);
		$query = $this->db->get();
	
		if($query->num_rows() > 0) {
			$row = $query->row();
			$this->setId($row->id);
			$this->setNome($row->nome);
			$this->setUrlBase($row->url_base);
			$this->setMethod($row->method);
			$this->setComId($row->comid ? true : false);
			return true;
		} else {
			return false;
		}
	
		return $lista;
	}
	
	public function listaParametros() {
	
		$lista = array();
	
		$this->db->select('*');
		$this->db->from('parametro');
		$this->db->where('id_comando', $this->getId());
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
}