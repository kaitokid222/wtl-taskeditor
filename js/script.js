document.addEventListener("contextmenu", function(e){
  e.preventDefault();
}, false);

document.addEventListener('mousedown', function (e) {
  if (e.detail > 1) {
    e.preventDefault();
  }
}, false);