<?php
    require_once('identifier.php');


    require_once('connexiondb.php');

    $idUser=isset($_POST['idUser'])?$_POST['idUser']:0;

    $login=isset($_POST['login'])?$_POST['login']:"";

    $email=isset($_POST['email'])?strtoupper($_POST['email']):"";
    
    $role=isset($_POST['role'])?strtoupper($_POST['role']):"";
    
    $requete="update utilisateur set login=?,email=?,role=? where idUser=?";

    $params=array($login,$email,$role,$idUser);

    $resultat=$pdo->prepare($requete);

    $resultat->execute($params);
    
    header('location:utilisateurs.php');
?>