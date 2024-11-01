<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Partida_usuario_model extends Gen_model {

	public $partida_id   = null;
	public $anfitrion    = null;
	public $contrincante = null;
	public $ganador      = null;


	public function __construct($id="")
	{
		parent::__construct();
		$this->setTabla("partida_usuario");
		$this->setLlave("id");

		if (!empty($id)) {
			$this->cargar($id);
		}
	}
}

/* End of file Partida_usuario_model.php */
/* Location: ./application/models/Partida_usuario_model.php */