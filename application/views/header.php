<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>POD</title>
	<link rel="canonical" href="<?php echo base_url('assets/bootstrap/site/content/docs/5.3/examples/dashboard')?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/iconic/font/css/open-iconic-bootstrap.min.css')?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/dist/css/bootstrap.min.css')?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/select2/dist/css/select2.min.css')?>">

	<?php if (isset($datatable)): ?>
		<!-- <link rel="stylesheet" href="<?php #echo base_url('assets/datatables.net-bs/css/dataTables.bootstrap.min.css')?>">
		<link rel="stylesheet" href="<?php #echo base_url('assets/datatables.net-bs/css/autoFill.bootstrap.min.css')?>">
		<link rel="stylesheet" href="<?php #echo base_url('assets/datatables.net-bs/css/buttons.bootstrap.min.css')?>"> -->
		<link rel="stylesheet" href="<?php echo base_url('assets/datatable/DataTables-1.13.1/css/jquery.dataTables.min.css')?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/datatable/Buttons-2.3.3/css/buttons.dataTables.min.css')?>">
	<?php endif ?>

	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/pod.min.css')?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/estilos.min.css')?>">
	<!-- <script src="https://cdn.tailwindcss.com"></script> -->
</head>
<body class="h-full">
	<div class="min-h-full">
		<nav class="navbar  navbar-expand-lg bg-body-tertiary">
			<div class="container-fluid">
				<a class="navbar-brand" href="javascript:;">
					<?php echo $GLOBALS["_USER"]["nombre"]?>
				</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<li class="nav-item">
							<a class="nav-link active" aria-current="page" href="#">Home</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Link</a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								Dropdown
							</a>
							<ul class="dropdown-menu">
								<li><a class="dropdown-item" href="#">Action</a></li>
								<li><a class="dropdown-item" href="#">Another action</a></li>
								<li><hr class="dropdown-divider"></li>
								<li><a class="dropdown-item" href="#">Something else here</a></li>
							</ul>
						</li>
						<li class="nav-item">
							<a class="nav-link disabled" aria-disabled="true">Disabled</a>
						</li>
					</ul>
					<form class="d-flex" role="search">
						<!-- <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"> -->
						<a class="btn btn-outline-success" href="sesion/salir">Cerrar sesión</a>
					</form>
				</div>
			</div>
		</nav>
	</div>


				<!-- <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
					<h1 class="h2"></h1>
					<div class="btn-toolbar mb-2 mb-md-0">
						<div class="btn-group mr-2">
							<button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
							<button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
						</div>
						<button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
							<span data-feather="calendar"></span>
							This week
						</button>
					</div>
				</div> -->
				