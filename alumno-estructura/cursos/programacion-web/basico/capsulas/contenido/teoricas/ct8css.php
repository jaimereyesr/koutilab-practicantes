<?php
session_start();
$id_user = $_SESSION['id_alumno']; $rol = $_SESSION['rol'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno'])) {
    header('location: ../../../../../../../acciones/cerrarsesion.php');
}
include "../../../../../../../acciones/conexion.php";
$id_user = $_SESSION['id_alumno']; $rol = $_SESSION['rol'];
$permiso = "capsulapago4";
$sql = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_pago_$rol c INNER JOIN detalle_capsulas_pago_$rol d ON c.id_capsula_pago = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$permiso' AND d.id_curso = 1;");
$existe = mysqli_fetch_all($sql);
if (empty($existe)) {
    header("Location: ../../../../basico/capsulas/contenido/alertas/paquete_premium3.php");
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
            <div class="new-g" style="text-align: center;">Cápsula teórica 8 CSS</div><br>
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
                        <li>
                            <a itlist="itList_7" href="#"></a>
                        </li>
                    </ul>
                    <ul id="slider">
                        <li style="background-image: url('../../img/2/T2.5/144.gif'); z-index:0; opacity: 1;"></li>
                        <li style="background-image: url('../../img/2/T2.5/145.gif');"></li>
                        <li style="background-image: url('../../img/2/T2.5/146.gif');"></li>
                        <li style="background-image: url('../../img/2/T2.5/147.gif');"></li>
                        <li style="background-image: url('../../img/2/T2.5/148.gif');"></li>
                        <li style="background-image: url('../../img/2/T2.5/149.gif');"></li>
                        <li>
                            <div>
                                <form class="forms" id="evaluar" method="POST" enctype="multipart/form-data" action="../../acciones/insertar_cp7.php">
                                    <h2>Para poder avanzar, responde la siguiente pregunta.</h2>
                                    <h1>¿Cuándo se usa el 'box model'?</h1>
                                    <div class="container-question">
                                        <input type="checkbox" id="checkbox1" class="check-box" style="scale: 90%;">
                                        <label for="checkbox1">Cuando se habla del diseño, el modelo de una caja</label>
                                    </div>
                                    <div class="container-question">
                                        <input type="checkbox" id="checkbox2" class="check-box" style="scale: 90%;">
                                        <label for="checkbox2">Cuando se habla del diseño</label>
                                    </div>
                                    <div class="container-question">
                                        <input type="checkbox" id="checkbox3" class="check-box" style="scale: 90%;">
                                        <label for="checkbox3">Palabras que llevan corchetes</label>
                                    </div>
                                    <div class="container-question">
                                        <input type="checkbox" id="checkbox4" class="check-box" style="scale: 90%;">
                                        <label for="checkbox4">No recuerdo</label>
                                    </div>
                                    <input type="hidden" name="permiso" value="7">
                                    <input type="hidden" name="teorico" value="10">
                                    <input type="hidden" name="id_curso" value="1">
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
        Correcto.src = "../../../../../../../acciones/sonidos/correcto.mp3";
        var Incorrecto = document.createElement("audio");
        Incorrecto.src = "../../../../../../../../acciones/sonidos/incorrecto.mp3";
        //checar respuesta

        var checkbox1 = document.getElementById('checkbox1');
        var checkbox2 = document.getElementById('checkbox2');
        var checkbox3 = document.getElementById('checkbox3');
        var checkbox4 = document.getElementById('checkbox4');

        checkbox1.addEventListener("change", comprueba, true);
        checkbox2.addEventListener("change", comprueba, true);
        checkbox3.addEventListener("change", comprueba, true);
        checkbox4.addEventListener("change", comprueba, true);

        function comprueba() {
            if (checkbox1.checked) {

                //se llama a "sonido" y reproducimos el sonido de que esta correcto
                Correcto.play();
                Swal.fire({
                    title: '¡Excelente sigue asi! ' + 'Obtuviste ' + 10 + ' puntos teóricos',
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


            } else if (checkbox2.checked) {
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