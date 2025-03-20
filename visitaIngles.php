<?php
	session_start();
	$_SESSION["nombre"];
	
	//Conecta con la base de datos ($conexión)
    include 'configbd.php'; //include del archivo con los datos de conexión
	$conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD); //Conecta con la base de datos
    $conexion->set_charset("utf8"); //Usa juego caracteres UTF8
	//Desactiva errores
	$controlador = new mysqli_driver();
    $controlador->report_mode = MYSQLI_REPORT_OFF;	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Visits</title>
		<meta charset="UTF-8"/>
		<meta name="autor" content="Adrián Risco Sánchez"/>
		<link rel="stylesheet" href="estiloformulario.css"/>
	</head>
	<body>
		<form name="formulario" method="POST" action="hacerVisitas.php">
			<fieldset>
				<?php
				$sql2="SELECT ip,lugar FROM lugar";
				$resultado=$conexion->query($sql2);

				echo "<legend class=".'tituloslegends'.">What visit are you going to make, ".$_SESSION["nombre"]."?</legend>";
				echo "<p>Place:</p>";
				echo "<select name=".'ip'.">";
				while($fila=$resultado->fetch_array()){
					echo "'<option value=".$fila["ip"].">".$fila["lugar"]."</option>'";
				}
				echo "</select>";
				echo "</br></br><input type=".'submit'." id=".'enviar'." value=".'SEND'.">";
				?>
			</fieldset>
		</form>
	</body>
</html>