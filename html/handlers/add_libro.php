<?
  require_once("../include/db.php"); # Permite la comunicación con la bd

	# Se hace la conexión a la BD #
	$db = new phpDB(); 	# La variable $db guarda la referencia a la BD
	$db->connect();
	$db1 = new phpDB();	
	$db1->connect(); 	//operaciones sobre tabla libro
	$db2 = new phpDB();
	$db2->connect();	//operaciones sobre tabla autor
	$db3 = new phpDB();
	$db3->connect(); 	//operaciones sobre categoria

	# Se hacen distintas cosas dependiendo del valor del parámetro "action" #
	if( $_GET['action'] == 'add' ) {
	
		$prestado="FALSE";
		$db1->exec('SELECT * from libro WHERE titulo=$1', array($_POST['titulo']));
	
	//verificar si algun campo necesario esta vacio
	if($_POST['titulo']==NULL || $_POST['autor']==NULL || $_POST['categoria']==NULL || $_POST['num_copia']==NULL )
		header('Location: ../agregar_libro.php?incomp=true');
	
	//verificar valor de numero de copia
	else if(is_numeric($_POST['num_copia']) != 1)
		header('Location: ../agregar_libro.php?nonum=true');

	//Si el libro existe, se agrega el numero de copia.
	else if ( $db1->fobject()->id  >= 1 ) {
			$db->exec('INSERT INTO copia_libro (libro_id, numero, prestado) VALUES ($1,$2,$3)', array( $db1->fobject()->id, $_POST['num_copia'], $prestado ));
			$db->close();
			$db1->close();
			header('Location: ../agregar_libro.php?success=true');
		}
		
		//Si el libro no existe.
		else
		{
			$db2->exec('SELECT * from autor WHERE nombre=$1', array($_POST['autor']));
			$db3->exec('SELECT * from categoria WHERE nombre=$1', array($_POST['categoria']));
			if($_POST['num_copia']==1) $_POST['num_copia'] = 0 ;

			//Si Existe el autor
			if ( $db2->fobject()->id >=1 ) {
				$db->exec('INSERT INTO libro ( autor_id, titulo, descripcion, stock )  VALUES ($1, $2, $3, $4)', array( $db2->fobject()->id, $_POST['titulo'], $_POST['descripcion'], $_POST['num_copia']) );
				
				//Si No existe categoria
				if( $db3->fobject()->id == 0 ) {
					$db->exec('INSERT INTO categoria ( nombre ) VALUES ($1)', array( $_POST['categoria']) );

					$db3->exec('SELECT id from categoria WHERE nombre=$1', array( $_POST['categoria']) );
					$db1->exec('SELECT id from libro WHERE titulo=$1', array($_POST['titulo']));
					$db->exec('INSERT INTO categoria_libro ( libro_id, categoria_id ) VALUES ($1,$2)', array( $db1->fobject()->id, $db3->fobject()->id) );
					
					$db->exec('INSERT INTO copia_libro ( libro_id, numero, prestado ) VALUES ($1,$2,$3)', array( $db1->fobject()->id, $_POST['num_copia'], $_POST['prestado']) );
					
					$db->close();
					$db1->close();
					$db2->close();
					$db3->close();

					header('Location: ../agregar_libro.php?success=true');
				}
				
				//Si existe la categoria
				else
				{
					$db3->exec('SELECT id from categoria WHERE nombre=$1', array( $_POST['categoria']) );
					$db1->exec('SELECT id from libro WHERE titulo=$1', array($_POST['titulo']));
					$db->exec('INSERT INTO categoria_libro ( libro_id, categoria_id ) VALUES ($1,$2)', array( $db1->fobject()->id, $db3->fobject()->id) );
					
					$db->exec('INSERT INTO copia_libro ( libro_id, numero, prestado ) VALUES ($1,$2,$3)', array( $db1->fobject()->id, $_POST['num_copia'], $prestado) );
					
					$db->close();
					$db1->close();
					$db2->close();
					$db3->close();

					header('Location: ../agregar_libro.php?success=true');
				}
			}

			//Si no existe el autor
			else
			{	//Si categoria existe
				if( $db3->fobject()->id >= 1 ) 
				{
					$db->exec('INSERT INTO autor (	nombre ) VALUES ($1)', array( $_POST['autor']) );
					$db2->exec('SELECT id from autor WHERE nombre=$1' , array($_POST['autor']));
					$db->exec('INSERT INTO libro ( autor_id, titulo, descripcion, stock ) VALUES ($1, $2, $3, $4 )', array( $db2->fobject()->id, $_POST['titulo'], $_POST['descripcion'], $_POST['num_copia']) );
						
					$db1->exec('SELECT id from libro WHERE titulo=$1', array($_POST['titulo']));
					$db->exec('INSERT INTO categoria_libro ( libro_id, categoria_id ) VALUES ( $1,$2 )', array ( $db1->fobject()->id, $db3->fobject()->id ) );
					$db->exec('INSERT INTO copia_libro ( libro_id, numero, prestado ) VALUES ($1,$2,$3)', array( $db1->fobject()->id, $_POST['num_copia'], $prestado) );

					$db->close();
					$db1->close();
					$db2->close();
					$db3->close();

					header('Location: ../agregar_libro.php?success=true');
				}

				else //Si no existe ninguno de los anteriores
				{
					$db->exec('INSERT INTO autor ( nombre ) VALUES ($1)', array( $_POST['autor']) );
					$db->exec('INSERT INTO categoria ( nombre ) VALUES ($1)', array( $_POST['categoria']) );
					
					$db2->exec('SELECT id from autor WHERE nombre=$1' , array($_POST['autor']));
					$db3->exec('SELECT id from categoria WHERE nombre=$1', array($_POST['categoria']));

					$db->exec('INSERT INTO libro ( autor_id, titulo, descripcion, stock) VALUES ($1, $2, $3, $4 )', array( $db2->fobject()->id, $_POST['titulo'], $_POST['descripcion'], $_POST['num_copia']) );
					
					$db1->exec('SELECT id from libro WHERE titulo=$1', array($_POST['titulo']));
					$db->exec('INSERT INTO categoria_libro ( libro_id, categoria_id ) VALUES ($1,$2)', array( $db1->fobject()->id, $db3->fobject()->id) );
					
					$db->exec('INSERT INTO copia_libro ( libro_id, numero, prestado ) VALUES ($1,$2,$3)', array( $db1->fobject()->id, $_POST['num_copia'], $prestado) );
					
					$db->close();
					$db1->close();
					$db2->close();
					$db3->close();

			 	    header('Location: ../agregar_libro.php?success=true');
				}
			}
		}
	}
?>
