<?php
    require_once('identifier.php');

    require_once('connexiondb.php');
    $idS=isset($_POST['idS'])?$_POST['idS']:0;
    $nom=isset($_POST['nom'])?$_POST['nom']:"";
    $idMarque=isset($_POST['idMarque'])?$_POST['idMarque']:1;

    $nomPhoto=isset($_FILES['photo']['name'])?$_FILES['photo']['name']:"";
    $imageTemp=$_FILES['photo']['tmp_name'];
    move_uploaded_file($imageTemp,"../images/".$nomPhoto);

    echo $nomPhoto ."<br>";
    echo $imageTemp;
    if(!empty($nomPhoto)){
        $requete="update ListeParfum set nom=?,idMarque=?,photo=? where idListeParfum=?";
        $params=array($nom,$idMarque,$nomPhoto,$idS);
    }else{
        $requete="update ListeParfum set nom=?,idMarque=? where idListeParfum=?";
        $params=array($nom,$idMarque,$idS);
    }

    $resultat=$pdo->prepare($requete);
    $resultat->execute($params);
    
    header('location:ListeParfum.php');

?>