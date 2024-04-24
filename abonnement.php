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
} ?>

  <!DOCTYPE html>
  <html lang="en">
  <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title> Abonnement </title>
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

    <h1> Abonnement </h1>


  <div class="resultat">
    <div class="container">
      <button class="btn"><a href="newabonnement.php"> Add new member </a> </button>
    </div>

<table class="table">
  <thead>
    <tr>
      <th scope="col"> ID </th>
      <th scope="col"> Firstname </th>
      <th scope="col">Lastname </th>
      <th scope="col"> Statut </th>
      <th scope="col"> Operations </th>
    </tr>
  </thead>

  <tbody>
    <?php 
    $reponse = $bdd->query("SELECT membership.id, firstname, lastname, subscription.name from membership INNER JOIN user ON user.id=membership.id_user INNER JOIN subscription ON membership.id_subscription=subscription.id WHERE membership.id < 200 order by membership.id ASC");
    while ($donnees = $reponse->fetch()){
          $id = $donnees['id'];
          $firstname = $donnees['firstname'];
          $lastname = $donnees['lastname'];
          $statut = $donnees['name'];
          echo '<tr>
            <th scope="row">'. $id . ' </th>
            <td>'. $firstname .' </td>
            <td>'. $lastname .' </td>
            <td>'. $statut .'</td>
            <td> 
            <button><a href="update.php"> Update </button>
            <button><a href="delete.php" id="delete"> Delete </button>
            </td>
            </tr>';
}?>
</tbody>
</table>
</div>
</body>
</html>