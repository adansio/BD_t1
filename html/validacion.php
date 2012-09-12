<?php
// Inicio la sesión
session_start();
header("Cache-control: private"); // Arregla IE 6

// Voy por el login y el password
   $username = $_POST['username'];
   $password = $_POST['password'];

// reviso si coincide
  if ( $username == "seba" && $password == "123456")
  {
     $_SESSION['estado'] = "logeado";  // Coloco la variable de sesión 'estado'
     $msg = "<a href="menu_admin.php">Bienvenido " . $login . ">></a>";
    
   } else {
	      $msg = "Datos erroneos!!. <a href=\"login.php\">Inténtelo de nuevo.</a>";				       
    	    }   
?> 
