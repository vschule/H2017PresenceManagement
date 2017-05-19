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
    echo "<link rel='stylesheet' type='text/css' href='css/stylePrincipal.css'/>";
echo "</head>";
echo "<body>";

$list_courses = array();
    foreach ($reference->getValue() as $course) {
        $c = array();
        $c['date'] = $course['date'];
        $c['start'] = $course['start'];
        $c['end'] = $course['end'];
        $c['name'] = $course['name'];
        $c['id'] = key($course);

        array_push($list_courses, $c);


    }

