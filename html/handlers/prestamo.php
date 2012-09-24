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
		
		$r=$_POST['rut'];
        $s=1;
        for($m=0;$r!=0;$r/=10)
	        $s=($s+$r%10*(9-$m++%6))%11;

		if($_POST['rut']==NULL || $_POST['copia_libro']==NULL)
			header('Location: ../prestar_libro.php?campo_incomp=true');

		 else if ($_POST['dv'] != chr($s?$s+47:75))
         	header('Location: ../prestar_libro.php?rutfalse=true');
		else {
		//obtencion de id segun nombre del libro
		$db->exec('INSERT INTO prestamo (alumno_rut, fecha_prestamo, copia_libro_libro_id, copia_libro_numero, administrador_id, devuelto) VALUES ($1,$2,$3,$4,$5,$6)', array( $_POST['rut'], $fecha, $_POST['id'] , $_POST['copia_libro'], $ses , $devuelto));
		
		$db->close();
		header('Location: ../prestar_libro.php?success=true');
		}
	}
?>
