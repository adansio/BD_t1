<?php
  include('include/header.php');

  require_once("include/db.php"); # Permite la comunicación con la bd

  # Se hace la conexión a la BD #
  $db = new phpDB(); # La variable $db guarda la referencia a la BD
  $db->connect();
  $db->exec('SELECT * FROM libro, categoria, categoria_libro WHERE libro.autor_id LIKE $1 and libro.id LIKE $2 and libro.titulo LIKE $3 and libro.descripcion LIKE $4 and categoria_libro.libro_id = libro.id and categoria.id = categoria_libro.categoria_id ORDER BY titulo ASC', array('%'.$_GET['autor'].'%','%'.$_GET['codigo'].'%','%'.$_GET['titulo'].'%','%'.$_GET['descripcion'].'%'));

?>

<h2>Resultados</h2>

<table>
  <thead>
    <th>Autor</th>
    <th>ID</th>
    <th>Titulo del libro</th>
    <th>Descripcion</th>
    <th>Stock</th>
    <th>Categoria</th>
    <th>Nombre</th>
  </thead>
  <tbody>

<!--<ul>-->
<?
  do {
?>
<tr>
     <td><? echo $db->fobject()->id; ?></td>
     <td><? echo $db->fobject()->autor_id; ?></td>
     <td><? echo $db->fobject()->titulo; ?></td>
     <td><? echo $db->fobject()->descripcion; ?></td>
     <td><? echo $db->fobject()->stock; ?></td>
     <td><? echo $db->fobject()->categoria_id; ?></td>
     <td><? echo $db->fobject()->nombre; ?></td>
     <td><a href="devolucion_libro.php?id=<? echo $db->fobject()->id; ?>">Devolver</a></td>
     <td><a href="prestar_libro.php?id=<? echo $db->fobject()->id; ?>">Prestar</a></td>
</tr>


<?
  } while($db->nextRow());
?>
 
<!--</ul>-->
 </tbody>
</table>
<br><br><a href='buscar_libro.php'>VOLVER A LA BUSQUEDA </a></br></br>
<?



  include('include/footer.php');

  $db->close();
?>
