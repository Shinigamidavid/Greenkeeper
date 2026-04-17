// add hovered class to selected list item
let list = document.querySelectorAll(".navigation li");

function activeLink(){
    list.forEach(item=>{
        item.classList.remove("hovered");
    })
    this.classList.add("hovered");
}

list.forEach(item => item.addEventListener("mouseover", activeLink));

// Menu Toggle
let toggle = document.querySelector(".toggle");
let navigation = document.querySelector(".navigation");
let main = document.querySelector(".main");

toggle.onclick = function () {
    navigation.classList.toggle("active");
    main.classList.toggle("active");
};

// Manejar Múltiples Temporizadores - 
//Asegúrate de que cada temporizador esté vinculado a su respectiva tarjeta.
// $(document).ready(function() {
//     $('.wrapper_timer').each(function() {
//         var fecha = $(this).data('fecha');  // Obtén la fecha
//         var hora = $(this).data('hora');    // Obtén la hora
        
//         // Combina fecha y hora en un solo DateTime
//         var targetDateTime = new Date(fecha + ' ' + hora);
        
//         // Inicia la cuenta regresiva
//         startCountdown($(this), targetDateTime);
//     });
// });

// function startCountdown(element, targetDateTime) {
//     function updateCountdown() {
//         var now = new Date();
//         var remainingTime = targetDateTime - now;

//         if (remainingTime <= 0) {
//             element.text('¡Tiempo terminado!');
//         } else {
//             var days = Math.floor(remainingTime / (1000 * 60 * 60 * 24));
//             var hours = Math.floor((remainingTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
//             var minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
//             var seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);

//             element.text(days + "d " + hours + "h " + minutes + "m " + seconds + "s ");
//         }
//     }

//     setInterval(updateCountdown, 1000);
// }
