<?php
require './vendor/autoload.php';

use Kreait\Firebase;

# If the JSON file is located in a path accessible to your project,
# or if you want to create multiple dedicated instances
$firebase = (new Firebase\Factory())
    ->withCredentials('php/json/JeSuisEnCours-70503524b2fa.json')
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
        $c['id'] = $course['id'];
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
 	$s = array();
        $s['firstname'] = $student['firstname'];
        $s['lastname'] = $student['lastname'];
        $s['id'] = $student['id'];
       array_push($students, $s);
    }

    return $students;
}

function setAbs($idStudent, $course){

 global $database;

    $reference = $database->getReference('students/' . $idStudent . '/courses/' . $course . '/status');

   $reference
     ->set('present');

}

$students = getstudents();
$courses = getcourses("vincent.pont"); // todo dur


$student = htmlspecialchars($_POST['students']);
$course = htmlspecialchars($_POST['courses']);

if($student != "" && $course != ""){
  setAbs($student, $course); 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/styleLogin.css"/>
</head>
<body>
    <div class="form">
        <div class="header"><h2>Ajouter une absence</h2></div>
        <div class="login">

<form action="absences.php" method="post" enctype="multipart/form-data">
        
 <select name="students" id="students">
<?php foreach($students as $student){ ?>
  <option value="<?php echo $student['id'] ?>"><?php echo $student['firstname']; echo " "; echo $student['lastname']; ?></option>
<?php } ?>
</select> 

 <select name="courses" id="courses">
<?php foreach($courses as $course){ ?>
  <option value="<?php echo $course['id']; ?>"><?php echo $course['name']; ?></option>
<?php } ?>
</select>         

 
<input type="submit" value="Ok" class="btn">
                
    </form>
        </div><br/>
    </div>

</body>
</html>


