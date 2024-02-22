<?php
// Inclusion d'un fichier externe 'include.php' qui peut contenir des fonctions, des variables,
// et d'autres fichiers nécessaires à la page actuelle.
require('include.php');


// Déclaration d'une variable $var avec la valeur "Connexion" pour être utilisée dans le code HTML ci-dessous.
$var = "Connexion";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
    // Inclusion des fichiers PHP contenant les balises meta, les liens vers les feuilles de style CSS,
    // et les scripts JavaScript pour la page. Ces fichiers sont organisés pour faciliter la maintenance
    // et la réutilisation dans d'autres pages du site web.
    require('_head/meta.php'); // Fichier contenant les balises meta pour des raisons de SEO et de compatibilité.
    require('_head/link.php'); // Fichier contenant les liens vers les feuilles de style CSS.
    require('_head/script.php'); // Fichier contenant les liens vers les scripts JavaScript.
    ?>
    <title>Connexion</title> <!-- Titre de la page visible dans l'onglet du navigateur -->
</head>

<body>
    <?php
    // Inclusion du menu de navigation du site. Séparer le menu dans un fichier distinct permet
    // une modification plus aisée et sa réutilisation sur différentes pages du site.
    require('_menu/menu.php');
    ?>
    <h1><?= $var ?></h1> <!-- Affichage de la variable $var qui contient le texte "Connexion" -->

    <?php
    // Inclusion du pied de page du site. Comme pour le menu, le séparer dans un fichier distinct
    // facilite sa maintenance et sa réutilisation.
    require('_footer/footer.php');
    ?>

</body>

</html>