<?php
session_start();
$id_user = $_SESSION['id_alumno']; $rol = $_SESSION['rol'];
if (empty($_SESSION['active']) || empty($_SESSION['id_alumno'])) {
	header('location: ../../../../../../../acciones/cerrarsesion.php');
}
include "../../../../../../../acciones/conexion.php";
$id_user = $_SESSION['id_alumno']; $rol = $_SESSION['rol'];
$permiso = "capsulapago5";
$sql = mysqli_query($conexion, "SELECT c.*, d.* FROM capsulas_pago_$rol c INNER JOIN detalle_capsulas_pago_$rol d ON c.id_capsula_pago = d.id_capsula WHERE d.id_alumno = $id_user AND c.nombre = '$permiso' AND d.id_curso = 10;");
$existe = mysqli_fetch_all($sql);
if (empty($existe)) {
	header("Location: ../../../../basico/capsulas/contenido/alertas/paquete_premium5.php");
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/css-juegos/select-ans-1.css">
    <link rel="stylesheet" href="../../css/css-juegos/select-ans-2.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>KOUTILAB</title>
</head>

<body onload="iniciarTiempo(), iniciar() ">
    <!-- CAMBIOS -->
    <!-- Timer -->
    <div class="timer">
        <b>Tiempo: <br>
            <p id="tiempo" style="margin: 0 0 0 0;"></p>
        </b>
    </div>

    <!-- Titulo general -->
    <div class="titulo-gen">
        <h2 class="titulo"><b>SELECCIÓN DE RESPUESTA PARA UN ENUNCIADO</b></h2>
    </div>

    <!-- Contenedor principal -->
    <div class="contenido">
        <div class="cont-st">
            <a href="#" onclick="history.back();">
                <button class="btn-b">
                    <i class="fas fa-reply"></i>
                </button>
            </a>
            <h4 class="titulo"><b>Responde correctamente una serie de preguntas, pierdes si se acaba el
                    tiempo o responde mal</b></h4>
        </div>

        <!-- Tenoch Moises -->
        <!--contenedor principal-->
        <div class="contenedor">
            <!--para mostrar la puntuacion-->
            <div class="puntaje" id="puntaje"></div>
            <!--es el encabezado donde se muestra la categoria, numero, pregunta e imagen-->
            <div class="encabezado">
                <!--es opcional la parte de mostrar categoria y esta implementado para funcionar sin ella tambien-->
                <div class="categoria" id="categoria"></div>
                <!--No se muestra en la pantalla pero permite que se generen las preguntas "NO MOVER" -->
                <div class="numero" id="numero"></div>
                <!--es donde se muestra la pregunta-->
                <h3><b>
                        <div class="pregunta" id="pregunta">
                        </div>
                    </b></h3>
                <!--muestra una imagen ilustrativa para dar pista de la respuesta pero igual es implementado para  funcionar sin la imagen-->
                <img src="#" class="imagen" id="imagen">
            </div>
            <!--Funcionan con un "onclick" y solo tiene una respuesta correcta-->

            <div class="btn" id="btn1" onclick="oprimir_btn(0)"></div>
            <div class="btn" id="btn2" onclick="oprimir_btn(1)"></div>
            <div class="btn" id="btn3" onclick="oprimir_btn(2)"></div>
            <div class="btn" id="btn4" onclick="oprimir_btn(3)"></div>
            <!--script donde se le da funcionalidad al juego-->
            <script>
                /* Ambos */
                let preguntas_aleatorias = true;
                let mostrar_pantalla_juego_términado = true;
                let reiniciar_puntos_al_reiniciar_el_juego = true;
                //sirve para que al inicial la pagina que cargen las preguntas guardadas en el archivo json
                function iniciar() {
                    base_preguntas = readText("../../js/base-preguntas-2.json");
                    interprete_bp = JSON.parse(base_preguntas);
                    escogerPreguntaAleatoria();
                };

                let pregunta;
                let posibles_respuestas;
                btn_correspondiente = [
                    select_id("btn1"),
                    select_id("btn2"),
                    select_id("btn3"),
                    select_id("btn4")
                ];
                let npreguntas = [];

                let preguntas_hechas = 0;
                let preguntas_correctas = 0;

                function escogerPreguntaAleatoria() {
                    let n;
                    if (preguntas_aleatorias) {
                        n = Math.floor(Math.random() * interprete_bp.length);
                    } else {
                        n = 0;
                    }

                    while (npreguntas.includes(n)) {
                        n++;
                        if (n >= interprete_bp.length) {
                            n = 0;
                        }
                        if (npreguntas.length == interprete_bp.length) {
                            //Aquí es donde el juego se reinicia
                            if (mostrar_pantalla_juego_términado) {
                                swal.fire({
                                    title: "Juego finalizado",
                                    text: "Puntuación: " + preguntas_correctas + "/" + "5", //preguntas_hechas
                                    icon: "success",
                                    confirmButtonText: '¡Genial!'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        alertExcelent();
                                    }
                                });
                            }
                            if (reiniciar_puntos_al_reiniciar_el_juego) {
                                preguntas_correctas = 0
                                preguntas_hechas = 0
                            }
                            npreguntas = [];
                        }
                    }
                    npreguntas.push(n);
                    preguntas_hechas++;

                    escogerPregunta(n);
                }


                function escogerPregunta(n) {
                    pregunta = interprete_bp[n];
                    select_id("categoria").innerHTML = pregunta.categoria;
                    select_id("pregunta").innerHTML = pregunta.pregunta;
                    select_id("numero").innerHTML = n;
                    let pc = preguntas_correctas;
                    if (preguntas_hechas > 1) {
                        select_id("puntaje").innerHTML = pc + "/" + "5";
                    } else {
                        select_id("puntaje").innerHTML = "";
                    }

                    style("imagen").objectFit = pregunta.objectFit;
                    desordenarRespuestas(pregunta);
                    if (pregunta.imagen) {
                        select_id("imagen").setAttribute("src", pregunta.imagen);
                        style("imagen").height = "200px";
                        style("imagen").width = "100%";
                    } else {
                        style("imagen").height = "0px";
                        style("imagen").width = "0px";
                        setTimeout(() => {
                            select_id("imagen").setAttribute("src", "");
                        }, 500);
                    }
                }

                function desordenarRespuestas(pregunta) {
                    posibles_respuestas = [
                        pregunta.respuesta,
                        pregunta.incorrecta1,
                        pregunta.incorrecta2,
                        pregunta.incorrecta3,
                    ];
                    posibles_respuestas.sort(() => Math.random() - 0.5);

                    select_id("btn1").innerHTML = posibles_respuestas[0];
                    select_id("btn2").innerHTML = posibles_respuestas[1];
                    select_id("btn3").innerHTML = posibles_respuestas[2];
                    select_id("btn4").innerHTML = posibles_respuestas[3];
                }

                let suspender_botones = false;

                function oprimir_btn(i) {
                    if (suspender_botones) {
                        return;
                    }
                    suspender_botones = true;
                    if (posibles_respuestas[i] == pregunta.respuesta) {
                        preguntas_correctas++;
                        btn_correspondiente[i].style.background = "#85c42caf";
                    } else {
                        btn_correspondiente[i].style.background = "red";
                    }
                    for (let j = 0; j < 4; j++) {
                        if (posibles_respuestas[j] == pregunta.respuesta) {
                            btn_correspondiente[j].style.background = "#85c42caf";
                            break;
                        }
                    }
                    setTimeout(() => {
                        reiniciar();
                        suspender_botones = false;
                    }, 1000);
                }

                // let p = prompt("numero")

                function reiniciar() {
                    for (const btn of btn_correspondiente) {
                        btn.style.background = "rgba(61, 172, 244, 0.7)";
                    }
                    escogerPreguntaAleatoria();
                }
                //sirve para seleccionar un objeto segun su ID
                function select_id(id) {
                    return document.getElementById(id);
                }
                //sirve para seleccionar el estilo segun su ID
                function style(id) {
                    return select_id(id).style;
                }
                //sirve para leer rutas de texto local que en este caso serian las preguntas que estan en el archivo "base-preguntas.json"
                function readText(ruta_local) {
                    var texto = null;
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.open("GET", ruta_local, false);
                    xmlhttp.send();
                    if (xmlhttp.status == 200) {
                        texto = xmlhttp.responseText;
                    }
                    return texto;
                }
                /* Ambos */
            </script>
        </div>
        <!-- boton de verificar respuestas-->
        <!-- NOTA: SE MANDO A LLAMAR LA FUNCION "marcador()" DONDE SE LLEVA LA PUNTUACION
            EN ESA FUNCION SE MANDA A LLAMAR LA FUNCION ORIGINAL "alertExcelent()" -->
        <!-- <button class="verificar" onclick="marcador()  ">Finalizar</button> -->
    </div>
    <!-- Tenoch Moises -->

    <!-- CAMBIOS -->
    <footer class="footerimga">
        <div class="imagen-footer">
            <img src="../../img/img-juegos/benvenida.png" alt="No-image">
        </div>
    </footer>
    <!-- fIN CAMBIOS -->

    <script>
        //ambos
        //funciona para mostrar el resultado al presionar el boton "comprobar respuestas"
        function marcador() {
            if (mostrar_pantalla_juego_términado) {
                swal.fire({
                    title: "Juego finalizado",
                    text: "Puntuación: " + preguntas_correctas + "/" + "5", //preguntas_hechas
                    icon: "success",
                    confirmButtonText: '¡Genial!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        alertExcelent();
                    }
                });
            }
        }
        //funciona para mostrar el resultado al agotarse el tiempo
        function marcadorTiempoAgotado() {
            if (mostrar_pantalla_juego_términado) {
                swal.fire({
                    title: "Juego finalizado",
                    text: "Puntuación: " + preguntas_correctas + "/" + "5", //preguntas_hechas
                    icon: "success",
                    confirmButtonText: '¡Genial!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        tiempoAgotado();
                    }
                });
            }
        }

        //sirve para mostrar cuando el tiempo se ha acabado al final del juego y recarga la pagina
        function tiempoAgotado() {
            var xmlhttp = new XMLHttpRequest();
            var param = "score=" + 0 + "&validar=" + 'incorrecto' + "&permiso=" + 31 + "&id_curso=" + 10; //cancatenation
            xmlhttp.open("POST", "../../acciones/insertar_pd31.php", true);
            xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xmlhttp.send(param);
            Swal.fire({
                title: 'Mala Suerte',
                text: '¡Mejora tu Tiempo!',
                imageUrl: "../../img/img-juegos/Thumbs-Up.gif",
                imageHeight: 350,
                backdrop: `
						rgba(0,143,255,0.6)
						url("../../img/img-juegos/fondo.gif")`,
                confirmButtonColor: '#a14cd9',
                confirmButtonText: '¡Genial!',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.reload();
                }
            });
        }
        //ambos


        //Contador de tiempo en segundos, si se acaba el tiempo sale alerta
        var segundos = 240;

        let puntos = 0;

        function iniciarTiempo() {
            document.getElementById('tiempo').innerHTML = segundos + " segundos";
            if (segundos == 0) {
                var xmlhttp = new XMLHttpRequest();
                var param = "score=" + 0 + "&validar=" + 'incorrecto' + "&permiso=" + 31 + "&id_curso=" + 10; //cancatenation
                xmlhttp.open("POST", "../../acciones/insertar_pd31.php", true);
                xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xmlhttp.send(param);
                Swal.fire({
                    title: 'Oops...',
                    text: '¡El tiempo se acabo!',
                    imageUrl: "../../img/img-juegos/loop.gif",
                    imageHeight: 350,
                }).then((result) => {
                    if (result.isConfirmed) {
                        marcadorTiempoAgotado();
                        // window.location.reload();
                    }
                });
            } else {
                segundos--;
                setTimeout("iniciarTiempo()", 1000);
            }
        }

        //Alerta muestra de que el juego fue completado
        function alertExcelent() {
            var xmlhttp = new XMLHttpRequest();
            var param = "score=" + 10 + "&validar=" + 'correcto' + "&permiso=" + 31 + "&id_curso=" + 10; //cancatenation
            xmlhttp.open("POST", "../../acciones/insertar_pd31.php", true);
            xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xmlhttp.send(param);
            Swal.fire({
                title: 'Excelente',
                text: '¡Buen trabajo!',
                imageUrl: "../../img/img-juegos/Thumbs-Up.gif",
                imageHeight: 350,
                backdrop: `
						rgba(0,143,255,0.6)
						url("../../img/img-juegos/fondo.gif")`,
                confirmButtonColor: '#a14cd9',
                confirmButtonText: '¡Genial!',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '../../../../../../rutas/ruta-vj-b.php';
                }
            });
        }
    </script>


</body>

</html>