<?php
	session_start();
	
	$nombre=$_POST["nombre"];
	$codigo=$_POST["codigo"];
	
	//Conecta con la base de datos ($conexión)
    include 'configbd.php'; //include del archivo con los datos de conexión
	$conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD); //Conecta con la base de datos
    $conexion->set_charset("utf8"); //Usa juego caracteres UTF8
	//Desactiva errores
	$controlador = new mysqli_driver();
    $controlador->report_mode = MYSQLI_REPORT_OFF;
	
	//SQL
	$sql="SELECT idJesuita,nombre FROM jesuita WHERE nombre='".$nombre."' AND codigo='".$codigo."';";
	$resultado=$conexion->query($sql);
	
	//Inicio de Sesión
	if(	$conexion->affected_rows>0){
		$fila=$resultado->fetch_array();
		$_SESSION["idJesuita"]=$fila["idJesuita"];
		$_SESSION["nombre"]=$fila["nombre"];
		echo "<h3><a href=".'visitaIngles.php'.">You can now make visits</a></h3>";
	}else{
		echo "<h2>INCORRECT DATA --> </h2>";
		echo "<h3><a href=".'jesuitasIngles.html'.">Try Again</a></h3>";
	}
	
	$conexion->close();
?>