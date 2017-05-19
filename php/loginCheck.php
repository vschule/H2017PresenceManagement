<?php
/*
try {
    $bdd = new PDO('mysql:host=localhost;dbname=;charset=utf8', '', '');
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}
*/


$user = htmlspecialchars($_POST['log']);
$pass = htmlspecialchars($_POST['pwd']);




if(password_verify($pass, $passCrypt[0])) {
    session_start();
    $_SESSION['adminUser'] = "valide";
    header('Location: ../principal.html');
} else {
    header('Location: ../login.html');
}

$req->closecursor();

?>