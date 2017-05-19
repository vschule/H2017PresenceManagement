<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 19/05/17
 * Time: 20:55
 */

require '../vendor/autoload.php';

use Kreait\Firebase;




# If the JSON file is located in a path accessible to your project,
# or if you want to create multiple dedicated instances
$firebase = (new Firebase\Factory())
    ->withCredentials(__DIR__.'/json/JeSuisEnCours-70503524b2fa.json')
    ->withDatabaseUri('https://jesuisencours-63b19.firebaseio.com/')
    ->create();

session_start();
$coursId = $_SESSION['coursSelect'];

$cours = "courses/" . $coursId . "/group";
$database = $firebase->getDatabase();

$reference = $database->getReference('students');

$snapshot = $reference->getSnapshot();

$students = array();
foreach ($snapshot->getValue() as $student) {
    $s = $student["firstname"] . " " . $student['lastname'] ;
    $status = $student["courses"]["190517-2300"]["status"];
    array_push($students, $s);
}


$reference = $database->getReference($cours);

$idGroup = $reference->getValue();


$textamettredanslaparenthese = "group/" . $idGroup . "/students";
$reference = $database->getReference($textamettredanslaparenthese);



$liststudents = $reference->getValue();

foreach ($liststudents as $student){

    $text = "students/" . $student  ;
    $a = $database->getReference($text);

}


echo "<!DOCTYPE html>";
echo "<html lang='en'>";
echo "<head>";
echo "<meta charset='UTF-8'>";
echo "<title>Principal</title>";
echo "<link rel='stylesheet' type='text/css' href='../css/styleCours.css'/>";
echo "</head>";
echo "<body>";
echo "<table>";
echo "<thead>";
echo "<tr><th>Nom</th><th>Presence</th></tr></thead><tbody>";
$list_courses = array();
foreach ($snapshot->getValue() as $student) {
    $s = $student["firstname"] . " " . $student['lastname'] ;
    $status = $student["courses"]["190517-2200"]["status"];
    array_push($students, $s);


    echo "<tr>";
    echo "<th scope='row'>";
    echo $s;
    echo "</th>";
    if($status == "absent")
    {
        echo "<th style='color:red;' scope='row'>";
        echo $status;
        echo "</th>";
    }
    else
    {
        echo "<th style='color:green;' scope='row'>";
        echo $status;
        echo "</th>";
    }

    echo "</tr>";

}
echo "</tbody>";
echo "</table>";
echo "</body>";
echo "</html>";
