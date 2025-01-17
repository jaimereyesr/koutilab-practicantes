<?php
session_start();
$id_user = $_SESSION['id_alumno'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno'])) {
    header('location: ../../acciones/cerrarsesion.php');
}
include "../../acciones/conexion.php";
$id_user = $_SESSION['id_alumno'];
$permiso = "7";
$sql = mysqli_query($conexion, "SELECT a.* FROM acceso_cursos_$rol a WHERE a.id_alumno = $id_user AND a.id_curso = '$permiso'");
$existe = mysqli_fetch_all($sql);
if (empty($existe)) {
    header("Location: ../cursos/arduino/basico/capsulas/acciones/acceso_cursos.php");
}

// Función para actualizar conexiones a ruta
function actualizarConexiones($permiso, $conexion, $rol)
{
    // Consulta para obtener el número de conexiones
    $sql = "SELECT conexiones FROM conexiones_curso_$rol WHERE id_curso = $permiso";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $total_conexiones = $row['conexiones'];

        if ($total_conexiones >= 0) {
            $id_escuela = $_SESSION['id_escuela'];
            $sql_curso =  mysqli_query($conexion, "INSERT INTO conexiones_cursos(id_curso, id_escuela) values ($permiso, $id_escuela)");
            // Si no es múltiplo de 20, actualizar el campo estrellas en la tabla total_estrellas_$rol
            $sql =  mysqli_query($conexion, "UPDATE conexiones_curso_$rol SET conexiones = conexiones + 1 WHERE id_curso = $permiso");
        }
    }
}

// Verifica si la variable de sesión "actualizacion_realizada" no está definida
if (!isset($_SESSION['actualizacion_realizada_arb'])) {
    // Llama a la función para actualizar las conexiones
    actualizarConexiones($permiso, $conexion, $rol);

    // Establece la variable de sesión "actualizacion_realizada" para indicar que la actualización ya se hizo
    $_SESSION['actualizacion_realizada_arb'] = true;
}

?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KOUTILAB</title>
    <link rel="shortcut icon" href="../img/lgk.png">
    <link rel="stylesheet" href="../css/ruta-ardu-b.css">
    <script src="https://kit.fontawesome.com/53845e078c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <audio id="popAudio" preload="auto">
        <source src="../../acciones/sonidos/pop.mp3" type="audio/mpeg">
    </audio>
    <audio id="hoverAudio" preload="auto">
        <source src="../../acciones/sonidos/pop2.mp3" type="audio/mpeg">
    </audio>
    <div class="body">
        <div class="containers">CURSO DE ARDUINO BÁSICO DE KOUTILAB
            <a href="../perfil.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" style="float: right;" class="btn-b" id="btn-cerrar-modalV"><i class="fas fa-reply"></i></button></a>
        </div>
        <div class="container">
            <img class="igm" src="../img/PPP.png">
            <img class="gif" src="../img/loop.gif">
            <img class="gif1" src="../img/foco.gif">
            <div class="ruta">
                <a href="../cursos/arduino/basico/capsulas/contenido/introduccion/ci1.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn1"></button></a>
                <a href="../cursos/arduino/basico/capsulas/contenido/teoricas/ct1.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn2"></button></a>
                <a href="../cursos/arduino/basico/capsulas/contenido/juegos/cj6.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn3"></button></a>
                <a href="../cursos/arduino/basico/capsulas/contenido/practicas/cp1.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn4"></button></a>
                <a href="../cursos/arduino/basico/capsulas/contenido/teoricas/ct2.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn5"></button></a>
                <a href="../cursos/arduino/basico/capsulas/contenido/juegos/cj6.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn6"></button></a>
                <a href="../cursos/arduino/basico/capsulas/contenido/teoricas/ct3.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn7"></button></a>
                <a href="../cursos/arduino/basico/capsulas/contenido/juegos/cj6.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn8"></button></a>
                <a href="../cursos/arduino/basico/capsulas/contenido/practicas/cp2.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn9"></button></a>
                <a href="../cursos/arduino/basico/capsulas/contenido/juegos/cj6.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn10"></button></a>
                <a href="../cursos/arduino/basico/capsulas/contenido/evaluativas/ce1.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn11"></button></a>
                <a href="../cursos/arduino/basico/capsulas/contenido/introduccion/ci2.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn12"></button></a>
                <a href="../cursos/arduino/basico/capsulas/contenido/juegos/cj6.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn13"></button></a>
                <a href="../cursos/arduino/basico/capsulas/contenido/practicas/cp3.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn14"></button></a>
                <a href="../cursos/arduino/basico/capsulas/contenido/juegos/cj6.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn15"></button></a>
                <a href="../cursos/arduino/basico/capsulas/contenido/evaluativas/ce2.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn16"></button></a>
                <a href="../cursos/arduino/basico/capsulas/contenido/introduccion/ci3.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn17"></button></a>
                <a href="../cursos/arduino/basico/capsulas/contenido/practicas/cp4.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn18"></button></a>
                <a href="../cursos/arduino/basico/capsulas/contenido/evaluativas/ce3.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn19"></button></a>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script>

    </script>
    <script>
        $(".step").click(function() {
            $(this).addClass("active").prevAll().addClass("active");
            $(this).nextAll().removeClass("active");
        });

        $(".step01").click(function() {
            $("#line-progress").css("width", "3%");
            $(".discovery").addClass("active").siblings().removeClass("active");
        });

        $(".step02").click(function() {
            $("#line-progress").css("width", "25%");
            $(".strategy").addClass("active").siblings().removeClass("active");
        });

        $(".step03").click(function() {
            $("#line-progress").css("width", "50%");
            $(".creative").addClass("active").siblings().removeClass("active");
        });

        $(".step04").click(function() {
            $("#line-progress").css("width", "75%");
            $(".production").addClass("active").siblings().removeClass("active");
        });

        $(".step05").click(function() {
            $("#line-progress").css("width", "100%");
            $(".analysis").addClass("active").siblings().removeClass("active");
        });
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
    <script>
        // Funciones para reproducir sonidos
        function playHoverSound() {
            var popAudio = document.getElementById("popAudio");
            popAudio.currentTime = 0; // Reiniciar el sonido si ya se está reproduciendo
            var hoverAudio = document.getElementById("hoverAudio");
            hoverAudio.currentTime = 0; // Reiniciar el sonido si ya se está reproduciendo
            hoverAudio.play();
        }

        function playClickSound() {
            var hoverAudio = document.getElementById("hoverAudio");
            hoverAudio.currentTime = 0; // Reiniciar el sonido si ya se está reproduciendo
            var popAudio = document.getElementById("popAudio");
            popAudio.currentTime = 0; // Reiniciar el sonido si ya se está reproduciendo
            popAudio.play();
        }
    </script>
</body>