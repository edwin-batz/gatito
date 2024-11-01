<template id="form-partida">
	<div>
		<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-body-tertiary">
			<div class="card text-center">
				<div class="card-header">
					[CARTAS]
				</div>
				<div class="card-body">
					<h5 class="card-title">Crea una partida o unete a una sala creada</h5>
					<p class="card-text">Seleccione la casilla si desea generar una partida privada</p>

					<div class="row d-flex justify-content-center m-3">
						<div class="col-md-4">
							<div class="input-group mb-3">
								<div class="input-group-text">
									<input
										class        ="form-check-input mt-0"
										type         ="checkbox"
										v-model      ="form.privada"
										:true-value  ="1"
										:false-value ="0"
									>
								</div>
								<input 
									type        ="text"
									class       ="form-control"
									placeholder ="Código de sala: A708#b"
									v-model     ="form.codigo"
								>
							</div>
						</div>
					</div>
					<div class="row d-flex justify-content-center m-3">
						<div class="col-md-4 d-grid">
							<button
								type           ="button"
								class          ="btn btn-info"
								@click.prevent ="unirse"
								:disabled      ="cargando"
							>	
								<span v-if="cargando">Validando sala...</span>
								<span v-else>Unirse</span>
							</button>
						</div>
					</div>
					<div class="row d-flex justify-content-center">
						<div class="col-md-4 d-grid">
							<button
								type="button"
								class="btn btn-light"
								@click.prevent="crear"
								:disabled="cargando"
							>
								<span v-if="cargando">Generando sala...</span>
								<span v-else>Crear</span>
							</button>
						</div>
					</div>
				</div>
				<div class="card-footer text-body-secondary">
					<div class="alert alert-success" role="alert" v-if="mensaje !== null && cargando == false">
						{{ mensaje }}
					</div>
					<div class="alert alert-danger" role="alert" v-if="errores !== null && cargando == false">
						{{ errores }}
					</div>
				</div>
			</div>
		</div>
		<br>
		<h3 class="text-center">Partidas publicas</h3>
		<div class="d-flex justify-content-center d-md-flex flex-md-equal w-100 my-md-3 ps-md-3">
			<hr>
			<div class="list-group" v-if="items.length > 0 && cargando == false">
				<a 
					v-for          ="(i, k) in items"
					class          ="list-group-item list-group-item-action list-group-item-primary"
					href           ="javascript:;"
					@click.prevent ="publica(i.codigo)"
					>
					<div class="row">
						<div class="col-sm-4"># {{ k+1 }}</div>
						<div class="col-sm-4">{{ i.codigo }}</div>
					</div>
				</a>
			</div>
		</div>
	</div>
</template>