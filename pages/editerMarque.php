<?php
    /*require_once('connexiondb.php');
    
    $nomf=isset($_POST['nomF'])?$_POST['nomF']:"";
    $niveau=isset($_POST['niveau'])?$_POST['niveau']:"";
    $idf=isset($_POST['idF'])?$_POST['idF']:"";
    $requete="insert into filiere(nomFiliere,niveau) values(?,?)";
    $params=array($nomf,$niveau);
    $resultat=$pdo->prepare($requete);
    $resultat->execute($params);*/
    require_once('identifier.php');
    require_once('connexiondb.php');
    $idf=isset($_GET['idF'])?$_GET['idF']:0;
    $requete="select * from Marque where idMarque=$idf";
    $resultat=$pdo->query($requete);
    $Marque=$resultat->fetch();
    $nomf=$Marque['nomMarque'];
    $categorie=$Marque['categorie'];
    //$nomf=isset($_POST['nomF'])?$_POST['nomF']:"";
    //$niveau=isset($_POST['niveau'])?$_POST['niveau']:"";
    
?>
<! DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="utf-8">
        <title>page blanche</title>
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
                <div class="panel-heading">Edition de la Marque :</div>
                <div class="panel-body">
                    <form method="post" action="updateMarque.php" class="form">
						<div class="form-group">
                             <label for="categorie">id de la marque: <?php echo $idf ?></label>
                            <input type="hidden" name="idF" 
                                   class="form-control"
                                    value="<?php echo $idf ?>"/>
                        </div>
                        
                        <div class="form-group">
                             <label for="niveau">Nom de la marque:</label>
                            <input type="text" name="nomF" 
                                   placeholder="Nom de la marque"
                                   class="form-control"
                                   value="<?php echo $nomf ?>"/>
                        </div>
                        
                        <div class="form-group">
                            <label for="categorie">Categorie:</label>
				            <select name="categorie" class="form-control" id="categorie"
                                onchange="this.form.submit()">
                            <option value="all" <?php if($categorie==="all") echo "selected" ?>>Toutes les categories</option>
                            <option value="PR"   <?php if($categorie==="PR")   echo "selected" ?>>PRADA</option>
                            <option value="ARM"   <?php if($categorie==="ARM")   echo "selected" ?>>ARMANI</option>
                            <option value="LV" <?php if($categorie==="LV") echo "selected" ?>> Louis vuitton</option>
                            <option value="TF" <?php if($categorie==="TF") echo "selected" ?>> TOM FORD</option>
                            <option value="CK" <?php if($categorie==="CK") echo "selected" ?>> Calvin Klein</option>
                            <option value="DR"   <?php if($categorie==="DR")   echo "selected" ?>>DIOR</option>
                             
			            </select>
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