<?
  require_once("../include/db.php"); # Permite la comunicación con la bd

   	# Se hace la conexión a la BD #
	$db = new phpDB(); # La variable $db guarda la referencia a la BD
	$db->connect();

	# Se hacen distintas cosas dependiendo del valor del parámetro "action" #
	if( $_GET['action'] == 'create' ) {
		//verifica el rut
		$r=$_POST['rut'];
		$s=1;
		for($m=0;$r!=0;$r/=10)
			$s=($s+$r%10*(9-$m++%6))%11;
	
		if($_POST['rut']==NULL || $_POST['dv']==NULL || $_POST['nombres']==NULL || $_POST['apellidos']==NULL)
		header('Location: ../nuevo_registro.php?campo_incomp=true');
	
		else if ($_POST['dv'] != chr($s?$s+47:75)) 
			header('Location: ../nuevo_registro.php?rutfalse=true');
		else
		{	
			$db->exec('INSERT INTO alumno (rut, dv, nombres, apellidos, email)'.' VALUES ($1, $2, $3, $4, $5)', array($_POST['rut'], $_POST['dv'], $_POST['nombres'], $_POST['apellidos'], $_POST['email']));
			$db->close();
    		header('Location: ../nuevo_registro.php?success=true');
		}	
}
?>
