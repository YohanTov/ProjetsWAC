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
        <div><a href="member.php"> Members  </a></div>
        <div><a href="history.php"> Historique </a></div>
    </div>

    <h1> Ajouter un nouvel abonné </h1>
    <form action="" method="post"> 
        <input type="text" name="id_user" class="search" placeholder="ID client"> <br/>
        <input type="text" name="id_sub" class="search" placeholder="ID abonnement"> <br/>
        <input type="submit" name="submit" class="submit" value="Ajouter">
    </form>

    <div class="resultat">
    <p> 1. VIP | 2. GOLD | 3. Classic | 4. Pass Day </p>
    <?php 
$iduser= isset($_POST["id_user"] ) ? $_POST["id_user"]: '';
$idsub= isset($_POST["id_sub"] ) ? $_POST["id_sub"]: '';

if(!empty($iduser) && !empty($idsub)){
    $reponse = $bdd->query("INSERT INTO membership(id_user, id_subscription) VALUES ('$iduser', '$idsub')");
    $date= $reponse->fetchAll(PDO::FETCH_ASSOC);
        echo '<h3>'. "Nouvel abonnement bien ajouté au membre !". '</h3>';
}
?>
</div>
</body>
</html>

