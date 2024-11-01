<div id="AppRepGanancia">
	<div v-if="cargando">
		<h4 class="spinner-border spinner-border-sm"></h4>
		Cargando...
	</div>
	<template v-else>
		<div class="card shadow-sm mt-2 mb-2">
			<div class="card-body container-fluid">
				<div class="row" v-if="mostrar === false">
					<div class="ml-auto mr-3">
						<button class="btn btn-sm btn-default" type="button" @click.prevent="mostrarForm(!mostrar)"><i class="oi oi-plus"></i></button>
					</div>
				</div>
				<form class="pl-3 pr-3" @submit.prevent="buscar" v-if="mostrar">
					<div class="form-group form-group-sm row">
						<div class="col-sm-6">
							<label for="" class="control-label">Del: </label>
							<input type="date" class="form-control" v-model="bform.fdel" :required="true">
						</div>
						<div class="col-sm-6">
							<label for="" class="control-label">Al: </label>
							<input type="date" class="form-control" v-model="bform.fal" :required="true">
						</div>

					</div>
					<div class="form-group form-group-sm row">
						<div class="col-sm-6">
							<label for="" class="control-label">Tipo:</label>
							<select2
								v-model  ="bform.tipo"
								:options ="cat.tipo"
								:indice  ="'id'"
								:campo   ="'descripcion'">
							</select2>
						</div>

						<div class="col-sm-6">
							<label for="" class="control-label">Detalle Tipo:</label>
							<select2
								v-model  ="bform.sub_tipo"
								:options ="getSubTipo"
								:indice  ="'id'"
								:campo   ="'descripcion'">
							</select2>
						</div>
					</div>
					<div class="form-group form-group-sm row">
						<div class="col-sm-6">
							<div class="form-check-inline" v-for="i in cat.venta_tipo">
								<label class="form-check-label">
									<input type="radio" class="form-check-input" name="venta_tipo" v-model="bform.venta_tipo" :value="i.id"> {{ i.descripcion }}
								</label>
							</div>
							<div class="form-check-inline">
								<label class="form-check-label">
									<input type="radio" class="form-check-input" name="venta_tipo" v-model="bform.venta_tipo" value="0"> Todo
								</label>
							</div>
						</div>
					</div>
					<div class="form-group form-group-sm row">
						<div class="col-sm-12 text-right">
							<button type="submit" class="btn btn-sm btn-primary" :disabled="btnBuscar">{{ btnBuscar ? 'Generando...' : 'Buscar' }}</button>
							<button type="button" class="btn btn-sm btn-secondary" @click.prevent="mostrarForm(false)" :disabled="btnBuscar">Cancelar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		
		<div class="card shadow-sm">
			<div class="card-body">
					{{ listaTipo }}
					{{ listaSubTipo }}
				<div class="row">
					<div class="col-sm-6">
						<div class="table-responsive">
						</div>
					</div>
					<div class="col-sm-6"></div>
				</div>
				<div class="row">
					<div class="col-sm-6"></div>
					<div class="col-sm-6"></div>
				</div>
				<!-- <div class="table-responsive">
					<table class="table table-condensed" id="tblRepGanancia">
						<thead>
							<tr>
								<th>Producto</th>
								<th>Fecha</th>
								<th>Tipo</th>
								<th>Detalle Tipo</th>
								<th>Venta</th>
								<th>Costo</th>
								<th>Ganancia</th>
							</tr>
						</thead>
						<tbody v-if="items.length > 0">
							<tr v-for="(i, k) in items" v-bind:key="tempTd = k" :class="['trTablaGanancia', {'table-danger': i.venta_tipo_id == 2}]">
								<td>{{ i.articulo }}</td>
								<td>{{ i.fecha }}</td>
								<td>{{ i.tipo }}</td>
								<td>{{ i.sub_tipo }}</td>
								<td>{{ i.monto_venta }}</td>
								<td>{{ i.monto_costo }}</td>
								<td>{{ i.ganancia }}</td>
							</tr>
						</tbody>
					</table>
				</div> -->
			</div>
		</div>
	</template>
</div>