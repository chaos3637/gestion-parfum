<?php
require_once("connexiondb.php");
require_once("../fonction/fonctions.php");

$validationErrors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
    $pwd1 = $_POST['pwd1'];
    $pwd2 = $_POST['pwd2'];
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

    if (strlen($login) < 4) {
        $validationErrors[] = "Erreur!!! Le login doit contenir au moins 4 caractères";
    }

    if (empty($pwd1) || md5($pwd1) !== md5($pwd2)) {
        $validationErrors[] = "Erreur!!! Les deux mots de passe ne sont pas identiques ou sont vides";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $validationErrors[] = "Erreur!!! Email non valide";
    }

    if (empty($validationErrors)) {
        if (rechercher_par_login($login) === 0 && rechercher_par_email($email) === 0) {
            $hashedPwd = md5($pwd1);
            $role = 'VISITEUR';
            $etat = 0;

            $requete = $pdo->prepare("INSERT INTO utilisateur (login, email, pwd, role, etat) 
                                      VALUES (:plogin, :pemail, :ppwd, :prole, :petat)");

            $requete->execute([
                'plogin' => $login,
                'pemail' => $email,
                'ppwd' => $hashedPwd,
                'prole' => $role,
                'petat' => $etat,
            ]);

            $success_msg = "Félicitations, votre compte est créé, mais temporairement inactif jusqu'à activation par l'admin";
        } else {
            if (rechercher_par_login($login) > 0) {
                $validationErrors[] = 'Désolé, le login existe déjà';
            }
            if (rechercher_par_email($email) > 0) {
                $validationErrors[] = 'Désolé, cet email existe déjà';
            }
        }
    }
}
?>


<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Nouvel utilisateur</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    
    <style>
        body {
            background-image: url('../images/dior.avif'); /* Replace 'background_image.jpg' with the path to your background image */
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-container {
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); /* Shadow effect */
        }

        .form-container h1 {
            margin-bottom: 20px;
            text-align: center;
        }

        .form-container input[type="text"],
        .form-container input[type="password"],
        .form-container input[type="email"] {
            margin-bottom: 10px;
        }

        .form-container input[type="submit"] {
            width: 100%;
        }

        .alert {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 form-container">
            <h1>Création d'un nouveau compte utilisateur</h1>

            <form class="form" method="post">

                <div class="form-group">
                    <input type="text"
                           required="required"
                           minlength="4"
                           title="Le login doit contenir au moins 4 caractères..."
                           name="login"
                           placeholder="Taper votre nom d'utilisateur"
                           autocomplete="off"
                           class="form-control">
                </div>

                <div class="form-group">
                    <input type="password"
                           required="required"
                           minlength="3"
                           title="Le Mot de passe doit contenir au moins 3 caractères..."
                           name="pwd1"
                           placeholder="Taper votre mot de passe"
                           autocomplete="new-password"
                           class="form-control">
                </div>

                <div class="form-group">
                    <input type="password"
                           required="required"
                           minlength="3"
                           name="pwd2"
                           placeholder="retaper votre mot de passe pour le confirmer"
                           autocomplete="new-password"
                           class="form-control">
                </div>

                <div class="form-group">
                    <input type="email"
                           required="required"
                           name="email"
                           placeholder="Taper votre email"
                           autocomplete="off"
                           class="form-control">
                </div>

                <input type="submit" class="btn btn-primary" value="Enregistrer">
            </form>
            <br>
            <?php
            if (isset($validationErrors) && !empty($validationErrors)) {
                foreach ($validationErrors as $error) {
                    echo '<div class="alert alert-danger">' . $error . '</div>';
                }
            }

            if (isset($success_msg) && !empty($success_msg)) {
                echo '<div class="alert alert-success">' . $success_msg . '</div>';
                header('refresh:5;url=login.php');
            }
            ?>
        </div>
    </div>
</div>

</body>
</html>



