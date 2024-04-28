'use strict';
const video = document.getElementById('video');
const canvas = document.getElementById('canvas');
const snap = document.getElementById("snap");
const errorMsgElement = document.querySelector('span#errorMsg');

const constraints = {
    audio: false,
    video: {
        width: 120, height: 100
    }
};

/*Función para acceder a la webcam, vemos si el navegador tiene soporte para la webcam (no se por que me funciona solo con chrome)*/
async function init() {
    try {
        const stream = await navigator.mediaDevices.getUserMedia(constraints);
        handleSuccess(stream); // Si no hubo problemas se vera lo que captura la webcam
    } catch (e) {
        errorMsgElement.innerHTML = `navigator.getUserMedia error:${e.toString()}`;
    }
}

function handleSuccess(stream) {
    video.srcObject = stream;
}

init();
video.addEventListener('loadedmetadata',function(){canvas.width=video.videoWidth; canvas.height=video.videoHeight;},false);
//si hago click en el boton "Capturar foto" aparece la imagen que capturé (esta en canvas)
snap.addEventListener("click", function() {
    canvas.getContext('2d').drawImage(video,0,0);
    var img=canvas.toDataURL('image/png');
    //para guardar el nombre de la imagen en un input no visible, esto me servira para enviarla al controlador
    document.getElementById('photo_camera').setAttribute('value', img);
});
