<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    /*public function __construct() {
        parent::__construct();
        $this->load->model('Torneo');
    }*/


	public function __construct() {
        parent::__construct();
        
        
    }

	public function index()
	{
		
		$data['files_css'] = array('css/torneo.css');

		$this->load->view('welcome_message',$data);


	}

	public function torneo()
	{	
		// Cargar el modelo 'Torneo'
		$this->load->model('Torneo');
		
		$torneo = new Torneo();

		$tipo = $this->input->get('tipo', TRUE);

		if(in_array($tipo, array('m','f'))){
			//definimos los jugadores que van a participar en base al genero
			$id_torneo = $torneo->armar_torneo($tipo);
					
			//generamos los partidos de la primera ronda
			$torneo->armar_cuadro();

			//disputamos todos los partidos de todas las rondas hasta obetener el/la ganador/a del torneo
			$torneo->resolver_cuadro();

			$data['partidos'] = $torneo->get_partidos();
		}else{

			$data['error'] = "Tipo de torneo inválido.";
		}

		
				
		$this->load->view('torneo',$data);
		
	}
}
