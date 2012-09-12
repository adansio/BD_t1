<?
	require_once("../include/db.php");

	session_start();

	#Conexion a la base de datos#

	$db = new phpDB();
	$db->connect();

	if( $_GET['action'] == 'prestar' )
	{	
		$ses = $_SESSION['user']->id;
		$fecha = strftime("%Y-%m-%d %H:%M:%S", time() );
		$devuelto = "FALSE";

		//obtencion de id segun nombre del libro
		$db->exec('INSERT INTO prestamo (alumno_rut, fecha_prestamo, copia_libro_libro_id, copia_libro_numero, administrador_id, devuelto) VALUES ($1,$2,$3,$4,$5,$6)', array( $_POST['rut'], $fecha, $_POST['id'] , $_POST['copia_libro'], $ses , $devuelto));
		
		$db->close();
		header('Location: ../prestar_libro.php?success=true');
	}
?>
