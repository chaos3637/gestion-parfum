<?php
require_once('identifier.php');

require_once('connexiondb.php');

$requeteF = "select * from Marque";
$resultatF = $pdo->query($requeteF);

?>
<! DOCTYPE HTML>
    <HTML>

    <head>
        <meta charset="utf-8">
        <title>Les Marques</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <style>
            body {
                background-image: url('../images/pic4.avif');
                background-size: cover;
                background-position: center;
            }

            /* Custom CSS to change the color of the table header to black */
            table thead {
                background-color: #000;
                /* Black color */
                color: #fff;
                /* Text color */
            }
        </style>

    </head>

    <body>
        <?php include("menu.php"); ?>


        <div class="container">

            <div class="panel panel-primary margetop">
                <div class="panel-heading">Entrer les infos :</div>
                <div class="panel-body">
                    <form method="post" action="insertListeParfum.php" class="form" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="nom">Nom :</label>
                            <input type="text" name="nom" placeholder="Nom" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="idMarque">Marque:</label>
                            <select name="idMarque" class="form-control" id="idMarque">
                                <?php while ($marque = $resultatF->fetch()) { ?>
                                    <option value="<?php echo $marque['idMarque'] ?>">
                                        <?php echo $marque['nomMarque'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="photo">Photo :</label>
                            <input type="file" name="photo" />
                        </div>


                        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-save"></span>
                            Enregistrer
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </body>

    </HTML>