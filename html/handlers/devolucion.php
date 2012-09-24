<?
	require_once("../include/db.php");

	session_start();

	#conexion a base de datos

	$db = new phpDB();
	$db->connect();
	$db1 = new phpDB();
	$db1->connect();
	$db2 = new phpDB();
	$db2->connect();

	if ( $_GET['action'] == 'devolver' )
	{
		$ses = $_SESSION['user']->id;
		$fecha = strftime("%Y-%m-%d %H:%M:%S",time() );
		$devuelto = "TRUE";
		
		$db1->exec('SELECT fecha_prestamo FROM prestamo WHERE alumno_rut= $1 AND copia_libro_numero= $2 AND copia_libro_libro_id=$3', array( $_POST['rut'], $_POST['copia_libro'], $_POST['id']) );

		$db->exec('UPDATE prestamo SET devuelto=$1, fecha_devolucion=$2 WHERE alumno_rut=$3 AND fecha_prestamo=$4 AND copia_libro_numero=$5', array( $devuelto, $fecha, $_POST['rut'], $db1->fobject()->fecha_prestamo, $_POST['copia_libro']) );

		//$db2->exec('SELECT fecha_devolucion from prestamo WHERE alumno_rut=$1 AND fecha_prestamo=$2',array($_POST['rut'],$db1->fobject()->fecha_prestamo));

		$db->close();
		$db1->close();
		header("Location: ../devolucion_libro.php?success=true");
		
	}
?>
