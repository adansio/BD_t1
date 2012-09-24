<?php
require_once('include/session.php');  
include('include/header.php');

?>

<header class="headaddlibro">
	<div class="titaddlibro"><h4>Agregar Libro</h4></div>
</header>

<div class="opc2">

<?
	if(isset($_GET['incomp'])=='true') { 
?>
	<p>Campo Incompleto</p>
<?
    }
	else if(isset($_GET['nonum'])=='true') {
?>
	<p>Numero de copia invalido</p>
<?
	}
	else if (isset($_GET['success'])=='true') {
?>
		<p>LIBRO AGREGADO</p>
		<br><a href='menu_admin.php'>VOLVER AL MENU </a></br>
<?
	}
?>
</div>

	<form action="handlers/add_libro.php?action=add" method="POST" class="maddlibro">
	<p>
		<label for="titulo">Titulo</label>
		<input type="text" name="titulo" maxlength="200"> *
	</p>
	<p>
		<label for="autor">Autor</label>
		<input type="text" name="autor" maxlength="200"> *
	</p>
	<p>
		<label for="descripcion">Descripcion</label>
		<input type="text" name="descripcion" maxlength="2000">
	</p>
	<p>
		<label for="categoria">Categoria</label>
		<input type="text" name="categoria" maxlength="200"> *
	</p>
	<p>
		<label for="num_copia">Numero de copia</label>
		<input type="number" name="num_copia" size="5" maxlength="5"> *
	</p>
	<p>
	    <input type="submit" value="Enviar">
	</p>
	<p><h5> * Datos Obligatorios <h5></p> 

	</form>
	<br><a href='menu_admin.php'>VOLVER AL MENU </a></br>
<?
	include('include/footer.php');
?>
