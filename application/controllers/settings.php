<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends CI_Controller {

	public function index()
	{
		$data['lista_equipamentos'] = $this->equipamento_model->search();
		
		//tipos de equipamentos
		$data['lista_tipo_equipamento'] = $this->tipo_equipamento_model->search();
		
		
		$this->load->view('settings', $data);
	}
	
	public function tipo_equipamento($id) {
		$data['tipo_equipamento'] = $this->tipo_equipamento_model->load($id);
		$this->load->view('settings/tipo_equipamento', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */