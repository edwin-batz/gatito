<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Partida_carta_model extends Gen_model {

	public $partida_id = null;
	public $carta_id   = null;
	public $orden      = null;
	public $usuario_id = null;
	public $jugado     = 0;

	public function __construct($id="")
	{
		parent::__construct();
		$this->setTabla("partida_carta");
		$this->setLlave("id");

		if (!empty($id)) {
			$this->cargar($id);
		}
	}

	public function ingresarCartas($args=array())
	{
		$this->db
		->query("CALL generar_mazo_partida({$args['0']}, {$args['1']}, {$args['2']})");
	}

	public function buscarPartidaCarta($idPartida)
	{
		return $this->db
		->select("
			a.id,
			a.carta_id,
			a.orden,
			ifnull(a.usuario_id, '') as jugador,
			a.jugado,
			b.nombre as carta_nombre,
			b.descripcion as carta_desc,
			b.imagen,
			b.uso_inmediato,
			b.robar,
			b.tomar,
			c.descripcion as carta_tipo
		")
		->from("partida_carta a")
		->join("carta b", "b.id = a.carta_id")
		->join("carta_tipo c", "c.id = b.carta_tipo_id")
		->where("a.partida_id", $idPartida)
		->order_by("a.orden", "asc")
		->get()
		->result();
	}
}

/* End of file Partida_carta_model.php */
/* Location: ./application/models/Partida_carta_model.php */