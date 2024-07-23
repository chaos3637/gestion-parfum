<?php
        session_start();
        if(isset($_SESSION['user']) ){
            
            if($_SESSION['user']['role']=='ADMIN'){
               
                require_once('connexiondb.php');
                
                $idS=isset($_GET['idS'])?$_GET['idS']:0;

                $requete="delete from ListeParfum where idListeParfum=?";
                
                $params=array($idS);
                
                $resultat=$pdo->prepare($requete);
                
                $resultat->execute($params);
                
                header('location:ListeParfum.php'); 
                
            }else{
                $message="Vous n'avez pas le privilège de supprimer un Parfum!!!";
                
                $url='ListeParfum.php';
                
                header("location:alerte.php?message=$message&url=$url"); 
            }
           
        }else {
                header('location:login.php');
        }
?>