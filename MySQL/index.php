<html>
<head><title>Test</title></head>
<body>
	<div align="center"><h3>Usuarios del Sistema</h3>
<?php
include('class.Conexion.php');

$modo = isset($_GET['modo']) ? $_GET['modo'] : 'default';

	switch ($modo) {
		case 'registro':
			if(isset($_POST['registro'])){
				include ('class.Usuario.php');
				$registro =new Usuario();
				$registro->registrar($_POST['nombre'],$_POST['apellido'],$_POST['email']);
				echo "registro exitoso.";
				header('location: index.php');
			}
			break;
		case 'modificar':
			if(isset($_POST['modificar'])){
				include('class.Usuario.php');
				$registro =new Usuario();
				$registro->modificar($_POST['nombre'],$_POST['apellido'],$_POST['email'],$_POST['id']);
				header('location: index.php');
			}
			break;
		case 'borrar':
				include('class.Usuario.php');
				$registro =new Usuario();
				$registro->borrar($_GET['id']);
				header('location: index.php');
			break;
		default:
		//vista del index
			$bd = new Conexion();
			$resultado = $bd->consulta("select * from usuario_table");
			echo '<form action="registro.php" method="post">';
			echo '<table border = "1">';
			echo '<tr><td>Nombre</td><td>Apellido</td><td>Email</td><td>Acciones</td></tr>';
			if($resultado!=NULL){
			    if(count($resultado)>0){
			       	foreach($resultado as $row){
			       		echo '<tr><td><input type="hidden" name ="id" value="',$row['id'],'">',$row['nombres'],'
							</td><td>',$row['apellidos'],'
							</td><td>',$row['correo'],'
							</td><td><a href="modificar.php?id=',$row['id'],'">Modificar</a><br/>
							<a href="index.php?modo=borrar&id=',$row['id'],'">Borrar</a></td></tr>';
			        }
			    }else{
			    }
			    $bd->liberar($resultado);
			 }
			echo '<tr><td colspan=4><center><input type="submit" value="Registrar"></center></td></tr>';
			echo'</table></form>';
			break;
	}
?>
</div>
</body>
</html>