<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carta_model extends CI_Model {

	public $nombre        = null;
	public $descripcion   = null;
	public $carta_tipo_id = null;
	public $cantidad      = 1;
	public $imagen        = null;
	public $uso_inmediato = 0;
	public $activo        = 1;
	public $turno         = 1;
	public $tomar         = 1;
	public $robar         = 0;

	public function __construct($id="")
	{
		parent::__construct();
		$this->setTabla("carta");
		$this->setLlave("id");

		if (!empty($id)) {
			$this->cargar($id);
		}
	}
}

/* End of file Carta_model.php */
/* Location: ./application/models/Carta_model.php */