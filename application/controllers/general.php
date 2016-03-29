<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class General extends CI_Controller {

	public function index()
	{
		
		$data['lista_equipamentos'] = $this->equipamento_model->search();
		
		$this->load->view('general/home', $data);
	}
	
	public function equipamento($id) {
		$data['lista_equipamentos'] = $this->equipamento_model->search();
		$this->equipamento_model->load($id);
		$data['equipamento'] = $this->equipamento_model;
		
		$this->tipo_equipamento_model->load($this->equipamento_model->getTipo());
		$data['tipo_equipamento'] = $this->tipo_equipamento_model;
		
		$data['lista_comandos'] = $this->comando_model->search();
		$data['lista_comandos_disponiveis'] = $this->tipo_equipamento_model->listaComandos();
		
		$this->load->view('general/equipamento', $data);
	}
	
	public function requisicao($idEquipamento, $idComando) {
		$data['lista_equipamentos'] = $this->equipamento_model->search();
		$this->equipamento_model->load($idEquipamento);
		$data['equipamento'] = $this->equipamento_model;
		
		$this->tipo_equipamento_model->load($this->equipamento_model->getTipo());
		$data['tipo_equipamento'] = $this->tipo_equipamento_model;
		
		$data['lista_comandos'] = $this->comando_model->search();
		$data['lista_comandos_disponiveis'] = $this->tipo_equipamento_model->listaComandos();
		$this->comando_model->load($idComando);
		$data['comando'] = $this->comando_model;
		
		$data['api_list'] = $this->api_model->search();
		
		$data['lista_parametros'] = $this->comando_model->listaParametros();
		
		$this->load->view('general/requisicao', $data);
	}
	
	public function do_request($idEquipamento, $idComando) {
		
		$this->equipamento_model->load($idEquipamento);
		$data['equipamento'] = $this->equipamento_model;
		
		$this->equipamento_model->incrementaNsu();
		
		$tipoEquipamento = $this->equipamento_model->getTipoEquipamento();
		
		$this->comando_model->load($idComando);
		$data['comando'] = $this->comando_model;
		
		$lista_parametros = $this->comando_model->listaParametros();
		
		//API
		$apiId = $this->input->post('api_id');
		if ($this->api_model->load($apiId)) {
			$this->session->set_userdata('api_id', $apiId);
		}
		$url = $this->api_model->getUrl();
		$url .= '/' . $this->comando_model->getUrlBase() . '.json';
		
		$params = array();
		
		foreach ($lista_parametros as $item_parametro) {
			$params[$item_parametro->getNome()] = $this->input->post($item_parametro->getNome());
		}
		
		//TODO campos padrões
		$params['datetime'] = date('Ymdhis');
		$params['serial'] = $this->equipamento_model->getSerial();
		$params['version'] = API_VERSION;
		$params['nsu'] = intval($this->equipamento_model->getNsu());
		$params['model'] = $this->equipamento_model->getModelo();
		$params['type'] = $tipoEquipamento->getNome();
		
		$curl = curl_init();
		
		
		//curl_setopt($curl, CURLOPT_HEADER, TRUE);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		
		switch ($this->comando_model->getMethod()) {
			case 'GET':
				$i=0;
				foreach ($params as $name => $value) {
					if ($i==0) {
						$url .= '?';
					} else {
						$url .= '&';
					}
					$url .= $name . '=' . $value;
					$i++;
				}
				
				curl_setopt($curl, CURLOPT_HTTPGET, TRUE);
				break;
			case 'POST':
				curl_setopt($curl, CURLOPT_POST, TRUE);
				curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
				break;
			case 'PUT':
				curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
				curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
				break;
			case 'DELETE':
				curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
				curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
				break;
			case 'OPTIONS':
				curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "OPTIONS");
				break;
			default:
				break;
		}
		
		curl_setopt($curl, CURLOPT_URL, $url);
		
		$response = curl_exec($curl);
		
		$info = curl_getinfo($curl);
		
		curl_close($curl);
		
		die($response);
		
		$arrResponse = json_decode($response);
		die(var_dump($arrResponse));
	}
	
	public function authorization() {
		$this->load->view('general/authorization');
	}
	
	public function authorization_request() {
		
		$url = 'http://10.10.10.1/s2way/api';
		$url .= '/authorization.json';
		
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		
		
		//TODO campos padrões
		$datetime = date('Ymdhis');
		$serial = '51798312';
		$version = '34';
		$nsu = 1;
		$model = 'ANDROID';
		$type = 'ANDROID';
		
		
		$params = array(
			'username' => $username,
			'password' => $password,
				
			//TODO campos padrões
			'datetime' => $datetime,
			'serial' => $serial,//TODO
			'nsu' => $nsu,//TODO
			'version' => $version,//TODO
			'model' => $model,//TODO
			'type' => $type,//TODO
			
		);
		
		$curl = curl_init();
		
		curl_setopt($curl, CURLOPT_URL, $url);
		
		curl_setopt($curl, CURLOPT_HEADER, TRUE);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		
		curl_setopt($curl, CURLOPT_POST, TRUE);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
		
		$response = curl_exec($curl);
		
		curl_close($curl);
		
		echo $response;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */