<?php
    require_once('identifier.php');
    require_once('connexiondb.php');
    $nom=isset($_POST['nom'])?$_POST['nom']:"";
    $idMarque=isset($_POST['idMarque'])?$_POST['idMarque']:1;

    $nomPhoto=isset($_FILES['photo']['name'])?$_FILES['photo']['name']:"";
    $imageTemp=$_FILES['photo']['tmp_name'];
    move_uploaded_file($imageTemp,"../images/".$nomPhoto);


    $requete="insert into ListeParfum(nom,idMarque,photo) values(?,?,?)";
    $params=array($nom,$idMarque,$nomPhoto);
    $resultat=$pdo->prepare($requete);
    $resultat->execute($params);
    
    header('location:ListeParfum.php');

?>