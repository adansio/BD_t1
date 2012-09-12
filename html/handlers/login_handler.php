<?
require_once("../include/db.php"); # Permite la comunicación con la bd

 # Se hace la conexión a la BD #
 $db = new phpDB(); # La variable $db guarda la referencia a la BD
 $db->connect();

   if( $_GET['action'] == 'login' ) {
    $query = "SELECT * FROM administrador WHERE username = $1 and passwd = $2";
    $db->exec($query, array($_POST['username'], $_POST['password']));

    # Si hay un resultado, el login fue correcto #
	    if ($db->numRows() == 1) {
	      header('Location: ../menu_admin.php'); # Redirecciona a /menu_admin.php
          session_start();
		  header("Cache-control: private");#esto lo agregue recien
		  $_SESSION['user'] = $db->fobject();
		  $db->close();
							    }
		else {
	      header('Location: ../login.php?error=true'); # Redirecciona al login con error
		      }
	 							    }
   else if( $_GET['action'] == 'logout' ) {
     	    $db->close();
	        session_start();
		    session_destroy(); # Borra las variables de sessión
		    header('Location: ../menu_admin.php');
		                				  }
 ?>
