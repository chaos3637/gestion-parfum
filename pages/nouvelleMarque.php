<?php 
    require_once('identifier.php');

?>
<! DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="utf-8">
        <title>nouvelle Marque</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
        body {
            background-image: url('../images/pic2.avif'); 
            background-size: cover;
            background-position: center;
        }

        /* Custom CSS to change the color of the table header to black */
        table thead {
            background-color: #000; /* Black color */
            color: #fff; /* Text color */
        }
    </style>
  
  
    </head>
    <body>
        <?php include("menu.php"); ?>
        
        <div class="container">
                       
             <div class="panel panel-primary margetop">
                <div class="panel-heading">Veuillez saisir les données de la nouvelle marque</div>
                <div class="panel-body">
                    <form method="post" action="insertMarque.php" class="form">
						
                        <div class="form-group">
                             <label for="categorie">Nom de la Marque:</label>
                            <input type="text" name="nomF" 
                                   placeholder="Nom de la marque"
                                   class="form-control"/>
                        </div>
                        
                        <div class="form-group">
                            <label for="categorie">Categorie:</label>
				            <select name="categorie" class="form-control" id="categorie">
                            <option value="PR"> PRADA</option>
                            <option value="ARM"> ARMANI</option>
                            <option value="LV">  Louis vuitton</option>
                            <option value="TF"> TOM FORD</option>
                            <option value="CK"> Calvin Klein</option>
                            <option value="DR"> DIOR</option>
                             
			            </select>
                        </div>
                        
				        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-save"></span> Enregistrer
                        </button>

					</form>
                </div>
            </div>
        </div>      
    </body>
</HTML>