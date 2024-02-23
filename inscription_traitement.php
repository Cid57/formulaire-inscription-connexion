<?php
// Démarrage de la session
session_start();


// Inclusion du fichier de connexion à la base de données
require_once('_db/connexionDB.php');

// Fonction pour afficher les messages d'erreur
function displayErrorMessage($message)
{
    if (!isset($_SESSION['errors'])) {
        $_SESSION['errors'] = [];
    }
    $_SESSION['errors'][] = $message;
}

// Vérification si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['inscription'])) {
    // Extraction et nettoyage des données du formulaire
    $pseudo = ucfirst(trim($_POST['pseudo']));
    $mail = trim($_POST['mail']);
    $password = trim($_POST['password']);
    $confpassword = trim($_POST['confpassword']);

    // Initialisation de la variable de validation
    $valid = true;

    // Vérification de l'unicité du pseudo
    $req = $DB->prepare("SELECT id FROM utilisateur WHERE pseudo = ?");
    $req->execute([$pseudo]);
    if ($req->fetch()) {
        $valid = false;
        displayErrorMessage("Ce pseudo est déjà pris.");
    }

    // Vérification de l'unicité de l'email
    $req = $DB->prepare("SELECT id FROM utilisateur WHERE mail = ?");
    $req->execute([$mail]);
    if ($req->fetch()) {
        $valid = false;
        displayErrorMessage("Cette adresse email est déjà utilisée.");
    }

    // Vérification que les mots de passe correspondent
    if ($password !== $confpassword) {
        $valid = false;
        displayErrorMessage("Les mots de passe ne correspondent pas.");
    }

    // Insertion des données dans la base de données si aucune erreur n'a été détectée
    if ($valid) {
        // Cryptage du mot de passe
        $crypt_password = password_hash($password, PASSWORD_DEFAULT);

        // Préparation de la requête d'insertion
        $query = "INSERT INTO utilisateur (pseudo, mail, crypt_password, date_creation, date_connexion) VALUES (?, ?, ?, NOW(), NOW())";
        $req = $DB->prepare($query);

        try {
            $req->execute([$pseudo, $mail, $crypt_password]);
            $_SESSION['inscription_success'] = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
            // header('Location: connexion.php');
            // exit;
        } catch (Exception $e) {
            displayErrorMessage("Erreur lors de l'inscription : " . $e->getMessage());
        }
    }

    // Si non valide, rediriger vers la page d'inscription pour afficher les erreurs
    if (!$valid) {
        header('Location: inscription.php');
        exit;
    }
}
