<?php
$_SESSION["login"] = array();
$_SESSION["nom"] = array();
$_SESSION["prenom"] = array();

unset($_SESSION["login"]);
unset($_SESSION["nom"]);
unset($_SESSION["prenom"]);



if (ini_get("session.use_cookies"))
{
    setcookie(session_name(), '', time()-42000);
}

session_destroy();
header("Location:index.php");
exit;