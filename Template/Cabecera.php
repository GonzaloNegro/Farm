<?php
session_start();
include ("../Modelo/Conexion.php");
if (empty($_SESSION["usuario"])) {
    header("location: ../index.php");
}
$iduser = $_SESSION['usuario'];
$sql = "SELECT * FROM usuarios WHERE usuario='$iduser'";
$resultado = $conexion->query($sql);
$row = $resultado->fetch_assoc();

$nombre = $row['nombre'];
$apellido = $row['apellido'];
$tipoUsu = $row['id_tipoUsuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<link rel="shortcut icon" href="imgs/GAFA.png">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="../Css/estilos.css">
	<title>Menu de Navegacion estilo Amazon</title>
</head>
<body>


<header class="hea-pri" >
	<div class="titPrincipal">
		<h1>Don Juan S.R.L.</h1>
	</div>
    <nav class="navbar navbar-expand-lg navbar-light" style="border-bottom: 1px solid #0a6111;">
        <div class="container-fluid navpri">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav" >
                <ul class="navbar-nav">
				<li class="nav-item">
					<a href="./Inicio.php" class="nav-link" style="color: #0a6111;" aria-current="page">Inicio</a>
				</li>
                <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle " id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #0a6111;">Proyectos</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
							<?php if($tipoUsu == 1){;?>
                            <li class="nav-item">
                                <a class="nav-link " href="./altaProyectos.php">Alta proyecto</a>
                            </li>
                            <li>
                                <a class="nav-link " href="./detalleSiembra.php">Detalle Siembra</a>
                            </li>
                            <li>
                                <a class="nav-link " href="./detalleHacienda.php">Detalle Hacienda</a>
                            </li>
							<li>
                                <a class="nav-link " href="./detalleAlquiler.php">Detalle Alquiler</a>
                            </li>
							<?php };?>
							<li>
                                <a class="nav-link " href="./todosLosProyectos.php">Listado de Proyectos</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle " id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #0a6111;">Compras y Gastos</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
						<?php if($tipoUsu == 1){;?>
                            <li class="nav-item">
                                <a class="nav-link " href="./altaCompras.php">Cargar compra</a>
                            </li>
							<?php };?>
                            <li>
                                <a class="nav-link " href="./verCompras.php">Ver compras</a>
                            </li>
                        </ul>
                    </li>
					<?php if($tipoUsu == 1){;?>
					<li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle " id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #0a6111;">Gestión</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li class="nav-item">
                                <a class="nav-link " href="./usuarios.php">Usuarios</a>
                            </li>
                            <li>
                                <a class="nav-link " href="./proveedores.php">Proveedores</a>
                            </li>
							<li>
                                <a class="nav-link " href="./categorias.php">Categorias</a>
                            </li>
							<li>
                                <a class="nav-link " href="./cultivos.php">Cultivos</a>
                            </li>
                        </ul>
                    </li>
					<?php };?>
					<li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle " id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #0a6111;">Estadísticas</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li class="nav-item">
                                <a class="nav-link " href="./estadisticasGenerales.php">Generales</a>
                            </li>
                            <li>
                                <a class="nav-link " href="./estadisticasSiembra.php">Siembra</a>
                            </li>
							<li>
                                <a class="nav-link " href="./estadisticasHacienda.php">Hacienda</a>
                            </li>
							<li>
                                <a class="nav-link " href="./estadisticasAlquiler.php">Alquiler</a>
                            </li>
                        </ul>
                    </li>
					<!-- <li class="nav-item">
						<a href="./nosotros.php" class="nav-link " aria-current="page" style="color: #0a6111;">¿Quiénes somos?</a>
					</li> -->
                </ul>
            </div>
            <div class="exit">
				<div class="exit-name">
				<p><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512" style="fill:#000000;"><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg>&nbsp<?php echo $nombre." ".$apellido;?></p>
				</div>
				<div class="exit-exit">
					<a href="../index.php">
						<button class="btn btn-success">Salir</button>
						<!-- <i class="fa-solid fa-right-from-bracket fa-2x" style="color: #0a6111;"></i> -->
					</a>
				</div>
			</div>
        </div>
    </nav>
</header>
























<!-- 	<nav class="menu" id="menu">
		<div class="contenedor contenedor-botones-menu">
			<button id="btn-menu-barras" class="btn-menu-barras"><i class="fas fa-bars"></i></button>
			<button id="btn-menu-cerrar" class="btn-menu-cerrar"><i class="fas fa-times"></i></button>
		</div>

		<div class="contenedor contenedor-enlaces-nav">
			<div class="btn-departamentos" id="btn-departamentos">
				<p>DON JUAN SRL <span>GAFA</span></p>
				<i class="fas fa-caret-down"></i>
                </div>
				<div class="button">
                    <div class=".text-light">
                        <?php
                        echo $nombre." ".$apellido;
                        ?>
                    </div>
			</div>
			<div class="enlaces">
				<a href="./inicio.php">Inicio</a>
				<a href="./login.php">Salir</a>				
			</div>
		</div>

		<div class="contenedor contenedor-grid">
			<div class="grid" id="grid">
				<div class="categorias">
					<button class="btn-regresar"><i class="fas fa-arrow-left"></i> Regresar</button>
					<h3 class="subtitulo">GAFA</h3>

					<a href="#" data-categoria="tecnologia-y-computadoras">Proyectos <i class="fas fa-angle-right"></i></a>

					<a href="#" data-categoria="ropa-y-accesorios">Compras y Gastos <i class="fas fa-angle-right"></i></a>
					<a href="#" data-categoria="hogar-y-cocina">Gestión <i class="fas fa-angle-right"></i></a>
					<a href="#" data-categoria="juegos-y-juguetes">¿Quiénes somos? <i class="fas fa-angle-right"></i></a>
					<a href="#" data-categoria="salud-y-belleza">Estadísticas <i class="fas fa-angle-right"></i></a>
				</div>

				<div class="contenedor-subcategorias">
					<div class="subcategoria " data-categoria="tecnologia-y-computadoras">
						<div class="enlaces-subcategoria">
							<button class="btn-regresar"><i class="fas fa-arrow-left"></i>Regresar</button>
							<h3 class="subtitulo">Proyectos</h3>
							<a href="./altaProyectos.php">Alta Proyecto</a>
							<a href="./detalleSiembra.php">Detalle siembra</a>
							<a href="./detalleHacienda.php">Detalle Hacienda</a>
							<a href="./todosLosProyectos.php">Listado de proyectos</a>
						</div>

						<div class="banner-subcategoria">
							<a href="#">
								<img src="./imgs/agroganaderia.png" alt="">
							</a>
						</div>

						<div class="galeria-subcategoria">
							<a href="#">
								<img src="./imgs/maiz.png" alt="">
							</a>
							<a href="#">
								<img src="./imgs/ganaderia2.png" alt="">
							</a>
							<a href="#">
								<img src="./imgs/ganaderia.png" alt="">
							</a>
							<a href="#">
								<img src="./imgs/trigo.png" alt="">
							</a>
						</div>
					</div>

					<div class="subcategoria" data-categoria="ropa-y-accesorios">
						<div class="enlaces-subcategoria">
							<button class="btn-regresar"><i class="fas fa-arrow-left"></i>Regresar</button>
							<h3 class="subtitulo">Compras y Ventas </h3>
							<a href="./altaCompras.php">Cargar Compra</a>
							<a href="./asignarCompra.php"> Asignar Compra</a>
							<a href="./verCompras.php">Ver compras</a>
						</div>

						<div class="banner-subcategoria">
							<a href="#">
								<img src="./imgs/compras.png" alt="">
							</a>
						</div>

						<div class="galeria-subcategoria">
							<a href="#">
								<img src="./imgs/compras2.png" alt="">
							</a>
							<a href="#">
								<img src="./imgs/compras3.png" alt="">
							</a>
							<a href="#">
								<img src="./imgs/compras4.png" alt="">
							</a>
							<a href="#">
								<img src="./imgs/compras5.png" alt="">
							</a>
						</div>
					</div>

					<div class="subcategoria" data-categoria="hogar-y-cocina">
						<div class="enlaces-subcategoria">
							<button class="btn-regresar"><i class="fas fa-arrow-left"></i>Regresar</button>
							<h3 class="subtitulo">Usuarios</h3>
							<a href="./usuarios.php">Usuarios</a>
							<a href="./proveedores.php">Proveedores</a>
							<a href="./categorias.php">Categorias</a>
						
						</div>

						<div class="banner-subcategoria">
							<a href="#">
								<img src="./imgs/usuarios1.jpg" alt="">
							</a>
						</div>

						<div class="galeria-subcategoria">
							<a href="#">
								<img src="./imgs/usuario4.png" alt="">
							</a>
							<a href="#">
								<img src="./imgs/usuarios2.png" alt="">
							</a>
							<a href="#">
								<img src="./imgs/usuario6.png" alt="">
							</a>
							<a href="#">
								<img src="./imgs/usuarios4.jpg" alt="">
							</a>
						</div>
					</div>

					<div class="subcategoria" data-categoria="juegos-y-juguetes">
						<div class="enlaces-subcategoria">
							<button class="btn-regresar"><i class="fas fa-arrow-left"></i>Regresar</button>
							<h3 class="subtitulo">Nosotros</h3>
							<a href="./nosotros.php">Quienes somos </a>
						</div>

						<div class="banner-subcategoria">
							<a href="#">
								<img src="./imgs/entrada.jpg" alt="">
							</a>
						</div>

						<div class="galeria-subcategoria">
							<a href="#">
								<img src="./imgs/casa0.jpg" alt="">
							</a>
							<a href="#">
								<img src="./imgs/casa1.jpg" alt="">
							</a>
							<a href="#">
								<img src="./imgs/casa2.jpeg" alt="">
							</a>
							<a href="#">
								<img src="./imgs/entrada2.jpg" alt="">
							</a>
						</div>
					</div>

					<div class="subcategoria" data-categoria="salud-y-belleza">
						<div class="enlaces-subcategoria">
							<button class="btn-regresar"><i class="fas fa-arrow-left"></i>Regresar</button>
							<h3 class="subtitulo">Estadísticas</h3>
							<a href="./estadisticas.php">Ver estadísticas</a>
						</div>

						<div class="banner-subcategoria">
							<a href="#">
								<img src="./imgs/proyecciones3.jpg" alt="">
							</a>
						</div>

						<div class="galeria-subcategoria">
							<a href="#">
								<img src="./imgs/proyecciones1.jpg" alt="">
							</a>
							<a href="#">
								<img src="./imgs/proyecciones2.jpg" alt="">
							</a>
							<a href="#">
								<img src="./imgs/proyecciones4.jpg" alt="">
							</a>
							<a href="#">
								<img src="./imgs/proyecciones6.png" alt="">
							</a>
						</div>
					</div>

				</div>
			</div>
		</div>
	</nav> -->

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
	<script src="https://kit.fontawesome.com/ebb188da7c.js" crossorigin="anonymous"></script>