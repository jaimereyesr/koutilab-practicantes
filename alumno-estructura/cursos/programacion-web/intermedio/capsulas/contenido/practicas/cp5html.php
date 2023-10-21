<?php
session_start();
$id_user = $_SESSION['id_alumno']; $rol = $_SESSION['rol'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno'])) {
    header('location: ../../../../../../../../acciones/cerrarsesion.php');
}
include "../../../../../../../../acciones/conexion.php";

//codigo de la cp4


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


$id_user = $_SESSION['id_alumno']; $rol = $_SESSION['rol'];
$permiso = "capsulapago2";
$sql = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_pago_$rol c INNER JOIN detalle_capsulas_pago_$rol d ON c.id_capsula_pago = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$permiso' AND d.id_curso = 2;");
$existe = mysqli_fetch_all($sql);
if (empty($existe)) {
    header("Location: ../../../../intermedio/capsulas/contenido/alertas/paquete_premium2.php");
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
            <a href="../../../../../../cursos/programacion-web/intermedio/capsulas/contenido/teoricas/ct5html.php"><button style="float: right; width: 100px; height: 40px;" class="btn-b"><b>Volver a teoría</b></button></a>
            <div class="new-g" style="text-align: center;">Cápsula práctica 3.5 HTML</div><br>
            <div class="board">
                <table width="100%">
                    <thead>
                        <tr>
                            <td>Instrucciones</td>
                            <td>Ejemplo de resultado</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="nombre">
                                <p> Crea una tabla como la del ejemplo.
                                    <br><br>
                                </p>
                            </td>
                            <td class="ne">
                                <img src="../../../../../../img/tablaencapractica.png" style="height: 100px; width: 200px;">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="editor-container">
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

            <a style="text-decoration: none;"><button onclick="miFunc()" type="submit" class="btn-grd" id="update" disabled>Evaluar</button></a>
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
            var frame = document.getElementById("output").contentWindow.document;
            //Validando etiquetas utilizadas
            let table = frame.querySelectorAll("table").length;
            console.log("table: " + table);
            let tr = frame.querySelectorAll("tr").length;
            console.log("tr: " + tr);
            let th = frame.querySelectorAll("th").length;
            console.log("th: " + th);
            let td = frame.querySelectorAll("td").length;
            console.log("td: " + td);

            let htmlcode = document.getElementById("html-code").value;
            let csscode = document.getElementById("css-code").value;
            let jscode = document.getElementById("js-code").value;

            if (htmlcode.indexOf('border') !== -1) {
                console.log("Si aparece border");
            } else {
                console.log("No hay border");
            }

            if (table == 1 && tr == 3 && th == 3 && td == 6 && htmlcode.indexOf('border') !== -1) {
                //se llama a "sonido" y reproducimos el sonido de que esta correcto
                Correcto.play();

                Swal.fire({
                    title: '¡Excelente sigue asi! ' + 'Obtuviste ' + 10 + ' puntos prácticos',
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
                        window.location.href = '../../acciones/insertar_cp9.php?validar=' + 'correcto' + '&permiso=' + 7 + '&id_curso=' + 2 + '&practico=' + 10;
                    }
                });

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
                        window.location.href = '../../acciones/insertar_cp9.php?validar=' + 'incorrecto' + '&permiso=' + 7 + '&id_curso=' + 2 + '&practico=' + 0 + '&htmlcode=' + encodeHTML + '&csscode=' + encodeCSS + '&jscode=' + encodeJS;

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
        //Función para contar las veces que aparece una cadena dentro de otra
        function contOcurrencias(cadena, subcadena) {
            let apariciones = 0;
            let i = 0;

            while ((i = cadena.indexOf(subcadena, i)) !== -1) {
                apariciones++;

                i += subcadena.length;
            }
            return apariciones;
        }

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