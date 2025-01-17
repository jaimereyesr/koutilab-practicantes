<?php
session_start();
$id_user = $_SESSION['id_alumno_primaria'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno_primaria'])) {
    header('location: ../../../../../../../../acciones/cerrarsesion.php');
}
include "../../../../../../../../acciones/conexion.php";
$id_user = $_SESSION['id_alumno_primaria'];
$permiso = "capsula9";
$sql = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_primaria c INNER JOIN detalle_capsulas_primaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$permiso' AND d.id_curso = 1");
$existe = mysqli_fetch_all($sql);
if (empty($existe) && $id_user != 1) {
    header("Location: ../../../../basico/capsulas/acciones/capsulas.php");
}

//Verificar si ya se tiene permiso y no dar puntos de más
$permiso_intento = 10;
$sql_permisos = mysqli_query($conexion, "SELECT * FROM detalle_capsulas_primaria WHERE id_capsula = $permiso_intento AND id_alumno = '$id_user' AND id_curso = 1");
$result_sql_permisos = mysqli_num_rows($sql_permisos);
//Script para poder ver cuantos intentos lleva el alumno en la capsula y mostrar cuantos puntos gano dependiendo los intentos

//Contar total de intentos
$consultaIntentos = mysqli_query($conexion, "SELECT intentos FROM detalle_intentos_primaria WHERE id_capsula = $permiso_intento AND id_alumno = $id_user AND id_curso = 1");
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
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/css-juegos/copy-code.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>KOUTILAB</title>
    <link rel="shortcut icon" href="../../../../../../img/lgk.png" />
</head>

<body onload="iniciarTiempo()">
    <!-- Timer -->
    <div class="timer" id="timer">
        <b>Tiempo: <br>
            <p id="tiempo" style="margin: 0 0 0 0;"></p>
        </b>
    </div>

    <!-- Titulo general del juego -->
    <div class="titulo-gen">
        <h2 class="titulo"><b>LISTAS ORDENADAS Y NO ORDENADAS </b></h2>
    </div>

    <!-- Contenedor principal -->
    <section>
        <!-- Boton para regresar -->
        <div class="cont-st">
            <a href="#" onclick="history.back();">
                <button class="btn-b">
                    <i class="fas fa-reply"></i>
                </button>
            </a>
            <h4 class="titulo"><b>Copia el código mostrado en el lado izquierdo al lado derecho antes de que termine el tiempo</b></h4>
        </div>
        <br>

        <!--CONTENEDOR DEL JUEGO-->
        <div class="mjuego">

            <!--EJEMPLO DE CODIGO-->
            <div class="ejemplo">


                <p id="textoej">
                </p>
            </div>

            <!--CCUADRO DE TEXTO DONDE SE COPIARA EL CODIGO-->
            <div class="copia">
                <textarea id="escrito" oncontextmenu="return false"></textarea>
            </div>

        </div>


        <!-- boton de verificar respuestas -->
        <div class="btn-v">
            <button class="verificar" onClick="alertExcelent()">Comprobar respuestas</button>
        </div>
    </section>
    <footer class="footerimga">
        <div class="imagen-footer">
            <img src="../../img/img-juegos/benvenida.png" alt="No-image">
        </div>
    </footer>

    <script>
        //Contador de tiempo en segundos, si se acaba el tiempo sale alerta
        var segundos = 240;
        let puntos = 0;

        //Funcion que agrega el sonido al juego
        var correcto = document.createElement("audio");
        correcto.src = "../../../../../../../../acciones/sonidos/correcto.mp3";
        var incorrecto = document.createElement("audio");
        incorrecto.src = "../../../../../../../../acciones/sonidos/incorrecto.mp3";

        //ASIGNA EL TEXTO AL CUADRO DE EJEMPLO DEL JUEGO
        document.getElementById(
            "textoej"
        ).innerHTML = `
&ltp&gt Reglamento del aula de clases &lt/p&gt </br>
&ltol&gt &ltli&gt Ingresar al aula de clases con el uniforme adecuado &lt/li&gt </br>
&ltli&gt Respetar a compañeros y profesores &lt/li&gt </br>
&ltli&gt No ingresar con alimentos &lt/li&gt &lt/ol&gt`;
        //Entidades para que html no reconosca las etiquetas
        //&lt; representa (<).
        //&gt; representa (>).
        //&quot; representa (").

        //Funcion para bloquear copiar y pegar
        document.addEventListener("keydown", function(event) {
            //con event se detecta si se presiono la tecla control y la tecla c o C
            if (event.ctrlKey && (event.key === "c" || event.key === "C")) {
                event.preventDefault(); //con prevent defaul el navegador bloquea la accion
            }

            if (event.ctrlKey && (event.key === "v" || event.key === "V")) {
                event.preventDefault();
            }
        });

        //Funcion que borra lo escrito dentro del textarea cuando se actualiza la pagina
        window.onbeforeunload = function() {
            document.getElementById("escrito").value = "";
        };

        function iniciarTiempo() {
            document.getElementById("tiempo").innerHTML = segundos + " segundos";
            /*declarando condiciones que permiten cambiar el color de fondo del timer*/
            if (segundos <= 60) {
                var div = document.getElementById("timer");
                div.style.cssText = "animation-name: animation1; animation-duration: 0.5s; background-color: #c42c2caf; border-color: #c42c2c;";
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
                var param = "score=" + 0 + "&validar=" + 'incorrecto' + "&permiso=" + 10 + "&id_curso=" + 1 + "&redireccion=" + '../contenido/juegos/cjhtml3.php'; //cancatenation
                xmlhttp.open("POST", "../../acciones/insertar_juego.php", true);
                xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xmlhttp.send(param);
                //Borra el texto escrito
                escrito.value = "";
                Swal.fire({
                    title: "Oops...",
                    text: "¡Se te ha agotado el tiempo!",
                    imageUrl: "../../img/img-juegos/loop.gif",
                    imageHeight: 350,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });
                incorrecto.play(); //agregando sonido al juego no completado
            } else {
                segundos--;
                setTimeout("iniciarTiempo()", 1000);
            }
        }

        //Alerta muestra de que el juego fue completado
        function alertExcelent() {
            //Obtiene el texto escrito en la pagina
            var textoejemplo = document.getElementById("textoej");
            var textoejemplof = textoejemplo.textContent;
            var textoescrito = document.getElementById("escrito").value;
            //Elimina los espacios que existen en los textos para que la comparacion sea mas exacta
            var text1 = textoescrito.replace(/\s/g, "");
            var text2 = textoejemplof.replace(/\s/g, "");
            //Compara y valida si el texto es igual o no y muestra mensajes.
            if (text1 === text2) {
                var puntos = <?php echo $puntosGanados; ?>;

                var xmlhttp = new XMLHttpRequest();
                var param = "score=" + 10 + "&validar=" + 'correcto' + "&permiso=" + 10 + "&id_curso=" + 1 + "&redireccion=" + '../contenido/juegos/cjhtml3.php'; //cancatenation
                xmlhttp.open("POST", "../../acciones/insertar_juego.php", true);
                xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xmlhttp.send(param);
                Swal.fire({
                    title: "Excelente",
                    text: "¡Buen trabajo! Obtienes " + puntos + " puntos de logros",
                    imageUrl: "../../img/img-juegos/Thumbs-Up.gif",
                    imageHeight: 350,
                    backdrop: `
                rgba(0,143,255,0.6)
                url("../../img/img-juegos/fondo.gif")`,
                    confirmButtonColor: "#a14cd9",
                    confirmButtonText: "¡Genial!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        //Borra el texto escrito
                        escrito.value = "";
                        window.location.href = "../../../../../../rutas/ruta-pw-b.php";
                    }
                });
                correcto.play(); //agrengando sonido al juego completado
            } else {
                Swal.fire({
                    title: "Oops...",
                    text: "¡Verifica tu respuesta!",
                    imageUrl: "../../img/img-juegos/loop.gif",
                    imageHeight: 350,
                    backdrop: `
                rgba(0,143,255,0.6)
                url("../../img/img-juegos/fondo.gif")`,
                    confirmButtonColor: "#a14cd9",
                    confirmButtonText: "Reintentar",
                });
            }
        }
    </script>
</body>

</html>