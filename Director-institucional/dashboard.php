<?php
session_start();
$id_user = $_SESSION['id_director'];
if (empty($_SESSION['active']) || empty($_SESSION['id_director'])) {
  header('location: ../../acciones/cerrarsesion.php');
}
include('../acciones/conexion.php');

$user = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM director_institucional WHERE id_director = '$id_user'"));

//obtener datos d la escuela
$clave = $user["clave"];
$user_escuela = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM escuelas WHERE clave_director = '$clave'"));

/* PARA LOS DATOS DE LA GRÁFICA */
if (isset($_POST['submitFecha'])) {
  //echo "La fecha de inicio fue: " . $_POST['fechaInicio'];
  if (isset($_POST['fechaFin'])) {
    //echo "La fecha de Fin fue: " . $_POST['fechaFin'];
    //echo "El id de usuario es :" . $_POST['id_user'];
    $fechaInicio = $_POST['fechaInicio'];
    $fechaFin = $_POST['fechaFin'];

    $consulta = "SELECT SUM(payment_amount * 0.1) as total, DATE_FORMAT(pp.create_at,'%M %Y') as mes from payment_institucional as pp INNER JOIN temp_account as t ON pp.id = t.id INNER JOIN director_institucional as dp ON t.id_escuela = dp.id_escuela WHERE dp.id_director = '$id_user' AND create_at BETWEEN '$fechaInicio' and '$fechaFin' GROUP BY(mes) ORDER BY (mes)DESC";
  }
} else {

  // Consulta para obtener los datos de ganancias
  $consulta = "SELECT SUM(payment_amount * 0.1) as total, DATE_FORMAT(pp.create_at,'%M %Y') as mes from payment_institucional as pp INNER JOIN temp_account as ap ON pp.id = ap.id INNER JOIN director_institucional as dp ON ap.id_escuela = dp.id_escuela WHERE dp.id_director = '$id_user' GROUP BY(mes) ORDER BY (mes)DESC";
}


// Ejecutar la consulta
$resultado = $conexion->query($consulta);

// Crear un arreglo para almacenar los datos
$datos = array();

// Recorrer los resultados y almacenarlos en el arreglo
while ($fila = $resultado->fetch_assoc()) {
  $datos[] = $fila;
}

// Cerrar la conexión a la base de datos
//$conexion->close();

// Crear un arreglo para almacenar las ganancias por mes
$gananciasPorMes = array();

// Recorrer los datos y agrupar las ganancias por mes
foreach ($datos as $dato) {
  $fecha = strtotime($dato['mes']);
  $mes = date('Y-m', $fecha);
  $monto = floatval($dato['total']);

  if (isset($gananciasPorMes[$mes])) {
    $gananciasPorMes[$mes] += $monto;
  } else {
    $gananciasPorMes[$mes] = $monto;
  }
}

// Crear un arreglo para almacenar los datos de la gráfica
$datosGrafica = array();

// Recorrer las ganancias por mes y generar los datos para la gráfica
foreach ($gananciasPorMes as $mes => $ganancia) {
  // Obtener el nombre del mes y año a partir del formato Y-m
  $nombreMes = date('F Y', strtotime($mes));
  $datosGrafica[] = array(
    'label' => $nombreMes,
    'data' => $ganancia
  );
}

// Convertir los datos a formato JSON
$datosJSON = json_encode($datosGrafica);
//echo "Datos recuperados de la bd" . $datosJSON;

?>
<?php
function actualizarGrafica()
{
  $id_user = $_POST['id_user'];
  $fechaInicio = $_POST['fechaInicio'];
  $fechaFin = $_POST['fechaFin'];

  /* PARA LOS DATOS DE LA GRÁFICA */

  include('../acciones/conexion.php');


  // Verificar si hay errores en la conexión
  if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
  }

  // Consulta para obtener los datos de ganancias
  $consulta = "SELECT SUM(payment_amount * 0.1) as total, DATE_FORMAT(create_at,'%M %Y') as mes from payment_primaria as pp INNER JOIN alumnos_primaria as ap ON pp.id_alumno = ap.id_alumno INNER JOIN directores_primaria as dp ON ap.id_escuela = dp.id_escuela WHERE dp.id_director = '$id_user' AND create_at BETWEEN '.$fechaInicio.' and '.$fechaFin.' GROUP BY(mes) ORDER BY (mes)DESC";
  // Ejecutar la consulta
  $resultado = $conexion->query($consulta);

  // Crear un arreglo para almacenar los datos
  $datos = array();

  // Recorrer los resultados y almacenarlos en el arreglo
  while ($fila = $resultado->fetch_assoc()) {
    $datos[] = $fila;
  }

  // Cerrar la conexión a la base de datos
  //  $conexion->close();

  // Crear un arreglo para almacenar las ganancias por mes
  $gananciasPorMes = array();

  // Recorrer los datos y agrupar las ganancias por mes
  foreach ($datos as $dato) {
    $fecha = strtotime($dato['mes']);
    $mes = date('Y-m', $fecha);
    $monto = floatval($dato['total']);

    if (isset($gananciasPorMes[$mes])) {
      $gananciasPorMes[$mes] += $monto;
    } else {
      $gananciasPorMes[$mes] = $monto;
    }
  }

  // Crear un arreglo para almacenar los datos de la gráfica
  $datosGrafica = array();

  // Recorrer las ganancias por mes y generar los datos para la gráfica
  foreach ($gananciasPorMes as $mes => $ganancia) {
    // Obtener el nombre del mes y año a partir del formato Y-m
    $nombreMes = date('F Y', strtotime($mes));
    $datosGrafica[] = array(
      'label' => $nombreMes,
      'data' => $ganancia
    );
  }

  // Convertir los datos a formato JSON
  $datosJSON = json_encode($datosGrafica);
}
?>

<!DOCTYPE html>
<html lang="en">

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/nav-barra.css">
<link rel="stylesheet" href="css/dashboard.css">
<link rel="stylesheet" href="css/footer.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/dataTables.bulma.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap4.min.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<title>KOUTILAB</title>
</head>

<body>

  <!-- Header nav -->
  <?php
  $id = $user["id_director"];
  $name = $user["nombre"];
  $image = $user["image"];
  ?>
  <?php include 'header-nav.php'; ?>

  <div class="containers">
    <h1 class="titulos">DASHBOARD</h1>
  </div>

  <section>
    <div class="left-content">
      <div class="titlec">
        <h2 class="subtitulos">Usuario</h2>
      </div>
      <!--<br>COMENTADO TEMPORALMENTE-->
      <form class="form" id="form" action="" enctype="multipart/form-data" method="post">
        <div class="perfil-usuario-avatar">
          <div class="avatar-img">
            <img src="img/<?php echo $image; ?>" id="imgchange1">
          </div>

          <div class="camera-icon">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="name" value="<?php echo $name; ?>">
            <input type="file" style="cursor: pointer;" name="image" id="image" class="" accept=".jpg, .jpeg, .png">
            <i class="fa fa-camera" style="color: white; font-size:30px;"></i>
          </div>

      </form>
    </div>
    <hr style="background-color: lightgray; width:60%; height:2px; margin-left:20%; margin-top:4%">

      <div class="container-info">
        <?php
        $data2 = mysqli_query($conexion, "SELECT * FROM director_institucional d INNER JOIN escuelas e WHERE d.id_escuela = e.id_escuela AND id_director = '$id_user'");
        while ($consulta = mysqli_fetch_array($data2)) {
          echo "  <h3 class='info-heading'>Nombre: <span>" . $consulta['nombre'] . "</span></h3>";
          echo "  <h3 class='info-heading'>Usuario: <span>" . $consulta['usuario'] . "</span></h3>";
          echo "  <h3 class='info-heading'>Escuela: <span>" . $consulta['nombre_escuela'] . "</span></h3>";
        }
        ?>
      </div>

      <hr class="hr2" style="background-color: lightgray; width:60%; height:2px; margin-left:20%; margin-top:-48%;">

      <div class="change-password">
      <h3>Contraseña:</h3>
      <form enctype="multipart/form-data" action="" method="post">
        <div class="user-details1">
          <div class="input-box1">
            <input type="text" name="contrasena" value="" placeholder="Nueva contraseña">
            <input type="submit" name="enviarcontrasena" value="Actualizar" class="btn-grd">
          </div>
        </div>
      </form>
    </div>

    </div>

    <div class="right-content">
      <div class="titlec">
        <h2 class="subtitulos">Datos de compras</h2>
      </div>
      <div class="latd">
      <div class="tabla-ingr">
        <table id="ingresos1" class="table">
          <thead>
            <tr>
              <td><b>Fecha</b></td>
              <td><b>Total ganancias</b></td>
            </tr>
          </thead>
          <tbody>
            <?php
            include "../acciones/conexion.php";

            $query_escuelas = mysqli_query($conexion, "SELECT
            SUM(payment_amount * 0.1) AS total,
            DATE_FORMAT(create_at, '%M %Y') AS mes
          FROM
            payment_primaria AS pp
          INNER JOIN
            alumnos_primaria AS ap ON pp.id_alumno = ap.id_alumno
          INNER JOIN
            directores_primaria AS dp ON ap.id_escuela = dp.id_escuela
          WHERE
            dp.id_director = '$id_user'
          GROUP BY
            YEAR(create_at), MONTH(create_at)
          ORDER BY
            YEAR(create_at) DESC, MONTH(create_at) DESC;
          ");
            $result = mysqli_num_rows($query_escuelas);
            if ($result > 0) {
              while ($data = mysqli_fetch_assoc($query_escuelas)) {

            ?>
                <tr>
                  <td><?php echo $data['mes']; ?></td>
                  <td><?php echo $data['total']; ?></td>
                </tr>
            <?php }
            } ?>
          </tbody>
        </table>
      </div>

      <div id="graficaContainer">
        <canvas id="grafica"></canvas>
      </div>

      <script>
        document.addEventListener('DOMContentLoaded', function() {
          // Código de inicialización de la gráfica
          console.log(<?php echo $datosJSON; ?>);
          // Obtener el elemento canvas
          var canvas = document.getElementById('grafica');

          // Obtener los datos JSON y procesarlos
          var datosJSON = JSON.parse('<?php echo $datosJSON; ?>');
          var labels = datosJSON.map(function(dato) {
            return dato.label;
          });
          var datos = datosJSON.map(function(dato) {
            return dato.data;
          });

          // Crear la instancia de la gráfica
          var grafica = new Chart(canvas, {
            type: 'bar',
            data: {
              labels: labels,
              datasets: [{
                label: 'Ganancias',
                data: datos,
                //backgroundColor: 'rgba(54, 162, 235, 0.5)', // Cambia el color de fondo
                //borderColor: 'rgba(54, 162, 235, 1)', // Cambia el color del borde
                //borderWidth: 1, // Cambia el ancho del borde
                backgroundColor: [
                  'rgba(255,99,132,0.2)',
                  'rgba(54,162,235,0.2)',
                  'rgba(255,206,86,0.2)',
                  'rgba(75,192,192,0.2)',
                  'rgba(255,159,64,0.2)'
                ],
                borderColor: [
                  'rgba(255,99,132,1)',
                  'rgba(54,162,235,1)',
                  'rgba(255,206,86,1)',
                  'rgba(75,192,192,1)',
                  'rgba(255,159,64,1)'
                ],
                borderWidth: 1.5
              }]
            },
            options: {
              responsive: true,
              scales: {
                y: {
                  beginAtZero: true
                }
              }
            }
          });
        });
      </script>
      <div align="center">
          <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <h4>Filtro </h4><br>
            <label for="fechaInicio" style="font-size: 13px; font-weight:bold;">De: </label>
            <input type="date" name="fechaInicio" id="fechaInicio" value="<?php echo $fechaInicio; ?>" style="margin-right: 50px; border: 1px solid rgba(0,201,255,2556); padding: 3px; border-radius: 5px; color: rgba(0,201,255,2556); " required>
            <label for="fechaFin" style="font-size: 13px; font-weight:bold;">A: </label>
            <input type="date" name="fechaFin" id="fechaFin" value="<?php echo $fechaFin; ?>" style="border: 1px solid rgba(0,201,255,2556); padding: 3px; border-radius: 5px; color: rgba(0,201,255,2556); " required>
            <input type="hidden" name="id_user" name="id_user" value="<?php echo $id_user; ?>">
            <br><br>
            <input name="submitFecha" type="submit" value="Filtrar" style="border: 1px solid rgba(0,201,255,2556); padding: 3px; border-radius: 5px; color: rgba(0,201,255,2556); font-weight: bold; font-size: 15px">
          </form>
        </div>
      </div>
      
    </div>
  </section>

  <?php include 'footer.php'; ?>

  <dialog close id="modalFP" style="border: none; border-radius: 10px; margin-top: 80px; margin-left: 370px; background: url(img/bg1.png); text-align: center;">
    <button style="float: right; background-color: rgba(132, 196, 44, 0.6); padding-left: 7px; padding-right: 7px; padding-top: 6px; padding-bottom: 5px; scale: 110%; border-radius: 50%; outline: none; border: 0px; margin: 10px 10px;" id="btn-cerrar-modalFP"><i class="fas fa-close"></i></button><br>
    <div style="color:darkslategray; width: 500px; height: 40px; margin: 10px 30px 10px 30px; box-shadow: 0 0 12px rgba(61,172,244,.6); border-radius: 10px; background: rgba(255,255,255, .8);">
      <h4 style="display: block; width: 100%; font-size: 1.75em; margin-bottom: 0.5rem; text-align: center;">Selecciona una imagen</h4>
    </div>
    <div class="portada" style="width: 500px; height: 300px; margin: 0px 30px 30px 30px; box-shadow: 0 0 12px rgba(61,172,244,.6); border-radius: 10px; background: rgba(255,255,255, .8); overflow-y: scroll; display: flex; justify-content: space-between;">
      <div class="upload-img">
        <form id="cambiaravatar" method="post" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?php echo $id; ?>">
          <input type="hidden" name="name" value="<?php echo $name; ?>">
          <input type="file" name="image" id="image" style="margin-left: 20%;">
          <button type="submit" style="width: 150px; margin-left: 27px; border: none; background-color: #85c32e; color:white; font-size: 15px;" id="cambiarFoto" name="cambiarFoto">Actualizar Foto</button>
        </form>
      </div>
    </div>
  </dialog>

  <!-- Cambiar foto de perfil -->
  <script type="text/javascript">
    document.getElementById("image").onchange = function() {
      document.getElementById("form").submit();
    };
  </script>
  <?php
  if (isset($_FILES["image"]["name"])) { /*Si el archivo existe */
    $id = $_POST["id"];
    $name = $_POST["name"];

    $imageName = $_FILES["image"]["name"]; //Nombre de la imagen
    $imageSize = $_FILES["image"]["size"]; //Tamaño de la imagen
    $tmpName = $_FILES["image"]["tmp_name"]; //Nombre temporal

    // Validación de la imagen
    $validImageExtension = ['jpg', 'jpeg', 'png', 'avif', 'webp']; //Extensiones válidas
    $imageExtension = explode('.', $imageName); //array - nombre de imagen
    $imageExtension = strtolower(end($imageExtension)); //conversión a minúsculas para validación
    if (!in_array($imageExtension, $validImageExtension)) {
      echo
      "
        <script>
        Swal.fire({
            title: '¡Advertencia!',
            text: 'Extensión de imagen inválida.',
            icon: 'info',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Reintentar',
          }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'dashboard.php';
            }
          });
        </script>
        ";
    } else if ($imageSize > 1200000) { //Si la imagen supera 1.2Mb
      echo
      "
        <script>
        Swal.fire({
            title: '¡Advertencia!',
            text: 'Tamaño de imagen demasiado largo.',
            icon: 'info',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Reintentar',
          }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'dashboard.php';
            }
          });
          
        </script> 
        ";
    } else { //Si se cumplen las condiciones
      $newImageName = $name . " - " . date("Y.m.d") . " - " . date("h.i.sa"); // Generando nuevo nombre de imagen
      $newImageName .= '.' . $imageExtension; //agregando extensión
      $query = "UPDATE director_institucional SET image = '$newImageName' WHERE id_director = $id_user"; //Actualizando imagen en BD
      mysqli_query($conexion, $query); //Ejecutando
      move_uploaded_file($tmpName, 'img/' . $newImageName); //añadiendo archivo al direcctorio indicado
      echo
      "
        <script> 
        Swal.fire({
            title: '¡Excelente!',
            text: 'Cambio de avatar exitoso.',
            icon: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar',
          }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'dashboard.php';
            }
          });
        </script>
        ";
    }
  }
  ?>

  <?php
  if (isset($_POST['enviarcontrasena'])) {
    $iddirector = $_SESSION['id_director'];
    $contrasena = md5($_POST['contrasena']);

    $sql_update = mysqli_query($conexion, "UPDATE director_institucional SET contrasena = '$contrasena' WHERE id_director = '$iddirector'");

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
              window.location.href = 'dashboard.php';
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
              window.location.href = 'dashboard.php';
          }
        });
      </script>
        ";
    }
  }
  ?>
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

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.2/js/dataTables.bulma.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap4.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>
    $(document).ready(function() {
      $('#ingresos1').DataTable({
        responsive: true,
        autoWidth: false,
        language: {
          url: 'https://cdn.datatables.net/plug-ins/1.13.2/i18n/es-MX.json'
        },
      lengthMenu: [
        [5, 10],
        [5, 10]
      ]
      });
    });
  </script>

</body>

</html>