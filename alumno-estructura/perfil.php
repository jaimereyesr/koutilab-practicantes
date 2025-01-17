<?php
session_start();
$id_user = $_SESSION['id_alumno'];
$rol = $_SESSION['rol'];

if (empty($_SESSION['active']) || empty($_SESSION['id_alumno'])) {
    header('location: ../acciones/cerrarsesion.php');
}

include('../acciones/conexion.php');

//Verificar si ya se tiene permiso en ruta 1
$permiso_ruta_r1 = "1";
$sql_verificar_r1 = mysqli_query($conexion, "SELECT a.* FROM acceso_cursos_$rol a WHERE a.id_alumno = $id_user AND a.id_curso = '$permiso_ruta_r1'");
$existe_verificar_r1 = mysqli_num_rows($sql_verificar_r1);

//Verificar si ya se tiene permiso en ruta 2
$permiso_ruta_r2 = "2";
$sql_verificar_r2 = mysqli_query($conexion, "SELECT a.* FROM acceso_cursos_$rol a WHERE a.id_alumno = $id_user AND a.id_curso = '$permiso_ruta_r2'");
$existe_verificar_r2 = mysqli_num_rows($sql_verificar_r2);

//Verificar si ya se tiene permiso en ruta 3
$permiso_ruta_r3 = "3";
$sql_verificar_r3 = mysqli_query($conexion, "SELECT a.* FROM acceso_cursos_$rol a WHERE a.id_alumno = $id_user AND a.id_curso = '$permiso_ruta_r3'");
$existe_verificar_r3 = mysqli_num_rows($sql_verificar_r3);

//Verificar si ya se tiene permiso en ruta 4
$permiso_ruta_r4 = "4";
$sql_verificar_r4 = mysqli_query($conexion, "SELECT a.* FROM acceso_cursos_$rol a WHERE a.id_alumno = $id_user AND a.id_curso = '$permiso_ruta_r4'");
$existe_verificar_r4 = mysqli_num_rows($sql_verificar_r4);

//Verificar si ya se tiene permiso en ruta 5
$permiso_ruta_r5 = "5";
$sql_verificar_r5 = mysqli_query($conexion, "SELECT a.* FROM acceso_cursos_$rol a WHERE a.id_alumno = $id_user AND a.id_curso = '$permiso_ruta_r5'");
$existe_verificar_r5 = mysqli_num_rows($sql_verificar_r5);

//Verificar si ya se tiene permiso en ruta 6
$permiso_ruta_r6 = "6";
$sql_verificar_r6 = mysqli_query($conexion, "SELECT a.* FROM acceso_cursos_$rol a WHERE a.id_alumno = $id_user AND a.id_curso = '$permiso_ruta_r6'");
$existe_verificar_r6 = mysqli_num_rows($sql_verificar_r6);

//Verificar si ya se tiene permiso en ruta 7
$permiso_ruta_r7 = "7";
$sql_verificar_r7 = mysqli_query($conexion, "SELECT a.* FROM acceso_cursos_$rol a WHERE a.id_alumno = $id_user AND a.id_curso = '$permiso_ruta_r7'");
$existe_verificar_r7 = mysqli_num_rows($sql_verificar_r7);

//Verificar si ya se tiene permiso en ruta 8
$permiso_ruta_r8 = "8";
$sql_verificar_r8 = mysqli_query($conexion, "SELECT a.* FROM acceso_cursos_$rol a WHERE a.id_alumno = $id_user AND a.id_curso = '$permiso_ruta_r8'");
$existe_verificar_r8 = mysqli_num_rows($sql_verificar_r8);

//Verificar si ya se tiene permiso en ruta 9
$permiso_ruta_r9 = "9";
$sql_verificar_r9 = mysqli_query($conexion, "SELECT a.* FROM acceso_cursos_$rol a WHERE a.id_alumno = $id_user AND a.id_curso = '$permiso_ruta_r9'");
$existe_verificar_r9 = mysqli_num_rows($sql_verificar_r9);

//Verificar si ya se tiene permiso en ruta 10
$permiso_ruta_r10 = "10";
$sql_verificar_r10 = mysqli_query($conexion, "SELECT a.* FROM acceso_cursos_$rol a WHERE a.id_alumno = $id_user AND a.id_curso = '$permiso_ruta_r10'");
$existe_verificar_r10 = mysqli_num_rows($sql_verificar_r10);

//Verificar si ya se tiene permiso en ruta 11
$permiso_ruta_r11 = "11";
$sql_verificar_r11 = mysqli_query($conexion, "SELECT a.* FROM acceso_cursos_$rol a WHERE a.id_alumno = $id_user AND a.id_curso = '$permiso_ruta_r11'");
$existe_verificar_r11 = mysqli_num_rows($sql_verificar_r11);

//Verificar si ya se tiene permiso en ruta 12
$permiso_ruta_r12 = "12";
$sql_verificar_r12 = mysqli_query($conexion, "SELECT a.* FROM acceso_cursos_$rol a WHERE a.id_alumno = $id_user AND a.id_curso = '$permiso_ruta_r12'");
$existe_verificar_r12 = mysqli_num_rows($sql_verificar_r12);

//Verificar si ya se tiene permiso en ruta 13
$permiso_ruta_r13 = "13";
$sql_verificar_r13 = mysqli_query($conexion, "SELECT a.* FROM acceso_cursos_$rol a WHERE a.id_alumno = $id_user AND a.id_curso = '$permiso_ruta_r13'");
$existe_verificar_r13 = mysqli_num_rows($sql_verificar_r13);

//Verificar si ya se tiene permiso en ruta 14
$permiso_ruta_r14 = "14";
$sql_verificar_r14 = mysqli_query($conexion, "SELECT a.* FROM acceso_cursos_$rol a WHERE a.id_alumno = $id_user AND a.id_curso = '$permiso_ruta_r14'");
$existe_verificar_r14 = mysqli_num_rows($sql_verificar_r14);

//Verificar si ya se tiene permiso en ruta 15
$permiso_ruta_r15 = "15";
$sql_verificar_r15 = mysqli_query($conexion, "SELECT a.* FROM acceso_cursos_$rol a WHERE a.id_alumno = $id_user AND a.id_curso = '$permiso_ruta_r15'");
$existe_verificar_r15 = mysqli_num_rows($sql_verificar_r15);

//Estadisticas de todos los cursos del alumno
$consultaEstadistica = mysqli_query($conexion, "SELECT trofeos, SUM(trofeos) AS total_trofeos, progreso, SUM(progreso) AS total_progreso, puntos, SUM(puntos) AS total_puntos, practico, SUM(practico) AS total_practico, teorico, SUM(teorico) AS total_teorico FROM estadisticas_$rol WHERE id_alumno = $id_user");
$resultadoEstadistica = mysqli_fetch_assoc($consultaEstadistica);

//Estadisticas programacion web basica
$query_programacion_web_basica = mysqli_query($conexion, "SELECT * FROM estadisticas_$rol WHERE id_alumno = $id_user AND id_curso = 1");
$data_programacion_web_basica = mysqli_fetch_assoc($query_programacion_web_basica);

//Estadisticas programacion web intermedio
$query_programacion_web_intermedio = mysqli_query($conexion, "SELECT * FROM estadisticas_$rol WHERE id_alumno = $id_user AND id_curso = 2");
$data_programacion_web_intermedio = mysqli_fetch_assoc($query_programacion_web_intermedio);

//Estadisticas programacion web avanzado
$query_programacion_web_avanzado = mysqli_query($conexion, "SELECT * FROM estadisticas_$rol WHERE id_alumno = $id_user AND id_curso = 3");
$data_programacion_web_avanzado = mysqli_fetch_assoc($query_programacion_web_avanzado);

//Estadisticas python basico
$query_python_basico = mysqli_query($conexion, "SELECT * FROM estadisticas_$rol WHERE id_alumno = $id_user AND id_curso = 4");
$data_python_basico = mysqli_fetch_assoc($query_python_basico);

//Estadisticas python intermedio
$query_python_intermedio = mysqli_query($conexion, "SELECT * FROM estadisticas_$rol WHERE id_alumno = $id_user AND id_curso = 5");
$data_python_intermedio = mysqli_fetch_assoc($query_python_intermedio);

//Estadisticas python avanzado
$query_python_avanzado = mysqli_query($conexion, "SELECT * FROM estadisticas_$rol WHERE id_alumno = $id_user AND id_curso = 6");
$data_python_avanzado = mysqli_fetch_assoc($query_python_avanzado);

//Estadisticas informatica basico
$query_informatica_basico = mysqli_query($conexion, "SELECT * FROM estadisticas_$rol WHERE id_alumno = $id_user AND id_curso = 7");
$data_informatica_basico = mysqli_fetch_assoc($query_informatica_basico);

//Estadisticas informatica intermedio
$query_informatica_intermedio = mysqli_query($conexion, "SELECT * FROM estadisticas_$rol WHERE id_alumno = $id_user AND id_curso = 8");
$data_informatica_intermedio = mysqli_fetch_assoc($query_informatica_intermedio);

//Estadisticas informatica avanzado
$query_informatica_avanzado = mysqli_query($conexion, "SELECT * FROM estadisticas_$rol WHERE id_alumno = $id_user AND id_curso = 9");
$data_informatica_avanzado = mysqli_fetch_assoc($query_informatica_avanzado);

//Estadisticas videojuegosunity basico
$query_videojuegosunity_basico = mysqli_query($conexion, "SELECT * FROM estadisticas_$rol WHERE id_alumno = $id_user AND id_curso = 10");
$data_videojuegosunity_basico = mysqli_fetch_assoc($query_videojuegosunity_basico);

//Estadisticas videojuegosunity intermedio
$query_videojuegosunity_intermedio = mysqli_query($conexion, "SELECT * FROM estadisticas_$rol WHERE id_alumno = $id_user AND id_curso = 11");
$data_videojuegosunity_intermedio = mysqli_fetch_assoc($query_videojuegosunity_intermedio);

//Estadisticas videojuegosunity avanzado
$query_videojuegosunity_avanzado = mysqli_query($conexion, "SELECT * FROM estadisticas_$rol WHERE id_alumno = $id_user AND id_curso = 12");
$data_videojuegosunity_avanzado = mysqli_fetch_assoc($query_videojuegosunity_avanzado);

//Estadisticas appsmoviles basico
$query_appsmoviles_basico = mysqli_query($conexion, "SELECT * FROM estadisticas_$rol WHERE id_alumno = $id_user AND id_curso = 13");
$data_appsmoviles_basico = mysqli_fetch_assoc($query_appsmoviles_basico);

//Estadisticas appsmoviles intermedio
$query_appsmoviles_intermedio = mysqli_query($conexion, "SELECT * FROM estadisticas_$rol WHERE id_alumno = $id_user AND id_curso = 14");
$data_appsmoviles_intermedio = mysqli_fetch_assoc($query_appsmoviles_intermedio);

//Estadisticas appsmoviles avanzado
$query_appsmoviles_avanzado = mysqli_query($conexion, "SELECT * FROM estadisticas_$rol WHERE id_alumno = $id_user AND id_curso = 15");
$data_appsmoviles_avanzado = mysqli_fetch_assoc($query_appsmoviles_avanzado);

//Información solo de alumno
$user = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM alumnos_$rol a JOIN escuelas e ON a.id_escuela = e.id_escuela WHERE id_alumno = $id_user"));

//Información para alumno - escuela
$user_escuela = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT e.* FROM alumnos_$rol a
JOIN escuelas e 
ON a.id_escuela = e.id_escuela
WHERE a.id_alumno = $id_user"));

//Información para alumno - docente
$user_docente = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT d.* FROM alumnos_$rol a
JOIN docentes_$rol d 
ON a.id_docente = d.id_docente
WHERE a.id_alumno = $id_user"));

//Conteo de cursos
$sql = "SELECT COUNT(*) id_alumno FROM acceso_cursos_$rol
WHERE id_alumno = $id_user";
$result = mysqli_query($conexion, $sql);
$fila = mysqli_fetch_assoc($result);

$sql_verificar_rutas = mysqli_query($conexion, "SELECT a.* FROM acceso_cursos_$rol a WHERE a.id_alumno = $id_user");
$existe_verificar_rutas = mysqli_num_rows($sql_verificar_rutas);

// Array que contiene los puntos correspondientes a cada ruta desbloqueada.
$puntos_por_ruta = array(
    "1" => array(
        "trofeos" => 200,
        "teoricos" => 200,
        "practicos" => 200,
        "evaluativos" => 20
    ),
    "2" => array(
        "trofeos" => 210,
        "teoricos" => 210,
        "practicos" => 210,
        "evaluativos" => 30
    ),
    "3" => array(
        "trofeos" => 200,
        "teoricos" => 200,
        "practicos" => 200,
        "evaluativos" => 20
    ),
    "4" => array(
        "trofeos" => 200,
        "teoricos" => 200,
        "practicos" => 200,
        "evaluativos" => 20
    ),
    "5" => array(
        "trofeos" => 200,
        "teoricos" => 200,
        "practicos" => 200,
        "evaluativos" => 20
    ),
    "6" => array(
        "trofeos" => 200,
        "teoricos" => 200,
        "practicos" => 200,
        "evaluativos" => 20
    ),
    "7" => array(
        "trofeos" => 200,
        "teoricos" => 200,
        "practicos" => 200,
        "evaluativos" => 20
    ),
    "8" => array(
        "trofeos" => 200,
        "teoricos" => 200,
        "practicos" => 200,
        "evaluativos" => 20
    ),
    "9" => array(
        "trofeos" => 200,
        "teoricos" => 200,
        "practicos" => 200,
        "evaluativos" => 20
    ),
    "10" => array(
        "trofeos" => 200,
        "teoricos" => 200,
        "practicos" => 200,
        "evaluativos" => 20
    ),
    "11" => array(
        "trofeos" => 200,
        "teoricos" => 200,
        "practicos" => 200,
        "evaluativos" => 20
    ),
    "12" => array(
        "trofeos" => 200,
        "teoricos" => 200,
        "practicos" => 200,
        "evaluativos" => 20
    ),
    "13" => array(
        "trofeos" => 200,
        "teoricos" => 200,
        "practicos" => 200,
        "evaluativos" => 20
    ),
    "14" => array(
        "trofeos" => 200,
        "teoricos" => 200,
        "practicos" => 200,
        "evaluativos" => 20
    ),
    "15" => array(
        "trofeos" => 200,
        "teoricos" => 200,
        "practicos" => 200,
        "evaluativos" => 20
    )

);

// Conjunto para llevar un registro de las rutas desbloqueadas ya procesadas.
$rutas_procesadas = array();

// Variables para almacenar los puntos totales de cada tipo.
$total_trofeos = 0;
$total_puntos_teoricos = 0;
$total_puntos_practicos = 0;
$total_puntos_evaluativos = 0;

if ($existe_verificar_rutas > 0) {
    // Si el usuario tiene desbloqueada al menos una ruta, sumar los puntos de todas las rutas desbloqueadas.
    while ($ruta = mysqli_fetch_assoc($sql_verificar_rutas)) {
        $ruta_desbloqueada = $ruta['id_curso'];
        if (isset($puntos_por_ruta[$ruta_desbloqueada]) && !isset($rutas_procesadas[$ruta_desbloqueada])) {
            $total_trofeos += $puntos_por_ruta[$ruta_desbloqueada]["trofeos"];
            $total_puntos_teoricos += $puntos_por_ruta[$ruta_desbloqueada]["teoricos"];
            $total_puntos_practicos += $puntos_por_ruta[$ruta_desbloqueada]["practicos"];
            $total_puntos_evaluativos += $puntos_por_ruta[$ruta_desbloqueada]["evaluativos"];
            $rutas_procesadas[$ruta_desbloqueada] = true;
        }
    }
}

// Ahora, las variables $total_trofeos, $total_puntos_teoricos, $total_puntos_practicos y $total_puntos_evaluativos contienen los totales de puntos máximos que el usuario puede obtener sin repetir rutas desbloqueadas y por cada tipo de punto.
$totalTrofeos = $total_trofeos;
$totalPuntaje = $total_puntos_evaluativos;
$totalPractico = $total_puntos_practicos;
$totalTeorico = $total_puntos_teoricos;

// Consulta para obtener la cantidad de estrellas para el alumno específico
$sql_estrellas = "SELECT estrellas FROM total_estrellas_$rol WHERE id_alumno = $id_user";
$result_estrellas = $conexion->query($sql_estrellas);

if ($result_estrellas->num_rows > 0) {
    $row = $result_estrellas->fetch_assoc();
    $cantidad_estrellas = $row['estrellas'];
}

?>
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KOUTILAB</title>
    <link rel="shortcut icon" href="img/lgk.png">

    <link rel="stylesheet" href="css/perfil-alumno2.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/easy-pie-chart/2.1.6/jquery.easypiechart.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

    <div class="container-principal">
        <section class="seccion-perfil-usuario">
            <div class="perfil-usuario-header">
                <div class="perfil-usuario-portada">

                    <?php
                    $id = $user["id_alumno"];
                    $name = $user["nombre"];
                    $image = $user["image"];
                    $portada = $user["fondo"];
                    ?>
                    <img src="acciones/img/<?php echo $portada; ?>" class="fondo" id="imgchange">

                    <div class="perfil-usuario-avatar">


                        <div class="upload" style="margin-right: 1px; margin-top: 0.5px;">
                            <img src="acciones/img/<?php echo $image; ?>" id="imgchange1">
                            <div class="dropdown">
                                <button class="dropdown-btn">
                                    <i class="fa fa-camera" style="color: rgba(0,201,255,2556); font-size:25px; margin-top:3px; margin-left: -6px;"></i></button>
                                <div class="dropdown-content">
                                    <form class="form" id="btn-abrir-modalFP" enctype="multipart/form-data" method="">
                                        <i class="fa fa-camera" style="color: white; text-decoration: none;">&nbsp;&nbsp;Seleccionar Avatar</i>
                                    </form>
                                    <form class="form" id="btn-abrir-modalP" enctype="multipart/form-data" method="">
                                        <i class="far fa-image" style="color: white; text-decoration: none;">&nbsp;&nbsp;Fondo de Portada</i>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="Logo2">
                        <img src="img/Bienvenida.png" style="height: 110px; width:170px;">
                    </div>


                    <div class="desplegable">

                        <button type="button" class="boton-opciones" id="" placeholder="Opciones">
                            <div class="sing"> <img src="../img/ajustes.png" alt="" height="20px" width="20px" class="svg">
                            </div>

                            <div class="textB">
                                <p>Opciones</p>
                            </div>
                            <div class="links">

                                <form class="link1" id="btn-abrir-modalCN" enctype="multipart/form-data" method="">
                                    <i class="fas fa-user" style="color: white; text-decoration: none;">&nbsp;&nbsp;Cambiar nombre&nbsp;&nbsp;</i>
                                </form>
                                <form class="link2" id="btn-abrir-modalCC" enctype="multipart/form-data" method="">
                                    <i class="fas fa-file-alt" style="color: white; text-decoration: none;">&nbsp;&nbsp;Cambiar contraseña&nbsp;&nbsp;</i>
                                </form>

                                <a href="../acciones/cerrarsesion.php" class="link3"><i class="fa fa-sign-out" style="color: white;">Cerrar sesión&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i></a>

                            </div>

                        </button>
                    </div>

                </div>
            </div>
            <div class="perfil-usuario-body">
                <div class="perfil-usuario-bio">

                    <?php
                    $data2 = mysqli_query($conexion, "SELECT * FROM alumnos_$rol WHERE id_alumno = '$id_user'");
                    while ($consulta = mysqli_fetch_array($data2)) {
                        echo " <h3 class='titulo'>" . $consulta['nombre'] . "</h3>";
                    }
                    ?>
                    <hr class="lineaTP">
                    <div class="dos">

                        <ul class="lista-datos">
                            <p><b>&nbsp;Escuela:</b> <?php echo $user_escuela["nombre_escuela"] ?>
                                <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nivel educativo:</b> <?php echo $user["nivel_educativo"] ?>
                                <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Profesor:</b> <?php echo $user_docente["nombre"] ?>
                                <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CCT:</b> <?php echo $user_escuela["cct"] ?>
                            </p>

                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <div class="body">
            <div class="lati">


                <div class="dos1" style="margin-bottom: 15px;">
                    <div class="titlec2">
                        <h2>Nuevo grupo</h2>
                    </div>
                    <ul class="lista-datos">
                        <li><b>&nbsp;Unirse a un grupo:</b></li>
                        <li>
                            <form enctype="multipart/form-data" action="" method="post">
                                <div class="user-details1">
                                    <div class="input-box1">
                                        <input type="text" name="clavegrupo" value="" placeholder="Clave de grupo">

                                        <input type="submit" name="enviarclave" value="Unirse" class="btn-grd">
                                    </div>
                                </div>
                            </form>
                        </li>
                    </ul>
                </div>
                <br>
                <br>
                <br>


                <div class="dos1">
                    <div class="titlec2">
                        <h2>Estadísticas</h2>
                    </div>
                    <ul class="lista-datos">
                        <div class="val-box">
                            <canvas id="myChart1"></canvas>
                        </div>
                    </ul>
                </div>
                <div class="dos1">
                    <ul class="lista-datos">
                        <li><i class="fas fa-award"></i> &nbsp;<b>Conocimientos:</b> <?php echo $resultadoEstadistica["teorico"] ?> de <?php echo $totalTeorico ?> </li><br>
                        <li><i class='fas fa-chart-line'></i></i> &nbsp;<b>Coding:</b> <?php echo $resultadoEstadistica["practico"] ?> de <?php echo $totalPractico ?> </li><br>
                        <li><i class='fab fa-joomla'></i></i>&nbsp; <b>Logros:</b> <?php echo $resultadoEstadistica["trofeos"] ?> de <?php echo $totalTrofeos ?> </li><br>
                        <li><i class='fas fa-file-alt'></i></i> &nbsp;<b>Destreza:</b> <?php echo $resultadoEstadistica["puntos"] ?> de <?php echo $totalPuntaje ?> </li> <br>
                        <li><i class='fas fa-star'></i></i> &nbsp;<b>Estrellas:</b> <?php echo $cantidad_estrellas ?> </li>
                    </ul>
                </div>


            </div>

            <div class="latd">
                <div class="titlec">
                    <h2>Cursos</h2>
                </div>
                <div class="card" <?php echo 'style="height: 300px;' . (($existe_verificar_r1 > 0) ? 'opacity: 1;' : 'display: none;') . '"'; ?>>
                    <a href="rutas/ruta-pw-b-<?php echo $rol; ?>.php">
                        <div class="container">
                            <div class="box">
                                <div class="chart" data-percent="<?php if (isset($data_programacion_web_basica)) echo $data_programacion_web_basica['progreso']; ?>" data-scale-color="#ffb400">
                                    <?php if (isset($data_programacion_web_basica)) echo $data_programacion_web_basica['progreso']; ?>%
                                </div>

                                <hr style="background-color:rgba(205, 249, 254); width: 170px; height:5px; border:none; margin-top: 15px; ">
                                <br>
                                <h2>Diseño web básico</h2>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="card" <?php echo 'style="height: 300px;' . (($existe_verificar_r2 > 0) ? 'opacity: 1;' : 'display: none;') . '"'; ?>>
                    <a href="rutas/ruta-pw-i-<?php echo $rol; ?>.php">
                        <div class="container">
                            <div class="box">
                                <div class="chart" data-percent="<?php if (isset($data_programacion_web_intermedio)) echo $data_programacion_web_intermedio['progreso']; ?>" data-scale-color="#ffb400">
                                    <?php if (isset($data_programacion_web_intermedio)) echo $data_programacion_web_intermedio['progreso']; ?>%
                                </div>
                                <hr style="background-color:rgba(205, 249, 254); width: 170px; height:5px; border:none; margin-top: 15px; ">
                                <br>
                                <h2>Diseño web intermedio</h2>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="card" <?php echo 'style="height: 300px;' . (($existe_verificar_r3 > 0) ? 'opacity: 1;' : 'display: none;') . '"'; ?>>
                    <a href="rutas/ruta-pw-a-<?php echo $rol; ?>.php">
                        <div class="container">
                            <div class="box">
                                <div class="chart" data-percent="<?php if (isset($data_programacion_web_avanzado)) echo $data_programacion_web_avanzado['progreso']; ?>" data-scale-color="#ffb400">
                                    <?php if (isset($data_programacion_web_avanzado)) echo $data_programacion_web_avanzado['progreso']; ?>%
                                </div>
                                <hr style="background-color:rgba(205, 249, 254); width: 170px; height:5px; border:none; margin-top: 15px; ">
                                <br>
                                <h2>Diseño web avanzado</h2>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="card" <?php echo 'style="height: 300px;' . (($existe_verificar_r4 > 0) ? 'opacity: 1;' : 'display: none;') . '"'; ?>>
                    <a href="rutas/ruta-py-b-<?php echo $rol; ?>.php">
                        <div class="container">
                            <div class="box">
                                <div class="chart" data-percent="<?php if (isset($data_python_basico)) echo $data_python_basico['progreso']; ?>" data-scale-color="#ffb400">
                                    <?php if (isset($data_python_basico)) echo $data_python_basico['progreso']; ?>%
                                </div>
                                <hr style="background-color:rgba(205, 249, 254); width: 170px; height:5px; border:none; margin-top: 15px; ">
                                <br>
                                <h2>Python básico</h2>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="card" <?php echo 'style="height: 300px;' . (($existe_verificar_r5 > 0) ? 'opacity: 1;' : 'display: none;') . '"'; ?>>
                    <a href="rutas/ruta-py-i-<?php echo $rol; ?>.php">
                        <div class="container">
                            <div class="box">
                                <div class="chart" data-percent="<?php if (isset($data_python_intermedio)) echo $data_python_intermedio['progreso']; ?>" data-scale-color="#ffb400">
                                    <?php if (isset($data_python_intermedio)) echo $data_python_intermedio['progreso']; ?>%
                                </div>
                                <hr style="background-color:rgba(205, 249, 254); width: 170px; height:5px; border:none; margin-top: 15px; ">
                                <br>
                                <h2>Python intermedio</h2>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="card" <?php echo 'style="height: 300px;' . (($existe_verificar_r6 > 0) ? 'opacity: 1;' : 'display: none;') . '"'; ?>>
                    <a href="rutas/ruta-py-a-<?php echo $rol; ?>.php">
                        <div class="container">
                            <div class="box">
                                <div class="chart" data-percent="<?php if (isset($data_python_avanzado)) echo $data_python_avanzado['progreso']; ?>" data-scale-color="#ffb400">
                                    <?php if (isset($data_python_avanzado)) echo $data_python_avanzado['progreso']; ?>%
                                </div>
                                <hr style="background-color:rgba(205, 249, 254); width: 170px; height:5px; border:none; margin-top: 15px; ">
                                <br>
                                <h2>Python avanzado</h2>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="card" <?php echo 'style="height: 300px;' . (($existe_verificar_r7 > 0) ? 'opacity: 1;' : 'display: none;') . '"'; ?>>
                    <a href="rutas/ruta-in-b-<?php echo $rol; ?>.php">
                        <div class="container">
                            <div class="box">
                                <div class="chart" data-percent="<?php if (isset($data_informatica_basico)) echo $data_informatica_basico['progreso']; ?>" data-scale-color="#ffb400">
                                    <?php if (isset($data_informatica_basico)) echo $data_informatica_basico['progreso']; ?>%
                                </div>
                                <hr style="background-color:rgba(205, 249, 254); width: 170px; height:5px; border:none; margin-top: 15px; ">
                                <br>
                                <h2>Informática básico</h2>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="card" <?php echo 'style="height: 300px;' . (($existe_verificar_r8 > 0) ? 'opacity: 1;' : 'display: none;') . '"'; ?>>
                    <a href="rutas/ruta-in-i-<?php echo $rol; ?>.php">
                        <div class="container">
                            <div class="box">
                                <div class="chart" data-percent="<?php if (isset($data_informatica_intermedio)) echo $data_informatica_intermedio['progreso']; ?>" data-scale-color="#ffb400">
                                    <?php if (isset($data_informatica_intermedio)) echo $data_informatica_intermedio['progreso']; ?>%
                                </div>
                                <hr style="background-color:rgba(205, 249, 254); width: 170px; height:5px; border:none; margin-top: 15px; ">
                                <br>
                                <h2>Informática intermedio</h2>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="card" <?php echo 'style="height: 300px;' . (($existe_verificar_r9 > 0) ? 'opacity: 1;' : 'display: none;') . '"'; ?>>
                    <a href="rutas/ruta-in-a-<?php echo $rol; ?>.php">
                        <div class="container">
                            <div class="box">
                                <div class="chart" data-percent="<?php if (isset($data_informatica_avanzado)) echo $data_informatica_avanzado['progreso']; ?>" data-scale-color="#ffb400">
                                    <?php if (isset($data_informatica_avanzado)) echo $data_informatica_avanzado['progreso']; ?>%
                                </div>
                                <hr style="background-color:rgba(205, 249, 254); width: 170px; height:5px; border:none; margin-top: 15px; ">
                                <br>
                                <h2>Informática avanzado</h2>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="card" <?php echo 'style="height: 300px;' . (($existe_verificar_r10 > 0) ? 'opacity: 1;' : 'display: none;') . '"'; ?>>
                    <a href="rutas/ruta-vj-b-<?php echo $rol; ?>.php">
                        <div class="container">
                            <div class="box">
                                <div class="chart" data-percent="<?php if (isset($data_videojuegosunity_basico)) echo $data_videojuegosunity_basico['progreso']; ?>" data-scale-color="#ffb400">
                                    <?php if (isset($data_videojuegosunity_basico)) echo $data_videojuegosunity_basico['progreso']; ?>%
                                </div>
                                <hr style="background-color:rgba(205, 249, 254); width: 170px; height:5px; border:none; margin-top: 15px; ">
                                <br>
                                <h2>Videojuegos Unity básico</h2>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="card" <?php echo 'style="height: 300px;' . (($existe_verificar_r11 > 0) ? 'opacity: 1;' : 'display: none;') . '"'; ?>>
                    <a href="rutas/ruta-vj-i-<?php echo $rol; ?>.php">
                        <div class="container">
                            <div class="box">
                                <div class="chart" data-percent="<?php if (isset($data_videojuegosunity_intermedio)) echo $data_informatica_intermedio['progreso']; ?>" data-scale-color="#ffb400">
                                    <?php if (isset($data_videojuegosunity_intermedio)) echo $data_videojuegosunity_intermedio['progreso']; ?>%
                                </div>
                                <hr style="background-color:rgba(205, 249, 254); width: 170px; height:5px; border:none; margin-top: 5px; ">
                                <br>
                                <h2>Videojuegos Unity intermedio</h2>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="card" <?php echo 'style="height: 300px;' . (($existe_verificar_r12 > 0) ? 'opacity: 1;' : 'display: none;') . '"'; ?>>
                    <a href="rutas/ruta-vj-a-<?php echo $rol; ?>.php">
                        <div class="container">
                            <div class="box">
                                <div class="chart" data-percent="<?php if (isset($data_videojuegosunity_avanzado)) echo $data_videojuegosunity_avanzado['progreso']; ?>" data-scale-color="#ffb400">
                                    <?php if (isset($data_videojuegosunity_avanzado)) echo $data_videojuegosunity_avanzado['progreso']; ?>%
                                </div>
                                <hr style="background-color:rgba(205, 249, 254); width: 170px; height:5px; border:none; margin-top: 5px; ">
                                <br>
                                <h2>Videojuegos Unity avanzado</h2>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="card" <?php echo 'style="height: 300px;' . (($existe_verificar_r13 > 0) ? 'opacity: 1;' : 'display: none;') . '"'; ?>>
                    <a href="rutas/ruta-apps-b-<?php echo $rol; ?>.php">
                        <div class="container">
                            <div class="box">
                                <div class="chart" data-percent="<?php if (isset($data_appsmoviles_basico)) echo $data_appsmoviles_basico['progreso']; ?>" data-scale-color="#ffb400">
                                    <?php if (isset($data_appsmoviles_basico)) echo $data_appsmoviles_basico['progreso']; ?>%
                                </div>
                                <hr style="background-color:rgba(205, 249, 254); width: 170px; height:5px; border:none; margin-top: 15px; ">
                                <br>
                                <h2>Apps móviles básico</h2>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="card" <?php echo 'style="height: 300px;' . (($existe_verificar_r14 > 0) ? 'opacity: 1;' : 'display: none;') . '"'; ?>>
                    <a href="rutas/ruta-apps-i-<?php echo $rol; ?>.php">
                        <div class="container">
                            <div class="box">
                                <div class="chart" data-percent="<?php if (isset($data_appsmoviles_intermedio)) echo $data_informatica_intermedio['progreso']; ?>" data-scale-color="#ffb400">
                                    <?php if (isset($data_appsmoviles_intermedio)) echo $data_appsmoviles_intermedio['progreso']; ?>%
                                </div>
                                <hr style="background-color:rgba(205, 249, 254); width: 170px; height:5px; border:none; margin-top: 5px; ">
                                <br>
                                <h2>Apps móviles intermedio</h2>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="card" <?php echo 'style="height: 300px;' . (($existe_verificar_r15 > 0) ? 'opacity: 1;' : 'display: none;') . '"'; ?>>
                    <a href="rutas/ruta-apps-a-<?php echo $rol; ?>.php">
                        <div class="container">
                            <div class="box">
                                <div class="chart" data-percent="<?php if (isset($data_appsmoviles_avanzado)) echo $data_appsmoviles_avanzado['progreso']; ?>" data-scale-color="#ffb400">
                                    <?php if (isset($data_appsmoviles_avanzado)) echo $data_appsmoviles_avanzado['progreso']; ?>%
                                </div>
                                <hr style="background-color:rgba(205, 249, 254); width: 170px; height:5px; border:none; margin-top: 5px; ">
                                <br>
                                <h2>Apps móviles avanzado</h2>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            const ctx1 = document.getElementById('myChart1');
            new Chart(ctx1, {
                type: 'radar',
                data: {
                    labels: ['Conocimientos', 'Coding', 'Logros', 'Destreza'],
                    datasets: [{
                        label: 'Estadísticas',
                        data: [<?php echo $resultadoEstadistica["teorico"] ?>, <?php echo $resultadoEstadistica["practico"] ?>, <?php echo $resultadoEstadistica["trofeos"] ?>, <?php echo $resultadoEstadistica["puntos"] ?>],
                        fill: true,
                        borderWidth: 1
                    }]
                },
            });
        </script>
        <script src="js/bar.js"></script>

        <!-- Cambiar foto de perfil -->

        <script type="text/javascript">
            document.getElementById("image").onchange = function() {
                document.getElementById("form").submit();
            };
        </script>
        <?php
        if (isset($_FILES["image"]["name"])) {
            $id = $_POST["id"];
            $name = $_POST["name"];

            $imageName = $_FILES["image"]["name"];
            $imageSize = $_FILES["image"]["size"];
            $tmpName = $_FILES["image"]["tmp_name"];

            // Image validation
            $validImageExtension = ['jpg', 'jpeg', 'png'];
            $imageExtension = explode('.', $imageName);
            $imageExtension = strtolower(end($imageExtension));
            if (!in_array($imageExtension, $validImageExtension)) {
                echo
                "
        <script>
        Swal.fire({
            title: '¡Advertencia!',
            text: 'Extensión de imágen invalida',
            icon: 'info',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Reintentar',
          }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'perfil.php';
            }
          });
        </script>
        ";
            } elseif ($imageSize > 1200000) {
                echo
                "
        <script>
        Swal.fire({
            title: '¡Advertencia!',
            text: 'Tamaño de imágen demasiado larga',
            icon: 'info',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Reintentar',
          }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'perfil.php';
              window.location.reload();
            }
          });
          
        </script>
        ";
            } else {
                $newImageName = $name . " - " . date("Y.m.d") . " - " . date("h.i.sa"); // Generate new image name
                $newImageName .= '.' . $imageExtension;
                $query = "UPDATE alumnos_$rol SET image = '$newImageName' WHERE id_alumno = $id";
                mysqli_query($conexion, $query);
                move_uploaded_file($tmpName, 'acciones/img/' . $newImageName);
                echo
                "
        <script>
        Swal.fire({
            title: '¡Excelente!',
            text: 'Cambio de imágen exitoso',
            icon: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar',
          }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'perfil.php';
            }
          });
        </script>
        ";
            }
        }
        ?>
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

        <dialog close id="modalCN" style="border: none; border-radius: 10px; margin-top: 250px; margin-left: 27%; background: url(img/fondoPerfil.png);  border: 2px solid rgba(0,201,255,2556); width: 45%; height: 30%; box-shadow: 0 0 12px rgba(0,201,255,2556);">
            <button style="float: right; background-color: rgba(132, 196, 44, 0.6); padding-left: 6px; padding-right: 9px; padding-top: 4px; padding-bottom: px; scale: 110%; border-radius: 50%; outline: none; border: 0px; margin: 10px 10px; cursor: pointer; " id="btn-cerrar-modalCN"><i class="fas fa-close"></i></button><br>
            <div class="portada" style="width: 80%; height: 140px;border-radius: 10px; margin-top: 2.5%; margin-left: 10%;  border: 2px solid rgba(0,201,255,2556);  background: rgba(255,255,255, .8); box-shadow: 0 0 12px rgba(0,201,255,2556); ">
                <ul class="lista-datos">
                    <b>&nbsp;Cambiar nombre:</b>

                    <form enctype="multipart/form-data" action="" method="post">
                        <div class="user-details1" style="margin-left:1%;">
                            <div class="input-box1" style="width: 90%; scale: 90%; margin-top:1%; margin-left: -0;">
                                <input type="text" name="nombrealumno" value="" placeholder="Nuevo nombre">
                                <input type="submit" name="enviarnombre" value="Actualizar" class="btn-grd" style="width: 70%; margin-left:20%">
                            </div>
                        </div>
                    </form>

                </ul>
            </div>


        </dialog>

        <dialog close id="modalCC" style="border: none; border-radius: 10px; margin-top: 250px; margin-left: 27%; background: url(img/fondoPerfil.png);  border: 2px solid rgba(0,201,255,2556); width: 45%; height: 30%; box-shadow: 0 0 12px rgba(0,201,255,2556);">
            <button style="float: right; background-color: rgba(132, 196, 44, 0.6); padding-left: 6px; padding-right: 9px; padding-top: 4px; padding-bottom: px; scale: 110%; border-radius: 50%; outline: none; border: 0px; margin: 10px 10px; cursor: pointer; " id="btn-cerrar-modalCC"><i class="fas fa-close"></i></button><br>
            <div class="portada" style="width: 80%; height: 140px;border-radius: 10px; margin-top: 2.5%; margin-left: 10%;  border: 2px solid rgba(0,201,255,2556);  background: rgba(255,255,255, .8); box-shadow: 0 0 12px rgba(0,201,255,2556); ">
                <ul class="lista-datos">
                    <b>&nbsp;Contraseña:</b>

                    <form enctype="multipart/form-data" action="" method="post">
                        <div class="user-details1" style="margin-left:1%;">
                            <div class="input-box1" style="width: 90%; scale: 90%; margin-top:1%; margin-left: -0;">
                                <input type="text" name="contrasena" value="" placeholder="Nueva contraseña">
                                <input type="submit" name="enviarcontrasena" value="Actualizar" class="btn-grd" style="width: 70%; margin-left:20%">
                            </div>
                        </div>
                    </form>

                </ul>
            </div>


        </dialog>



        <dialog close id="modalP" style="width:40%;border: none; border-radius: 10px; margin-top: 190px; margin-left: 33%; background: url(img/fondoPerfil.png);  border: 2px solid rgba(0,201,255,2556);">
            <button style="float: right; background-color: rgba(132, 196, 44, 0.6); padding-left: 7px; padding-right: 7px; padding-top: 6px; padding-bottom: 5px; scale: 110%; border-radius: 50%; outline: none; border: 0px; margin: 10px 10px; cursor: pointer;" id="btn-cerrar-modalP"><i class="fas fa-close"></i></button><br>
            <div class="portada" style="width: 90%; height: 40px;margin-left:5%; margin-bottom:2%;  border: 2px solid rgba(0,201,255,2556); border-radius: 10px; background: rgba(255,255,255, .8);">
                <h4 style="display: block; width: 100%; font-size: 1.75em; margin-bottom: 0.5rem; text-align: center;">Fondos</h4>
            </div>
            <div class="portada" style="width: 90%; height: 300px; margin-left:5%;  border: 2px solid rgba(0,201,255,2556);  background: rgba(255,255,255, .8); overflow-y: scroll;">
                <form id="cambiarportada1" action="acciones/cambiarfondo.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="name" value="<?php echo $name; ?>">
                    <input type="hidden" name="portada-1" value="portada-1">
                    <img src="img/portada-1.png" alt="" style="width: 95%; margin-left: 3%; margin-top: 15px; border-radius: 5px;"><br>
                    <button onclick="miPortada1(); return false;" type="submit" style="width: 100px; margin-left: 40%; padding: 5px; border: none; background-color: rgba(0,201,255,2556); color:white; cursor: pointer;">Seleccionar</button>
                </form>
                <hr style="margin-left: 15px; width: 457px; margin-top: 10px; color: grey; opacity: 25%;">
                <form id="cambiarportada2" action="acciones/cambiarfondo.php" method="post" style="margin-top:15px;">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="name" value="<?php echo $name; ?>">
                    <input type="hidden" name="portada-2" value="portada-2">
                    <img src="img/portada-2.png" alt="" style="width: 95%; margin-left: 3%; border-radius: 5px;"><br>
                    <button onclick="miPortada2(); return false;" type="submit" style="width: 100px; margin-left: 40%; padding: 5px; border-radius: 5px; border: none; background-color:rgba(0,201,255,2556); color:white; cursor: pointer;">Seleccionar</button>
                </form>
                <hr style="margin-left: 15px; width: 457px; margin-top: 10px; color: grey; opacity: 25%;">
                <form id="cambiarportada3" action="acciones/cambiarfondo.php" method="post" style="margin-top:15px;">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="name" value="<?php echo $name; ?>">
                    <input type="hidden" name="portada-3" value="portada-3">
                    <img src="img/portada-3.png" alt="" style="width: 95%; margin-left: 3%; border-radius: 5px;"><br>
                    <button onclick="miPortada3(); return false;" type="submit" style="width: 100px; margin-left: 40%; padding: 5px; border-radius: 5px; border: none; background-color: rgba(0,201,255,2556); color:white; cursor: pointer;">Seleccionar</button>
                </form>
                <hr style="margin-left: 15px; width: 457px; margin-top: 10px; color: grey; opacity: 25%;">
                <form id="cambiarportada4" action="acciones/cambiarfondo.php" method="post" style="margin-top:15px;">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="name" value="<?php echo $name; ?>">
                    <input type="hidden" name="portada-4" value="portada-4">
                    <img src="img/portada-4.png" alt="" style="width: 95%; margin-left: 3%; border-radius: 5px;"><br>
                    <button onclick="miPortada4(); return false;" type="submit" style="width: 100px; margin-left: 40%; padding: 5px; border-radius: 5px; border: none; background-color: rgba(0,201,255,2556); color:white; cursor: pointer;">Seleccionar</button>
                </form>
                <hr style="margin-left: 15px; width: 457px; margin-top: 10px; color: grey; opacity: 25%;">
                <form id="cambiarportada5" action="acciones/cambiarfondo.php" method="post" style="margin-top:15px;">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="name" value="<?php echo $name; ?>">
                    <input type="hidden" name="portada-5" value="portada-5">
                    <img src="img/portada-5.png" alt="" style="width: 95%; margin-left: 3%; border-radius: 5px;"><br>
                    <button onclick="miPortada5(); return false;" type="submit" style="width: 100px; margin-left: 40%; padding: 5px; border-radius: 5px; border: none; background-color:rgba(0,201,255,2556); color:white; cursor: pointer;">Seleccionar</button>
                </form>
                <hr style="margin-left: 15px; width: 457px; margin-top: 10px; color: grey; opacity: 25%;">
                <form id="cambiarportada6" action="acciones/cambiarfondo.php" method="post" style="margin-top:15px;">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="name" value="<?php echo $name; ?>">
                    <input type="hidden" name="portada-6" value="portada-6">
                    <img src="img/portada-6.png" alt="" style="width: 95%; margin-left: 3%; "><br>
                    <button onclick="miPortada6(); return false;" type="submit" style="width: 100px; margin-left: 40%; padding: 5px; border-radius: 5px; border: none; background-color: rgba(0,201,255,2556); color:white; cursor: pointer;">Seleccionar</button>
                </form>
                <hr style="margin-left: 15px; width: 457px; margin-top: 10px; color: grey; opacity: 25%;">
                <form id="cambiarportada7" action="acciones/cambiarfondo.php" method="post" style="margin-top:15px;">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="name" value="<?php echo $name; ?>">
                    <input type="hidden" name="portada-7" value="portada-7">
                    <img src="img/portada-7.png" alt="" style="width: 95%; margin-left: 3%; "><br>
                    <button onclick="miPortada7(); return false;" type="submit" style="width: 100px; margin-left: 40%; padding: 5px; border-radius: 5px; border: none; background-color: rgba(0,201,255,2556); color:white; cursor: pointer;">Seleccionar</button>
                </form>
                <hr style="margin-left: 15px; width: 457px; margin-top: 10px; color: grey; opacity: 25%;">
                <form id="cambiarportada8" action="acciones/cambiarfondo.php" method="post" style="margin-top:15px; margin-bottom: 15px;">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="name" value="<?php echo $name; ?>">
                    <input type="hidden" name="portada-8" value="portada-8">
                    <img src="img/portada-8.png" alt="" style="width: 95%; margin-left: 3%;"><br>
                    <button onclick="miPortada8(); return false;" type="submit" style="width: 100px; margin-left: 40%; padding: 5px; border-radius: 5px; border: none; background-color:rgba(0,201,255,2556); color:white; cursor: pointer;">Seleccionar</button>
                </form>
            </div>
        </dialog>

        <script>
            const btnAbrirModalP = document.querySelector("#btn-abrir-modalP");
            const btnCerrarModalP = document.querySelector("#btn-cerrar-modalP");
            const modalP = document.querySelector("#modalP");
            btnAbrirModalP.addEventListener("click", () => {
                modalP.showModal();
            })

            btnCerrarModalP.addEventListener("click", () => {
                modalP.close();
            })
        </script>

        <script>
            function miPortada1() {
                modalP.close();
                Swal.fire({
                    title: '¡Excelente!',
                    text: 'Cambio de portada exitosa',
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Aceptar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('cambiarportada1').submit();
                    }
                });
            }

            function miPortada2() {
                modalP.close();
                Swal.fire({
                    title: '¡Excelente!',
                    text: 'Cambio de portada exitosa',
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Aceptar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('cambiarportada2').submit();
                    }
                });
            }

            function miPortada3() {
                modalP.close();
                Swal.fire({
                    title: '¡Excelente!',
                    text: 'Cambio de portada exitosa',
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Aceptar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('cambiarportada3').submit();
                    }
                });
            }

            function miPortada4() {
                modalP.close();
                Swal.fire({
                    title: '¡Excelente!',
                    text: 'Cambio de portada exitosa',
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Aceptar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('cambiarportada4').submit();
                    }
                });
            }

            function miPortada5() {
                modalP.close();
                Swal.fire({
                    title: '¡Excelente!',
                    text: 'Cambio de portada exitosa',
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Aceptar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('cambiarportada5').submit();
                    }
                });
            }

            function miPortada6() {
                modalP.close();
                Swal.fire({
                    title: '¡Excelente!',
                    text: 'Cambio de portada exitosa',
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Aceptar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('cambiarportada6').submit();
                    }
                });
            }

            function miPortada7() {
                modalP.close();
                Swal.fire({
                    title: '¡Excelente!',
                    text: 'Cambio de portada exitosa',
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Aceptar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('cambiarportada7').submit();
                    }
                });
            }

            function miPortada8() {
                modalP.close();
                Swal.fire({
                    title: '¡Excelente!',
                    text: 'Cambio de portada exitosa',
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Aceptar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('cambiarportada8').submit();
                    }
                });
            }
        </script>

        <dialog close id="modalFP" style="width:39%;border: none; border-radius: 10px;  border: 2px solid rgba(0,201,255,2556);margin-top: 170px; margin-left: 33%; background: url(img/fondoPerfil.png);">
            <button style="float: right; background-color: rgba(132, 196, 44, 0.6); padding-left: 7px; padding-right: 7px; padding-top: 6px; padding-bottom: 5px; scale: 110%; border-radius: 50%; outline: none; border: 0px; margin: 10px 10px; cursor: pointer;" id="btn-cerrar-modalFP"><i class="fas fa-close"></i></button><br>
            <div style="margin-left:5%; margin-bottom:2%; width: 90%; height: 40px;  border: 2px solid rgba(0,201,255,2556); border-radius: 10px; background: rgba(255,255,255, .8); display:flex; justify-content:center">
                <h4 style="display: block; width: 100%; font-size: 1.75em; margin-bottom: 0.5rem; text-align: center;">Avatar</h4>
            </div>
            <div class="portada" style="margin-left:5%;width: 90%; height: 300px;  border: 2px solid rgba(0,201,255,2556); border-radius: 10px; background: rgba(255,255,255, .8); overflow-y: scroll; display: flex; justify-content: space-between; flex-wrap:wrap">
                <div style="flex: 1 0 10px">
                    <form id="cambiaravatar1" action="acciones/cambiaravatar.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="name" value="<?php echo $name; ?>">
                        <input type="hidden" name="Mascota-Aerobot-01" value="Mascota-Aerobot-01">
                        <img src="img/Mascota-Aerobot-01.png" alt="" style="width: 100px; margin-left: 28px; margin-top: 10px; border-radius: 50%; border: rgba(61, 172, 244);"><br>
                        <button onclick="miAvatar1(); return false;" type="submit" style="width: 100px; margin-left: 27px; padding: 3px; border-radius: 5px; border: none; background-color: rgba(0,201,255,2556); color:white; cursor: pointer;" id="Mascota-Aerobot-01" name="Mascota-Aerobot-01">Seleccionar</button>
                    </form>
                    <hr style="margin-left: 20px; width: 115px; margin-top: 10px; color: grey; opacity: 20%;">
                    <form id="cambiaravatar2" action="acciones/cambiaravatar.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="name" value="<?php echo $name; ?>">
                        <input type="hidden" name="Mascota-Aerobot-02" value="Mascota-Aerobot-02">
                        <img src="img/Mascota-Aerobot-02.png" alt="" style="width: 100px; margin-left: 28px; margin-top: 10px; border-radius: 50%; border: rgba(61, 172, 244);"><br>
                        <button onclick="miAvatar2(); return false;" type="submit" style="width: 100px; margin-left: 27px; padding: 3px; border-radius: 5px; border: none; background-color: rgba(0,201,255,2556); color:white; cursor: pointer;" id="Mascota-Aerobot-02" name="Mascota-Aerobot-02">Seleccionar</button>
                    </form>
                    <hr style="margin-left: 20px; width: 115px; margin-top: 10px; color: grey; opacity: 20%;">
                    <form id="cambiaravatar3" action="acciones/cambiaravatar.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="name" value="<?php echo $name; ?>">
                        <input type="hidden" name="Mascota-Aerobot-03" value="Mascota-Aerobot-03">
                        <img src="img/Mascota-Aerobot-03.png" alt="" style="width: 100px; margin-left: 28px; margin-top: 10px; border-radius: 50%; border: rgba(61, 172, 244);"><br>
                        <button onclick="miAvatar3(); return false;" type="submit" style="width: 100px; margin-left: 27px; padding: 3px; border-radius: 5px; border: none; background-color: rgba(0,201,255,2556); color:white; cursor: pointer;" id="Mascota-Aerobot-03" name="Mascota-Aerobot-03">Seleccionar</button>
                    </form>
                </div>
                <div style="flex: 1 0 10px">
                    <form id="cambiaravatar4" action="acciones/cambiaravatar.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="name" value="<?php echo $name; ?>">
                        <input type="hidden" name="Mascota-Aerobot-04" value="Mascota-Aerobot-04">
                        <img src="img/Mascota-Aerobot-04.png" alt="" style="width: 100px; margin-left: 28px; margin-top: 10px; border-radius: 50%; border: rgba(61, 172, 244);"><br>
                        <button onclick="miAvatar4(); return false;" type="submit" style="width: 100px; margin-left: 27px; padding: 3px; border-radius: 5px; border: none; background-color: rgba(0,201,255,2556); color:white; cursor: pointer;" id="Mascota-Aerobot-04" name="Mascota-Aerobot-04">Seleccionar</button>
                    </form>
                    <hr style="margin-left: 10px; width: 115px; margin-top: 10px; color: grey; opacity: 20%;">
                    <form id="cambiaravatar5" action="acciones/cambiaravatar.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="name" value="<?php echo $name; ?>">
                        <input type="hidden" name="Mascota-Aerobot-05" value="Mascota-Aerobot-05">
                        <img src="img/Mascota-Aerobot-05.png" alt="" style="width: 100px; margin-left: 28px; margin-top: 10px; border-radius: 50%; border: rgba(61, 172, 244);"><br>
                        <button onclick="miAvatar5(); return false;" type="submit" style="width: 100px; margin-left: 27px; padding: 3px; border-radius: 5px; border: none; background-color: rgba(0,201,255,2556); color:white; cursor: pointer;" id="Mascota-Aerobot-05" name="Mascota-Aerobot-05">Seleccionar</button>
                    </form>
                    <hr style="margin-left: 10px; width: 115px; margin-top: 10px; color: grey; opacity: 20%;">
                    <form id="cambiaravatar6" action="acciones/cambiaravatar.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="name" value="<?php echo $name; ?>">
                        <input type="hidden" name="Mascota-Aerobot-06" value="Mascota-Aerobot-06">
                        <img src="img/Mascota-Aerobot-06.png" alt="" style="width: 100px; margin-left: 28px; margin-top: 10px; border-radius: 50%; border: rgba(61, 172, 244);"><br>
                        <button onclick="miAvatar6(); return false;" type="submit" style="width: 100px; margin-left: 27px; padding: 3px; border-radius: 5px; border: none; background-color:rgba(0,201,255,2556); color:white; cursor: pointer;" id="Mascota-Aerobot-06" name="Mascota-Aerobot-06">Seleccionar</button>
                    </form>
                </div>
                <div style="flex: 1 0 10px">
                    <form id="cambiaravatar7" action="acciones/cambiaravatar.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="name" value="<?php echo $name; ?>">
                        <input type="hidden" name="Mascota-Aerobot-07" value="Mascota-Aerobot-07">
                        <img src="img/Mascota-Aerobot-07.png" alt="" style="width: 100px; margin-left: 28px; margin-top: 10px; border-radius: 50%; border: rgba(61, 172, 244);"><br>
                        <button onclick="miAvatar7(); return false;" type="submit" style="width: 100px; margin-left: 27px; padding: 3px; border-radius: 5px; border: none; background-color: rgba(0,201,255,2556); color:white; cursor: pointer;" id="Mascota-Aerobot-07" name="Mascota-Aerobot-07">Seleccionar</button>
                    </form>
                    <hr style="margin-left: 10px; width: 115px; margin-top: 10px; color: grey; opacity: 20%;">
                    <form id="cambiaravatar8" action="acciones/cambiaravatar.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="name" value="<?php echo $name; ?>">
                        <input type="hidden" name="Mascota-Aerobot-08" value="Mascota-Aerobot-08">
                        <img src="img/Mascota-Aerobot-08.png" alt="" style="width: 100px; margin-left: 28px; margin-top: 10px; border-radius: 50%; border: rgba(61, 172, 244);"><br>
                        <button onclick="miAvatar8(); return false;" type="submit" style="width: 100px; margin-left: 27px; padding: 3px; border-radius: 5px; border: none; background-color: rgba(0,201,255,2556); color:white; cursor: pointer;" id="Mascota-Aerobot-08" name="Mascota-Aerobot-08">Seleccionar</button>
                    </form>
                    <hr style="margin-left: 10px; width: 115px; margin-top: 10px; color: grey; opacity: 20%;">
                    <form id="cambiaravatar9" action="acciones/cambiaravatar.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="name" value="<?php echo $name; ?>">
                        <input type="hidden" name="Mascota-Aerobot-09" value="Mascota-Aerobot-09">
                        <img src="img/Mascota-Aerobot-09.png" alt="" style="width: 100px; margin-left: 28px; margin-top: 10px; border-radius: 50%; border: rgba(61, 172, 244);"><br>

                        <button onclick="miAvatar9(); return false;" type="submit" style="width: 100px; margin-left: 27px; padding: 3px; border-radius: 5px; border: none; background-color:rgba(0,201,255,2556); color:white;" id="Mascota-Aerobot-09" name="Mascota-Aerobot-09">Seleccionar</button>


                    </form>

                    <hr style="margin-left: 10px; width: 115px; margin-top: 10px; color: grey; opacity: 20%;">
                </div>
            </div>
        </dialog>

        <script>
            const btnAbrirModalFO = document.querySelector("#btn-abrir-modalFO");
            const btnCerrarModalFO = document.querySelector("#btn-cerrar-modalFO");
            const modalFO = document.querySelector("#modalFO");
            btnAbrirModalFP.addEventListener("click", () => {
                modalFP.showModal();
            })

            btnCerrarModalFP.addEventListener("click", () => {
                modalFP.close();
            })
        </script>

        <script>
            const btnAbrirModalCN = document.querySelector("#btn-abrir-modalCN");
            const btnCerrarModalCN = document.querySelector("#btn-cerrar-modalCN");
            const modalCN = document.querySelector("#modalCN");
            btnAbrirModalCN.addEventListener("click", () => {
                modalCN.showModal();
            })

            btnCerrarModalCN.addEventListener("click", () => {
                modalCN.close();
            })
        </script>

        <script>
            const btnAbrirModalCC = document.querySelector("#btn-abrir-modalCC");
            const btnCerrarModalCC = document.querySelector("#btn-cerrar-modalCC");
            const modalCC = document.querySelector("#modalCC");
            btnAbrirModalCC.addEventListener("click", () => {
                modalCC.showModal();
            })

            btnCerrarModalCC.addEventListener("click", () => {
                modalCC.close();
            })
        </script>
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

        <script>
            function miAvatar1() {
                modalFP.close();
                Swal.fire({
                    title: '¡Excelente!',
                    text: 'Cambio de avatar exitoso',
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Aceptar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('cambiaravatar1').submit();
                    }
                });
            }

            function miAvatar2() {
                modalFP.close();
                Swal.fire({
                    title: '¡Excelente!',
                    text: 'Cambio de avatar exitoso',
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Aceptar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('cambiaravatar2').submit();
                    }
                });
            }

            function miAvatar3() {
                modalFP.close();
                Swal.fire({
                    title: '¡Excelente!',
                    text: 'Cambio de avatar exitoso',
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Aceptar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('cambiaravatar3').submit();
                    }
                });
            }

            function miAvatar4() {
                modalFP.close();
                Swal.fire({
                    title: '¡Excelente!',
                    text: 'Cambio de avatar exitoso',
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Aceptar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('cambiaravatar4').submit();
                    }
                });
            }

            function miAvatar5() {
                modalFP.close();
                Swal.fire({
                    title: '¡Excelente!',
                    text: 'Cambio de avatar exitoso',
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Aceptar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('cambiaravatar5').submit();
                    }
                });
            }

            function miAvatar6() {
                modalFP.close();
                Swal.fire({
                    title: '¡Excelente!',
                    text: 'Cambio de avatar exitoso',
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Aceptar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('cambiaravatar6').submit();
                    }
                });
            }

            function miAvatar7() {
                modalFP.close();
                Swal.fire({
                    title: '¡Excelente!',
                    text: 'Cambio de avatar exitoso',
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Aceptar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('cambiaravatar7').submit();
                    }
                });
            }

            function miAvatar8() {
                modalFP.close();
                Swal.fire({
                    title: '¡Excelente!',
                    text: 'Cambio de avatar exitoso',
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Aceptar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('cambiaravatar8').submit();
                    }
                });
            }

            function miAvatar9() {
                modalFP.close();
                Swal.fire({
                    title: '¡Excelente!',
                    text: 'Cambio de avatar exitoso',
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Aceptar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('cambiaravatar9').submit();
                    }
                });
            }
        </script>

        <?php
        if (isset($_POST['enviarnombre'])) {
            $idalumno = $_SESSION['id_alumno'];
            $nombre = $_POST['nombrealumno'];

            $sql_update = mysqli_query($conexion, "UPDATE alumnos_$rol SET nombre = '$nombre' WHERE id_alumno = '$idalumno'");

            if ($sql_update) {
                echo
                "
      <script>
      Swal.fire({
          title: 'Excelente!',
          text: 'Cambio de nombre exitoso',
          icon: 'success',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Aceptar',
        }).then((result) => {
          if (result.isConfirmed) {
              window.location.href = 'perfil.php';
          }
        });
      </script>
        ";
            } else {
                echo
                "
      <script>
      Swal.fire({
          title: '¡Advertencia!',
          text: 'Cambio de nombre no exitoso',
          icon: 'info',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Reintentar',
        }).then((result) => {
          if (result.isConfirmed) {
              window.location.href = 'perfil.php';
          }
        });
      </script>
        ";
            }
        }
        ?>

        <?php
        if (isset($_POST['enviarcontrasena'])) {
            $idalumno = $_SESSION['id_alumno'];
            $contrasena = md5($_POST['contrasena']);

            $sql_update = mysqli_query($conexion, "UPDATE alumnos_$rol SET contrasena = '$contrasena' WHERE id_alumno = '$idalumno'");

            if ($sql_update) {
                echo
                "
      <script>
      Swal.fire({
          title: 'Excelente!',
          text: 'Cambio de contraseña exitosa',
          icon: 'success',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Aceptar',
        }).then((result) => {
          if (result.isConfirmed) {
              window.location.href = 'perfil.php';
          }
        });
      </script>
        ";
            } else {
                echo
                "
      <script>
      Swal.fire({
          title: '¡Advertencia!',
          text: 'Cambio de contraseña no exitosa',
          icon: 'info',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Reintentar',
        }).then((result) => {
          if (result.isConfirmed) {
              window.location.href = 'perfil.php';
          }
        });
      </script>
        ";
            }
        }
        ?>

        <footer class="footerimga">
            <div class="imagen-footer">
                <img src="../img/benvenida.png" alt="No-image">
            </div>
        </footer>

        <?php
        if (isset($_POST['enviarclave'])) {
            $idalumno = $_SESSION['id_alumno'];
            $clavegrupo = $_POST['clavegrupo'];

            $data_alumno = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM grupos_$rol WHERE clave = '$clavegrupo'"));
            if (isset($data_alumno['id_grupo'])) {
                $id_grupo_alumno = $data_alumno['id_grupo'];
                $insertar_grupo = mysqli_query($conexion, "INSERT INTO detalle_grupos_$rol(id_alumno, id_grupo) VALUES ($idalumno, $id_grupo_alumno)");
            }
            if (isset($data_alumno['id_docente'])) {
                $id_docente_alumno = $data_alumno['id_docente'];
                $sql_update = mysqli_query($conexion, "UPDATE alumnos_$rol SET id_docente = $id_docente_alumno WHERE id_alumno = $idalumno");
            }

            if (isset($data_alumno['id_grupo'])) {
                $sql = "SELECT DISTINCT c.id_curso FROM grupos_$rol g JOIN detalle_grupo_cursos_$rol dg ON g.id_grupo = dg.id_grupo JOIN cursos_$rol c ON dg.id_curso = c.id_curso WHERE g.clave = '$clavegrupo'";
                $resultado = $conexion->query($sql);

                if ($resultado->num_rows > 0) {
                    // Itera sobre los resultados de la consulta SELECT y ejecuta una consulta INSERT para insertar cada registro en la tabla de destino
                    while ($fila = $resultado->fetch_assoc()) {
                        $idcurso = $fila["id_curso"];
                        $insertar_acceso_curso = "INSERT INTO acceso_cursos_$rol(id_curso, id_alumno) VALUES ('$idcurso', $idalumno)";
                        $conexion->query($insertar_acceso_curso);
                    }
                }
            }

            if ($insertar_grupo && $insertar_acceso_curso && $sql_update) {
                echo
                "
      <script>
      Swal.fire({
          title: 'Excelente!',
          text: 'Registro de grupo exitoso',
          icon: 'success',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Aceptar',
        }).then((result) => {
          if (result.isConfirmed) {
              window.location.href = 'perfil.php';
          }
        });
      </script>
        ";
            } else {
                echo
                "
      <script>
      Swal.fire({
          title: '¡Revisa bien tu clave!',
          text: 'Registro de grupo no exitoso',
          icon: 'info',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Reintentar',
        }).then((result) => {
          if (result.isConfirmed) {
              window.location.href = 'perfil.php';
          }
        });
      </script>
        ";
            }
        }
        ?>

</body>