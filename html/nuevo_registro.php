<?php
require_once('include/session.php');
include('include/header.php');
?>

<?
	if (isset($_GET['success'])) {
?>
    <p>Alumno Creado</p>
<?
	}
?>
  <form action="handlers/alumno_handler.php?action=create" method="POST">
   <p><b><br>REGISTRO NUEVO ALUMNO</br></b></p>
   <p><br>
  	  <label for="rut">RUT</label>
   	  <input type="text" name="rut">
	  <label for="dv">-</label>
	  <input type="text" name="dv" size="2">
    </br></p>
    <p>
  	   <label for="nombres">Nombre</label>
	   <input type="text" name="nombres">
    </p>
	<p>
       <label for="apellidos">Apellidos</label>
	   <input type="text" name="apellidos">
    </p>
   
    <p>
        <label for="email">Email</label>
        <input type="text" name="email">
    </p>
    <p>
        <input type="submit" value="Enviar">
    </p>
	<br><a href='menu_admin.php'>VOLVER AL MENU </a></br>
  </form>
  <?
   include('include/footer.php');
?>
