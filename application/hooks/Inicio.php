<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio
{
	protected $ci;
	private $paths;

	public function __construct()
	{
        $this->ci =& get_instance();

        $this->paths = array(
        	"/sesion/login",
			"/sesion/registro"
        );
	}

	public function verificaSesion()
	{
		if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
			die();
		} else {
			$continuar = false;

			if ($this->ci->session->has_userdata("user")) {
				$continuar = $this->auth_sesion();
			} else {
				if (in_array($_SERVER["PATH_INFO"], $this->paths)) {
					return TRUE;
				} else {
					redirect("sesion/login");
				}
			}

			if ($continuar === false) {
				$this->ci->output->set_status_header(401);
				exit;
			}
		}
	}

	public function auth_sesion()
	{
		$usr = $this->ci->session->userdata("user");
		
		$GLOBALS["_USER"] = $usr;
		
		return true;
	}
}

/* End of file Inicio.php */
/* Location: ./application/hooks/Inicio.php */
