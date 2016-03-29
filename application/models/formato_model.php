<?php

class Formato_model extends CI_Model {
	
	private $id;
	private $nome;
	private $tipo;
	
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
	
	public function getTipo() {
		return $this->tipo;
	}
	
	public function setTipo($tipo) {
		$this->tipo = $tipo;
	}
	
}