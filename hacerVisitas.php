<?php
//Recoge la información del formulario
	session_start();
	
	$_SESSION["nombre"];
	$ip=$_POST["ip"];

//Conecta con la base de datos ($conexión)
    include 'configbd.php'; //include del archivo con los datos de conexión
	$conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD); //Conecta con la base de datos
    $conexion->set_charset("utf8"); //Usa juego caracteres UTF8
	//Desactiva errores
	$controlador = new mysqli_driver();
    $controlador->report_mode = MYSQLI_REPORT_OFF;
	
//Cadena de caracteres de la consulta sql
	$sql="SELECT idJesuita FROM jesuita WHERE nombre='".$_SESSION["nombre"]."';";
	$resultado=$conexion->query($sql);
	while($fila=$resultado->fetch_array()){
		$idJesuita=$fila["idJesuita"];
	}
	
	$sql2="INSERT INTO visita(idJesuita,ip) VALUES(".$idJesuita.",'".$ip."');";   //completa lo que falta
	$conexion->query($sql2);
	if($conexion->affected_rows>0){
		echo "<h2>Visita realizada</h2>";
		echo '<h3><a href="visita.php"> Volver a Hacer Visitas</a></h3>';
		echo '<h3><a href="jesuitas.html"> Iniciar Sesión</a></h3>';
	}else{
		echo "<h2>La visita no se ha realizado</h2>";
		echo '<h3><a href="visitas.php"> Vuelve a intentarlo</a></h3>';
	}	

//Cierra la conexión
	$conexion->close();
?>
