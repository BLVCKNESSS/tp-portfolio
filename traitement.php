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
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Portfolio - Résultat</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <span class="logo">[Ton Nom]</span>
    <nav>
      <a href="index.html">Accueil</a>
      <a href="contact.html" class="actif">Contact</a>
    </nav>
  </header>

  <main>
    <section class="carte formulaire">
      <?php if ($succes): ?>
        <h2>Message envoyé</h2>
        <p class="alerte succes">Merci <?php echo $nom; ?>, votre message a bien été envoyé !</p>
      <?php else: ?>
        <h2>Oups...</h2>
        <p class="alerte erreur"><?php echo $erreur; ?></p>
      <?php endif; ?>

      <a href="contact.html" class="bouton retour">Retour au formulaire</a>
    </section>
  </main>

  <footer>
    <p>&copy; <?php echo date("Y"); ?> [Ton Nom] - Tous droits réservés</p>
  </footer>
</body>
</html>
