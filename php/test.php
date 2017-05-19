<?php
require '../vendor/autoload.php';

use Kreait\Firebase\Configuration;
use Kreait\Firebase\Firebase;

$config = new Configuration();

$firebase = new Firebase('https://jesuisencours-63b19.firebaseio.com/', $config);
$result = $firebase->get('prof');
echo $result;