let toast = document.querySelector('#MessageFlash');
toast.style.opacity = 'block';
setTimeout(function() {
    toast.style.display = 'none';
}, 3000);

var modal = document.getElementById("myModall");
var btn = document.getElementById("openModalBtn");
var span = document.getElementsByClassName("close")[0];

btn.onclick = function() {
  modal.style.display = "block";
}

span.onclick = function() {
  modal.style.display = "none";
}


// window.onclick = function(event) {
//   if (event.target == modal) {
//     modal.style.display = "none";
//   }
// }
