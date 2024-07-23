<?php
   require_once('identifier.php');

    
    require_once("connexiondb.php");
  
    $nom=isset($_GET['nom'])?$_GET['nom']:"";
    $idMarque=isset($_GET['idMarque'])?$_GET['idMarque']:0;
    
    $size=isset($_GET['size'])?$_GET['size']:5;
    $page=isset($_GET['page'])?$_GET['page']:1;
    $offset=($page-1)*$size;
    
    $requeteMarque="select * from Marque";

    if($idMarque==0){
        $requeteListeParfum="select idListeParfum,nom,nomMarque,photo 
                from Marque as m,ListeParfum as lp
                where m.idMarque=lp.idMarque
                and (nom like '%$nom%')
                order by idListeParfum
                limit $size
                offset $offset";
        
        $requeteCount="select count(*) countS from ListeParfum
                where nom like '%$nom%'";
    }else{
         $requeteListeParfum="select idListeParfum,nom,nomMarque,photo 
                from Marque as m,ListeParfum as lp
                where m.idMarque=lp.idMarque
                and (nom like '%$nom%')
                and m.idMarque=$idMarque
                 order by idListeParfum
                limit $size
                offset $offset";
        
        $requeteCount="select count(*) countS from ListeParfum
                where (nom like '%$nom%')
                and idMarque=$idMarque";
    }

    $resultatMarque=$pdo->query($requeteMarque);
    $resultatListeParfum=$pdo->query($requeteListeParfum);
    $resultatCount=$pdo->query($requeteCount);

    $tabCount=$resultatCount->fetch();
    $nbrListeParfum=$tabCount['countS'];
    $reste=$nbrListeParfum % $size;   
    if($reste===0) 
        $nbrPage=$nbrListeParfum/$size;   
    else
        $nbrPage=floor($nbrListeParfum/$size)+1;  
    
    /*if(isset($nomf=$_GET['nomF']))
        $nomf=$_GET['nomF'];
    else
        $nomf="";
    */
?>
<! DOCTYPE HTML>
<HTML>
<head>
    <meta charset="utf-8">
    <title>La Liste des Parfums</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    
    <style>
        /* Custom CSS to change the color of the table head to black */
        table thead {
            background-color: #000; /* Black color */
            color: #fff; /* Text color */
        }

        body {
            background-image: url('../images/dior2.avif'); 
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
    <body>
        <?php require("menu.php"); ?>
        
        <div class="container">
            <div class="panel panel-success margetop">
            
				<div class="panel-heading">Rechercher dans la liste des parfums</div>
				
				<div class="panel-body">
					<form method="get" action="ListeParfum.php" class="form-inline">
						<div class="form-group">
						
                            <input type="text" name="nom" 
                                   placeholder="Nom"
                                   class="form-control"
                                   value="<?php echo $nom ?>"/>
                        </div>
                            <label for="idMarque">Marque:</label>
                            
				            <select name="idMarque" class="form-control" id="idMarque"
                                    onchange="this.form.submit()">
                                    
                                    <option value=0>Toutes les Marques</option>
                                    
                                <?php while ($Marque=$resultatMarque->fetch()) { ?>
                                
                                    <option value="<?php echo $Marque['idMarque'] ?>"
                                    
                                        <?php if($Marque['idMarque']==$idMarque) echo "selected" ?>>
                                        
                                        <?php echo $Marque['nomMarque'] ?> 
                                        
                                    </option>
                                    
                                <?php } ?>
                                
				            </select>
				            
				        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-search"></span>
                            Chercher...
                        </button> 
                        
                        &nbsp;&nbsp;
                         <?php if ($_SESSION['user']['role']== 'ADMIN') {?>
                         
                            <a href="nouveauListeParfum.php">
                            
                                <span class="glyphicon glyphicon-plus"></span>
                                Nouveau Parfum
                                
                            </a>
                            
                         <?php }?>
					</form>
				</div>
			</div>
            
            <div class="panel panel-primary">
                <div class="panel-heading">Liste des Parfums (<?php echo $nbrListeParfum ?> ListeParfum)</div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Id Parfum</th> <th>Nom</th> 
                                <th>Marque</th>  <th>Photo</th>
                                <?php if ($_SESSION['user']['role']== 'ADMIN') {?>
                                	<th>Actions</th>
                                <?php }?>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php while($ListeParfum=$resultatListeParfum->fetch()){ ?>
                                <tr>
                                    <td><?php echo $ListeParfum['idListeParfum'] ?> </td>
                                    <td><?php echo $ListeParfum['nom'] ?> </td>
                                    <td><?php echo $ListeParfum['nomMarque'] ?> </td>
                                    <td>
                                        <img src="../images/<?php echo $ListeParfum['photo']?>"
                                        width="50px" height="50px" class="img-circle">
                                    </td> 
                                    
                                     <?php if ($_SESSION['user']['role']== 'ADMIN') {?>
                                        <td>
                                            <a href="editerListeParfum.php?idS=<?php echo $ListeParfum['idListeParfum'] ?>">
                                                <span class="glyphicon glyphicon-edit"></span>
                                            </a>
                                            &nbsp;
                                            <a onclick="return confirm('Etes vous sur de vouloir supprimer le stagiaire')"
                                            href="supprimerListeParfum.php?idS=<?php echo $ListeParfum['idListeParfum'] ?>">
                                                <span class="glyphicon glyphicon-trash"></span>
                                            </a>
                                        </td>
                                    <?php }?>
                                    
                                 </tr>
                             <?php } ?>
                        </tbody>
                    </table>
                <div>
                    <ul class="pagination">
                        <?php for($i=1;$i<=$nbrPage;$i++){ ?>
                            <li class="<?php if($i==$page) echo 'active' ?>"> 
            <a href="ListeParfum.php?page=<?php echo $i;?>&nom=<?php echo $nom ?>&idMarque=<?php echo $idMarque ?>">
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
</HTML>