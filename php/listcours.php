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

$database = $firebase->getDatabase();

    $reference = $database->getReference();

    $reference = $database->getReference('courses')
        ->orderByChild("prof")
        ->equalTo($_SESSION['adminUser']);

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
echo "<tr><th>Date</th><th>Start</th><th>End</th><th>name</th></tr></thead><tbody>";
$list_courses = array();
    foreach ($reference->getValue() as $course) {
        $c = array();
        $c['date'] = $course['date'];
        $c['start'] = $course['start'];
        $c['end'] = $course['end'];
        $c['name'] = $course['name'];
        $c['id'] = $course['id'];
        $_SESSION['coursSelect'] = $c['id'];
        array_push($list_courses, $c);

        echo "<tr>";
            echo "<th scope='row'>";
                echo $c['date'];
            echo "</th>";

        echo "<th scope='row'>";
        echo $c['start'];
        echo "</th>";


        echo "<th scope='row'>";
        echo $c['end'];
        echo "</th>";


        echo "<th scope='row'>";
        echo $c['name'];
        echo "</th>";

        echo "<th scope='row'>";
        echo "<form action='liststudent.php' method='post'>";
        echo "<input type='submit' name='".$c['id'] . "' value='Details'/>";
        echo "</form>";
        echo "</th>";

        echo "</tr>";

    }
    echo "</tbody>";
    echo "</table>";
echo "</body>";
echo "</html>";
