<!-- Permisos para BIENVENIDA -->
<?php
session_start();
$$id_user = $_SESSION['id_alumno']; $rol = $_SESSION['rol'];
include('../../../../../../../acciones/conexion.php');
if (!$conexion) {
    die("Connection failed: " . mysqli_connect_error());
}

//Datos permisos
$permiso = $_POST['permiso'];
$id_curso = $_POST['id_curso'];
$insertarPermisos = mysqli_query($conexion, "INSERT INTO detalle_capsulas_$rol(id_alumno, id_capsula, id_curso) VALUES ($id_user, $permiso, $id_curso)");

if ($insertarPermisos) {
    header('location: ../../../../../rutas/ruta-in-a-<?php echo $rol; ?>.php');
    exit();
}
