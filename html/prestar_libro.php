<?php
	require_once('include/session.php');
	include('include/header.php');
	require_once('include/db.php');

	$db = new phpDB();
	$db->connect();

	$db->exec('SELECT * FROM libro',array());
?>

<header class="headprestar">
	<div class="titprestar"><h4>Prestar Libro</h4></div>
</header>

<div class="opc3">
<? 
	if (isset($_GET['campo_incomp'])) {
?>
	<p>Campo Incompleto</p>
<?
	}
	else if(isset($_GET['rutfalse'])) {
?>
	<p>Rut invalido</p>
<?
	}
	else if (isset($_GET['success'])) {
?>
	<p>Libro Prestado</p>
<?
	}
?>
</div>	

	<p>Prestar Libro</p>
	
	<form action="handlers/prestamo.php?action=prestar" method="POST" class="mprestar">
	<p>
		<label for="rut">Rut alumno</label>
		<input type="number" name="rut" maxlength="8" >
		<label for="dv">-</label>
		<input type="text" name="dv" size="2" maxlength="1" > *
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
		<input type="number" name="copia_libro" size="5" maxlength="5"> *
	</p>
	<p>
		<input type="submit" value="enviar">
	</p>
	<p><h5>* Datos requeridos</h5></p>
	<br><a href='menu_admin.php'>Volver al menu</a></br>

	</form>


<?
	include('include/footer.php');
?>

