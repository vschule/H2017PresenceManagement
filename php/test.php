<?php
require '../vendor/autoload.php';

use Kreait\Firebase;

# If the JSON file is located in a path accessible to your project,
# or if you want to create multiple dedicated instances
$firebase = (new Firebase\Factory())
    ->withCredentials(__DIR__.'/json/JeSuisEnCours-70503524b2fa.json')
    ->withDatabaseUri('https://jesuisencours-63b19.firebaseio.com/')
    ->create();

$database = $firebase->getDatabase();

/**
 * @param $database
 */


function getcourses($username): array
{
    global $database;
    $reference = $database->getReference();

    $reference = $database->getReference('courses')
        ->orderByChild("prof")
        ->equalTo($username);

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

    return $list_courses;

}

/**
 * @param $database
 * @return array
 */
function getstudents(): array
{
    global $database;

    $reference = $database->getReference('students');

    $snapshot = $reference->getSnapshot();

    $students = array();
    foreach ($snapshot->getValue() as $student) {
       $s = $student["firstname"] . " " . $student['lastname'];
       array_push($students, $s);
    }

    return $students;
}



/**
 * @param $username
 * @return mixed
 */
function getpassword($username)
{
    global $database;

    $reference = $database->getReference('prof')
        ->orderByChild("username")
        ->equalTo($username);

    $prof = $reference->getValue();
    foreach ($prof as $x) {
        $password = $x['password'];
    }
    return $password;
}

getpassword("vincent.pont");