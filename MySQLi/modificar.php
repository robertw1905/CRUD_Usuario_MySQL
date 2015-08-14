<html>
<head><title>Test</title></head>
<body>
	<div align="center"><h3>Usuarios del Sistema</h3>
<?php
	include('class.Conexion.php');
	$bd = new Conexion();
	$resultado = $bd->consulta("select * from usuario_table where id = '".$_GET['id']."';");
	echo '<form action="index.php?modo=modificar" method="post">';
	echo '<table border = "1">';
	echo '<tr><th colspan="3">Modificar Información</th></tr>';
	echo '<tr><td>Nombre</td><td>Apellido</td><td>Email</td></tr>';

	if($resultado!=NULL){
	    if(count($resultado)>0){
			foreach($resultado as $row){
	       	echo '<tr><td><input type="hidden" name ="id" value="',$row['id'],'"><input type="hidden" name ="modificar" value="1">',
	       			     	'<input type="text" name ="nombre" value="',$row['nombres'],'"/>
					</td><td><input type="text" name ="apellido" value="',$row['apellidos'],'"/>
					</td><td><input type="text" name ="email" value="',$row['correo'],'"/>';
	       }
	    }else{
	    }
	 }
	echo '<tr><td colspan=4><center><input type="submit" value="Enviar"></center></td></tr>';
	echo'</table></form>';
?>
</div>
</body>
</html>