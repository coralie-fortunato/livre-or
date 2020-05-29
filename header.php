<h1>Mon livre d'or</h1>
<nav>
    <a href="index.php">Accueil</a>
    <?php if(!isset($_SESSION["login"])):?>
        <a href="inscription.php">S'incrire</a>
        <a href="connexion.php">Se connecter</a>
    <?php  endif;?>
    <?php if(isset($_SESSION["login"])):?>
        <a href="livre-or">Livre d'or</a>
        <a href="profil.php">Mon profil</a>
        <a href="logout.php">Se déconnecter</a>
    <?php  endif;?>
</nav>