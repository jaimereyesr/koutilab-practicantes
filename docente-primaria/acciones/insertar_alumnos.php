<?php

include('../../acciones/conexion.php');
session_start();

//Datos grupo
$nombre_escuela = $_POST['nombre_escuela'];
$nombre_docente = $_POST['nombre_docente'];
$nivel_educativo = $_POST['nivel_educativo'];
$nombre_grupo = $_POST['nombre_grupo'];
$grado_escolar = $_POST['grado_escolar'];
$nombre = $_POST['nombre'];
$nombre_grupo = $_POST['nombre_grupo'];
$usuario = $_POST['usuario'];
$contrasena = md5($_POST['contrasena']);
$clave = $_POST['clave'];
$acceso_curso = $_POST['acceso_curso'];
$cct = $_POST['cct'];
$id_escuela = $_POST['id_escuela'];
$id_docente = $_POST['id_docente'];

$id_user = $_SESSION['id_docente_primaria'];

$consulta_curso = mysqli_query($conexion, "SELECT * FROM grupos WHERE nombre_grupo = '$nombre_grupo'");
$resultadoCurso = mysqli_fetch_assoc($consulta_curso);
$nombregrupo = $resultadoCurso['id_grupo'];
$accesoCurso = $resultadoCurso['curso'];

$insertar_alumno = mysqli_query($conexion, "INSERT INTO alumnos(
  nombre, usuario, contrasena, clave, nivel_educativo, 
  grado_escolar, nombre_grupo, id_escuela, id_docente, image, fondo) VALUES (
    '$nombre', '$usuario', '$contrasena', '$clave', '$nivel_educativo', '$grado_escolar', 
    '$nombre_grupo', '$id_escuela', '$id_docente', 'Mascota-Aerobot-01.png', 'portada-1.png')");



$consulta_alumno = mysqli_query($conexion, "SELECT id_alumno FROM alumnos WHERE usuario = '$usuario'");
$resultadoAlumno = mysqli_fetch_assoc($consulta_alumno);
$idalumno = $resultadoAlumno['id_alumno'];

$insertar_grupo = mysqli_query($conexion, "INSERT INTO detalle_grupos(id_alumno, id_grupo) VALUES ('$idalumno', '$nombregrupo')");

$insertar_acceso_curso = mysqli_query($conexion, "INSERT INTO acceso_cursos(curso, id_alumno) VALUES ('$accesoCurso', '$idalumno')");

$insertar_clave = mysqli_query($conexion, "INSERT INTO roles(clave, rol) VALUES ('$clave', '2')");


if ($insertar_alumno && $insertar_grupo && $insertar_acceso_curso) {
  $alert = '<div class="alert alert-primary" role="alert">
                         Alumno registrado
                      </div>';
  header("Location: ../../docente-primaria/alumnos.php");
}
