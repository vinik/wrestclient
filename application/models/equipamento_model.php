<?php

class Equipamento_model extends CI_Model {
	private $id;
	private $name;
	private $modelo;
	private $tipo;
	private $serial;
	private $nsu;
	
	public function getId() {
		return $this->id;
	}
	
	public function setId($id) {
		$this->id = $id;
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function setName($name) {
		$this->name = $name;
	}
	
	public function getModelo() {
		return $this->modelo;
	}
	
	public function setModelo($modelo) {
		$this->modelo = $modelo;
	}
	
	public function getTipo() {
		return $this->tipo;
	}
	
	public function setTipo($tipo) {
		$this->tipo = $tipo;
	}
	
	public function getSerial() {
		return $this->serial;
	}
	
	public function setSerial($serial) {
		$this->serial = $serial;
	}
	
	public function getNsu() {
		return $this->nsu;
	}
	
	public function setNsu($nsu) {
		$this->nsu = $nsu;
	}
	
	public function search() {
		
		$lista = array();
		
		$this->db->select('*');
		$this->db->from('equipamento');
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row)
			{
				$equipamento = new Equipamento_model();
				$equipamento->setId($row->id);
				$equipamento->setTipo($row->tipo);
				$equipamento->setModelo($row->modelo);
				$equipamento->setSerial($row->serial);
				$equipamento->setNsu($row->nsu);
				$equipamento->setName($row->name);
				
				array_push($lista, $equipamento);
			}
		}
		
		return $lista;
	}
	
	public function load($id) {
		$this->db->select('*');
		$this->db->from('equipamento');
		$this->db->where('id', $id);
		
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			$row = $query->row();
			$this->setId($row->id);
			$this->setTipo($row->tipo);
			$this->setModelo($row->modelo);
			$this->setSerial($row->serial);
			$this->setNsu($row->nsu);
			$this->setName($row->name);
			return true;
		} else {
			return false;
		}
	}
	
	public function getTipoEquipamento() {
		$tipoEquipamento = new Tipo_equipamento_model();
		$tipoEquipamento->load($this->getTipo());
		return $tipoEquipamento;
	}
	
	public function incrementaNsu() {
		$this->setNsu(intval($this->nsu) + 1);
		
		$this->db->where('id', $this->getId());
		$this->db->update('equipamento', array('nsu' => $this->nsu));
	}
}