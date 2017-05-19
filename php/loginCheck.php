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

require '../vendor/autoload.php';

use Kreait\Firebase;

# If the JSON file is located in a path accessible to your project,
# or if you want to create multiple dedicated instances
$firebase = (new Firebase\Factory())
    ->withCredentials(__DIR__.'/json/JeSuisEnCours-70503524b2fa.json')
    ->withDatabaseUri('https://jesuisencours-63b19.firebaseio.com/')
    ->create();

$database = $firebase->getDatabase();


$user = htmlspecialchars($_POST['log']);

$pass = htmlspecialchars($_POST['pwd']);


global $database;

$reference = $database->getReference('prof')
    ->orderByChild("username")
    ->equalTo($user);

$prof = $reference->getValue();
foreach ($prof as $x) {
    $password = $x['password'];
}
if(password_verify($pass, $password)) {
    session_start();
    $_SESSION['adminUser'] = $user;
    header('Location: ../principal.html');
} else {
    header('Location: ../login.html');
}

$req->closecursor();

?>