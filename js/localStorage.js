// Vérifier si le localStorage est pris en charge par le navigateur
if (typeof Storage !== "undefined") {
  // Récupérer l'élément input et le select
  var messageInput = document.querySelector('textarea[name="tweet"]');
  var hashtagSelect = document.querySelector('select[name="hashtag"]');

  // Vérifier s'il y a un message non publié dans le localStorage
  var storedMessage = localStorage.getItem("draftMessage");
  if (storedMessage) {
    // Remettre le message non publié dans l'input
    messageInput.value = storedMessage;
  }

  // Vérifier s'il y a un tag sélectionné non publié dans le localStorage
  var storedTag = localStorage.getItem("draftTag");
  if (storedTag) {
    // Remettre le tag sélectionné dans le select
    hashtagSelect.value = storedTag;
  }

  // Écouter les événements de changement dans l'input et le select
  messageInput.addEventListener("input", function () {
    // Stocker le contenu de l'input dans le localStorage
    localStorage.setItem("draftMessage", messageInput.value);
  });

  hashtagSelect.addEventListener("change", function () {
    // Stocker la valeur sélectionnée du select dans le localStorage
    localStorage.setItem("draftTag", hashtagSelect.value);
  });
}
