<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Partida extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->output->set_content_type("application/json");
	}

	public function index()
	{
		$this->output->set_status_header(403);
	}

	public function validar()
	{
		if ($this->input->method()  === "post") {
			$this->load->model("Partida_model");
			$this->load->model("Partida_carta_model");

			$usr     = $GLOBALS["_USER"]["jugador"];
			$partida = $this->Partida_model->getPartidaActiva($usr);
			$res     = array(
				"jugador" => $usr
			);

			if ($partida) {
				if (!empty($partida->anfitrion) && !empty($partida->contrincante)) {
					$res["vista"] = 3;
					$res["items"] = $this->Partida_carta_model->buscarPartidaCarta($partida->partida_id);

					if ($partida->contrincante == $usr) {
						$res["contrincante"] = $partida->nombre_anfitrion;
					} else {
						$res["contrincante"] = $partida->nombre_contrincante;
					}

				} else {
					$res["vista"] = 2;
				}

				$res["anfitrion"] = $partida->anfitrion == $usr;
				$res["partida"]   = $partida->codigo;
				$res["turno"]     = $partida->turno == $usr;
			} else {
				$res["vista"] = 1;
			}

			$this->output->set_output(json_encode($res));
		} else {
			$this->output->set_status_header(403);
		}
	}

	public function buscar()
	{
		if ($this->input->method() === "get") {
			$this->load->model("Partida_model");

			$lista = array();
			$tmp   = $this->Partida_model->getPartidaPublica();

			if ($tmp) {
				$lista = $tmp;
			}

			$this->output->set_output(json_encode($lista));

		} else {
			$this->output->set_status_header(403);
		}
	}

	public function crear()
	{
		if ($this->input->method() === "post") {
			$datos = json_decode(file_get_contents("php://input"), true);

			$this->load->model(array(
				"Partida_model",
				"Partida_usuario_model"
			));

			$partida = new Partida_model();
			$usr     = $GLOBALS["_USER"]["jugador"];
			$res     = array();
			$error   = array();

			if ($partida->getPartidaActiva($usr)) {
				$error[] = "Ya cuenta con una partida activa, recargue la pagina para unirse";
			} else {
				$data = array(
					"privada" => verData($datos, "privada", 0),
					"activo"  => 1
				);
				
				if ($partida->guardar($data)) {
					$tmp = new Partida_usuario_model();

					$detalle = array(
						"partida_id" => $partida->getPK(),
						"anfitrion"  => $usr
					);

					if ($tmp->guardar($detalle)) {
						$res = array(
							"mensaje" => "Partida generada con éxito {$partida->codigo}"
							//"item" => $partida->codigo
						);
					} else {
						$partida->guardar(array("activo" => 0));
						$error[] = "Ocurrió un error inesperado, intente nuevamente";
					}
				} else {
					$error[] = "La partida no fue generada, intente nuevamente";
				}
			}

			if (count($error) === 0) {
				$this->output
				->set_status_header(201)
				->set_output(json_encode($res));
			} else {
				$this->output
				->set_status_header(400)
				->set_output(json_encode(["errores" => implode("\n", $error)]));
			}
		} else {
			$this->output->set_status_header(403);
		}
	}

	public function unirse()
	{
		if ($this->input->method() === "post") {
			$datos = json_decode(file_get_contents("php://input"), true);

			if (verData($datos, "codigo")) {
				$this->load->model(array(
					"Partida_model",
					"Partida_usuario_model"
				));

				$partida = new Partida_model();
				$usr     = $GLOBALS["_USER"]["jugador"];
				$res     = array();
				$error   = array();

				if ($partida->getPartidaActiva($usr)) {
					$error[] = "Ya cuenta con una partida activa, recargue la pagina para unirse";
				} else {
					$existe = $partida->buscar([
						"codigo" => $datos["codigo"],
						"_uno"   => true
					]);

					if ($existe) {
						if ($existe->activo == 1) {
							$detalle = $this->Partida_usuario_model->buscar(array(
								"partida_id" => $existe->id,
								"_uno"       => true
							));

							if ($detalle) {
								if ($detalle->anfitrion != $usr) {
									if (empty($detalle->contrincante) && empty($detalle->ganador)) {
										$tmp = new Partida_usuario_model($detalle->id);

										if ($tmp->guardar(array("contrincante" => $usr))) {
											$res = array("mensaje" => "Uniendote a la sala, espera un momento");
										} else {
											$error[] = "Ocurrió un error inesperado, intente nuevamente";
										}
									} else {
										$error[] = "La sala ya esta llena";
									}
								} else {
									$error[] = "Error, no puedes competir contra ti mismo";
								}
							} else {
								$error[] = "Error inesperado, la sala es invalida";
							}
						} else {
							$error[] = "Partida finalizada";
						}
					} else {
						$error[] = "Codigo de sala invalida";
					}
				}
			} else {
				$error[] = "Debe ingresar un código para unirse";
			}
			
			if (count($error) === 0) {
				$this->output
				->set_status_header(200)
				->set_output(json_encode($res));
			} else {
				$this->output
				->set_status_header(400)
				->set_output(json_encode(["errores" => implode("\n", $error)]));
			}
		} else {
			$this->output->set_status_header(403);
		}
	}
}

/* End of file Partida.php */
/* Location: ./application/controllers/Partida.php */