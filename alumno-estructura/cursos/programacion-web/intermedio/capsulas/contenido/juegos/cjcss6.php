 <?php
    session_start();
    $id_user = $_SESSION['id_alumno']; $rol = $_SESSION['rol'];
    if (empty($_SESSION['active']) || empty($_SESSION['id_alumno'])) {
        header('location: ../../../../../../../acciones/cerrarsesion.php');
    }
    include "../../../../../../../acciones/conexion.php";
    $id_user = $_SESSION['id_alumno']; $rol = $_SESSION['rol'];
    $permiso = "capsula20";
    $sql = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_$rol c INNER JOIN detalle_capsulas_$rol d ON c.id_capsula = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$permiso' AND d.id_curso = 2");
    $existe = mysqli_fetch_all($sql);
    if (empty($existe) && $id_user != 1) {
        header("Location: ../../../../basico/capsulas/acciones/capsulas.php");
    }

    //Verificar si ya se tiene permiso y no dar puntos de más
    $permiso_intento = 21;
    $sql_permisos = mysqli_query($conexion, "SELECT * FROM detalle_capsulas_$rol WHERE id_capsula = $permiso_intento AND id_alumno = '$id_user' AND id_curso = 2");
    $result_sql_permisos = mysqli_num_rows($sql_permisos);
    //Script para poder ver cuantos intentos lleva el alumno en la capsula y mostrar cuantos puntos gano dependiendo los intentos

    //Contar total de intentos
    $consultaIntentos = mysqli_query($conexion, "SELECT intentos FROM detalle_intentos_$rol WHERE id_capsula = $permiso_intento AND id_alumno = $id_user AND id_curso = 2");
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
 <html lang="es">

 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="../../css/css-juegos/copy-code.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <title>KOUTILAB</title>
     <link rel="shortcut icon" href="../../../../../../img/lgk.png" />
 </head>

 <body onload="iniciarTiempo()">
     <!-- Timer -->
     <div class="timer" id="timer">
         <b>Tiempo: <br>
             <p id="tiempo" style="margin: 0 0 0 0;"></p>
         </b>
     </div>
     <!-- Titulo general del juego -->
     <div class="titulo-gen">
         <h2 class="titulo"><b>ANIMACIONES</b></h2>
     </div>

     <!-- Contenedor principal -->
     <section>

         <!-- Boton para regresar -->
         <div class="cont-st">
             <a href="../../../../../../rutas/ruta-pw-i-<?php echo $rol; ?>.php">
                 <button class="btn-b">
                     <i class="fas fa-reply"></i>
                 </button>
             </a>
             <h4 class="titulo"><b>Copia el código de ejemplo de la izquierda a la derecha antes de que termine el tiempo</b></h4>
         </div>
         <!-- Parte que modifique Final -->
         <br>

         <!--CONTENEDOR DEL JUEGO-->
         <div class="mjuego">

             <!--EJEMPLO DE CODIGO-->
             <div class="ejemplo">


                 <p id="textoej">
                 </p>
             </div>

             <!--CCUADRO DE TEXTO DONDE SE COPIARA EL CODIGO-->
             <div class="copia">
                 <textarea id="escrito" oncontextmenu="return false"></textarea>
             </div>

         </div>


         <!-- boton de verificar respuestas -->
         <button class="verificar" onClick="alertExcelent()">Comprobar respuestas</button>
     </section>


     <footer class="footerimga">
         <div class="imagen-footer">
             <img src="../../img/img-juegos/benvenida.png" alt="No-image">
         </div>
     </footer>
     <script>
         var puntos = <?php echo $puntosGanados; ?>
     </script>
     <script src="../../js/copy-code-3.js"></script>
 </body>

 </html>