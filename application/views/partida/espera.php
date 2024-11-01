<template id="espera-partida">
	<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-body-tertiary">
		<div class="card text-center">
			<div class="card-header">
				<div class="spinner-border m-5" role="status">
			  		<!-- <span>Loading...</span> -->
				</div>
			</div>
			<div class="card-body">
				<h5 class="card-title">
					{{ anfitrion ? 'Esperando a contrincante' : 'Uniendose a la sala' }}
				</h5>
				<p class="card-text">Preparate...</p>
			</div>
			<div class="card-footer text-body-secondary"></div>
		</div>
	</div>
</template>