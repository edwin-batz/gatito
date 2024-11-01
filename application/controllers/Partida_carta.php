<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Partida_carta extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->output->set_content_type("application/json");
	}

	public function index()
	{
		$this->output->set_status_header(403);
	}

	public function movimiento($id)
	{
		if ($this->input->method() === "post") {
			$datos = json_decode(file_get_contents("php://input"), true);
			$res   = array();
			$error = array();

			if (
				verData($datos, "movimiento") ||
				verData($datos, "robo") ||
				verData($datos, "toma")
			) {
				$this->load->model(array(
					"Partida_model",
					"Partida_carta_model",
					"Carta_model"
				));				

				if (verData($datos, "movimiento")) {
					$usr      = $GLOBALS["_USER"]["jugador"];
					$oponente = $usr == $partida->anfitrion ? $usr : $partida->contrincante;

					$mov     = new Partida_carta_model($datos["movimiento"]);
					$carta   = new Carta_model($mov->carta_id);
					$partida = new Partida_model($mov->partida_id);

					$data = array(
						"usuario_id" => $usr,
						"jugado"     => 1
					);

					$mov->guardar($data);

					$partidaData = array(
						"turno"       => null,
						"doble_turno" => null
					);

					if (!empty($partida->doble_turno)) {
						$partidaData["turno"] = $partidaData->doble_turno;
					} else {
						if ($carta->turno == 0) {
							$partidaData["turno"] = $usr;
						} elseif ($carta->turno > 1) {
							$partidaData["doble_turno"] = $oponente; 
						} else {
							$partidaData["turno"] = $oponente;
						}
					}

					$partida->guardar($partidaData);
				}

				if (verData($datos, "robo")) {
					for ($i=0; $i < count($datos["robo"]); $i++) { 
						$tmp = new Partida_carta_model($datos["robo"][$i]);
						$tmp->guardar(array("jugador_id" => $usr));
					}
				}

				if (verData($datos, "toma")) {
					for ($i=0; $i < count($datos["toma"]); $i++) { 
						$tmp = new Partida_carta_model($datos["toma"][$i]);
						$tmp->guardar(array("jugador_id" => $usr));
					}
				}
				
				$res["exito"] = true;
			} else {
				$error[] = "Error desconocido juega de nuevo";
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


	private function turno()
	{
		
	}
}

/* End of file Partida_carta.php */
/* Location: ./application/controllers/Partida_carta.php */