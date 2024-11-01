<form action="<?php echo base_url('index.php/sesion/login') ?>" autocomplete="off" method="POST" c>
	<img class="mb-4" src="/docs/5.3/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
	<h1 class="h3 mb-3 fw-normal">Iniciar Sesión</h1>

	<?php if (verData($_SESSION, "mensaje_login")): ?>
		<div class="form-floating">
			<div class="alert alert-success" role="alert">
				<?php echo is_array($_SESSION["mensaje_login"]) ? implode("\n", $_SESSION["mensaje_login"]) : $_SESSION["mensaje_login"]?>
			</div>
		</div>
	<?php unset($_SESSION["mensaje_login"]); endif ?>

	<div class="form-floating">
		<input type="email" class="form-control" id="correo" name="correo" placeholder="algo" required>
		<label for="correo">Correo</label>
	</div>
	<div class="form-floating">
		<input type="password" class="form-control" id="clave" name="clave" placeholder="algo" required>
		<label for="clave">Contraseña</label>
	</div>

	<?php if (verData($_SESSION, "error_login")): ?>
		<div class="form-floating">
			<div class="alert alert-warning d-flex align-items-center" role="alert">
				<i class="oi oi-warning"></i>
				<div> 
					<?php echo is_array($_SESSION["error_login"]) ? implode("\n", $_SESSION["error_login"]) : $_SESSION["error_login"]?>
				</div>
			</div>
		</div>
	<?php unset($_SESSION["error_login"]); endif ?>

	<div class="form-floating d-flex justify-content-between">
		<a href="registro" class="btn btn-link py-2">Registrarse</a>
		<button class="btn btn-primary w-50 py-2 pull-right" type="submit">Ingresar</button>
	</div>
</form>