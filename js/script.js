// Ouvrir/fermer la sidebar
const navToggle = document.getElementById("navToggle");
const mainNav = document.getElementById("mainNav");

navToggle.addEventListener("click", () => {
  mainNav.classList.toggle("open");
  navToggle.classList.toggle("open");
  if (mainNav.classList.contains("open") && window.innerWidth > 1000) {
    document.getElementsByTagName("main")[0].style.maxWidth =
      "calc(75% - 145px)";
    document.getElementsByTagName("main")[0].style.transform =
      "translateX(145px)";
  } else {
    document.getElementsByTagName("main")[0].style.maxWidth = "75%";
    document.getElementsByTagName("main")[0].style.transform = "translateX(0)";
  }
});

// ----------------------------------------------

//foreach pour les notifications avec la class .error et .success, si elle existe, on affiche le message et on le supprime au bout de 5 secondes
const error = document.querySelectorAll(".error");
const success = document.querySelectorAll(".success");

error.forEach((element) => {
  if (error.innerHTML != "") {
    setTimeout(function () {
      element.style.animation = "fadeOut 1s";
    }, 3000);
    setTimeout(function () {
      element.remove();
    }, 4000);
  }
});

success.forEach((element) => {
  if (success.innerHTML != "") {
    setTimeout(function () {
      element.style.animation = "fadeOut 1s";
    }, 3000);
    setTimeout(function () {
      element.remove();
    }, 4000);
  }
});

// ----------------------------------------------

// Script pour afficher ou cacher le formulaire de tweet rapide
const tweetBox = document.getElementById("quick_tweet_box");

function showQuickTweet() {
  if (tweetBox.style.display == "block") {
    tweetBox.style.display = "none";
  } else {
    tweetBox.style.display = "block";
  }
}

// ----------------------------------------------

// Script pour changer l'affichage des tweets entre liste et grille
function affichageDesTweetsGrille() {
  const tweetContainer = document.getElementById("tweet_container");
  tweetContainer.classList.add("tweets_container_grid");
  tweetContainer.classList.remove("tweets_container");
}
function affichageDesTweetsListe() {
  const tweetContainer = document.getElementById("tweet_container");
  tweetContainer.classList.remove("tweets_container_grid");
  tweetContainer.classList.add("tweets_container");
}

// ----------------------------------------------

// Script pour afficher ou cacher la confirmation de suppression d'un tweet

function supprimerTweet(id, confirmation) {
  const tweetDeleteConfirm = document.getElementById("tweet_delete_" + id);
  if (confirmation == true) {
    tweetDeleteConfirm.style.display = "flex";
    tweetDeleteConfirm.style.animation = "fadeIn .3s";
  } else if (confirmation == false) {
    //wait for animation to end
    tweetDeleteConfirm.style.animation = "fadeOut .3s";
    setTimeout(function () {
      tweetDeleteConfirm.style.display = "none";
    }, 300);
  }
}

// ----------------------------------------------

// Responsive
if (
  window.innerWidth < 800 &&
  document.getElementById("grille_btn") != null &&
  document.getElementById("liste_btn") != null
) {
  document.getElementById("grille_btn").style.display = "none";
  document.getElementById("liste_btn").style.display = "none";
  affichageDesTweetsListe();
}
if (window.innerWidth < 1000) {
  mainNav.classList.remove("open");
  navToggle.classList.remove("open");
}
if (mainNav.classList.contains("open") && window.innerWidth > 1000) {
  document.getElementsByTagName("main")[0].style.maxWidth = "calc(75% - 145px)";
  document.getElementsByTagName("main")[0].style.transform =
    "translateX(145px)";
} else {
  document.getElementsByTagName("main")[0].style.maxWidth = "100%";
  document.getElementsByTagName("main")[0].style.transform = "translateX(0)";
}

// Au resize de la fenêtre

window.onresize = function () {
  if (
    window.innerWidth < 800 &&
    document.getElementById("grille_btn") != null &&
    document.getElementById("liste_btn") != null
  ) {
    document.getElementById("grille_btn").style.display = "none";
    document.getElementById("liste_btn").style.display = "none";
    affichageDesTweetsListe();
  } else if (
    document.getElementById("grille_btn") != null &&
    document.getElementById("liste_btn") != null
  ) {
    document.getElementById("grille_btn").style.display = "inline";
    document.getElementById("liste_btn").style.display = "inline";
  }
  // navbar
  if (window.innerWidth < 1000) {
    mainNav.classList.remove("open");
    navToggle.classList.remove("open");
  } else {
    mainNav.classList.add("open");
    navToggle.classList.add("open");
  }
  //main
  if (mainNav.classList.contains("open") && window.innerWidth > 1000) {
    document.getElementsByTagName("main")[0].style.maxWidth =
      "calc(75% - 145px)";
    document.getElementsByTagName("main")[0].style.transform =
      "translateX(145px)";
  } else {
    document.getElementsByTagName("main")[0].style.maxWidth = "100%";
    document.getElementsByTagName("main")[0].style.transform = "translateX(0)";
  }
};
