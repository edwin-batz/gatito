<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Partida_model extends Gen_model {

	public $codigo  = null;
	public $privada = 0;
	public $activo  = 1;

	public function __construct($id="")
	{
		parent::__construct();
		$this->setTabla("partida");
		$this->setLlave("id");

		if (!empty($id)) {
			$this->cargar($id);
		}
	}

	public function getPartidaPublica()
	{
		return $this->db
		->select("
			b.partida_id,
			a.codigo
		")
		->from("partida a")
		->join("partida_usuario b", "b.partida_id = a.id")
		->where("a.activo", 1)
		->where("a.privada", 0)
		->where("b.contrincante is null")
		->where("b.ganador is null")
		->group_by("a.id")
		->order_by("a.id", "asc")
		->get()
		->result();
	}

	public function getPartidaActiva($usr)
	{
		$tmp = $this->db
		->select("
			a.partida_id,
			a.anfitrion,
			a.contrincante,
			b.codigo,
			b.turno,
			ifnull(c.nombre, '') as nombre_anfitrion,
			ifnull(d.nombre, '') as nombre_contrincante
		")
		->from("partida_usuario a")
		->join("partida b", "b.id = a.partida_id")
		->join("usuario c", "c.id = a.anfitrion", "left")
		->join("usuario d", "d.id = a.contrincante", "left")
		->where("b.activo", 1)
		->where("(a.anfitrion = {$usr} or contrincante = {$usr})")
		->get();

		if ($tmp->num_rows() > 0) {
			return $tmp->row();
		}

		return false;
	}
}

/* End of file Partida_model.php */
/* Location: ./application/models/Partida_model.php */