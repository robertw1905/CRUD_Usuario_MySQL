<?php

class Usuario
{
	public function registrar($a,$b,$c){
		$bd = new Conexion();
		$bd->sql("insert into usuario_table (nombres,apellidos,correo) 
						values ('$a','$b','$c');");
	}

	public function modificar($a,$b,$c,$d){
		$bd = new Conexion();
		$bd->sql("update usuario_table set nombres='$a',apellidos='$b',correo='$c'
			where id = '$d';");
	}

	public function borrar($a){
		$bd = new Conexion();
		$bd->consulta("delete from usuario_table where id = '$a';");
	}
}

?>