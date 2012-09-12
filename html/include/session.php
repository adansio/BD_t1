<?
  session_start(); # Permite el acceso a las variables de sesión

  	if (!isset($_SESSION['user'])){
  		header('Location: login.php');
	}
?>
