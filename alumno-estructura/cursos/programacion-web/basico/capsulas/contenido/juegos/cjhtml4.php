<?php
session_start();
$id_user = $_SESSION['id_alumno']; $rol = $_SESSION['rol'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno'])) {
    header('location: ../../../../../../../../acciones/cerrarsesion.php');
}
include "../../../../../../../../acciones/conexion.php";
$id_user = $_SESSION['id_alumno']; $rol = $_SESSION['rol'];
$permiso = "capsula12";
$sql = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_$rol c INNER JOIN detalle_capsulas_$rol d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$permiso' AND d.id_curso = 1");
$existe = mysqli_fetch_all($sql);
if (empty($existe) && $id_user != 1) {
    header("Location: ../../../../basico/capsulas/acciones/capsulas.php");
}

//Verificar si ya se tiene permiso y no dar puntos de más
$permiso_intento = 13;
$sql_permisos = mysqli_query($conexion, "SELECT * FROM detalle_capsulas_$rol WHERE id_capsula = $permiso_intento AND id_alumno = '$id_user' AND id_curso = 1");
$result_sql_permisos = mysqli_num_rows($sql_permisos);
//Script para poder ver cuantos intentos lleva el alumno en la capsula y mostrar cuantos puntos gano dependiendo los intentos

//Contar total de intentos
$consultaIntentos = mysqli_query($conexion, "SELECT intentos FROM detalle_intentos_$rol WHERE id_capsula = $permiso_intento AND id_alumno = $id_user AND id_curso = 1");
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
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../css/css-juegos/select-word.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>KOUTILAB</title>
    <link rel="shortcut icon" href="../../../../../../img/lgk.png" />
</head>

<body onload="iniciarTiempo()">
    <!-- Timer -->
    <div class="timer" id="timer">
        <b>Tiempo: <br />
            <p id="tiempo" style="margin: 0 0 0 0"></p>
        </b>
    </div>
    <!-- Titulo general del juego -->
    <div class="titulo-gen">
        <h2 class="titulo"><b>IMÁGENES</b></h2>
    </div>

    <!-- Contenedor principal -->
    <div class="contenido">
        <!-- Boton para regresar -->
        <div class="cont-st">
            <a href="../../../../../../rutas/ruta-pw-b.php">
                <button class="btn-b">
                    <i class="fas fa-reply"></i>
                </button>
            </a>
            <h4 class="titulo"><b>El jugador deberá seleccionar una respuesta de las listas seleccionables</b></h4>
        </div>
        <!--Generando contenedor que almacenara las preguntas y respuestas del juego-->
        <div class="container">
            <section><!--GENERANDO SECCION PARA PREGUNTAS Y RESPUESTAS-->
                <!--Generando pregunta 1-->
                <h3>1- ¿Cuál de las siguientes etiquetas se utiliza para insertar una imagen en HTML?
                    <select class="select" id="respuesta0"><!--Generando lista de opciones de respuesta de la pregunta 1-->
                        <option value="----">...</option>
                        <option value="incorrecto">BACKGROUND</option>
                        <option value="incorrecto">IMAGENES</option>
                        <option value="correcto">IMG</option>
                    </select>
                </h3>
                <!--Generando pregunta 2-->
                <h3>2- ¿Cuáles son las formas de agregar una imagen en una estructura HTML?
                    <select class="select" id="respuesta1"><!--Generando lista de opciones de respuesta de la pregunta 2-->
                        <option value="----">...</option>
                        <option value="incorrecto">Mediante QR</option>
                        <option value="incorrecto">Por archivos PDF</option>
                        <option value="correcto">Online y Local</option>
                    </select>
                </h3>
                <!--Generando pregunta 3-->
                <h3>3- ¿Cuál es el atributo que indica la ubicación o dirección de la imagen a colocar?
                    <select class="select" id="respuesta2"><!--Generando lista de opciones de respuesta de la pregunta 3-->
                        <option value="----">...</option>
                        <option value="correcto">SRC</option>
                        <option value="incorrecto">IMG</option>
                        <option value="incorrecto">VIDEO</option>
                    </select>
                </h3><!--Generando primer pregunta-->

                <h3>4- ¿Qué etiqueta se utiliza para colocar una imagen en PHP?
                    <select class="select" id="respuesta3"><!--Generando opciones de respuesta de la pregunta-->
                        <option value="----">...</option>
                        <option value="incorrecto">DIV</option>
                        <option value="incorrecto">BACKGROUND-IMG;</option>
                        <option value="correcto">ECHO</option>
                    </select>
                </h3><!--Generando primer pregunta-->
            </section>
        </div>

        <!--Boton para verificar la respuesta-->
        <!--Boton para verificar la respuesta-->
        <div class="btn-ctn">
            <button class="verificar" onClick="verificar()">
                Comprobar respuestas
            </button>
        </div>

    </div>
    <p id="resultado"></p>
    <!-- CAMBIOS -->
    <footer class="footerimga">
        <div class="imagen-footer">
            <img src="../../img/img-juegos/benvenida.png" alt="No-image">
        </div>
    </footer>
    <!-- fIN CAMBIOS -->


    <script>
        //Contador de tiempo en segundos, si se acaba el tiempo sale alerta
        var segundos = 240; //240

        //Funcion que agrega el sonido al juego
        var correcto = document.createElement("audio");
        correcto.src = "../../../../../../../../acciones/sonidos/correcto.mp3";
        var incorrecto = document.createElement("audio");
        incorrecto.src = "../../../../../../../../acciones/sonidos/incorrecto.mp3";

        //funcion que permite definir el tiempo que tiene el jugador
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
                var param = "score=" + 0 + "&validar=" + 'incorrecto' + "&permiso=" + 13 + "&id_curso=" + 1 + "&redireccion=" + '../contenido/juegos/cjhtml4.php'; //cancatenation
                xmlhttp.open("POST", "../../acciones/insertar_juego.php", true);
                xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xmlhttp.send(param);
                Swal.fire({
                    title: "Oops...Intentalo nuevamente, te has quedado sin tiempo",
                    text: "",
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

        //funcion Error, determina que las respuestas sean correctas
        function error() {
            var xmlhttp = new XMLHttpRequest();
            var param = "score=" + 0 + "&validar=" + 'incorrecto' + "&permiso=" + 13 + "&id_curso=" + 1 + "&redireccion=" + '../contenido/juegos/cjhtml4.php'; //cancatenation
            xmlhttp.open("POST", "../../acciones/insertar_juego.php", true);
            xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xmlhttp.send(param);
            Swal.fire({
                title: "¡Oh no!",
                text: "Comprueba tus respuestas, e intentalo nuevamente",
                imageUrl: "../../img/img-juegos/loop.gif",
                imageHeight: 350,
                backdrop: `
						rgba(0,143,255,0.6)
						url("../../img/img-juegos/fondo.gif")`,
                confirmButtonColor: "#a14cd9",
                confirmButtonText: "¡Sigue intentando!",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.reload();
                }
            });
        }

        //Alerta muestra de que el juego fue completado
        function alertExcelent() {
            var puntos = <?php echo $puntosGanados; ?>

            var xmlhttp = new XMLHttpRequest();
            var param = "score=" + 10 + "&validar=" + 'correcto' + "&permiso=" + 13 + "&id_curso=" + 1 + "&redireccion=" + '../contenido/juegos/cjhtml4.php'; //cancatenation
            xmlhttp.open("POST", "../../acciones/insertar_juego.php", true);
            xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xmlhttp.send(param);
            Swal.fire({
                title: "¡Felicidades!",
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
                    window.location.href = '../../../../../../rutas/ruta-pw-b.php';
                }
            });
            correcto.play(); //agregando sonido al juego completado
        }

        //funcion de validar respuestas
        function verificar() {
            var respuesta0 = document.getElementById("respuesta0").value; //valida la respuesta 1
            var respuesta1 = document.getElementById("respuesta1").value; //valida la respuesta 2
            var respuesta2 = document.getElementById("respuesta2").value; //valida la respuesta 3
            var respuesta3 = document.getElementById("respuesta3").value; //valida la respuesta 4

            if (respuesta0 == "correcto" && respuesta1 == "correcto" && respuesta2 == "correcto" && respuesta3 == "correcto" && respuesta1 == "correcto") {
                document.getElementById("resultado").innerHTML = "";
                alertExcelent(); //mandando a traer la funcion alertExelent para que se muestre cuando el usuario haya capturado las respuestas correctas
            } else {
                document.getElementById("resultado").innerHTML = "";
                error(); //mandando a llamar la funcion alertBad para indicarle al jugador que sus respuestas son incorrectas
            }
        }
    </script>
</body>

</html>