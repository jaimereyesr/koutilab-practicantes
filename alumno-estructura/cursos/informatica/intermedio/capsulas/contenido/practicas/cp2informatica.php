<?php
session_start();
$id_user = $_SESSION['id_alumno']; $rol = $_SESSION['rol'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno'])) {
    header('location: ../../../../../../../../acciones/cerrarsesion.php');
}
include "../../../../../../../../acciones/conexion.php";
$id_user = $_SESSION['id_alumno']; $rol = $_SESSION['rol'];
$permiso = "capsula5";
$sql = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_preparatoria c INNER JOIN detalle_capsulas_preparatoria d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$permiso' AND d.id_curso = 8");
$existe = mysqli_fetch_all($sql);
if (empty($existe) && $id_user != 1) {
    header("Location: ../../../../intermedio/capsulas/acciones/capsulas.php");
}

//Verificar si ya se tiene permiso y no dar puntos de más
$permiso_intento = 6;
$sql_permisos = mysqli_query($conexion, "SELECT * FROM detalle_capsulas_preparatoria WHERE id_capsula = $permiso_intento AND id_alumno = '$id_user' AND id_curso = 8");
$result_sql_permisos = mysqli_num_rows($sql_permisos);
//Script para poder ver cuantos intentos lleva el alumno en la capsula y mostrar cuantos puntos gano dependiendo los intentos

//Contar total de intentos
$consultaIntentos = mysqli_query($conexion, "SELECT intentos FROM detalle_intentos_preparatoria WHERE id_capsula = $permiso_intento AND id_alumno = $id_user AND id_curso = 8");
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
            <a href="../../../../../../cursos/informatica/intermedio/capsulas/contenido/teoricas/ct2informatica.php"><button style="float: right; width: 100px; height: 40px;" class="btn-b"><b>Volver a teoría</b></button></a>
            <div class="new-g" style="text-align: center;">Cápsula práctica 2 informatica</div><br>
            <div class="board">
                <table width="100%">
                    <thead>
                        <tr>
                            <td>Instrucciones</td>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="nombre">
                                <p> Desarrolla un manual de instrucciones paso a paso sobre cómo conectar un dispositivo a una red Wi-Fi, incluyendo la detección de redes disponibles, la selección de la red correcta y la introducción de la clave de red.
                                    <br>
                                </p>
                            </td>

                        </tr>
                    </tbody>
                </table>

            </div>

            <form class="form" id="btn-abrir-modalFP" enctype="multipart/form-data" method="">
                <a style="text-decoration: none;"><button onclick="//miFunc()" type="button" class="btn-grd" id="update">Evaluar</button></a>
            </form>
        </div>
    </div>
    <script src="../../js/fund.js"></script>
    <script>
        //se esta llamando los sonidos de la carpeta "sonidos"
        /*var Correcto = document.createElement("audio");
        Correcto.src = "../../../../../../../../acciones/sonidos/correcto.mp3";
        var Incorrecto = document.createElement("audio");
        Incorrecto.src = "../../../../../../../../acciones/sonidos/incorrecto.mp3";

        function miFunc() {
            // checar que haya por lo menos 1 bold, italics y mark
            var puntos = <?php echo $puntosGanados; ?>;
            var frame = document.getElementById("editor").contentWindow.document;
            let bolds = frame.querySelectorAll("b").length;
            let italics = frame.querySelectorAll("i").length;
            let marks = frame.querySelectorAll("mark").length;

            if (bolds > 0 && italics > 0 && marks > 0) {
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
                            window.location.href = '../../acciones/insertar_pd6.php?validar=' + 'correcto' + '&permiso=' + 6 + '&id_curso=' + 8 + '&practico=' + 10;
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
                            window.location.href = '../../acciones/insertar_pd6.php?validar=' + 'correcto' + '&permiso=' + 6 + '&id_curso=' + 8 + '&practico=' + 10;
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
                            window.location.href = '../../acciones/insertar_pd6.php?validar=' + 'correcto' + '&permiso=' + 6 + '&id_curso=' + 8 + '&practico=' + 10;
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
                            window.location.href = '../../acciones/insertar_pd6.php?validar=' + 'correcto' + '&permiso=' + 6 + '&id_curso=' + 8 + '&practico=' + 10;
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
                        window.location.href = '../../acciones/insertar_pd6.php?validar=' + 'incorrecto' + '&permiso=' + 6 + '&id_curso=' + 8 + '&practico=' + 10;

                    }
                });
            }
        }*/
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
    <dialog close id="modalFP" style="border: none; border-radius: 10px; margin-top: 80px; margin-left: 370px; background: url(img/bg1.png); text-align: center;">
        <button style="float: right; background-color: rgba(132, 196, 44, 0.6); padding-left: 7px; padding-right: 7px; padding-top: 6px; padding-bottom: 5px; scale: 110%; border-radius: 50%; outline: none; border: 0px; margin: 10px 10px;" id="btn-cerrar-modalFP"><i class="fas fa-close"></i></button><br>
        <div style="color:darkslategray; width: 500px; height: 40px; margin: 10px 30px 10px 30px; box-shadow: 0 0 12px rgba(61,172,244,.6); border-radius: 10px; background: rgba(255,255,255, .8);">
            <h4 style="display: block; width: 100%; font-size: 1.75em; margin-bottom: 0.5rem; text-align: center;">Adjuntar Archivo</h4>
        </div>
        <div class="portada" style="width: 500px; height: 300px; margin: 0px 30px 30px 30px; box-shadow: 0 0 12px rgba(61,172,244,.6); border-radius: 10px; background: rgba(255,255,255, .8); overflow-y: scroll; display: flex; justify-content: space-between;">
            <div class="upload-img">
                <form id="subirArchivo" enctype="multipart/form-data" action="" method="POST">
                    <input type="hidden" name="id_alumno" value="<?php echo $id_user; ?>">
                    <input type="hidden" name="id_curso" value="8">
                    <input type="hidden" name="id_capsula" value="<?php echo $permiso_intento; ?>">
                    <input type="file" name="archivo" id="inputArchivos" style="margin-left: 20%;" required>
                    <button type="submit" style="width: 150px; margin-left: 27px; border: none; background-color: #85c32e; color:white; font-size: 15px;" id="btnEnviar" name="btnEnviar">Subir Archivo</button>
                </form>
                <div id="estado"></div>
            </div>
        </div>
    </dialog>
    <script>
        const btnAbrirModalFP = document.querySelector("#btn-abrir-modalFP");
        const btnCerrarModalFP = document.querySelector("#btn-cerrar-modalFP");
        const modalFP = document.querySelector("#modalFP");
        btnAbrirModalFP.addEventListener("click", () => {
            modalFP.showModal();
        })

        btnCerrarModalFP.addEventListener("click", () => {
            modalFP.close();
        })
    </script>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['archivo'])) {

        $nombreArchivo = $_FILES['archivo']['name'];
        $archivoTemporal = $_FILES['archivo']['tmp_name'];
        $id_alumno = $_POST['id_alumno'];
        $id_curso = $_POST['id_curso'];
        $id_capsula = $_POST['id_capsula'];
        // Leer el contenido del archivo
        $archivoData = file_get_contents($archivoTemporal);

        // Conectar a la base de datos
        include "../../../../../../../../acciones/conexion.php";
        if ($conexion->connect_error) {
            die('Error de conexión: ' . $conexion->connect_error);
        }

        // Preparar la consulta SQL para insertar el archivo en la base de datos
        $consulta = $conexion->prepare('INSERT INTO archivos_preparatoria (nombre_archivo,archivo_data,id_alumno,id_curso,id_capsula) VALUES (?,?,?,?,?)');
        $consulta->bind_param('sssss', $nombreArchivo, $archivoData, $id_alumno, $id_curso, $id_capsula); //Modificado para guardar nombre en BD
        if ($consulta->execute()) {
            echo
            "
      <script>
      Swal.fire({
        title: '¡Excelente!',
        text: '¡Archivo enviado con éxito!',
          imageUrl: '../../../../../../img/Thumbs-Up.gif', imageHeight: 350,
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Aceptar',
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = '../../../../../../rutas/ruta-in-i.php';
          }
        });
      </script>
        ";
        } else {
            echo
            "
      <script>
      Swal.fire({
        title: 'Error subiendo archivo',
        text: 'Inténtalo de nuevo más tarde.',
          imageUrl: '../../../../../../img/Thumbs-Up.gif', imageHeight: 350,
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Reintentar',
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = '../../../../../../rutas/ruta-in-i.php';
          }
        });
      </script>
        ";
        }

        // Cerrar la conexión y liberar recursos
        $consulta->close();
        $conexion->close();
    }
    ?>
</body>