<?php
//Recoge la información del formulario
	$nombreJesuita=$_POST["nombreJesuita"];    //asigna el valor que se envía del formulario, recuerda acabar con ;
	$nombreAlumno=$_POST["nombreAlumno"];
	$firmaEsp=$_POST["firmaEsp"];
	$firmaIng=$_POST["firmaIng"];
	$codigo=$_POST["codigo"];

//Conecta con la base de datos ($conexión)
    include 'configbd.php'; //include del archivo con los datos de conexión
	$conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD); //Conecta con la base de datos
    $conexion->set_charset("utf8"); //Usa juego caracteres UTF8
	//Desactiva errores
	$controlador = new mysqli_driver();
    $controlador->report_mode = MYSQLI_REPORT_OFF;
	
//Cadena de caracteres de la consulta sql	
	$sql="INSERT INTO jesuita(codigo,nombre,nombreAlumno,firma,firmaIngles) VALUES('".$codigo."','".$nombreJesuita."','".$nombreAlumno."','".$firmaEsp."','".$firmaIng."');";   //completa lo que falta
	echo $sql; //envía el contenido de la variable al navegador, o sea, muestra la información en el navegador
	
//Ejecuta la consulta
	$conexion->query($sql);
	if($conexion->affected_rows>0)
		echo "<h2>Jesuitas Introducidos</h2>";
	else{
		echo "<h2>Los jesuitas no se han introducido</h2>";
		echo '<h3><a href="IntroducirJesuitas.html"> Vuelve a intentarlo</a></h3>';
	}	

//Cierra la conexión
	$conexion->close();
?>