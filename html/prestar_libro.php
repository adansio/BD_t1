<?php
	require_once('include/session.php');
	include('include/header.php');
	require_once('include/db.php');

	$db = new phpDB();
	$db->connect();

	$db->exec('SELECT * FROM libro',array());
?>

<?
	if (isset($_GET['success'])) {
?>
	<p>Libro Prestado</p>
	<br><a href='prestar_libro.php'>Prestar otro libro</a></br>
	<br><a href='menu_admin.php'>Volver al menu</a></br>
<?
	}
?>

	<p>Prestar Libro</p>
	
	<form action="handlers/prestamo.php?action=prestar" method="POST">
	<p>
		<label for="rut">Rut alumno</label>
		<input type="number" name="rut">
	</p>
	<p>
		<select name="id">
		<?
			do {
		?>
			<option value=<? echo $db->fobject()->id;?>> 
						<?echo $db->fobject()->titulo;?>
			</option>
		<? 
			}	while ($db->nextRow());
		?>
		</select>
	</p>
	<p>
		<label for="copia_libro">Numero de copia</label>
		<input type="number" name="copia_libro">
	</p>
	<p>
		<input type="submit" value="enviar">
	</p>

	</form>
	<br><a href='menu_admin.php'>Volver al menu</a></br>


<?
	include('include/footer.php');
?>

