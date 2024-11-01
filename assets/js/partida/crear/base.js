Vue.prototype.urlBase = "/gatito/index.php/partida"

var appCrearPartida = new Vue({
	el: "#appCrearPartida",
	data: {
		cargando: false,
		errores: null,
		mensaje: null,
		items: [],
		btnGuardar: false,
		btnBuscar: false,
		form: {
			privada:0,
			codigo: null
		}
	},
	created: function () {
		this.form = {
			privada: 0,
			codigo: null
		}

		this.buscar()
	},
	methods: {
		limpiarMensaje: function () {
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
		}
	},
	computed: {
		
	},
	watch: {

	}
})