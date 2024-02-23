<?php


session_start(); // Démarre la session ici, donc pas besoin de le faire dans chaque fichier
require_once('_db/connexionDB.php'); // Inclusion de la connexion à la base de données

// Fonction pour afficher les messages d'erreur
function displayErrorMessage($message)
{
    return '<div class="alert alert-danger" role="alert">' . htmlspecialchars($message) . '</div>';
}
