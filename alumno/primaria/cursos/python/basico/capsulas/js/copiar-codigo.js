//Contador de tiempo en segundos, si se acaba el tiempo sale alerta
var segundos = 240;

let puntos = 0;

//ASIGNA EL TEXTO AL CUADRO DE EJEMPLO DEL JUEGO
document.getElementById(
    "textoej"
).innerHTML =  `a = 1  <br><br> b = 2<br><br><br>if a < b:<br><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;print(" b es mayor que a ")<br><br> else: <br><br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;print(" a es mayor que b")`;
//Entidades para que html no reconosca las etiquetas
//&lt; representa (<).
//&gt; representa (>).
//&quot; representa (").
//&nbsp; espaciado de tabulacion

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

function iniciarTiempo() {
    document.getElementById("tiempo").innerHTML = segundos + " segundos";
     /*declarando condiciones que permiten cambiar el color de fondo del timer*/
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
        //Borra el texto escrito
        escrito.value = "";
        Swal.fire({
            title: "Oops...",
            text: "¡Se te ha agotado el tiempo!",
            imageUrl: "img/loop.gif",
            imageHeight: 350,
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.reload();
            }
        });
    } else {
        segundos--;
        setTimeout("iniciarTiempo()", 1000);
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
                window.location.reload();
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
