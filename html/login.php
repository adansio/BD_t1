
<?

  require_once('include/header.php')
  ?>

  <?
    # Si está colocado el parámetro error mostramos el error
  if (isset($_GET['error'])) {
  ?>
    <p><b>Error, revisa tus datos</b></p>
  <?
            	      		  }
  ?>
  <div style="text-align:center;">
  <form action="handlers/login_handler.php?action=login" method="POST">
  <legend><br><b>Entrar como administrador.</b></br></legend>
  <p><br>
      <label for="username">Nombre de Usuario</label>
      <input type="text" name="username">
	  </br></p>
  <p><br>
      <label for="password">Contraseña</label>
      <input type="password" name="password">
  </br></p>
  <p>
      <input type="submit" value="Entrar">
  </p>
</form>
</div>

<?
  require_once('include/footer.php')
 ?>
