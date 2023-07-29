<?php
session_start();
$id_user = $_SESSION['id_alumno_universidad'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno_universidad'])) {
    header('location: ../../../../../../../../acciones/cerrarsesion.php');
}
include "../../../../../../../../acciones/conexion.php";
$id_user = $_SESSION['id_alumno_universidad'];
$permiso = "capsula21";
if (isset($_GET['htmlcode'])) {
    $htmlcode = $_GET['htmlcode'];
    $htmlcode = str_replace("sdl", "%0A", $htmlcode);
    $htmlcode = urldecode($htmlcode);
} else {
    $htmlcode = "";
}
if (isset($_GET['csscode'])) {
    $csscode = $_GET['csscode'];
    $csscode = str_replace("sdl", "%0A", $csscode);
    $csscode = urldecode($csscode);
} else {
    $csscode = "";
}
if (isset($_GET['htmlcode'])) {
    $jscode = $_GET['jscode'];
    $jscode = str_replace("sdl", "%0A", $jscode);
    $jscode = urldecode($jscode);
} else {
    $jscode = "";
}

$sql = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_universidad c INNER JOIN detalle_capsulas_universidad d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$permiso' AND d.id_curso = 3");
$existe = mysqli_fetch_all($sql);
if (empty($existe) && $id_user != 1) {
    header("Location: ../../../../avanzado/capsulas/acciones/capsulas.php");
}

//Verificar si ya se tiene permiso y no dar puntos de más
$permiso_intento = 22;
$sql_permisos = mysqli_query($conexion, "SELECT * FROM detalle_capsulas_universidad  WHERE id_capsula = $permiso_intento AND id_alumno = '$id_user' AND id_curso = 3");
$result_sql_permisos = mysqli_num_rows($sql_permisos);
//Script para poder ver cuantos intentos lleva el alumno en la capsula y mostrar cuantos puntos gano dependiendo los intentos

//Contar total de intentos
$consultaIntentos = mysqli_query($conexion, "SELECT intentos FROM detalle_intentos_universidad WHERE id_capsula = $permiso_intento AND id_alumno = $id_user AND id_curso = 3");
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KOUTILAB</title>
    <link rel="shortcut icon" href="../../../../../../img/lgk.png">
    <link rel="stylesheet" href="../../css/capsula-practica.css">
    <script src="https://kit.fontawesome.com/53845e078c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <div class="body">
        <div class="container">
            <a href="#" onclick="history.back(); return false;"><button style="float: left;" class="btn-b" id="btn-cerrar-modalV"><i class="fas fa-reply"></i></button></a>
            <a href="../../../../../../cursos/programacion-web/avanzado/capsulas/contenido/teoricas/ct4css.php"><button style="float: right; width: 100px; height: 40px;" class="btn-b"><b>Volver a teoría</b></button></a>
            <div class="new-g" style="text-align: center;">Cápsula práctica 4 CSS</div><br>
            <div class="board">
                <table width="100%">
                    <thead>
                        <tr>
                            <td>Instrucciones</td>
                            <td>Ejemplo del Resultado</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="nombre">
                                <p> Crea la siguiente tabla y agrégale css.
                                </p>
                            </td>
                            <td class="ne">
                                <img src="../../../../../../img/tablas.png" style="height: 250px; width: 450px;">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="">
                <h3 style="margin-bottom: 20px;">EDITOR DE CÓDIGO</h3>
                <!--
                <textarea onkeyup="actualizar()" class="cd" id="cd" placeholder="Escribe el código aquí"></textarea>
                <iframe class="editor" id="editor" srcdoc=" "></iframe> -->
                <!-- <button type="button" class="btn-grd" onclick="copyToClipBoard()" style="width: 5%; padding: 5px; margin: -30px 60px -20px 1050px; scale: 80%;"><i class="fas fa-paste fa-2x"></i></button> -->

                <div class="editor1">
                    <div class="titulo-edit1">
                        <h6>HTML</h6>
                    </div>
                    <div class="titulo-edit2">
                        <h6>CSS</h6>
                    </div>
                    <div class="titulo-edit3">
                        <h6>JAVASCRIPT</h6>
                    </div>
                    <div class="titulo-edit4">
                        <h6>SALIDA</h6>
                    </div>
                    <textarea onkeyup="actualizar() " id="html-code" class="cd" placeholder="Escribe el código HTML aquí"><?php echo $htmlcode; ?></textarea>
                    <textarea onkeyup="actualizar()" id="css-code" class="cd1" placeholder="Escribe el código CSS aquí"><?php echo $csscode; ?></textarea>
                    <textarea onkeyup="actualizar()" id="js-code" class="cd2" placeholder="Escribe el código JavaScript aquí"><?php echo $jscode; ?></textarea> <br>
                    <iframe id="output" class="editor" style="margin-top: 20px;"></iframe>
                </div>

            </div>
            <a style="text-decoration: none;"><button onclick="miFunc()" type="submit" class="btn-grd" id="update"  disabled>Evaluar</button></a>
        </div>
    </div>
    <script src="../../js/editor.js"></script>
    <script type="text/javascript">
        function run() {
            let htmlCode = document.querySelector(".editor1 #html-code").value;
            let cssCode = "<style>" + document.querySelector(".editor1 #css-code").value + "</style>";
            let jsCode = document.querySelector(".editor1 #js-code").value;
            let output = document.querySelector(".editor1 #output");

            output.contentDocument.body.innerHTML = htmlCode + cssCode;
            output.contentWindow.eval(jsCode);
        }
        document.querySelector(".editor1 #html-code").addEventListener("keyup", run);
        document.querySelector(".editor1 #css-code").addEventListener("keyup", run);
        document.querySelector(".editor1 #js-code").addEventListener("keyup", run);
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.5.3/ace.js"></script>
    <script>
        //se esta llamando los sonidos de la carpeta "sonidos"
        var Correcto = document.createElement("audio");
        Correcto.src = "../../../../../../../../acciones/sonidos/correcto.mp3";
        var Incorrecto = document.createElement("audio");
        Incorrecto.src = "../../../../../../../../acciones/sonidos/incorrecto.mp3";

        function miFunc() {
            var puntos = <?php echo $puntosGanados; ?>;
            var frame = document.getElementById("output").contentWindow.document;

            let htmlcode = document.getElementById("html-code").value;
            let csscode = document.getElementById("css-code").value;
            let jscode = document.getElementById("js-code").value;

            //Validando etiquetas utilizadas
            let table = frame.querySelectorAll("table ").length;
            console.log("table : " + table);

            let thead = frame.querySelectorAll("thead").length;
            console.log("thead: " + thead);

            let tr = frame.querySelectorAll("tr").length;
            console.log("tr: " + tr);

            let th = frame.querySelectorAll("th").length;
            console.log("th: " + th);

            let tbody = frame.querySelectorAll("tbody").length;
            console.log("tbody: " + tbody);

            if (csscode.indexOf('background-color') !== -1) {
                console.log("Si aparece background-color en CSS");
            } else {
                console.log("No hay background-color en CSS");
            }

            if (csscode.indexOf('color') !== -1) {
                console.log("Si aparece color en CSS");
            } else {
                console.log("No hay color en CSS");
            }

            if (csscode.indexOf('border') !== -1) {
                console.log("Si aparece border en CSS");
            } else {
                console.log("No hay border en CSS");
            }

            if (table > 0 && thead > 0 && tr > 0 && th > 0 && tbody > 0 && csscode.indexOf('background-color') != -1 && csscode.indexOf('color') != -1 && csscode.indexOf('border') != -1) {

                //se llama a "sonido" y reproducimos el sonido de que esta correcto
                Correcto.play();

                //UNA SERIE DE CONDICIONALES ANIDADAS LAS CUALES VALIDAN NUESTROS 4 POSIBLES RESULTADOS Y MANDA LA ALERTA CORRESPONDIENTE
                if (puntos == 0) {
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
                            window.location.href = '../../acciones/insertar_pd22.php?validar=' + 'correcto' + '&permiso=' + 22 + '&id_curso=' + 3 + '&practico=' + 10;
                        }
                    });
                } else if (puntos == 6) {
                    Swal.fire({
                        title: '¡Bien hecho! ' + 'Obtuviste ' + puntos + ' puntos prácticos',
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
                            window.location.href = '../../acciones/insertar_pd22.php?validar=' + 'correcto' + '&permiso=' + 22 + '&id_curso=' + 3 + '&practico=' + 10;
                        }
                    });
                } else if (puntos == 8) {
                    Swal.fire({
                        title: '¡Bien hecho! ' + 'Obtuviste ' + puntos + ' puntos prácticos',
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
                            window.location.href = '../../acciones/insertar_pd22.php?validar=' + 'correcto' + '&permiso=' + 22 + '&id_curso=' + 2 + '&practico=' + 10;

                        }
                    });
                } else if (puntos == 10) {
                    Swal.fire({
                        title: '¡Excelente sigue asi! ' + 'Obtuviste ' + puntos + ' puntos prácticos',
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
                            window.location.href = '../../acciones/insertar_pd22.php?validar=' + 'correcto' + '&permiso=' + 22 + '&id_curso=' + 3 + '&practico=' + 10;
                        }
                    });
                }
            } else {
                //se llama a "sonido" y reproducimos el sonido de que esta correcto
                Incorrecto.play();
                var myCodeHTML = document.getElementById("html-code").value;
                var encodeHTML = encodeURI(myCodeHTML);
                var myCodeCSS = document.getElementById("css-code").value;
                var encodeCSS = encodeURI(myCodeCSS);
                var myCodeJS = document.getElementById("js-code").value;
                var encodeJS = encodeURI(myCodeJS);

                Swal.fire({
                    title: 'Oops...',
                    text: '¡Verifica tu respuesta!',
                    imageUrl: "../../../../../../img/signo.gif",
                    imageHeight: 350,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '../../acciones/insertar_pd22.php?validar=' + 'incorrecto' + '&permiso=' + 22 + '&id_curso=' + 3 + '&practico=' + 10 + '&htmlcode=' + encodeHTML + '&csscode=' + encodeCSS + '&jscode=' + encodeJS;

                    }
                });
            }
        }
    </script>
    <script>
        function copyToClipBoard() {
            var content = document.getElementById('editor');
            content.select();
            document.execCommand('copy');
        }
    </script>
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
</body>