<?php
session_start();
$id_user = $_SESSION['id_alumno_secundaria'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno_secundaria'])) {
    header('location: ../../../../../../../../acciones/cerrarsesion.php');
}
include "../../../../../../../../acciones/conexion.php";
$id_user = $_SESSION['id_alumno_secundaria'];
$permiso = "capsula35";
$sql = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_secundaria c INNER JOIN detalle_capsulas_secundaria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$permiso' AND d.id_curso = 12");
$existe = mysqli_fetch_all($sql);
if (empty($existe) && $id_user != 1) {
    header("Location: ../../../../avanzado/capsulas/acciones/capsulas.php");
}

//Verificar si ya se tiene permiso y no dar puntos de más
$permiso_intento = 36;
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

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>KOUTILAB</title>
    <link rel="shortcut icon" href="../../../../../../img/lgk.png">
    <link rel="stylesheet" href="../../css/capsula-teoria.css" />
    <link rel="stylesheet" href="../../css/carrusel.css" />
    <script src="https://kit.fontawesome.com/53845e078c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.2/plyr.css" />
    <script src="https://cdn.plyr.io/3.7.2/plyr.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <div class="body">
        <div class="container">
            <a href="#" onclick="history.back(); return false;"><button style="float: left;" class="btn-b" id="btn-cerrar-modalV"><i class="fas fa-reply"></i></button></a>
            <div class="new-g" style="text-align: center;">Cápsula teórica 4 Videojuegos Unity</div><br>
            <section id="container-slider">
                <section id="container-slider">
                    <a href="javascript: fntExecuteSlide('prev');" class="arrowPrev"><i class="fas fa-chevron-circle-left"></i></a>
                    <a href="javascript: fntExecuteSlide('next');" class="arrowNext"><i class="fas fa-chevron-circle-right"></i></a>
                    <ul class="listslider">
                        <!-- Agregar linea de código <li><a itlist="itList_X" href="#"></a></li> cada que se agrega una imagen más-->
                        <li>
                            <a itlist="itList_1" href="#" class="item-select-slid"></a>
                        </li>
                        <li>
                            <a itlist="itList_2" href="#"></a>
                        </li>
                        <li>
                            <a itlist="itList_3" href="#"></a>
                        </li>
                        <li>
                            <a itlist="itList_4" href="#"></a>
                        </li>
                        <li>
                            <a itlist="itList_5" href="#"></a>
                        </li>
                        <li>
                            <a itlist="itList_6" href="#"></a>
                        </li>
                    </ul>
                    <ul id="slider">
                        <li style="background-image: url('../../img/videojuegosunitya/T14/1.jpg'); z-index:0; opacity: 1;"></li>
                        <li style="background-image: url('../../img/videojuegosunitya/T14/2.jpg');"></li>
                        <li style="background-image: url('../../img/videojuegosunitya/T14/3.jpg');"></li>
                        <li style="background-image: url('../../img/videojuegosunitya/T14/4.jpg');"></li>
                        <li style="background-image: url('../../img/videojuegosunitya/T14/5.jpg');"></li>
                        <li>
                            <div>
                                <form class="forms" id="evaluar" method="POST" enctype="multipart/form-data" action="../../acciones/insertar_pd36.php">
                                    <h2>Para poder avanzar, responde la siguiente pregunta.</h2>
                                    <h1>¿Qué se necesita para la carga de escena de game over?</h1>
                                    <div class="container-question">
                                        <input type="checkbox" id="checkbox1" class="check-box" style="scale: 90%;">
                                        <label for="checkbox1">
                                            Fuction Game
                                        </label>
                                    </div>
                                    <div class="container-question">
                                        <input type="checkbox" id="checkbox2" class="check-box" style="scale: 90%;">
                                        <label for="checkbox2">
                                            Scene Manager
                                        </label>
                                    </div>
                                    <div class="container-question">
                                        <input type="checkbox" id="checkbox3" class="check-box" style="scale: 90%;">
                                        <label for="checkbox3">
                                            Game Manager
                                        </label>
                                    </div>
                                    <div class="container-question">
                                        <input type="checkbox" id="checkbox4" class="check-box" style="scale: 90%;">
                                        <label for="checkbox4">
                                            Script Game
                                        </label>
                                    </div>
                                    <input type="hidden" name="permiso" value="36">
                                    <input type="hidden" name="teorico" value="10">
                                    <input type="hidden" name="id_curso" value="12">
                                    <input type="hidden" name="validar" id="validar" value="incorrecto">
                                </form>
                            </div>
                        </li>
                    </ul>
                </section>
        </div>
    </div>
    <footer class="footerimga">
        <div class="imagen-footer">
            <img src="../../img/benvenida.png" alt="No-image">
        </div>
    </footer>
    <script>
        window.addEventListener("load", function() {
            var form = document.querySelector("form");
            var fields = form.querySelectorAll("div");
            var randomIndex = Math.floor(Math.random() * fields.length);

            for (var i = 0; i < fields.length; i++) {
                var index = (i + randomIndex) % fields.length;
                form.appendChild(fields[index]);
            }
        });
    </script>
    <script>
        //se esta llamando los sonidos de la carpeta "sonidos"
        var Correcto = document.createElement("audio");
        Correcto.src = "../../../../../../../../acciones/sonidos/correcto.mp3";
        var Incorrecto = document.createElement("audio");
        Incorrecto.src = "../../../../../../../../acciones/sonidos/incorrecto.mp3";
        //checar respuesta

        var puntos = <?php echo $puntosGanados; ?>;
        var checkbox1 = document.getElementById('checkbox1');
        var checkbox2 = document.getElementById('checkbox2');
        var checkbox3 = document.getElementById('checkbox3');
        var checkbox4 = document.getElementById('checkbox4');

        checkbox1.addEventListener("change", comprueba, true);
        checkbox2.addEventListener("change", comprueba, true);
        checkbox3.addEventListener("change", comprueba, true);
        checkbox4.addEventListener("change", comprueba, true);

        function comprueba() {
            if (checkbox2.checked) {
                //UNA SERIE DE CONDICIONALES ANIDADAS LAS CUALES VALIDAN NUESTROS 4 POSIBLES RESULTADOS Y MANDA LA ALERTA CORRESPONDIENTE
                if (puntos == 0) {
                    //se llama a "sonido" y reproducimos el sonido de que esta correcto
                    Correcto.play();
                    //resultado();
                    Swal.fire({
                        title: 'Bien hecho al fin lo lograste. ¡Debes mejorar!',
                        text: '¡Más de 3 intentos, no es posible sumar puntos!',
                        imageUrl: "../../../../../../img/Thumbs-Up.gif",
                        imageHeight: 350,
                        backdrop: `
                    rgba(0,143,255,0.6)
                    url("../../../../../../img/fondo.gif")
                    `,
                        confirmButtonColor: '#a14cd9',
                        confirmButtonText: 'Aceptar',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var inputValidar = document.getElementById("validar");
                            inputValidar.value = "correcto";
                            document.getElementById('evaluar').submit();
                        }
                    });
                } else if (puntos == 6) {
                    //se llama a "sonido" y reproducimos el sonido de que esta correcto
                    Correcto.play();
                    Swal.fire({
                        title: '¡Bien hecho! ' + 'Obtuviste ' + puntos + ' puntos teóricos',
                        text: '¡Puntuación guardada con éxito!',
                        imageUrl: "../../../../../../img/Thumbs-Up.gif",
                        imageHeight: 350,
                        backdrop: `
                    rgba(0,143,255,0.6)
                    url("../../../../../../img/fondo.gif")
                    `,
                        confirmButtonColor: '#a14cd9',
                        confirmButtonText: 'Aceptar',
                    }).then((result) => {

                        if (result.isConfirmed) {
                            var inputValidar = document.getElementById("validar");
                            inputValidar.value = "correcto";
                            document.getElementById('evaluar').submit();
                        }
                    });
                } else if (puntos == 8) {
                    //se llama a "sonido" y reproducimos el sonido de que esta correcto
                    Correcto.play();
                    Swal.fire({
                        title: '¡Bien hecho! ' + 'Obtuviste ' + puntos + ' puntos teóricos',
                        text: '¡Puntuación guardada con éxito!',
                        imageUrl: "../../../../../../img/Thumbs-Up.gif",
                        imageHeight: 350,
                        backdrop: `
                    rgba(0,143,255,0.6)
                    url("../../../../../../img/fondo.gif")
                    `,
                        confirmButtonColor: '#a14cd9',
                        confirmButtonText: 'Aceptar',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var inputValidar = document.getElementById("validar");
                            inputValidar.value = "correcto";
                            document.getElementById('evaluar').submit();
                        }
                    });
                } else if (puntos == 10) {
                    //se llama a "sonido" y reproducimos el sonido de que esta correcto
                    Correcto.play();
                    Swal.fire({
                        title: '¡Excelente sigue asi! ' + 'Obtuviste ' + puntos + ' puntos teóricos',
                        text: '¡Puntuación guardada con éxito!',
                        imageUrl: "../../../../../../img/Thumbs-Up.gif",
                        imageHeight: 350,
                        backdrop: `
                    rgba(0,143,255,0.6)
                    url("../../../../../../img/fondo.gif")
                    `,
                        confirmButtonColor: '#a14cd9',
                        confirmButtonText: 'Aceptar',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var inputValidar = document.getElementById("validar");
                            inputValidar.value = "correcto";
                            document.getElementById('evaluar').submit();
                        }
                    });
                }

            } else if (checkbox1.checked) {
                //se llama a "sonido" y reproducimos el sonido de que esta incorrecto
                Incorrecto.play();
                Swal.fire({
                    title: 'Oops...',
                    text: '¡Verifica tu respuesta!',
                    imageUrl: "../../../../../../img/signo.gif",
                    imageHeight: 350,
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('evaluar').submit();
                    }
                });
            } else if (checkbox3.checked) {
                //se llama a "sonido" y reproducimos el sonido de que esta incorrecto
                Incorrecto.play();
                Swal.fire({
                    title: 'Oops...',
                    text: '¡Verifica tu respuesta!',
                    imageUrl: "../../../../../../img/signo.gif",
                    imageHeight: 350,
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('evaluar').submit();
                    }
                });
            } else if (checkbox4.checked) {
                //se llama a "sonido" y reproducimos el sonido de que esta incorrecto
                Incorrecto.play();
                Swal.fire({
                    title: 'Oops...',
                    text: '¡Verifica tu respuesta!',
                    imageUrl: "../../../../../../img/signo.gif",
                    imageHeight: 350,
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('evaluar').submit();
                    }
                });
            }
        }
    </script>
    <script src="../../js/validar.js"></script>
    <script>
        function disableIE() {
            if (document.all) {
                return false;
            }
        }

        function disableNS(e) {
            if (document.layers || (document.getElementById && !document.all)) {
                if (e.which == 2 || e.which == 3) {
                    return false;
                }
            }
        }
        if (document.layers) {
            document.captureEvents(Event.MOUSEDOWN);
            document.onmousedown = disableNS;
        } else {
            document.onmouseup = disableNS;
            document.oncontextmenu = disableIE;
        }
        document.oncontextmenu = new Function("return false");
    </script>
    <script>
        onkeydown = e => {
            let tecla = e.which || e.keyCode;

            // Evaluar si se ha presionado la tecla Ctrl:
            if (e.ctrlKey) {
                // Evitar el comportamiento por defecto del nevagador:
                e.preventDefault();
                e.stopPropagation();

                // Mostrar el resultado de la combinación de las teclas:
                if (tecla === 85)
                    console.log("Ha presionado las teclas Ctrl + U");

                if (tecla === 83)
                    console.log("Ha presionado las teclas Ctrl + S");
            }
        }
    </script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <script defer src="../../js/functions.js"></script>
</body>