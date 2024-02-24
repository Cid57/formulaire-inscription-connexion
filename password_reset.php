<?php
require_once('include.php'); // Assurez-vous que ce fichier contient la connexion à la base de données
require_once('_db/connexionDB.php'); // Assurez-vous que ce fichier contient la classe connexionDB

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reset_request'])) {
    $email = trim($_POST['email']);

    // Vérifier si l'email existe dans la base de données
    $req = $DB->prepare("SELECT * FROM utilisateur WHERE mail = ?");
    $req->execute([$email]);
    if ($req->fetch()) {
        // L'email existe
        // Générer un token de réinitialisation unique
        $token = bin2hex(random_bytes(32));


        // NOTE : Utilisez PHPMailer ou une bibliothèque similaire pour envoyer l'email
        // Le lien de réinitialisation pourrait ressembler à : https://votredomaine.com/reset_password.php?token=le_token_generé

        $message = 'Un e-mail de réinitialisation a été envoyé avec succès ( Aller dans votre boite mail).';
    } else {
        // L'email n'existe pas
        $message = 'Aucun compte trouvé avec cette adresse e-mail.';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
    require_once('_head/meta.php');
    require_once('_head/link.php');
    require_once('_head/script.php');
    ?>
    <title>Réinitialisation du mot de passe</title>
    <style>
        body {
            background-image: url(./img/password_reset.jpg);
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: cover;
        }


        .container {
            padding: 20px;
            border-radius: 10px;
            background-color: rgba(0, 0, 0, 0.4);

        }

        .container h1,
        .container .btn {
            color: rgba(255, 255, 255, 0.8);

        }

        .container .form-control {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 5px;
            padding: 0.2em 0.5em;

        }

        .container .text-white {
            color: rgba(255, 255, 255, 0.8);

        }

        .container .form-label {
            color: rgba(255, 255, 255, 0.8);
        }
    </style>
</head>

<body>
    <?php require_once('_menu/menu.php'); ?>
    <div class="container p-5">

        <div class="row">
            <div class="col-md-6 offset-md-3">

                <h2 class="text-white">Réinitialisation du mot de passe</h2>
                <form action="password_reset.php" method="post">
                    <div class="mb-4 p-2">
                        <label for="email" class="form-label">Adresse e-mail</label>
                        <input type="email" class="form-control border-3" id="email" name="email" required>
                    </div>
                    <button type="submit" name="reset_request" class="btn btn-primary ms-3">Demander la réinitialisation</button>
                </form>
                <?php if (!empty($message)) echo "<p class='mt-3 ms-3' style='color: white; font-size: 1.8em;'>$message</p>"; ?>

            </div>
        </div>
    </div>

</body>

</html>