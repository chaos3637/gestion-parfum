 <?php
    require_once('identifier.php');

    require_once('connexiondb.php');
    $idf=isset($_POST['idF'])?$_POST['idF']:"";
    $nomf=isset($_POST['nomF'])?$_POST['nomF']:"";
    $categorie=isset($_POST['categorie'])?$_POST['categorie']:"";
    
    $requete="update Marque set nomMarque=?,categorie=? where idMarque=?";
    $params=array($nomf,$categorie,$idf);
    $resultat=$pdo->prepare($requete);
    $resultat->execute($params);
    
    header('location:Marque.php');
?>