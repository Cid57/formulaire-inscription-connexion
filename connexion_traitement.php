<?php
session_start();
require_once('_db/connexionDB.php');

$errorMessage = ''; // Initialisation d'une chaîne vide pour les messages d'erreur

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['connexion'])) {
    $pseudo = trim($_POST['pseudo']); // Pas besoin de ucfirst, sauf si vous l'avez utilisé lors de l'enregistrement
    $password = trim($_POST['password']);

    if (empty($pseudo) || empty($password)) {
        $errorMessage = "Le pseudo et le mot de passe sont requis.";
    } else {
        $req = $DB->prepare("SELECT * FROM utilisateur WHERE pseudo = :pseudo");
        $req->execute([':pseudo' => $pseudo]);
        $user = $req->fetch();

        if ($user && password_verify($password, $user['crypt_password'])) {
            // Initialisation de la session utilisateur
            $_SESSION['id'] = $user['id'];
            $_SESSION['pseudo'] = $user['pseudo'];
            $_SESSION['mail'] = $user['mail'];

            // Mise à jour de la date de connexion
            $date_connexion = date('Y-m-d H:i:s');
            $req = $DB->prepare("UPDATE utilisateur SET date_connexion = :date_connexion WHERE id = :id");
            $req->execute([':date_connexion' => $date_connexion, ':id' => $user['id']]);

            header('Location: /');
            exit;
        } else {
            $errorMessage = "La combinaison du pseudo / mot de passe est incorrecte.";
        }
    }
}
