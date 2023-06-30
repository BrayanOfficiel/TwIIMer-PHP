// ----------------------------------------------

// Script pour afficher un message d'inscription au scroll de la page

let maxscroll = 600;

window.onscroll = function () {
  if (window.scrollY <= maxscroll - 300) {
    document.getElementById("inscr_box").style.display = "none";
  }
  if (window.scrollY >= maxscroll) {
    document.getElementById("inscr_box").style.display = "block";
    window.scrollTo(scrollX, maxscroll);
  }
};
