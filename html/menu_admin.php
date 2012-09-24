<?
require_once('include/session.php');
  
require_once('include/header.php')
  ?>

<header class="headmadmin">
	<div class="titmadmin"><h4>Bienvenido Administrador</h4></div>
</header>

<div class="madmin">

	<ul class="main_menu">
		<li><a href='nuevo_registro.php'>AGREGAR NUEVO ALUMNO </a></li>
	<li><a href='agregar_libro.php'>AGREGAR LIBRO</a></li>
	<li><a href='prestar_libro.php'>PRESTAR LIBRO</a></li>
	<li><a href='devolucion_libro.php'>DEVOLUCION DE LIBRO</a></li>
	<li><a href='buscar_libro.php'>BUSCAR UN LIBRO</a></li>
	<li><a href='logout.php'>SALIR</a></li>

	</ul>
</div>


<?
  require_once('include/footer.php')
 ?>
