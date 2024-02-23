<?php

// Inclusion du fichier externe contenant fonctions, variables, etc.
require_once('include.php');

$var = "Connexion";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
    require_once('_head/meta.php');
    require_once('_head/link.php');
    require_once('_head/script.php');
    ?>
    <style>
        body {
            background-image: url(./img/connexion.jpg);
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
    <title>Connexion</title>
</head>

<body>
    <?php require_once('_menu/menu.php'); ?>

    <div class="container">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <h1>Connexion</h1>
                <form action="connexion.php" method="post">
                    <div class="mb-4 p-1">
                        <?php if (isset($err_pseudo)) echo displayErrorMessage($err_pseudo); ?>
                        <label class="form-label text-white fs-5">Pseudo</label>
                        <input class="form-control" type="text" name="pseudo" value="<?php echo isset($pseudo) ? htmlspecialchars($pseudo) : ''; ?>" placeholder="Pseudo" required>
                    </div>
                    <div class="mb-4 p-1">
                        <?php if (isset($err_password)) echo displayErrorMessage($err_password); ?>
                        <label class="form-label text-white fs-5">Mot de passe</label>
                        <input class="form-control" type="password" name="password" placeholder="Mot de passe" required>
                    </div>
                    <div id="btn" class="mb-4 mt-5 p-1">
                        <button type="submit" name="connexion" class="btn btn-primary">Se connecter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php require_once('_footer/footer.php'); ?>
</body>

</html>