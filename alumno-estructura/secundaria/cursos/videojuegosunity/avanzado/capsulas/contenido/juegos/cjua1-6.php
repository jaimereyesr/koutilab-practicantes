<?php
session_start();
$id_user = $_SESSION['id_alumno_secundaria'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno_secundaria'])) {
	header('location: ../../../../../../../../acciones/cerrarsesion.php');
}
include "../../../../../../../../acciones/conexion.php";
$id_user = $_SESSION['id_alumno_secundaria'];
$permiso = "capsula24";
$sql = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_secundaria c INNER JOIN detalle_capsulas_secundaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$permiso' AND d.id_curso = 12");
$existe = mysqli_fetch_all($sql);
if (empty($existe) && $id_user != 1) {
	header("Location: ../../../../avanzado/capsulas/acciones/capsulas.php");
}

//Verificar si ya se tiene permiso y no dar puntos de más
$permiso_intento = 25;
$sql_permisos = mysqli_query($conexion, "SELECT * FROM detalle_capsulas_secundaria WHERE id_capsula = $permiso_intento AND id_alumno = '$id_user' AND id_curso = 12");
$result_sql_permisos = mysqli_num_rows($sql_permisos);
//Script para poder ver cuantos intentos lleva el alumno en la capsula y mostrar cuantos puntos gano dependiendo los intentos

//Contar total de intentos
$consultaIntentos = mysqli_query($conexion, "SELECT intentos FROM detalle_intentos_secundaria WHERE id_capsula = $permiso_intento AND id_alumno = $id_user AND id_curso = 12");
$resultadoIntentos = mysqli_fetch_assoc($consultaIntentos);
if (isset($resultadoIntentos['intentos'])) {
	$totalIntentos = $resultadoIntentos['intentos'];
	if ($totalIntentos == 2 && $result_sql_permisos == 0) {
		$puntosGanados = 8;
	} else if ($totalIntentos == 3 && $result_sql_permisos == 0) {
		$puntosGanados = 6;
	} else if ($totalIntentos > 3 && $result_sql_permisos == 0) {
		$puntosGanados = 0;
	} else {
		$puntosGanados = 0;
	}
} else {
	$puntosGanados = 10;
}

?>
<!DOCTYPE html>
<html>

<head>
	<title>KOUTILAB</title>
	<link rel="shortcut icon" href="img/lgk.png">

	<link rel="stylesheet" type="text/css" href="../../css/css-juegos/sopa-letras.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
	<script language="javascript" type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript" src="../../js/wordfind.js"></script>
	<script type="text/javascript" src="../../js/wordfindgame2.js"></script>
	<script src="https://kit.fontawesome.com/53845e078c.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body onload="iniciarTiempo();">
	<!-- CAMBIOS -->
	<!-- Timer -->
	<div class="timer" id="timer">
		<b>Tiempo: <br>
			<p id="tiempo" style="margin: 0 0 0 0;"></p>
		</b>
	</div>

	<!-- Titulo general -->
	<div class="titulo-gen">
		<h2 class="titulo"><b>SALTO CON GROUND CHECK</b></h2>
	</div>

	<section>

		<div class="cont-st">
			<a href="#" onclick="history.back();">
				<button class="btn-b">
					<i class="fas fa-reply"></i>
				</button>
			</a>
			<h6 class="titulo"><b>Busca las palabras ocultas dentro de la sopa de letras</b></h6>
		</div>
		<!--FIN  CAMBIOS -->

		<!--CONTENEDOR DEL JUEGO-->
		<div class="mjuego">
			<!-- Sección donde se agregan las palabras a buscar dentro de la sopa de letras -->
			<div class="words">
				<div class="title-h6">
					<h4><b>Palabras a buscar:</b></h4>
				</div>
				<div id='Palabras'></div>
			</div>

			<!-- Sección donde se agrega la sopa de letras -->
			<div class="soup">
				<div id='juego' style="margin: 0 0 0 40px;"></div>
			</div>
		</div>

	</section>
	<!-- CAMBIOS -->
	<footer class="footerimga">
		<div class="imagen-footer">
			<img src="../../img/img-juegos/benvenida.png" alt="No-image">
		</div>
	</footer>
	<!-- fIN CAMBIOS -->
	<script>
		// Se pueden agregar las palabras que quieran, pero agregar al menos una palabra de 10 letras
		// para mantener proporcion
		var words = ['FUNCION', 'COLISIONES', 'COMANDOS', 'GROUND', 'CHECK', 'OBJETO', 'SECUENCIA', 'SUELO'];
		var gamePuzzle = wordfindgame.create(words, '#juego', '#Palabras');

		var puzzle = wordfind.newPuzzle(words, {
			height: 18,
			width: 18,
			fillBlanks: false
		});
		wordfind.print(puzzle);

		$('#solve').click(function() {
			wordfindgame.solve(gamePuzzle, words);
		});
	</script>
	<script>
		var segundos = 240;

		let puntos = 0;

		function iniciarTiempo() {
			document.getElementById('tiempo').innerHTML = segundos + " segundos";
			if (segundos <= 60) {
				var div = document.getElementById("timer");
				div.style.cssText = " animation-name: animation1; animation-duration: 0.5s; background-color: #c42c2caf; border-color: #c42c2c;";
			}
			if (segundos <= 30) {
				var div = document.getElementById("timer");
				div.style.cssText = "animation-name: animation2; animation-duration: 0.5s; background-color: #c42c2caf; border-color: #c42c2c;";
			}
			if (segundos <= 10) {
				var div = document.getElementById("timer");
				div.style.cssText = "animation-name: animation3; animation-duration: 0.5s; background-color: #c42c2caf; border-color: #c42c2c;";
			}

			if (segundos == 0) {
				var xmlhttp = new XMLHttpRequest();
				var param = "score=" + 0 + "&validar=" + 'incorrecto' + "&permiso=" + 25 + "&id_curso=" + 12; //cancatenation
				xmlhttp.open("POST", "../../acciones/insertar_pd25.php", true);
				xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xmlhttp.send(param);
				Swal.fire({
					title: 'Oops...',
					text: '¡Verifica tu respuesta!',
					imageUrl: "../../img/img-juegos/loop.gif",
					imageHeight: 350,
				}).then((result) => {
					if (result.isConfirmed) {
						window.location.reload();
					}
				});
			} else {
				segundos--;
				setTimeout("iniciarTiempo()", 1000);
			}
		}
	</script>
	<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>