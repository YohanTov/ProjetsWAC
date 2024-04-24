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
        <div>   <a href="addsession.php"> Ajouter un créneau </a></div>
        <div>   <a href="member.php"> Membres </a></div>
    </div>
    <div class=secondlien>
        <div><a href="abonnement.php"> Abonnements  </a></div>
        <div><a href="history.php"> Historique </a></div>
    </div>

    <h1> Date de projection </h1>
    <h2 id="prime"> Entrez une date </h2>
    <form action="" method="post"> 
        <input type="text" name="date" class="search" placeholder="2018-MM-JJ">
        <input type="submit" name="submit" class="submit" value="Rechercher">
    </form>

    <div class=resultat>
    <?php 
$date = isset($_POST["date"] ) ? $_POST["date"]: '';

if(!empty($_POST['date'])){
    $reponse = $bdd->query("SELECT title, date_begin, movie_schedule.id as 'id_session' FROM movie INNER JOIN movie_schedule ON movie.id=movie_schedule.id_movie WHERE date_begin LIKE '$date%'");
    while ($donnees = $reponse->fetch()){
        echo '<br /> Session : ' . $donnees['id_session'] . '<h3>'.$donnees['title'].'</h3>';
        echo '<h3>'.$donnees['date_begin'].'</h3>';
        echo '__<br />';
    }
    $reponse->closeCursor();
}
?>
</div>
</body>
</html>
