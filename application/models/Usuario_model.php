<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends Gen_model {
	public $nombre      = null;
	public $correo      = null;
	public $contrasenia = null;
	public $activo      = 0;

	public function __construct($id="")
	{
		parent::__construct();
		$this->setTabla("usuario");
		$this->setLlave("id");

		if (!empty($id)) {
			$this->cargar($id);
		}
	}

	public function guardarUsuario($args=array())
	{
		$data = array(
			"nombre"      => $args["nombre"],
			"correo"      => $args["correo"],
			"contrasenia" => hash("md5", $args["clave"]),
			"activo"      => 1
		);

		return $this->guardar($data);
	}

	public function iniciarSesion($usuario, $clave)
	{
		$tmp = $this->db
		->where("activo", 1)
		->where("correo", $usuario)
		->where("contrasenia", "md5('{$clave}')", false)
		->get("usuario")
		->row();

		if ($tmp) {
			$this->cargar($tmp->id);
			return $this;
		}

		$this->setMensaje("Usuario o contraseña incorrecta.");

		return false;
	}

}

/* End of file Usuario_model.php */
/* Location: ./application/models/Usuario_model.php */