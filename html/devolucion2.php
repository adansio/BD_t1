<?php
	require_once('include/session.php');
	include('include/header.php');
	require_once('include/db.php');

	$db=new phpDB;
	$db->connect();

	$db->exec('SELECT titulo,id,devuelto FROM libro , prestamo WHERE libro.id = prestamo.copia_libro_libro_id AND alumno_rut=$1',array($_POST['rut']));
?>

	<p>Devolver libro</p>
	
	<form action="handlers/devolucion.php?action=devolver" method="POST">
	<p>
		<select name="id">
		<?
			do {
		?>
			<option value=<? if($db->fobject()==NULL || $db->fobject()->devuelto=="t")
								echo "";
							else
							{
								echo $db->fobject()->id;?> >
							<? echo $db->fobject()->titulo;
							}
							?>
			</option>
		<?
			} while ($db->nextRow());
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
	<br><a href='menu_admin.php'>Volver_al_menu</a></br>

