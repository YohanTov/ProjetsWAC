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
        <div>   <a href="planning.php"> Planning </a></div>
    </div>

    <div class=secondlien>
        <div><a href="abonnement.php"> Abonnements  </a></div>
        <div><a href="member.php"> Members </a></div>
    </div>

    <h1> Historique </h1>
    <form action="" method="post"> 
        <input type="text" name="lastname" class="search" placeholder="Nom">
        <input type="text" name="firstname" class="search" placeholder="Prénom">
        <input type="submit" name="submit" class="submit" value="Rechercher">
    </form>

    <form action="" method="post"> 
        <input type="text" name="id_member" class="search" placeholder="Member ID">
        <input type="text" name="id_session" class="search" placeholder="Session ID">
        <input type="submit" name="submit" class="submit" value="Ajouter">
    </form>

    <div class="resultat">
    <h2> Résultat(s) de votre recherche : </h2>

    <?php 
$lastname= isset($_POST["lastname"] ) ? $_POST["lastname"]: '';
$firstname= isset($_POST["firstname"] ) ? $_POST["firstname"]: '';

if(!empty($lastname) === !empty($firstname)){
    $reponse = $bdd->query("SELECT title, id_room, movie_schedule.date_begin FROM movie 
    INNER JOIN movie_schedule ON movie.id=movie_schedule.id_movie
    INNER JOIN membership_log ON movie_schedule.id=membership_log.id_session 
    INNER JOIN membership ON membership_log.id_membership=membership.id 
    INNER JOIN user ON membership.id_user=user.id 
    WHERE firstname = '$firstname' AND lastname = '$lastname'");
    while ($donnees = $reponse->fetch()){
        echo '<br /><h3>'. $donnees['title']  . " vu le " . $donnees['date_begin'] . " en salle " .  $donnees['id_room'] .  '</h3>';
        echo '__<br />';
    }
        $reponse->closeCursor();
    } else {
    echo "ce membre n'est pas abonnée";
}

$addsession=isset($_POST["id_session"] ) ? $_POST["id_session"]: '';
$addmember=isset($_POST["id_member"] ) ? $_POST["id_member"]: '';

if(!empty($addsession) && !empty($addmember)){
    $reponse = $bdd->query("INSERT INTO membership_log(id_membership, id_session) VALUES ('$addmember', '$addsession')");
    $date= $reponse->fetchAll(PDO::FETCH_ASSOC);
        echo '<h3>'. "Séance bien ajoutée dans l'historique !". '</h3>';
}
?>
</body>
</html>

