<!doctype html>
<html lang="en" class="semi-dark">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="<?php echo BASE_URL; ?>assets/images/favicon-32x32.png" type="image/png" />
	<!--plugins-->
	<link href="<?php echo BASE_URL; ?>assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"/>
	<link href="<?php echo BASE_URL; ?>assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="<?php echo BASE_URL; ?>assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="<?php echo BASE_URL; ?>assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="<?php echo BASE_URL; ?>assets/css/pace.min.css" rel="stylesheet" />
	<script src="<?php echo BASE_URL; ?>assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo BASE_URL; ?>assets/css/bootstrap-extended.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="<?php echo BASE_URL; ?>assets/css/app.css" rel="stylesheet">
	<link href="<?php echo BASE_URL; ?>assets/css/icons.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL . 'assets/DataTables/datatables.min.css'; ?>">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/semi-dark.css" />
	<title><?php echo TITLE . ' - ' . $data['title']; ?></title>
</head>

<body>
	<!-- Contenedor del navbar-->
	<div class="wrapper">
		<!-- Inicio de la barra lateral -->	
		<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<img src="<?php echo BASE_URL; ?>assets/images/carrito.png" class="logo-icon" alt="logo icon">
				</div>
				<div>
					<h4 class="logo-text"><?php echo TITLE; ?></h4>
				</div>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
				</div>
			</div>
			<!-- Menú de navegación -->
			<ul class="metismenu" id="menu">
				<li>
					<a href="<?php echo BASE_URL . 'admin/home'; ?>">
						<div class="parent-icon"><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">Inicio</div>
					</a>
				</li>
				<li>
					<a href="<?php echo BASE_URL . 'usuarios'; ?>">
						<div class="menu-title"><i class='fas fa-users'></i> Usuarios</div>
					</a>
				</li>
				<li>
					<a href="<?php echo BASE_URL . 'compradores'; ?>">
						<div class="menu-title"><i class='fas fa-user'></i> Clientes</div>
					</a>
				</li>
				<li>
					<a href="<?php echo BASE_URL . 'categorias'; ?>">
						<div class="menu-title"><i class='fas fa-tags'></i> Categorias</div>
					</a>
				</li>
				<li>
					<a href="<?php echo BASE_URL . 'productos'; ?>">
						<div class="menu-title"><i class='fas fa-list'></i> Productos</div>
					</a>
				</li>
				<li>
					<a href="<?php echo BASE_URL . 'pedidos'; ?>">
						<div class="menu-title"><i class='fas fa-bell'></i> Pedidos</div>
					</a>
				</li>
			</ul>
			<!-- Fin de la navegación -->
	
		</div>
		<!-- Fin de la barra lateral -->
		<!-- Inicio del header -->
		<header>
			<div class="topbar d-flex align-items-center">
				<nav class="navbar navbar-expand">
					<div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
					</div>
					<div class="top-menu ms-auto">
						<ul class="navbar-nav align-items-center">
							<li class="nav-item mobile-search-icon">
								<a class="nav-link" href="#">	<i class='bx bx-search'></i>
								</a>
							</li>
					
						</ul>
					</div>
					<div class="user-box dropdown">
						<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<img src="<?php echo BASE_URL; ?>assets/images/carrito.png" class="user-img" alt="user avatar">
							<div class="user-info ps-3">
								<p class="user-name mb-0"><?php echo $_SESSION['nombre_usuario']; ?></p>
								<p class="designattion mb-0"><?php echo $_SESSION['email']; ?></p>
							</div>
						</a>
						<ul class="dropdown-menu dropdown-menu-end">
							<li>
								<div class="dropdown-divider mb-0"></div>
							</li>
							<li><a class="dropdown-item" href="<?php echo BASE_URL . 'admin/salir'; ?>"><i class='bx bx-log-out-circle'></i><span>Logout</span></a>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</header>
		<!-- Fin del header -->
		<!-- Inicio del contenido -->
		<div class="page-wrapper">
			<div class="page-content">