<?php
	require_once('include/session.php');
	include('include/header.php');
	require_once('include/db.php');

	$db = new phpDB();
	$db->connect();

	$db->exec('SELECT titulo,id,devuelto FROM libro , prestamo WHERE libro.id = prestamo.copia_libro_libro_id',array());
?>

<? 
	if(isset($_GET['success'])) {
?>

<?
	}
?>

	<p>Devolver libro</p>

	<form action="devolucion2.php?action=send" method="POST">
	<p>
		<label for"rut">RUT alumno</label>
		<input type="number" name="rut">
	</p>
	
	<p>
		<input type="submit" value="Aceptar">
	</p>
	
	</form>
	<br><a href='menu_admin.php'>Volver_al_menu</a></br>

<?
	include('include/footer.php');
?>
