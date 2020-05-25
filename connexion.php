<?php 
session_start();
$db= mysqli_connect("localhost","root","","livreor");

$error=null;

   if(!empty($_POST["login"]) && !empty($_POST["password"])){
        $login=htmlentities($_POST["login"]);
        $password= htmlentities($_POST["password"]);
        $req_connect= "SELECT * FROM `utilisateurs` WHERE `login` = '$login' AND `password` = '$password' " ;
        $query_connect = mysqli_query($db,$req_connect);
        $data_users = mysqli_fetch_all($query_connect);
       
       if(count($data_users) == 0){
            $error="Login ou mot de passe incorrect";
        }
        else{
            session_start();
            $_SESSION["login"]= $login;
            header("Location: profil.php");
        }
    }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Connexion</title>
</head>
<body>
    <header></header>
    <main class="main_form">
        <h1>Se connecter</h1>
        <?php if($error): ?>
        <div class="error">
          <p><?=  $error ?></p>
        </div>
        <?php endif; ?>
        <form action="" method="post">
            <input type="text" name="login" placeholder="Votre login">
            <input type="password" name="password" placeholder="Votre mot de passe">
            <button type="submit" name="connect">Se connecter</button>
        </form>
    </main>
    <footer></footer>
</body>
</html>