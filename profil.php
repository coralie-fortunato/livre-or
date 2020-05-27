<?php
session_start();
$db= mysqli_connect("localhost","root","","livreor");
$login=$_SESSION['login'];
$error_login=null;
$error_pwd= null;



if(isset($login)){
$req_user_data="SELECT `login`, `password` FROM `utilisateurs` WHERE `login`= '".$_SESSION["login"]."'";
$query=mysqli_query($db,$req_user_data);
$user_data=mysqli_fetch_assoc($query);

}
if(isset($_POST["valider"])){
    $login2=htmlentities($_POST["new_login"]);
    

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
           
            $_SESSION["login"]=$login2;
            header("Location:profil.php?success");
            
        }
    }
   
}
if(isset($_POST["modifier"])){
    $password= htmlentities($_POST["password"]);
    $password_confirm= htmlentities($_POST["password_confirm"]);
    if(!empty($password) && !empty($password_confirm)){
        if($password === $password_confirm ){
            $req_update2="UPDATE `utilisateurs` SET `password`= '$password_confirm' WHERE login= '$login'" ;
            mysqli_query($db, $req_update2);
            header("Location:profil.php?success");
        }
        else{
            
            $error_pwd="Mot de passe différent";
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
    <title>Profil</title>
</head>
<body>
    <header>
    <?php include("header.php");?>  
    </header>
    <main class="main_form">
        <h1>Modifier votre profil</h1>

        <?php if($error_login): ?>
        <div class="error">
          <p><?=  $error_login ?></p>
        </div>
        <?php endif; ?>

        <?php if($error_pwd): ?>
        <div class="error">
          <p><?=  $error_pwd ?></p>
        </div>
        <?php endif; ?>
        <?php if(isset($_GET["success"])):?>
        <div class="success">
          <p><?php echo "Votre profil a été mis a jour avec succès" ?></p>
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
            
                <input type="text" name="new_login" class="input_update" placeholder="Votre nouveau login">
                
            
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
        <div class="form_pwds">
            <input type="password" name="password" class="input_update" placeholder="Votre nouveau mot de passe">
            <input type="password" name="password_confirm" class="input_update" placeholder="Confirmer votre nouveau mot de passe">
            
           
        </div>
        <?php endif; ?>
        <?php if(isset($_GET["login"])):?>
            <button type="submit" name="valider" class="update_profile">Enregistrer les modifications</button>
        <?php endif; ?>
        <?php if(isset($_GET["password"])):?>
            <button type="submit" name="modifier" class="update_profile">Enregistrer les modifications</button>
        <?php endif; ?>
     
    </form>
    </main>
    <footer></footer>
</body>
</html>