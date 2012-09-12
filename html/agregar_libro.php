<?php
require_once('include/session.php');  
include('include/header.php');

?>

 <?
    if (isset($_GET['success'])) {
?>
	<p>LIBRO AGREGADO!!</p>
	<br><a href='agregar_libro.php'>VOLVER A AGREGAR </a></br>
	<br><a href='menu_admin.php'>VOLVER AL MENU </a></br>
<?
}
?>
	<p>Agregar Libro</p>

	<form action="handlers/add_libro.php?action=add" method="POST">
	<p>
		<label for="titulo">Titulo</label>
		<input type="text" name="titulo"> *
	</p>
	<p>
		<label for="autor">Autor</label>
		<input type="text" name="autor"> *
	</p>
	<p>
		<label for="descripcion">Descripcion</label>
		<input type="text" name="descripcion">
	</p>
	<p>
		<label for="categoria">Categoria</label>
		<input type="text" name="categoria"> *
	</p>
	<p>
		<label for="num_copia">Numero de copia</label>
		<input type="number" name="num_copia"> *
	</p>
	<p>
	    <input type="submit" value="Enviar">
	</p>
	
	</form>
	<p><h5> * Datos Requeridos <h5></p> 
	<br><a href='menu_admin.php'>VOLVER AL MENU </a></br>
<?
	include('include/footer.php');
?>
