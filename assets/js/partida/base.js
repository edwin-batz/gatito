Vue.prototype.urlBase = "/gatito/index.php/partida"

var appPartida = new Vue({
	el: "#appPartida",
	data: {
		cargando: false,
		websocket: null,
		partida: null,
		jugador: null,
		anfitrion: false,
		contrincante: null,
		vista: 0,
		turno: false,
		items: [],
		errores: null,
		mensaje: null
	},
	created: function () {
		this.generarWebsocket()
		this.validar();
	},
	methods: {
		validar: function () {
			this.cargando     = true
			this.jugador      = null;
			this.partida      = null;
			this.vista        = 0;
			this.turno        = 0;
			this.anfitrion    = false;
			this.contrincante = false;
			this.items        = []
			
			axios
			.post(`${this.urlBase}/validar/`)
			.then(res => {
				if (res.data.jugador) {
					this.jugador = res.data.jugador
				}

				if (res.data.partida) {
					this.partida = res.data.partida
				}				

				if (res.data.turno) {
					this.turno = res.data.turno
				}

				if (res.data.anfitrion) {
					this.anfitrion = res.data.anfitrion
				}

				if (res.data.contrincante) {
					this.contrincante = res.data.contrincante
				}

				if (res.data.items) {
					this.items = res.data.items
				}

				if (res.data.vista) {
					this.vista = res.data.vista
				}
			})
			.finally(() => { this.cargando = false })
			.catch(error => {
				if (error.response && error.response.data.errores) {
					this.errores = error.response.data.errores
				} else {
					this.errores = error.message
				}
			})
		},
		generarWebsocket: function () {
			this.websocket           = new WebSocket("ws://localhost:8282");
			this.websocket.onmessage = this.onMessage;
			this.websocket.onopen    = () => {
                this.websocket.send(JSON.stringify({
					"accion": "crear"
				}))
            }
		},
		onMessage(event) {
			console.log(event)
		},
		iniciarPartida: function() {
			if (this.websocket != null) {
				this.websocket.send(JSON.stringify({
					"accion": "iniciar_partida",
					"codigo": this.partida,
					"jugador": this.jugador
				}))
			}
		},
		realizarMovimiento: function() {
			if (this.websocket != null) {
				this.websocket.send(JSON.stringify({
					"accion": "movimiento",
					"codigo": this.partida,
					"jugador": this.jugador
				}))
			}
		}

		/*limpiarMensaje: function () {
			this.errores    = null
			this.mensaje    = null
		},
		buscar: function () {
			this.cargando = true
			this.limpiarMensaje()
			
			axios
			.get(`${this.urlBase}/buscar`, {params: this.bform})
			.then(res => {
				this.items = res.data
			})
			.finally(() => { this.cargando = false })
			.catch(e => {
				alert(e.message)
			})
		},
		crear: function () {
			this.btnGuardar = true
			this.limpiarMensaje()
			
			axios
			.post(`${this.urlBase}/crear/`, this.form)
			.then(res => {
				this.mensaje = res.data.mensaje
			})
			.finally(() => { this.btnGuardar = false })
			.catch(error => {
				if (error.response && error.response.data.errores) {
					this.errores = error.response.data.errores
				} else {
					this.errores = error.message
				}
			})
		},
		unirse: function () {
			this.btnGuardar = true
			this.limpiarMensaje()
			
			axios
			.post(`${this.urlBase}/unirse/`, this.form)
			.then(res => {
				this.mensaje = res.data.mensaje
			})
			.finally(() => { this.btnGuardar = false })
			.catch(error => {
				if (error.response && error.response.data.errores) {
					this.errores = error.response.data.errores
				} else {
					this.errores = error.message
				}
			})
		},
		publica: function (codigo) {
			this.btnGuardar = true
			this.limpiarMensaje()
			
			axios
			.post(`${this.urlBase}/unirse/`, {codigo:codigo})
			.then(res => {
				this.mensaje = res.data.mensaje
			})
			.finally(() => { this.btnGuardar = false })
			.catch(error => {
				if (error.response && error.response.data.errores) {
					this.errores = error.response.data.errores
				} else {
					this.errores = error.message
				}
			})
		}*/
	},
	components: {
		"form-partida": formPartida,
		"espera-partida": esperaPartida,
		"sala-partida": salaPartida
	},
	computed: {
		
	},
	watch: {
		"vista": function (actual, anterior) {
			if (actual) {
				if (actual != anterior) {
					this.iniciarPartida()
				}
			}
		}
	}
})