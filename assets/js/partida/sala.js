Vue.prototype.urlBase = "/gatito/index.php/"

let salaPartida = {
	template: "#sala-partida",
	props:["jugador", "contrincante", "turno", "items"],
	data: function () {
		return {
			cartaActiva: null,
			mazoActivo: false,
			puedeLanzar: true,
			puedeTomar: false,
			puedeRobar: false,
			roba: [],
			toma: [],
			movimiento: null
		}
	},
	created: function () {
		
	},
	methods: {
		limpiar: function () {
			this.roba        = []
			this.toma        = []
			this.movimiento  = null
			this.puedeTomar  = false
			this.puedeRobar  = false
			this.puedeLanzar = true
		},
		lanzar: function (id) {
			if (this.movimiento == null && this.puedeLanzar) {
				this.movimiento = id

				let idx = this.items.findIndex(o => {
					return o.id == id
				})

				this.items[idx].jugado = 1

				this.puedeTomar  = this.items[idx].tomar == 1
				this.puedeRobar  = this.items[idx].robar == 1
				this.puedeLanzar = false
			}
		},
		tomarCartaMazo: function () {
			if (this.mazo.length > 0 && this.puedeTomar) {
				if (this.toma.length == 0) {
					let tmp = this.mazo[0]

					this.toma.push(tmp.id)

					let idx = this.items.findIndex(o => {
						return o.id == tmp.id
					})

					this.items[idx].jugador = this.jugador
					this.puedeTomar         = false
				}
			}
		},
		tomarCartaOponente: function (id) {
			this.roba.push(id)

			let idx = this.items.findIndex(o => {
				return o.id == tmp.id
			})

			this.items[idx].jugador = this.jugador
			this.puedeRobar         = false
		},
		enviarMovimiento: function () {
			/*this.turno = 0
			
			let data = {
				movimiento: this.movimiento,
				roba: this.roba,
				toma: this.toma
			}
			
			console.log(data)

			this.websocketMovimiento()*/
			this.$parent.turno = 0
			
			let data = {
				movimiento: this.movimiento,
				roba: this.roba,
				toma: this.toma
			}


			axios
			.post(`${this.urlBase}/partida_carta/movimiento`, data)
			.then(res => {

			})
			.finally(() => { this.websocketMovimiento() })
			.catch(error => {
				if (error.response && error.response.data.errores) {
					console.log(error.response.data.errores)
				} else {
					console.log(error.message)
				}
			})
		},
		websocketMovimiento: function () {
			//this.ejecutarMovimiento()
			this.limpiar()
		}
	},
	computed: {
		mano: function () {
			let temp = []
			if (this.items.length > 0) {
				temp = this.items.filter(o => {
					return o.jugador == this.jugador && o.jugado == 0
				})
			}

			return temp
		},
		mazo: function () {
			let temp = []

			if (this.items.length > 0) {
				temp = this.items.filter(o => {
					return o.jugador === ""
				})
			}

			return temp
		},
		jugado: function () {
			let temp = null

			if (this.items.length > 0) {
				temp = this.items.filter(o => {
					return o.jugado == 1
				}).pop()
			}

			return temp
		}
	},
	watch: {
		"puedeLanzar": function (valor) {
			if (!valor && !this.puedeTomar && !this.puedeRobar) {
				this.enviarMovimiento()
			}
		},
		"puedeTomar": function (valor) {
			if (!valor && !this.puedeLanzar && !this.puedeRobar) {
				this.enviarMovimiento()
			}
		},
		"puedeRobar": function (valor) {
			if (!valor && !this.puedeLanzar && !this.puedeTomar) {
				this.enviarMovimiento()
			}
		}
	}
}