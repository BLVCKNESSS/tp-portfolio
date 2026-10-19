<?php
// ===== PHP : traitement du formulaire (côté serveur) =====
$succes = false;
$erreur = "";
$nom = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // htmlspecialchars protège contre les caractères dangereux
    $nom     = htmlspecialchars(trim($_POST["nom"] ?? ""));
    $email   = htmlspecialchars(trim($_POST["email"] ?? ""));
    $message = htmlspecialchars(trim($_POST["message"] ?? ""));

    if ($nom === "" || $email === "" || $message === "") {
        $erreur = "Merci de remplir tous les champs.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreur = "L'adresse email n'est pas valide.";
    } else {
        // On enregistre le message dans un fichier texte
        $ligne = date("d/m/Y H:i") . " | $nom | $email | $message\n";
        file_put_contents("messages.txt", $ligne, FILE_APPEND);
        $succes = true;
    }
} else {
    $erreur = "Aucun message reçu. Veuillez utiliser le formulaire de contact.";
}
