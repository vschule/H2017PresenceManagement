<?php
require '../vendor/autoload.php';

use Kreait\Firebase;

# If the JSON file is located in a path accessible to your project,
# or if you want to create multiple dedicated instances
$firebase = (new Firebase\Factory())
    ->withCredentials(__DIR__.'/json/JeSuisEnCours-70503524b2fa.json')
    ->withDatabaseUri('https://jesuisencours-63b19.firebaseio.com/')
    ->create();

echo 'Test';

$database = $firebase->getDatabase();

$reference = $database->getReference('courses')
    ->orderByChild("prof")
    ->equalTo(123);
$snapshot = $reference->getSnapshot();

foreach ($reference->getValue() as $course){
    foreach ($course as $value){
        echo "value is $value <br/>";

    }}
