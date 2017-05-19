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

//$hash = password_hash($pass,PASSWORD_BCRYPT,['cost' => 13]) ;

$req = $bdd->prepare('SELECT Password FROM admin WHERE Username = :username');
$req->execute(array(
    'username' => $user
));
$passCrypt = $req->fetch();


if(password_verify($pass, $passCrypt[0])) {
    session_start();
    $_SESSION['adminUser'] = "valide";
    header('Location: ../indexAdmin.php');
} else {
    header('Location: ../../login.php');
}

$req->closecursor();

?>