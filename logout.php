<?php
session_start();
unset($_SESSION["login"]);
header("Location: connexion.php");
?>