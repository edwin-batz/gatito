<main role="main" id="appPartida">
	<div class="spinner-border m-5" role="status" v-if="cargando">
  		<span>Loading...</span>
	</div>
	<div v-else>
		<form-partida
			v-if ="vista == 1"
			:key ="Math.random()"
		>
		</form-partida>

		<espera-partida
			v-if       ="vista == 2"
			:anfitrion ="anfitrion"
			:key       ="Math.random()"
		>
		</espera-partida>

		<sala-partida
			v-if          ="vista == 3"
			:jugador      ="jugador"
			:contrincante ="contrincante"
			:turno        ="turno"
			:items        ="items"
			:key          ="Math.random()"
		>
		</sala-partida>

		<div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
			<div class="toast-header">
				<!-- <img src="..." class="rounded me-2" alt="..."> -->
				<strong class="me-auto">Bootstrap</strong>
				<small>11 mins ago</small>
				<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
			</div>
			<div class="toast-body">
				Hello, world! This is a toast message.
			</div>
		</div>
	</div>
</main>

<?php $this->load->view("partida/form"); ?>
<?php $this->load->view("partida/espera"); ?>
<?php $this->load->view("partida/sala"); ?>