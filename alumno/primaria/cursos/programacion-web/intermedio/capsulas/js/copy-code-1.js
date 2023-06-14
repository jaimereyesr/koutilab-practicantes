//Contador de tiempo en segundos, si se acaba el tiempo sale alerta
var segundos = 150;
var count = 1000;

let puntos = 0;

//ASIGNA EL TEXTO AL CUADRO DE EJEMPLO DEL JUEGO
document.getElementById(
    "textoej"
).innerHTML =
        `.main { <br><br>
          width:500px; <br><br>
          height:500px;<br> <br>
          margin:0 auto;<br><br>
          background-color:grey;}`;
//Entidades para que html no reconosca las etiquetas
//&lt; representa (<).
//&gt; representa (>).
//&quot; representa (").

//Funcion para bloquear copiar y pegar
document.addEventListener("keydown", function (event) {
    //con event se detecta si se presiono la tecla control y la tecla c o C
    if (event.ctrlKey && (event.key === "c" || event.key === "C")) {
        event.preventDefault(); //con prevent defaul el navegador bloquea la accion
    }

    if (event.ctrlKey && (event.key === "v" || event.key === "V")) {
        event.preventDefault();
    }
});

//Funcion que borra lo escrito dentro del textarea cuando se actualiza la pagina
window.onbeforeunload = function () {
    document.getElementById("escrito").value = "";
};

  //Agregando animacion a el juego
    function iniciarTiempo() {
        document.getElementById("tiempo").innerHTML =
            segundos + " segundos";
        if (segundos <= 60) {
            var div = document.getElementById("timer");
            div.style.cssText = "animation-name: animation1; animation-duration: 0.5s; background-color: #c42c2caf; border-color: #c42c2c;";
        }
        if (segundos <= 30) {
            var div = document.getElementById("timer");
            div.style.cssText = "animation-name: animation2; animation-duration: 0.5s; background-color: #c42c2caf; border-color: #c42c2c;";
        }
        if (segundos <= 10) {
            var div = document.getElementById("timer");
            div.style.cssText = "animation-name: animation2; animation-duration: 0.5s; background-color: #c42c2caf; border-color: #c42c2c;";
        }
        if (segundos == 0) {
            var xmlhttp = new XMLHttpRequest();
				var param = "score=" + 0 + "&validar=" + 'incorrecto' + "&permiso=" + 20 + "&id_curso=" + 2; //cancatenation
				xmlhttp.open("POST", "../../acciones/insertar_pd20.php", true);
				xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xmlhttp.send(param);
            Swal.fire({
                title: "Oops...",
                text: "Se acabó el tiempo",
                imageUrl: "img/loop.gif",
                imageHeight: 350,
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.reload();
                }
            });
            loseText.setText("Juego terminado");
            player.setTint(0xff0000);
            player.anims.play("turn");
            gameoverSound();
            gameOver = true;
        } else {
            segundos--;
            setTimeout("iniciarTiempo()", count);
        }
    }

//Alerta muestra de que el juego fue completado
function alertExcelent() {
    //Obtiene el texto escrito en la pagina
    var textoejemplo = document.getElementById("textoej");
    var textoejemplof = textoejemplo.textContent;
    var textoescrito = document.getElementById("escrito").value;
    //Elimina los espacios que existen en los textos para que la comparacion sea mas exacta
    var text1 = textoescrito.replace(/\s/g, "");
    var text2 = textoejemplof.replace(/\s/g, "");
    //Compara y valida si el texto es igual o no y muestra mensajes.
    if (text1 === text2) {
        var xmlhttp = new XMLHttpRequest();
				var param = "score=" + 10 + "&validar=" + 'correcto' + "&permiso=" + 20 + "&id_curso=" + 2; //cancatenation
				xmlhttp.open("POST", "../../acciones/insertar_pd20.php", true);
				xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xmlhttp.send(param);
        Swal.fire({
            title: "Excelente",
            text: "¡Buen trabajo!",
            imageUrl: "img/Thumbs-Up.gif",
            imageHeight: 350,
            backdrop: `
                rgba(0,143,255,0.6)
                url("img/fondo.gif")`,
            confirmButtonColor: "#a14cd9",
            confirmButtonText: "¡Genial!",
        }).then((result) => {
            if (result.isConfirmed) {
                //Borra el texto escrito
                escrito.value = "";
                window.location.href = '../../../../../rutas/ruta-pw-i.php';
            }
        });
    } else {
        Swal.fire({
            title: "Oops...",
            text: "¡Verifica tu respuesta!",
            imageUrl: "img/loop.gif",
            imageHeight: 350,
            backdrop: `
                rgba(0,143,255,0.6)
                url("img/fondo.gif")`,
            confirmButtonColor: "#a14cd9",
            confirmButtonText: "Reintentar",
        });
    }
}
