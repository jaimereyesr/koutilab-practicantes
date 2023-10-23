<?php
session_start();
$id_user = $_SESSION['id_alumno'];
$rol = $_SESSION['rol'];
$id_escuela = $_SESSION['id_escuela'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno'])) {
    header('location: ../../acciones/cerrarsesion.php');
}
include "../../acciones/conexion.php";
$id_user = $_SESSION['id_alumno'];
$permiso = "9";
$sql = mysqli_query($conexion, "SELECT a.* FROM acceso_cursos_$rol a WHERE a.id_alumno = $id_user AND a.id_curso = '$permiso'");
$existe = mysqli_fetch_all($sql);
if (empty($existe)) {
    header("Location: ../cursos/informatica/avanzado/capsulas/acciones/acceso_cursos.php");
}

include "verificar-ruta-in-a-secundaria.php";

//Verificar si capsula esta completada para mostrar la opcion de compra de capsula 1 de html
$capsula_verificar_html1 = "capsula13";
$sql_verificar_html1 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_$rol c INNER JOIN detalle_capsulas_$rol d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula_verificar_html1' AND d.id_curso = 9");
$existe_verificar_html1 = mysqli_num_rows($sql_verificar_html1);

//Verificar si esta comprada la capsula 1 de html
$capsula_comprada_html1 = "capsulapago1";
$sql_comprada_html1 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_pago_$rol c INNER JOIN detalle_capsulas_pago_$rol d ON c.id_capsula_pago = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula_comprada_html1' AND d.id_curso = 9;");
$existe_comprada_html1 = mysqli_num_rows($sql_comprada_html1);

//Verificar si capsula esta completada para mostrar la opcion de compra de capsula 2 de html
$capsula_verificar_html2 = "capsula16";
$sql_verificar_html2 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_$rol c INNER JOIN detalle_capsulas_$rol d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula_verificar_html2' AND d.id_curso = 9");
$existe_verificar_html2 = mysqli_num_rows($sql_verificar_html2);

//Verificar si esta comprada la capsula 2 de html
$capsula_comprada_html2 = "capsulapago2";
$sql_comprada_html2 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_pago_$rol c INNER JOIN detalle_capsulas_pago_$rol d ON c.id_capsula_pago = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula_comprada_html2' AND d.id_curso = 9;");
$existe_comprada_html2 = mysqli_num_rows($sql_comprada_html2);

//Verificar si capsula esta completada para mostrar la opcion de compra de capsula 1 de css
$capsula_verificar_css1 = "capsula47";
$sql_verificar_css1 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_$rol c INNER JOIN detalle_capsulas_$rol d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula_verificar_css1' AND d.id_curso = 9");
$existe_verificar_css1 = mysqli_num_rows($sql_verificar_css1);

//Verificar si esta comprada la capsula 1 de css
$capsula_comprada_css1 = "capsulapago3";
$sql_comprada_css1 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_pago_$rol c INNER JOIN detalle_capsulas_pago_$rol d ON c.id_capsula_pago = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula_comprada_css1' AND d.id_curso = 9;");
$existe_comprada_css1 = mysqli_num_rows($sql_comprada_css1);

//Verificar si capsula esta completada para mostrar la opcion de compra de capsula 2 de css
$capsula_verificar_css2 = "capsula47";
$sql_verificar_css2 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_$rol c INNER JOIN detalle_capsulas_$rol d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula_verificar_css2' AND d.id_curso = 9");
$existe_verificar_css2 = mysqli_num_rows($sql_verificar_css2);

//Verificar si esta comprada la capsula 2 de css
$capsula_comprada_css2 = "capsulapago4";
$sql_comprada_css2 = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_pago_$rol c INNER JOIN detalle_capsulas_pago_$rol d ON c.id_capsula_pago = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$capsula_comprada_css2' AND d.id_curso = 9;");
$existe_comprada_css2 = mysqli_num_rows($sql_comprada_css2);

//Verificar si es escuela licencia o freemium
$sql_modelo = "SELECT tipo_modelo FROM escuelas WHERE id_escuela = $id_escuela";
$result_modelo = $conexion->query($sql_modelo);
$row_modelo = $result_modelo->fetch_assoc();
$tipo_modelo = $row_modelo['tipo_modelo'];

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
if (!isset($_SESSION['actualizacion_realizada_ina'])) {
    // Llama a la función para actualizar las conexiones
    actualizarConexiones($permiso, $conexion, $rol);

    // Establece la variable de sesión "actualizacion_realizada" para indicar que la actualización ya se hizo
    $_SESSION['actualizacion_realizada_ina'] = true;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KOUTILAB</title>
    <link rel="shortcut icon" href="../img/lgk.png">
    <link rel="stylesheet" href="../css_secundaria/ruta-in-a.css">

    <script src="https://kit.fontawesome.com/53845e078c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        #intro {
            background-image: url(../img/btn/BTNINTRO2.png);
        }

        #teoria {
            background-image: url(../img/btn/BTNTEO2.png);
        }

        #prac {
            background-image: url(../img/btn/BTNPRA2.png);
        }

        #game {
            background-image: url(../img/btn/BTNJU2.png);
        }

        #eva {
            background-image: url(../img/btn/BTNEV2.png);
        }
    </style>
</head>

<body>
    <audio id="popAudio" preload="auto">
        <source src="../../acciones/sonidos/pop.mp3" type="audio/mpeg">
    </audio>
    <audio id="hoverAudio" preload="auto">
        <source src="../../acciones/sonidos/pop2.mp3" type="audio/mpeg">
    </audio>
    <div class="containers">
        <a href="../perfil.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn-b"><i class="fas fa-reply"></i></button></a>
        <h1>CURSO DE INFORMATICA AVANZADO DE KOUTILAB</h1>
    </div>
    <aside class="sidebar">
        <div class="circle" style="background-image:url(../img/btn/BTNINTRO2.png); background-size:cover;background-position:center ">
            <p>Introducción</p>
        </div>
        <div class="circle" style="background-image:url(../img/btn/BTNPRA2.png); background-size:cover;background-position:center ">
            <p>Práctica</p>
        </div>
        <div class="circle" style="background-image:url(../img/btn/BTNTEO2.png); background-size:cover;background-position:center ">
            <p>Teórica</p>
        </div>
        <div class="circle" style="background-image:url(../img/btn/BTNJU2.png); background-size:cover;background-position:center ">
            <p>Juegos</p>
        </div>
        <div class="circle" style="background-image:url(../img/btn/BTNEV2.png); background-size:cover;background-position:center ">
            <p>Evaluativa</p>
        </div>
    </aside>

    <section>
        <div class="main-content">
            <div class="label">
                <span></span>
            </div>
            <a href="../acciones/estadisticas_in-a.php" style="text-decoration: none;color: inherit;">
                <div class="graphics-buttoon"><i class="fa-solid fa-chart-line fa-2xl"></i></div>
            </a>
            <div class="snake">
                <!-- informatica -->
                <a href="../cursos/informatica/avanzado/capsulas/contenido/introduccion/ci1html.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn1" id="intro"></button></a><!--Capsula introduccion a informatica-->
                <!-- TEMA 1 -->
                <a href="../cursos/informatica/avanzado/capsulas/contenido/teoricas/ct1informatica.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn2" id="teoria" <?php echo 'style="' . (($existe_capsula1 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 1-->
                <a href="../cursos/informatica/avanzado/capsulas/contenido/practicas/cp1informatica.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn3" id="prac" <?php echo 'style="' . (($existe_capsula2 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 1-->
                <a href="../cursos/informatica/avanzado/capsulas/contenido/juegos/cjia1-1.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn4" id="game" <?php echo 'style="' . (($existe_capsula3 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 1-->
                <!-- TEMA 2 -->
                <a href="../cursos/informatica/avanzado/capsulas/contenido/teoricas/ct2informatica.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn5" id="teoria" <?php echo 'style="' . (($existe_capsula4 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 2-->
                <a href="../cursos/informatica/avanzado/capsulas/contenido/practicas/cp2informatica.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn6" id="prac" <?php echo 'style="' . (($existe_capsula5 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 2-->
                <a href="../cursos/informatica/avanzado/capsulas/contenido/juegos/cjia1-2.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn7" id="game" <?php echo 'style="' . (($existe_capsula6 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 2-->
                <!-- TEMA 3 -->
                <a href="../cursos/informatica/avanzado/capsulas/contenido/teoricas/ct3informatica.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn8" id="teoria" <?php echo 'style="' . (($existe_capsula7 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>" <?php echo 'style="' . (($existe_capsula1 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 3-->
                <a href="../cursos/informatica/avanzado/capsulas/contenido/practicas/cp3informatica.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn9" id="prac" <?php echo 'style="' . (($existe_capsula8 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 3-->
                <a href="../cursos/informatica/avanzado/capsulas/contenido/juegos/cjia1-3.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn10" id="game" <?php echo 'style="' . (($existe_capsula9 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 3-->
                <!-- TEMA 4 -->
                <a href="../cursos/informatica/avanzado/capsulas/contenido/teoricas/ct4informatica.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn11" id="teoria" <?php echo 'style="' . (($existe_capsula10 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 4-->
                <a href="../cursos/informatica/avanzado/capsulas/contenido/practicas/cp4informatica.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn12" id="prac" <?php echo 'style="' . (($existe_capsula11 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 4-->
                <a href="../cursos/informatica/avanzado/capsulas/contenido/juegos/cjia1-4.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn13" id="game" <?php echo 'style="' . (($existe_capsula12 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 4-->
                <!-- TEMA 5 -->
                <a href="../cursos/informatica/avanzado/capsulas/contenido/teoricas/ct5informatica.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn14" id="teoria" <?php echo 'style="' . (($existe_capsula13 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 5-->
                <a href="../cursos/informatica/avanzado/capsulas/contenido/practicas/cp6informatica.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn15" id="prac" <?php echo 'style="' . (($existe_capsula14 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 5-->
                <a href="../cursos/informatica/avanzado/capsulas/contenido/juegos/cjia1-5.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn16" id="game" <?php echo 'style="' . (($existe_capsula15 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>>></button></a><!--Capsula juego 5-->
                <!-- TEMA 6 -->
                <a href="../cursos/informatica/avanzado/capsulas/contenido/teoricas/ct6informatica.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn17" id="teoria" <?php echo 'style="' . (($existe_capsula16 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 6-->
                <a href="../cursos/informatica/avanzado/capsulas/contenido/practicas/cp8informatica.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn18" id="prac" <?php echo 'style="' . (($existe_capsula17 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 6-->
                <a href="../cursos/informatica/avanzado/capsulas/contenido/juegos/cjia1-6.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn19" id="game" <?php echo 'style="' . (($existe_capsula18 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 6-->
                <!-- TEMA 7 -->
                <a href="../cursos/informatica/avanzado/capsulas/contenido/teoricas/ct7informatica.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn20" id="teoria" <?php echo 'style="' . (($existe_capsula19 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 7-->
                <a href="../cursos/informatica/avanzado/capsulas/contenido/practicas/cp9informatica.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn21" id="prac" <?php echo 'style="' . (($existe_capsula20 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 7-->
                <a href="../cursos/informatica/avanzado/capsulas/contenido/juegos/cjia1-7.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn22" id="game" <?php echo 'style="' . (($existe_capsula21 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 7-->
                <!-- TEMA 8 -->
                <a href="../cursos/informatica/avanzado/capsulas/contenido/teoricas/ct10informatica.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn23" id="teoria" <?php echo 'style="' . (($existe_capsula22 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 8-->
                <a href="../cursos/informatica/avanzado/capsulas/contenido/practicas/cp10informatica.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn24" id="prac" <?php echo 'style="' . (($existe_capsula23 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 8-->
                <a href="../cursos/informatica/avanzado/capsulas/contenido/juegos/cjia1-8.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn25" id="game" <?php echo 'style="' . (($existe_capsula24 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 8-->
                <!-- TEMA 9 -->
                <div class="container-premium1" <?php echo 'style="' . (($tipo_modelo == 1) ? 'display: none;' : 'display: block;') . '"'; ?>> -->
                    <a href="../cursos/informatica/avanzado/capsulas/contenido/teoricas/ct5informatica.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn26" id="teoriap" <?php echo 'style="' . (($existe_verificar_html1 > 0 || $id_user == 1) ? 'display: block;' : 'display: none;') . ' ' . (($existe_comprada_html1 > 0) ? 'opacity: 1;' : 'opacity: 0.5;') . '"'; ?>></button></a> <!-- Capsula teorica 9 -->
                    <a href="../cursos/informatica/avanzado/capsulas/contenido/practicas/cp5informatica.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn27" id="pracp" <?php echo 'style="' . (($existe_verificar_html1 > 0 || $id_user == 1) ? 'display: block;' : 'display: none;') . ' ' . (($existe_comprada_html1 > 0) ? 'opacity: 1;' : 'opacity: 0.5;') . '"'; ?>></button></a> <!-- Capsula practica 9 -->
                    <a href="../cursos/informatica/avanzado/capsulas/contenido/juegos/cjip1.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn28" id="gamep" <?php echo 'style="' . (($existe_verificar_html1 > 0 || $id_user == 1) ? 'display: block;' : 'display: none;') . ' ' . (($existe_comprada_html1 > 0) ? 'opacity: 1;' : 'opacity: 0.5;') . '"'; ?>>></button></a> <!-- Capsula juego 9 -->
                </div>
                <!-- TEMA 10 -->
                <div class="container-premium2" <?php echo 'style="' . (($tipo_modelo == 1) ? 'display: none;' : 'display: block;') . '"'; ?>> -->
                    <a href="../cursos/informatica/avanzado/capsulas/contenido/practicas/cp7informatica.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn26" id="pracp" <?php echo 'style="' . (($existe_verificar_html2 > 0 || $id_user == 1) ? 'display: block;' : 'display: none;') . ' ' . (($existe_comprada_html2 > 0) ? 'opacity: 1;' : 'opacity: 0.5;') . '"'; ?>></button></a> <!-- Capsula practica 10 -->
                    <a href="../cursos/informatica/avanzado/capsulas/contenido/juegos/cjip2/index.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn27" id="gamep" <?php echo 'style="' . (($existe_verificar_html2 > 0 || $id_user == 1) ? 'display: block;' : 'display: none;') . ' ' . (($existe_comprada_html2 > 0) ? 'opacity: 1;' : 'opacity: 0.5;') . '"'; ?>>></button></a> <!-- Capsula juego 10 -->
                    <a href="../cursos/informatica/avanzado/capsulas/contenido/teoricas/ct7informatica.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn28" id="teoriap" <?php echo 'style="' . (($existe_verificar_html2 > 0 || $id_user == 1) ? 'display: block;' : 'display: none;') . ' ' . (($existe_comprada_html2 > 0) ? 'opacity: 1;' : 'opacity: 0.5;') . '"'; ?>></button></a> <!-- Capsula teorica 10 -->
                </div> 
                <!-- EVALUATIVA informatica-->
                <a href="../cursos/informatica/avanzado/capsulas/contenido/evaluativas/ce1informatica.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn23" id="eva" <?php echo 'style="' . (($existe_capsula25 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula evaluativas informatica-->

                <div class="label-css">
                    <span></span>
                </div>
                <a href="../cursos/informatica/avanzado/capsulas/contenido/introduccion/ci2css.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn24" id="intro" <?php echo 'style="' . (($existe_capsula26 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula introduccion a CSS-->
                <!-- TEMA 1 -->
                <a href="../cursos/informatica/avanzado/capsulas/contenido/teoricas/ct8informatica.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn25" id="teoria" <?php echo 'style="' . (($existe_capsula27 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 1-->
                <a href="../cursos/informatica/avanzado/capsulas/contenido/practicas/cp11informatica.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn29" id="prac" <?php echo 'style="' . (($existe_capsula28 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 1-->
                <a href="../cursos/informatica/avanzado/capsulas/contenido/juegos/cjia2-1.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn30" id="game" <?php echo 'style="' . (($existe_capsula29 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 1-->
                <!-- TEMA 2 -->
                <a href="../cursos/informatica/avanzado/capsulas/contenido/teoricas/ct9informatica.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn31" id="teoria" <?php echo 'style="' . (($existe_capsula30 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 2-->
                <a href="../cursos/informatica/avanzado/capsulas/contenido/practicas/cp12informatica.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn32" id="prac" <?php echo 'style="' . (($existe_capsula31 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 2-->
                <a href="../cursos/informatica/avanzado/capsulas/contenido/juegos/cjia2-2.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn33" id="game" <?php echo 'style="' . (($existe_capsula32 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 2-->
                <!-- TEMA 3 -->
                <a href="../cursos/informatica/avanzado/capsulas/contenido/teoricas/ct10informatica.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn34" id="teoria" <?php echo 'style="' . (($existe_capsula33 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 3-->
                <a href="../cursos/informatica/avanzado/capsulas/contenido/practicas/cp13informatica.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn35" id="prac" <?php echo 'style="' . (($existe_capsula34 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 3-->
                <a href="../cursos/informatica/avanzado/capsulas/contenido/juegos/cjia2-3.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn36" id="game" <?php echo 'style="' . (($existe_capsula35 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 3-->
                <!-- TEMA 4 -->
                <a href="../cursos/informatica/avanzado/capsulas/contenido/teoricas/ct11informatica.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn37" id="teoria" <?php echo 'style="' . (($existe_capsula36 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 4-->
                <a href="../cursos/informatica/avanzado/capsulas/contenido/practicas/cp14informatica.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn38" id="prac" <?php echo 'style="' . (($existe_capsula37 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 4-->
                <a href="../cursos/informatica/avanzado/capsulas/contenido/juegos/cjia2-4.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn39" id="game" <?php echo 'style="' . (($existe_capsula38 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 4-->
                <!-- TEMA 5 -->
                <a href="../cursos/informatica/avanzado/capsulas/contenido/teoricas/ct12informatica.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn40" id="teoria" <?php echo 'style="' . (($existe_capsula39 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 5-->
                <a href="../cursos/informatica/avanzado/capsulas/contenido/practicas/cp15informatica.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn41" id="prac" <?php echo 'style="' . (($existe_capsula40 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 5-->
                <a href="../cursos/informatica/avanzado/capsulas/contenido/juegos/cjia2-5.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn42" id="game" <?php echo 'style="' . (($existe_capsula41 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 5-->
                <!-- TEMA 6 -->
                <a href="../cursos/informatica/avanzado/capsulas/contenido/teoricas/ct13informatica.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn43" id="teoria" <?php echo 'style="' . (($existe_capsula42 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>>></button></a><!--Capsula teorica 6-->
                <a href="../cursos/informatica/avanzado/capsulas/contenido/practicas/cp16informatica.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn44" id="prac" <?php echo 'style="' . (($existe_capsula43 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 6-->
                <a href="../cursos/informatica/avanzado/capsulas/contenido/juegos/cjia2-6.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn45" id="game" <?php echo 'style="' . (($existe_capsula44 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 6-->
                <!-- TEMA 7 -->
                <a href="../cursos/informatica/avanzado/capsulas/contenido/teoricas/ct14informatica.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn46" id="teoria" <?php echo 'style="' . (($existe_capsula45 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 7-->
                <a href="../cursos/informatica/avanzado/capsulas/contenido/practicas/cp17informatica.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn47" id="prac" <?php echo 'style="' . (($existe_capsula46 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 7-->
                <a href="../cursos/informatica/avanzado/capsulas/contenido/juegos/cjia2-7.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn48" id="game" <?php echo 'style="' . (($existe_capsula47 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 7-->
                <!-- TEMA 8 -->
                <div class="container-premium3" <?php echo 'style="' . (($tipo_modelo == 1) ? 'display: none;' : 'display: block;') . '"'; ?>> -->
                    <a href="../cursos/informatica/avanzado/capsulas/contenido/practicas/cp18informatica.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn26" id="pracp" <?php echo 'style="' . (($existe_verificar_css1 > 0 || $id_user == 1) ? 'display: block;' : 'display: none;') . ' ' . (($existe_comprada_css1 > 0) ? 'opacity: 1;' : 'opacity: 0.5;') . '"'; ?>></button></a> <!-- Capsula practica 8 -->
                    <a href="../cursos/informatica/avanzado/capsulas/contenido/juegos/cjip3.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn27" id="gamep" <?php echo 'style="' . (($existe_verificar_css1 > 0 || $id_user == 1) ? 'display: block;' : 'display: none;') . ' ' . (($existe_comprada_css1 > 0) ? 'opacity: 1;' : 'opacity: 0.5;') . '"'; ?>></button></a> <!-- Capsula juego 8 -->
                    <a href="../cursos/informatica/avanzado/capsulas/contenido/teoricas/ct18informatica.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn28" id="teoriap" <?php echo 'style="' . (($existe_verificar_css1 > 0 || $id_user == 1) ? 'display: block;' : 'display: none;') . ' ' . (($existe_comprada_css1 > 0) ? 'opacity: 1;' : 'opacity: 0.5;') . '"'; ?>></button></a> <!-- Capsula teorica 8 -->
                </div>
                <!-- TEMA 9 -->
                <a href="../cursos/informatica/avanzado/capsulas/contenido/teoricas/ct20informatica.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn58" id="teoria" <?php echo 'style="' . (($existe_capsula48 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula teorica 9-->
                <a href="../cursos/informatica/avanzado/capsulas/contenido/practicas/cp20informatica.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn59" id="prac" <?php echo 'style="' . (($existe_capsula49 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula practica 9-->
                <a href="../cursos/informatica/avanzado/capsulas/contenido/juegos/cjia2-8.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn60" id="game" <?php echo 'style="' . (($existe_capsula50 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>></button></a><!--Capsula juego 9-->
                <!-- TEMA 10 -->
                <div class="container-premium4" <?php echo 'style="' . (($tipo_modelo == 1) ? 'display: none;' : 'display: block;') . '"'; ?>> -->
                    <a href="../cursos/informatica/avanzado/capsulas/contenido/teoricas/ct19informatica.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn26" id="teoriap" <?php echo 'style="' . (($existe_verificar_css2 > 0 || $id_user == 1) ? 'display: block;' : 'display: none;') . ' ' . (($existe_comprada_css2 > 0) ? 'opacity: 1;' : 'opacity: 0.5;') . '"'; ?>></button></a> <!-- Capsula teorica 10 -->
                    <a href="../cursos/informatica/avanzado/capsulas/contenido/practicas/cp19informatica.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn27" id="pracp" <?php echo 'style="' . (($existe_verificar_css2 > 0 || $id_user == 1) ? 'display: block;' : 'display: none;') . ' ' . (($existe_comprada_css2 > 0) ? 'opacity: 1;' : 'opacity: 0.5;') . '"'; ?>></button></a> <!-- Capsula practica 10 -->
                    <a href="../cursos/informatica/avanzado/capsulas/contenido/juegos/cjip4.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn28" id="gamep" <?php echo 'style="' . (($existe_verificar_css2 > 0 || $id_user == 1) ? 'display: block;' : 'display: none;') . ' ' . (($existe_comprada_css2 > 0) ? 'opacity: 1;' : 'opacity: 0.5;') . '"'; ?>></button></a> <!-- Capsula juego 10 --> 
                </div>
                <!-- EVALUATIVA CSS -->
                <a href="../cursos/informatica/avanzado/capsulas/contenido/evaluativas/ce2informatica.php"><button onmouseover="playHoverSound()" onclick="playClickSound()" onmousedown="playClickSound()" class="btn49" id="eva" <?php echo 'style="' . (($existe_capsula51 > 0) ? 'opacity: 1;' : 'opacity: 0.5; ') . '"'; ?>>></button></a><!--Capsula evaluativas informatica-->
            </div>
        </div>
    </section>
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