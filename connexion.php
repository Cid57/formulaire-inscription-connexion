<?php
require_once('include.php'); // Cela va démarrer la session et inclure la connexion à la DB

// Initialisation des variables d'erreur
$err_pseudo = $err_password = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['connexion'])) {
    $pseudo = trim($_POST['pseudo']);
    $password = trim($_POST['password']);

    // Validation des entrées
    if (empty($pseudo)) {
        $err_pseudo = 'Le champ pseudo est requis.';
    }

    if (empty($password)) {
        $err_password = 'Le champ mot de passe est requis.';
    }

    // Vérification des identifiants de l'utilisateur
    if (empty($err_pseudo) && empty($err_password)) {
        $req = $DB->prepare('SELECT * FROM utilisateur WHERE pseudo = ?');
        $req->execute([$pseudo]);
        $user = $req->fetch();

        if ($user && password_verify($password, $user['crypt_password'])) {
            $_SESSION['user'] = $user['pseudo']; // Stocker le pseudo de l'utilisateur dans la session
            header('Location: bienvenue.php'); // Rediriger vers la page de bienvenue
            exit;
        } else {
            $err_pseudo = 'Pseudo ou mot de passe incorrect.';
        }
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
    <style>
        body {
            background-image: url(./img/connexion.jpg);
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: cover;
        }


        .container {
            padding: 20px;
            border-radius: 10px;
            background-color: rgba(0, 0, 0, 0.3);
            /* Réduire l'opacité à 0.3 */
        }

        .container h1,
        .container .form-label,
        .container .btn {
            color: rgba(255, 255, 255, 0.8);
            /* Couleur de texte */
        }

        .container .form-control {
            background-color: rgba(255, 255, 255, 0.9);
            /* Couleur de fond semi-transparente pour les champs de saisie */
        }

        .container .text-white {
            color: rgba(255, 255, 255, 0.8);
            /* Couleur de texte pour le lien */
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
                        <?php if (!empty($err_pseudo)) echo displayErrorMessage($err_pseudo); ?>
                        <label class="form-label text-white fs-5">Pseudo</label>
                        <input class="form-control" type="text" name="pseudo" value="<?php echo isset($pseudo) ? htmlspecialchars($pseudo) : ''; ?>" placeholder="Pseudo" required>
                    </div>
                    <div class="mb-4 p-1">
                        <?php if (!empty($err_password)) echo displayErrorMessage($err_password); ?>
                        <label class="form-label text-white fs-5">Mot de passe</label>
                        <input class="form-control" type="password" name="password" placeholder="Mot de passe" required>
                    </div>
                    <div id="btn" class="mb-4 mt-5 p-1">
                        <button type="submit" name="connexion" class="btn btn-primary">Se connecter</button>
                    </div>
                    <!-- Lien pour la réinitialisation du mot de passe -->
                    <div class="mb-4 p-1 ">
                        <a class="text-white" href="password_reset.php">Mot de passe oublié ?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php require_once('_footer/footer.php'); ?>
</body>

</html>