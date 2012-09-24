<?php
	require_once('include/session.php');
	include('include/header.php');
	require_once('include/db.php');

	
	$db = new phpDB();
	$db->connect();

	$db->exec('SELECT titulo,id,devuelto FROM libro , prestamo WHERE libro.id = prestamo.copia_libro_libro_id',array());
?>


<header class="headdevol">
	<div class="titdevol"><h4>Devolver Libro</h4></div>
</header>

<div class="opc4">
<?	
	if(isset($_GET['incomp'])) {
?>
	<p>Datos incompletos</p>
<? 
	}
	else if(isset($_GET['success'])) {
?>
	<p>Libro Devuelto<p/>
<?
	}
?>
</div>

	<form action="devolucion2.php?action=send" method="POST" class="mdevol">
	<p>
		<label for"rut">RUT alumno</label>
		<input type="number" name="rut" maxlength="8">
	</p>
	<p>
		<input type="submit" value="Aceptar">
	</p>
	</form>
	<p><h5>* Ingrese Rut sin digito vericador</h5></p>
	<br><a href='menu_admin.php'>Volver_al_menu</a></br>

<?
	include('include/footer.php');
?>
