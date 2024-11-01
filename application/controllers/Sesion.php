<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sesion extends CI_Controller {

	public function index()
	{
		$this->output->set_status_header(403);
	}

	public function login()
	{
		if ($this->input->method() === "post") {
			if ($this->input->post("clave") && $this->input->post("correo")) {
				$usr = new Usuario_model();

				if ($usr->iniciarSesion($_POST["correo"], $_POST["clave"])) {
					$this->load->helper("ayuda");
					setSesion($this->session, $usr);

					redirect("principal");
				} else {
					$this->session->set_userdata(["error_login" => $usr->getMensaje()]);
				}
			} else {
				$this->session->set_userdata(array("error_login" => array("Ingrese credenciales.")));
			}

			redirect("sesion/login");
		} else {
			if ($this->session->has_userdata("user")) {
				redirect("principal");
			} else {
				$this->load->view("principal", array(
					"vista" => "login/form"
				));
			}
		}
	}

	public function registro()
	{
		if ($this->input->server("REQUEST_METHOD") === "GET") {
			//$this->datos["menu"] = "menu";
			$this->datos["vista"] = "login/form_registro";

			$this->load->view("principal", $this->datos);
		} elseif ($this->input->server("REQUEST_METHOD") === "POST") {

			$res = array("exito" => false, "msg" => "¡Error!");

			if (
				$this->input->post("nombre") &&
				$this->input->post("correo") &&
				$this->input->post("clave") &&
				$this->input->post("clave1")
			) {
				$clvp = $this->input->post("clave");
				$clvs = $this->input->post("clave1");

				if (strlen($clvp) >= 8 && strlen($clvs) >= 8) {
					if ($clvp == $clvs) {
						$existeCorreo = $this->Usuario_model->buscar(array("correo" => $_POST["correo"]));
						$existeNombre = $this->Usuario_model->buscar(array("nombre" => $_POST["nombre"]));

						if ($existeNombre) {

							$this->session->set_userdata(array(
								"error_registro" => array("Ya existe un jugador con el mismo nombre")
							));
						} else {
							if ($existeCorreo) {
								$this->session->set_userdata(array(
									"error_registro" => array("Ya existe un jugador con el mismo correo")
								));
							} else {
								$user = new Usuario_model();

								if ($user->guardarUsuario($_POST)) {
									$this->session->set_userdata(array(
										"mensaje_login" => array("Jugador [{$_POST['nombre']}] creado con éxito [{$_POST['correo']}]")
									));

									redirect("sesion/login");
								}
								
								$this->session->set_userdata(array(
									"error_registro" => $user->getMsg()
								));
							}
						}
					} else {
						$this->session->set_userdata(array(
							"error_registro" => array("Las contraseñas no coinciden")
						));
					}
				} else {
					$this->session->set_userdata(array(
						"error_registro" => array("La contraseña es muy débil")
					));
				}
			} else {
				$this->session->set_userdata(array(
					"error_registro" => array("Faltan datos obligatorios")
				));
			}

			redirect("sesion/registro");
		} else {
			redirect("sesion/login");
		}
	}

	public function salir()
	{
		$this->session->sess_destroy();
		redirect('sesion/login');
	}
}

/* End of file Sesion.php */
/* Location: ./application/controllers/Sesion.php */