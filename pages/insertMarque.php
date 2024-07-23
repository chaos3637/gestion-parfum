<?php
    require_once('identifier.php');

    require_once('connexiondb.php');
    
    $nomf=isset($_POST['nomF'])?$_POST['nomF']:"";
    $categorie=isset($_POST['categorie'])?$_POST['categorie']:"";
    
    $requete="insert into Marque(nomMarque,categorie) values(?,?)";
    $params=array($nomf,$categorie);
    $resultat=$pdo->prepare($requete);
    $resultat->execute($params);
    
    header('location:Marque.php');
?>