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
    <title> Members </title>
    </head>
    <body>

    <div class=lien>
        <div><a href="index.php"> Films </a></div>
        <div><a href="addsession.php"> Ajouter un créneau </a></div>
        <div><a href="planning.php"> Planning </a></div>
    </div>
    <div class=secondlien>
        <div><a href="abonnement.php"> Abonnements  </a></div>
        <div><a href="history.php"> Historique </a></div>
    </div>


    <h1> Membres </h1>
    <br>
    <form action="" method="post"> 
        <input type="text" name="lastname" class="search" placeholder="Nom">
        <input type="text" name="firstname" class="search" placeholder="Prénom">
        <input type="submit" name="submit" class="submit" value="Rechercher">
    </form>

    <div class="resultat">
    <h2> Résultat(s) de votre recherche : </h2>

<?php 
$lastname= isset($_POST["lastname"] ) ? $_POST["lastname"]: '';

if(!empty($lastname)){
    $reponse = $bdd->query("SELECT id, firstname, lastname FROM user WHERE lastname LIKE '%$lastname%'");
    while ($donnees = $reponse->fetch()){
        echo '<br /> ID: ' . $donnees['id'] . "<h3> " . $donnees['firstname'] . " " . $donnees['lastname']. '</h3>';
        echo '__<br />';
    }
        $reponse->closeCursor();
    }

$firstname= isset($_POST["firstname"] ) ? $_POST["firstname"]: '';

if(!empty($firstname)){
    $reponse = $bdd->query("SELECT id, firstname, lastname FROM user WHERE firstname LIKE '%$firstname%'");
    while ($donnees = $reponse->fetch()){
        echo '<br /> ID: ' . $donnees['id'] . "<h3> " . $donnees['firstname'] . " " . $donnees['lastname']. '</h3>';
        echo '__<br />';
    }
        $reponse->closeCursor();
}
?>
</div>
</body>
</html>