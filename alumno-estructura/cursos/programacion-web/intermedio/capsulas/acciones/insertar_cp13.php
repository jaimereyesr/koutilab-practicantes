<!-- PERMISOS PARA PRACTICA -->
<?php
session_start();
$id_user = $_SESSION['id_alumno']; $rol = $_SESSION['rol'];
include('../../../../../../../acciones/conexion.php');
if (!$conexion) {
    die("Connection failed: " . mysqli_connect_error());
}

$pregunta = $_GET['validar'];
$permiso = $_GET['permiso'];
$id_curso = $_GET['id_curso'];
$puntos = $_GET['practico'];

//Verificar si ya se tiene permiso y no dar puntos de más
$sql_permisos = mysqli_query($conexion, "SELECT * FROM detalle_capsulas_preparatoria WHERE id_capsula = '$permiso' AND id_alumno = '$id_user' AND id_curso = '$id_curso'");
$result_sql_permisos = mysqli_num_rows($sql_permisos);

//Verificar si la pregunta es correcta
if ($pregunta != 'correcto') {
    header('location: ../contenido/practicas/cp7js.php');
}

if ($pregunta == 'correcto' && $result_sql_permisos <= 4) {
    //Datos permisos
    $insertarPermisos = mysqli_query($conexion, "INSERT INTO detalle_capsulas_preparatoria(id_alumno, id_capsula, id_curso) VALUES ($id_user, $permiso, $id_curso)");

    $query = "INSERT INTO detalle_estadisticas_preparatoria (progreso, practico, id_alumno, id_curso) VALUES ('2', $puntos, '$id_user', $id_curso)";
    $query_run = mysqli_query($conexion, $query);
    //Sumar trofeos
    $consultaEstadistica = mysqli_query($conexion, "SELECT trofeos, SUM(trofeos) AS total_trofeos, progreso, SUM(progreso) AS total_progreso, puntos, SUM(puntos) AS total_puntos, practico, SUM(practico) AS total_practico, teorico, SUM(teorico) AS total_teorico FROM detalle_estadisticas_preparatoria WHERE id_alumno = $id_user AND id_curso = '$id_curso'");
    $resultadoEstadistica = mysqli_fetch_assoc($consultaEstadistica);
    $totalTrofeos = $resultadoEstadistica['total_trofeos'];
    $totalProgreso = $resultadoEstadistica['total_progreso'];
    $totalPuntos = $resultadoEstadistica['total_puntos'];
    $totalPractico = $resultadoEstadistica['total_practico'];
    $totalTeorico = $resultadoEstadistica['total_teorico'];
    $insertarEstadisticas = mysqli_query($conexion, "UPDATE estadisticas_preparatoria SET trofeos = '$totalTrofeos', progreso = '$totalProgreso', puntos = '$totalPuntos', practico = '$totalPractico', teorico = '$totalTeorico' WHERE id_alumno = $id_user AND id_curso = '$id_curso'");

    if ($insertarPermisos && $insertarEstadisticas) {
        header('location: ../../../../../rutas/ruta-pw-i.php');
        exit();
    }
} else if ($pregunta == 'correcto' && $result_sql_permisos > 4) {
    header('location: ../../../../../rutas/ruta-pw-i.php');
}
