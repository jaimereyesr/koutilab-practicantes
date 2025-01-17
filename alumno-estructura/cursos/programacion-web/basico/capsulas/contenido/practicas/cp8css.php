<?php
session_start();
$id_user = $_SESSION['id_alumno']; $rol = $_SESSION['rol'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno'])) {
    header('location: ../../../../../../../acciones/cerrarsesion.php');
}
include "../../../../../../../acciones/conexion.php";

if (isset($_GET['htmlcode'])) {
    $htmlcode = $_GET['htmlcode'];
} else {
    $htmlcode = "";
}
$id_user = $_SESSION['id_alumno']; $rol = $_SESSION['rol'];
$permiso = "capsulapago3";
$sql = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_pago_$rol c INNER JOIN detalle_capsulas_pago_$rol d ON c.id_capsula_pago = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$permiso' AND d.id_curso = 1;");
$existe = mysqli_fetch_all($sql);
if (empty($existe)) {
    header("Location: ../../../../basico/capsulas/contenido/alertas/paquete_premium3.php");
}
//Verificar si ya se tiene permiso y no dar puntos de más
//VERIFICAR QUE PERMISO INTENTO SEA EL CORRECTO
$permiso_intento = 24;
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
            <a href="../../../../../../cursos/programacion-web/basico/capsulas/contenido/teoricas/ct8css.php"><button style="float: right; width: 100px; height: 40px;" class="btn-b"><b>Volver a teoría</b></button></a>
            <div class="new-g" style="text-align: center;">Cápsula práctica 8 CSS</div><br>
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
                                <p>En un documento HTML realizar el siguiente box model con las siguientes medidas margin: 30px 60px 45px 85px;
                                    Al usar 4 valores:
                                    <br>
                                    El primer valor es para arriba.
                                    <br>
                                    El segundo valor es para la derecha.
                                    <br>
                                    El tercer valor es para la parte inferior.
                                    <br>
                                    El cuarto valor es para la izquierda.
                                    <br>
                                    Para recordar el orden, comience en la parte superior y siga en el sentido de las agujas del reloj. < div>
                                        <br> <br>
                                </p>
                            </td>
                            <td class="ne">
                            &lt;style> <br>
                                &nbsp;&nbsp;&nbsp;&nbsp; div { <br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;background-color: orange;<br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;margin: 30px 60px 45px 85px; <br>
                                &nbsp;&nbsp;&nbsp;&nbsp;} <br>
                                &lt;/style> <br> <br>

                                &lt;div> Hola mundo &lt;/div> <br>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
            <div class="editor-container">
                <h3>EDITOR DE CÓDIGO</h3>
                <textarea onkeyup="actualizar() " id="cd" class="cd" placeholder="Escribe el código aquí"><?php echo $htmlcode; ?></textarea>
                <iframe class="editor" id="editor" srcdoc=" "></iframe>
            </div>
            <a style="text-decoration: none;"><button onclick="miFunc()" type="submit" class="btn-grd" id="update" disabled>Evaluar</button></a>

        </div>
    </div>
    <script>
        //se esta llamando los sonidos de la carpeta "sonidos"
        var Correcto = document.createElement("audio");
        Correcto.src = "../../../../../../../acciones/sonidos/correcto.mp3";
        var Incorrecto = document.createElement("audio");
        Incorrecto.src = "../../../../../../../../acciones/sonidos/incorrecto.mp3";

        function miFunc() {
            // checar que haya por lo menos 1 bold, italics y mark
            var frame = document.getElementById("editor").contentWindow.document;
            let divs = frame.querySelectorAll("div").length;

            if (divs > 0) {
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
                            window.location.href = '../../acciones/insertar_cp8.php?validar=' + 'correcto' + '&permiso=' + 8 + '&id_curso=' + 1 + '&practico=' + 10;
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
                            window.location.href = '../../acciones/insertar_cp8.php?validar=' + 'correcto' + '&permiso=' + 8 + '&id_curso=' + 1 + '&practico=' + 10;
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
                        window.location.href = '../../acciones/insertar_cp8.php?validar=' + 'correcto' + '&permiso=' + 8 + '&id_curso=' + 1 + '&practico=' + 10;

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
                            window.location.href = '../../acciones/insertar_cp8.php?validar=' + 'correcto' + '&permiso=' + 8 + '&id_curso=' + 1 + '&practico=' + 10;
                        }
                    });
                }
            } else {
                //se llama a "sonido" y reproducimos el sonido de que esta correcto
                Incorrecto.play();

                Swal.fire({
                    title: 'Oops...',
                    text: '¡Verifica tu respuesta!',
                    imageUrl: "../../../../../../img/signo.gif",
                    imageHeight: 350,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '../../acciones/insertar_cp8.php?validar=' + 'incorrecto' + '&permiso=' + 8 + '&id_curso=' + 1 + '&practico=' + 10 + '&htmlcode=' + document.getElementById("cd").value;

                    }
                });
            }
        }
    </script>
    <script src="../../js/fund.js"></script>
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