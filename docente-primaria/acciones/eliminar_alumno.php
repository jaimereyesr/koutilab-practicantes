<?php
session_start();
require("../../acciones/conexion.php");
$id_user = $_SESSION['id_docente_primaria'];

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $query_delete = mysqli_query($conexion, "UPDATE alumnos_primaria SET estado = 0 WHERE id_alumno = $id");
    mysqli_close($conexion);
    header("Location: ../../docente-primaria/alumnos.php");
}
