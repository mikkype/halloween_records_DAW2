document.addEventListener("DOMContentLoaded", init);

function init(){
var tabla = document.getElementById('cuerpo');
var opciones = {
    method: 'POST'
}
//ruta donde se consume el json
fetch('php/mostrar.php', opciones)
    .then(result => result.json())
    .then(result => {
        //console.log(result)
        result.forEach(element=> {

            tabla.innerHTML += `
                    <tr>
                    <th scope="row">${element.puntuacion_id}</th>
                    <td>${element.nombre}</td>
                    <td>${element.curso}</td>
                    <td>${element.puntaje}</td>
                    </tr>`

        });
        //console.log(tabla);
        
    })
}