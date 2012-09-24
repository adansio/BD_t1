<?php
require_once('include/session.php');
include('include/header.php');
?>

<header class="headsearch">
	<div class="titsearch"><h4>Ingresar criterio de busqueda</h4></div>
</header>

  <form action="resultado_buscar.php?action=libro" method="GET" class="msearch" >
  
    <p>
    <label for="autor">Autor</label>
    <input type="text" name="autor">
	</p>
    <p>	   
       <label for="codigo">Codigo</label>
       <input type="text" name="codigo">
    </p>
    <p>	   
       <label for="titulo">Titulo</label>
       <input type="text" name="titulo">
    </p>
    <p>	   
       <label for="descripcion">Descripcion</label>
       <input type="text" name="descripcion">
    </p>
    <p>	   
       <label for="categoria">Categoria(s)(Separe por comas ',')</label>
       <input type="text" name="categoria">
    </p>
   
          <input type="submit" value="Buscar">
    
	<br><br><a href='menu_admin.php'>VOLVER AL MENU </a></br></br>
  </form>
<?
   include('include/footer.php');
?>
