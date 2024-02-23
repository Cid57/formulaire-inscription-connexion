<?php
session_start(); // Démarrage de la session

if (!isset($_SESSION['user'])) {
    header('Location: connexion.php'); // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    exit;
}

$pseudo = $_SESSION['user']; // Récupérer le pseudo de l'utilisateur depuis la session
?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <?php
    require_once('_head/meta.php');
    require_once('_head/link.php');
    require_once('_head/script.php');
    ?>
    <title>Bienvenue</title>
</head>

<body>

    <h1 class="text-center">Bonjour, <?php echo htmlspecialchars($pseudo); ?>!</h1>


</body>

</html>