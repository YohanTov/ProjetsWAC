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
    <title> My cinema</title>
    </head>

<body>
    <div class=lien>
        <div><a href="member.php"> Members </a></div>
        <div><a href="addsession.php"> Ajouter un créneau </a></div>
        <div><a href="planning.php"> Planning </a></div>
    </div>


    <h1> Films </h1>
    <br>
    <form action="" method="post"> 
        <input type="text" name="film" class="search" placeholder="Nom du film">
        <select name="distrib" id="distrib">
            <option value="tous">  </option>
            <?php
            $reponse = $bdd->query('SELECT name FROM distributor'); 
            while ($donnees = $reponse->fetch()){  ?>
            <option> <?php echo $donnees['name']; ?></option>
            <?php } ?> </select>
        <select name="genre" id="genre">
            <option value="tout">  </option>
            <?php
            $reponse = $bdd->query('SELECT name FROM genre');
            while ($donnees = $reponse->fetch()){ ?>
            <option> <?php echo $donnees['name']; ?></option>
            <?php } ?> </select>
        <input type="submit" name="submit" class="submit" value="Rechercher">
    </form>


    <div class="resultat">
        <h2> Résultat(s) de votre recherche : </h2>
        <?php 
    $titre_film = isset($_POST["film"] ) ? $_POST["film"]: '';
    $genre_film = isset($_POST["genre"] ) ? $_POST["genre"]: '';
    $distrib_film = isset($_POST["distrib"] ) ? $_POST["distrib"]: '';

// if(!empty($titre_film) === !empty($genre_film)){
//     $reponse = $bdd->query("SELECT title, movie.id FROM movie INNER JOIN movie_genre ON movie.id=movie_genre.id_movie INNER JOIN genre ON movie_genre.id_genre=genre.id WHERE name LIKE '%$genre_film%' and title LIKE '%$titre_film%'");
//     while ($donnees = $reponse->fetch()){
//         echo ' ID du film : '.$donnees['id']. '';
//         echo '<h3>'.$donnees['title']. '</h3>';
//         echo '__<br />';
// }
//

if(!empty($titre_film)){
    $reponse = $bdd->query("SELECT title, movie.id FROM movie WHERE title LIKE '%$titre_film%'");
    while ($donnees = $reponse->fetch()){
        echo '<h3>'.$donnees['title']. '</h3>';
        echo ' ID du film : '.$donnees['id']. '<br>';
        echo '__<br />';
    }
}

if(!empty($_POST['genre'])){
    $reponse = $bdd->query("SELECT title, movie.id FROM movie INNER JOIN movie_genre ON movie.id=movie_genre.id_movie INNER JOIN genre ON movie_genre.id_genre=genre.id WHERE name LIKE '%$genre_film%'");
    while ($donnees = $reponse->fetch()){
        echo '<h3>'.$donnees['title']. '</h3>';
        echo ' ID du film : '.$donnees['id']. '<br>';
        echo '__<br />';
    }
}

if(!empty($_POST['distrib'])){
    $reponse = $bdd->query("SELECT title, movie.id FROM movie INNER JOIN distributor ON movie.id_distributor=distributor.id WHERE name LIKE '%$distrib_film%'");
    while ($donnees = $reponse->fetch()){
        echo '<h3>'.$donnees['title']. '</h3>';
        echo ' ID du film : '.$donnees['id']. '<br>';
        echo '__<br />';
    }
} else {
        echo "<p> Aucun résultat trouvé</p>";
    }



    // Filtrer par film ET genre
//     if(isset($_POST['submit'])){
//         $reponse = $bdd->query("SELECT title, movie.id FROM movie INNER JOIN movie_genre ON movie.id=movie_genre.id_movie INNER JOIN genre ON movie_genre.id_genre=genre.id WHERE name LIKE '%$genre_film%' and title LIKE '%$titre_film%'");
//         while ($donnes = $reponse->fetch()){
//             echo ' ID du film : '.$donnees['id']. '';
//             echo '<h3>'.$donnees['title']. '</h3>';
//             echo '__<br />';
//         }
//     $reponse->closeCursor();
// }
//     // Filtrer par Film ET distributeur
//     if(!empty($_POST[$titre_film]) & !empty($_POST['distrib'])){
//         $reponse = $bdd->query("SELECT title, movie.id FROM movie INNER JOIN distributor ON movie.id_distributor=distributor.id WHERE name LIKE '%$distrib_film%' and title LIKE '%$titre_film%' ");
//         while ($donnes = $reponse->fetch()){
//             echo ' ID du film : '.$donnees['id']. '';
//             echo '<h3>'.$donnees['title']. '</h3>';
//             echo '__<br />';
//         }
//     $reponse->closeCursor();
// }
    // Filtrer par Genre et Distributeur
    // select title from movie innerjoin movie_genre on movie.id=movie_genre.id_movie innerjoin genre on movie_genre.id_genre=genre.id innerjoin distributor on movie.id_distributor=distributor.id where title like '%Pirates%' and genre.name like '%Action%' and distributor.name like '%Disney%';

    // Filtrer par film, genre et distributeur
?>





</div>

</ul>
</nav>
</body>
</html>