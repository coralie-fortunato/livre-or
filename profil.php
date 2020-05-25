<?php
session_start();
$db= mysqli_connect("localhost","root","","livreor");

$login=$_SESSION['login'];
var_dump($login);
$error_login=null;
$success_message=null;
if(isset($login)){
$req_user_data="SELECT `login`, `password` FROM `utilisateurs` WHERE `login`= '".$_SESSION["login"]."'";
$query=mysqli_query($db,$req_user_data);
$user_data=mysqli_fetch_assoc($query);

}
if(isset($_POST["valider"])){
    $login2=htmlentities($_POST["new_login"]);
    //$password= htmlentities($_POST["password"]);
    //$password_confirm= htmlentities($_POST["confirm_password"]);

    if(!empty($login2)){
        $req_login="SELECT * FROM `utilisateurs` WHERE login='$login2'";
        $query_login= mysqli_query($db, $req_login);
        $compare_login=mysqli_fetch_all($query_login);
        
        if(count($compare_login) != 0){
            $error_login="Désolé ce login est déjà utilsé";
        }
        else{
            $req_update="UPDATE `utilisateurs` SET `login`= '$login2' WHERE login= '$login'" ;
            mysqli_query($db, $req_update);
            $success_message= "Votre profil a été mis à jour avec succès";
            $_SESSION["login"]=$login2;
            header("Location:profil.php");
        }
    }
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
    <header></header>
    <main class="main_profile">
        <h1>Modifier votre profil</h1>
        <?php if($error_login): ?>
        <div class="error">
          <p><?=  $error_login ?></p>
        </div>
        <?php endif; ?>
        <?php if($success_message): ?>
        <div class="error">
          <p><?=  $success_message ?></p>
        </div>
        <?php endif; ?>
    <form action="" method="post">
    <?php if(!isset($_GET["login"])):?>
        <div class="form_items">
            <label>Login</label>
            <input type="" name="login" class="input_profile" value=<?php echo $user_data["login"];?> disabled>
            <a href="profil.php?login"> Modifier</a>
        </div>
        <?php endif; ?>
        <?php if(isset($_GET["login"])):?>
        <div class="form_items">
            
            <input type="text" name="new_login" class="input_profile" placeholder="Votre nouveau login">
          
        </div>
        <?php endif; ?>
        <?php if(!isset($_GET["password"])):?>
        <div class="form_items">
            <label>Mot de passe</label>
            <input type="password" name="password" class="input_profile" value=<?php echo $user_data["password"];?> disabled>
            <a href="profil.php?password">Modifier</a>
        </div>
        <?php endif; ?>
        <?php if(isset($_GET["password"])):?>
        <div class="form_items">
            <input type="password" name="password" class="input_profile" placeholder="Votre nouveau mot de passe">
            <input type="password" name="password" class="input_profile" placeholder="Confirmer votre nouveau mot de passe">
           
        </div>
        <?php endif; ?>
        <button type="submit" name="valider">Enregistrer les modifications</button>
        
     
    </form>
    </main>
    <footer></footer>
</body>
</html>