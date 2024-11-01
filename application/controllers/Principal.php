<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Principal extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->datos = array();

		$this->load->model(array(
			"Partida_model"
		));
	}

	public function index()
	{
		//print_r ($GLOBALS["_USER"]);
		/*$usuario = $this->Usuario_model->buscar(array(
			"usuario"
		));*/
		//$partida = $this->Partida_model->getPartidaActiva($GLOBALS["_USER"]["jugador"]);


		

		/*echo "<pre>";
		print_r ($partida);
		echo "</pre>";*/
		
		//Crear partida
		
		/*$this->load->view("header");
		$this->load->view("partida/base");
		$this->load->view("footer", array(
			"scripts" => array(
				(object) array("ruta" => "assets/js/partida/crear/base.js", "print" => true),
				(object) array("ruta" => "assets/js/principal.js", "print" => true)
			)
		));*/

		//sala de espera
		$this->load->view("header");
		$this->load->view("partida/base", array(
			"partida" => 1,
			"jugador" => 2
		));
		$this->load->view("footer", array(
			"scripts" => array(
				(object) array("ruta" => "assets/js/partida/form.js", "print" => true),
				(object) array("ruta" => "assets/js/partida/espera.js", "print" => true),
				(object) array("ruta" => "assets/js/partida/sala.js", "print" => true),
				(object) array("ruta" => "assets/js/partida/base.js", "print" => true)
			)
		));
	}

	public function about()
	{
		$this->load->view("extra/about", $this->datos);
	}
}

/* End of file Principal.php */
/* Location: ./application/controllers/Principal.php */