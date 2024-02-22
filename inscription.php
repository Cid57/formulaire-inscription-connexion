<?php
// Inclut le fichier de traitement de l'inscription.
include('inscription_traitement.php');

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
    // Inclut les métadonnées, les liens CSS et les scripts JavaScript nécessaires pour la page.
    require('_head/meta.php');
    require('_head/link.php');
    require('_head/script.php');
    ?>
    <title>Inscription</title>
    <style>
        .message-success {
            color: #000;
            width: 75%;
            margin: auto;
            font-size: 20px;
            text-align: center;
            background-color: #FDE2FF;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            border: 1px solid #3c763d;
        }
    </style>
</head>

<body>

    <?php
    // Inclut le menu de navigation de la page.
    require('_menu/menu.php');
    ?>
    <div class="container">
        <div class="row">
            <div class="col-3"></div> <!-- Colonne vide pour le centrage du formulaire -->
            <div class="col-6">
                <h1>Inscription</h1>
                <!-- Formulaire d'inscription avec la méthode POST pour envoyer les données -->
                <form action="inscription.php" method="post">
                    <div class="mb-3">
                        <?php
                        // Affiche un message d'erreur si le pseudo est incorrect
                        if (isset($err_pseudo)) {
                            echo displayErrorMessage($err_pseudo);
                        }
                        ?>
                        <label class="form-label">Pseudo</label>
                        <!-- Champ de saisie pour le pseudo avec pré-remplissage si déjà défini -->
                        <input class="form-control" type="text" name="pseudo" value="<?php if (isset($pseudo)) {
                                                                                            echo $pseudo;
                                                                                        } ?>" placeholder="Pseudo">
                    </div>
                    <div class="mb-3 ">
                        <?php
                        // Affiche un message d'erreur si l'email est incorrect
                        if (isset($err_mail)) {
                            echo displayErrorMessage($err_mail);
                        }
                        ?>
                        <label class="form-label">Mail</label>
                        <!-- Champ de saisie pour l'email avec pré-remplissage si déjà défini -->
                        <input class="form-control" type="email" name="mail" value="<?php if (isset($mail)) {
                                                                                        echo $mail;
                                                                                    } ?>" placeholder="Mail">
                    </div>
                    <div class="mb-3 ">
                        <?php
                        // Affiche un message d'erreur si le mot de passe est incorrect
                        if (isset($err_password)) {
                            echo displayErrorMessage($err_password);
                        }
                        ?>
                        <label class="form-label">Mot de passe</label>
                        <!-- Champ de saisie pour le mot de passe -->
                        <input class="form-control" type="password" name="password" placeholder="Mot de passe">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirmation Mot de passe</label>
                        <!-- Champ de saisie pour la confirmation du mot de passe -->
                        <input class="form-control" type="password" name="confpassword" value="" placeholder="Confirmation Mot de passe">
                    </div>
                    <div class="mb-3">
                        <!-- Bouton d'envoi du formulaire -->
                        <button type="submit" name="inscription">Inscription</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php


    if (isset($_GET['inscription']) && $_GET['inscription'] == 'success') {
        echo '<div class="message-success" role="alert">Inscription réussie ! Vous pouvez maintenant vous connecter.</div>';
    }


    // Inclut le pied de page de la page.
    require('_footer/footer.php');
    ?>

</body>

</html>