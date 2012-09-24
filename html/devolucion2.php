<?php
	require_once('include/session.php');
	include('include/header.php');
	require_once('include/db.php');

	$db=new phpDB;
	$db->connect();
	$db1=new phpDB;
	$db1->connect();

	//selecciona titulo de libro no devuelto
	$db->exec('SELECT titulo,id,devuelto FROM libro , prestamo WHERE libro.id = prestamo.copia_libro_libro_id AND alumno_rut=$1 AND devuelto=false',array($_POST['rut']));
	$db1->exec('SELECT copia_libro_libro_id FROM prestamo WHERE alumno_rut=$1 AND devuelto=$2',array($_POST['rut'], "f"));

	if ( $_GET['action'] == 'send')
	{
		if($_POST['rut'] == NULL)
			header('Location: devolucion_libro.php?incomp=true');
		else
		{
?>

<header class="headd">
	<div class="titd"><h4>Devolver Libro</h4></div>
</header>
	<p>Devolver libro</p>
	
	<form action="handlers/devolucion.php?action=devolver" method="POST" class="md">
	<p>
	<label for="rut">Rut</label>
	<input type="number" name="rut" value=<?echo $_POST['rut']?> readonly="readonly" > 
		<select name="id">
		<?	//despliega lista con libros no devueltos
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
		<input type="number" name="copia_libro" maxlength="5" size="5">
	</p>
	<p>
		<input type="submit" value="enviar">
	</p>
	<br><a href='menu_admin.php'>Volver_al_menu</a></br>

	</form>
<? 
	}
}
?>
