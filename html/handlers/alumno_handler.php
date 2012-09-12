<?
  require_once("../include/db.php"); # Permite la comunicación con la bd

   	# Se hace la conexión a la BD #
	$db = new phpDB(); # La variable $db guarda la referencia a la BD
	$db->connect();

	# Se hacen distintas cosas dependiendo del valor del parámetro "action" #
	if( $_GET['action'] == 'create' ) {
	$db->exec('INSERT INTO alumno (rut, dv, nombres, apellidos, email)'.' VALUES ($1, $2, $3, $4, $5)', array($_POST['rut'], $_POST['dv'], $_POST['nombres'], $_POST['apellidos'], $_POST['email']));
	$db->close();
    header('Location: ../nuevo_registro.php?success=true');
}
?>
