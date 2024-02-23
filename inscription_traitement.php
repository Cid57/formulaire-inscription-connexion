<?php
// Démarrage de la session
session_start();

// Inclusion du fichier de connexion à la base de données
include('_db/connexionDB.php');



// Vérification si le formulaire a été soumis
if (!empty($_POST)) {
    // Extraction des données du formulaire
    extract($_POST);

    // Initialisation de la variable de validation
    $valid = true;

    // Vérification si le formulaire d'inscription a été soumis
    if (isset($_POST['inscription'])) {
        // Nettoyage et assignation des variables avec les données du formulaire
        // La première lettre du pseudo sera convertie en majuscule
        $pseudo = ucfirst(trim($_POST['pseudo'])); // Correction ajoutée: fermeture de la parenthèse
        $mail = trim($_POST['mail']);
        $password = trim($_POST['password']);
        $confpassword = trim($_POST['confpassword']);
    }


    // Vérification des champs du formulaire et traitement des erreurs
    if (empty($pseudo)) {

        $valid = false;
        $err_pseudo = "Ce champ ne peut pas être vide"; // Message d'erreur si le pseudo est vide
    } elseif (grapheme_strlen($pseudo) < 5) {
        $valid = false;
        $err_pseudo = "Le pseudo doit faire plus de 5 caractères";
    } elseif (grapheme_strlen($pseudo) > 25) {
        $valid = false;
        $err_pseudo = "Le pseudo doit faire moins de 26 caractères (" . grapheme_strlen($pseudo) . "/25)";
    } else {
        // Préparation de la requête SQL pour sélectionner l'ID d'un utilisateur en fonction du pseudo
        $req = $DB->prepare("SELECT id FROM utilisateur WHERE pseudo = ?");

        // Exécution de la requête en remplaçant le paramètre par la valeur du pseudo fourni
        $req->execute(array($pseudo));

        // Récupération de la première ligne de résultat de la requête
        $req_result = $req->fetch();

        // Vérification si des données ont été retournées par la requête, ce qui signifie qu'un utilisateur avec ce pseudo existe déjà
        if ($req_result) {
            // Si un résultat est retourné, le pseudo est déjà utilisé, donc le formulaire n'est pas valide
            $valid = false; // Variable pour indiquer que le formulaire n'est pas valide
            $err_pseudo = "Ce pseudo est déjà pris"; // Message d'erreur si le pseudo est déjà utilisé
        }
    }

    if (empty($mail)) {

        $valid = false;
        $err_mail = "Ce champ ne peut pas être vide"; // Message d'erreur si le mail est vide
    } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {

        $valid = false;
        $err_mail = "Format d'adresse e-mail invalide"; // Vérification du format de l'adresse e-mail
    } else {
        // Préparation de la requête SQL pour sélectionner l'ID d'un utilisateur en fonction de son adresse e-mail
        $req = $DB->prepare("SELECT id FROM utilisateur WHERE mail = ?");

        // Exécution de la requête en remplaçant le paramètre par la valeur de l'adresse e-mail fournie
        $req->execute(array($mail));

        // Récupération de la première ligne de résultat de la requête
        $req_result = $req->fetch();

        // Vérification si des données ont été retournées par la requête, ce qui signifie qu'un utilisateur avec cette adresse e-mail existe déjà
        if ($req_result) {
            // Si un résultat est retourné, l'adresse e-mail est déjà utilisée, donc le formulaire n'est pas valide
            $valid = false; // Variable pour indiquer que le formulaire n'est pas valide
            $err_mail = "Cette adresse email est déjà utilisée"; // Message d'erreur si l'e-mail est déjà utilisé
        }
    }

    if (empty($password)) {
        $valid = false;
        $err_password = "Mot de passe doit être remplie"; // Message d'erreur si le mot de passe est vide
    } elseif ($password != $confpassword) {
        $valid = false;
        $err_password = "Erreur mot de passe est différent de la confirmation"; // Vérification de la correspondance des mots de passe
    }

    // Insertion des données dans la base de données si aucune erreur n'a été détectée
    if ($valid) {
        // Cryptage du mot de passe
        $crypt_password = password_hash($password, PASSWORD_DEFAULT);

        echo $crypt_password;
        if (password_verify($password, $crypt_password)) {
            echo 'Le mot de passe est valide';
        } else {
            echo 'Le mot de passe est invalide';
        }

        // Date de création et de connexion
        $date_creation = date('Y-m-d H:i:s');
        $date_connexion = date('Y-m-d H:i:s');

        // Préparation de la requête d'insertion
        $query = "INSERT INTO utilisateur(pseudo, mail, crypt_password, date_creation, date_connexion) VALUES (?, ?, ?, ?, ?)";
        $req = $DB->prepare($query);

        // Exécution de la requête d'insertion avec les valeurs du formulaire
        if ($req->execute(array($pseudo, $mail, $crypt_password, $date_creation, $date_connexion))) {
            // Définir un message de confirmation dans la session
            $_SESSION['inscription_success'] = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
            // Redirection vers la page d'inscription ou de connexion
            header('Location: connexion.php?inscription=success');
            exit;
        } else {
            // Afficher l'erreur si l'exécution a échoué
            print_r($req->errorInfo());
        }
    }
}

// Affichage des messages d'erreur avec le style défini
function displayErrorMessage($message)
{
    return '<div style="color: #D8000C; background-color: #FFD2D2; padding: 7px; margin-bottom: 15px; border-radius: 5px; border: 1px solid #D8000C;">' . $message . '</div>';
}
