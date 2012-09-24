<?php
  include('include/header.php');

  require_once("include/db.php"); # Permite la comunicación con la bd

  # Se hace la conexión a la BD #
  $db = new phpDB(); # La variable $db guarda la referencia a la BD
  $db->connect();
  $db->exec('SELECT * FROM libro, autor, categoria, categoria_libro WHERE autor.nombre LIKE $1 and autor.id = libro.id and libro.id LIKE $2 and libro.titulo LIKE $3 and libro.descripcion LIKE $4 and categoria_libro.libro_id = libro.id and categoria.id = categoria_libro.categoria_id ORDER BY titulo ASC', array('%'.$_GET['autor'].'%','%'.$_GET['codigo'].'%','%'.$_GET['titulo'].'%','%'.$_GET['descripcion'].'%'));

?>

<header class="headres">
	<div class="titres"><h4>Resultados</h4></div>
</header>

<table class="mres">
  <thead>
    <th>Autor</th>
    <th>ID</th>
    <th>Titulo del libro</th>
    <th>Descripcion</th>
    <th>Categoria</th>
    <th>Stock</t>
  </thead>
  <tbody>

<!--<ul>-->
<?
if($db->fobject() != NULL)
{
  do {
?>
<tr>
     <td class="td1"><? echo $db->fobject()->autor_id; ?></td>
     <td class="td2"><? echo $db->fobject()->id; ?></td>
     <td class="td3"><? echo $db->fobject()->titulo; ?></td>
     <td class="td4"><? echo $db->fobject()->descripcion; ?></td>
     <td class="td5"><? echo $db->fobject()->nombre; ?></td>
     <td class="td6"><? echo $db->fobject()->stock; ?></td>
</tr>


<?
  } while($db->nextRow());
}
else echo "No se encontraron relaciones";
?>
 
<!--</ul>-->
 </tbody>
</table>
<div class="regresar">
	<br><br><a href='login.php'>VOLVER A LA BUSQUEDA </a></br></br>
</div>
<?
	include('include/footer.php');
	$db->close();
?>
