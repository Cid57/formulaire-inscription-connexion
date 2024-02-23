<?php
// Inclusion du fichier nécessaire pour le fonctionnement du script
require('include.php');

if (isset($_SESSION['id'])) {
    $var = "Bonjour" . $_SESSION['pseudo'];
} else {
    $var = "Bonjour à tous";
}


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Accueil</title>
    <style>
        body {
            background-image: url(./img/accueil.jpg);
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
    <?php
    // Inclusion des différents éléments de l'en-tête de la page :
    // Meta tags pour le SEO, les liens vers les feuilles de style CSS et les scripts JavaScript
    require('_head/meta.php'); // Fichier contenant les balises meta pour le référencement et l'optimisation
    require('_head/link.php'); // Fichier contenant les liens vers les feuilles de style CSS
    require('_head/script.php'); // Fichier contenant les liens vers les scripts JavaScript
    ?>

</head>

<body>
    <?php
    // Inclusion du menu de navigation du site
    require('_menu/menu.php');
    ?>

    <h1><?= $var ?></h1> <!-- Affichage du message de bienvenue déclaré plus haut dans le script PHP -->
    <?php
    // Inclusion du pied de page du site
    require('_footer/footer.php');
    ?>
</body>

</html>