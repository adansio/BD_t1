<?php 

SELECT * FROM libro WHERE (id LIKE $1 or autor_id LIKE $2 or titulo LIKE $3 or descripcion LIKE $4) ORDER BY titulo ASC', array('%'.$_GET['codigo'].'%','%'.$_GET['autor'].'%','%'.$_GET['titulo'].'%','%'.$_GET['descripcion'].'%
?>
