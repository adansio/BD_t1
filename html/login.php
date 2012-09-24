<?
  require_once('include/header.php');
?>

<header class="cabecera">
  <div class="titulo"></div>
  </header>

<div class="err1">
   <?
    # Si está colocado el parámetro error mostramos el error
  if (isset($_GET['error'])) {
  ?>
    <p><b>Error, revisa tus datos</b></p>
  <?
            	      		  }
  ?>
</div>

  <aside class="acceso_admin">
	  <form action="handlers/login_handler.php?action=login" method="POST">
  		<legend class="acc"><br><b>Login administrador.</b></br></legend>
  	<p>
      	<label for="username">Usuario</label>
      	<input type="text" name="username" maxlength="100" size="10">
	</p>
  	<p>
      	<label for="password">Contraseña</label>
      	<input type="password" name="password" maxlength="100" size="10">
	</p>
  	<p>
     	<input type="submit" value="Entrar">
  	</p>
	</form>
	</aside>

  <form action="resultado_buscar2.php?action=libro" method="GET" class="gral_search" >
	Buscar Libro  
   
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
    
  </form>

