<?php
// Inclusion du fichier nécessaire pour le fonctionnement du script
require('include.php');

if (isset($_SESSION['id'])) {
    $var = "Bonjour" . $_SESSION['pseudo'];
}
// else {
//     $var = "<p class='text-center pt-5 display-1 m-5' style='color:red' >Bonjour à tous, <br> Bienvenue sur mon site de démo</p>";
// }


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
    <div class="bienvenue">
        <h1>Bonjour à tous, <br> Bienvenue sur mon site de démo</h1>
    </div>


    <?php
    // Inclusion du pied de page du site
    require('_footer/footer.php');
    ?>
</body>

</html>