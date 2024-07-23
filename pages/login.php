<?php
session_start();
if (isset($_SESSION['erreurLogin']))
    $erreurLogin = $_SESSION['erreurLogin'];
else {
    $erreurLogin = "";
}
session_destroy();
?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <title>LOGIN PAGE</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
   .login-bg {
          background-image: url('../images/jean paul gautier.jpg'); /* changed background image */
          background-size: cover;
          background-position: center;
          height: 100vh;
          display: flex;
          justify-content: center;
          align-items: center;
        }

   .container {
          margin: auto;
          max-width: 600px;
          padding: 30px;
      }

   .card {
          width: 100%;
          max-width: 600px;
          margin: auto;
      }

   .card-header {
          background-color: #663399;
          color: #fff;
          padding: 20px;
          font-size: 24px;
      }

   .card-body {
          padding: 30px;
      }

   .form-group {
          margin-bottom: 20px;
      }

   .btn-success {
          background-color: #663399;
          padding: 10px 20px;
          border: none;
          border-radius: 5px;
          cursor: pointer;
      }

   .alert-danger {
          background-color: #FFC080;
          padding: 10px;
          border: 1px solid #FFC080;
          border-radius: 5px;
      }
    </style>
</head>

<body>
    <div class="login-bg">
        <div class="container">
            <div class="card">
                <div class="card-header">Se connecter</div>
                <div class="card-body">
                    <form method="post" action="seConnecter.php" class="form">

                        <?php if (!empty($erreurLogin)) {?>
                            <div class="alert alert-danger">
                                <?php echo $erreurLogin;?>
                            </div>
                        <?php }?>

                        <div class="form-group">
                            <label for="login">Login :</label>
                            <input type="text" name="login" placeholder="Login" class="form-control" autocomplete="off" />
                        </div>

                        <div class="form-group">
                            <label for="pwd">Mot de passe :</label>
                            <input type="password" name="pwd" placeholder="Mot de passe" class="form-control" />
                        </div>

                        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-log-in"></span> Se connecter
                        </button>
                        <p class="text-right">
                            <a href="nouvelUtilisateur.php">Créer un compte</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>