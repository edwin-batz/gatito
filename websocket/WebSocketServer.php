<?php

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class WebSocketServer implements MessageComponentInterface {
	protected $cliente;
	protected $partida;

	public function __construct() {
		$this->cliente = new \SplObjectStorage;
		$this->partida = [];
	}

	public function onOpen(ConnectionInterface $conn) {
		$this->cliente->attach($conn);
	}

	public function onMessage(ConnectionInterface $from, $msg) {
		$data = json_decode($msg, true);

		//print_r($from);
		//echo "\n";
		//print_r($data);
		echo "\n";
		print_r($data);
		echo "\n";
		print_r($this->partida);
		echo "\n";

	/*	if (
			verData($data, "accion") &&
			verData($data, "vista")
		) {
			$res    = array(
				"accion"     => "",
				"movimiento" => "",
				"vista"      => $data["vista"]
			);
			
			if (verData($data, "codigo")) {
				// code...
			} else {
				$res["accion"] = "cambio_vista";
				$from->send(json_encode($res));
			}
		} else {

		}*/

		if (
			isset($data["accion"]) &&
			isset($data["codigo"])
		) {
			$codigo = $data["codigo"];
			
			if ($data["accion"] == "iniciar_partida") {
				if (!isset($this->partida[$codigo])) {
					$this->partida[$codigo] = array();
				}

				$jugadores = count($this->partida[$codigo]);

				if ($jugadores < 2) {
					$this->partida[$codigo][] = $from;


					if ($jugadores == 2) {
						$res["accion"] = "iniciar_partida";
						
						foreach ($this->partida[$codigo] as $clt) {
							$clt->send(json_encode($res));
						}
					} else {
						$res["accion"] = "espera_partida";
						
						$from->send(json_encode($res));
					}
				}
			} elseif ($data["accion"] == "cerrar_partida") {
				echo "Partida finalizada | {$codigo}";
				
				unset($this->partida[$codigo]);
			} elseif ($data["accion"] == "movimiento") {

				if (isset($data["movimiento"])) {
					$movimiento = $data["movimiento"];

					foreach ($this->partida[$codigo] as $clt) {
						$res["accion"]     = "movimiento";
						$res["movimiento"] = $movimiento;

						$clt->send(json_encode($res));
					}
				} else {
					echo "Movimiento no permitido, faltan datos 0_o";
				}
			} else {
				echo "Acción no permitida | code := {$codigo} ";
			}
		} else {
			echo "Faltan datos 0_o";
		}


		/*$data = json_decode($msg);
		switch ($data->action) {
			case 'join_room':
			$roomId = $data->roomId;
			if (!isset($this->partida[$roomId])) {
				$this->partida[$roomId] = [];
			}

				// Añadimos el cliente a la sala
			$this->partida[$roomId][] = $from;

				// Si hay dos jugadores en la sala, se inicia el juego
			if (count($this->partida[$roomId]) == 2) {
				foreach ($this->partida[$roomId] as $client) {
					$client->send(json_encode(['action' => 'start_game']));
				}
			}
			break;

			case 'make_move':
			$roomId = $data->roomId;
			$move = $data->move;

			// Enviamos el movimiento al oponente
			foreach ($this->partida[$roomId] as $client) {
				if ($client !== $from) {
					$client->send(json_encode(['action' => 'opponent_move', 'move' => $move]));
				}
			}
			break;
		}*/
	}

	/**
	 *
	 * Eliminamos al cliente cuando cierra la conexión 
	 *
	**/
	public function onClose(ConnectionInterface $conn) {
		// 
		$this->cliente->detach($conn);
	}

	public function onError(ConnectionInterface $conn, \Exception $e) {
		$conn->close();
	}
}
