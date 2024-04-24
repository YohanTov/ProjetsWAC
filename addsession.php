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
        <div><a href="abonnement.php"> Abonnements </a></div>
        <div><a href="history.php"> Historique </a></div>
    </div>

    <h1> Ajouter une séance </h1>

    <form action="" method="post"> 
        <input type="text" name="idmovie" class="search" placeholder="ID du film"> <br/>
        <input type="text" name="idroom" class="search" placeholder="Numéro de la salle"> <br/>
        <input type="text" name="heure" class="search" placeholder="YYYY-MM-JJ HH:MM:SS"> <br/>
        <input type="submit" name="submit" class="submit" value="Ajouter">
    </form>


    <div class=resultat>
    <?php 
$movieid= isset($_POST["idmovie"] ) ? $_POST["idmovie"]: '';
$movieroom= isset($_POST["idroom"] ) ? $_POST["idroom"]: '';
$movieheure= isset($_POST["heure"] ) ? $_POST["heure"]: '';

    if(!empty($movieid) && !empty($movieroom) && !empty($movieheure)){
        $reponse = $bdd->query("INSERT INTO movie_schedule(id_movie, id_room, date_begin) VALUES ('$movieid', '$movieroom', '$movieheure')");
        $date= $reponse->fetchAll(PDO::FETCH_ASSOC);
        echo '<h3>'. "Séance ajoutée !". '</h3>';
    } 
?>
</div>
</body>
</html>


