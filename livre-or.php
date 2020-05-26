<?php
session_start();
$db= mysqli_connect("localhost","root","","livreor");
$req="SELECT login, commentaire, date FROM utilisateurs 
      LEFT JOIN commentaires ON utilisateurs.id = commentaires.id_utilisateur ORDER BY commentaires.id DESC";
$query=mysqli_query($db,$req);
$data=mysqli_fetch_all($query,MYSQLI_ASSOC);
var_dump($data);

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livre d'or</title>
</head>
<body>
    <header></header>
    <main>
        <?php 
        for($i=0; $i <count($data); $i++){
        ?>
        <p><strong><?= $data[$i]["login"]?></strong> <?= $data[$i]["date"]?> <br>
        <?= $data[$i]["commentaire"]?>
        </p>
        <?php }?>
        
    </main>
    <footer></footer>
</body>
</html>