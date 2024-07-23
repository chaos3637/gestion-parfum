<?php

    require_once('identifier.php');
    require_once("connexiondb.php");
    $nomf=isset($_GET['nomF'])?$_GET['nomF']:"";
    $categorie=isset($_GET['categorie'])?$_GET['categorie']:"all";

    $size=isset($_GET['size'])?$_GET['size']:5;
    $page=isset($_GET['page'])?$_GET['page']:1;
    $offset=($page-1)*$size;

    if($categorie=="all"){
        $requete="select * from Marque
                where nomMarque like '%$nomf%'
                limit $size
                offset $offset";
        $requeteCount="select count(*) countF from Marque
                where nomMarque like '%$nomf%'";
    
    }else{
        $requete="select * from Marque
               where nomMarque like '%$nomf%'
               and categorie='$categorie'";
        $requeteCount="select count(*) countF from Marque
                where nomMarque like '%$nomf%'
                and categorie='$categorie'
                limit $size
                offset $offset";
    }
    
    $resultatF=$pdo->query($requete);  

    $resultatCount=$pdo->query($requeteCount);
    $tabCount=$resultatCount->fetch();
    $nbrMarque=$tabCount['countF'];
    $reste=$nbrMarque % $size;
        
    if($reste===0) 
        $nbrPage=$nbrMarque/$size;   
    else
        $nbrPage=floor($nbrMarque/$size)+1;
    
    /*if(isset($nomf=$_GET['nomF']))
        $nomf=$_GET['nomF'];
    else
        $nomf="";
    */
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Magasin de parfum</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        body {
            background-image: url('../images/dior2.avif'); 
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
        <div class="panel panel-success margetop">
            <div class="panel-heading">Rechercher des parfums</div>
            <div class="panel-body">
                <form method="get" action="Marque.php" class="form-inline">
                    <div class="form-group">
                        <input type="text" name="nomF" 
                               placeholder="Nom de la marque"
                               class="form-control"
                               value="<?php echo $nomf ?>"/>
                    </div>
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
                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-search"></span>
                        Chercher...
                    </button> 
                    &nbsp;&nbsp;
                    <?php if ($_SESSION['user']['role']=='ADMIN') {?>
                        <a href="nouvelleMarque.php">
                            <span class="glyphicon glyphicon-plus"></span>
                            Nouvelle Marque
                        </a>
                    <?php } ?>                 
                </form>
            </div>
        </div>
        
        <div class="panel panel-primary">
            <div class="panel-heading">Liste des marques (<?php echo $nbrMarque ?> Marques)</div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Id marque</th><th>Nom marque</th><th>Categorie</th>
                            <?php if ($_SESSION['user']['role']== 'ADMIN') {?>
                                <th>Actions</th>
                            <?php }?>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php while($Marque=$resultatF->fetch()){ ?>
                            <tr>
                                <td><?php echo $Marque['idMarque'] ?> </td>
                                <td><?php echo $Marque['nomMarque'] ?> </td>
                                <td><?php echo $Marque['categorie'] ?> </td> 
                                
                                <?php if ($_SESSION['user']['role']== 'ADMIN') {?>
                                    <td>
                                        <a href="editerMarque.php?idF=<?php echo $Marque['idMarque'] ?>">
                                            <span class="glyphicon glyphicon-edit"></span>
                                        </a>
                                        &nbsp;
                                        <a onclick="return confirm('Etes vous sur de vouloir supprimer cette marque')"
                                            href="supprimerMarque.php?idF=<?php echo $Marque['idMarque'] ?>">
                                                <span class="glyphicon glyphicon-trash"></span>
                                        </a>
                                    </td>
                                <?php }?>
                            </tr>
                        <?PHP } ?>
                   </tbody>
                </table>
                <div>
                    <ul class="pagination">
                        <?php for($i=1;$i<=$nbrPage;$i++){ ?>
                            <li class="<?php if($i==$page) echo 'active' ?>"> 
                                <a href="Marque.php?page=<?php echo $i;?>&nomF=<?php echo $nomf ?>&categorie=<?php echo $categorie ?>">
                                    <?php echo $i; ?>
                                </a> 
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
