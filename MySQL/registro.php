<html>
<head>
	<title>Test</title>
</head>
<body>
<div align="center"><h3>Usuarios del Sistema</h3>

<form action="index.php?modo=registro" method="post">
<table border="1">
		<tr><th colspan="3">Registro</th></tr>
	<tbody>
		<tr>
			<td><label>Nombre</label><br/><input type="text" name="nombre">
										  <input type="hidden" name="registro" value="1"></td>
			<td><label>Apellido</label><br/><input type="text" name="apellido"></td>
			<td><label>Email</label><br/><input type="email" name="email"></td>
		</tr>
		<tr>
			<td colspan="3"><center><input type="submit" value="Enviar"/><center></td>
		</tr>
	</tbody>
</table>
</form>
</div>
</body>
</html>