<?php 

function Conectar()
{
	$host = 'localhost';
	$user = 'root';
	$pass = '';
	$db = 'barrioitalia';
			
	$link = mysql_connect($host,$user,$pass) or die 
	('No se puede conectar a la base de datos!');
	mysql_select_db($db) or die 
	('No se puede seleccionar la base de datos!');
}

function adaptarFecha($fecha){
	$cadena = explode(' ', $fecha);
	return $cadena[0];
}

Conectar();

$fecha = date("Y"."-"."m"."-"."d");
echo $fecha;
echo "<br>";

$consulta = mysql_query("SELECT * FROM oferta");

while($info = mysql_fetch_array($consulta)){
	if($fecha <= adaptarFecha($info['termino'])){
		echo "ok";
	}
}

?>