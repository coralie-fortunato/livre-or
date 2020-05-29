<meta charset="UTF-8" /> 
<?php
session_start();

date_default_timezone_set('Europe/Paris');

$db= mysqli_connect("localhost","root","","livreor");

if(!isset($_SESSION["id"])){
    header("Location:index.php");
}

if(isset($_POST['valider'])){
    $message=htmlspecialchars($_POST['message']);
    $id_user=$_POST['id_user'];
    $date= date('Y-m-d H:i:s');
   $add_comment=" INSERT INTO `commentaires`( `commentaire`, `id_utilisateur`, `date`) VALUES ('$message', '$id_user', '$date')";
   mysqli_query($db, $add_comment);
   header("Location: livre-or.php");
}
 ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Ajouter un commentaire</title>
</head>
<body>
    <header><?php include("header.php");?></header>
    <main class=main_form>
        <h1>Ajouter un commentaire</h1>
        <form action="" method="post">
            <input type="hidden" name='id_user' value=<?= $_SESSION["id"]?>>
            <textarea name='message' placeholder="Votre message ici..."></textarea>
            <button type="submit" name='valider'>Envoyer</button>
        </form>
    </main>
    <footer><?php include("footer.php");?></footer>
    
</body>
</html>