<html>
<head><title>Test</title></head>
<body>
	<div align="center"><h3>Usuarios del Sistema</h3>
<?php 
include('class.Conexion.php');

$modo = (isset($_REQUEST['modo'])? $_GET['modo'] :'default');	

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
 		$bd = new Conexion();
		$resultado = $bd->consulta('select * from usuario_table');
		echo '<form action="registro.php" method="POST">';
		echo '<table border = 1>';
		echo '<tr><th>Nombre</th><th>Apellido</th><th>Acciones</th></tr>';
		foreach($resultado as $row){
			echo '<tr><td>',$row['nombres'],'</td>';
			echo '<td>',$row['apellidos'],'</td>
			<td><a href="modificar.php?id=',$row['id'],'">Modificar</a>
			<a href="index.php?modo=borrar&id=',$row['id'],'">Borrar</a></td></tr>';
		}
		echo '<td colspan = "3"><center><input type="submit" value="Resgistrate" /></center></td>';
		echo '</table>';
		echo '</form>';
 		break;
 }
?>
</div>
</body>
</html>