<?php
require_once('identifier.php');
   
require_once('connexiondb.php');
            
$idUser=isset($_GET['idUser'])?$_GET['idUser']:0;
$requete="delete from utilisateur where idUser=?";
            
$params=array($idUser);

$resultat=$pdo->prepare($requete);
            
$resultat->execute($params);
            
header('location:utilisateurs.php');   

?>