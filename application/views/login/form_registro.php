<form action="<?php echo base_url('index.php/sesion/registro') ?>" autocomplete="off" method="POST">
	<div class="form-floating">
		<input type="text" class="form-control" id="nombre" name="nombre" placeholder="algo" required>
		<label for="nombre">Nombre Completo</label>
	</div>
	<div class="form-floating">
		<input type="email" class="form-control" id="correo" name="correo" placeholder="algo" required>
		<label for="correo">Correo Electronico</label>
	</div>
	<div class="form-floating">
		<input type="password" class="form-control" id="clave1" name="clave1" minlength="8" onkeyup="tamanioContrasenia(this)" placeholder="algo" required>
		<label for="clave1">Contraseña</label>
		<p class="small py-2" id="valid-pass" style="display: none;"></p>
	</div>
	<div class="form-floating">
		<input type="password" class="form-control" id="clave2" name="clave" minlength="8" placeholder="algo" required>
		<label for="clave2">Confirme Contraseña</label>
	</div>

	<?php if (verData($_SESSION, "error_registro")): ?>
		<div class="form-floating">
			<div class="alert alert-warning d-flex align-items-center" role="alert">
				<i class="oi oi-warning"></i>
				<div> 
					<?php echo is_array($_SESSION["error_registro"]) ? implode("\n", $_SESSION["error_registro"]) : $_SESSION["error_registro"]?>
				</div>
			</div>
		</div>
	<?php unset($_SESSION["error_registro"]); endif ?>

	<div class="form-floating">
		<div class="d-grid">
			<button type="submit" class="btn btn-success">
				<span class="oi oi-check"></span> Registrarse
			</button>
		</div>
	</div>
</form>