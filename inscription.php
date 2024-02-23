<?php

include('inscription_traitement.php');



if (isset($_SESSION['errors']) && count($_SESSION['errors']) > 0) {
    foreach ($_SESSION['errors'] as $error) {
        echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
    }
    unset($_SESSION['errors']);
}


if (isset($_SESSION['inscription_success'])) {
    echo '<div class="alert alert-success" role="alert">' . $_SESSION['inscription_success'] . '</div>';
    unset($_SESSION['inscription_success']);
}

?>



<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Inclusion des métadonnées, des liens CSS, et des scripts JavaScript -->
    <?php require('_head/meta.php');
    require('_head/link.php');
    require('_head/script.php'); ?>
    <title>Inscription</title>
    <style>
        body {
            background-image: url(./img/header-principal.jpg);
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
    <!-- Inclusion du menu de navigation -->
    <?php require('_menu/menu.php'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div> <!-- Colonne vide pour centrage -->
            <div class="col-md-6">
                <h1>Inscription</h1>
                <!-- Formulaire d'inscription -->
                <form action="inscription.php" method="post">
                    <!-- Champs du formulaire -->
                    <div class="form-group">
                        <?php if (!empty($err_pseudo)) echo displayErrorMessage($err_pseudo); ?>
                        <label class="text-white fs-4" for="pseudo">Pseudo:</label>
                        <input type="text" class="form-control" id="pseudo" name="pseudo" required>
                    </div>
                    <div class="form-group">
                        <label class="text-white fs-4" for="mail">Email:</label>
                        <input type="email" class="form-control" id="mail" name="mail" required>
                    </div>
                    <div class="form-group">
                        <label class="text-white fs-4" for="password">Mot de passe:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label class="text-white fs-4" for="confpassword">Confirmez le mot de passe:</label>
                        <input type="password" class="form-control" id="confpassword" name="confpassword" required>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary" name="inscription">S'inscrire</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Inclusion du pied de page -->
    <?php require('_footer/footer.php'); ?>
</body>

</html>