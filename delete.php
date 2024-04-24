<?php
$servername = "localhost";
$username = "Yohan";
$password = "jesuisla";
try {
    $bdd = new PDO("mysql:host=$servername;dbname=cinema;", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
        echo "Erreur : " . $e->getMessage();
    }
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
    </head>
    <body>

    <div class=lien>
        <div><a href="index.php"> Films </a></div>
        <div><a href="member.php"> Membres </a></div>
        <div><a href="planning.php"> Planning </a></div>
    </div>
    <div class=secondlien>
        <div><a href="abonnement.php"> Abonnements  </a></div>
        <div><a href="history.php"> Historique </a></div>
    </div>

    <h1> Supprimer un abonnement </h1>

    <form action="" method="post"> 
        <input type="text" name="memberID" class="search" placeholder="Numéro d'abonné"> <br/>
        <input type="submit" name="submit" class="submit" value="Supprimer l'abonnement">
    </form>

    <div class=resultat>
    <?php 
$memberID= isset($_POST["memberID"] ) ? $_POST["memberID"]: '';

if(!empty($memberID)){
    $reponse = $bdd->query("SET FOREIGN_KEY_CHECKS=OFF");
    $reponse = $bdd->query("DELETE from membership where id = $memberID");
    $reponse = $bdd->query("SET FOREIGN_KEY_CHECKS=ON");
    
    $date= $reponse->fetchAll(PDO::FETCH_ASSOC);
    echo '<h3>'. "Abonnement supprimé !". '</h3>';
}
?>
</div>