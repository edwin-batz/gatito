Vue.prototype.urlBase = "/pod/index.php/reporte/venta"

var AppRepGanancia = new Vue({
	el: "#AppRepGanancia",
	data: {
		cargando: false,
		btnBuscar: false,
		mostrar: false,
		tempTd: null,
		bform: {},
		items: [],
		cat: {
			tipo: [],
			sub_tipo: [],
			venta_tipo: []
		}
	},
	created: function () {
		var now = new Date();
    	now.setMinutes(now.getMinutes() - now.getTimezoneOffset());

		this.bform.fdel       = now.toJSON().slice(0, 10);
		this.bform.fal        = now.toJSON().slice(0, 10);
		this.bform.venta_tipo = 1;
		
		this.getDatos();
	},
	methods: {
		getDatos: function () {
			this.cargando = true
			
			axios
			.get(`${this.urlBase}/get_datos_ganancia`)
			.then(res => {
				this.cat = res.data
			})
			.finally(() => { this.cargando = false })
			.catch(e => {
				alert(e.message)
			})
		},
		buscar: function () {
			this.btnBuscar = true
			this.tempTd    = null
			this.items     = []
			
			axios
			.post(`${this.urlBase}/ganancia`, this.bform)
			.then(res => {
				this.items = res.data				
			})
			.finally(() => { this.btnBuscar = false })
			.catch(e => {
				alert(e.message)
			})
		},
		reporteListo: function () {
			this.btnBuscar = false
		},
		mostrarForm: function (valor) {
			this.mostrar = valor
		}
	},
	computed: {
		getSubTipo: function () {
			return this.cat.sub_tipo.filter(o => {
				return o.id_tipo_articulo == this.bform.tipo
			})
		},
		listaTipo: function () {
			let tmp = {}

			this.items.forEach(function(o, i) {
				if (!tmp[o.tipo]) {
					tmp[o.tipo] = {
						ganancia: 0,
						monto_costo: 0,
						monto_venta: 0
					}
				}

				tmp[o.tipo].ganancia    += Number(o.ganancia)
				tmp[o.tipo].monto_costo += Number(o.monto_costo)
				tmp[o.tipo].monto_venta += Number(o.monto_venta)
			})

			return tmp
		},
		listaSubTipo: function () {
			let tmp = {}

			this.items.forEach(function(o, i) {
				if (!tmp[o.sub_tipo]) {
					tmp[o.sub_tipo] = {
						ganancia: 0,
						monto_costo: 0,
						monto_venta: 0
					}
				}

				tmp[o.sub_tipo].ganancia    += Number(o.ganancia)
				tmp[o.sub_tipo].monto_costo += Number(o.monto_costo)
				tmp[o.sub_tipo].monto_venta += Number(o.monto_venta)
			})

			return tmp
		}
		/*totalTipo: function () {
			
		},
		totalSubTipo: function () {
			
		}*/
	},
	watch: {
		tempTd: function(){
			if (this.items.length > 0 && (document.getElementsByClassName("trTablaGanancia").length == this.items.length)) {
				$("#tblRepGanancia").DataTable({
					destroy: true,
					dom: "Bfrtip",
					buttons: [
						"excel",
						"pdf"
					]
				})
			}
		}
	}
})