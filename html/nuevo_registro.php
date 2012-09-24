<?php
require_once('include/session.php');
include('include/header.php');
?>

<header class="headingreso">
	<div class="titingreso"><h4>Registro nuevo alumno</h4></div>
</header>

<div class="opc1">

<?
	if (isset($_GET['success']) == 'true') {
?>
    <p>Alumno Ingresado</p>
<?
	}
	else if(isset($_GET['rutfalse']) == 'true') {
?>
	<p>Rut invalido</p>
<?
	} 
	else if(isset($_GET['campo_incomp'])=='true'){
?>
	<p>Campo incompleto</p>
<?
	}
?>
</div>

  <form action="handlers/alumno_handler.php?action=create" method="POST" class="mingreso">
   <p><br>
  	  <label for="rut">RUT</label>
   	  <input type="text" name="rut" maxlength="8">
	  <label for="dv">-</label>
	  <input type="text" name="dv" size="2" maxlength="1" > *
    </br></p>
    <p>
  	   <label for="nombres">Nombres</label>
	   <input type="text" name="nombres" maxlength="200"> *
    </p>
	<p>
       <label for="apellidos">Apellidos</label>
	   <input type="text" name="apellidos" maxlength="200"> *
    </p>
   
    <p>
        <label for="email">Email</label>
        <input type="text" name="email" maxlength="255">
    </p>
    <p>
        <input type="submit" value="Enviar">
    </p>
	<br><a href='menu_admin.php'>VOLVER AL MENU </a></br>
	<h5>* Datos obligatorios</h5>

  </form>
 						  

  <?
   include('include/footer.php');
?>
