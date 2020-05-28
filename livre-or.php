<?php
session_start();

date_default_timezone_set('Europe/Paris');
$db= mysqli_connect("localhost","root","","livreor");
$req="SELECT login, commentaire, date FROM utilisateurs 
      LEFT JOIN commentaires ON utilisateurs.id = commentaires.id_utilisateur ORDER BY commentaires.id DESC";
$query=mysqli_query($db,$req);
$data=mysqli_fetch_all($query,MYSQLI_ASSOC);


 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Livre d'or</title>
</head>
<body>
    <header>
        <?php include("header.php");?>  
    </header>
    <main class="main-book">
        <h1>Vos messages</h1>
        <div class="container">
            <?php 
            for($i=0; $i <count($data); $i++){
            $date_us_format=$data[$i]["date"];
           $date_new_format= date('d/m/Y à H:i:s', strtotime($date_us_format));
            ?>
            <div class="comments">
            <p class="comment_info">Posté le <span class="datetime"> <?= $date_new_format?></span> par <span class="login"><?= $data[$i]["login"]?></span> </p>
            <p class="text"><?= $data[$i]["commentaire"]?></p>
            </p>
            </div>
            <?php }?>
        </div>
    <?php if(isset($_SESSION["login"])):?>    
    <div class="add_comment">
    <a href="commentaire.php" >Ajouter un commentaire</a>
    </div>
    <?php endif ?>
    <?php if(!isset($_SESSION["login"])):?> 
    <div class="connect_subcribe">
        <p> Veuillez vous <a href="connexion.php">connecter</a> ou vous <a href="inscription">inscrire</a> pour laisser un commentaire.</p>
    </div> 
    <?php endif ?>   
    </main>
    <footer></footer>
</body>
</html>