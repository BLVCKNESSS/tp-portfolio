// ===== JavaScript : vérification du formulaire (côté navigateur) =====
const formulaire = document.getElementById("form-contact");
const zoneErreur = document.getElementById("erreur-js");
const champMessage = document.getElementById("message");
const compteur = document.getElementById("compteur");

// Compteur de caractères pendant la frappe
champMessage.addEventListener("input", function () {
  compteur.textContent = champMessage.value.length + " caractère(s)";
});

// Vérification avant l'envoi vers le PHP
formulaire.addEventListener("submit", function (e) {
  const nom = document.getElementById("nom").value.trim();
  const email = document.getElementById("email").value.trim();
  const message = champMessage.value.trim();
  let texte = "";

  if (nom === "" || email === "" || message === "") {
    texte = "Veuillez remplir tous les champs.";
  } else if (!email.includes("@") || !email.includes(".")) {
    texte = "Veuillez entrer un email valide.";
  } else if (message.length < 10) {
    texte = "Votre message est trop court (10 caractères minimum).";
  }

  if (texte !== "") {
    e.preventDefault(); // bloque l'envoi
    zoneErreur.textContent = texte;
    zoneErreur.hidden = false;
  }
});
